import { post, get } from '@/axios/index'
// import APIUrl from '@/axios/api.url'

// var img_url = APIUrl.util.image // 这个就是图片上传的api url

// 就可以使用 post 和 get 了

// 大宗交易下单
export function buyStockDz (options) {
  return post('/dtapi/user/buyStockDz.do', options)
}
// vip抢筹列表
export function getVipList (options) {
  return post('/dtapi/api/stock/getVipList.do', options)
}
// 大宗交易列表
export function stockgetDzList (options) {
  return post('/dtapi/api/stock/getDzList.do', options)
}
//大宗交易记录
export function buyStockDzList (options) {
  return post('/dtapi/user/buyStockDzList.do', options)
}
// vip抢筹详情下单
export function buyVipQc (options) {
  return post('/dtapi/user/buyVipQc.do', options)
}
export function queryIndexNews (options) {
  return post('/dtapi/api/index/queryIndexNews.do', options)
}
// 获取产品配置信息
export function getProductSetting (options) {
  return post('/dtapi/api/admin/getProductSetting.do', options)
}

export function submitSubscribe (options) {
  return post('/dtapi/user/submitSubscribe.do', options)
}
// 登录
export function login (options) {
  return post('/dtapi/api/user/login.do', options)
}

// 注册
export function register (options) {
  return post('/dtapi/api/user/reg.do', options)
}

// 注销登录
export function logout (options) {
  return post('/dtapi/api/user/logout.do', options)
}

// 删除账户
export function delUser (options) {
  return post('/dtapi/api/user/delUser.do', options)
}

// 验证是否注册
export function checkPhone (options) {
  return post('/dtapi/api/user/checkPhone.do', options)
}

// 更改密码 -- 忘记密码
export function forgetPas (options) {
  return get('/dtapi/api/user/updatePwd.do', options)
}

// 修改密码
export function changePassword (options) {
  return get('/dtapi/user/updatePwd.do', options)
}

// 获取验证码  -- 注册
export function getCode (options) {
  return get('/dtapi/api/sms/sendRegSms.do', options)
}

// 获取验证码  -- 忘记密码
export function sendForgetSms (options) {
  return get('/dtapi/api/sms/sendForgetSms.do', options)
}

// 获取图片验证码   -- 查看验证码
export function getCode2 (options) {
  return get('/dtapi/code/getCode.do', options)
}

// 验证图片验证码 -- 验证
export function checkCode (options) {
  return get('/dtapi/code/checkCode.do', options)
}

// /*** 首页 ****/
// 查询首页显示的指数
export function getIndexMarket (options) {
  return get('/dtapi/api/index/queryHomeIndex.do', options)
}

// 查询列表页显示的指数
export function getListMarket (options) {
  return get('/dtapi/api/index/queryListIndex.do', options)
}

// 查询指数是否可交易
export function getTransMarket (options) {
  return get('/dtapi/api/index/queryTransIndex.do', options)
}

// 获取大盘指数
export function getMarket (options) {
  return get('/dtapi/api/stock/getMarket.do', options)
}

// 股票列表数据
export function getStock (options) {
  return get('/dtapi/api/stock/getStock.do', options)
}

// 单只股票行情数据
export function getSingleStock (options) {
  return post('/dtapi/api/stock/getSingleStock.do', options)
}

// 单只指数行情数据
export function getSingleIndex (options) {
  return post('/dtapi/api/index/querySingleIndex.do', options)
}

// 添加自选
export function addOption (options) {
  return post('/dtapi/user/addOption.do', options)
}

// 删除自选
export function delOption (options) {
  return post('/dtapi/user/delOption.do', options)
}

// 获取期货列表
export function getFutures (options) {
  return get('/dtapi/api/futures/queryList.do', options)
}

// 获取首页显示的期货列表
export function getHomeFutures (options) {
  return get('/dtapi/api/futures/queryHome.do', options)
}

// 获取期货列表
export function getListFutures (options) {
  return get('/dtapi/api/futures/queryList.do', options)
}

// 查询期货产品的交易状态
export function queryTrans (options) {
  return get('/dtapi/api/futures/queryTrans.do', options)
}

// 查询基币的汇率，对外暴露
export function queryExchange (options) {
  return get('/dtapi/api/futures/queryExchange.do', options)
}

// 查询单个期货产品的行情（行情源的数据）
export function querySingleMarket (options) {
  return get('/dtapi/api/futures/querySingleMarket.do', options)
}

// 新股列表
export function getNewGu (options) {
  return post('/dtapi/user/list.do', options)
}

// 新股申购
export function getNewAdd (options) {
  return post('/dtapi/user/add.do', options)
}

// 申购列表
export function getUserNewGuList (options) {
  return post('/dtapi/user/getOneSubscribeByUserId.do', options)
}

// 期货下单
export function buyFutures (options) {
  return post('/dtapi/user/buyFutures.do', options)
}

// 挂单
export function guadan (options) {
  return post('/dtapi/user/addOrder.do', options)
}

// 删除挂单
export function delGuaDan (options) {
  return post('/dtapi/user/delOrder.do', options)
}
// 挂单列表
export function getorderList (options) {
  return post('/dtapi/user/orderList.do', options)
}

// 美股详情
export function getUsDetail (options) {
  return post('/dtapi/api/stock/getSingleStockByCode.do', options)
}

// 下单
export function buy (options) {
  return post('/dtapi/user/buy.do', options)
}

// 指数下单
export function indexBuy (options) {
  return post('/dtapi/user/buyIndex.do', options)
}

// 用户平仓
export function sell (options) {
  return post('/dtapi/user/sell.do', options)
}

// 指数平仓
export function sellIndex (options) {
  return post('/dtapi/user/sellIndex.do', options)
}

// 期货平仓
export function sellFutures (options) {
  return post('/dtapi/user/sellFutures.do', options)
}

// /***用户中心***/
// 用户资金户转
export function AmtChange (options) {
  return post('/dtapi/user/transAmt.do', options)
}

// 用户详情
export function getUserInfo (options) {
  return post('/dtapi/user/getUserInfo.do', options)
}

// 添加银行卡
export function addBankCard (options) {
  return post('/dtapi/user/bank/add.do', options)
}

// 删除银行卡
export function delBankCard (options) {
  return post('/dtapi/user/bank/del.do', options)
}


// 修改银行卡
export function updateBankCard (options) {
  return post('/dtapi/user/bank/update.do', options)
}

// 获取银行卡信息
export function getBankCard (options) {
  return post('/dtapi/user/bank/getBankInfo.do', options)
}

// 获取用户银行卡列表
export function getBankList (options) {
  return post('/dtapi/user/bank/getBankList.do', options)
}

// 获取我的持仓单
export function getOrderList (options) {
  return post('/dtapi/user/position/list.do', options)
}

// 获取我的持仓单 - 指数
export function getIndexOrderList (options) {
  return post('/dtapi/user/index/position/list.do', options)
}

// 获取我的持仓单 - 期货
export function getFuturesOrderList (options) {
  return post('/dtapi/user/futures/position/list.do', options)
}

// 获取我的自选列表
export function getMyList (options) {
  return post('/dtapi/user/option/list.do', options)
}

// 实名认证
export function userAuth (options) {
  return post('/dtapi/user/auth.do', options)
}

// 资金明细
export function cashDetail (options) {
  return post('/dtapi/user/cash/list.do', options)
}

// 提现记录
export function rechargeList (options) {
  return post('/dtapi/user/recharge/list.do', options)
}

// 充值记录
export function withdrawList (options) {
  return post('/dtapi/user/withdraw/list.do', options)
}

// 充值
export function inMoney (options) {
  return post('/dtapi/user/recharge/inMoney.do', options)
}

// 提现
export function outMoney (options) {
  return post('/dtapi/user/withdraw/outMoney.do', options)
}

// 取消提现
export function canceloutMoney (options) {
  return post('/dtapi/user/withdraw/cancel.do', options)
}

// k线图
export function getMinK (options) {
  return post('/dtapi/api/stock/getMinK.do', options)
}

// k线图
export function getMinKEcharts (options) {
  return post('/dtapi/api/stock/getMinK_Echarts.do', options)
}

// 是否已添加自选
export function isOption (options) {
  return post('/dtapi/user/isOption.do', options)
}

// 获取网站设置信息
export function getSetting (options) {
  return post('/dtapi/api/admin/getSetting.do', options)
}

// 获取指数网站设置信息
export function getIndexSetting (options) {
  return post('/dtapi/api/admin/getIndexSetting.do', options)
}

// 获取期货网站设置信息
export function getFuturesSetting (options) {
  return post('/dtapi/api/admin/getFuturesSetting.do', options)
}

// 获取首页banner
export function getBannerByPlat (options) {
  return post('/dtapi/api/site/getBannerByPlat.do', options)
}

// 公告列表
export function getArtList (options) {
  return post('/dtapi/api/art/list.do', options)
}

// 公告详情
export function getArtDetail (options) {
  return post('/dtapi/api/art/detail.do', options)
}

// 获取支付渠道
export function getPayInfo (options) {
  return post('/dtapi/api/site/getPayInfo.do', options)
}

// 获取单个渠道信息
export function getPayInfoDetail (options) {
  return post('/dtapi/api/site/getPayInfoById.do', options)
}

// 获取网站设置信息
export function getInfoSite (options) {
  return post('/dtapi/api/site/getInfo.do', options)
}

// k线图 分时
export function getMinuteLine (options) {
  return post('/dtapi/api/realTime/findStock.do', options)
}

// 新增渠道  支付宝扫码
export function getjuhe1 (options) {
  return post('/dtapi/user/pay/juhe1.do', options)
}

//H5支付
export function getjuheH5 (options) {
  return post('/dtapi/user/pay/juheh5.do', options)
}

// 支付渠道
export function payLInk (url, options) {
  return post(url, options)
}

// 图片上传 uploadimg
export function uploadimg (options) {
  return post('/dtapi/user/upload.do', options)
}

// 查询点差费率
export function findSpreadRateOne (options) {
  return post('/dtapi/api/user/findSpreadRateOne.do', options)
}

// ==================最新修改内容：日线、添加自选等，2020年7月10日15:37:20======================
// 期货分钟-k线图
export function getFuturesMinKEcharts (options) {
  return post('/dtapi/api/stock/getFuturesMinK_Echarts.do', options)
}

// 指数分钟-k线图
export function getIndexMinKEcharts (options) {
  return post('/dtapi/api/stock/getIndexMinK_Echarts.do', options)
}

// 股票日线图
export function getDayK (options) {
  return post('/dtapi/api/stock/getDayK.do', options)
}

// 期货日线图
export function getFuturesDayK (options) {
  return post('/dtapi/api/stock/getFuturesDayK.do', options)
}

// 指数日线图
export function getIndexDayK (options) {
  return post('/dtapi/api/stock/getIndexDayK.do', options)
}

// 查询期货详情
export function queryFuturesByCode (options) {
  return get('/dtapi/api/futures/queryFuturesByCode.do', options)
}


// ==================最新修改内容：新版-新闻资讯、交易大厅，2020年8月26日10:39======================

// 查询期货详情
export function queryNewsList (type) {
  return get(`/dtapi/api/news/getNewsList.do?pageNum=1&pageSize=15&type=${type}`, {})
}

// 查询新闻详情
export function queryNewsDetail (type) {
  return get(`/dtapi/api/news/getDetail.do?id=${type}`, {})
}

// 配资申请-用户配资列表
export function getUserApplyList (options) {
  return post('/dtapi/user/funds/getUserApplyList.do', options)
}

// -----分仓配资----- 2020 08 30

export function getFundsSetting (options) {
  return post('/dtapi/user/funds/getFundsSetting.do', options)
}

// 查询配资类型杠杆
export function getFundsTypeList (options) {
  return post('/dtapi/user/funds/getFundsTypeList.do', options)
}

// 配资申请-添加
export function addFundsApply (options) {
  return post('/dtapi/user/funds/addFundsApply.do', options)
}
//分仓下单
export function buyFunds (options) {
  return post('/dtapi/user/funds/buyFunds.do', options)
}

// 配资申请-用户操盘中子账户
export function getUserSubaccount (options) {
  return post('/dtapi/user/funds/getUserSubaccount.do', options)
}

// 获取消息列表
export function getNoticeList(options) {
  return post('/dtapi/user/cash/getMessagelist.do', options)
}

// 分仓交易-获取我的配资持仓单
export function getFundsOrderList (options) {
  return post('/dtapi/user/funds/fundsList.do', options)
}

// 分仓交易-配资平仓
export function sellFunds (options) {
  return post('/dtapi/user/funds/sellFunds.do', options)
}

export function getZs() {
  return get('https://69.push2.eastmoney.com/api/qt/clist/get?pn=1&pz=25&po=1&np=1&ut=bd1d9ddb04089700cf9c27f6f7426281&fltt=2&invt=2&wbp2u=|0|0|0|web&fid=&fs=b:MK0010&fields=f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f12,f13,f14,f15,f16,f17,f18,f20,f21,f23,f24,f25,f26,f22,f11,f62,f128,f136,f115,f152&_=1666359071216')
}
