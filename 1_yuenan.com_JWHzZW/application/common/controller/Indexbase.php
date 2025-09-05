<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: fastadmin: https://www.fastadmin.net/
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 前台控制模块
// +----------------------------------------------------------------------
namespace app\common\controller;

use app\admin\service\User;
use think\facade\Hook;
use think\facade\Session;
use think\Loader;
use think\Validate;

//定义是后台
define('IN_INDEX', true);

class Indexbase extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = [];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = [];
    //当前登录账号信息
    //public $_userinfo;
    //Multi方法可批量修改的字段
    protected $multiFields = 'status,listorder';
    /**
     * 权限控制类
     * @var Auth
     */
    protected $auth = null;
    //模型对象
    protected $modelClass = null;
    //快速搜索时执行查找的字段
    protected $searchFields = 'id';
    //Selectpage可显示的字段
    protected $selectpageFields = '*';
    //是否是关联查询
    protected $relationSearch = false;
    //前台提交过来,需要排除的字段数据
    protected $excludeFields = "";
    /**
     * 是否开启数据限制
     * 支持auth/personal
     * 表示按权限判断/仅限个人
     * 默认为禁用,若启用请务必保证表中存在admin_id字段
     */
    protected $dataLimit = false;
    //数据限制字段
    protected $dataLimitField = 'admin_id';
    //数据限制开启时自动填充限制字段值
    protected $dataLimitFieldAutoFill = true;
    //是否开启Validate验证
    protected $modelValidate = false;
    //是否开启模型场景验证
    protected $modelSceneValidate = false;

    /*
     * 引入后台控制器的traits
     */
    use \app\admin\library\traits\Curd;

    //初始化
    protected function initialize()
    {
        $res = Session::get(bianliang(1));
        if(empty($res)){
            // echo  json_encode(code_msg(10000));   die;
            // json(code_msg(10000))->send();
            // header()
            // header("Location: http://xm.undress.cn/#/login");
        }
    }
    
    /**
     * 构建请求参数
     * @param mixed   $searchfields   快速查询的字段
     * @param array $excludeFields 忽略构建搜索的字段
     * @param boolean $relationSearch 是否关联查询
     * @return array
     */
    protected function buildTableParames($searchfields = null, $excludeFields = [], $relationSearch = null)
    {
        $searchfields   = is_null($searchfields) ? $this->searchFields : $searchfields;
        $relationSearch = is_null($relationSearch) ? $this->relationSearch : $relationSearch;
        $search         = $this->request->get("search", '');
        $filter         = $this->request->get("filter", '');
        $op             = $this->request->get("op", '', 'trim');
        $sort           = $this->request->get("sort", !empty($this->modelClass) && $this->modelClass->getPk() ? $this->modelClass->getPk() : 'id');
        $order          = $this->request->get("order", "DESC");
        $offset         = $this->request->get("offset/d", 0);
        $limit          = $this->request->get("limit/d", 999999);
        //新增自动计算页码
        $page = $limit ? intval($offset / $limit) + 1 : 1;
        if ($this->request->has("page")) {
            $page = $this->request->get("page/d", 1);
        }
        $this->request->withGet([config('paginate.var_page') => $page]);
        $filter    = (array) json_decode($filter, true);
        $op        = (array) json_decode($op, true);
        $filter    = $filter ? $filter : [];
        $where     = [];
        $alias     = [];
        $bind      = [];
        $name      = '';
        $aliasName = '';
        if (!empty($this->modelClass) && $this->relationSearch) {
            $name         = $this->modelClass->getTable();
            $alias[$name] = Loader::parseName(basename(str_replace('\\', '/', get_class($this->modelClass))));
            $aliasName    = $alias[$name] . '.';
        }
        $sortArr = explode(',', $sort);
        foreach ($sortArr as $index => &$item) {
            $item = stripos($item, ".") === false ? $aliasName . trim($item) : $item;
        }
        unset($item);
        $sort = implode(',', $sortArr);
        if ($search) {
            $searcharr = is_array($searchfields) ? $searchfields : explode(',', $searchfields);
            foreach ($searcharr as $k => &$v) {
                $v = stripos($v, ".") === false ? $aliasName . $v : $v;
            }
            unset($v);
            $where[] = [implode("|", $searcharr), "LIKE", "%{$search}%"];
        }
        $index = 0;
        foreach ($filter as $k => $v) {
            if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $k)) {
                continue;
            }
            $sym = isset($op[$k]) ? $op[$k] : '=';
            if (stripos($k, ".") === false) {
                $k = $aliasName . $k;
            }
            $v   = !is_array($v) ? trim($v) : $v;
            $sym = strtoupper(isset($op[$k]) ? $op[$k] : $sym);
            //null和空字符串特殊处理
            if (!is_array($v)) {
                if (in_array(strtoupper($v), ['NULL', 'NOT NULL'])) {
                    $sym = strtoupper($v);
                }
                if (in_array($v, ['""', "''"])) {
                    $v   = '';
                    $sym = '=';
                }
            }

            switch ($sym) {
                case '=':
                case '<>':
                    $where[] = [$k, $sym, (string) $v];
                    break;
                case 'LIKE':
                case 'NOT LIKE':
                case 'LIKE %...%':
                case 'NOT LIKE %...%':
                    $where[] = [$k, trim(str_replace('%...%', '', $sym)), "%{$v}%"];
                    break;
                case '>':
                case '>=':
                case '<':
                case '<=':
                    $where[] = [$k, $sym, intval($v)];
                    break;
                case 'FINDIN':
                case 'FINDINSET':
                case 'FIND_IN_SET':
                    $v       = is_array($v) ? $v : explode(',', str_replace(' ', ',', $v));
                    $findArr = array_values($v);
                    foreach ($findArr as $idx => $item) {
                        $bindName        = "item_" . $index . "_" . $idx;
                        $bind[$bindName] = $item;
                        $where[]         = "FIND_IN_SET(:{$bindName}, `" . str_replace('.', '`.`', $k) . "`)";
                    }
                    break;
                case 'IN':
                case 'IN(...)':
                case 'NOT IN':
                case 'NOT IN(...)':
                    $where[] = [$k, str_replace('(...)', '', $sym), is_array($v) ? $v : explode(',', $v)];
                    break;
                case 'BETWEEN':
                case 'NOT BETWEEN':
                    $arr = array_slice(explode(',', $v), 0, 2);
                    if (stripos($v, ',') === false || !array_filter($arr)) {
                        continue 2;
                    }
                    //当出现一边为空时改变操作符
                    if ($arr[0] === '') {
                        $sym = $sym == 'BETWEEN' ? '<=' : '>';
                        $arr = $arr[1];
                    } elseif ($arr[1] === '') {
                        $sym = $sym == 'BETWEEN' ? '>=' : '<';
                        $arr = $arr[0];
                    }
                    $where[] = [$k, $sym, $arr];
                    break;
                case 'RANGE':
                case 'NOT RANGE':
                    $v   = str_replace(' - ', ',', $v);
                    $arr = array_slice(explode(',', $v), 0, 2);
                    if (stripos($v, ',') === false || !array_filter($arr)) {
                        continue 2;
                    }
                    //当出现一边为空时改变操作符
                    if ($arr[0] === '') {
                        $sym = $sym == 'RANGE' ? '<=' : '>';
                        $arr = $arr[1];
                    } elseif ($arr[1] === '') {
                        $sym = $sym == 'RANGE' ? '>=' : '<';
                        $arr = $arr[0];
                    }
                    $tableArr = explode('.', $k);
                    if (count($tableArr) > 1 && $tableArr[0] != $name && !in_array($tableArr[0], $alias) && !empty($this->modelClass)) {
                        //修复关联模型下时间无法搜索的BUG
                        $relation                                          = Loader::parseName($tableArr[0], 1, false);
                        $alias[$this->modelClass->$relation()->getTable()] = $tableArr[0];
                    }
                    $where[] = [$k, str_replace('RANGE', 'BETWEEN', $sym) . ' TIME', $arr];
                    break;
                case 'NULL':
                case 'IS NULL':
                case 'NOT NULL':
                case 'IS NOT NULL':
                    $where[] = [$k, strtolower(str_replace('IS ', '', $sym))];
                    break;
                default:
                    break;
            }
            $index++;
        }
        if (!empty($this->modelClass)) {
            $this->modelClass->alias($alias);
        }
        $model = $this->modelClass;
        $where = function ($query) use ($where, $alias, $bind, &$model) {
            if (!empty($model)) {
                $model->alias($alias);
                $model->bind($bind);
            }
            foreach ($where as $k => $v) {
                if (is_array($v)) {
                    call_user_func_array([$query, 'where'], $v);
                } else {
                    $query->where($v);
                }
            }
        };
        return [$page, $limit, $where, $sort, $order, $offset, $alias, $bind];
    }
}
