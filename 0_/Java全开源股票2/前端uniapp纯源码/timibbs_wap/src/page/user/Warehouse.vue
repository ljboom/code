<template>
  <div class="warehouse_page">
    <div class="content">
      <div class="top_title" :class="titleDialog ? 'active' : ''" ref="topTitle">
        <div class="titles">
          <div class="left_title" @click="handleOpenDialog()">
            <div class="title">
              <span>{{ titleName }}</span>
            </div>
            <div class="img">
              <img src="../../assets/img/xiala.png" alt />
            </div>
          </div>
          <div class="right_box"></div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(0)">
          <div class="left_titles">
            <span>{{ $t('hj293') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(1)">
          <div class="left_titles">
            <span>{{ $t('hj294') }}(USD)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(2)">
          <div class="left_titles">
            <span>{{ $t('hj295') }}(HKD)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <div class="overflow_box item" @click="SetTitleIndex(3)">
          <div class="left_titles">
            <span>{{ $t('hj296') }}(MYR)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <div class="overflow_box item" @click="SetTitleIndex(4)">
          <div class="left_titles">
            <span>{{ $t('hj297') }}(THB)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <div class="overflow_box item" @click="SetTitleIndex(5)">
          <div class="left_titles">
            <span>{{ $t('hj283') }}(INR)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <div class="overflow_box item" @click="SetTitleIndex(6)">
          <div class="left_titles">
            <span>{{ $t('hj301') }}(USD)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <!-- 新股<div class="overflow_box item" @click="SetTitleIndex(7)">
          <div class="left_titles">
            <span>{{ $t('hj116') }}(USD)</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div> -->

      </div>
      <div class="warehouse_card">
        <div class="top_card" v-if="titleIndex !== 0">
          <div class="card_content">
            <div class="t_title">
              <span>{{ $t('hj49') }}</span>
            </div>
            <div class="t_price">
              <p class="price">
                {{ userAmt | formatDecimal }}
                <span>({{ currency }})</span>
              </p>
            </div>
            <div class="balance">
              <div class="left_titles">
                {{ $t('hj50') }}
              </div>
              <div class="right_titles">
                {{ $t('hj54') }}
              </div>
            </div>
            <div class="num">
              <div class="left_price">
                <span>{{ userLiquidationAmt | formatDecimal }}</span>
              </div>
              <div class="right_margin">
                <span>{{ userEnableAmt | formatDecimal }}</span>
              </div>
            </div>
            <div class="margin">
              <div class="left_titles">
                {{ $t('hj55') }}
              </div>
              <div class="right_titles">
                {{ $t('hj56') }}
              </div>
            </div>
            <div class="prices">
              <div class="left_titles">
                <span class="numDemo">{{ userFreezAmt | formatDecimal }}</span>
                <span class="numDemo" v-show="titleIndex == 0">{{ '¥ ' +
                  $store.state.userInfo.allFreezAmt ? $store.state.userInfo.allFreezAmt : '0.00'
                }}</span>
                <span class="numDemo" v-show="titleIndex == 7">{{ '¥ ' +
                  $store.state.userInfo.djzj ? $store.state.userInfo.djzj : '0.00'
                }}</span>
              </div>
              <div class="right_titles">
                <span class="numDemo" :class="userProfitAndLose > 0 ? ' red' : userProfitAndLose < 0 ? ' green' : ''">{{
                  userProfitAndLose | formatDecimal }}</span>
                <span class="numDemo"
                  :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                  v-show="titleIndex == 0 || titleIndex == 7">{{ '¥ ' +
                    $store.state.userInfo.allProfitAndLose ? $store.state.userInfo.allProfitAndLose : '0.00'
                  }}</span>

              </div>
            </div>
          </div>
        </div>
        <div class="tabs_card">
          <div class="tabs_card_content">
            <div class="tabs_top_title">
              <div class="title_items" v-for="(item, index) in tabsArr" :key="index" @click="handleTabsClick(item, index)"
                :class="index == 0 ? 'kuan' : 'kuan'">
                <span :class="tabsCurrentIndex === index ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total + ')' : index == 1 ? '(' + totalss + ')' : index == 2 ? '(' +
                    totals + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>
            </div>
            <!-- 持仓 currentIndex: 0 -->
            <div class="over">
              <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                v-show="tabsCurrentIndex === 0 && total != 0" @load="onLoad" :immediate-check="immediate">
                <div class="tabs_o">
                  <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr" :key="item.buyOrderId"
                    @click="getdetail(item, 0)">

                    <div class="tabs_o_title">
                      <!-- 类型 -->
                      <span v-if="item.stockGid.includes('us')" class="backGsz"
                        style="background: rgb(32, 99, 226);">US</span>
                      <span v-if="item.stockGid.includes('hk')" class="backGsz"
                        style="background: rgb(81, 164, 99);">HK</span>
                      <span v-if="item.stockGid.includes('my')" class="backGsz"
                        style="background: rgb(47, 44, 255);">MY</span>
                      <span v-if="item.stockGid.includes('th')" class="backGsz"
                        style="background: rgb(69, 136, 37);">TH</span>
                      <span v-if="item.stockGid.includes('in')" class="backGsz"
                        style="background: rgb(235, 46, 203);">IN</span>
                      <!-- 持仓方向 -->
                      <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                        {{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>
                      <!-- 股票名称 -->
                      <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                    </div>

                    <div class="right_btn pingbtn" @click.stop="getpingcang(item.positionSn)">
                      <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                    </div>

                    <div style="display: flex;">
                      <div>
                        <div class="center_price">
                          <span class="multiple">{{ item.orderLever }}X</span>
                          <span class="nums">{{ item.orderNum / 100 }}Lot</span>
                        </div>
                      </div>

                      <div class="profit">

                        <span class="green" style="font-weight:800;">{{ item.profitAndLose | formatDecimal }}({{
                          (item.profitAndLose > 0) ? "+" : "-" }}{{ (((item.now_price - item.buyOrderPrice) /
    item.buyOrderPrice) * 100).toFixed(2) }}%)</span>
                      </div>

                    </div>

                    <div style="width: 100%; margin-top: 0.2rem;">
                      <div class="center_price" style="margin-top: 5px;">
                        <div class="start_price jiantou">
                          <span>{{ item.buyOrderPrice | formatDecimal }}</span>
                        </div>

                        <path
                          d="M885.113 489.373L628.338 232.599c-12.496-12.497-32.758-12.497-45.254 0-12.497 12.497-12.497 32.758 0 45.255l203.3 203.3H158.025c-17.036 0-30.846 13.811-30.846 30.846 0 17.036 13.811 30.846 30.846 30.846h628.36L583.084 746.147c-12.497 12.496-12.497 32.758 0 45.255 6.248 6.248 14.438 9.372 22.627 9.372s16.379-3.124 22.627-9.372l256.775-256.775a31.999 31.999 0 0 0 0-45.254z"
                          fill="var(--c-font-text-c2)" p-id="2661"></path>

                        <div class="new_price">
                          <span>{{ item.now_price | formatDecimal }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="start_price">
                          <span>{{ $t('hj119') }}</span>
                        </div>
                        <div class="new_price">
                          <span>{{ $t('hj120') }}</span>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </van-list>
              <div class="waiting" v-if="total == 0 && tabsCurrentIndex === 0">
                <div class="waiting_box">
                  <div class="img_cont">
                    <img src="../../assets/img/zhaobudao.png" alt />
                    <span class="gd">{{ $t('hj122') }}</span>
                    <div class="trading" @click="$router.push('/trading-list')">
                      <span>{{ $t('hj123') }}</span>
                    </div>
                  </div>
                </div>
              </div>



              <!-- 挂单 -->
              <div class="waiting" v-if="totalss == 0 && tabsCurrentIndex === 1">
                <div class="waiting_box">
                  <div class="img_cont">
                    <img src="../../assets/img/zhaobudao.png" alt />
                    <span class="gd">{{ $t('hj124') }}</span>
                    <div class="trading" @click="$router.push('/trading-list')">
                      <span>{{ $t('hj123') }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                v-show="tabsCurrentIndex === 1 && totalss != 0" :immediate-check="immediate">
                <div class="tabs_o">
                  <div class="tabs_o_items" v-for="(item, index) in tabsOrderList" :key="item.id">
                    <div class="tabs_o_title">
                      <div>
                        <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                        <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">{{
                          item.buyType == 1 ? $t('hj84') : $t('hj85')
                        }}</span>
                        <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">{{
                          item.status == 1 ? $t('hj254') : $t('hj255')
                        }}</span>
                        <span class="multiple">{{ item.lever }}X</span>
                        <span class="nums">{{ item.buyNum / 100 + $t('hj117') }}</span>
                      </div>

                      <div class="right_btn pingbtn" @click="gdClose(item)">
                        <span style="margin-right: 0;">{{ $t('hj126') }}</span>
                      </div>
                    </div>
                    <div class="center_price">
                      <div class="start_price jiantou">
                        <span>{{ item.targetPrice }}</span>
                      </div>
                      <div class="new_price">
                        <span>{{ item.nowPrice }}</span>
                      </div>
                    </div>
                    <div class="bottom_price_title">
                      <div class="start_price">
                        <span>{{ $t('hj125') }}</span>
                      </div>
                      <div class="new_price">
                        <span>{{ $t('hj120') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </van-list>




              <!-- 平仓 -->
              <div class="waiting" v-if="totals == 0 && tabsCurrentIndex === 2">
                <div class="waiting_box">
                  <div class="img_cont">
                    <img src="../../assets/img/zhaobudao.png" alt />
                    <span class="gd">{{ $t('hj127') }}</span>
                    <div class="trading" @click="$router.push('/trading-list')">
                      <span>{{ $t('hj123') }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals != 0">
                <div class="tabs_o">
                  <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr" :key="index"
                    @click="getdetail(item, 1)">
                    <div class="tabs_o_title">
                      <div>
                        <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                        <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">{{
                          item.orderDirection == "买跌" ?
                          $t('hj84') : $t('hj85')
                        }}</span>
                        <span class="multiple">{{ item.allProfitAndLose }}</span>
                        <span class="nums">{{ item.orderNum / 100 + $t('hj117') }}</span>
                      </div>
                      <div class="right_count"
                        :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? '' : 'green'">
                        <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                      </div>
                    </div>
                    <div class="bottom_price_title">
                      <div class="profit_res">
                        <span>{{ $t('hj128') }}: {{ item.sellOrderTime | gettime }}</span>
                      </div>
                    </div>

                  </div>
                </div>
              </van-list>
              <!-- 新股筛选列表 -->
              <van-dropdown-menu style="padding: 0rem;width: calc(100% + 0.6rem);margin-left: -0.3rem;" title="新股分類"
                v-show="tabsCurrentIndex == 3">
                <van-dropdown-item v-model="xgStatus" :options="xgStatusList" @change="marketChange" />
                <van-dropdown-item v-model="xgPayStatus" :options="xgPayStatusList" @change="newStockChange"
                  :disabled="isDisabled" />
              </van-dropdown-menu>
              <!-- 新股 -->
              <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                <div class="waiting_box">
                  <div class="img_cont">
                    <img src="../../assets/img/zhaobudao.png" alt />
                    <span class="gd">{{ $t('hj129') }}</span>
                    <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 5 } })">
                      <span>{{ $t('hj123') }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <van-list v-model="loadingXg" :finished="finishedXg" :finished-text="$t('hj43')"
                v-show="tabsCurrentIndex === 3 && xgTotal != 0" @load="onLoadXg" :immediate-check="immediate">
                <div class="tabs_o">
                  <div class="tabs_o_items" v-for="(item, index) in tabsXgArr" :key="item.id">
                    <div class="tabs_o_title">
                      <!-- 类型 -->
                      <span v-if="item.stockType === 'us'" class="backGsz" style="background: rgb(32, 99, 226);">US</span>
                      <span v-if="item.stockType === 'hk'" class="backGsz" style="background: rgb(81, 164, 99);">HK</span>
                      <span v-if="item.stockType === 'my'" class="backGsz" style="background: rgb(47, 44, 255);">MY</span>
                      <span v-if="item.stockType === 'th'" class="backGsz" style="background: rgb(69, 136, 37);">TH</span>
                      <span v-if="item.stockType === 'in'" class="backGsz"
                        style="background: rgb(235, 46, 203);">IN</span>
                      <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">{{
                        $t('hj45')
                      }}</span>
                      <span class="title">{{ item.newName }}</span>
                      <!-- <span class="multiple">{{ item.lever  }}X</span>
                      <span class="nums">{{ item.buyNum / 100 + '手' }}</span> -->
                    </div>
                    <div style="display: flex;align-items: center;justify-content: space-between;">
                      <div style="width: 100%;">
                        <div class="center_price">
                          <div class="start_price jiantou">
                            <span>{{ item.buyPrice }}</span>
                          </div>
                          <div class="new_price" v-if="item.status != 3">
                            <span>{{ item.applyNums }}</span>
                          </div>
                          <div class="new_price" v-else>
                            <span>{{ item.applyNumber }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">

                          <div class="start_price">
                            <span>{{ $t('hj130') }}</span>
                          </div>
                          <div class="new_price" v-if="item.status != 3">
                            <span>{{ $t('hj57') }}</span>
                          </div>
                          <div class="new_price" v-else>
                            <span>{{ $t('hj253') }}</span>
                          </div>
                        </div>
                      </div>

                      <div class="right_btn" style="padding: 0 0.2rem;" @click="getrenjiao(item)"
                        :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                          : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                        <span>{{ item.status == 1 ?
                          $t('hj131') : item.status == 2 ? $t('hj132')
                            : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') :
                              item.status == 5 ?
                                $t('hj135')
                                : ''
                        }}</span>
                      </div>
                      <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                        style="width: 2rem !important;" @click="getrenjiao(item)">
                        {{ $t('hj250') }}
                      </div>
                    </div>


                  </div>
                </div>
              </van-list>


            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="dialog" v-if="titleDialog" @click="titleDialog = false"></div>
  </div>
</template>

<script>
import { Toast } from 'vant';
import { MessageBox } from 'mint-ui'
import * as api from "@/axios/api";

export default {
  data() {
    return {
      isDisabled: false,
      xgStatus: "",
      xgPayStatus: "",
      xgStatusVal: "",
      xgStatusList: [
        { text: this.$t('hj365'), value: "" },
        { text: this.$t('hj132'), value: 2 },
        { text: this.$t('hj133'), value: 3 },
        { text: this.$t('hj364'), value: 6 },
      ],
      xgPayStatusList: [
        { text: this.$t('hj160'), value: "" },
        { text: this.$t('hj363'), value: 3 },
        { text: this.$t('hj134'), value: 4 },
      ],
      currency: "",//货币符号
      userAmt: 0.000, //总金额
      userEnableAmt: 0.000,//可用金额
      userLiquidationAmt: 0.000, //强平金额
      userFreezAmt: 0.000,//保证金
      userProfitAndLose: 0.000,//持倉總盈虧
      tabsArr: [this.$t('hj2'), this.$t('hj109'), this.$t('hj136'), this.$t('hj3')],
      tabsCurrentIndex: 0,
      titleName: this.$t('hj293'),
      indexSettingInfo: {},
      futuresSettingInfo: {},
      tabsPositionNumArr: [],
      titleIndex: 0,
      settingInfo: {},
      tabsPcArr: [],
      titleDialog: false,
      total: 0,
      totals: 0,
      totalss: 0,
      loading: false,
      finished: false,
      finisheds: false,
      finishedss: false,
      page: 1,
      pages: 1,
      pagess: 1,
      immediate: false,
      loadings: false,
      loadingss: false,
      tabsOrderList: [],
      xgTotal: 0,
      tabsXgArr: [],
      loadingXg: false,
      finishedXg: false,
      stockType: "", //股票类型
    };
  },
  mounted() {
    this.getListDetail();
    this.getUserInfo();
    this.getIndexSettingInfo();
    this.getSettingInfo();
    this.getFuturesSetting();
    this.getListDetails();
    this.getorderList();
    this.getNewXg();

    setTimeout(() => {
      //3秒再更新异步数据
      window.localStorage.setItem("warehouse_total", this.total + this.xgTotal);
    }, 3000)

  },
  watch: {
  },
  created() {
    if (this.$route.query.index) {
      this.tabsCurrentIndex = Number(this.$route.query.index)
    }

  },
  methods: {
    marketChange(value) {
      if (value != "") {
        this.xgPayStatus = "";
        this.isDisabled = true;
      }
      if (value === "") {
        this.isDisabled = false;
      }
      //重新加载新股
      this.xgStatusVal = value;
      this.getNewXg();
    },
    newStockChange(value) {
      //重新加载新股
      this.xgStatusVal = value;
      this.getNewXg();
    },
    initUserCardMoney() {
      //初始化用户卡片余额
      if (this.titleIndex != 6 && this.titleIndex != 0) {
        var userInfo = this.$store.state.userInfo;
        var currencyMap = {
          "1": { currency: "USD", enableAmtKey: "usEnableAmt", userAmtKey: "usUserAmt", freezAmtKey: "usFreezAmt", profitAndLoseKey: "usProfitAndLose", stockType: "us" },
          "2": { currency: "HKD", enableAmtKey: "hkEnableAmt", userAmtKey: "hkUserAmt", freezAmtKey: "hkFreezAmt", profitAndLoseKey: "hkProfitAndLose", stockType: "hk" },
          "3": { currency: "MYR", enableAmtKey: "myEnableAmt", userAmtKey: "myUserAmt", freezAmtKey: "myFreezAmt", profitAndLoseKey: "myProfitAndLose", stockType: "my" },
          "4": { currency: "THB", enableAmtKey: "thEnableAmt", userAmtKey: "thUserAmt", freezAmtKey: "thFreezAmt", profitAndLoseKey: "thProfitAndLose", stockType: "th" },
          "5": { currency: "INR", enableAmtKey: "inEnableAmt", userAmtKey: "inUserAmt", freezAmtKey: "inFreezAmt", profitAndLoseKey: "inProfitAndLose", stockType: "in" },
        };

        var currencyInfo = currencyMap[this.titleIndex];
        this.currency = currencyInfo.currency;
        this.userEnableAmt = userInfo[currencyInfo.enableAmtKey];
        this.userAmt = userInfo[currencyInfo.userAmtKey];
        this.userLiquidationAmt = (userInfo[currencyInfo.enableAmtKey] + userInfo[currencyInfo.freezAmtKey]) * this.settingInfo.forceStopPercent;
        this.userFreezAmt = userInfo[currencyInfo.freezAmtKey];
        this.userProfitAndLose = userInfo[currencyInfo.profitAndLoseKey];
        this.stockType = currencyInfo.stockType;
      } else {
        //期货
        this.currency = "USD";
        this.stockType = "";
      }

    },
    getdetail(item, type) {
      const route = {
        name: 'stockDetail',
        params: {
          data: item,
          type: type
        }
      }
      this.$openPageParams(route, true, true)

    },
    getrenjiao(val) {
      console.log(val);
      this.$router.push({ name: 'newStockDetail', params: val })
      return false;
      //进入认缴详情页
      MessageBox.confirm(this.$t('hj251') + '?', this.$t('hj165'), {
        confirmButtonText: this.$t('hj161'),
        cancelButtonText: this.$t('hj106'),
      }).then(async () => {
        let opt = {
          id: val
        }
        let data = await api.submitSubscribe(opt)
        if (data.status == 0) {
          Toast(data.msg)
          this.finishedXg = false;
          this.getNewXg();
          this.getUserInfo();
        } else {
          Toast(data.msg)
        }
      }).catch(() => {

      });
    },
    getpingcang(val) {
      if (!this.$store.state.userInfo.idCard) {
        Toast(this.$t('hj138'))
        this.$router.push('/authentication')
        return
      }
      //<7 指前面所有股平仓 都走以下接口
      if (this.titleIndex < 7) {
        //沪深京
        MessageBox.confirm(this.$t('hj139') + '?', this.$t('hj165'), {
          confirmButtonText: this.$t('hj161'),
          cancelButtonText: this.$t('hj106'),
        }).then(async () => {
          let opt = {
            positionSn: val
          }
          let data = await api.sell(opt)
          if (data.status === 0) {
            Toast(data.msg)

            //沪深京持仓
            this.finished = false;
            this.getListDetail();
            this.tabsPositionNumArr = []
            //沪深京平仓
            this.finisheds = false;
            this.tabsPcArr = [];
            this.getListDetails();

          } else if (data.msg.indexOf('不在交易时段内') > -1) {
            Toast(this.$t('hj140'))
          } else {
            Toast(data.msg)
          }
        }).catch(() => {

        });
      } else {
        //指数
        MessageBox.confirm(this.$t('hj139') + '?', this.$t('hj165'), {
          confirmButtonText: this.$t('hj161'),
          cancelButtonText: this.$t('hj106'),
        }).then(async () => {
          let opt = {
            positionSn: val
          }
          let data = await api.sellIndex(opt)
          if (data.status === 0) {
            Toast(data.msg)
            //指数持仓
            this.finished = false;
            this.getzhishuListDetail();
            this.tabsPositionNumArr = [];
            //指数平仓
            this.finisheds = false;
            this.tabsPcArr = [];
            this.getzhishuListDetails();
          } else if (data.msg.indexOf('不在交易时段内') > -1) {
            Toast(this.$t('hj140'))
          } else {
            Toast(data.msg)
          }
        }).catch(() => {

        });
      }
    },
    onLoad() {
      //持仓
      this.page++;
      switch (this.titleIndex) {
        case 0:
          //沪深京持仓
          this.getListDetail();
          break;
        case 1:
          //指数持仓
          this.getzhishuListDetail();
          break;

        default:
          break;
      }
    },
    onLoads() {
      //平仓
      this.pages++;
      switch (this.titleIndex) {
        case 0:
          //沪深京平仓
          this.getListDetails();
          break;
        case 1:
          //指数平仓
          this.getzhishuListDetails();
          break;
        default:
          break;
      }
    },
    onLoadss() {
      this.pagess++;
      switch (this.titleIndex) {
        case 1:
          this.getorderList();
          break;
        default:
          break;
      }
    },
    onLoadXg() {
      // this.getNewXg();
    },
    async gdClose(item) {
      let opts = {
        id: item.id
      }
      let data = await api.delGuaDan(opts)
      if (data.status == 1) {
        Toast(this.$t('hj137'))
        this.page = 1;
        this.pages = 1;
        this.finished = false;
        this.finisheds = false;
        this.finishedss = false;
        this.tabsPositionNumArr = [];
        this.tabsPcArr = [];
        this.tabsOrderList = []
        switch (this.titleIndex) {
          case 0:
            this.titleName = this.$t('hj114');
            this.getListDetail();
            this.getListDetails();
            this.getorderList();
            break;
          case 1:
            this.titleName = this.$t('hj115');
            this.getzhishuListDetail();
            this.getzhishuListDetails();
            this.getorderList();
            break;
          case 2:
            this.titleName = this.$t('hj116');


            // this.getQhListDetail();
            // this.getQhListDetails();
            this.getorderList();
            break;
          default:
            break;
        }
      } else {
        Toast(data.msg)
      }
    },
    zcsg(item) {
      this.$router.push({ path: '/trading-list', query: { listid: 5 } })
    },
    SetTitleIndex(index) {
      //账户选项卡
      this.titleIndex = index;
      //初始化卡片数据
      this.initUserCardMoney();
      this.page = 1;
      this.pages = 1;
      this.finished = false;
      this.finisheds = false;
      this.finishedss = false;
      this.tabsPositionNumArr = [];
      this.tabsPcArr = [];
      this.tabsOrderList = [];
      switch (index) {
        case 0:
          this.titleName = this.$t('hj293');
          this.getListDetail();
          this.getListDetails();
          this.getorderList();
          this.handleTabsClick('', 0)
          break;
        case 1:
          //美股
          this.titleName = this.$t('hj294');
          //持仓
          this.getListDetail();
          //平仓
          this.getListDetails();
          //订单列表
          this.getorderList();
          //默认跳转列表
          this.handleTabsClick('', 0)
          break;
        case 2:
          //港股
          this.titleName = this.$t('hj295');
          //持仓
          this.getListDetail();
          //平仓
          this.getListDetails();
          //订单列表
          this.getorderList();
          //默认跳转列表
          this.handleTabsClick('', 0)
          break;
        case 3:
          //马股
          this.titleName = this.$t('hj296');
          //持仓
          this.getListDetail();
          //平仓
          this.getListDetails();
          //订单列表
          this.getorderList();
          //默认跳转列表
          this.handleTabsClick('', 0)
          break;
        case 4:
          //泰股
          this.titleName = this.$t('hj297');
          //持仓
          this.getListDetail();
          //平仓
          this.getListDetails();
          //订单列表
          this.getorderList();
          //默认跳转列表
          this.handleTabsClick('', 0)
          break;
        case 5:
          //印股
          this.titleName = this.$t('hj283');
          //持仓
          this.getListDetail();
          //平仓
          this.getListDetails();
          //订单列表
          this.getorderList();
          //默认跳转列表
          this.handleTabsClick('', 0)
          break;
        case 7:
          this.totalss = 0;
          this.totals = 0;
          this.total = 0;
          this.titleName = this.$t('hj116');
          this.handleTabsClick('', 3)
          // this.getQhListDetail();
          // this.getQhListDetails();
          // this.getorderList();
          break;
        default:
          break;
      }
      this.titleDialog = false;
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    handleTabsClick(item, index) {
      //持仓已平仓选项卡
      this.tabsCurrentIndex = index;
      if (index == 3) {
        this.finishedXg = false;
        this.getNewXg();

      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    handleOpenDialog() {
      this.titleDialog = !this.titleDialog;
    },
    //挂单
    async getorderList() {
      let opts = {}
      let data = await api.getorderList(opts);
      this.loadingss = false;
      if (data.status === 0) {
        data.data.forEach(element => {
          this.tabsOrderList.push(element)
        })
        this.totalss = data.data.length
        this.finishedss = true; //只有一页，所以锁住翻页。有需要刷新数据的时候在调用方法前重新解锁
      } else {
        Toast(data.msg)
      }
    },
    async getIndexSettingInfo() {
      // 网站设置信息 指数
      let data = await api.getIndexSetting()
      if (data.status === 0) {
        // 成功
        this.indexSettingInfo = data.data
      } else {
        Toast(data.msg)
      }
    },
    async getFuturesSetting() {
      // 网站设置信息 期货
      let data = await api.getFuturesSetting()
      if (data.status === 0) {
        // 成功
        this.futuresSettingInfo = data.data
      } else {
        Toast(data.msg)
      }
    },
    async getSettingInfo() {
      let data = await api.getSetting()
      if (data.status === 0) {
        // 成功
        this.settingInfo = data.data
      } else {
        Toast(data.msg)
      }
    },
    async getUserInfo() {
      // 获取用户信息
      //   let showcookie = this.getCookie('USER_TOKEN');
      let data = await api.getUserInfo()
      if (data.status === 0) {
        // this.getProductSetting()
        this.$store.state.userInfo = data.data
      } else {
        Toast(data.msg)
      }
      this.$store.state.user = this.user
    },
    async getListDetail() {
      //获取沪深我的持仓列表
      this.loading = true;
      let opt = {
        state: 0,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        stockType: this.stockType,
        pageNum: this.page,
        pageSize: 15,
      }
      let data = await api.getOrderList(opt)
      this.loading = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finished = true;
        }
        data.data.list.forEach(element => {
          this.tabsPositionNumArr.push(element)
        })
        this.total = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getzhishuListDetail() {
      //获取指数持仓
      this.loading = true;
      let opt = {
        state: 0,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        pageNum: this.pageNum,
        pageSize: this.pageSize
      }
      let data = await api.getIndexOrderList(opt)
      this.loading = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finished = true;
        }
        data.data.list.forEach(element => {
          this.tabsPositionNumArr.push(element)
        })
        this.total = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getQhListDetail() {
      //获取期货持仓
      this.loading = true;
      let opt = {
        state: 0,
        fnCode: '', // 代码
        fnName: '', // 简拼
        pageNum: this.pageNum,
        pageSize: this.pageSize
      }
      let data = await api.getFuturesOrderList(opt)
      this.loading = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finished = true;
        }
        data.data.list.forEach(element => {
          this.tabsPositionNumArr.push(element)
        })
        this.total = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getListDetails() {
      //获取沪深我的平仓列表
      this.loadings = true;
      let opt = {
        state: 1,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        stockType: this.stockType,
        pageNum: this.pages,
        pageSize: 15
      }
      let data = await api.getOrderList(opt)
      this.loadings = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finisheds = true;
        }
        data.data.list.forEach(element => {
          this.tabsPcArr.push(element)
        })
        this.totals = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getzhishuListDetails() {
      //获取指数平仓
      this.loadings = true;
      let opt = {
        state: 1,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        pageNum: this.pageNum,
        pageSize: 15
      }
      let data = await api.getIndexOrderList(opt)
      this.loadings = false;
      if (data.data.list.length < 15) {
        this.finisheds = true;
      }
      if (data.status === 0) {
        data.data.list.forEach(element => {
          this.tabsPcArr.push(element)
        })
        this.totals = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getQhListDetails() {
      //获取期货平仓
      this.loadings = true;
      let opt = {
        state: 1,
        fnCode: '', // 代码
        fnName: '', // 简拼
        pageNum: this.pageNum,
        pageSize: this.pageSize
      }
      let data = await api.getFuturesOrderList(opt)
      this.loadings = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finisheds = true;
        }
        data.data.list.forEach(element => {
          this.tabsPcArr.push(element)
        })
        this.totals = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async getNewXg() {
      //获取新股
      this.loadingXg = true;
      let opt = {
        stockType: "all",
        pageNum: 1,
        pageSize: 10,
        status: this.xgStatusVal,
      }
      let data = await api.getUserNewGuList(opt)
      this.loadingXg = false;
      if (data.status === 0) {
        this.tabsXgArr = data.data
        // data.data.list.forEach(element => {
        //   this.tabsXgArr.push(element)
        // })
        this.xgTotal = data.data.length;
        this.finishedXg = true;//只有一页，所以锁住翻页。有需要刷新数据的时候在调用方法前重新解锁
      } else {
        Toast(data.msg)
      }
    },
  },
  filters: {
    formatDecimal(value) {
      if (typeof value === 'number') {
        return value.toFixed(3); // 使用 toFixed 方法保留 3 位小数
      }
      return value;
    },
    gettime(time) {
      if (!time) {
        return "";
      }
      var nd = new Date(time);
      var y = nd.getFullYear();
      var mm = nd.getMonth() + 1;
      var d = nd.getDate();
      var h = nd.getHours();
      var m = nd.getMinutes();
      var c = nd.getSeconds();
      if (mm < 10) {
        mm = "0" + mm;
      }
      if (d < 10) {
        d = "0" + d;
      }
      if (h < 10) {
        h = "0" + h;
      }
      if (m < 10) {
        m = "0" + m;
      }
      if (c < 10) {
        c = "0" + c;
      }
      //17:35:2922-06-2022
      return y + '/' + mm + '/' + d + ' ' + h + ":" + m + ":" + c;
    }
  },
};
</script>

<style scoped lang="less">
/deep/ .mint-msgbox-title {
  font-size: 0.4rem !important;
}

.pingbtn {
  width: auto !important;
  height: auto !important;
  background: rgb(45, 106, 233);
  color: rgb(255, 255, 255);
  padding: 0.2rem 0.4rem;
  border-radius: 0.2rem !important;
}

.pink {
  color: #eb2f96;
  background: #fff0f6;
  border-color: #ffadd2;
}

.red {
  color: #f5222d;
  background: #fff1f0;
  border-color: #ffa39e;
}

.blue {
  color: #1890ff;
  background: #e6f7ff;
  border-color: #91d5ff;
}

.green {
  color: #52c41a;
  background: #f6ffed;
  border-color: #b7eb8f;
}

.purple {
  color: #722ed1;
  background: #f9f0ff;
  border-color: #d3adf7;
}

@boxCenter: {
  display: flex;
  justify-content: center;
  align-items: center;
}

;
@topCardColor: #bdbdbd;

.warehouse_page {
  width: 100%;
  height: calc(100% - 1.2974rem);
}

.content {
  width: 100%;
  height: 100%;
  position: relative;
}

.top_title.active {
  height: 15rem;
}

.top_title {
  width: 100%;
  height: 0.9231rem;
  position: absolute;
  top: 0.6rem;
  z-index: 10;
  overflow: hidden;
  transition: all 0.3s;
  padding: 0 .3rem;

  .titles {
    width: 100%;
    height: 0.9231rem;
    display: flex;
    padding: 0 0.1rem;
  }

  .left_title,
  .right_box {
    // width: 50%;
    height: 100%;
    display: flex;
  }

  .title {
    width: auto;
    height: 100%;
    font-size: 0.4897rem;
    display: flex;
    align-items: center;

    span {
      font-size: 0.4897rem;
      font-weight: 600;
    }
  }

  .img {
    // width: 40%;
    height: 100%;
    display: flex;
    align-items: center;

    img {
      width: 0.6rem;
      height: 0.6rem;
    }
  }
}

.warehouse_card {
  width: 100%;
  height: calc(100% - 1rem);
  position: absolute;
  top: 1.5231rem;
  z-index: 0;
  padding: 0 0.3333rem;
  background: rgb(242, 243, 247);

  .top_card {
    width: 100%;
    height: 4.2308rem;
    border-radius: 0.15rem;
    margin-top: 0.3rem;
    background: #fff;

    .card_content {
      width: 100%;
      height: 100%;
      padding: 0.4rem;

      .t_title {
        width: 100%;
        height: 0.5128rem;
        display: flex;
        align-items: center;

        span {
          font-size: 0.3046rem;
          font-weight: bold;
        }
      }

      .t_price {
        width: 100%;
        height: 0.5128rem;
        display: flex;
        align-items: center;

        .price {
          font-weight: 600;
          font-size: 0.4246rem;
          margin-top: 0.07rem;
        }

        .profits {
          font-weight: 800;
          font-size: 0.2846rem;
          color: #dd2c34;
          margin-top: 0.2rem;
          margin-left: 0.2rem;
        }
      }

      .balance {
        width: 100%;
        height: 0.3846rem;
        margin-top: 0.428rem;
        display: flex;

        >div {
          width: 50%;
          height: 100%;
          color: @topCardColor;

          span {
            font-weight: 600;
          }
        }
      }

      .num {
        width: 100%;
        height: 0.3846rem;
        margin-top: 0.1rem;
        display: flex;

        >div {
          width: 50%;
          height: 100%;

          span {
            font-weight: 600;
          }
        }

        .right_margin {
          color: rgb(81, 164, 99);

          span {
            font-weight: normal !important;
          }
        }
      }

      .margin {
        width: 100%;
        height: 0.3846rem;
        margin-top: 0.2rem;
        display: flex;

        >div {
          width: 50%;
          height: 100%;
          color: @topCardColor;

          span {
            font-weight: 600;
          }
        }
      }

      .prices {
        width: 100%;
        height: 0.3846rem;
        margin-top: 0.1rem;
        display: flex;

        >div {
          width: 50%;
          height: 100%;

          span {
            font-weight: 600;
          }
        }
      }
    }
  }
}

.over {
  width: 100%;
  height: calc(100% - 0.7179rem);
  overflow: auto;
  padding: 0 0.3rem;
}

.tabs_card {
  width: 100%;
  //height: calc(100% - 4.24rem - 0.5rem - 0.6rem);
  height: calc(((100% - 0.24rem) - 0.5rem) - 0.6rem);
  margin-top: 0.3rem;
  background: #fff;
  border-radius: 0.2rem;
  padding-top: 0.15rem;
}

.over::-webkit-scrollbar {
  display: none;
}

.tabs_card_content {
  width: 100%;
  height: 100%;

  .tabs_top_title {
    width: 100%;
    height: 1rem;
    border-bottom: 0.01rem solid #ececec;
    display: flex;
    align-items: center;
    font-size: 0.4103rem;
    padding: 0.2rem 0.3rem 0;
    justify-content: space-between;
    overflow-x: scroll;

    &::-webkit-scrollbar {
      display: none;
    }

    >div {
      // width: 20%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      white-space: nowrap;
      padding: 0 0.3rem;

      span {
        display: inline-block;
        height: 100%;
        font-weight: 550;
        // line-height: 0.7179rem;
        text-align: center;


      }

      span.active {
        color: rgb(62, 121, 226);
        text-align: center;
        // border-bottom: 0.1rem solid rgb(62, 121, 226);

      }

      span.active::after {
        content: '';
        width: 80%;

        height: 0.001rem;
        display: block;
        margin: 0 auto;
        margin-top: 0.3rem;
        border-bottom: 0.06rem solid rgb(62, 121, 226);
      }

    }
  }

  .pink {
    color: #eb2f96;
    background: #fff0f6;
    border-color: #ffadd2;
  }

  .red {
    color: #f5222d;
    background: none;
    border-color: #ffa39e;
  }

  .blue {
    color: #1890ff;
    background: none;
    border-color: #91d5ff;
  }

  .green {
    color: #52c41a;
    background: none;
    border-color: #b7eb8f;
  }

  .purple {
    color: #722ed1;
    background: none;
    border-color: #d3adf7;
  }

  .orange {
    color: #ff6e00;
    background: none;
    border-color: #ff9240;
  }

  .over {
    width: 100%;
    height: calc(100% - 0.7179rem);
    overflow: auto;
    padding: 0 0.3rem;

    &::-webkit-scrollbar {
      display: none;
    }
  }

  .tabs_o {
    width: 100%;
    margin-top: 0.3rem;

    >.tabs_o_items {
      width: 100%;
      position: relative;
      border-bottom: 0.01rem solid #ececec;
      padding: 0.2rem 0;

      .tabs_o_title {
        width: 100%;
        position: relative;
        height: 0.7rem;

        .backGsz {
          color: #fff;
          padding: 0.08rem 0.1rem;
          text-align: center;
          font-size: 0.222222rem;
          -webkit-transform: scale(0.9, 0.9);
          transform: scale(0.9, 0.9);
        }

        span {
          margin-right: 0.05rem;
        }

        .title {
          font-weight: 600;
          font-size: 0.4059rem;
        }

        .buy_to_sell {
          padding: 0.08rem 0.1rem;
        }

        .futures-c {
          left: 1.8rem !important;
        }

        .futures-title {
          left: 2.8rem !important;
        }

        .multiple {
          padding: 0.08rem 0.1rem;
          background: rgb(236, 243, 252);
          color: rgb(42, 108, 230);
          font-weight: 600;
        }

        .nums {
          color: @topCardColor;
        }
      }

      .profit {
        margin-left: 0.15rem;
      }

      .center_price {
        width: 100%;
        display: flex;
        align-items: center;
        margin-top: -0.1rem;

        .order-status {
          padding: 0.1rem 0.1rem;
          background-color: #2d6ae9;
          color: #ffffff;
          margin-right: 0.2rem;
        }

        >div {
          width: 33%;
          height: 100%;

          span {
            font-weight: 600;
          }
        }

        .multiple {
          padding: 0.08rem 0.1rem;
          background: #ecf3fc;
          color: #2a6ce6;
          font-weight: 600;
        }

        .nums {
          color: #bdbdbd;
          margin-left: 0.1rem;
        }

        .profit {
          color: rgb(209, 79, 91);
        }
      }

      .bottom_price_title {
        width: 100%;
        margin-top: 0.2rem;
        display: flex;
        align-items: center;

        >div {
          width: 33%;
          height: 100%;
          color: #bdbdbd;

          span {
            font-weight: 600;
          }
        }
      }
    }
  }
}

.right_btn {
  width: 1.9949rem;
  height: 0.6667rem;
  position: absolute;
  right: 0%;
  top: 26%;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.15rem;

  span {
    font-weight: 600;
    font-size: 0.2846rem;
  }
}

.pingbtn {
  width: auto !important;
  height: auto !important;
  background: #2d6ae9;
  color: #ffffff;
  padding: 0.2rem 0.3rem;
  border-radius: 0.2rem !important;
}


.dropdown-content {
  padding: 0rem;
  width: calc(100% + 0.6rem);
  margin-left: -0.3rem;
}

.van-dropdown-item {
  position: fixed;
  right: 0;
  left: 0;
  z-index: 10;
  overflow: hidden;
  width: calc(100% - 0.6rem);
  margin-left: 0.3rem;
}

.maichu {
  color: #e13941;
  background: #fceef0;
}

.mairu {
  color: #6daf7d;
  background: #d7f3eb;
}

.right_count {
  width: 1.7949rem;
  height: 0.6667rem;
  position: absolute;
  right: 1%;
  top: 20%;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.3rem;

  span {
    font-weight: 600;
    font-size: 0.3846rem;
  }
}

.profit_res {
  width: 100% !important;
  margin-top: 0.2rem;
}

.waiting {
  width: 100%;
  margin-top: 0.3rem;
  position: relative;

  .waiting_box {
    width: 100%;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1rem;

    >div {
      width: 60%;
      height: 100%;

      img {
        width: 100%;
        height: 100%;
      }

      .gd {
        display: inline-block;
        width: 100%;
        text-align: center;
        color: rgb(133, 133, 133);
      }

      .trading {
        width: 100%;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;

        span {
          display: inline-block;
          width: 4.1026rem;
          height: 1.0256rem;
          background: #f7f7f7;
          color: #3773dd;
          font-weight: 600;
          font-size: 0.4615rem;
          text-align: center;
          line-height: 1.0256rem;
          border-radius: 0.2rem;
        }
      }
    }
  }
}


.dialog {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  background: rgba(0, 0, 0, .5);
  z-index: 9;
}

.overflow_box {
  width: 75%;
  height: 1rem;
  border-radius: .2rem;
  padding: 0 .3rem;
  margin: .2rem 0;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;

  >div {
    height: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .left_titles {
    color: rgb(129, 131, 133);
    font-size: .3815rem;

    span {
      font-weight: normal !important;


    }
  }

  .right_price {
    color: rgb(128, 135, 145);
  }
}

.kuan {
  width: auto !important;
  // padding-left: 0.5rem;
  letter-spacing: 0.02rem;
}

.kuans {
  width: auto !important;
  padding-left: 0.5rem;
  letter-spacing: 0.02rem;
}

.left_price {
  font-weight: normal;

  span {
    font-size: 0.3rem;
    color: #000;
    font-weight: 500 !important;
    ;
  }
}

.left_price {
  font-weight: normal;

  span {
    font-size: 0.3rem;
    color: #000;
    font-weight: 500 !important;
    ;
  }
}

.numDemo {
  font-size: 0.3rem;
  color: #000;
  font-weight: 500 !important;
  ;
}

.maichu {
  color: rgb(225, 57, 65);
  background: rgb(252, 238, 240);
}

.mairu {
  color: rgb(109, 175, 125);
  background: rgb(215, 243, 235);
}

.jiantou {
  position: relative;
}

.jiantou::before {
  content: '';
  background-image: url('../../assets/img/youyou.png');
  background-size: 100% 100%;
  width: 0.6rem;
  height: 0.2rem;
  font-size: 0.8rem;
  position: absolute;
  right: 0.5rem;
  top: calc(50% - 0.15rem);
}
</style>