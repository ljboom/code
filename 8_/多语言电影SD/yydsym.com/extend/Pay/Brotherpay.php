<?php

namespace Pay;

use think\Db;

class Brotherpay extends PayBase
{
    const PAY_BANK_LIST = [
        '40138' => 'ABC CAPITAL',
        '40102' => 'ACCENDO BANCO',
        '40133' => 'ACTINVER',
        '40062' => 'AFIRME',
        '90638' => 'AKALA',
        '40103' => 'AMERICAN EXPRES',
        '90659' => 'ASP INTEGRA OPC',
        '40128' => 'AUTOFIN',
        '40127' => 'AZTECA',
        '40030' => 'BAJIO',
        '40002' => 'BANAMEX',
        '40995' => 'Banco Fивcil',
        '40994' => 'Banco Fивcil_R',
        '40999' => 'Banco Fивcil2',
        '40154' => 'BANCO FINTERRA',
        '40819' => 'BANCO PRUEBAS',
        '40160' => 'BANCO S3',
        '90996' => 'BanCobro',
        '90904' => 'BanCobro_R',
        '40998' => 'BanCobroA',
        '40997' => 'BanCobroB',
        '37006' => 'BANCOMEXT',
        '40137' => 'BANCOPPEL',
        '40152' => 'BANCREA',
        '37019' => 'BANJERCITO',
        '40106' => 'BANK OF AMERICA',
        '40159' => 'BANK OF CHINA',
        '40147' => 'BANKAOOL',
        '37009' => 'BANOBRAS',
        '40072' => 'BANORTE',
        '40058' => 'BANREGIO',
        '37166' => 'BANSEFI',
        '40060' => 'BANSI',
        '40805' => 'Banxico Pruebas',
        '2001' => 'BANXICO',
        '40129' => 'BARCLAYS',
        '40145' => 'BBASE',
        '40012' => 'BBVA BANCOMER',
        '40112' => 'BMONEX',
        '90698' => 'BURSAMETRICA',
        '90676' => 'C.B. INBURSA',
        '90677' => 'CAJA POP MEXICA',
        '90683' => 'CAJA TELEFONIST',
        '90697' => 'CAPITAL ACTIVO',
        '90630' => 'CB INTERCAM',
        '90631' => 'CI BOLSA',
        '40143' => 'CIBANCO',
        '90901' => 'CLSBANK',
        '90903' => 'CoDi Valida',
        '40130' => 'COMPARTAMOS',
        '40140' => 'CONSUBANCO',
        '90652' => 'CREDICAPITAL',
        '90688' => 'CREDICLUB',
        '40126' => 'CREDIT SUISSE',
        '90680' => 'CRISTOBAL COLON',
        '40124' => 'DEUTSCHE',
        '40151' => 'DONDE',
        '90606' => 'ESTRUCTURADORES',
        '90648' => 'EVERCORE',
        '90616' => 'FINAMEX',
        '90634' => 'FINCOMUN',
        '90689' => 'FOMPED',
        '90685' => 'FONDO (FIRA)',
        '90601' => 'GBM',
        '602' => 'GEMABNAMRO',
        '562' => 'GEMAFIRME',
        '838' => 'GEMAKALA',
        '603' => 'GEMAMEX',
        '852' => 'GEMASEA',
        '860' => 'GEMASPFINANC',
        '628' => 'GEMAUTOFIN',
        '627' => 'GEMAZTECA',
        '530' => 'GEMBAJIO',
        '606' => 'GEMBAMSA',
        '502' => 'GEMBANAMEX',
        '302' => 'GEMBANAMEX2',
        '660' => 'GEMBANCO S3',
        '512' => 'GEMBANCOMER',
        '412' => 'GEMBANCOMER2',
        '506' => 'GEMBANCOMEXT',
        '637' => 'GEMBANCOPPEL',
        '519' => 'GEMBANJERCITO',
        '447' => 'GEMBANKAOOL',
        '303' => 'GEMBANKOFCHINA',
        '509' => 'GEMBANOBRAS',
        '572' => 'GEMBANORTE/IXE',
        '558' => 'GEMBANREGIO',
        '566' => 'GEMBANSEFI',
        '560' => 'GEMBANSI',
        '501' => 'GEMBANXICO',
        '629' => 'GEMBARCLAYS',
        '854' => 'GEMBBASE',
        '633' => 'GEMBCO ACTINVE',
        '452' => 'GEMBM BANCREA',
        '898' => 'GEMBURSAMETRIC',
        '876' => 'GEMC.B. INBURS',
        '840' => 'GEMC.B. J.P. M',
        '880' => 'GEMCAJ CRISTOB',
        '883' => 'GEMCAJA_TELMEX',
        '877' => 'GEMCAJAPOPMEX',
        '897' => 'GEMCAPITAL ACT',
        '830' => 'GEMCB INTERCAM',
        '653' => 'GEMCHIHUAHUA',
        '831' => 'GEMCI BOLSA',
        '630' => 'GEMCOMPARTAMOS',
        '640' => 'GEMCONSUBANCO',
        '743' => 'GEMCONSULTORIA',
        '888' => 'GEMCREDICLUB',
        '626' => 'GEMCREDIT SUIS',
        '330' => 'GEMDES_COMPART',
        '624' => 'GEMDEUTSCHE',
        '451' => 'GEMDONDE',
        '853' => 'GEMELO KUSPIT',
        '823' => 'GEMESTRUCTURAD',
        '848' => 'GEMEVERCORE',
        '816' => 'GEMFINAMEX',
        '834' => 'GEMFINCOMUN',
        '654' => 'GEMFINTERRA',
        '885' => 'GEMFONDO',
        '707' => 'GEMGBM',
        '836' => 'GEMHDI SEGUROS',
        '668' => 'GEMHIPOTECARIA',
        '521' => 'GEMHSBC',
        '322' => 'GEMHSBC_DES',
        '421' => 'GEMHSBC2',
        '321' => 'GEMHSBC3',
        '323' => 'GEMHSBC4',
        '455' => 'GEMICBC',
        '536' => 'GEMINBURSA',
        '858' => 'GEMINDEVAL',
        '450' => 'GEMINMOBIMEX',
        '636' => 'GEMINTERCAM',
        '886' => 'GEMINVERCAP',
        '544' => 'GEMINVERLAT',
        '444' => 'GEMINVERLAT2',
        '559' => 'GEMINVEX',
        '610' => 'GEMJPMORGAN',
        '861' => 'GEMLIBERTAD',
        '767' => 'GEMMASARI',
        '542' => 'GEMMIFEL',
        '315' => 'GEMMIFEL2',
        '658' => 'GEMMIZUHO',
        '612' => 'GEMMONEX',
        '721' => 'GEMMONEX',
        '632' => 'GEMMULTIVA',
        '813' => 'GEMMULTIVA',
        '635' => 'GEMNAFIN',
        '638' => 'GEMNORESTE',
        '448' => 'GEMPAGATODO',
        '881' => 'GEMPRESTAMO',
        '304' => 'GEMPRESTAMO1',
        '305' => 'GEMPRESTAMO2',
        '306' => 'GEMPRESTAMO3',
        '820' => 'GEMPROFUTURO',
        '896' => 'GEMPROSA',
        '842' => 'GEMREFORMA',
        '656' => 'GEMSABADELL',
        '414' => 'GEMSANTANDE',
        '514' => 'GEMSANTANDER',
        '314' => 'GEMSANTANDES',
        '657' => 'GEMSHINHAN',
        '846' => 'GEMSTP',
        '895' => 'GEMTE CREEMOS',
        '608' => 'GEMTOKYO',
        '884' => 'GEMTRANSFER',
        '857' => 'GEMUNAGRA',
        '817' => 'GEMVALMEX',
        '719' => 'GEMVALUE',
        '613' => 'GEMVE POR MAS',
        '826' => 'GEMVECTOR',
        '641' => 'GEMVOLKSWAGEN',
        '892' => 'GEMXXIBANORTE',
        '90636' => 'HDI SEGUROS',
        '37168' => 'HIPOTECARIA FED',
        '40021' => 'HSBC',
        '40155' => 'ICBC',
        '40036' => 'INBURSA',
        '90902' => 'INDEVAL',
        '40150' => 'INMOBILIARIO',
        '40136' => 'INTERCAM BANCO',
        '90686' => 'INVERCAP',
        '40059' => 'INVEX',
        '40110' => 'JP MORGAN',
        '90653' => 'KUSPIT',
        '90670' => 'LIBERTAD',
        '90602' => 'MASARI',
        '301' => 'MEMBER_A',
        '40042' => 'MIFEL',
        '40158' => 'MIZUHO BANK',
        '90600' => 'MONEXCB',
        '40108' => 'MUFG',
        '40132' => 'MULTIVA BANCO',
        '90613' => 'MULTIVA CBOLSA',
        '37135' => 'NAFIN',
        '90694' => 'OPORMEX',
        '40148' => 'PAGATODO',
        '90620' => 'PROFUTURO',
        '40153' => 'PROGRESO',
        '90642' => 'REFORMA',
        '40156' => 'SABADELL',
        '40014' => 'SANTANDER',
        '90696' => 'SC PROM Y OP',
        '40044' => 'SCOTIABANK',
        '40157' => 'SHINHAN',
        '90646' => 'STP',
        '90695' => 'TE CREEMOS',
        '684' => 'TRANSFER',
        '90684' => 'TRANSFER',
        '90656' => 'UNAGRA',
        '90999' => 'Validador',
        '90617' => 'VALMEX',
        '90605' => 'VALUE',
        '40113' => 'VE POR MAS',
        '90608' => 'VECTOR',
        '40141' => 'VOLKSWAGEN',
        '90692' => 'XXIBANORTE',
    ];
    const PAY_URL = 'http://8.142.100.111:3020/api/collection/create';
    const PAYOUT_URL = 'http://8.142.100.111:3020/api/agentpay/apply';

    public static function instance()
    {
        return new self();
    }

    public function get_mch_id()
    {
        return config('pay.brotherpay.mch_id');
    }

    public function get_secret()
    {
        return config('pay.brotherpay.secret');

    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $data = [
            'mchId' => $this->get_mch_id(),
            'appId' => config('pay.brotherpay.app_id'),
            'productId' => config('pay.brotherpay.pay_type'),
            'idNumber' => $op_data['sn'],
            'amount' => $op_data['amount'] * 100,
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => $op_data['sn'],
            ], true, true),
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data);
        $res = json_decode($res, true);
        if (!empty($res['retCode']) && $res['retCode'] == 'SUCCESS') {
            Db::name('user_recharge')
                ->where('order_number', $op_data['sn'])
                ->update([
                    'pay_type' => $res['payCode']
                ]);
            return [
                'respCode' => 'SUCCESS',
                'payInfo' => $res['payUrl']
            ];
        }
        return ['respCode' => 'ERROR', 'payInfo' => '', 'resData' => $res, 'postData' => $data];
    }

    /**
     * 验证代收回调
     * @param string $type
     * @return array ['status'=>'SUCCESS',oid=>'订单号',amount=>'金额','data'=>'原始数据 array']
     */
    public function parsePayCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        parse_str($put, $data);
        if (empty($data['sign']) || empty($data['payCode'])) {
            exit('data error');
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_make_sign($data);
        if ($sign_old != $sign) {
            return [
                'status' => 'FAIL',
                'msg' => '签名错误',
                'sign_str' => $this->_make_sign($data, true),
                'new_sign' => $sign,
                'data' => $data
            ];
        }
        $oinfo = Db::name('user_recharge')
            ->where('pay_type', $data['payCode'])
            ->where('pay_name', 'Brotherpay')
            ->order('id desc')
            ->find();
        if (empty($oinfo)) {
            exit('no order');
        }
        //判断是否已经上分
        $s_oinfo = Db::name('user_recharge')
            ->where('pay_order_id', $data['payOrderId'])
            ->where('pay_type', $data['payCode'])
            ->where('pay_name', 'Brotherpay')
            ->order('id desc')
            ->find();
        if (!empty($s_oinfo)) {
            return [
                'status' => ($data['status'] == 2 ? 'SUCCESS' : 'FAIL'),
                'oid' => $s_oinfo['order_number'],
                'amount' => $data['amount'],
                'data' => $data
            ];
        }
        //单位 分
        $data['amount'] = floatval($data['amount'] / 100);

        //如果订单已经充值了的话
        if ($oinfo['state'] == 1) {
            $orderNumber = trading_number();
            $ress = Db::name('user_recharge')
                ->insert([
                    'uid' => $oinfo['uid'],
                    'order_number' => $orderNumber,
                    'type' => $oinfo['type'],
                    'money' => $data['amount'],
                    'postscript' => $oinfo['postscript'],
                    'add_time' => time()
                ]);
            $oinfo = Db::name('user_recharge')->where('order_number', $orderNumber)->find();
        } else {
            //更改订单金额
            Db::name('user_recharge')
                ->where('id', $oinfo['id'])
                ->update([
                    'money' => $data['amount'],
                    'pay_order_id' => $data['payOrderId'],
                ]);
        }
        return [
            'status' => ($data['status'] == 2 ? 'SUCCESS' : 'FAIL'),
            'oid' => $oinfo['order_number'],
            'amount' => $data['amount'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'success';
    }

    public function payCallbackFail()
    {
        echo 'error';
    }

    public $_payout_msg = '';
    public $_payout_id = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'mchId' => $this->get_mch_id(),
            'mchOrderNo' => $oinfo['id'],
            'amount' => intval($oinfo['num'] * 100),
            'accountType' => 3,
            'accountNo' => $blank_info['cardnum'],
            'accountName' => $blank_info['username'],
            'bankCode' => $blank_info['bank_code'],
            'bankName' => $blank_info['bank_name'],
            'phone' => $blank_info['mobile'],
            'reqTime' => date('YmdHis'),
            'notifyUrl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
            'remark' => 'payout'
        ];
        if (strlen($data['accountNo']) == 18) $data['accountType'] = 40;
        $data['sign'] = $this->_make_payout_sign($data);
        $res = $this->_post(self::PAYOUT_URL, $data);
        $res = json_decode($res, true);
        if (!empty($res['retCode']) && $res['retCode'] == 'SUCCESS') {
            $this->_payout_id = $res['agentpayOrderId'];
            return true;
        }
        $this->_payout_msg = !empty($res['retMsg']) ? $res['retMsg'] : '';
        $this->_payout_msg .= json_encode($data);
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        parse_str($put, $data);
        if (empty($data['sign']) || empty($data['status'])
            || !in_array($data['status'], [2, 3])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_make_payout_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 2 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['mchOrderNo'],
            'amount' => $data['fee'] / 100,
            'msg' => !empty($data['transMsg']) ? $data['transMsg'] : '',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "error";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo "success";
    }


    /**
     * 创建签名
     * @param $data array  数据包
     * @return string
     */
    private function _make_sign(array $data, $getContent = false)
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $value = trim($value);
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        if ($getContent) return $str . 'key=' . $this->get_secret();
        return strtoupper(md5($str . 'key=' . $this->get_secret()));
    }

    private function _make_payout_sign(array $data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $value = trim($value);
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        return strtoupper(md5($str . 'key=' . $this->get_secret()));
    }
}