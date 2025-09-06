<?php

namespace app\api\model;

use think\Model;

class UserBankModel extends Model
{
    protected $table = 'ly_user_bank';

    /** 添加银行卡 **/
    public function addBankCard()
    {
        //获取参数	token、name、card_no、bank_name、bank_branch_name
        $post = input('post.');

        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        $name = input('post.name/s');            // 持卡人姓名
        $card_no = input('post.card_no/s');        // 银行卡账号
        $mobile = input('post.mobile/s');            // 手机号码
        $email = input('post.email/s');            // 邮箱地址
        $bank_name = input('post.bank_name/s');    // 银行名称
        //$bank_name = 'BT';    // 银行名称
        $bank_id = input('post.bank_id/s');    // 银行名称bid=3656
        //	$bank_branch_name	= input('post.bank_branch_name/s');	// 支行名称
        $remark = input('post.remark/s');            // 备注
        $bank_clabe = input('post.bank_clabe/s');            // 备注
        $bank_code = input('post.bank_code/s');            // 银行代码
        $bank_source = input('post.bank_source/s');            // 出款渠道

        $card_no = strip_tags(trim($card_no));
        $mobile = strip_tags(trim($mobile));
        $name = strip_tags(trim($name));
        $email = strip_tags(trim($email));
        $bank_name = strip_tags(trim($bank_name));
        $bank_code = strip_tags(trim($bank_code));
        $remark = strip_tags(trim($remark));
        /* 数据验证 */
        if (empty($name)) {
            if ($lang == 'cn') {
                return ['code' => 2, 'code_dec' => '持卡人姓名为空'];
            } elseif ($lang == 'id') {
                return ['code' => 2, 'code_dec' => 'Nama pemegang kartu kosong'];
            } elseif ($lang == 'ft') {
                return ['code' => 2, 'code_dec' => '持卡人姓名為空'];
            } elseif ($lang == 'yd') {
                return ['code' => 2, 'code_dec' => 'कार्ड होल्डर नाम खाली है'];
            } elseif ($lang == 'vi') {
                return ['code' => 2, 'code_dec' => 'Tên chủ thẻ rỗng'];
            } elseif ($lang == 'es') {
                return ['code' => 2, 'code_dec' => 'El nombre del titular está vacío.'];
            } elseif ($lang == 'ja') {
                return ['code' => 2, 'code_dec' => 'カードを持っている人の名前は空です。'];
            } elseif ($lang == 'th') {
                return ['code' => 2, 'code_dec' => 'ชื่อผู้ถือบัตรว่างเปล่า'];
            } elseif ($lang == 'ma') {
                return ['code' => 2, 'code_dec' => 'Nama pemegang kad kosong'];
            } elseif ($lang == 'pt') {
                return ['code' => 2, 'code_dec' => 'Nome do titular está vazio'];
            }
            return ['code' => 2, 'code_dec' => 'Cardholder name is empty'];
        }
        if (empty($card_no)) {
            if ($lang == 'cn') {
                return ['code' => 2, 'code_dec' => '银行卡账号为空'];
            } elseif ($lang == 'id') {
                return ['code' => 2, 'code_dec' => 'Nomor rekening kartu bank kosong'];
            } elseif ($lang == 'ft') {
                return ['code' => 2, 'code_dec' => '銀行卡帳號為空'];
            } elseif ($lang == 'yd') {
                return ['code' => 2, 'code_dec' => 'बैंक कार्ड खाता संख्या खाली है'];
            } elseif ($lang == 'vi') {
                return ['code' => 2, 'code_dec' => 'Số thẻ ngân hàng là rỗng'];
            } elseif ($lang == 'es') {
                return ['code' => 2, 'code_dec' => 'La cuenta bancaria está vacía.'];
            } elseif ($lang == 'ja') {
                return ['code' => 2, 'code_dec' => '銀行カードのアカウントが空です。'];
            } elseif ($lang == 'th') {
                return ['code' => 2, 'code_dec' => 'บัญชีธนาคารว่างเปล่า'];
            } elseif ($lang == 'ma') {
                return ['code' => 2, 'code_dec' => 'Nombor akaun kad bank kosong'];
            } elseif ($lang == 'pt') {
                return ['code' => 2, 'code_dec' => 'O número Da conta do cartão está vazio'];
            }
            return ['code' => 2, 'code_dec' => 'Bank card account number is empty'];
        }
        if (empty($bank_name)) {
            if ($lang == 'cn') {
                return ['code' => 2, 'code_dec' => '银行名称为空'];
            } elseif ($lang == 'id') {
                return ['code' => 2, 'code_dec' => 'Nama bank kosong'];
            } elseif ($lang == 'ft') {
                return ['code' => 2, 'code_dec' => '銀行名稱為空'];
            } elseif ($lang == 'yd') {
                return ['code' => 2, 'code_dec' => 'बैंक नाम खाली है'];
            } elseif ($lang == 'vi') {
                return ['code' => 2, 'code_dec' => 'Tên ngân hàng rỗng'];
            } elseif ($lang == 'es') {
                return ['code' => 2, 'code_dec' => 'Nombre del Banco'];
            } elseif ($lang == 'ja') {
                return ['code' => 2, 'code_dec' => '銀行の名前は空です'];
            } elseif ($lang == 'th') {
                return ['code' => 2, 'code_dec' => 'ชื่อธนาคารว่างเปล่า'];
            } elseif ($lang == 'ma') {
                return ['code' => 2, 'code_dec' => 'Nama bank kosong'];
            } elseif ($lang == 'pt') {
                return ['code' => 2, 'code_dec' => 'O Nome do Banco está vazio.'];
            }
            return ['code' => 2, 'code_dec' => 'Bank name is empty'];
        }
        //	if(empty($bank_branch_name))	return ['code' => 2, 'code_dec'	=> '支行名称为空'];
        if (empty($remark)) $remark = '';
        //实名信息
        $realname = Model('Users')->where('id', $uid)->value('realname');
        if ($realname) {
            if ($name != $realname) {
                $data['code'] = 0;
                if ($lang == 'cn') {
                    $data['code_dec'] = '银行卡姓名与实名信息不一致,请重新输入';
                } elseif ($lang == 'id') {
                    $data['code_dec'] = 'Nama kartu bank dan informasi nama asli tidak konsisten, silakan masukkan kembali';
                } elseif ($lang == 'ft') {
                    $data['code_dec'] = '銀行卡姓名與實名資訊不一致，請重新輸入';
                } elseif ($lang == 'yd') {
                    $data['code_dec'] = 'बैंक कार्ड नाम और वास्तविक नाम जानकारी संस्थित नहीं हैं, कृपया फिर प्रविष्ट करें';
                } elseif ($lang == 'vi') {
                    $data['code_dec'] = 'Tên thẻ ngân hàng và tên thật không khớp, xin nhập lại';
                } elseif ($lang == 'es') {
                    $data['code_dec'] = 'El nombre de la tarjeta no coincide con el nombre real.';
                } elseif ($lang == 'ja') {
                    $data['code_dec'] = '銀行カードの名前と実名情報が一致しないので、もう一度入力してください。';
                } elseif ($lang == 'th') {
                    $data['code_dec'] = 'ชื่อบัตรไม่ตรงกับชื่อจริงกรุณาพิมพ์อีกครั้ง';
                } elseif ($lang == 'ma') {
                    $data['code_dec'] = 'Nama kad bank tidak konsisten dengan maklumat nama sebenar, sila masukkan semula';
                } elseif ($lang == 'pt') {
                    $data['code_dec'] = 'O Nome do cartão bancário é inconsistente com a informação do Nome real, por favor re-digite';
                } else {
                    $data['code_dec'] = 'Bank card name and real name information are inconsistent, please re-enter';
                }
                return $data;
            }
        } else {
            //更新用户名
            model('Users')->where('id', $uid)->update(array('realname' => $name));
        }

        // 防止银行卡重复使用==不是自己的情况下
        $bankcard_account = $this->where([
            'card_no' => $card_no,
            'uid' => ['!=', $uid]
        ])->find();
        if ($bankcard_account) {
            if ($lang == 'cn') {
                return ['code' => 4, 'code_dec' => '卡号已绑定'];
            } elseif ($lang == 'id') {
                return ['code' => 4, 'code_dec' => 'Nomor kartu terikat'];
            } elseif ($lang == 'ft') {
                return ['code' => 4, 'code_dec' => '卡號已綁定'];
            } elseif ($lang == 'yd') {
                return ['code' => 4, 'code_dec' => 'कार्ड संख्या बाइंड है'];
            } elseif ($lang == 'vi') {
                return ['code' => 4, 'code_dec' => 'Số thẻ bị ràng buộc'];
            } elseif ($lang == 'es') {
                return ['code' => 4, 'code_dec' => 'La tarjeta está atada.'];
            } elseif ($lang == 'ja') {
                return ['code' => 4, 'code_dec' => 'カード番号がバインドされています'];
            } elseif ($lang == 'th') {
                return ['code' => 4, 'code_dec' => 'หมายเลขบัตรถูกผูกไว้'];
            } elseif ($lang == 'ma') {
                return ['code' => 4, 'code_dec' => 'Nombor kad diikat'];
            } elseif ($lang == 'pt') {
                return ['code' => 4, 'code_dec' => 'Número do cartão limitado'];
            }
            return ['code' => 4, 'code_dec' => 'Card number is bound'];
        }

        // 绑定新增银行卡
        $bankCard_arr = array(
            'uid' => $uid,
            'name' => $name,        // 持卡人姓名
            'bid' => $bank_id,
            'card_no' => $card_no,    // 银行卡卡号
            'bank_name' => $bank_name,            // 银行名称
            'bank_clabe' => $bank_clabe,            // 银行名称
            'bank_code' => $bank_code,            // 银行代码
            'bank_source' => $bank_source,            //出款渠道
            'mobile' => $mobile,    // 手机号码
            'email' => $email,    // 邮箱地址
            //	'bank_branch_name'	=> $bank_branch_name,	// 支行名称
            'remark' => $remark,    // 备注
            'add_time' => time(),
        );
        $insert_ok = $this->insert($bankCard_arr);
        if (!$insert_ok)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '银行卡添加失败'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Failed to add bank card'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Gagal menambah kartu bank'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '銀行卡添加失敗'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'बैंक कार्ड जोड़ने में असफल'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Lỗi thêm thẻ ngân hàng'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Error al añadir una tarjeta bancaria'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '銀行カードの追加に失敗しました。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ความล้มเหลวในการเพิ่มบัตรธนาคาร'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Gagal menambah kad bank'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Falha Ao adicionar cartão bancário'];
            }


        if ($lang == 'cn') {
            return ['code' => 1, 'code_dec' => '银行卡添加成功'];
        } elseif ($lang == 'en') {
            return ['code' => 1, 'code_dec' => 'Bank card added successfully'];
        } elseif ($lang == 'id') {
            return ['code' => 1, 'code_dec' => 'Kartu bank ditambah dengan sukses'];
        } elseif ($lang == 'ft') {
            return ['code' => 1, 'code_dec' => '銀行卡添加成功'];
        } elseif ($lang == 'yd') {
            return ['code' => 1, 'code_dec' => 'बैंक कार्ड सफलतापूर्वक जोड़ा'];
        } elseif ($lang == 'vi') {
            return ['code' => 1, 'code_dec' => 'Thẻ ngân hàng thêm thành công'];
        } elseif ($lang == 'es') {
            return ['code' => 1, 'code_dec' => 'Añadir tarjeta bancaria'];
        } elseif ($lang == 'ja') {
            return ['code' => 1, 'code_dec' => '銀行カードの追加に成功しました。'];
        } elseif ($lang == 'th') {
            return ['code' => 1, 'code_dec' => 'บัตรธนาคารเพิ่มเรียบร้อยแล้ว'];
        } elseif ($lang == 'ma') {
            return ['code' => 1, 'code_dec' => 'Kad bank ditambah dengan berjaya'];
        } elseif ($lang == 'pt') {
            return ['code' => 1, 'code_dec' => 'Cartão bancário Adicionado com SUCESSO'];
        }
    }


    /** 获取银行卡列表 **/
    public function getBankCardList()
    {
        // 获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        // 获取数据
        $bankCard_arr = $this->where('uid', $uid)->where('status', 1)->order('id desc')->select()->toArray();

        if (!count($bankCard_arr))
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '没有绑定的银行卡'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'There is no bound bank card'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada kartu bank terikat'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '沒有綁定的銀行卡'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई बाइंड बैंक कार्ड नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có thẻ ngân hàng bị ràng buộc'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Sin tarjeta bancaria vinculada.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'バインディングされた銀行カードがありません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่ผูกบัตรธนาคาร'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Kad bank tidak terikat'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Cartão bancário não consolidado'];
            }


        // 返回数组
        $data['code'] = 1;
        foreach ($bankCard_arr as $key => $value) {
            $data['data'][$key]['id'] = $value['id'];
            $data['data'][$key]['card_no'] = $value['card_no'];        // 银行卡账号
            $data['data'][$key]['bank_name'] = $value['bank_name'];        // 银行名称
            $data['data'][$key]['bank_branch_name'] = $value['bank_branch_name'];        // 支行名称
            $data['data'][$key]['name'] = $value['name'];            // 持卡人姓名
            $data['data'][$key]['remark'] = $value['remark'];            // 备注
        }

        return $data;
    }


    /** 获取银行卡信息 **/
    public function getBankCardInfo()
    {
        // 获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];
        $card_no = input('post.card_no/d', '', 'strip_tags,trim');    // 银行卡号
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        // 获取数据
        $bankCardInfo = $this->where(['uid' => $uid, 'card_no' => $card_no])->find();
        if (!$bankCardInfo)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '没有绑定的银行卡'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'There is no bound bank card'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Tidak ada kartu bank terikat'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '沒有綁定的銀行卡'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'कोई बाइंड बैंक कार्ड नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Không có thẻ ngân hàng bị ràng buộc'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'Sin tarjeta bancaria vinculada.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => 'バインディングされた銀行カードがありません。'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'ไม่ผูกบัตรธนาคาร'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Kad bank tidak terikat'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'Cartão bancário não consolidado'];
            }

        // 返回数组
        $data['data']['id'] = $bankCardInfo['id'];
        $data['data']['card_no'] = $bankCardInfo['card_no'];    // 银行卡账号
        $data['data']['bank_name'] = model('Bank')->where('id', $bankCardInfo['bid'])->value('bank_name');    // 银行名称
        $data['data']['bank_branch_name'] = $bankCardInfo['bank_branch_name'];    // 支行名称
        $data['data']['name'] = $bankCardInfo['name'];        // 持卡人姓名
        $data['data']['remark'] = $bankCardInfo['remark'];        // 备注
        $data['data']['status'] = $bankCardInfo['status'];        // 银行卡状态：1=正常；2=锁定；3=删除

        return $data;
    }


    /**  修改银行卡信息     **/
    public function changeBankCardInfo()
    {
        ///获取参数
        $token = input('post.token/s');
        $userArr = explode(',', auth_code($token, 'DECODE'));
        $uid = $userArr[0];
        $card_no = input('post.card_no/d', '', 'strip_tags,trim');    // 银行卡号
        $act = input('post.action/d');    // 银行卡修改操作
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        //获取数据
        $bankCardId = $this->where(['uid' => $uid, 'card_no' => $card_no])->value('id');
        if (!$bankCardId)
            if ($lang == 'cn') {
                return ['code' => 0, 'code_dec' => '银行卡不存在'];
            } elseif ($lang == 'en') {
                return ['code' => 0, 'code_dec' => 'Bank card does not exist'];
            } elseif ($lang == 'id') {
                return ['code' => 0, 'code_dec' => 'Kartu bank tidak ada'];
            } elseif ($lang == 'ft') {
                return ['code' => 0, 'code_dec' => '銀行卡不存在'];
            } elseif ($lang == 'yd') {
                return ['code' => 0, 'code_dec' => 'बैंक कार्ड मौजूद नहीं है'];
            } elseif ($lang == 'vi') {
                return ['code' => 0, 'code_dec' => 'Thẻ ngân hàng không có'];
            } elseif ($lang == 'es') {
                return ['code' => 0, 'code_dec' => 'La tarjeta bancaria no existe.'];
            } elseif ($lang == 'ja') {
                return ['code' => 0, 'code_dec' => '銀行カードは存在しません'];
            } elseif ($lang == 'th') {
                return ['code' => 0, 'code_dec' => 'บัตรธนาคารไม่มี'];
            } elseif ($lang == 'ma') {
                return ['code' => 0, 'code_dec' => 'Bank card does not exist'];
            } elseif ($lang == 'pt') {
                return ['code' => 0, 'code_dec' => 'O cartão bancário não existe'];
            }


        switch ($act) {
            case '1':    // 银行卡删除
                $isDel_bankInfo = $this->where('id', $bankCardId)->update(['status' => 3]);

                if (!$isDel_bankInfo)
                    if ($lang == 'cn') {
                        return ['code' => 0, 'code_dec' => '删除失败'];
                    } elseif ($lang == 'en') {
                        return ['code' => 0, 'code_dec' => 'Deletion failed'];
                    } elseif ($lang == 'id') {
                        return ['code' => 0, 'code_dec' => 'Penghapusan gagal'];
                    } elseif ($lang == 'ft') {
                        return ['code' => 0, 'code_dec' => '删除失敗'];
                    } elseif ($lang == 'yd') {
                        return ['code' => 0, 'code_dec' => 'मिटाना असफल'];
                    } elseif ($lang == 'vi') {
                        return ['code' => 0, 'code_dec' => 'Lỗi xóa'];
                    } elseif ($lang == 'es') {
                        return ['code' => 0, 'code_dec' => 'Error al borrar'];
                    } elseif ($lang == 'ja') {
                        return ['code' => 0, 'code_dec' => '削除に失敗しました'];
                    } elseif ($lang == 'th') {
                        return ['code' => 0, 'code_dec' => 'ลบล้มเหลว'];
                    } elseif ($lang == 'ma') {
                        return ['code' => 0, 'code_dec' => 'Padam gagal'];
                    } elseif ($lang == 'pt') {
                        return ['code' => 0, 'code_dec' => 'A remoção falhou'];
                    }
                if ($lang == 'cn') {
                    return ['code' => 1, 'code_dec' => '删除成功'];
                } elseif ($lang == 'en') {
                    return ['code' => 1, 'code_dec' => 'Deletion succeeded'];
                } elseif ($lang == 'id') {
                    return ['code' => 1, 'code_dec' => 'Penghapusan berhasil'];
                } elseif ($lang == 'ft') {
                    return ['code' => 1, 'code_dec' => '删除成功'];
                } elseif ($lang == 'yd') {
                    return ['code' => 1, 'code_dec' => 'मिटाना सफल'];
                } elseif ($lang == 'vi') {
                    return ['code' => 1, 'code_dec' => 'Xoá thành công'];
                } elseif ($lang == 'es') {
                    return ['code' => 1, 'code_dec' => 'Borrar éxito'];
                } elseif ($lang == 'ja') {
                    return ['code' => 1, 'code_dec' => '削除に成功しました'];
                } elseif ($lang == 'th') {
                    return ['code' => 1, 'code_dec' => 'ลบสำเร็จ'];
                } elseif ($lang == 'ma') {
                    return ['code' => 1, 'code_dec' => 'Padam dengan berjaya'];
                } elseif ($lang == 'pt') {
                    return ['code' => 1, 'code_dec' => 'Suprimido com SUCESSO'];
                }


                break;
            case '2':    // 银行卡锁定
                $isLocking = $this->where('id', $bankCardId)->update(['status' => 2]);

                if (!$isLocking)
                    if ($lang == 'cn') {
                        return ['code' => 0, 'code_dec' => '锁定失败'];
                    } elseif ($lang == 'en') {
                        return ['code' => 0, 'code_dec' => 'lock failed'];
                    } elseif ($lang == 'id') {
                        return ['code' => 0, 'code_dec' => 'kunci gagal'];
                    } elseif ($lang == 'ft') {
                        return ['code' => 0, 'code_dec' => '鎖定失敗'];
                    } elseif ($lang == 'yd') {
                        return ['code' => 0, 'code_dec' => 'तालाबंद असफल'];
                    } elseif ($lang == 'vi') {
                        return ['code' => 0, 'code_dec' => 'khoá bị lỗi'];
                    } elseif ($lang == 'es') {
                        return ['code' => 0, 'code_dec' => 'Bloqueo fallido.'];
                    } elseif ($lang == 'ja') {
                        return ['code' => 0, 'code_dec' => 'ロック失敗'];
                    } elseif ($lang == 'th') {
                        return ['code' => 0, 'code_dec' => 'ล็อคล้มเหลว'];
                    } elseif ($lang == 'ma') {
                        return ['code' => 0, 'code_dec' => 'kunci gagal'];
                    } elseif ($lang == 'pt') {
                        return ['code' => 0, 'code_dec' => 'Bloqueio falhou'];
                    }
                if ($lang == 'cn') {
                    return ['code' => 1, 'code_dec' => '银行卡锁定成功'];
                } elseif ($lang == 'en') {
                    return ['code' => 1, 'code_dec' => 'Bank card locked successfully'];
                } elseif ($lang == 'id') {
                    return ['code' => 1, 'code_dec' => 'Kartu bank terkunci dengan sukses'];
                } elseif ($lang == 'ft') {
                    return ['code' => 1, 'code_dec' => '銀行卡鎖定成功'];
                } elseif ($lang == 'yd') {
                    return ['code' => 1, 'code_dec' => 'बैंक कार्ड सफलतापूर्वक ताला लगाया गया'];
                } elseif ($lang == 'vi') {
                    return ['code' => 1, 'code_dec' => 'Thẻ ngân hàng khoá thành công'];
                } elseif ($lang == 'es') {
                    return ['code' => 1, 'code_dec' => 'Tarjeta bancaria bloqueada.'];
                } elseif ($lang == 'ja') {
                    return ['code' => 1, 'code_dec' => '銀行カードのロックに成功しました。'];
                } elseif ($lang == 'th') {
                    return ['code' => 1, 'code_dec' => 'ล็อคบัตรสำเร็จ'];
                } elseif ($lang == 'ma') {
                    return ['code' => 1, 'code_dec' => 'Kad bank terkunci dengan berjaya'];
                } elseif ($lang == 'pt') {
                    return ['code' => 1, 'code_dec' => 'Cartão bancário bloqueado com SUCESSO'];
                }


                break;
            case '3':    // 银行卡解锁
                $isUnlocking = $this->where('id', $bankCardId)->update(['status' => 1]);

                if (!$isUnlocking)
                    if ($lang == 'cn') {
                        return ['code' => 0, 'code_dec' => '解锁失败'];
                    } elseif ($lang == 'en') {
                        return ['code' => 0, 'code_dec' => 'Unlock failed'];
                    } elseif ($lang == 'id') {
                        return ['code' => 0, 'code_dec' => 'Buka kunci gagal'];
                    } elseif ($lang == 'ft') {
                        return ['code' => 0, 'code_dec' => '解鎖失敗'];
                    } elseif ($lang == 'yd') {
                        return ['code' => 0, 'code_dec' => 'अनलाक असफल'];
                    } elseif ($lang == 'vi') {
                        return ['code' => 0, 'code_dec' => 'Lỗi bỏ khoá'];
                    } elseif ($lang == 'es') {
                        return ['code' => 0, 'code_dec' => 'Fallo de desbloqueo'];
                    } elseif ($lang == 'ja') {
                        return ['code' => 0, 'code_dec' => 'ロック解除に失敗しました'];
                    } elseif ($lang == 'th') {
                        return ['code' => 0, 'code_dec' => 'ปลดล็อคความล้มเหลว'];
                    } elseif ($lang == 'ma') {
                        return ['code' => 0, 'code_dec' => 'Nyahkunci gagal'];
                    } elseif ($lang == 'pt') {
                        return ['code' => 0, 'code_dec' => 'Desbloqueio falhou'];
                    }
                if ($lang == 'cn') {
                    return ['code' => 1, 'code_dec' => '银行卡解锁成功'];
                } elseif ($lang == 'en') {
                    return ['code' => 1, 'code_dec' => 'Bank card unlocked successfully'];
                } elseif ($lang == 'id') {
                    return ['code' => 1, 'code_dec' => 'Kartu bank tidak terkunci dengan sukses'];
                } elseif ($lang == 'ft') {
                    return ['code' => 1, 'code_dec' => '銀行卡解鎖成功'];
                } elseif ($lang == 'yd') {
                    return ['code' => 1, 'code_dec' => 'बैंक कार्ड सफलतापूर्वक खोला गया'];
                } elseif ($lang == 'vi') {
                    return ['code' => 1, 'code_dec' => 'Thẻ ngân hàng đã mở thành công'];
                } elseif ($lang == 'es') {
                    return ['code' => 1, 'code_dec' => 'Tarjeta bancaria desbloqueada.'];
                } elseif ($lang == 'ja') {
                    return ['code' => 1, 'code_dec' => '銀行カードのロック解除に成功しました。'];
                } elseif ($lang == 'th') {
                    return ['code' => 1, 'code_dec' => 'บัตรธนาคารปลดล็อคเรียบร้อยแล้ว'];
                } elseif ($lang == 'ma') {
                    return ['code' => 1, 'code_dec' => 'Kad bank dibuka dengan berjaya'];
                } elseif ($lang == 'pt') {
                    return ['code' => 1, 'code_dec' => 'Cartão do Banco desbloqueado com SUCESSO'];
                }


                break;
        }
    }
}
