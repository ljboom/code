<?php

namespace app\manage\controller;

use think\Db;

class SyncController extends CommonController
{
    private $_sync_url = 'https://marin99.com/api/sync/task';

    public function index()
    {
        return $this->fetch();
    }

    public function task()
    {
        set_time_limit(0);
        ini_set('memory_limit', '800M');
        //获取最后ID
        $lastId = Db::name('task')->field('id')->order('id desc')->value('id');
        if (empty($lastId)) $lastId = 0;
        //获取所有会员等级
        $grade_list = Db::name('user_grade')->column('*', 'grade');
        $result = $this->curl_post($this->_sync_url, [
            'id' => $lastId,
            'password' => $this->request->post('password/s', '')
        ]);
        $data = json_decode($result, true);
        if (!isset($data['code'])) {
            return json([
                'code' => 0,
                'msg' => '同步失败，请检查数据源',
                'data' => $data,
                'result' => $result,
            ]);
        }
        if ($data['code'] != 1) {
            return json([
                'code' => 0,
                'msg' => '同步失败，' . (isset($data['msg']) ? $data['msg'] : '系统错误'),
            ]);
        }
        if (empty($data['list'])) {
            return json([
                'code' => 0,
                'msg' => '所有数据同步完成',
            ]);
        }
        //print_r($data);
        $lang = config('app_lang');
        $insert = [];
        foreach ($data['list'] as $val) {
            //更改佣金
            $val['reward_price'] = isset($grade_list[$val['task_level']]['commission']) ? $grade_list[$val['task_level']]['commission'] : $val['reward_price'];
            $val['examine_demo'] = '["\/upload\/image\/202202231018215733702506.jpg"]';
            $val['task_step'] = '[{"img":"\/upload\/image\/202202231018075996026339.jpg","describe":""}]';
            $val['lang'] = $lang;
            $insert[] = $val;
        }
        $result = Db::name('task')->insertAll($insert);
        if ($result) {
            return json([
                'code' => 1,
                'msg' => '同步成功',
                'count' => count($insert)
            ]);
        } else {
            return json([
                'code' => 0,
                'msg' => '同步失败，数据保存失败',
            ]);
        }
    }

    private function curl_post($url, array $data, $type = 'form-data', $header = [], $closeSSl = true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (substr_count($url, 'https://') > 0 && $closeSSl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($type == 'json') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, ['Content-Type: application/json; charset=utf-8']));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            if ($header) curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}