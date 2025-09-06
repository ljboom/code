<?php

namespace app\api\model;

use think\Model;
use app\api\validate\UserTotal as UserTotalValidate;
use Pay\Lryokpay;

class UserRechargeModel extends Model
{
    protected $table = 'ly_user_recharge';

    /**
     * [inpourpay 用户使用该接口提交充值记录订单]
     * @return [type] [description]
     */
    public function newRechargeOrder()
    {
        //获取参数
        $token = input('post.token/s');
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $userArr = explode(',', auth_code($token, 'DECODE'));//uid,username
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username
        if (cache('submitRechargeTime' . $uid) && time() - cache('submitRechargeTime' . $uid) < 5)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '提交过于频繁'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Commit too often'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Commit terlalu sering'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '提交過於頻繁'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'बहुत बार कमिट करें'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Ghi nhận quá thường xuyên'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Presentación excesiva'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '提出が頻繁すぎる'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ส่งบ่อยเกินไป'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Hantar terlalu sering'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Enviar com demasiada frequência'];
            }

        cache('submitRechargeTime' . $uid, time());

        $param = input('param.');

        //数据验证
        $validate = validate('app\api\validate\Recharge');
        if (!$validate->scene('userRechargeSub')->check($param)) return ['code' => 0, 'code_dec' => $validate->getError()];

        // 获取渠道信息
        $rechargeTypeInfo = model('RechangeType')->where('id', $param['recharge_id'])->find();
        if ($param['money'] < $rechargeTypeInfo['minPrice'] || $param['money'] > $rechargeTypeInfo['maxPrice'])
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '金额过高或过低'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'The amount is too high or too low'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Jumlah terlalu tinggi atau terlalu rendah'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '金額過高或過低'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'मात्रा बहुत उच्च है या बहुत कम है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Số lượng này quá cao hoặc quá thấp'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Importe elevado o bajo'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '金額が高すぎたり、低すぎたりします。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'มากเกินไปหรือต่ำเกินไป'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Terlalu tinggi atau terlalu rendah'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Muito Alto ou Muito baixo'];
            }

        if(empty($param['tixdorhash'])){
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无数据'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No data available'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada data tersedia'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無數據'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई डाटा उपलब्ध नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có dữ liệu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Datos no disponibles'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'データがありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีข้อมูล'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada data tersedia'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não existem dados disponíveis'];
            }
        }
        //检测tixd是否重复
        $rsTIXD = model('UserRecharge')->where(['hash' => $param['tixdorhash']])->count('id');
        if($rsTIXD > 0){
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => 'TIXD 提交重复'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'TIXD Submit failed'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'TIXD Pengiriman gagal'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => 'TIXD 提交失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'TIXD प्रेषण असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'TIXD Lỗi gởi'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'TIXD Presentación fallida'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'TIXD 送信に失敗しました'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'TIXD ความล้มเหลวในการส่ง'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'TIXD Gagal menghantar'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'TIXD Não FOI apresentado'];
            }
        }
        
        $orderNumber = trading_number();
        $screenshots = (input('post.screenshots')) ? input('post.screenshots') : '';
        $is_update_level  = isset($param['is_update_level']) ? $param['is_update_level'] : 2;
        $to_user_level = isset($param['to_user_level']) ? $param['to_user_level'] : 0;
        $insertArray = [
            'uid' => $uid,
            'order_number' => $orderNumber,
            'type' => $param['recharge_id'],
            'money' => $param['money'],
            'usdt_money' => floatval($param['usdt_money']),
            'postscript' => $param['name'],
            'add_time' => time(),
            'is_update_level' => $is_update_level,//重置资金用户。1 升级vip，2 仅充值
            'hash' => isset($param['tixdorhash'])?$param['tixdorhash']:'',
            'to_user_level' => isset($param['to_user_level']) ? $param['to_user_level'] : 0
        ];


        

        if ($screenshots) {
            $insertArray['screenshots'] = json_encode($screenshots);
        }

        $res = $this->allowField(true)->save($insertArray);
        if (!$res)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '提交失败'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Submit failed'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Pengiriman gagal'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '提交失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'प्रेषण असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Lỗi gởi'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Presentación fallida'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '送信に失敗しました'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ความล้มเหลวในการส่ง'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Gagal menghantar'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não FOI apresentado'];
            }

        // 获取收款账号信息
        $recaivablesInfo = model('Recaivables')->field('ly_recaivables.id,ly_recaivables.account,ly_recaivables.name,ly_recaivables.qrcode,bank.bank_name')
            ->join('bank', 'ly_recaivables.bid=bank.id', 'left')
            ->where('ly_recaivables.type', $param['recharge_id'])->select()->toArray();
        if (!$recaivablesInfo)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无收款账户'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No collection account'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada akun koleksi'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無收款帳戶'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई संग्रह खाता नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có tài khoản'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Cuenta de cobro'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '入金口座がありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีบัญชีลูกหนี้'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada akaun koleksi'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Nenhuma conta de cobrança'];
            }


        foreach ($recaivablesInfo as $key => &$value) {
            $value['typeName'] = ($value['qrcode']) ? $rechargeTypeInfo['name'] : $value['bank_name'];
        }

        $data['code'] = 1;
        $data['code_dec'] = 'success';
        $data['orderNumber'] = $orderNumber;
        $data['money'] = $param['money'];
        $data['date'] = date('Y-m-d');
        $data['receive'] = $recaivablesInfo;
        //$data['payurl'] = $payurl;
        return $data;
    }

    public function getRechargeInfo()
    {
        //获取参数
        $param = input('param.');
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $userArr = explode(',', auth_code($param['token'], 'DECODE'));//uid,username
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username

        if (!isset($param['orderNumber']) || !$param['orderNumber'])
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无数据'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No data available'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada data tersedia'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無數據'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई डाटा उपलब्ध नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có dữ liệu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Datos no disponibles'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'データがありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีข้อมูล'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada data tersedia'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não existem dados disponíveis'];
            }


        $orderInfo = $this->where([['uid', '=', $uid], ['order_number', '=', $param['orderNumber']]])->find();
        if (!$orderInfo->toArray())
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无数据'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No data available'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada data tersedia'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無數據'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई डाटा उपलब्ध नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có dữ liệu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Datos no disponibles'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'データがありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีข้อมูล'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada data tersedia'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não existem dados disponíveis'];
            }

        // 充值渠道名称
        $typeInfo = model('RechangeType')->field('name')->where('id', $orderInfo['type'])->find();
        // 获取收款账号信息
        $recaivablesInfo = model('Recaivables')->field('ly_recaivables.id,ly_recaivables.account,ly_recaivables.name,ly_recaivables.qrcode,bank.bank_name')
            ->join('bank', 'ly_recaivables.bid=bank.id', 'left')
            ->where('ly_recaivables.type', $orderInfo['type'])->select()->toArray();
        if (!$recaivablesInfo) ;//return ['code'=>0,'code_dec'=>'暂无收款账户'];

        foreach ($recaivablesInfo as $key => &$value) {
            $value['typeName'] = ($value['qrcode']) ? $typeInfo['name'] : $value['bank_name'];
            unset($value['bank_name']);
        }

        $data['code'] = 1;
        $data['code_dec'] = 'success';
        $data['orderNumber'] = $orderInfo['order_number'];
        $data['usdt_money'] = $orderInfo['usdt_money'];
        $data['remarks'] = $orderInfo['remarks'];
        $data['money'] = $orderInfo['money'];
        $data['screenshots'] = $orderInfo['screenshots'] ? json_decode($orderInfo['screenshots'], true) : [];
        $data['date'] = date('Y-m-d');
        $data['receive'] = $recaivablesInfo;
        $data['tixdorhash'] = $orderInfo['hash'];
        return $data;
    }
/*
    public function getRechargeInfo()
    {
        //获取参数
        $param = input('param.');
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $userArr = explode(',', auth_code($param['token'], 'DECODE'));//uid,username
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username

        if (!isset($param['orderNumber']) || !$param['orderNumber'])
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无数据'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No data available'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada data tersedia'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無數據'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई डाटा उपलब्ध नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có dữ liệu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Datos no disponibles'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'データがありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีข้อมูล'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada data tersedia'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não existem dados disponíveis'];
            }


        $orderInfo = $this->where([['uid', '=', $uid], ['order_number', '=', $param['orderNumber']]])->find();
        if (!$orderInfo)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '暂无数据'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'No data available'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada data tersedia'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '暫無數據'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई डाटा उपलब्ध नहीं'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có dữ liệu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Datos no disponibles'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'データがありません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่มีข้อมูล'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada data tersedia'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não existem dados disponíveis'];
            }

        // 充值渠道名称
        $typeInfo = model('RechangeType')->field('name')->where('id', $orderInfo['type'])->find();
        // 获取收款账号信息
        $recaivablesInfo = model('Recaivables')->field('ly_recaivables.id,ly_recaivables.account,ly_recaivables.name,ly_recaivables.qrcode,bank.bank_name')
            ->join('bank', 'ly_recaivables.bid=bank.id', 'left')
            ->where('ly_recaivables.type', $orderInfo['type'])->select()->toArray();
        if (!$recaivablesInfo) ;//return ['code'=>0,'code_dec'=>'暂无收款账户'];

        foreach ($recaivablesInfo as $key => &$value) {
            $value['typeName'] = ($value['qrcode']) ? $typeInfo['name'] : $value['bank_name'];
            unset($value['bank_name']);
        }

        $data['code'] = 1;
        $data['code_dec'] = 'success';
        $data['orderNumber'] = $orderInfo['order_number'];
        $data['usdt_money'] = $orderInfo['usdt_money'];
        $data['remarks'] = $orderInfo['remarks'];
        $data['money'] = $orderInfo['money'];
        $data['screenshots'] = $orderInfo['screenshots'] ? json_decode($orderInfo['screenshots'], true) : [];
        $data['date'] = date('Y-m-d');
        $data['receive'] = $recaivablesInfo;
        return $data;
    }
*/
    public function getNewRechargeInfo()
    {
        //获取参数
        $param = input('param.');
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $startTime = strtotime(date("Y-m-d 00:00:00", time()));
        $endTime = $startTime + 24 * 60 * 60 - 1;

        $count = $this->where(['is_update_level' => 1])->count();

        if (!$count) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '没有数据';
            elseif ($lang == 'en') $data['code_dec'] = 'No data!';
            elseif ($lang == 'id') $data['code_dec'] = 'tidak ada data';
            elseif ($lang == 'ft') $data['code_dec'] = '沒有數據';
            elseif ($lang == 'yd') $data['code_dec'] = 'कोई डाटा नहीं';
            elseif ($lang == 'vi') $data['code_dec'] = 'không có dữ liệu';
            elseif ($lang == 'es') $data['code_dec'] = 'Sin datos';
            elseif ($lang == 'ja') $data['code_dec'] = 'データがありません';
            elseif ($lang == 'th') $data['code_dec'] = 'ไม่มีข้อมูล';
            elseif ($lang == 'ma') $data['code_dec'] = 'tiada data';
            elseif ($lang == 'pt') $data['code_dec'] = 'SEM dados';
            return $data;
        }

        //每页记录数
        $pageSize = (isset($param['page_size']) and $param['page_size']) ? $param['page_size'] : 10;
        //当前页
        $pageNo = (isset($param['page_no']) and $param['page_no']) ? $param['page_no'] : 1;
        //总页数
        $pageTotal = ceil($count / $pageSize); //当前页数大于最后页数，取最后
        //偏移量
        $limitOffset = ($pageNo - 1) * $pageSize;

        //$update_level = $this->where(['is_update_level'=>1,'between'=>[$startTime,$endTime]])->order('add_time desc')->limit($limitOffset,$page_size)->select()->toArray();
        $update_level = $this->where(['is_update_level' => 1])->order('add_time desc')->limit($limitOffset, $pageSize)->select()->toArray();

        $data = [];
        $data['code'] = 1;
        foreach ($update_level as $key => &$value) {
            switch ($value['state']) {
                case 1:
                    if ($lang == 'cn') {
                        $state = '成功';
                    } elseif ($lang == 'en') {
                        $state = 'success';
                    } elseif ($lang == 'id') {
                        $state = 'sukses';
                    } elseif ($lang == 'ft') {
                        $state = '成功';
                    } elseif ($lang == 'yd') {
                        $state = 'सफलता';
                    } elseif ($lang == 'vi') {
                        $state = 'thành công';
                    } elseif ($lang == 'es') {
                        $state = 'éxito';
                    } elseif ($lang == 'ja') {
                        $state = '成功';
                    } elseif ($lang == 'th') {
                        $state = 'ประสบความสำเร็จ';
                    } elseif ($lang == 'ma') {
                        $state = 'sukses';
                    } elseif ($lang == 'pt') {
                        $state = 'SUCESSO';
                    }
                    break;
                case 2:
                    if ($lang == 'cn') {
                        $state = '失败';
                    } elseif ($lang == 'en') {
                        $state = 'fail';
                    } elseif ($lang == 'id') {
                        $state = 'gagal';
                    } elseif ($lang == 'ft') {
                        $state = '失敗';
                    } elseif ($lang == 'yd') {
                        $state = 'असफल';
                    } elseif ($lang == 'vi') {
                        $state = 'hỏng';
                    } elseif ($lang == 'es') {
                        $state = 'Fracaso';
                    } elseif ($lang == 'ja') {
                        $state = '失敗';
                    } elseif ($lang == 'th') {
                        $state = 'เสียเหลี่ยม';
                    } elseif ($lang == 'ma') {
                        $state = 'gagal';
                    } elseif ($lang == 'pt') {
                        $state = 'Falha';
                    }
                    break;
                case 3:
                    if ($lang == 'cn') {
                        $state = '审核中';
                    } elseif ($lang == 'en') {
                        $state = 'Under review';
                    } elseif ($lang == 'id') {
                        $state = 'Dipertimbangkan';
                    } elseif ($lang == 'ft') {
                        $state = '稽核中';
                    } elseif ($lang == 'yd') {
                        $state = 'पुनरावृत्ति';
                    } elseif ($lang == 'vi') {
                        $state = 'Đang xem xét';
                    } elseif ($lang == 'es') {
                        $state = 'Auditoría en curso';
                    } elseif ($lang == 'ja') {
                        $state = '審査中';
                    } elseif ($lang == 'th') {
                        $state = 'ตรวจสอบ';
                    } elseif ($lang == 'ma') {
                        $state = 'Dalam ulasan';
                    } elseif ($lang == 'pt') {
                        $state = 'Em revisão';
                    }
                    break;
            }

            $data['info'][$key]['uid'] = $value['uid'];
            $data['info'][$key]['order_id'] = $value['order_number'];
            $data['info'][$key]['money'] = '+' . $value['money'];
            $data['info'][$key]['type'] = model('RechangeType')->where('id', $value['type'])->value('name');
            $data['info'][$key]['state'] = $state;
            $data['info'][$key]['addtime'] = date("Y-m-d H:i:s", $value['add_time']);
            $data['info'][$key]['remarks'] = $value['remarks'];
        }

        return $data;
    }

    /**
     * 充值记录
     */
    public function getUserRechargeList()
    {

        //获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));//uid,username
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $param = input('post.');

        if (!$uid) {
            $data['code'] = 0;
            return $data;
        }

        //用户名
        if (isset($param['username']) and $param['username']) {
            $userId = model('Users')->where('username', $param['username'])->value('id');
            $where[] = array('uid', '=', $userId);
        } else {
            $where[] = array('uid', '=', $uid);
        }

        //状态
        if (isset($param['state']) and $param['state']) {
            $where[] = array('state', '=', $param['state']);
        }
        /*//开始时间
        if (isset($param['search_time_s']) and $param['search_time_s']) {
            $where[] = array('ly_user_recharge.add_time','>=',strtotime($param['search_time_s']));
        } else {
            $where[] = array('ly_user_recharge.add_time','>=',mktime(0,0,0,date('m'),date('d'),date('Y')));
        }
        //结束时间
        if (isset($param['search_time_e']) and $param['search_time_e']) {
            $where[] = array('ly_user_recharge.add_time','<=',strtotime($param['search_time_e']));
        } else {
            $where[] = array('ly_user_recharge.add_time','<=',mktime(23,59,59,date('m'),date('d'),date('Y')));
        }*/

        //分页
        //总记录数
        $count = $this->where($where)->count();
        if (!$count) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '没有数据';
            elseif ($lang == 'en') $data['code_dec'] = 'No data!';
            elseif ($lang == 'id') $data['code_dec'] = 'tidak ada data';
            elseif ($lang == 'ft') $data['code_dec'] = '沒有數據';
            elseif ($lang == 'yd') $data['code_dec'] = 'कोई डाटा नहीं';
            elseif ($lang == 'vi') $data['code_dec'] = 'không có dữ liệu';
            elseif ($lang == 'es') $data['code_dec'] = 'Sin datos';
            elseif ($lang == 'ja') $data['code_dec'] = 'データがありません';
            elseif ($lang == 'th') $data['code_dec'] = 'ไม่มีข้อมูล';
            elseif ($lang == 'ma') $data['code_dec'] = 'tiada data';
            elseif ($lang == 'pt') $data['code_dec'] = 'SEM dados';
            return $data;
        }

        //每页记录数
        $pageSize = (isset($param['page_size']) and $param['page_size']) ? $param['page_size'] : 10;
        //当前页
        $pageNo = (isset($param['page_no']) and $param['page_no']) ? $param['page_no'] : 1;
        //总页数
        $pageTotal = ceil($count / $pageSize); //当前页数大于最后页数，取最后
        //偏移量
        $limitOffset = ($pageNo - 1) * $pageSize;

        /*		$dataAll = $this->field('ly_user_recharge.*,rechange_type.name,bank.bank_name')
                                ->join('rechange_type','ly_user_recharge.type = rechange_type.id')
                                ->join('bank','ly_user_recharge.bid = bank.id')
                                ->where($where)
                                ->order(['ly_user_recharge.add_time'=>'desc','id'=>'desc'])
                                ->limit($limitOffset, $pageSize)
                                ->select();*/
        $dataAll = $this->field('*')->where($where)->order(['add_time' => 'desc', 'id' => 'desc'])->limit($limitOffset, $pageSize)->select();

        if (!$dataAll) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '没有数据';
            elseif ($lang == 'en') $data['code_dec'] = 'No data!';
            elseif ($lang == 'id') $data['code_dec'] = 'tidak ada data';
            elseif ($lang == 'ft') $data['code_dec'] = '沒有數據';
            elseif ($lang == 'yd') $data['code_dec'] = 'कोई डाटा नहीं';
            elseif ($lang == 'vi') $data['code_dec'] = 'không có dữ liệu';
            elseif ($lang == 'es') $data['code_dec'] = 'Sin datos';
            elseif ($lang == 'ja') $data['code_dec'] = 'データがありません';
            elseif ($lang == 'th') $data['code_dec'] = 'ไม่มีข้อมูล';
            elseif ($lang == 'ma') $data['code_dec'] = 'tiada data';
            elseif ($lang == 'pt') $data['code_dec'] = 'SEM dados';
            return $data;
        }

        //获取成功
        $data['code'] = 1;
        $data['data_total_nums'] = $count;
        $data['data_total_page'] = $pageTotal;
        $data['data_current_page'] = $pageNo;

        //数组重组赋值
        foreach ($dataAll as $key => $value) {
            $bank_name = array();
            $pay_type = array();
            $data['info'][$key]['dan'] = $value['order_number'];
            $data['info'][$key]['adddate'] = date('Y-m-d H:i:s', $value['add_time']);

            $bank_name = model('Bank')->field('bank_name')->where('id', $value['bid'])->find();
            $data['info'][$key]['bank_name'] = isset($bank_name['bank_name']) ? $bank_name['bank_name'] : '';
            //$value['bank_name'];
            $pay_type = model('RechangeType')->field('name')->where('id', $value['type'])->find();
            $data['info'][$key]['pay_type'] = isset($pay_type['name']) ? $pay_type['name'] : '';
            //$value['name'];
            $data['info'][$key]['money'] = $value['money'];
            $data['info'][$key]['status'] = $value['state'];
            $data['info'][$key]['remarks'] = $value['remarks'];

            if ($lang == 'cn') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatus')[$value['state']];
            } elseif ($lang == 'en') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusen')[$value['state']];
            } elseif ($lang == 'id') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusid')[$value['state']];
            } elseif ($lang == 'ft') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusft')[$value['state']];
            } elseif ($lang == 'yd') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusyd')[$value['state']];
            } elseif ($lang == 'vi') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusvi')[$value['state']];
            } elseif ($lang == 'es') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatuses')[$value['state']];
            } elseif ($lang == 'ja') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusja')[$value['state']];
            } elseif ($lang == 'th') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusth')[$value['state']];
            } elseif ($lang == 'ma') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatusma')[$value['state']];
            } elseif ($lang == 'pt') {
                $data['info'][$key]['status_desc'] = config('custom.rechargeStatuspt')[$value['state']];
            }

            $data['info'][$key]['typedes'] = '充222值';
        }


        return $data;
    }

    /**
     * 团队充值
     */
    public function TeamRecharge()
    {
        //获取参数并过滤
        $param = input('param.');
        $param['user_id'] = input('param.user_id/d');
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        if (!$param['user_id']) {
            $data['code'] = 0;
            return $data;
        }

        $where[] = array('user_team.uid', '=', $param['user_id']);
        $where[] = array('user_team.team', 'neq', $param['user_id']);

        //用户名搜索
        if (isset($param['username']) and $param['username']) {
            $where[] = array('username', '=', $param['username']);
        }
        //状态
        if (isset($param['state']) and $param['state']) {
            $where[] = array('ly_user_recharge.state', '=', $param['state']);
        }
        //开始时间
        if (isset($param['search_time_s']) and $param['search_time_s']) {
            $where[] = array('add_time', '>=', strtotime($param['search_time_s']));
        } else {
            $where[] = array('add_time', '>=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        }
        //结束时间
        if (isset($param['search_time_e']) and $param['search_time_e']) {
            $where[] = array('add_time', '<=', strtotime($param['search_time_e']));
        } else {
            $where[] = array('add_time', '<=', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
        }

        //分页
        //总记录数
        $count = $this->join('users', 'ly_user_recharge.uid = users.id')->join('user_team', 'ly_user_recharge.uid = user_team.team')->where($where)->count();
        if (!$count) {
            $data['code'] = 0;
            return $data;
        }


        //每页记录数
        $pageSize = (isset($param['page_size']) and $param['page_size']) ? $param['page_size'] : 10;
        //当前页
        $pageNo = (isset($param['page_no']) and $param['page_no']) ? $param['page_no'] : 1;
        //总页数
        $pageTotal = ceil($count / $pageSize); //当前页数大于最后页数，取最后
        //偏移量
        $limitOffset = ($pageNo - 1) * $pageSize;

        //数据
        $dataArray = $this->field('ly_user_recharge.*,users.username')
            ->join('users', 'ly_user_recharge.uid = users.id')
            ->join('user_team', 'ly_user_recharge.uid = user_team.team')
            ->where($where)
            ->order('add_time', 'desc')
            ->limit($limitOffset, $pageSize)
            ->select();

        if (!$dataArray) {
            $data['code'] = 0;
            return $data;
        }

        //获取成功
        $data['code'] = 1;
        $data['data_total_nums'] = $count;
        $data['data_total_page'] = $pageTotal;
        $data['data_current_page'] = $pageNo;

        $decimalPlace = config('api.decimalPlace');
        foreach ($dataArray as $key => $value) {
            $value['fee'] = round($value['fee'], $decimalPlace);
            $value['money'] = round($value['money'], $decimalPlace);

            $bankName = model('Bank')->field('bank_name')->where('id', $value['bid'])->find();
            $payType = model('RechangeType')->field('name')->where('id', $value['type'])->find();
            $data['info'][$key]['dan'] = $value['order_number'];
            $data['info'][$key]['adddate'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['info'][$key]['bank_name'] = $bankName ? $bankName['bank_name'] : '';
            $data['info'][$key]['pay_type'] = $payType['name'];
            $data['info'][$key]['username'] = $value['username'];
            $data['info'][$key]['fee'] = $value['fee'];
            $data['info'][$key]['money'] = $value['money'];
            $data['info'][$key]['status'] = config('custom.rechargeStatus')[$value['state']];
        }

        return $data;
    }

    /**
     * 团队账号首冲人数
     */
    public function rechargeFirst($userId, $startData, $endDate)
    {
        $data = $this->field('ly_user_recharge.uid,ly_user_recharge.add_time')->join('user_team', 'ly_user_recharge.uid = user_team.team', 'inner')->where(['user_team.uid' => $userId, 'ly_user_recharge.state' => 1])->order('add_time', 'asc')->group('ly_user_recharge.uid')->select();
        if (!$data) return 0;

        foreach ($data as $key => $value) {
            if ($value['add_time'] <= $startData || $value['add_time'] >= $endDate) {
                unset($data[$key]);
            }
        }

        return count($data);
    }

    //获取用户首冲信息
    public function getfirstRecharge()
    {

        //获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username

        $count = $this->where(array('uid' => $uid, 'first_recharge' => 2))->count();
        if ($count) {
            $data['code'] = 1;
            $data['info']['state'] = 0;
            return $data;
        }

        $data_arr = $this->field('money,first_recharge,add_time')->where(array('uid' => $uid, 'state' => 1))->find();

        if (!$data_arr) {
            $data['code'] = 1;
            $data['info']['state'] = 0;
            return $data;
        }

        if ($data_arr['first_recharge'] == 2) {
            $data['code'] = 1;
            $data['info']['state'] = 0;
            return $data;
        }

        //判断首冲是否过了24小时
        if (time() - $data_arr['add_time'] > 24 * 60 * 60) {
            $data['code'] = 1;
            $data['info']['state'] = 0;
            return $data;
        }

        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        $where[] = array('uid', '=', $uid);
        $where[] = array('date', '=', $date);
        $where[] = array('betting', '=', 0);

        $bettingcount = Model('UserDaily')->wehre($where)->count();

        if ($bettingcount) {
            $data['code'] = 1;
            $data['info']['state'] = 0;
            return $data;
        }

        $state = 1;

        if (!$data_arr['money']) {
            $state = 0;
        }

        if ($data_arr['money'] >= 100 && $data_arr['money'] < 500) {
            $back = 18.88;
        } elseif ($data_arr['money'] >= 500 && $data_arr['money'] < 1000) {
            $back = 38.88;
        } elseif ($data_arr['money'] >= 1000 && $data_arr['money'] < 5000) {
            $back = 58.88;
        } elseif ($data_arr['money'] >= 5000 && $data_arr['money'] < 10000) {
            $back = 88.88;
        } elseif ($data_arr['money'] >= 10000) {
            $back = 188.88;
        }

        if (!$back) {
            $data['code'] = 0;
            return $data;
        }

        if ($state) {
            $data['code'] = 1;
            $data['info']['firstRecharge'] = $data_arr['money'];
            $data['info']['money'] = $back;
            $data['info']['state'] = 1;
        } else {
            $data['code'] = 1;
            $data['info']['state'] = 0;
        }
        return $data;
    }

    //首冲返现
    public function firstRecharge()
    {
        //获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $count = $this->where(array('uid' => $uid, 'first_recharge' => 2))->count();
        if ($count) {
            $data['code'] = 2;
            if ($lang == 'cn') $data['code_dec'] = '已领取奖励';
            elseif ($lang == 'en') $data['code_dec'] = 'Received reward';
            elseif ($lang == 'id') $data['code_dec'] = 'Hadiah yang diterima';
            elseif ($lang == 'ft') $data['code_dec'] = '已領取獎勵';
            elseif ($lang == 'yd') $data['code_dec'] = 'प्राप्त बदला';
            elseif ($lang == 'vi') $data['code_dec'] = 'Nhận thưởng';
            elseif ($lang == 'es') $data['code_dec'] = 'Recompensas recibidas';
            elseif ($lang == 'ja') $data['code_dec'] = '奨励金を受け取りました';
            elseif ($lang == 'th') $data['code_dec'] = 'ได้รับรางวัล';
            elseif ($lang == 'ma') $data['code_dec'] = 'Hadiah diterima';
            elseif ($lang == 'pt') $data['code_dec'] = 'Prémio recebido';

            return $data;
        }

        $data_arr = $this->field('money,first_recharge,add_time')->where(array('uid' => $uid, 'state' => 1))->find();

        if (!$data_arr) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';

            return $data;
        }

        if ($data_arr['first_recharge'] == 2) {
            $data['code'] = 2;
            if ($lang == 'cn') $data['code_dec'] = '已领取奖励';
            elseif ($lang == 'en') $data['code_dec'] = 'Received reward';
            elseif ($lang == 'id') $data['code_dec'] = 'Hadiah yang diterima';
            elseif ($lang == 'ft') $data['code_dec'] = '已領取獎勵';
            elseif ($lang == 'yd') $data['code_dec'] = 'प्राप्त बदला';
            elseif ($lang == 'vi') $data['code_dec'] = 'Nhận thưởng';
            elseif ($lang == 'es') $data['code_dec'] = 'Recompensas recibidas';
            elseif ($lang == 'ja') $data['code_dec'] = '奨励金を受け取りました';
            elseif ($lang == 'th') $data['code_dec'] = 'ได้รับรางวัล';
            elseif ($lang == 'ma') $data['code_dec'] = 'Hadiah diterima';
            elseif ($lang == 'pt') $data['code_dec'] = 'Prémio recebido';

            return $data;
        }

        //判断首冲是否过了24小时
        if (time() - $data_arr['add_time'] > 24 * 60 * 60) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';

            return $data;
        }

        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        $where[] = array('uid', '=', $uid);
        $where[] = array('date', '=', $date);
        $where[] = array('betting', '=', 0);

        $bettingcount = Model('UserDaily')->wehre($where)->count();

        if ($bettingcount) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';

            return $data;
        }


        if (!$data_arr['money']) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';
        }

        if ($data_arr['money'] >= 100 && $data_arr['money'] < 500) {
            $back = 18.88;
        } elseif ($data_arr['money'] >= 500 && $data_arr['money'] < 1000) {
            $back = 38.88;
        } elseif ($data_arr['money'] >= 1000 && $data_arr['money'] < 5000) {
            $back = 58.88;
        } elseif ($data_arr['money'] >= 5000 && $data_arr['money'] < 10000) {
            $back = 88.88;
        } elseif ($data_arr['money'] >= 10000) {
            $back = 188.88;
        }

        if (!$back) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';

            return $data;
        }
        $price = sprintf("%.3f", $back);

        //获取余额
        $balance = model('UserTotal')->where('uid', $uid)->value('balance');

        $is_updata_user = model('UserTotal')->where('uid', $uid)->setDec('balance', $price);

        if (!$is_updata_user) {
            $data['code'] = 0;
            if ($lang == 'cn') $data['code_dec'] = '领取失败';
            elseif ($lang == 'en') $data['code_dec'] = 'Claim failed';
            elseif ($lang == 'id') $data['code_dec'] = 'Claim gagal';
            elseif ($lang == 'ft') $data['code_dec'] = '領取失敗';
            elseif ($lang == 'yd') $data['code_dec'] = 'क्लाइम असफल';
            elseif ($lang == 'vi') $data['code_dec'] = 'Lỗi lợi';
            elseif ($lang == 'es') $data['code_dec'] = 'Fallo de cobro';
            elseif ($lang == 'ja') $data['code_dec'] = '受取に失敗しました';
            elseif ($lang == 'th') $data['code_dec'] = 'ความล้มเหลวในการเก็บรวบรวม';
            elseif ($lang == 'ma') $data['code_dec'] = 'Koleksi gagal';
            elseif ($lang == 'pt') $data['code_dec'] = 'A coleção falhou';

            return $data;
        }

        $financial_data['uid'] = $uid;
        $financial_data['username'] = $username;
        $financial_data['order_number'] = 'A' . trading_number();
        $financial_data['trade_type'] = 9;
        $financial_data['trade_before_balance'] = $balance;
        $financial_data['trade_amount'] = $price;
        $financial_data['account_balance'] = $balance + $price;
        $financial_data['remarks'] = '每日首冲活动奖励';

        model('TradeDetails')->tradeDetails($financial_data);

        $this->where(array('uid' => $uid))->update(array('first_recharge' => 2));

        $data['code'] = 1;
        if ($lang == 'cn') $data['code_dec'] = '每日首冲活动奖励';
        elseif ($lang == 'en') $data['code_dec'] = 'Reward for daily first flush';
        elseif ($lang == 'id') $data['code_dec'] = 'Hadiah untuk flush pertama sehari';
        elseif ($lang == 'ft') $data['code_dec'] = '每日首沖活動獎勵';
        elseif ($lang == 'yd') $data['code_dec'] = 'प्रत्येक दिन के लिए प्रथम प्रवाह का बदला दिया';
        elseif ($lang == 'vi') $data['code_dec'] = 'Phần thưởng cho lần dội đầu tiên hàng ngày';
        elseif ($lang == 'es') $data['code_dec'] = 'Premios diarios de iniciación';
        elseif ($lang == 'ja') $data['code_dec'] = '毎日のイベントのご褒美';
        elseif ($lang == 'th') $data['code_dec'] = 'เปิดตัวกิจกรรมรางวัลทุกวัน';
        elseif ($lang == 'ma') $data['code_dec'] = 'Hadiah aktiviti flush pertama sehari';
        elseif ($lang == 'pt') $data['code_dec'] = 'Recompensa diária de primeira DESCARGA';
        return $data;
    }

    public function setOrderInfo()
    {
        $orderNumber = (input('post.orderNumber')) ? input('post.orderNumber') : 0;
        $screenshots = (input('post.screenshots')) ? input('post.screenshots') : '';
        $is_up = $this->where('order_number', $orderNumber)->update(['screenshots' => json_encode($screenshots)]);
        if ($is_up) {
            $data['code'] = 1;
            $data['code_dec'] = 'success';
            $data['orderNumber'] = $orderNumber;
            return $data;
        }else{
            $data['code'] = 1;
            $data['code_dec'] = 'success';
            $data['orderNumber'] = $orderNumber;
            return $data;
        }
    }

    //充值返点
    public function recharge_setrebate($param)
    {
        return;
        if ($param['uid'] == $param['sid']) return true;
        //判断首次还是多次
        if ($param['num'] == 1) {
            $hiton_promote = model('Setting')->where('id', 1)->value('hiton_promote');
            if (!$hiton_promote) return true;
            //只奖励一次 === 判断之前用户是否有产生过
            if ($hiton_promote == 1) {
                $res = model('common/TradeDetails')
                    ->where('trade_type', 8)
                    ->where('sid', $param['uid'])
                    ->find();
                if ($res) return true;
            }
        }
        if ($param['num'] < 4) {//上三级
            $userinfo = model('Users')
                ->field('ly_users.id,ly_users.vip_level,user_grade.spread,ly_users.username,ly_users.sid,user_total.balance')
                ->join('user_total', 'ly_users.id=user_total.uid')
                ->join('user_grade', 'ly_users.vip_level=user_grade.grade')
                ->where('ly_users.id', $param['sid'])
                ->find();
            //spread
            if ($userinfo) {
                $rr = explode(',', $userinfo['spread']);
                //返点值
                $rebate = isset($rr[$param['num'] - 1]) ? intval($rr[$param['num'] - 1]) : 0;
                if ($rebate) {
                    $rebate_amount = round($param['commission'] * ($rebate / 100), 2);
                    if ($rebate_amount > 0) {
                        $is_up_to = model('UserTotal')
                            ->where('uid', $userinfo['id'])
                            ->setInc('balance', $rebate_amount);
                        if ($is_up_to) {
                            model('UserTotal')->where('uid', $userinfo['id'])->setInc('total_balance', $rebate_amount);
                            // 流水
                            $financial_data_p = [];
                            $financial_data_p['uid'] = $userinfo['id'];
                            $financial_data_p['sid'] = $param['uid'];
                            $financial_data_p['username'] = $userinfo['username'];
                            $financial_data_p['order_number'] = $param['order_number'];
                            $financial_data_p['trade_number'] = 'L' . trading_number();
                            $financial_data_p['trade_type'] = 8;
                            $financial_data_p['trade_before_balance'] = $userinfo['balance'];
                            $financial_data_p['trade_amount'] = $rebate_amount;
                            $financial_data_p['account_balance'] = $userinfo['balance'] + $rebate_amount;
                            $financial_data_p['remarks'] = '充值返点,比例:' . $rebate . ',层级:' . $param['num'];
                            $financial_data_p['types'] = 1;    // 用户1，商户2
                            model('common/TradeDetails')->tradeDetails($financial_data_p);
                        }
                    }
                    //继续下一级
                    if ($userinfo['sid']) {
                        $rebatearr = array(
                            'num' => $param['num'] + 1,
                            'uid' => $userinfo['id'],
                            'sid' => $userinfo['sid'],
                            'order_number' => $param['order_number'],
                            'commission' => $param['commission'],
                        );
                        $this->recharge_setrebate($rebatearr);
                    }
                }
            }
        }
    }

}
