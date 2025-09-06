<?php

/**
 * 编写：祝踏岚
 * 对每日报表的相关操作
 */

namespace app\common\model;

use think\Model;

class UserDailyModel extends Model
{
    //表名
    protected $table = 'ly_user_daily';

    /**
     * 每日统筹
     */
    public function updateReportForm($array = array())
    {
        foreach ($array as $key => $value) {
            $$key = $value;
        }

        if (!isset($uid) || !$uid) return false;
        // 判断交易类型
        if (!isset($type) || !$type) return false;
        // 是否后台操作1=是；2=否(程序自动运行)
        $isadmin = (isset($isadmin)) ? $isadmin : 2;
        // 获取用户信息
        switch ($type) {
            case 1://用户充值
                $field = 'recharge';
                break;
            case 2://用户提现
                $field = 'withdrawal';
                break;
            case 3://发布任务
                $field = 'task';
                break;
            case 4://平台抽水
                $field = 'pump';
                break;
            case 5://下级返点
                $field = 'rebate';
                break;
            case 6://任务提成
                $field = 'commission';
                break;
            case 7://注册奖励
                $field = 'regment';
                break;
            case 8://推广奖励
                $field = 'spread';
                break;
            case 9://购买会员
                $field = 'buymembers';
                break;
            case 10:
                $field = 'revoke';
                break;
            case 11:
                $field = 'transfer_c';
                break;
            case 12:
                $field = 'transfer_r';
                break;

            default:
                $field = 'other';

        }

        if (!isset($field)) return false;
        //if ($isdaily == 2) return true; //是否进每日
        $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $countReport = $this->where(array(['uid', '=', $uid], ['date', '=', $today]))->count();
        //判断当日是否已有数据
        if (!$countReport) {
            $res = $this->insertGetId(array(
                'uid' => $uid,
                'username' => $username,
                'user_type' => $user_type,
                'date' => $today,
                $field => $price
            ));
        } else {
            $res = $this->where(array(['uid', '=', $uid], ['date', '=', $today]))->setInc($field, $price);
        }

        /*// 更新投资总额与用户等级、收益比例
        if ($type == 3) {
            // 获取用户信息
            $userInfo = model('Users')->field('ly_users.rebate,ly_users.vip_level,user_total.balance_investment')->join('user_total','ly_users.id=user_total.uid')->where('ly_users.id', $uid)->find();
            // 初始化更新数组
            $userUpdateArray['rebate']    = $userInfo['rebate'];
            $userUpdateArray['vip_level'] = $userInfo['vip_level'];
            // 获取用户等级列表
            $userLevel = model('UserVip')->select()->toArray();
            foreach (array_reverse($userLevel) as $key => $value) {
                if ($userInfo['balance_investment'] >= $value['min'] && $userInfo['balance_investment'] <= $value['max']) {
                    $userUpdateArray['rebate']    = $value['profit'];
                    $userUpdateArray['vip_level'] = $value['grade'];
                }
            }
            // 等级是否变更
            if ($userInfo['rebate'] != $userUpdateArray['rebate'] || $userInfo['vip_level'] != $userUpdateArray['vip_level']) {
                model('Users')->where('id', $uid)->update($userUpdateArray);
            }
            // 递增账户投资总额
            model('UserTotal')->where('uid', $uid)->setInc('balance_investment', $price);
        }*/

        if (!$res) return false;
        return true;
    }

    //更新字段
    public function updateReportfield($param = array())
    {

        $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        $countReport = $this->where(array(['uid', '=', $param['uid']], ['date', '=', $today]))->count();

        //判断当日是否已有数据
        if (!$countReport) {
            $this->insertGetId(array(
                'uid' => $param['uid'],
                'username' => $param['username'],
                'user_type' => 1,
                'date' => $today,
                $param['field'] => $param['value'],
            ));
        } else {
            $this->where(array(['uid', '=', $param['uid']], ['date', '=', $today]))->setInc($param['field'], $param['value']);
        }
    }

    /**
     * 团队报表
     */
    public function teamStatistic($userList, $startDate, $endDate, $sid, $filter = false)
    {
        $array = array();
        // where
        // $where[] = ['user_type','<>',3];
        $where[] = ['date', '>=', $startDate];
        $where[] = ['date', '<=', $endDate];

        foreach ($userList as $key => &$value) {
            //数据获取
            if ($value['id'] == $sid) {
                $array[$value['id']] = $this->field([
                    'SUM(`recharge`)' => 'recharge',
                    'SUM(`withdrawal`)' => 'withdrawal',
                    'SUM(`task`)' => 'task',
                    'SUM(`rebate`)' => 'rebate',
                    'SUM(`regment`)' => 'regment',
                    'SUM(`other`)' => 'other',
                    'SUM(`buymembers`)' => 'buymembers',
                    'SUM(`spread`)' => 'spread',
                    'SUM(`pump`)' => 'pump',
                    'SUM(`revoke`)' => 'revoke',
                    'SUM(`commission`)' => 'commission',
                ])->where('uid', $value['id'])->where($where)->findOrEmpty();
            } else {
                $array[$value['id']] = $this->field([
                    'SUM(`recharge`)' => 'recharge',
                    'SUM(`withdrawal`)' => 'withdrawal',
                    'SUM(`task`)' => 'task',
                    'SUM(`rebate`)' => 'rebate',
                    'SUM(`regment`)' => 'regment',
                    'SUM(`other`)' => 'other',
                    'SUM(`buymembers`)' => 'buymembers',
                    'SUM(`spread`)' => 'spread',
                    'SUM(`pump`)' => 'pump',
                    'SUM(`revoke`)' => 'revoke',
                    'SUM(`commission`)' => 'commission',
                ])->join('user_team', 'ly_user_daily.uid = user_team.team')->where('user_team.uid', $value['id'])->where($where)->findOrEmpty();
            }
            if (is_object($array[$value['id']])) $array[$value['id']] = $array[$value['id']]->toArray();
            // 发布任务数量
            $array[$value['id']]['relTaskNumber'] = model('UserTeam')->alias('ut')->join('task', 'ut.team=task.uid')->where('ut.uid', '=', $value['id'])->whereIn('status', [3, 4])->whereTime('add_time', 'between', [$startDate, $endDate])->count();
            // 接手任务数量
            $array[$value['id']]['takeTaskNumber'] = model('UserTeam')->alias('ut')->join('user_task', 'ut.team=user_task.uid')->where('ut.uid', '=', $value['id'])->whereTime('add_time', 'between', [$startDate, $endDate])->count();

            if ($filter && array_filter($array[$value['id']])) {
                unset($array[$value['id']]);
                continue;
            }

            $array[$value['id']]['id'] = $value['id'];
            $array[$value['id']]['sid'] = $value['sid'];
            $array[$value['id']]['username'] = $value['username'];
            $array[$value['id']]['lock'] = $value['state'];
            // 团队总人数
            $array[$value['id']]['teamCount'] = model('UserTeam')->where('uid', $value['id'])->count();
            if ($array[$value['id']]['recharge'] > 0) {
                $array[$value['id']]['recharge_num'] = 1;
            } else {
                $array[$value['id']]['recharge_num'] = 0;
            }
        }
        // 总计
        $sumField = ['recharge', 'withdrawal', 'task', 'rebate', 'regment', 'other', 'buymembers', 'spread', 'pump', 'revoke', 'commission', 'recharge_num'];
        foreach ($sumField as $key => &$value) {
            $array['totalAll'][$value] = 0;
            foreach ($array as $k => $v) {
                $array['totalAll'][$value] += $v[$value];
            }
        }

        return $array;
    }


}
