<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\Request;
use think\Db;
use think\facade\Env;

use util\Dir;
use util\Database as dbOper;

/**
 * 数据库管理控制器
 * @package app\admin\controller
 */
class Database extends Admin
{
    /**
     * 初始化方法
     */
    public function initialize()
    {
        parent::initialize();
        // 定义sql备份路径
        $this->backupPath = Env::get('root_path') . 'backup/database/';
        // 定义备份文件的大小 默认20MB;
        $this->part = 20971520;
        // 备份压缩。压缩备份文件需要PHP环境支持gzopen,gzwrite函数
        $this->compress = 0;
        // 数据库备份文件的压缩级别，该配置在开启压缩时生效.1:最低4:一般9:最高
        $this->compress_level = 4;
    }
    /**
     * 显示资源列表
     */
    public function index()
    {
        // 备份数据库
        $tables = Db::query("SHOW TABLE STATUS");
        // 还原数据库
        //列出备份文件列表
        if (!is_dir($this->backupPath)) {
            Dir::create($this->backupPath);
        }
        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($this->backupPath,  $flag);

        $dataList = [];

        foreach ($glob as $name => $file) {

            if (preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)) {
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];

                if (isset($dataList["{$date} {$time}"])) {

                    $info           = $dataList["{$date} {$time}"];
                    $info['part']   = max($info['part'], $part);
                    $info['size']   = $info['size'] + $file->getSize();
                } else {

                    $info['part']   = $part;
                    $info['size']   = $file->getSize();
                }

                $info['time']       = "{$date} {$time}";
                $time               = strtotime("{$date} {$time}");
                $extension          = strtoupper($file->getExtension());
                $info['compress']   = ($extension === 'SQL') ? '无' : $extension;
                $info['name']       = date('Ymd-His', $time);
                $info['id']         = $time;
                $info['size']       = intval( $info['size']/pow(2,10) );

                $dataList["{$date} {$time}"] = $info;
            }
        }
        $this->assign('data_list', $dataList);
        $this->assign('tables',$tables);
        return $this->fetch();
    }

    /**
     * 修复表
     */
    public function repairTable()
    {
        if ($this->request->isGet()) {
            $table = $this->request->param('id');
        }
        if ($this->request->isPost()) {
            $table = $this->request->post('ids');
            $table = implode('`,`', $table);
        }
        if (empty($table)) {
            return apiRule(false, '请选择表');
        }

        Admin::recordLog("修复表");
        $res = Db::query("REPAIR TABLE `{$table}`");
        if ($res) {
            return apiRule(true, '数据表修复完成');
        }
        return apiRule(false, '数据表修复失败');
    }

    /**
     * 优化表
     */
    public function optimizeTable()
    {
        if ($this->request->isGet()) {
            $table = $this->request->param('id');
        }
        if ($this->request->isPost()) {
            $table = $this->request->post('ids');
            $table = implode('`,`', $table);
        }
        if (empty($table)) {
            return apiRule(false, '请选择表');
        }

        Admin::recordLog("优化表");
        $res = Db::query("OPTIMIZE TABLE `{$table}`");
        if ($res) {
            return apiRule(true, '数据表优化完成');
        }
        return apiRule(false, '数据表优化失败');
    }


    /**
     * 备份数据库
     */
    public function export($id = '', $start = 0)
    {
        if ($this->request->isPost()) {
            $tables = $this->request->post('ids');
        }
        if (empty($tables)) {
            return apiRule(false, '请选择您要备份的数据表');
        }
        //读取备份配置
        $config = array(
            'path'     => $this->backupPath,
            'part'     => $this->part,
            'compress' => $this->compress,
            'level'    => $this->compress_level,
        );
        //检查是否有正在执行的任务
        $lock = "{$config['path']}backup.lock";
        if (is_file($lock)) {
            return apiRule(false, '检测到有一个备份任务正在执行，请稍后再试');
        } else {
            // 创建文件夹
            if (!is_dir($config['path'])) {
                Dir::create($config['path'], 0755, true);
            }
            //创建锁文件
            file_put_contents($lock, $this->request->time());
        }
        //生成备份文件信息
        $file = [
            'name' => date('Ymd-His', $this->request->time()),
            'part' => 1,
        ];

        // 创建备份文件
        $database = new dbOper($file, $config);

        if ($database->create() !== false) {

            // 备份指定表
            foreach ($tables as $table) {
                $start = $database->backup($table, $start);
                while (0 !== $start) {
                    if (false === $start) {
                        return apiRule(false, '备份出错');
                    }
                    $start = $database->backup($table, $start[0]);
                }
            }

            // 备份完成，删除锁定文件
            unlink($lock);
        }
        return apiRule(true, '备份完成');
    }

    /**
     * 恢复数据库
     */
    public function import($id = '')
    {
        if ($this->request->isGet()) {
            $id = $this->request->param('id');
        }
        if (empty($id)) {
            return apiRule(false, '请选择您要恢复的备份文件');
        }
        $name  = date('Ymd-His', $id) . '-*.sql*';
        $path  = $this->backupPath . $name;
        $files = glob($path);
        $list  = array();

        foreach ($files as $name) {
            $basename = basename($name);
            $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
            $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
            $list[$match[6]] = array($match[6], $name, $gz);
        }

        ksort($list);

        // 检测文件正确性
        $last = end($list);

        if (count($list) === $last[0]) {

            foreach ($list as $item) {

                $config = [
                    'path'     => $this->backupPath,
                    'compress' => $item[2]
                ];

                $database = new dbOper($item, $config);
                $start = $database->import(0);

                // 导入所有数据
                while (0 !== $start) {

                    if (false === $start) {
                        return apiRule(false, '数据恢复出错');
                    }

                    $start = $database->import($start[0]);
                }
            }

            return apiRule(true, '数据恢复完成');

        }
        return apiRule(false, '备份文件可能已经损坏，请检查');
    }

    /**
     * 删除指定资源
     */
    public function delete()
    {
        if ($this->request->isGet()) {
            $id = $this->request->param('id');
        }
        if (empty($id)) {
            return apiRule(false, '请选择您要删除的备份文件');
        }

        $name  = date('Ymd-His', $id) . '-*.sql*';
        $path = $this->backupPath . $name;
        array_map("unlink", glob($path));

        if (count(glob($path)) && glob($path)) {
            return apiRule(false, '备份文件删除失败，请检查权限');
        }
        return apiRule(true, '备份文件删除成功');
    }

}
