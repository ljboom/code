import Vue from 'vue'
import Router from 'vue-router'
import i18n from '@/locales/index.js'
import Home from '@/page/home/home'
import Buy from '@/page/home/buy'
import Alertdetail from '@/page/home/components/alert' // 公告详情
import Register from '@/page/register'
import Forget from '@/page/forget'
import Login from '@/page/login'
import List from '@/page/list/list'
import TradingList from '@/page/list/trading-list'
import Searchlist from '@/page/list/list-search'
import IndexSearchlist from '@/page/list/indexlist-search' // 指数查询
import SearchMylist from '@/page/list/my-list-search'
import ListDetail from '@/page/list/listDetail'
import ListDetail2 from '@/page/list/detail2'
import MyList from '@/page/list/my-list'
import Inquiry from '@/page/home/inquiry'
import OrderList from '@/page/user/order-list'
import Warehouse from '@/page/user/Warehouse.vue'
import NewStockDetail from '@/page/user/newStockDetail.vue'
import StockDetail from '@/page/user/stockDetail.vue'
import Warehousedetail from '@/page/user/Warehousedetail.vue'
import holdOrderList from '@/page/user/search-order/hold-stockCode'
import holdOrderList2 from '@/page/user/search-order/hold-stockSpell'
import sellOrderList from '@/page/user/search-order/sell-stockCode'
import sellOrderList2 from '@/page/user/search-order/sell-stockSpell'
import Detail from '@/page/user/detail'
import Card from '@/page/user/card'
import Authentication from '@/page/user/authentication'
import Aggre from '@/page/user/agreement'
import Recharge from '@/page/user/recharge'
import RechargeSure from '@/page/user/recharge-sure'
import RechargeList from '@/page/user/rechargelist'
import Cash from '@/page/user/cash'
import Cashlist from '@/page/user/cashlist'
import AddCard from '@/page/user/addCard'
import Setting from '@/page/user/my'
import Transfer from '@/page/user/transfer'
import IndexList from '@/page/list/index-list'
import indexBuy from '@/page/home/index-buy'
import TwoBuy from '@/page/home/two-buy'
import SubWarehouseBuy from '@/page/home/sub-warehouse-buy'
import futuresBuy from '@/page/home/futures-buy'
import Agree from '@/page/registerAgree'
import Trage from '@/page/tradeAgree'
import OpenAccount from '@/page/openaccount'
import FundsList from '@/page/funds/funds-list'
import newLogin from '@/page/login/login.vue'
import newRegister from '@/page/login/register.vue'
import NewPage from '@/page/home/newPage'
import NewGg from '@/page/home/newGg'
import KLine from '@/page/kline/index.vue'
import TradingBuy from '@/page/trading/buy.vue'
import NewUser from '@/page/newUser/index.vue'
import Wallet from '@/page/wallet/index.vue';
import TransferRecord from '@/page/transferRecord/index.vue'
import CashWithdrawalRecord from '@/page/cashWithdrawalRecord/index.vue'
import Transfers from '@/page/transfer/index.vue'
import Authentications from '@/page/authentication/index.vue'
import BankCard from '@/page/bankCard/index.vue'
import EditBankCard from '@/page/bankCard/bankEdit.vue'
import service from '@/page/service/service.vue'
Vue.use(Router)

const routerPush = Router.prototype.push
Router.prototype.push = function push(location) {
  return routerPush.call(this, location).catch(error => error)
}
export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/home'
    }, {
      path: '/home',
      name: 'home',
      meta: {
        title: i18n.t('hj224'),
        requireAuth: true,
        index: 0
      },
      component: Home
    }, {
      path: '/buy',
      name: 'buy',
      meta: {
        title: i18n.t('hj237'),
        requireAuth: true,
        hasHeader: true,
        index: 1
      },
      component: Buy
    }, {
      path: '/newPage',
      name: 'newPage',
      meta: {
        title: i18n.t('hj238'),
        hasHeader: true,
        is_Show: true,
        index: 2
      },
      component: NewPage
    },
    {
      path: '/newGg',
      name: 'newGg',
      meta: {
        title: i18n.t('hj239'),
        hasHeader: true,
        is_Show: true,
        index: 49
      },
      component: NewGg
    },
    // {
    //   path: '/register',
    //   name: 'register',
    //   meta: {
    //     title: '注册',
    //     index: 3
    //   },
    //   component: Register
    // }, 
    {
      path: '/forget',
      name: 'forget',
      meta: {
        title: i18n.t('hj240'),
        index: 4
      },
      component: Forget
    },
    // {
    //   path: '/login',
    //   name: 'login',
    //   meta: {
    //     title: '账户登录',
    //     hasHeader: true,
    //     index: 5
    //   },
    //   component: Login
    // },
    {
      path: '/openaccount',
      name: 'openaccount',
      meta: {
        title: i18n.t('hj241'),
        hasHeader: true,
        index: 6
      },
      component: OpenAccount
    },
    {
      path: '/trading-list',
      name: 'TradingList',
      meta: {
        title: i18n.t('hj242'),
        requireAuth: false,
        hasHeader: false,
        index: 7
      },
      component: TradingList
    }
    // {
    //   path: '/list',
    //   name: 'list',
    //   meta: {
    //     title: '行情',
    //     requireAuth: false,
    //     hasHeader: false,
    //     index: 7
    //   },
    //   component: List
    // }
    , {
      path: '/indexsearchlist',
      name: '指数查询',
      meta: {
        title: '指数查询',
        index: 8
      },
      component: IndexSearchlist
    }, {
      path: '/indexlist',
      name: 'indexlist',
      meta: {
        title: '指数列表',
        requireAuth: false,
        index: 9
      },
      component: IndexList
    }, {
      path: '/searchlist',
      name: '个股查询',
      meta: {
        title: '个股查询',
        index: 10
      },
      component: Searchlist
    }, {
      path: '/searchmylist',
      name: 'searchmylist',
      meta: {
        title: '自选查询',
        requireAuth: true,
        index: 11
      },
      component: SearchMylist
    }, {
      path: '/mylist',
      name: 'mylist',
      meta: {
        title: '自选列表',
        requireAuth: true,
        hasHeader: true,
        index: 12

      },
      component: MyList
    }, {
      path: '/listdetail',
      name: 'listdetail',
      meta: {
        title: i18n.t('hj238'),
        requireAuth: false,
        hasHeader: false,
        index: 13
      },
      component: ListDetail
    }, {
      path: '/listdetail2',
      name: 'listdetail2',
      meta: {
        title: i18n.t('hj238'),
        requireAuth: false,
        hasHeader: true,
        index: 14
      },
      component: ListDetail2
    },
    {
      path: '/indexBuy',
      name: 'indexBuy',
      meta: {
        title: '指数购买',
        requireAuth: false,
        hasHeader: true,
        iconRight: 'search',
        index: 15
      },
      component: indexBuy
    },
    {
      path: '/twoBuy',
      name: 'TwoBuy',
      meta: {
        title: '两融交易',
        requireAuth: false,
        hasHeader: true,
        iconRight: 'search',
        index: 16
      },
      component: TwoBuy
    },
    {
      path: '/subWarehouseBuy',
      name: 'SubWarehouseBuy',
      meta: {
        title: '分仓交易',
        requireAuth: false,
        hasHeader: true,
        iconRight: 'search',
        index: 17
      },
      component: SubWarehouseBuy
    }, {
      path: '/futuresBuy',
      name: 'futuresBuy',
      meta: {
        title: '期货购买',
        requireAuth: false,
        hasHeader: true,
        index: 18
      },
      component: futuresBuy
    }, {
      path: '/inquiry',
      name: 'inquiry',
      meta: {
        title: '询价',
        requireAuth: true,
        index: 19
      },
      component: Inquiry
    },
    // {
    //   path: '/user',
    //   name: 'user',
    //   meta: {
    //     title: '我的',
    //     requireAuth: false,
    //     hasHeader: true,
    //     index: 20
    //   },
    //   component: User
    // },
    {
      path: '/transfer',
      name: 'transfer',
      meta: {
        title: '资金互转',
        requireAuth: true,
        index: 21
      },
      component: Transfer
    },
    // {
    //   path: '/orderlist',
    //   name: 'orderlist',
    //   meta: {
    //     title: '持仓',
    //     requireAuth: false,
    //     hasHeader: true,
    //     index: 22
    //   },
    //   component: OrderList
    // },
    {
      path: '/warehouse',
      name: 'Warehouse',
      meta: {
        title: i18n.t('hj2'),
        requireAuth: false,
        hasHeader: false,
        index: 22
      },
      component: Warehouse
    },
    {
      path: '/warehousedetail',
      name: 'Warehousedetail',
      meta: {
        title: i18n.t('hj2'),
        requireAuth: true,
        hasHeader: false,
        index: 22,
        show: true
      },
      component: Warehousedetail
    },
    {
      path: '/holdorderlist',
      name: 'holdorderlist',
      meta: {
        title: '查询持仓',
        requireAuth: true,
        hasHeader: true,
        index: 23
      },
      component: holdOrderList
    }, {
      path: '/holdorderlist2',
      name: 'holdorderlist2',
      meta: {
        title: '查询持仓',
        requireAuth: true,
        hasHeader: true,
        index: 24
      },
      component: holdOrderList2
    }, {
      path: '/sellorderlist',
      name: 'sellorderlist',
      meta: {
        title: '查询平仓',
        requireAuth: true,
        hasHeader: true,
        index: 25
      },
      component: sellOrderList
    }, {
      path: '/sellorderlist2',
      name: 'sellorderlist2',
      meta: {
        title: '查询平仓',
        requireAuth: true,
        hasHeader: true,
        index: 26
      },
      component: sellOrderList2
    }, {
      path: '/detail',
      name: 'detail',
      meta: {
        title: '资金明细',
        requireAuth: true,
        hasHeader: true,
        index: 27
      },
      component: Detail
    }, {
      path: '/card',
      name: 'card',
      meta: {
        title: '银行卡',
        requireAuth: true,
        hasHeader: true,
        index: 28
      },
      component: Card
    }, {
      path: '/authentication',
      name: 'authentication',
      meta: {
        title: '认证',
        requireAuth: true,
        hasHeader: true,
        index: 29
      },
      component: Authentication
    }, {
      path: '/aggre',
      name: 'aggre',
      meta: {
        title: '合作协议',
        requireAuth: true,
        index: 30
      },
      component: Aggre
    }, {
      path: '/recharge',
      name: 'recharge',
      meta: {
        title: '充值',
        requireAuth: true,
        hasHeader: true,
        index: 31

      },
      component: Recharge
    }, {
      path: '/rechargeSure',
      name: 'rechargeSure',
      meta: {
        title: '确认充值',
        requireAuth: true,
        hasHeader: true,
        index: 32

      },
      component: RechargeSure
    }, {
      path: '/rechargelist',
      name: 'rechargelist',
      meta: {
        title: '充值记录',
        requireAuth: true,
        hasHeader: true,
        index: 33
      },
      component: RechargeList
    }, {
      path: '/cash',
      name: 'cash',
      meta: {
        title: '提现',
        requireAuth: true,
        hasHeader: true,
        index: 34
      },
      component: Cash
    }, {
      path: '/addCard',
      name: 'addCard',
      meta: {
        title: '添加银行卡',
        requireAuth: true,
        hasHeader: true,
        index: 35

      },
      component: AddCard
    }, {
      path: '/cashlist',
      name: 'cashlist',
      meta: {
        title: '提现记录',
        requireAuth: true,
        hasHeader: true,
        index: 36

      },
      component: Cashlist
    }, {
      path: '/setting',
      name: 'setting',
      meta: {
        title: '设置',
        requireAuth: true,
        index: 37
      },
      component: Setting
    }, {
      path: '/agree',
      name: 'agree',
      meta: {
        title: '注册协议',
        requireAuth: true,
        index: 38
      },
      component: Agree
    }, {
      path: '/trade',
      name: 'trade',
      meta: {
        title: '交易⻛险揭示书',
        requireAuth: true,
        index: 39
      },
      component: Trage
    },
    {
      path: '/alertdetail',
      name: 'alertdetail',
      meta: {
        title: '公告详情',
        requireAuth: true,
        index: 40
      },
      component: Alertdetail
    },
    {
      path: '/funds',
      name: 'funds',
      meta: {
        title: '配资主页',
        requireAuth: true,
        hasHeader: true,
        iconRight: 'setting',
        index: 41
      },
      component: () => import('../page/funds/index')
    },
    {
      path: '/days',
      name: 'days',
      meta: {
        title: '按天配资',
        requireAuth: true,
        hasHeader: true,
        iconRight: 'setting',
        index: 42
      },
      component: () => import('../page/funds/days')
    },
    {
      path: '/xingu',
      name: 'xingu',
      meta: {
        title: '新股申购',
        requireAuth: true,
        hasHeader: true,
        iconRight: 'setting',
        index: 43
      },
      component: () => import('../page/funds/xingu')
    },
    {
      path: '/searchStock',
      name: 'searchStock',
      meta: {
        title: '查询股票',
        requireAuth: true,
        hasHeader: true,
        index: 44
      },
      component: () => import('../page/list/search')
    },
    {
      path: '/notify',
      name: 'notify',
      meta: {
        title: '消息记录',
        requireAuth: true,
        hasHeader: true,
        index: 45
      },
      component: () => import('../page/user/notify')
    }, {
      path: '/fundslist',
      name: 'fundslist',
      meta: {
        title: '分仓配资',
        requireAuth: false,
        hasHeader: true,
        index: 46,
      },
      component: FundsList
    },
    {
      path: '/login',
      name: 'newLogin',
      meta: {
        title: i18n.t('hj248'),
        requireAuth: false,
        hasHeader: false,
        index: 47,
        show: true
      },
      component: newLogin
    },
    {
      path: '/register',
      name: 'newRegister',
      meta: {
        title: i18n.t('hj249'),
        requireAuth: false,
        hasHeader: false,
        index: 48,
        show: true
      },
      component: newRegister
    },
    {
      path: '/kline',
      name: 'kline',
      meta: {
        title: i18n.t('hj238'),
        requireAuth: false,
        hasHeader: false,
        index: 49,
        show: true
      },
      component: KLine
    },
    {
      path: '/TradingBuy',
      name: 'TradingBuy',
      meta: {
        title: i18n.t('hj237'),
        requireAuth: false,
        hasHeader: false,
        index: 50,
        show: true
      },
      component: TradingBuy
    },
    {
      path: '/User',
      name: 'NewUser',
      meta: {
        title: i18n.t('hj243'),
        requireAuth: false,
        hasHeader: false,
        index: 51,
      },
      component: NewUser
    },
    {
      path: '/wallet',
      name: 'Wallet',
      meta: {
        title: i18n.t('hj244'),
        requireAuth: false,
        hasHeader: false,
        index: 52,
      },
      component: Wallet
    },
    {
      path: '/transferRecord',
      name: 'transferRecord',
      meta: {
        title: i18n.t('hj168'),
        requireAuth: false,
        hasHeader: false,
        index: 53,
        show: true
      },
      component: TransferRecord
    },
    {
      path: '/cashWithdrawalRecord',
      name: 'cashWithdrawalRecord',
      meta: {
        title: i18n.t('hj162'),
        requireAuth: false,
        hasHeader: false,
        index: 54,
        show: true
      },
      component: CashWithdrawalRecord
    },
    {
      path: '/transfers',
      name: 'transfers',
      meta: {
        title: i18n.t('hj245'),
        requireAuth: false,
        hasHeader: false,
        index: 55,
        show: true
      },
      component: Transfers
    },
    {
      path: '/authentications',
      name: 'authentications',
      meta: {
        title: i18n.t('hj246'),
        requireAuth: false,
        hasHeader: false,
        index: 56,
        show: true
      },
      component: Authentications
    },
    {
      path: '/bankCard',
      name: 'bankCard',
      meta: {
        title: i18n.t('hj247'),
        requireAuth: false,
        hasHeader: false,
        index: 57,
        show: true
      },
      component: BankCard
    },
    {
      path: '/bankEdit',
      name: 'bankEdit',
      meta: {
        title: i18n.t('hj247'),
        requireAuth: false,
        hasHeader: false,
        index: 58,
        show: true
      },
      component: EditBankCard
    },
    {
      path: '/service',
      name: 'service',
      meta: {
        title: '客服',
        requireAuth: false,
        hasHeader: false,
        index: 59,
        show: true
      },
      component: service
    },
    {
      path: '/newStockDetail',
      name: 'newStockDetail',
      meta: {
        title: "新股详情",
        requireAuth: false,
        hasHeader: false,
        index: 60,
        show: true
      },
      component: NewStockDetail
    },
    {
      path: '/stockDetail',
      name: 'stockDetail',
      meta: {
        title: "平仓详情",
        requireAuth: false,
        hasHeader: false,
        index: 61,
        show: true
      },
      component: StockDetail
    },
    {
      // 会匹配所有路径
      path: '*',
      redirect: '/home'
    }
  ]
})
