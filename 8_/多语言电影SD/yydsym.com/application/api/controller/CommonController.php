<?php

namespace app\api\controller;

use think\Cache;

use app\api\controller\BaseController;


class CommonController extends BaseController
{
    //获取平台共用数据
    public function BackData()
    {
        if (!$this->request->isPost()) return $this->error('error');
        $param = input('param.');
        $lang = isset($param['lang']) && $param['lang'] ? $param['lang'] : 'id';
        //网站公告
        $noticelist = model('Notice')->where(array(['state', '=', 1], ['lang', '=', $lang]))->order('add_time', 'desc')->select()->toArray();
        $data = [];
        $k = $l = $j = $s = $p = $a = 0;
        $data['info']['noticelist'] = [];
        $data['info']['helpList'] = [];
        $data['info']['videovTutorial'] = [];
        $data['info']['serviceList'] = [];
        $data['info']['about'] = [];
        foreach ($noticelist as $key => $value) {
            switch ($value['gropid']) {
                case 1:
                    $data['info']['noticelist'][$k]['id'] = $value['id'];
                    $data['info']['noticelist'][$k]['title'] = $value['title'];
                    $data['info']['noticelist'][$k]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['noticelist'][$k]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    ++$k;
                    break;
                case 2:
                    $data['info']['helpList'][$l]['id'] = $value['id'];
                    $data['info']['helpList'][$l]['title'] = $value['title'];
                    $data['info']['helpList'][$l]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['helpList'][$l]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    ++$l;
                    break;
                case 3:
                    $data['info']['videovTutorial'][$j]['id'] = $value['id'];
                    $data['info']['videovTutorial'][$j]['title'] = $value['title'];
                    $data['info']['videovTutorial'][$j]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['videovTutorial'][$j]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    ++$j;
                    break;
                case 4:
                    $data['info']['serviceList'][$s]['id'] = $value['id'];
                    $data['info']['serviceList'][$s]['title'] = $value['title'];
                    $data['info']['serviceList'][$s]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['serviceList'][$s]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    $data['info']['serviceList'][$s]['url'] = $value['url'];
                    $data['info']['serviceList'][$s]['cover_img'] = $value['cover_img'];
                    ++$s;
                    break;
                case 7:
                    $data['info']['about'][$p]['id'] = $value['id'];
                    $data['info']['about'][$p]['title'] = $value['title'];
                    $data['info']['about'][$p]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['about'][$p]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    $data['info']['about'][$p]['url'] = $value['url'];
                    $data['info']['about'][$p]['cover_img'] = $value['cover_img'];
                    ++$p;
                    break;
                case 9:
                    $data['info']['activeList'][$a]['id'] = $value['id'];
                    $data['info']['activeList'][$a]['title'] = $value['title'];
                    $data['info']['activeList'][$a]['content'] = htmlspecialchars_decode($value['content']);
                    $data['info']['activeList'][$a]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    $data['info']['activeList'][$a]['url'] = $value['url'];
                    $data['info']['activeList'][$a]['cover_img'] = $value['cover_img'];
                    ++$a;
                    break;
            }
        }
        $headData = ['head_1.png', 'head_2.png', 'head_3.png', 'head_4.png', 'head_5.png', 'head_6.png', 'head_7.png', 'head_8.png', 'head_9.png', 'head_10.png'];
        $usernameData = ['130', '131', '132', '133', '134', '135', '136', '137', '138', '139', '145', '146', '147', '150', '151', '152', '153', '155', '156', '157', '158', '159', '162', '165', '166'];
        // 最新播报
        //	$UserVipData	= model('UserVip')->where(array(['etime','>=',strtotime(date("Y-m-d",time()))],['state','=',1]))->order('etime','DESC')->limit(10)->select()->toArray();
        $UserVipData = model('UserIndex')->where(array(['trade_type', '=', 8]))->order('id', 'DESC')->limit(10)->select()->toArray();
        $userviplist = [];
        if ($UserVipData) {
            foreach ($UserVipData as $key2 => $value2) {

                $userviplist[$key2]['username'] = substr(trim($value2['username']), 0, 0) . '****' . substr(trim($value2['username']), -4);

                $child_vip_name = '';

                $child = model('users')->where('id', '=', $value2['sid'])->find();
                if ($child) {
                    $child_vip = model('user_grade')->where('grade', '=', $child['vip_level'])->find();

                    if ($child_vip) {

                        if ($lang == 'en') {
                            $child_vip_name = $child_vip['en_name'];
                        } elseif ($lang == 'cn') {
                            $child_vip_name = $child_vip['name'];
                        } elseif ($lang == 'ft') {
                            $child_vip_name = $child_vip['ft_name'];
                        } elseif ($lang == 'id') {
                            $child_vip_name = $child_vip['ydn_name'];
                        } elseif ($lang == 'vi') {
                            $child_vip_name = $child_vip['yn_name'];
                        } elseif ($lang == 'es') {
                            $child_vip_name = $child_vip['xby_name'];
                        } elseif ($lang == 'jp') {
                            $child_vip_name = $child_vip['ry_name'];
                        } elseif ($lang == 'th') {
                            $child_vip_name = $child_vip['ty_name'];
                        } elseif ($lang == 'yd') {
                            $child_vip_name = $child_vip['yd_name'];
                        } elseif ($lang == 'ma') {
                            $child_vip_name = $child_vip['ma_name'];
                        } elseif ($lang == 'pt') {
                            $child_vip_name = $child_vip['pt_name'];
                        }

                    }

                }

                $userviplist[$key2]['child_vip_name'] = $child_vip_name;

                if ($lang == 'en') {
                    $userviplist[$key2]['name'] = $value2['trade_amount'];
                } else {
                    $userviplist[$key2]['name'] = $value2['trade_amount'];
                }
            }
        }
        $userviplist2 = [];
        //$userviplist33 = model('UserGrade')->where('state', 1)->select();
        //$userviplist3 = $userviplist33['states'];
        $data['info']['userviplist'] = array_merge($userviplist, $userviplist2);


        // 商家榜单
        for ($j = 0; $j < 20; $j++) {
            $headKey = array_rand($headData);
            $headerImage = $headData[$headKey];
            $nameKey = array_rand($usernameData);
            $username = $usernameData[$nameKey];
            $data['info']['businessList'][$j]['username'] = '****' . mt_rand(1000, 9999);
            $data['info']['businessList'][$j]['header'] = $headerImage;
            $data['info']['businessList'][$j]['number'] = mt_rand(1000, 9999);
            $data['info']['businessList'][$j]['profit'] = round($data['info']['businessList'][$j]['number'] * 2, 3);
        }
        //任务类型
        $taskclasslist = model('TaskClass')->where(array(['state', '=', 1]))->order('num', 'ASC')->select()->toArray();
        $TaskClassdata = [];
        foreach ($taskclasslist as $key => $value) {
            $TaskClassdata[$key]['group_id'] = $value['id'];
            $TaskClassdata[$key]['icon'] = $value['h_icon'];

            if ($lang == 'en') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_en'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_en'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_en'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_en'];
            } elseif ($lang == 'cn') {
                $TaskClassdata[$key]['group_name'] = $value['group_name'];
                $TaskClassdata[$key]['group_info'] = $value['group_info'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info'];
            } elseif ($lang == 'id') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_ydn'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_ydn'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_ydn'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_ydn'];
            } elseif ($lang == 'ft') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_ft'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_ft'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_ft'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_ft'];
            } elseif ($lang == 'vi') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_yn'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_yn'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_yn'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_yn'];
            } elseif ($lang == 'ja') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_ry'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_ry'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_ry'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_ry'];
            } elseif ($lang == 'es') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_xby'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_xby'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_xby'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_xby'];
            } elseif ($lang == 'th') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_ty'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_ty'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_ty'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_ty'];
            } elseif ($lang == 'yd') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_yd'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_yd'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_yd'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_yd'];
            } elseif ($lang == 'ma') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_ma'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_ma'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_ma'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_ma'];
            } elseif ($lang == 'pt') {
                $TaskClassdata[$key]['group_name'] = $value['group_name_pt'];
                $TaskClassdata[$key]['group_info'] = $value['group_info_pt'];
                $TaskClassdata[$key]['h_group_name'] = $value['group_name_pt'];
                $TaskClassdata[$key]['h_group_info'] = $value['group_info_pt'];
            }


            $TaskClassdata[$key]['state'] = $value['state'];
            $TaskClassdata[$key]['h_icon'] = $value['h_icon'];
            $TaskClassdata[$key]['is_f'] = $value['is_f'];
            $TaskClassdata[$key]['is_fx'] = $value['is_fx'];
        }
        $data['info']['taskclasslist'] = $TaskClassdata;

        $data['info']['setting'] = model('Setting')->field('q_server_name as up_url,service_hotline,official_QQ,WeChat_official,Mobile_client,aboutus,company,contact,problem,guides,hezuomeiti,zhifufangshi,record_number,Company_name,Customer_QQ,Accumulated_investment_amount,Conduct_investment_amount,Cumulative_expected_earnings,registered_smart_investors,service_url,seal_img,info_w,min_w,max_w,reg_url,is_sms,ft,cn,en,yny,vi,jp,es,ty,currency,yd,ma,default_language,activity_url,web_title,app_down,pt')->find();
        $data['info']['currency'] = $data['info']['setting']['currency'];
        //会员等级,判断是否显示
//        $UserViplist = model('UserGrade')->where(array('states' => 1))->order('id', 'ASC')->select()->toArray();
        $UserViplist = model('UserGrade')->order('id', 'ASC')->select()->toArray();
        $UserViplistdata = [];
        foreach ($UserViplist as $key => $value) {
            $UserViplistdata[$key]['grade'] = $value['grade'];
            $UserViplistdata[$key]['amount'] = $value['amount'];
            if ($lang == 'en') {
                $UserViplistdata[$key]['name'] = $value['en_name'];
            } elseif ($lang == 'cn') {
                $UserViplistdata[$key]['name'] = $value['name'];
            } elseif ($lang == 'ft') {
                $UserViplistdata[$key]['name'] = $value['ft_name'];
            } elseif ($lang == 'ja') {
                $UserViplistdata[$key]['name'] = $value['ry_name'];
            } elseif ($lang == 'id') {
                $UserViplistdata[$key]['name'] = $value['ydn_name'];
            } elseif ($lang == 'vi') {
                $UserViplistdata[$key]['name'] = $value['yn_name'];
            } elseif ($lang == 'es') {
                $UserViplistdata[$key]['name'] = $value['xby_name'];
            } elseif ($lang == 'th') {
                $UserViplistdata[$key]['name'] = $value['ty_name'];
            } elseif ($lang == 'yd') {
                $UserViplistdata[$key]['name'] = $value['yd_name'];
            } elseif ($lang == 'ma') {
                $UserViplistdata[$key]['name'] = $value['ma_name'];
            } elseif ($lang == 'pt') {
                $UserViplistdata[$key]['name'] = $value['pt_name'];
            }
            $UserViplistdata[$key]['validity_time'] = $value['validity_time'];
            $UserViplistdata[$key]['number'] = $value['number'];
            $UserViplistdata[$key]['states'] = $value['states'];
            $UserViplistdata[$key]['commission'] = $value['commission'];

            $UserViplistdata[$key]['income'] = $value['number'] * $value['commission'];
            $UserViplistdata[$key]['income1'] = $value['number'] * $value['commission'] * 30;
        }
        $data['info']['UserGradeList'] = $UserViplistdata;


        // 会员榜单
        $leng = count($data['info']['UserGradeList']) - 1;
        for ($i = 0; $i < 20; $i++) {
            $r = mt_rand(0, $leng);
            $headKey = array_rand($headData);
            $headerImage = $headData[$headKey];
            $data['info']['memberList'][$i]['username'] = '****' . mt_rand(1000, 9999);
            $data['info']['memberList'][$i]['header'] = $headerImage;
            $data['info']['memberList'][$i]['number'] = $data['info']['UserGradeList'][$r]['number'];
            $data['info']['memberList'][$i]['profit'] = $data['info']['UserGradeList'][$r]['commission'] * $data['info']['UserGradeList'][$r]['number'];
        }

        $authenticationdata = [];
        switch ($lang) {
            case 'en':
                $authenticationdata = ['Mobile phone authentication', 'Wechat authentication', 'Real name authentication', 'Identity authentication'];
                break;
            case 'cn':
                $authenticationdata = ['手机认证', '微信认证', '实名认证', '身份认证'];
                break;
            case 'ft':
                $authenticationdata = ['手機認證', '微信認證', '實名認證', '身份認證'];
                break;
            case 'vi':
                $authenticationdata = ['Xác thc din thoi', 'Xác thc chat', 'Xác thc tên tht', 'Xác thc danh tính'];
                break;
            case 'id':
                $authenticationdata = ['Otentikasi ponsel', 'Otentikasi Wechat', 'Autentikasi nama asli', 'autentikasi identitas'];
                break;
            case 'es':
                $authenticationdata = ['Autenticación de teléfonos', 'Autenticación de micro carta', 'Homologación real', 'Identificación:'];
                break;
            case 'ja':
                $authenticationdata = ['携帯電話の認証', 'WeChat認証', '実名認証', '認証'];
                break;
            case 'yd':
                $authenticationdata = ['  ', 'wechat ', '  ', ' '];
                break;
            case 'ma':
                $authenticationdata = ['Pengesahan mudah alih', 'Pengesahan WeChat', 'Pengesahan nama sebenar', 'Pengesahan identiti'];
                break;
            case 'pt':
                $authenticationdata = ['Autenticação por telefone celular', 'Autenticação Wechat', 'Autenticação do Nome verdadeiro', 'Autenticação Da identidade'];
                break;
        }

        $data['info']['authenticationList'] = $authenticationdata;

        //获取可提现银行列表
        /*$payBanks = model('Bank')->where(array(['q_state', '=', 1], ['pay_type', '=', 4]))->group('bank_name')->select();
        $BanksList = [];
        foreach ($payBanks as $key => $value) {
            $BanksList[$key]['bank_id'] = $value['id'];
            $BanksList[$key]['bank'] = $value['bank_name'];
            $BanksList[$key]['bank_code'] = $value['bank_code'];
            $BanksList[$key]['types'] = $value['pay_type'];
        }*/
        $BanksList = [];
        /*$i = 1;
        foreach (\Pay\Brotherpay::PAY_BANK_LIST as $c => $v) {
            $BanksList[] = [
                'bank_id' => $i,
                'bank' => $v,
                'bank_code' => $c,
                'types' => 0,
            ];
            $i++;
        }*/
        $data['info']['BanksList'] = $BanksList;

        //新版-提现银行列表
        $withBankList = [];
        //获取所有支付方式
        $rechargeType = model('RechangeType')
            ->field('id,name,code,fee,exchange')
            ->where([
                'state' => 1,
                'type' => 'app'
            ])
            ->order('sort', 'asc')
            ->select()
            ->toArray();
        $huilv = '';//汇率描述
        $pay_exchange = 0;//汇率兑换比例
        foreach ($rechargeType as $v) {
            $bList = [];
            $className = "\\Pay\\" . $v['code'];
            //return $className;
            
            if (class_exists($className)) {
                if (!empty($className::PAY_BANK_LIST)) {
                    foreach ($className::PAY_BANK_LIST as $kb => $vb) {
                        /*
                        if($vb == 'TRC20') {
                            $huilv = '1USD = 1USDT';
                            
                        }
                        */
                        $huilv = '1 PHP = '.$v['exchange'].' USD';
                        $pay_exchange = $v['fee'];//手续费
                        $exchange = $v['exchange'];//汇率
                        $bList[] = ['code' => $kb, 'name' => $vb, 'huilv' => $huilv, 'pay_exchange' =>$pay_exchange, 'exchange' => $exchange];
                    }
                }
            }
            //$blist[] = ['code'=>'USD', 'name'=>];
            $withBankList[] = [
                'name' => $v['name'],
                'code' => $v['code'],
                'list' => $bList,
                'RechangeType' => $rechargeType
            ];
        }

        $data['info']['withBankList'] = $withBankList;
        /**
         * 获取幻灯片
         */
        $slideLikst = model('Slide')->where(array(['status', '=', 1], ['lang', '=', $lang]))->select()->toArray();
        $data['info']['bannerList'] = [];
        foreach ($slideLikst as $key => $value) {
            $data['info']['bannerList'][$key] = $value['img_path'];
        }


        $data['info']['link'] = ['http://' . $_SERVER['HTTP_HOST'], 'http://' . $_SERVER['HTTP_HOST'], 'http://' . $_SERVER['HTTP_HOST']];

        $data['info']['pay_exchange'] = config('pay.trc20pay.pay_exchange');
        $data['info']['pay_out_exchange'] = config('pay.trc20pay.pay_out_exchange');
        $data['info']['pay_exchange'] = $data['info']['pay_exchange'] ? $data['info']['pay_exchange'] : 0;
        $data['info']['pay_out_exchange'] = $data['info']['pay_out_exchange'] ? $data['info']['pay_out_exchange'] : 0;
        return json($data);
    }

    public function GetLanguage()
    {
        $data = model('Setting')->field('default_language')->find();
        switch ($data['default_language']) {
            case 'cn':
                $data['default_language'] = 'zh-CN';
                break;
            case 'ft':
                $data['default_language'] = 'zh-TW';
                break;
            case 'en':
                $data['default_language'] = 'en-US';
                break;
            case 'vi':
                $data['default_language'] = 'vi-VN';
                break;
            case 'th':
                $data['default_language'] = 'th-TH';
                break;
            case 'id':
                $data['default_language'] = 'id-ID';
                break;
            case 'ja':
                $data['default_language'] = 'ja-JP';
                break;
            case 'es':
                $data['default_language'] = 'es-ES';
                break;
            case 'yd':
                $data['default_language'] = 'yd-YD';
                break;
            case 'yd':
                $data['default_language'] = 'yd-YD';
                break;
            case 'ma':
                $data['default_language'] = 'ma-MA';
                break;
            case 'pt':
                $data['default_language'] = 'pt-PT';
                break;
        }
        return json(['Language' => $data]);
    }

    public function getNotice()
    {
        if (!$this->request->isPost()) $this->error('not support');
        $cid = $this->request->post('cid/d', 0);
        $param = input('param.');
        $lang = isset($param['lang']) && $param['lang'] ? $param['lang'] : 'id';
        $noticelist = model('Notice')->where(array(
            ['state', '=', 1],
            ['lang', '=', $lang],
            ['gropid', '=', $cid]
        ))->order('add_time', 'desc')
            ->select()
            ->toArray();
        $list = [];
        foreach ($noticelist as $value) {
            $list[] = [
                'id' => $value['id'],
                'title' => $value['title'],
                'url' => $value['url'],
                'cover_img' => $value['cover_img'],
                'content' => htmlspecialchars_decode($value['content']),
                'add_time' => date('Y-m-d H:i:s', $value['add_time']),
            ];
        }
        return json([
            'code' => 1,
            'list' => $list
        ]);
    }
}
