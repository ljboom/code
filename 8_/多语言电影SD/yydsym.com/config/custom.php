<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 自定义公共配置
// +----------------------------------------------------------------------

return [
	// +----------------------------------------------------------------------
	// | 公用
	// +----------------------------------------------------------------------
    
    // 同步管理用户到客服系统
    
    'kefu_user_sync' => 1,  //开启登录同步用户到客服系统
    'kefu_user_autologin' => 1,//后台登录自动登录客服系统
    
	// 账户状态
	'userState'	=>	[
		'全部',		// 0
		'正常',		// 1
		'锁定',		// 2
		'冻结',		// 3
		'踢下线',	// 4
	],

	// 账户会员状态
	'userVipState'	=>	[
		'全部',		// 0
		'正常',		// 1
		'锁定',		// 2
		'过期',		// 3
	],

	'lang'=>[
		'cn'=>'简体中文',
		'en'=>'英文',
		'ft'=>'繁体中文',
		'ja'=>'日语',
		'id'=>'印尼语',
		'vi'=>'越南语',
		'es'=>'西班牙语',
		'th'=>'泰语',
		'yd'=>'印度语',
        'ma'=>'马来语',
        'pt'=>'葡萄牙语',
	],

	'taskType' => ['所有','供应信息','需求信息'],

	// 任务分类
	'taskClass' => [
		'所有',
		'砍价专区',
		'转发专区',
		'点赞专区',
		'下载专区',
		'关注专区',
		'评论专区',
		'投票',
		'注册',
		'调查问卷',
		'辅助相关',
	],

	// 任务状态
	'taskStatus' => [
		'所有',
		'审核中',//1
		'未通过',//2
		'进行中',//3
		'已完成',//4
		'已撤销',//5
	],

	// 任务状态
	'entaskStatus' => [
		'All',
		'Reviewing',
		'Fail',
		'Ongoing',
		'Completed',
		'Abandoned',
	],

	// 任务订单状态
	'cntaskOrderStatus' => [
		'所有',
		'进行中',//1
		'审核中',//2
		'已完成',//3
		'已失败',//4
		'恶意',//5
		'已放弃',//6
	],
	// 任务订单状态
	'entaskOrderStatus' => [
		'All',
		'Ongoing',
		'Reviewing',
		'Completed',
		'Failed',
		'Malice',
		'Give Up'
	],

	// +----------------------------------------------------------------------
	// | 状态、类型
	// +----------------------------------------------------------------------

	// 订单状态
	'orderStates'	=>	[
		'全部',	 // 0
		'已创建',	// 1
		'已支付',	// 2
		'已完成',	// 3
		'已关闭',	// 4
		'已过期',	// 5
		'已锁定',	// 6
		'待支付',	// 7
		'已失败',	// 8
	],
    // 交易类型
    'transactionType'	=>	[
        '全部',	 //0
        '用户充值',	//1 recharge
        '用户提现',	//2 withdrawal
        '发布任务',	//3 task
        '平台抽水',	//4 pump
        '下级返点',	//5 rebate
        '完成任务',	//6 commission
        '注册奖励',	//7 regment
        '推广奖励',	//8 spread
        '购买会员',	//9 buymembers
        '撤销任务',	//10 revoke
        '转账转出',	//11 transfer_c
        '转账转入',	//12 transfer_r
        '其他',	 	//13 其他
        '发放红包',	//14
        '领取红包',	//15
        '收益宝',	//16
        '升级VIP'     //17
    ],

	// 交易类型
	'cntransactionType'	=>	[
		'全部',	 //0
		'用户充值',	//1 recharge
		'用户提现',	//2 withdrawal
		'发布任务',	//3 task
		'平台抽水',	//4 pump
		'下级返点',	//5 rebate
		'完成任务',	//6 commission
		'注册奖励',	//7 regment
		'推广奖励',	//8 spread
		'购买会员',	//9 buymembers
		'撤销任务',	//10 revoke
		'转账转出',	//11 transfer_c
		'转账转入',	//12 transfer_r
		'其他',	 	//13 其他
		'发放红包',	//14
		'领取红包',	//15
		'余额宝',	//16
	],

    // 英文交易类型
    'entransactionType'	=>	[
        'All',	 //0
        'Recharge',	//1 recharge
        'Withdrawal',	//2 withdrawal
        'Post task',	//3 task
        'Platform pumping',	//4 pump
        'Lower rebate',	//5 rebate
        'mission accomplished',	//6 commission
        'Registration rewards',	//7 regment
        'Promotion reward',	//8 spread
        'Buy membership',	//9 buymembers
        'Cancel task',	//10 revoke
        'Transfer out',	//11 transfer_c
        'Transfer in',	//12 transfer_r
        'Other',	 	//13 其他
        'Red envelope',	//14
        'Receive red envelope',	//15
        'Yu\'ebao',	//16
    ],

    // 印尼交易类型
    'idtransactionType'	=>	[
        'Semua',	 //0
        'Isi ulang',	//1 recharge
        'menarik',	//2 withdrawal
        'Posting tugas',	//3 task
        'Pemompaan platform',	//4 pump
        'Rabat lebih rendah',	//5 rebate
        'misi selesai',	//6 commission
        'Hadiah pendaftaran',	//7 regment
        'Hadiah promosi',	//8 spread
        'Beli keanggotaan',	//9 buymembers
        'Batalkan tugas',	//10 revoke
        'Transfer keluar',	//11 transfer_c
        'Transfer masuk',	//12 transfer_r
        'lain',	 	//13 其他
        'amplop merah',	//14
        'Terima amplop merah',	//15
        'Yu\'ebao',	//16
    ],

    // 繁体交易类型
    'fttransactionType'	=>	[
        '全部',	 //0
        '用戶充值',	//1 recharge
        '用戶提現',	//2 withdrawal
        '發布任務',	//3 task
        '平台抽水',	//4 pump
        '下級返點',	//5 rebate
        '完成任務',	//6 commission
        '註冊獎勵',	//7 regment
        '推廣獎勵',	//8 spread
        '購買會員',	//9 buymembers
        '撤銷任務',	//10 revoke
        '轉賬轉出',	//11 transfer_c
        '轉賬轉入',	//12 transfer_r
        '其他',	 	//13 其他
        '發放紅包',	//14
        '領取紅包',	//15
        '餘額寶',	//16
    ],

    // 印度交易类型
    'ydtransactionType'	=>	[
        'सब',	 //0
        'उपयोगकर्ता रिचार्ज',	//1 recharge
        'उपयोगकर्ता वापसी',	//2 withdrawal
        'पोस्ट कार्य',	//3 task
        'प्लेटफार्म पंपिंग',	//4 pump
        'कम छूट',	//5 rebate
        'मिशन पूरा हुआ',	//6 commission
        'पंजीकरण पुरस्कार',	//7 regment
        'पदोन्नति इनाम',	//8 spread
        'सदस्यता खरीदें',	//9 buymembers
        'कार्य रद्द करें',	//10 revoke
        'बाहर स्थानांतरण',	//11 transfer_c
        'में स्थानांतरण',	//12 transfer_r
        'अन्य',	 	//13 其他
        'लाल लिफाफा',	//14
        'लाल लिफाफा प्राप्त करें',	//15
        'यु\'आबाओ',	//16
    ],

    // 越南交易类型
    'vitransactionType'	=>	[
        'Tất cả',	 //0
        'Người dùng nạp tiền',	//1 recharge
        'Người dùng rút tiền',	//2 withdrawal
        'Đăng công việc',	//3 task
        'Bơm nền tảng',	//4 pump
        'Giảm giá thấp hơn',	//5 rebate
        'nhiệm vụ hoàn thành',	//6 commission
        'Phần thưởng đăng ký',	//7 regment
        'Phần thưởng khuyến mãi',	//8 spread
        'Mua thành viên',	//9 buymembers
        'Huỷ công việc',	//10 revoke
        'Chuyển ra ngoài',	//11 transfer_c
        'Chuyển giao',	//12 transfer_r
        'khác',	 	//13 其他
        'Phong bì đỏ',	//14
        'Nhận phong bì đỏ',	//15
        'Yu\'ebao',	//16
    ],

    // 西班牙交易类型
    'estransactionType'	=>	[
        'Todas',	 //0
        'Recarga de usuario',	//1 recharge
        'Retiro del usuario',	//2 withdrawal
        'Publicar tarea',	//3 task
        'Plataforma de bombeo',	//4 pump
        'Reembolso más bajo',	//5 rebate
        'misión cumplida',	//6 commission
        'Recompensas de registro',	//7 regment
        'Recompensa de promoción',	//8 spread
        'Comprar membresía',	//9 buymembers
        'Cancelar tarea',	//10 revoke
        'Trasferencia',	//11 transfer_c
        'Transferencia',	//12 transfer_r
        'otro',	 	//13 其他
        'sobre rojo',	//14
        'Recibir sobre rojo',	//15
        'Yu\'ebao',	//16
    ],

    // 日语交易类型
    'jatransactionType'	=>	[
        'すべて',	 //0
        'ユーザーの再充電',	//1 recharge
        'ユーザーの撤退',	//2 withdrawal
        'タスクの投稿',	//3 task
        'プラットフォームポンピング',	//4 pump
        'リベートを下げる',	//5 rebate
        '任務完了',	//6 commission
        '登録報酬',	//7 regment
        'プロモーション報酬',	//8 spread
        'メンバーシップを購入する',	//9 buymembers
        'タスクをキャンセル',	//10 revoke
        '転出',	//11 transfer_c
        '転送',	//12 transfer_r
        'その他',	 	//13 其他
        '赤い封筒',	//14
        '赤い封筒を受け取る',	//15
        'ユエバオ',	//16
    ],

    // 泰语交易类型
    'thtransactionType'	=>	[
        'ทั้งหมด',	 //0
        'ผู้ใช้เติมเงิน',	//1 recharge
        'การถอนของผู้ใช้',	//2 withdrawal
        'โพสต์งาน',	//3 task
        'แพลตฟอร์มการสูบน้ำ',	//4 pump
        'ส่วนลดที่ต่ำกว่า',	//5 rebate
        'ภารกิจเสร็จสมบูรณ์',	//6 commission
        'รางวัลการลงทะเบียน',	//7 regment
        'รางวัลส่งเสริมการขาย',	//8 spread
        'ซื้อสมาชิก',	//9 buymembers
        'ยกเลิกงาน',	//10 revoke
        'โอนออก',	//11 transfer_c
        'โอนเข้า',	//12 transfer_r
        'อื่น ๆ',	 	//13 其他
        'ซองจดหมายสีแดง',	//14
        'รับอั่งเปา',	//15
        'Yu\'ebao',	//16
    ],

    // 马来语交易类型
    'matransactionType'	=>	[
        'Semua',	 //0
        'Pengisian semula pengguna',	//1 recharge
        'Pengeluaran pengguna',	//2 withdrawal
        'Tugaskan tugas',	//3 task
        'Mengepam platform',	//4 pump
        'Rebat lebih rendah',	//5 rebate
        'misi tercapai',	//6 commission
        'Ganjaran pendaftaran',	//7 regment
        'Ganjaran promosi',	//8 spread
        'Beli keahlian',	//9 buymembers
        'Batalkan tugas',	//10 revoke
        'Pindahkan keluar',	//11 transfer_c
        'Pindah masuk',	//12 transfer_r
        'yang lain',	 	//13 其他
        'sampul surat merah',	//14
        'Terima sampul surat berwarna merah',	//15
        'Yu\'ebao',	//16
    ],

    // 葡萄牙交易类型
    'pttransactionType'	=>	[
        'Tudo',	 //0
        'Recarga do usuário',	//1 recharge
        'Retirada do usuário',	//2 withdrawal
        'Publicar tarefa',	//3 task
        'Plataforma de bombeamento',	//4 pump
        'Desconto mais baixo',	//5 rebate
        'missão cumprida',	//6 commission
        'Recompensas de registro',	//7 regment
        'Recompensa de promoção',	//8 spread
        'Compre assinatura',	//9 buymembers
        'Cancelar tarefa',	//10 revoke
        'Transferir para fora',	//11 transfer_c
        'Transferir em',	//12 transfer_r
        'outro',	 	//13 其他
        'envelope vermelho',	//14
        'Receber envelope vermelho',	//15
        'Yu\'ebao',	//16
    ],

	// 交易类型代号
	'userTotal' => [
		'',
		'total_recharge',
		'total_withdrawals',
		'balance_investment',
		'total_fee',
		'total_rebate',
		'total_commission',
	],

	// 前端显示交易类型
	'front_type'	=>	[
		'全部',	// 0
		'转入',	//1
		'转出',	//2
		'冻结',	//3
		'解冻',	//4
	],

	//充值状态中文
	'rechargeStatus'	=>	[
		'全部',			// 0
		'已完成',		// 1
		'失败',		// 2
		'待付款',		// 3
		'已关闭',		// 4
		'匹配中',		// 5
		'已取消',		// 6
	],
	//充值状态印尼
	'rechargeStatusid'	=>	[
		'seluruh',			// 0
		'Selesai',		// 1
		'gagal',		// 2
		'Untuk dibayar',		// 3
		'Tutup',		// 4
		'Mencocok',		// 5
		'Dibatalkan',		// 6
	],
	
	//充值状态英文
	'rechargeStatusen'	=>	[
		'whole',			// 0
		'Completed',		// 1
		'fail',		// 2
		'To be paid',		// 3
		'Closed',		// 4
		'Matching',		// 5
		'Cancelled',		// 6
	],
	//充值状态繁体
	'rechargeStatusft'	=>	[
		'全部',			// 0
		'已完成',		// 1
		'失敗',		// 2
		'待付款',		// 3
		'已關閉',		// 4
		'匹配中',		// 5
		'已取消',		// 6
	],
	//充值状态印度
	'rechargeStatusyd'	=>	[
		'पूर्ण',			// 0
		'पूर्ण',		// 1
		'असफल',		// 2
		'पैसा करने के लिए',		// 3
		'बन्द',		// 4
		'मिलान',		// 5
		'रद्द',		// 6
	],
	//充值状态越南
	'rechargeStatusvi'	=>	[
		'nguyên',			// 0
		'Hoàn',		// 1
		'hỏng',		// 2
		'Được trả',		// 3
		'Đóng',		// 4
		'Khớp',		// 5
		'Dừng',		// 6
	],
	//充值状态西班牙
	'rechargeStatuses'	=>	[
		'Total',			// 0
		'100%',		// 1
		'Fracaso',		// 2
		'Cuentas por pagar',		// 3
		'Cerrado.',		// 4
		'Coincide.',		// 5
		'Cancelada.',		// 6
	],
	//充值状态日文
	'rechargeStatusja'	=>	[
		'全部',			// 0
		'完了しました',		// 1
		'失敗',		// 2
		'未払い金',		// 3
		'閉じられました',		// 4
		'マッチ中',		// 5
		'キャンセルしました',		// 6
	],
	//充值状态泰语
	'rechargeStatusth'	=>	[
		'จำนวนทั้งหมด',			// 0
		'เสร็จสิ้น',		// 1
		'เสียเหลี่ยม',		// 2
		'ค้างชำระ',		// 3
		'ปิดกล้อง',		// 4
		'จับคู่กัน',		// 5
		'ยกเลิก',		// 6
	],
    //充值状态马来语
    'rechargeStatusma'	=>	[
        'keseluruhan',			// 0
        'Selesai',		// 1
        'gagal',		// 2
        'Untuk dibayar',		// 3
        'Tutup',		// 4
        'Berpadan',		// 5
        'Dibatalkan',		// 6
    ],
    //充值状态葡萄牙语
    'rechargeStatuspt'	=>	[
        'Inteiro',			// 0
        'Completo',		// 1
        'Falha',		// 2
        'A Pagar',		// 3
        'Fechado',		// 4
        'Correspondência',		// 5
        'Cancelado',		// 6
    ],
	
	
	

	//买卖状态
	'transactionStatus'	=>	[
		'全部',			// 0
		'已完成',		// 1
		'已付款',		// 2
		'待付款',		// 3
		'已关闭',		// 4
		'匹配中',		// 5
		'已取消',		// 6
	],

	// 流水状态
	'tradedetailsStatus' =>[
		'全部',		// 0
		'成功',		// 1
		'失败',		// 2
		'审核中',	// 3
	],

	//提现状态中文
	'withdrawalsState' => [
		'全部',			// 0
		'已支付',		// 1
		'拒绝支付',		// 2
		'未支付',		// 3
		'银行处理中',	// 4
		'失败'	,		// 5
		'出款成功',		// 6 第三方自动出款
	],
	
	//提现状态英语
	'withdrawalsStateen' => [
		'whole',			// 0
		'Paid',		// 1
		'Refuse to pay',		// 2
		'Unpaid',		// 3
		'Bank processing',	// 4
		'fail'	,		// 5
		'Successful payment',		// 6 第三方自动出款
	],
	//提现状态印尼
	'withdrawalsStateid' => [
		'seluruh',			// 0
		'Dibayar',		// 1
		'Menolak membayar',		// 2
		'Tidak dibayar',		// 3
		'Proses bank',	// 4
		'gagal'	,		// 5
		'Pembayaran berhasil',		// 6 第三方自动出款
	],
	//提现状态繁体
	'withdrawalsStateft' => [
		'全部',			// 0
		'已支付',		// 1
		'拒絕支付',		// 2
		'未支付',		// 3
		'銀行處理中',	// 4
		'失敗'	,		// 5
		'出款成功',		// 6 第三方自动出款
	],
	//提现状态印度
	'withdrawalsStateyd' => [
		'पूर्ण',			// 0
		'पैदा',		// 1
		'पैसा करने के लिए अस्वीकार करें',		// 2
		'बिना पैसा',		// 3
		'बैंक प्रोसेसिंग',	// 4
		'असफल'	,		// 5
		'सफलता पैसा',		// 6 第三方自动出款
	],
	//提现状态越南
	'withdrawalsStatevi' => [
		'nguyên',			// 0
		'Trả',		// 1
		'Từ chối trả tiền',		// 2
		'Chưa trả',		// 3
		'Xử lý ngân hàng',	// 4
		'hỏng'	,		// 5
		'Dịch vụ',		// 6 第三方自动出款
	],
	//提现状态西班牙
	'withdrawalsStatees' => [
		'Total',			// 0
		'Pagos efectuados',		// 1
		'Negativa de pago',		// 2
		'No pagada',		// 3
		'Procesos bancarios en curso',	// 4
		'Fracaso'	,		// 5
		'éxito.',		// 6 第三方自动出款
	],
	//提现状态日语
	'withdrawalsStateja' => [
		'全部',			// 0
		'支払い済み',		// 1
		'支払いを拒否する',		// 2
		'未払い',		// 3
		'銀行処理中',	// 4
		'失敗'	,		// 5
		'出金に成功する',		// 6 第三方自动出款
	],
	//提现状态泰语
	'withdrawalsStateth' => [
		'จำนวนทั้งหมด',			// 0
		'จ่ายเงิน',		// 1
		'ปฏิเสธที่จะจ่าย',		// 2
		'ไม่จ่าย',		// 3
		'ธนาคารในการประมวลผล',	// 4
		'เสียเหลี่ยม'	,		// 5
		'ความสำเร็จของการชำระเงิน',		// 6 第三方自动出款
	],
    //提现状态马来语
    'withdrawalsStatema' => [
        'keseluruhan',			// 0
        'Dibayar',		// 1
        'Menolak membayar',		// 2
        'Tidak dibayar',		// 3
        'Pemprosesan bank',	// 4
        'gagal'	,		// 5
        'Pembayaran berjaya',		// 6 第三方自动出款
    ],
    //提现状态葡萄牙语
    'withdrawalsStatept' => [
        'Inteiro',			// 0
        'Pagamento',		// 1
        'Recusar-se a Pagar',		// 2
        'Não Pago',		// 3
        'Processamento bancário',	// 4
        'Falha'	,		// 5
        'Pagamento BEM sucedido',		// 6 第三方自动出款
    ],

	//支付类型
	'payway' => [
		''					=>	'',
		'AliPay'			=> '支付宝',
		'WechatPay'			=> '微信',
		'BankPay'			=> '银联',
		'WechatPayFixed'	=> '固定微信',
		'AliPayFixed'		=> '固定支付宝',

	],

	// 充值渠道类型
	'rechargeType' => [
		'online'      => '在线网银',
		'scan'        => '扫码',
		'quick'       => '快捷',
		'wap'         => 'WAP',
		'turn'        => '网银转账',
		'turn_alipay' => '支付宝转账',
		'turn_wx'     => '微信转账',
		'alipay_scan' => '支付宝扫码',
		'wechat_scan' => '微信扫码',
		'qpay_scan'   => 'QQ钱包扫码',
	],

	// +----------------------------------------------------------------------
	// | 用户
	// +----------------------------------------------------------------------

	//账户类型
	'userType'	=>	[
		'全部',	// 0
		'代理',	// 1
		'会员',	// 2
		'测试',	// 3
		'推广',	// 4
	],

	//账户级别
	'vipLevel'	=>	[
		'全部',	// 0
		'顶级',	// 1
		'主管',	// 2
		'招商',	// 3
		'直属',	// 4
		'代理',	// 5
		'会员',	// 6
	],

	// +----------------------------------------------------------------------
	// | 商户
	// +----------------------------------------------------------------------

	// 商户资质状态
	'merchantType' => [
		'全部',
		'代理商户',
		'基本商户',
	],

	// 商户资质状态
	'merchantVerify' => [
		'全部',
		'正常',
		'审核中',
		'未认证',
		'审核失败',
	],

	// +----------------------------------------------------------------------
	// | 其他
	// +----------------------------------------------------------------------

	// 会员支付方式返点
	'paywayrebate' => [
		'AliPay'    => 1.3,	// 支付宝
		'WechatPay' => 0.9,	// 微信
	],
	//商户支付方式手续费
	'mpaywayrebate' => [
		'AliPay'    => 1.3,	// 支付宝
		'WechatPay' => 0.9,	// 微信
	],
	//用户额度配置
	'userbalance' => [
		'limit_balance'      =>	1000.00,//接单最小金额
		'activation_balance' =>	200.00,//激活最小金额
		'min_recharge'       =>	3000.00,//最小充值金额
		'max_recharge'       =>	20000.00,//最大充值金额
		'recharge_fee'       =>	0.1,//充值费率
		'min_selling'        =>	900.00,//最小卖币
		'max_selling'        =>	10000.00,//最大卖币
		'selling_fee'        =>	0.5,//卖币费率
		'min_withdrawal'     =>	200.00,//最小提现金额
		'max_withdrawal'     =>	20000.00,//最大提现金额
		'withdrawal_fee'     =>	0.1,//提现费率
	],

    //余额宝状态
    'cnyuebaoStatus' =>[
        '收益中',
        '已结束'
    ],
    'enyuebaoStatus' =>[
        'Processing',
        'Over'
    ],
    'idyuebaoStatus' =>[
        'Pendapatan',
        'lebih'
    ],
    'ftyuebaoStatus' =>[
        '收益中',
        '已結束'
    ],
    'ydyuebaoStatus' =>[
        'आय',
        'ऊपर'
    ],
    'viyuebaoStatus' =>[
        'Thu nhập = earnings',
        'kết thúc'
    ],
    'esyuebaoStatus' =>[
        'Ingreso',
        'encima'
    ],
    'jayuebaoStatus' =>[
        '所得',
        '以上'
    ],
    'thyuebaoStatus' =>[
        'รายได้',
        'เกิน'
    ],
    'mayuebaoStatus' =>[
        'Pendapatan',
        'berakhir'
    ],
    'ptyuebaoStatus' =>[
        'Renda',
        'sobre'
    ],
];
