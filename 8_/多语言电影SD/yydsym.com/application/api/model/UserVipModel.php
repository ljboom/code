<?php

/**
 * 编写：祝踏岚
 * 用于获取系统设置数据
 */

namespace app\api\model;

use think\Model;
use think\facade\Env;

class UserVipModel extends Model
{
    //表名
    protected $table = 'ly_user_vip';

    // 用户购买vip
    public function userBuyVip()
    {
        $param = input('post.');
        $userArr = explode(',', auth_code($param['token'], 'DECODE'));
        $uid = $userArr[0];
        $username = $userArr[1];
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $grade = input('post.grade/d');    // 购买的VIP等级
        // 检测VIP等级
        if ($grade < 2) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '充值的VIP等级错误'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tingkat ulang isi VIP yang salah'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '充值的VIP等級錯誤'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'पुनरार्ज का VIP स्तर गलत है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không đúng cấp VIP để nạp lại'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Error de categoría VIP'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'チャージのVIPレベルエラー'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ข้อผิดพลาดในการชาร์จระดับวีไอพี'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Aras muatan semula VIP tidak betul'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Nível VIP incorreto de recarga'];
            }
            return ['code' => 0, 'code_dec' => 'Wrong VIP level for recharging!'];
        }

        // 检测充值的VIP等级
        $GradeInfo = model('UserGrade')->where('grade', $grade)->find();
        if (!$GradeInfo) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => 'VIP等级不存在'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tingkat VIP tidak ada'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => 'VIP等級不存在'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'VIP स्तर मौजूद नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'cấp VIP không tồn tại'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'VIP no existe.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'VIPレベルは存在しません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ระดับวีไอพีไม่มี'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Aras VIP tidak wujud'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'O nível VIP não existe'];
            }
            return ['code' => 0, 'code_dec' => 'VIP level does not exist!'];
        }
        $amount = $GradeInfo['amount'];//
        $vip_level = model('Users')->where('id', $uid)->value('vip_level');
        //不等购买低于会员等级的vip
        if ($grade < $vip_level) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '充值的VIP等级不能小于原VIP等级'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tingkat VIP pemuatan ulang tidak dapat kurang dari tingkat VIP asli'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '充值的VIP等級不能小於原VIP等級'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'पुनरार्ज के VIP स्तर मौलिक VIP स्तर से कम नहीं होता'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Mức phụ nạp của VIP không thể ít hơn cấp VIP ban đầu'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'No puede ser inferior al nivel VIP original.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'チャージしたVIPレベルは元のVIPレベルを下回ってはいけません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ระดับวีไอพีเติมเงินไม่สามารถน้อยกว่าระดับวีไอพีเดิม'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Aras muatan semula VIP tidak boleh kurang daripada aras VIP asal'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'O nível VIP de recarga não Pode ser inferior Ao nível VIP original'];
            }
            return ['code' => 0, 'code_dec' => 'The recharge VIP level cannot be less than the original VIP level!'];
        }
        $uservipdata = $this->where(array(['uid', '=', $uid], ['state', '=', 1], ['etime', '>=', time()]))->find();

        $in = $is_in = $is_up = 0;
        $start_time = strtotime(date("Y-m-d", time()));//当天的时间错

        /*switch ($GradeInfo['validity_time']) {
            case '12':
                $validity_day = 365;
                break;
            default:
                $validity_day = $GradeInfo['validity_time'] * 30;
                break;
        }*/
        //有效期
        $validity_day = intval($GradeInfo['validity_time']);

        if ($uservipdata) {
            //等级相同续费
            if ($uservipdata['grade'] == $grade && $grade == $vip_level) {
                //更新结束时间
                $arr1 = array(
                    'etime' => $uservipdata['etime'] + $validity_day * 86400,
                );
                $amount = $GradeInfo['amount'];//续费金额

            } else {
                //更新结束时间
                $arr1 = array(
                    'en_name' => $GradeInfo['en_name'],
                    'name' => $GradeInfo['name'],
                    'ft_name' => $GradeInfo['ft_name'],
                    'ry_name' => $GradeInfo['ry_name'],
                    'ydn_name' => $GradeInfo['ydn_name'],
                    'xby_name' => $GradeInfo['xby_name'],
                    'yn_name' => $GradeInfo['yn_name'],
                    'ty_name' => $GradeInfo['ty_name'],
                    'yd_name' => $GradeInfo['yd_name'],
                    'ma_name' => $GradeInfo['ma_name'],
                    'pt_name' => $GradeInfo['pt_name'],
                    'grade' => $grade,
                    'stime' => $start_time,
                    'etime' => $start_time + $validity_day * 86400,
                );
                $amount = $GradeInfo['amount'] - model('UserGrade')->where('grade', $vip_level)->value('amount');
                //$amount = $GradeInfo['amount'];
            }
        } //没有vip
        else {
            $newData = [
                'username' => $username,
                'uid' => $uid,
                'state' => 1,
                'name' => $GradeInfo['name'],
                'en_name' => $GradeInfo['en_name'],
                'ft_name' => $GradeInfo['ft_name'],
                'ry_name' => $GradeInfo['ry_name'],
                'ydn_name' => $GradeInfo['ydn_name'],
                'xby_name' => $GradeInfo['xby_name'],
                'yn_name' => $GradeInfo['yn_name'],
                'ty_name' => $GradeInfo['ty_name'],
                'yd_name' => $GradeInfo['yd_name'],
                'ma_name' => $GradeInfo['ma_name'],
                'pt_name' => $GradeInfo['pt_name'],
                'grade' => $grade,
                'stime' => $start_time,
                'etime' => $start_time + $validity_day * 86400,
            ];
            $in = 1;
        }

        // 检测用户的余额
        $userBalance = model('UserTotal')->where('uid', $uid)->value('balance');    // 获取用户的余额
        if ($amount > $userBalance) {
            if ($lang == 'cn') {
                return ['code' => 2, 'amount' => $amount - $userBalance, 'code_dec' => '用户余额不足'];
            } elseif ($lang == 'id') {
                return ['code' => 2, 'code_dec' => 'Tidak cukup keseimbangan pengguna'];
            } elseif ($lang == 'ft') {
                return ['code' => 2, 'code_dec' => '用戶餘額不足'];
            } elseif ($lang == 'yd') {
                return ['code' => 2, 'code_dec' => 'अपर्याप्त प्रयोक्ता बैलेंस'];
            } elseif ($lang == 'vi') {
                return ['code' => 2, 'code_dec' => 'Lượng người dùng kém'];
            } elseif ($lang == 'es') {
                return ['code' => 2, 'code_dec' => 'Saldo de usuario insuficiente'];
            } elseif ($lang == 'ja') {
                return ['code' => 2, 'code_dec' => 'ユーザー残高が足りない'];
            } elseif ($lang == 'th') {
                return ['code' => 2, 'code_dec' => 'ยอดผู้ใช้ไม่เพียงพอ'];
            } elseif ($lang == 'ma') {
                return ['code' => 2, 'code_dec' => 'Imbangan pengguna tidak mencukupi'];
            } elseif ($lang == 'pt') {
                return ['code' => 2, 'code_dec' => 'Balanço insuficiente do utilizador'];
            }
            return ['code' => 2, 'amount' => $amount - $userBalance, 'code_dec' => 'Insufficient user balance!'];
        }

        if ($in) {
            $is_in = $this->insertGetId($newData);//添加会员
        } else {
            $is_up = $this->where('id', $uservipdata['id'])->update($arr1);
        }

        $is = $is_up + $is_in;
        if (!$is) {
            if ($is_in) {
                $this->where('id', $is_in)->delete();
            }
            if ($is_up) {
                //更新结束时间
                $arr3 = array(
                    'en_name' => $uservipdata['en_name'],
                    'name' => $uservipdata['name'],
                    'ft_name' => $uservipdata['ft_name'],
                    'ry_name' => $uservipdata['ry_name'],
                    'ydn_name' => $uservipdata['ydn_name'],
                    'xby_name' => $uservipdata['xby_name'],
                    'yn_name' => $uservipdata['yn_name'],
                    'ty_name' => $uservipdata['ty_name'],
                    'yd_name' => $uservipdata['yd_name'],
                    'ma_name' => $uservipdata['ma_name'],
                    'pt_name' => $uservipdata['pt_name'],
                    'grade' => $uservipdata['grade'],
                    'stime' => $uservipdata['stime'],
                    'etime' => $uservipdata['etime'],
                );
                $this->where('id', $uservipdata['id'])->update($arr3);
            }
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => 'VIP充值失败'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Pemuatan ulang VIP gagal'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => 'VIP充值失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'वीपी पुनरार्ज असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Nạp VIP bị lỗi'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Fallo VIP'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'VIPチャージ失敗'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'วีไอพีชาร์จล้มเหลว'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Muat semula VIP gagal'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Falha Na recarga VIP'];
            }
            return ['code' => 0, 'code_dec' => 'VIP recharge failed!'];
        }

        // 扣减用户汇总表的用户余额


        // 流水
        $order_number = 'B' . trading_number();
        $trade_number = 'L' . trading_number();

        $financial_data['uid'] = $uid;
        $financial_data['username'] = $username;
        $financial_data['order_number'] = $order_number;
        $financial_data['trade_number'] = $trade_number;
        $financial_data['trade_type'] = 9;
        $financial_data['trade_before_balance'] = $userBalance;
        $financial_data['trade_amount'] = $amount;
        $financial_data['account_balance'] = $userBalance - $amount;
        $financial_data['remarks'] = '购买 ' . $GradeInfo['name'];
        $financial_data['types'] = 1;    // 用户1，商户2
        if (!$in) {
            $financial_data['remarks'] = '升级 ' . $GradeInfo['name'];;
            $financial_data['trade_type'] = 17;
        }

        model('TradeDetails')->tradeDetails($financial_data);

        //更新会员等级
        model('Users')->where('id', $uid)->update(array('vip_level' => $grade));

        //减去会员的余额
        model('UserTotal')->where('uid', $uid)->setDec('balance', $amount);

        //推荐返佣
        $userinfo = model('Users')->where('id', $uid)->find();
        //判断重复推荐返佣
        //
        //$uservip = model('Uservip')->where('uid', $uid)->find();
        // $usergrade = $uservip['grade'];
        //var_dump($usergrade);die;
        //if ($userinfo['is_spread'] == 0) {
        if ($userinfo['sid'] && $in) {
            //上级推荐返佣
            $rebatearr = array(
                'num' => 1,
                'uid' => $userinfo['id'],
                'sid' => $userinfo['sid'],
                'order_number' => $order_number,
                'spread' => $GradeInfo['spread'],
                'amount' => $amount,
            );
            $this->setspread($rebatearr);
        }
        model('Users')->where('id', $uid)->update(array('is_spread' => 1));
        //}
        
        //信用中心
        if($userinfo['credit'] <= 99)
        {
            model('Users')->where('id', $userinfo['sid'])->setInc('credit');
        }

        if ($lang == 'cn') {
            return ['code' => 1, 'code_dec' => 'VIP充值成功'];
        } elseif ($lang == 'id') {
            return ['code' => 1, 'code_dec' => 'Memuatkan ulang VIP berhasil'];
        } elseif ($lang == 'ft') {
            return ['code' => 1, 'code_dec' => 'VIP充值成功'];
        } elseif ($lang == 'yd') {
            return ['code' => 1, 'code_dec' => 'VIP पुनरार्ज सफल'];
        } elseif ($lang == 'vi') {
            return ['code' => 1, 'code_dec' => 'Nạp VIP đã xong'];
        } elseif ($lang == 'es') {
            return ['code' => 1, 'code_dec' => 'VIP cargado.'];
        } elseif ($lang == 'ja') {
            return ['code' => 1, 'code_dec' => 'VIPチャージ成功'];
        } elseif ($lang == 'th') {
            return ['code' => 1, 'code_dec' => 'วีไอพีชาร์จเรียบร้อยแล้ว'];
        } elseif ($lang == 'ma') {
            return ['code' => 1, 'code_dec' => 'Muat semula VIP berjaya'];
        } elseif ($lang == 'pt') {
            return ['code' => 1, 'code_dec' => 'Recarregamento VIP BEM sucedido'];
        }
        return ['code' => 1, 'code_dec' => 'VIP recharge succeeded!'];
    }


    // 获取用户购买vip记录列表
    public function getUserBuyVipList()
    {
        //获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型

        $is_user = model('Users')->where('id', $uid)->count();
        //检测用户
        if ($is_user) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '用户不存在'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'user does not exist!'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'pengguna tidak ada'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '用戶不存在'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'उपयोक्ता मौजूद नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'người dùng không tồn tại'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Usuario no existente'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'ユーザが存在しません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ผู้ใช้ไม่มี'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'pengguna tidak wujud'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'O utilizador não existe'];
            }
        }

        $countNum = $this->where('uid', $uid)->count();
        if (!$countNum) {
            $data['code'] = 0;
            if ($lang == 'cn') {
                $data['code_dec'] = '暂无交易记录';
            } elseif ($lang == 'en') {
                $data['code_dec'] = 'No transaction record';
            } elseif ($lang == 'id') {
                $data['code_dec'] = 'Tidak ada catatan transaksi';
            } elseif ($lang == 'ft') {
                $data['code_dec'] = '暫無交易記錄';
            } elseif ($lang == 'yd') {
                $data['code_dec'] = 'कोई ट्रांसेक्शन रेकॉर्ड नहीं';
            } elseif ($lang == 'vi') {
                $data['code_dec'] = 'Không ghi nhận giao dịch';
            } elseif ($lang == 'es') {
                $data['code_dec'] = 'No se dispone de registros';
            } elseif ($lang == 'ja') {
                $data['code_dec'] = '取引記録がありません';
            } elseif ($lang == 'th') {
                $data['code_dec'] = 'ไม่มีบันทึกการซื้อขาย';
            } elseif ($lang == 'ma') {
                $data['code_dec'] = 'Tiada transaksi';
            } elseif ($lang == 'pt') {
                $data['code_dec'] = 'Nenhuma transação';
            }
            return $data;
        }

        //每页记录数
        $pageSize = (isset($param['page_size']) and $param['page_size']) ? $param['page_size'] : 10;
        //当前页
        $pageNo = (isset($param['page_no']) and $param['page_no']) ? $param['page_no'] : 1;
        //总页数
        $pageTotal = ceil($countNum / $pageSize); //当前页数大于最后页数，取最后
        //偏移量
        $limitOffset = ($pageNo - 1) * $pageSize;

        $userBuyVipList = $this->where('uid', $uid)->order('stime desc')->limit($limitOffset, $pageSize)->select();
        if (is_object($userBuyVipList)) $userBuyVipListArray = $userBuyVipList->toArray();

        //获取成功
        $data['code'] = 1;
        $data['data_total_nums'] = $countNum;
        $data['data_total_page'] = $pageTotal;
        $data['data_current_page'] = $pageNo;

        //数组重组赋值
        foreach ($userBuyVipListArray as $key => $value) {
            $data['info'][$key]['id'] = $value['id'];
            $data['info'][$key]['uid'] = $value['uid'];
            $data['info'][$key]['username'] = $value['username'];
            $data['info'][$key]['name'] = $value['name'];
            $data['info'][$key]['en_name'] = $value['en_name'];
            $data['info'][$key]['grade'] = $value['grade'];
            $data['info'][$key]['state'] = $value['state'];
            $data['info'][$key]['stime'] = date('Y-m-d H:i:s', $value['stime']);
            $data['info'][$key]['etime'] = date('Y-m-d H:i:s', $value['etime']);
        }

        return $data;
    }

    public function setspread($param, $isTest = false)
    {
        if ($param['uid'] == $param['sid']) return true;
        if ($param['num'] < 4) {
            $userinfo = model('Users')
                ->field('ly_users.id,ly_users.username,ly_users.sid,ly_users.vip_level,user_total.balance,ly_users.vip_level')
                ->join('user_total', 'ly_users.id=user_total.uid')
                ->where('ly_users.id', $param['sid'])
                ->find();
            if (!$userinfo) return true;
            $GradeInfo = model('UserGrade')->where('grade', $userinfo['vip_level'])->find();
            if ($GradeInfo) {
                //用自己的等级
                $param['spread'] = $GradeInfo['spread'];
                //用自己的钱
                $rAmount = $param['amount'];
                if ($GradeInfo['amount'] < $rAmount) $rAmount = $GradeInfo['amount'];
                //上三级
                $spread_arr = explode(',', $param['spread']);
                if (!empty($spread_arr[$param['num'] - 1])) {
                    $rebate_arotate = floatval($spread_arr[$param['num'] - 1]);
                    if ($rebate_arotate > 0) {
                        $rebate_real = $rebate_arotate * $rAmount / 100;
                        if ($rebate_real > 0) {
                            $is_up_to = model('UserTotal')->where('uid', $userinfo['id'])->setInc('balance', $rebate_real);
                            if ($is_up_to) {
                                model('UserTotal')->where('uid', $userinfo['id'])->setInc('total_balance', $rebate_real);
                                // 流水
                                $financial_data_p['uid'] = $userinfo['id'];
                                $financial_data_p['sid'] = $param['uid'];
                                $financial_data_p['username'] = $userinfo['username'];
                                $financial_data_p['order_number'] = 'D' . trading_number();
                                $financial_data_p['trade_number'] = 'L' . trading_number();
                                $financial_data_p['trade_type'] = 8;
                                $financial_data_p['trade_before_balance'] = $userinfo['balance'];
                                $financial_data_p['trade_amount'] = $rebate_real;
                                $financial_data_p['account_balance'] = $userinfo['balance'] + $rebate_real;
                                $financial_data_p['remarks'] = '[' . $param['uid'] . ']购买VIP 推荐返佣 Level:' . $param['num'];
                                $financial_data_p['types'] = 1;    // 用户1，商户2
                                model('common/TradeDetails')->tradeDetails($financial_data_p);
                            }
                        }
                    }
                }
            }
            if ($userinfo['sid']) {
                $rebatearr = array(
                    'num' => $param['num'] + 1,
                    'uid' => $param['uid'],
                    'sid' => $userinfo['sid'],
                    'order_number' => $param['order_number'],
                    'spread' => $param['spread'],
                    'amount' => $param['amount'],
                );
                $this->setspread($rebatearr);
            }
        }
    }


    public function upgradeVip($uid, $userBalance, $GradeInfo)
    {
        $user = model('Users')->where('id', $uid)->find();
        $amount = $GradeInfo['amount'];//
        $vip_level = model('Users')->where('id', $uid)->value('vip_level');
        //不等购买低于会员等级的vip
        $grade = $GradeInfo['grade'];
        if ($grade <= $vip_level) {
            return false;
        }
        $uservipdata = $this->where(array(['uid', '=', $uid], ['state', '=', 1], ['etime', '>=', time()]))->find();
        $in = $is_in = $is_up = 0;
        $start_time = strtotime(date("Y-m-d", time()));//当天的时间错

        if ($uservipdata) {
            //等级相同续费
            if ($uservipdata['grade'] == $grade && $grade == $vip_level) {
                //相同的就不用升级
                return false;
            } else {
                //更新结束时间
                $arr1 = array(
                    'en_name' => $GradeInfo['en_name'],
                    'name' => $GradeInfo['name'],
                    'grade' => $grade,
                    'stime' => $start_time,
                    'etime' => $start_time + 365 * 24 * 3600,
                );
            }
        } else {//没有vip
            $newData = [
                'username' => $user['username'],
                'uid' => $uid,
                'state' => 1,
                'name' => $GradeInfo['name'],
                'en_name' => $GradeInfo['en_name'],
                'grade' => $grade,
                'stime' => $start_time,
                'etime' => $start_time + 365 * 24 * 3600,
            ];
            $in = 1;
        }
        if ($in) {
            $is_in = $this->insertGetId($newData);//添加会员
        } else {
            $is_up = $this->where('id', $uservipdata['id'])->update($arr1);
        }
        $is = $is_up + $is_in;
        if (!$is) {
            if ($is_in) {
                $this->where('id', $new_id)->delete();
            }
            if ($is_up) {
                //更新结束时间
                $arr3 = array(
                    'en_name' => $uservipdata['en_name'],
                    'name' => $uservipdata['name'],
                    'grade' => $uservipdata['grade'],
                    'stime' => $uservipdata['stime'],
                    'etime' => $uservipdata['etime'],
                );
                $this->where('id', $uservipdata['id'])->update($arr3);
            }
            return false;
        }
        //更新会员等级
        model('Users')->where('id', $uid)->update(array('vip_level' => $grade));
        return true;
    }
}
