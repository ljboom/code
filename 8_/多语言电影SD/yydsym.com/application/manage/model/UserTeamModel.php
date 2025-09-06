<?php

namespace app\manage\model;

use think\Model;

class UserTeamModel extends Model
{
    //表名
    protected $table = 'ly_user_team';

    //获取真实的下级ID
    public function getRealAllSonIds($uid, &$dataIds)
    {
        $ids = model('Users')->where('sid', $uid)->column('id');
        foreach ($ids as $v) {
            $dataIds[] = $v;
            $this->getRealAllSonIds($v, $dataIds);
        }
    }
}