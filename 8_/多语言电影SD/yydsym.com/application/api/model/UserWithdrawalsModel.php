<?php

namespace app\api\model;

use think\model;
use app\api\validate\UserTotal as UserTotalValidate;

class UserWithdrawalsModel extends model
{
    protected $table = 'ly_user_withdrawals';

    /**
     * [draw 提现接口]
     * @return [type] [description]
     */


    public function draw()
    {
        //获取参数
        $post = input('post.');
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));//uid,username
        $uid = $userArr[0];//uid
        $username = $userArr[1];//username
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型

        //判断提现时间
        $now_days = intval(date('w', time()));
        $now_hour = intval(date('H', time()));
        /*
        if($now_days < 1 || $now_days >= 6){
            return ['code' => 0, 'code_dec' => 'not monday to friday'];
        }
        */
        
        if ($now_hour < 11 || $now_hour >= 19) {
            return ['code' => 0, 'code_dec' => 'Time in [11:00-19:00]'];
        }
        
        //return $now_days.'---'.$now_hour;
        /*laoli--------------------------------------------------------start*/
        //查询用户类型——测试用户类型不允许提现
        $userType = model('users')->where('id', $uid)->value('user_type');
        if ($userType == 3) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '测试用户类型不允许提现'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Withdrawal is not allowed for test user type'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Pengunduran tidak diizinkan untuk tipe pengguna ujian'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '測試用戶類型不允許提現'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'वाटडवाल प्रयोक्ता क़िस्म के लिए परीक्षा करने के लिए अनुमति नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không cho phép rút lui cho kiểu người dùng thử nghiệm'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Tipo de usuario de prueba'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'テストユーザーのタイプは提示できません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'การทดสอบประเภทผู้ใช้ไม่ได้รับอนุญาต'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Pengunduran tidak dibenarkan untuk jenis pengguna ujian'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Retirada não permitida para o Tipo de utilizador de ensaio'];
            }
        }
        $userState = model('users')->where('id', $uid)->value('state');
        if ($userState != 1) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '会员不可提现'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Members are not allowed to withdraw cash'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Anggota tidak diizinkan menarik uang tunai'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '會員不可提現'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'सदस्यों को पैसा निकालने के लिए अनुमति नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Thành viên không được phép rút tiền mặt'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'No se puede mencionar un miembro.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '会員は現金にしてはいけません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'สมาชิกไม่สามารถนำเงินสด'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Ahli tidak dibenarkan untuk menarik wang tunai'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Os membros não podem retirar numerário'];
            }

        }
        /*laoli--------------------------------------------------------end*/

        $drawtime = cache('C_DrawTime_' . $uid) ? cache('C_DrawTime_' . $uid) : time() - 2;
        //2秒
        if (time() - $drawtime < 2) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '2s内不能连续提交'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak dapat mengirim secara terus-menerus dalam 2 detik'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '2s內不能連續提交'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => '2 सेकण्डों में नियमित रूप से जमा नहीं कर सकता'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không thể nộp liên tục trong vòng hai giây'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'No presentación continua dentro de las 2s'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '2 s以内の連続提出はできません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่สามารถส่งอย่างต่อเนื่องภายใน'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tidak dapat hantar secara terus-menerus dalam 2 saat'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Não é possível submeter continuamente Dentro de dois Segundos'];
            }
            return ['code' => 0, 'code_dec' => 'Cannot submit continuously within 2 seconds'];
        }
        cache('C_DrawTime_' . $uid, time() + 2);

        //判断是否可以提现
        $withdrawals_state = model('Users')->where(array('id' => $uid, 'withdrawals_state' => 1))->count();

        if (!$withdrawals_state) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '未开启提现功能'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Fungsi penarikan tidak diaktifkan'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '未開啟提現功能'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'फंक्शन हटाएँ'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Chức năng rút lui chưa bật'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Sin activar funciones de facturación'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'オープンしていません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ฟังก์ชันการยกเลิก'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Fungsi tarik tidak aktif'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'A função de retirada não é ligada'];
            }
            return ['code' => 0, 'code_dec' => 'Withdrawal function not enabled'];
        }
        //低以50不能提现
        $credit = model('users')->where('id', $uid)->value('credit');
        if ($credit < 50) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '信用低以50不能提现'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Kredit rendah tidak bisa menarik uang tunai pada 50'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '信用低以50不能提現'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कम क्रेडिट 50 से पैसा निकाल सकता है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Giảm t ín dụng không thể rút tiền vào 50'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'El crédito es de 50 dólares.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '信用が低いので、50で現金を引き出すことができません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'เครดิตต่ำเพื่อ 50s ไม่สามารถเพิ่มเงินสด'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Tiada pengeluaran tunai pada kredit 50%'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Sem levantamento de numerário a cinquenta% crédito'];
            }
            return ['code' => 0, 'code_dec' => "Low credit can't withdraw cash at 50"];
        }
        //提现金额次数判读，提现4次翻倍
        //ly_user_withdrawals
        //获取当天提现次数
        //团队提现
        $settingDataa = model('Setting')->where('id', 1)->find();
        //$grade = model('UserVip')->where('uid',$uid)->find();
        $grade = model('Users')->where('id', $uid)->find();
        $usergrade = model('UserGrade')->where('grade', $grade['vip_level'])->find();
        //$usergrade = model('UserGrade')->where('grade',$grade['grade'])->find();
        //当前级别提现次数
        $userwithdrawals = model('UserWithdrawals')
            ->where('uid', $uid)
            ->where('vip_level', $grade['vip_level'])
            ->where('state', 'in', [1, 3, 6])->count();
        $gradeb = $usergrade['extract'] * $settingDataa['min_txbs'];

        // if($post['draw_money'] < $usergrade['extract']){
        //     if($lang=='cn'){
        //     return ['code' => 0, 'code_dec' => '提现金额不在范围内'];
        // }elseif($lang=='pt'){
        //     return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama.'];
        // }
        // }
        if ($userwithdrawals >= $settingDataa['min_txcs']) {
            if ($post['draw_money'] < $gradeb) {
                if ($lang == 'cn') {
                    return ['code' => 0, 'code_dec' => '提现金额不在范围内[min ' . $gradeb . ']'];
                } elseif ($lang == 'pt') {
                    return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama..[min ' . $gradeb . ']'];
                } else {
                    return ['code' => 0, 'code_dec' => '[min ' . $gradeb . ']'];
                }
            }
        } else {
            if ($post['draw_money'] < $usergrade['extract']) {
                if ($lang == 'cn') {
                    return ['code' => 0, 'code_dec' => '提现金额不在范围内'];
                } elseif ($lang == 'pt') {
                    return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama. [min ' . $usergrade['extract'] . ']'];
                } else {
                    return ['code' => 0, 'code_dec' => '[min ' . $usergrade['extract'] . ']'];
                }
            }
        }
        // if(($userwithdrawals > $settingDataa['min_txcs'])){
        //     if($post['draw_money'] < $usergrade['extract']){
        //         if($lang=='cn'){
        //         return ['code' => 0, 'code_dec' => '提现金额不在范围内'];
        //     }elseif($lang=='pt'){
        //         return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama.'];
        //     }
        //     }
        //     elseif($post['draw_money'] < $gradeb){
        //          if($lang=='cn'){
        //         return ['code' => 0, 'code_dec' => '提现金额不在范围内'];
        //     }elseif($lang=='pt'){
        //         return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama..'];
        //     }
        //     }
        // }
        //查询userwithdrawals表中 该uid中state为1的数量
        //提现次数 $settingDataa['min_txcs']
        //该UID等级 $grade['grade']
        //对应等级提现最大金额 $usergrade['extract']
        //提现倍数$settingDataa['min_txbs']
        //当前提现次数$userwithdrawals
        //大于＞ 小于＜
        //var_dump($settingDataa['min_txcs']);
        // var_dump($grade['grade']);
        //  var_dump($usergrade['extract']);
        //  var_dump($usergrade['extract'] * $settingDataa['min_txbs']);
        //  var_dump($userwithdrawals);
        //  var_dump($gradeb);
        //  die;

        $date_str = date('Y-m-d H:i:s');
        // $date_str = '2022-01-04 11:47:48';
        //封装成数组
        $arr = explode("-", $date_str);
        //参数赋值 //年
        $year = $arr[0];
        //月，输出2位整型，不够2位右对齐
        $month = sprintf('%02d', $arr[1]);
        //日，输出2位整型，不够2位右对齐
        $day = sprintf('%02d', $arr[2]);
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;
        //转换成时间戳
        $strap = mktime($hour, $minute, $second, $month, $day, $year);
        //获取数字型星期几$userweek['week']
        $number_wk = date("w", $strap);
        //设置星期几
        $grade1 = model('Users')->where('id', $uid)->find();
        $userweek = model('UserGrade')->where('grade', $grade1['vip_level'])->find();
        $uweek = explode(',', $userweek['week']);

        if (!in_array($number_wk, $uweek)) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '日期不在范围内', [
                    'n' => $number_wk,
                    'a' => $uweek,
                ]];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'data fora do intervalo', [
                    'n' => $number_wk,
                    'a' => $uweek,
                ]];
            } else {
                return ['code' => 0, 'code_dec' => 'Date not in range', [
                    'n' => $number_wk,
                    'a' => $uweek,
                ]];
            }
        }
        //提现范围

        //$settingData = model('Setting')->where('id', 1)->find();

        //var_dump($post['draw_money']);

        // if(($post['draw_money'] < $settingData['min_w']) || ($post['draw_money'] > $settingData['max_w'])){
        //     if($lang=='cn'){
        //         return ['code' => 0, 'code_dec' => '提现金额不在范围内'];
        //     }elseif($lang=='en'){
        //         return ['code' => 0, 'code_dec' => "The withdrawal amount is not within the scope"];
        //     }elseif($lang=='id'){
        //         return ['code' => 0, 'code_dec' => 'Jumlah penarikan tidak berada dalam skop'];
        //     }elseif($lang=='ft'){
        //         return ['code' => 0, 'code_dec' => '提現金額不在範圍內'];
        //     }elseif($lang=='yd'){
        //         return ['code' => 0, 'code_dec' => 'निकालन मात्रा क्षेत्र में नहीं है'];
        //     }elseif($lang=='vi'){
        //         return ['code' => 0, 'code_dec' => 'Số tiền rút lui không nằm trong phạm vi.'];
        //     }elseif($lang=='es'){
        //         return ['code' => 0, 'code_dec' => 'No está dentro de los límites.'];
        //     }elseif($lang=='ja'){
        //         return ['code' => 0, 'code_dec' => '現金引き出しは範囲外です。'];
        //     }elseif($lang=='th'){
        //         return ['code' => 0, 'code_dec' => 'การถอนเงินไม่ได้อยู่ในช่วง'];
        //     }elseif($lang=='ma'){
        //         return ['code' => 0, 'code_dec' => 'Jumlah penarikan tidak berada dalam julat'];
        //     }elseif($lang=='pt'){
        //         return ['code' => 0, 'code_dec' => 'O montante Da retirada não está Na gama'];
        //     }

        // }


        //数据验证
        $validate = validate('app\api\validate\UserTotal');
        if (!$validate->scene('draw')->check($post)) {
            $data['code'] = $validate->getError();
            switch ($data['code']) {
                case 3:
                    if ($lang == 'cn') {
                        $data['code_cn'] = '提现金额不在范围内';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'The withdrawal amount is not within the scope';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Jumlah penarikan tidak berada dalam skop';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '提現金額不在範圍內';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'निकालन मात्रा क्षेत्र में नहीं है';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Số tiền rút lui không nằm trong phạm vi.';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'No está dentro de los límites.';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '現金引き出しは範囲外です。';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'การถอนเงินไม่ได้อยู่ในช่วง';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Jumlah penarikan tidak berada dalam julat';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'O montante Da retirada não está Na gama';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

                    break;
                case 4:

                    if ($lang == 'cn') {
                        $data['code_cn'] = '资金密码有误';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'Wrong capital password';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Kata sandi kapital salah';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '資金密碼有誤';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'गलत राजधानी पासवर्ड';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Mật khẩu vốn sai';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Código de fondos equivocado.';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '資金のパスワードが間違っています';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'รหัสเงินผิด';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Katalaluan kapital salah';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'Senha de capital errada';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }
                    break;
                case 5:
                    if ($lang == 'cn') {
                        $data['code_cn'] = '余额不足';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'Sorry, your credit is running low';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Maaf, kreditmu kehabisan';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '餘額不足';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'माफ़ करें, आपका क्रेडिट कम चल रहा है';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Xin lỗi, tín dụng của anh đang cạn dần';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Saldo insuficiente';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '残高が足りない';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'ขาดสมดุล';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Maaf, kredit awak dah runtuh.';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'Desculpe, SEU crédito está acabando.';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

                    break;
                case 6:

                    if ($lang == 'cn') {
                        $data['code_cn'] = '提现渠道有误';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'Wrong withdrawal channel';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Saluran penarikan salah';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '提現通路有誤';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'गलत प्रतिलिपि चैनल';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Sai kênh rút lui';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Hay un error en el Canal.';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '提現ルートに誤りがあります';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'มีข้อผิดพลาดในการนำเสนอเงินสด';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Saluran penarikan salah';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'Canal de retirada errado';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

                    break;
                case 7:

                    if ($lang == 'cn') {
                        $data['code_cn'] = '提现银行卡有误';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'Incorrect withdrawal bank card';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Kartu bank penarikan yang salah';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '提現銀行卡有誤';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'गलत बैंक कार्ड';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Thẻ rút ngân hàng sai';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Hay un error con la tarjeta bancaria.';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = 'キャッシュカードが間違っています。';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'มีข้อผิดพลาดในการยกบัตรธนาคาร';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Pengunduran kad bank tidak betul';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'Retirada incorreta do cartão bancário';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

                    break;
                case 8:

                    if ($lang == 'cn') {
                        $data['code_cn'] = '提现银行有误';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'There is a mistake in the withdrawal bank';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Ada kesalahan di bank penarikan';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '提現銀行有誤';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'बैंक में एक गलती है';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Có một sự nhầm lẫn ở ngân hàng rút tiền.';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Hay un error en el Banco.';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '現金引き出しの銀行が間違っています';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'มีข้อผิดพลาดในการถอนเงินจากธนาคาร';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Bank penarikan salah.';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'O Banco de retirada está errado.';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

                    break;
                default:

                    if ($lang == 'cn') {
                        $data['code_cn'] = '提现失败';
                    } elseif ($lang == 'en') {
                        $data['code_en'] = 'Withdrawal failed';
                    } elseif ($lang == 'id') {
                        $data['code_id'] = 'Pengunduran gagal';
                    } elseif ($lang == 'ft') {
                        $data['code_ft'] = '提現失敗';
                    } elseif ($lang == 'yd') {
                        $data['code_yd'] = 'वाटडवाल असफल';
                    } elseif ($lang == 'vi') {
                        $data['code_vi'] = 'Rút lui thất bại';
                    } elseif ($lang == 'es') {
                        $data['code_es'] = 'Falla de oferta';
                    } elseif ($lang == 'ja') {
                        $data['code_ja'] = '提示失敗';
                    } elseif ($lang == 'th') {
                        $data['code_th'] = 'ความล้มเหลวในการเสนอเงินสด';
                    } elseif ($lang == 'ma') {
                        $data['code_ma'] = 'Pengunduran wang gagal';
                    } elseif ($lang == 'pt') {
                        $data['code_pt'] = 'A retirada de numerário falhou';
                    } else {
                        return ['code' => 0, 'code_dec' => 'Fail'];
                    }

            }

            if ($lang == 'cn') {
                return ['code' => $data['code'], 'code_dec' => $data['code_cn']];
            } elseif ($lang == 'en') {
                return ['code' => $data['code'], 'code_dec' => $data['code_en']];
            } elseif ($lang == 'id') {
                return ['code' => $data['code'], 'code_dec' => $data['code_id']];
            } elseif ($lang == 'ft') {
                return ['code' => $data['code'], 'code_dec' => $data['code_ft']];
            } elseif ($lang == 'yd') {
                return ['code' => $data['code'], 'code_dec' => $data['code_yd']];
            } elseif ($lang == 'vi') {
                return ['code' => $data['code'], 'code_dec' => $data['code_vi']];
            } elseif ($lang == 'es') {
                return ['code' => $data['code'], 'code_dec' => $data['code_es']];
            } elseif ($lang == 'ja') {
                return ['code' => $data['code'], 'code_dec' => $data['code_ja']];
            } elseif ($lang == 'th') {
                return ['code' => $data['code'], 'code_dec' => $data['code_th']];
            } elseif ($lang == 'ma') {
                return ['code' => $data['code'], 'code_dec' => $data['code_ma']];
            } elseif ($lang == 'pt') {
                return ['code' => $data['code'], 'code_dec' => $data['code_pt']];
            } else {
                return ['code' => 0, 'code_dec' => 'Fail'];
            }
        }


        //获取当天提现次数
        $where[] = ['time', '>=', mktime(0, 0, 0, date('m'), date('d'), date('Y'))];
        $where[] = ['time', '<=', mktime(23, 59, 59, date('m'), date('d'), date('Y'))];
        $where[] = ['uid', '=', $uid];

        $num = $this->where($where)->count();
        if ($num > 9) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '超过当日最大提现次数'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Lebih dari waktu refleksi maksimum hari'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '超過當日最大體現次數'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'दिन के अधिकतम प्रतिरूप के समय से बढ़कर'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Vượt quá thời gian phản xạ tối đa trong ngày'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Número máximo de representaciones'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '当日の最大発現回数を超える'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'มากกว่าจำนวนสูงสุดของวัน'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Melewati masa penarikan maksimum hari'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Excedendo OS prazos máximos de retirada do dia'];
            }
            return ['code' => 0, 'code_dec' => "Exceeding the maximum reflection times of the day"];
        }
        $post['user_bank_id'] = intval($post['user_bank_id']);
        $draw_type = input('post.draw_type/s');
        switch ($draw_type) {
            case 'bank':
                //获取用户绑定银行信息
                $user_bank = model('UserBank')->where('id', $post['user_bank_id'])->find();
                break;
            case 'alipay':
                $Usersinfo = Model('Users')->where('id', $uid)->where('alipay', $post['user_bank_id'])->find();
                $user_bank['card_no'] = $Usersinfo['alipay'];
                $user_bank['name'] = $Usersinfo['alipay_name'];
                $user_bank['bid'] = 0;
                break;
        }
        $htfee = model('Setting')->where('id', 1)->find();
        //手续费 ===v0免手续费
        /*
        if ($grade['vip_level'] == 1) {
            $htfeex = 0;
        } else 
        */
        $htfeex = $htfee['ht_fee'] * $post['draw_money'];
        //提交提现金额减手续费
        $htfeejine = $post['draw_money'] - $htfeex;

        // var_dump($htfeex);
        // die;

        $carry = [];
        $carry['vip_level'] = $grade['vip_level'];
        $carry['uid'] = $uid;
        //$carry['price']			=	$post['draw_money'];
        $carry['price'] = $htfeejine;
        $carry['user_bank_id'] = $post['user_bank_id'];
        $carry['tlog'] = 1;//提现次数
        $carry['bank_source'] = $user_bank['bank_source'];//取款方式
        $carry['card_name'] = $user_bank['name'];//户名
        $carry['card_number'] = $user_bank['card_no'];//卡号
        $carry['card_email'] = $user_bank['email'];//邮箱地址
        $carry['card_mobile'] = $user_bank['mobile'];//手机号码
        $carry['bank_id'] = $user_bank['bid'];//银行ID
        $carry['fee'] = $htfeex;//提现手续费ht_fee
        $carry['time'] = time();
        $carry['order_number'] = trading_number();
        $carry['trade_number'] = trading_number();
        $carry['remarks'] = '尊敬的用户您好！您的编号为' . $carry['order_number'] . ' 的提现处理中，金额￥' . $post['draw_money'] . '元 服务费：' . $htfeex . '元，处理时间：' . date('Y-m-d H:i:s', $carry['time']);
        /*$isinsert = $this->insert($carry);
        if(!$isinsert){
            $data['code'] 		= 0;
            $data['code_dec']	= '提现失败';
            return $data;
        }*/
        //用户余额
        $cbalance = model('UserTotal')->where('uid', $uid)->value('balance');
        //提现金额+手续费
        //$balancejj = $htfeex+$post['draw_money'];
        $balancejj = $post['draw_money'];
        //更新余额
        $map[] = array('uid', '=', $uid);
        $map[] = array('balance', '>=', $balancejj);

        $isupdata = model('UserTotal')->where($map)->setDec('balance', $balancejj);
        if (!$isupdata) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '业务失败'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => "Business failure"];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Kegagalan bisnis'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '業務失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'व्यवसाय असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Lỗi kinh doanh'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Operaciones fallidas'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '業務が失敗する'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ความล้มเหลวทางธุรกิจ'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Gagal perniagaan'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Insuficiência empresarial'];
            }
        }
        $isinsert = $this->insert($carry);
        if (!$isinsert) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '业务失败'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => "Business failure"];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Kegagalan bisnis'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '業務失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'व्यवसाय असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Lỗi kinh doanh'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Operaciones fallidas'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '業務が失敗する'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ความล้มเหลวทางธุรกิจ'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Gagal perniagaan'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Insuficiência empresarial'];
            }
        }
        //添加流水
        $financial_data['uid'] = $uid;
        $financial_data['username'] = $username;
        $financial_data['sid'] = $uid;
        $financial_data['state'] = 3;
        $financial_data['tlog'] = 1;
        $financial_data['order_number'] = $carry['order_number'];
        $financial_data['trade_number'] = $carry['trade_number'];
        $financial_data['trade_type'] = 2;
        $financial_data['trade_before_balance'] = $cbalance;
        $financial_data['trade_amount'] = $post['draw_money'];
        $financial_data['account_balance'] = $cbalance - $post['draw_money'];
        $financial_data['remarks'] = '平台取款';
        $financial_data['vip_level'] = model('Users')->where('id', $uid)->value('vip_level');
        $financial_data['isdaily'] = 2;
        $insert = model('TradeDetails')->tradeDetails($financial_data);
        if (!$insert) {
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '业务失败'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => "Business failure"];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Kegagalan bisnis'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '業務失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'व्यवसाय असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Lỗi kinh doanh'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Operaciones fallidas'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '業務が失敗する'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ความล้มเหลวทางธุรกิจ'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Gagal perniagaan'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Insuficiência empresarial'];
            }
        }
        //提现手续费ht_fee
        $htfee = model('Setting')->where('id', 1)->find();
        $htfeeh = $htfee['ht_fee'] * 100;
        // var_dump($htfeeh);
        // die;
        if ($lang == 'cn') {
            //return ['code' => 1, 'code_dec' => '成功'];
            return ['code' => 1, 'code_dec' => '成功,提现手续费' . $htfeeh . '%'];
        } elseif ($lang == 'en') {
            return ['code' => 1, 'code_dec' => 'Success'];
        } elseif ($lang == 'id') {
            return ['code' => 1, 'code_dec' => 'sukses'];
        } elseif ($lang == 'ft') {
            return ['code' => 1, 'code_dec' => '成功'];
        } elseif ($lang == 'yd') {
            return ['code' => 1, 'code_dec' => 'सफलता'];
        } elseif ($lang == 'vi') {
            return ['code' => 1, 'code_dec' => 'thành công'];
        } elseif ($lang == 'es') {
            return ['code' => 1, 'code_dec' => 'éxito'];
        } elseif ($lang == 'ja') {
            return ['code' => 1, 'code_dec' => '成功'];
        } elseif ($lang == 'th') {
            return ['code' => 1, 'code_dec' => 'ประสบความสำเร็จ'];
        } elseif ($lang == 'ma') {
            return ['code' => 1, 'code_dec' => 'sukses'];
        } elseif ($lang == 'pt') {
            return ['code' => 1, 'code_dec' => 'SUCESSO，Taxa de retirada' . $htfeeh . '%'];
        } else {
            return ['code' => 1, 'code_dec' => 'success'];
        }

    }

    /**
     * 提现记录
     */
    public function getUserWithdrawalsList()
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

        $where[] = array('uid', '=', $uid);

        //状态
        if (isset($param['state']) and $param['state']) {
            $where[] = array('state', '=', $param['state']);
        }
        /*//开始时间
        if (isset($param['search_time_s']) and $param['search_time_s']) {
            $where[] = array('time','>=',strtotime($param['search_time_s']));
        } else {
            $where[] = array('time','>=',mktime(0,0,0,date('m'),date('d'),date('Y')));
        }
        //结束时间
        if (isset($param['search_time_e']) and $param['search_time_e']) {
            $where[] = array('time','<=',strtotime($param['search_time_e']));
        } else {
            $where[] = array('time','<=',mktime(23,59,59,date('m'),date('d'),date('Y')));
        }*/

        //分页
        //总记录数
        $count = $this->where($where)->count();
        if (!$count) {
            $data['code'] = 0;
            if ($lang == 'cn') {
                $data['code_dec'] = '暂无记录';
            } elseif ($lang == 'en') {
                $data['code_dec'] = 'No record';
            } elseif ($lang == 'id') {
                $data['code_dec'] = 'Tidak ada catatan';
            } elseif ($lang == 'ft') {
                $data['code_dec'] = '暫無記錄';
            } elseif ($lang == 'yd') {
                $data['code_dec'] = 'कोई रिकार्ड नहीं';
            } elseif ($lang == 'vi') {
                $data['code_dec'] = 'Không ghi âm';
            } elseif ($lang == 'es') {
                $data['code_dec'] = 'Sin registro';
            } elseif ($lang == 'ja') {
                $data['code_dec'] = '記録がない';
            } elseif ($lang == 'th') {
                $data['code_dec'] = 'ไม่มีบันทึก';
            } elseif ($lang == 'ma') {
                $data['code_dec'] = 'No record';
            } elseif ($lang == 'pt') {
                $data['code_dec'] = 'Sem Registro';
            }

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

        $dataAll = $this->where($where)
            ->order(['time' => 'desc', 'id' => 'desc'])
            ->limit($limitOffset, $pageSize)
            ->select();

        if (!$dataAll) {
            $data['code'] = 0;
            if ($lang == 'cn') {
                $data['code_dec'] = '暂无记录';
            } elseif ($lang == 'en') {
                $data['code_dec'] = 'No record';
            } elseif ($lang == 'id') {
                $data['code_dec'] = 'Tidak ada catatan';
            } elseif ($lang == 'ft') {
                $data['code_dec'] = '暫無記錄';
            } elseif ($lang == 'yd') {
                $data['code_dec'] = 'कोई रिकार्ड नहीं';
            } elseif ($lang == 'vi') {
                $data['code_dec'] = 'Không ghi âm';
            } elseif ($lang == 'es') {
                $data['code_dec'] = 'Sin registro';
            } elseif ($lang == 'ja') {
                $data['code_dec'] = '記録がない';
            } elseif ($lang == 'th') {
                $data['code_dec'] = 'ไม่มีบันทึก';
            } elseif ($lang == 'ma') {
                $data['code_dec'] = 'No record';
            } elseif ($lang == 'pt') {
                $data['code_dec'] = 'Sem Registro';
            }
            return $data;
        }

        //获取成功
        $data['code'] = 1;
        $data['data_total_nums'] = $count;
        $data['data_total_page'] = $pageTotal;
        $data['data_current_page'] = $pageNo;

        //数组重组赋值
        foreach ($dataAll as $key => $value) {
            $rmoney = 0;
            if ($value['state'] == 1 || $value['state'] == 6) {
                $rmoney = $value['price'];
            }
            $data['info'][$key]['dan'] = $value['order_number'];
            $data['info'][$key]['adddate'] = date('Y-m-d H:i:s', $value['time']);
            $data['info'][$key]['real_name'] = mb_substr($value['card_name'], 0, 1, "utf-8") . '**';
            $data['info'][$key]['bank_no_tail'] = substr_replace($value['card_number'], '*************', 0, -4);
            $data['info'][$key]['money'] = $value['price'];
            $data['info'][$key]['rmoney'] = $rmoney;//($value['state'] == 1) ? $value['price'] : 0;

            if ($lang == 'cn') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsState')[$value['state']];
            } elseif ($lang == 'en') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateen')[$value['state']];
            } elseif ($lang == 'id') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateid')[$value['state']];
            } elseif ($lang == 'ft') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateft')[$value['state']];
            } elseif ($lang == 'yd') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateyd')[$value['state']];
            } elseif ($lang == 'vi') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStatevi')[$value['state']];
            } elseif ($lang == 'es') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStatees')[$value['state']];
            } elseif ($lang == 'ja') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateja')[$value['state']];
            } elseif ($lang == 'th') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStateth')[$value['state']];
            } elseif ($lang == 'ma') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStatema')[$value['state']];
            } elseif ($lang == 'pt') {
                $data['info'][$key]['status_desc'] = config('custom.withdrawalsStatept')[$value['state']];
            }


            $data['info'][$key]['remark'] = $value['remarks'];
            $data['info'][$key]['typedes'] = '提现';
        }

        return $data;
    }

    /**
     * 团队提现
     */
    public function teamWithdrawals()
    {
        //获取参数并过滤
        $param = input('param.');
        $param['user_id'] = input('param.user_id/d');

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
            $where[] = array('ly_user_withdrawals.state', '=', $param['state']);
        }
        //开始时间
        if (isset($param['search_time_s']) and $param['search_time_s']) {
            $where[] = array('time', '>=', strtotime($param['search_time_s']));
        } else {
            $where[] = array('time', '>=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        }
        //结束时间
        if (isset($param['search_time_e']) and $param['search_time_e']) {
            $where[] = array('time', '<=', strtotime($param['search_time_e']));
        } else {
            $where[] = array('time', '<=', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
        }

        //分页
        //总记录数
        $count = $this->join('users', 'ly_user_withdrawals.uid = users.id')->join('user_team', 'ly_user_withdrawals.uid = user_team.team')->where($where)->count();
        //每页记录数
        $pageSize = (isset($param['page_size']) and $param['page_size']) ? $param['page_size'] : 10;
        //当前页
        $pageNo = (isset($param['page_no']) and $param['page_no']) ? $param['page_no'] : 1;
        //总页数
        $pageTotal = ceil($count / $pageSize); //当前页数大于最后页数，取最后
        //偏移量
        $limitOffset = ($pageNo - 1) * $pageSize;

        //数据
        $dataArray = $this->field('ly_user_withdrawals.*,users.username')
            ->join('users', 'ly_user_withdrawals.uid = users.id')
            ->join('user_team', 'ly_user_withdrawals.uid = user_team.team')
            ->where($where)
            ->order('time', 'desc')
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
            $rmoney = 0;
            if ($value['state'] == 1 || $value['state'] == 6) {
                $rmoney = $value['price'];
            }
            $value['fee'] = round($value['fee'], $decimalPlace);
            $value['price'] = round($value['price'], $decimalPlace);
            $rmoney = round($rmoney, $decimalPlace);
            $data['info'][$key]['dan'] = $value['order_number'];
            $data['info'][$key]['adddate'] = date('Y-m-d H:i:s', $value['time']);
            $data['info'][$key]['username'] = $value['username'];
            $data['info'][$key]['real_name'] = mb_substr($value['card_name'], 0, 1, "utf-8") . '**';
            $data['info'][$key]['fee'] = $value['fee'];
            $data['info'][$key]['bank_no_tail'] = substr_replace($value['card_number'], '*******************', 0, -4);
            $data['info'][$key]['money'] = $value['price'];
            $data['info'][$key]['rmoney'] = $rmoney;//($value['state'] == 1) ? $value['price'] : 0;
            $data['info'][$key]['status_desc'] = config('custom.withdrawalsState')[$value['state']];
            $data['info'][$key]['remarks'] = $value['remarks'];
        }

        return $data;
    }
}
