<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\admin\model\AdminAttachment as AttachmentModel;
use think\File;
use think\Image;


/**
 * 后台附件管理控制器
 * @package app\admin\controller
 */
class Attachment extends Admin
{
    /**
     * 附件管理
     */
    public function index()
    {
        $param = $this->request->param();
        $search['filetype'] = 1;
        $search['type'] = 0;
        $search['keyword'] = '';
        $search['data_start'] = '';
        $search['data_end'] = '';
        if (isset($param['filetype'])) {
            $search['filetype'] = $param['filetype'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

        $where = 1;
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and `id` = " . $search['keyword'];
            } elseif ($search['type'] == 2) {
                $where .= " and `path` like " . $keyword;
            }
        }

        if (!empty($search['filetype'])) {
            $where .= " and `filetype` =" . $search['filetype'];
        }
        if (!empty($search['data_start'])) {
            $where .= " and create_time >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and create_time <= '" . strtotime($search['data_end']) . "'";
        }

        $list = AttachmentModel::where($where)->order('id desc')->paginate(20, false, ['query' => $search]);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);

        return $this->fetch();
    }


    /**
     * 附件管理-删除
     * @param string $ids 附件id
     */
    public function delete()
    {
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
        }
        if (empty($ids)) {
            return apiRule(false, '缺少主键');
        }

        $files_path = AttachmentModel::where('id', 'in', $ids)->column('path,thumb', 'id');

        foreach ($files_path as $value) {
            $real_path = realpath(ROOT_PATH . $value['path']);
            $real_path_thumb = realpath(ROOT_PATH . $value['thumb']);

            if (is_file($real_path) && !unlink($real_path)) {
                return apiRule(false, '删除失败');
            }
            if (is_file($real_path_thumb) && !unlink($real_path_thumb)) {
                return apiRule(false, '删除缩略图失败');
            }
        }
        Admin::recordLog("删除");
        if (AttachmentModel::where('id', 'in', $ids)->delete()) {
            return apiRule(true, '删除成功');
        } else {
            return apiRule(false, '删除失败');
        }
    }


    /**
     * 上传附件
     * @param string $dir 保存的目录:images,files,videos,auidos
     * @param string $from 来源，wangeditor：wangEditor编辑器, ueditor:ueditor编辑器, editormd:editormd编辑器等
     * @param string $module 来自哪个模块
     * @return mixed
     */
    public function upload($dir = '', $from = '', $module = '')
    {
        // ============ 测试临时参数
        $dir = $dir ? $dir : input('post.dir');
        $from = $from ? $from : input('post.from');
        $module = $module ? $module : input('post.module');

        // 临时取消执行时间限制
        set_time_limit(0);
        if ($dir == '') {
            return apiRule(false, '没有指定上传目录', '', 509);
        }

        return $this->saveFile($dir, $from, $module);
    }

    /**
     * 保存附件
     * @param string $dir 附件存放的目录
     * @param string $from 来源
     * @param string $module 来自哪个模块
     * @return string|\think\response\Json
     */
    private function saveFile($dir = '', $from = '', $module = '')
    {
        // 附件类型：图片、文件、视频、音频、flash
        switch ($dir) {
            case 'images':
                $size_limit = config('app.upload_image_size') * 1024;
                $ext_limit = config('app.upload_image_ext');
                $filetype = 1;
                break;
            case 'files':
                $size_limit = config('app.upload_file_size') * 1024;
                $ext_limit = config('app.upload_file_ext');
                $filetype = 2;
                break;
            case 'auidos':
                $size_limit = config('app.upload_audio_size') * 1024;
                $ext_limit = config('app.upload_audio_ext');
                $filetype = 3;
                break;
            case 'videos':
                $size_limit = config('app.upload_video_size') * 1024;
                $ext_limit = config('app.upload_video_ext');
                $filetype = 4;
                break;
            case 'flashs':
                $size_limit = config('app.upload_file_size') * 1024;
                $ext_limit = config('app.upload_file_ext');
                $filetype = 5;
                break;
            default:
                return apiRule(false, '上传错误', '', 500);
                break;
        }

        // 图片缩略图是否开启
        $thumb = (bool) config('app.thumb_size');
        // 图片水印参数是否开启
        $watermark = (bool) config('app.image_watermark');

        // 获取附件数据
        switch ($from) {
            case 'editormd':
                $file_input_name = 'editormd-image-file';
                break;
            default:
                $file_input_name = 'file';
        }

        $file = $this->request->file($file_input_name);

        // 判断附件是否已存在
        if ($file_exists = AttachmentModel::get(['md5' => $file->hash('md5')])) {
            $file_path = $file_exists['path'];

            $return = [
                'id'    =>  $file_exists['id'],
                'path'  =>  $file_exists['path']
            ];
            return apiRule(true, '上传成功!', $return);
        }
        // 检测是否合法的上传文件
        if (!$file->isValid()) {
            return apiRule(false, '上传的文件不合法');
        }
        // 检测上传的文件规则。size：大小；ext：后缀
        if (!$file->check(['size' => $size_limit, 'ext' => $ext_limit])) {
            return apiRule(false, '附件类型不正确或附件过大');
        }

        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'uploads' . DIRECTORY_SEPARATOR . $dir);
        if ($info) {
            // 缩略图路径
            $thumb_path_name = '';
            // 图片宽度
            $img_width = '';
            // 图片高度
            $img_height = '';

            // 图片处理
            if ($dir == 'images') {
                $img = Image::open($info);
                $img_width = $img->width();
                $img_height = $img->height();

                // 添加水印
                if ($watermark) {
                    $this->createWater($info->getRealPath());
                }
                // 生成缩略图
                if ($thumb) {
                    $thumb_path_name = $this->createThumb($info->getRealPath(), $info->getPathInfo()->getfileName(), $info->getFilename());
                }
            }

            // 获取附件信息
            $file_info = [
                'uid'       =>  session('admin_user_auth.uid'),
                'name'      =>  $file->getInfo('name'),
                'mime'      =>  $file->getInfo('type'),
                'path'      =>  '/uploads/' . $dir . '/' . str_replace('\\', '/', $info->getSaveName()),
                'ext'       =>  $info->getExtension(),
                'size'      =>  $info->getSize(),
                'md5'       =>  $info->hash('md5'),
                'sha1'      =>  $info->hash('sha1'),
                'thumb'     =>  $thumb_path_name,
                'module'    =>  $module,
                'filetype'  =>  $filetype,
                'width'     =>  $img_width,
                'height'    =>  $img_height,
            ];

            // 写入数据库
            if ($file_add = AttachmentModel::create($file_info)) {
                $return = [
                    'id'    =>  $file_add['id'],
                    'path'  =>  $thumb_path_name ? $thumb_path_name : $file_info['path'],
                ];

                switch ($from) {
                    case 'editormd':
                        $return['path'] = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME') . $return['path'];
                        break;
                }

                return apiRule(true, '上传成功', $return);
            } else {
                return apiRule(false, '上传失败');
            }
        } else {
            return apiRule(false, $file->getError(), '', 400);
        }
    }


    /**
     * 添加水印
     * @param string $file 要添加水印的文件路径
     */
    private function createWater($file = '')
    {
        // 水印图片
        $watermark_img = config('app.image_watermark_pic');
        $watermark_img = ROOT_PATH . AttachmentModel::where('id', $watermark_img)->value('path');
        // 水印位置
        $watermark_pos = config('app.image_watermark_location');
        // 水印透明度
        $watermark_alpha = config('app.image_watermark_opacity');

        // 判断是否有这个文件，在进行添加
        if (is_file($watermark_img)) {
            // 读取图片
            $image = Image::open($file);
            // 添加水印
            $image->water($watermark_img, $watermark_pos, $watermark_alpha);
            // 保存水印图片，覆盖原图
            $image->save($file);
        }
    }

    /**
     * 创建缩略图
     * @param string $file 目标文件，可以是文件对象或文件路径
     * @param string $dir 保存目录，即目标文件所在的目录名
     * @param string $save_name 缩略图名
     * @return string 缩略图路径
     */
    private function createThumb($file = '', $dir = '', $save_name = '')
    {
        // 缩略图尺寸
        $thumb_size = config('app.thumb_size');
        list($thumb_max_width, $thumb_max_height) = explode(',', $thumb_size);
        // 缩略图裁剪方式
        $thumb_type = config('app.thumb_type');
        // 读取图片
        $image = Image::open($file);
        // 生成缩略图
        $image->thumb($thumb_max_width, $thumb_max_height, $thumb_type);
        // 保存缩略图
        $thumb_path = ROOT_PATH . 'uploads' . DIRECTORY_SEPARATOR . 'images/' . $dir . '/thumb/';
        if (!is_dir($thumb_path)) {
            mkdir($thumb_path, 0766, true);
        }
        $thumb_path_name = $thumb_path . $save_name;
        $image->save($thumb_path_name);
        $thumb_path_name = '/uploads/images/' . $dir . '/thumb/' . $save_name;
        return $thumb_path_name;
    }
}
