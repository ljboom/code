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
              <img src="../../assets/img/xiala.svg" alt />
            </div>
          </div>
          <div class="right_box"></div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(4)">
          <div class="left_titles">
            <span>{{ $t('hj288') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>

        <div class="overflow_box item" @click="SetTitleIndex(6)">
          <div class="left_titles">
            <span>{{ $t('hj289') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <!-- <div class="overflow_box item" @click="SetTitleIndex(0)">
          <div class="left_titles">
            <span>{{ $t('hj284') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(1)">
          <div class="left_titles">
            <span>{{ $t('hj285') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(2)">
          <div class="left_titles">
            <span>{{ $t('hj286') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(3)">
          <div class="left_titles">
            <span>{{ $t('hj287') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(4)">
          <div class="left_titles">
            <span>{{ $t('hj288') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(5)">
          <div class="left_titles">
            <span>{{ $t('hj290') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div>
        <div class="overflow_box item" @click="SetTitleIndex(6)">
          <div class="left_titles">
            <span>{{ $t('hj289') }}</span>
          </div>
          <div class="right_price">
            <span>{{ '' }}</span>
          </div>
        </div> -->
      </div>
      <div class="warehouse_card">
        <div class="top_card">
          <div class="card_content">
            <div class="card_top">
              <div>
              <div class="t_title">
                <span>{{ $t('hj49') }}</span>
              </div>
              <div class="t_price">
                <p class="price" v-show="titleIndex == 0">$ {{Number($store.state.userInfo.userAmt).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 1">HK$ {{(Number($store.state.userInfo.userAmt)*7.82).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 2">RM {{(Number($store.state.userInfo.userAmt)*4.7).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 3">฿ {{(Number($store.state.userInfo.userAmt)*36.8).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 4">Rs {{(Number($store.state.userInfo.userAmt)*83.1).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 5">₫ {{(Number($store.state.userInfo.userAmt)*24333.2).toFixed(2)}}</p>
                <p class="price" v-show="titleIndex == 6">$ {{Number($store.state.userInfo.userFuturesAmt).toFixed(2)}}</p>

              </div>
              </div>
              <div class="t_tag">$</div>
            </div>
            <div class="balance">
              <div class="left_line">
                <div class="linetag">➡</div>
                <div class="info">
                  <div class="left_titles">
                    {{ $t('hj50') }}
                  </div>
                  <div class="down-num">
                    <div class="left_price">
                      <span v-show="titleIndex == 0">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.enableAmt
                          +
                          $store.state.userInfo.allFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 1">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.hkEnableAmt
                          +
                          $store.state.userInfo.hkAllFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 2">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.myEnableAmt
                          +
                          $store.state.userInfo.myAllFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 3">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.thEnableAmt
                          +
                          $store.state.userInfo.thAllFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 4">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.inEnableAmt
                          +
                          $store.state.userInfo.inAllFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 5">{{ $store.state.hide ? '****' : Number(($store.state.userInfo.vnEnableAmt
                          +
                          $store.state.userInfo.vnAllFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                      }} </span>
                      <span v-show="titleIndex == 6">{{ $store.state.hide ? '****' :
                          Number(($store.state.userInfo.enableFuturesAmt +
                            $store.state.userInfo.allFuturesFreezAmt) * futuresSettingInfo.forceSellPercent).toFixed(2)
                      }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="right_yue">
                <div class="linetag">💸</div>
                <div class="info">
                  <div class="right_titles">
                    {{ $t('hj54') }}
                  </div>
                  <div class="down-num">
                    <div class="right_margin">
                      <span v-show="titleIndex == 0 ">{{ '$ ' + $store.state.userInfo.enableAmt }}</span>
                    <span v-show="titleIndex == 1 ">{{ 'HK$ ' + $store.state.userInfo.hkEnableAmt }}</span>
                      <span v-show="titleIndex == 2 ">{{ 'RM ' + $store.state.userInfo.myEnableAmt }}</span>
                      <span v-show="titleIndex == 3 ">{{ '฿ ' + $store.state.userInfo.thEnableAmt }}</span>
                      <span v-show="titleIndex == 4 ">{{ 'Rs ' + $store.state.userInfo.inEnableAmt }}</span>
                      <span v-show="titleIndex == 5 ">{{ '₫ ' + $store.state.userInfo.vnEnableAmt}}</span>
                      <span v-show="titleIndex == 6">{{ '$ ' + $store.state.userInfo.enableFuturesAmt }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="margin">
              <div class="left_line">
                <div class="linetag">💰</div>
                <div class="info">
                  <div class="left_titles">
                    {{ $t('hj55') }}
                  </div>
                  <div class="prices">
                    <div class="left_titles">
                      <span class="numDemo" v-show="titleIndex == 0">{{ '$ ' +
                          $store.state.userInfo.allFreezAmt ? $store.state.userInfo.allFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 1">{{ 'HK$ ' +
                          $store.state.userInfo.hkAllFreezAmt ? $store.state.userInfo.hkAllFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 2">{{ 'RM ' +
                          $store.state.userInfo.myAllFreezAmt ? $store.state.userInfo.myAllFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 3">{{ '฿ ' +
                          $store.state.userInfo.thAllFreezAmt ? $store.state.userInfo.thAllFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 4">{{ 'Rs ' +
                          $store.state.userInfo.inAllFreezAmt ? $store.state.userInfo.inAllFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 5">{{ '₫ ' +
                          $store.state.userInfo.vnAllFreezAmt ? $store.state.userInfo.vnAllFreezAmt : '0.00'
                      }}</span>
                      <span class="numDemo" v-show="titleIndex == 6">{{ '$ ' +
                          $store.state.userInfo.allFuturesFreezAmt ? $store.state.userInfo.allFuturesFreezAmt : '0.00'
                      }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="right_yue">
                <div class="linetag">🗇</div>
                <div class="info">
                  <div class="right_titles">
                    {{ $t('hj56') }}
                  </div>
                  <div class="prices">
                    <div class="right_titles">
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 0 ">{{ '$ ' +
                            $store.state.userInfo.allProfitAndLose ? $store.state.userInfo.allProfitAndLose : '0.00'
                        }}</span>
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 1 ">{{ 'HK$ ' +
                            $store.state.userInfo.hkAllProfitAndLose ? $store.state.userInfo.hkAllProfitAndLose : '0.00'
                        }}</span>
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 2 ">{{ 'RM ' +
                            $store.state.userInfo.myAllProfitAndLose ? $store.state.userInfo.myAllProfitAndLose : '0.00'
                        }}</span>
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 3 ">{{ '฿ ' +
                            $store.state.userInfo.thAllProfitAndLose ? $store.state.userInfo.thAllProfitAndLose : '0.00'
                        }}</span>
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 4 ">{{ 'Rs ' +
                            $store.state.userInfo.inAllProfitAndLose ? $store.state.userInfo.inAllProfitAndLose : '0.00'
                        }}</span>
                      <span class="numDemo"
                        :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 5 ">{{ '₫ ' +
                            $store.state.userInfo.vnAllProfitAndLose ? $store.state.userInfo.vnAllProfitAndLose : '0.00'
                        }}</span>

                      <span class="numDemo"
                        :class="$store.state.userInfo.allFuturesProfitAndLose > 0 ? 'red' : $store.state.userInfo.allFuturesProfitAndLose < 0 ? ' green' : ''"
                        v-show="titleIndex == 6">{{
                            '¥' + $store.state.userInfo.allFuturesProfitAndLose ?
                              Number($store.state.userInfo.allFuturesProfitAndLose).toFixed(2) : '0.00'
                        }}</span>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="tabs_card">
          <div class="tabs_card_content">
            <div class="tabs_top_title">
              <div v-if="titleIndex==6" class="title_items kuan" v-for="(item, index) in tabsqhArr" :key="index"
                @click="handleTabsClick(item, index)" >
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total6 + ')' : index == 1 ? '(' + totalss6 + ')' : '(' +
                      totals6 + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==0" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total + ')' : index == 1 ? '(' + totalss + ')' : index == 2 ? '(' +
                      totals + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==1" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total1 + ')' : index == 1 ? '(' + totalss1 + ')' : index == 2 ? '(' +
                      totals1 + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==2" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total2 + ')' : index == 1 ? '(' + totalss2 + ')' : index == 2 ? '(' +
                      totals2 + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==3" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total3 + ')' : index == 1 ? '(' + totalss3 + ')' : index == 2 ? '(' +
                      totals3 + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==4" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total4 + ')' : index == 1 ? '(' + totalss4 + ')' : index == 2 ? '(' +
                      totals4 + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

              <div v-if="titleIndex==5" class="title_items kuan" v-for="(item, index) in tabsArr" :key="index"
                @click="handleTabsClick(item, index)">
                <span :class="tabsCurrentIndex === index  ? 'active' : ''">
                  {{ item }}{{ index == 0 ? '(' + total5 + ')' : index == 1 ? '(' + totalss5 + ')' : index == 2 ? '(' +
                      totals5 + ')' : '(' + xgTotal + ')'
                  }}</span>
              </div>

            </div>

              <div v-show="titleIndex==0">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
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
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 0 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- 挂单 -->
                <div class="over">
                  <div class="waiting" v-if="totalss == 0 && tabsCurrentIndex === 1">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj124') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 0 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 1 && totalss != 0"  :immediate-check="immediate">
                    <div class="tabs_o" >
                      <div class="tabs_o_items" v-for="(item, index) in tabsOrderList" :key="item.id" >
                        <div class="tabs_o_title" >
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                            <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                            </span>
                              <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                              <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                            <span class="multiple">{{ item.lever }}X</span>
                            <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                </div>

                <!-- 平仓 -->
                <div class="over">
                  <div class="waiting" v-if="totals == 0 && tabsCurrentIndex === 2">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj127') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 0 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                    :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals != 0">
                    <div class="tabs_o">
                      <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr" :key="index">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 2.8rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                            <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum  + $t('hj117') }}</span>
                          </div>
                          <div class="right_count"
                            :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                            <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_res">
                            <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_res">
                            <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_res">
                            <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>
              </div>

              <div v-show="titleIndex==1">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total1 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr1" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum  + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total1 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 1 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 持仓 currentIndex: 0 -->

                <!-- 挂单 -->
                <div class="over">
                <div class="waiting" v-if="totalss1 == 0 && tabsCurrentIndex === 1">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj124') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 1 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                  v-show="tabsCurrentIndex === 1 && totalss1 != 0"  :immediate-check="immediate">
                  <div class="tabs_o" >
                    <div class="tabs_o_items" v-for="(item, index) in tabsOrderList1" :key="item.id" >
                      <div class="tabs_o_title" >
                        <div style="width: calc(100% - 3.5rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                          </span>
                            <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                            <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                          <span class="multiple">{{ item.lever }}X</span>
                          <span class="nums">{{ item.buyNum  + $t('hj117') }}</span>
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
                </div>
                <!-- 挂单 -->

                <!-- 平仓 -->
                <div class="over">
                <div class="waiting" v-if="totals1 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 1 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals1 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr1" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>
              </div>

              <div v-show="titleIndex==2">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total2 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr2" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total2 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 2 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 持仓 currentIndex: 0 -->

                <!-- 挂单 -->
                <div class="over">
                <div class="waiting" v-if="totalss2 == 0 && tabsCurrentIndex === 1">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj124') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 2 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                  v-show="tabsCurrentIndex === 1 && totalss2 != 0"  :immediate-check="immediate">
                  <div class="tabs_o" >
                    <div class="tabs_o_items" v-for="(item, index) in tabsOrderList2" :key="item.id" >
                      <div class="tabs_o_title" >
                        <div style="width: calc(100% - 3.5rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                          </span>
                            <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                            <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                          <span class="multiple">{{ item.lever }}X</span>
                          <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                </div>

                <!-- 平仓 -->
                <div class="over">
                <div class="waiting" v-if="totals2 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 2 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals2 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr2" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>
              </div>

              <div v-show="titleIndex==3">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total3 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr3" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total3 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 3 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                <div class="waiting" v-if="totalss3 == 0 && tabsCurrentIndex === 1">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj124') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 3 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                  v-show="tabsCurrentIndex === 1 && totalss3 != 0"  :immediate-check="immediate">
                  <div class="tabs_o" >
                    <div class="tabs_o_items" v-for="(item, index) in tabsOrderList3" :key="item.id" >
                      <div class="tabs_o_title" >
                        <div style="width: calc(100% - 3.5rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                          </span>
                            <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                            <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                          <span class="multiple">{{ item.lever }}X</span>
                          <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                </div>

                <!-- 平仓 -->
                <div class="over">
                <div class="waiting" v-if="totals3 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 3 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals3 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr3" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>
              </div>

              <div v-show="titleIndex==4">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total4 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr4" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total4 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 4 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 持仓 currentIndex: 0 -->

                <!-- 挂单 -->
                <div class="over">
                  <div class="waiting" v-if="totalss4 == 0 && tabsCurrentIndex === 1">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj124') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 4 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 1 && totalss4 != 0"  :immediate-check="immediate">
                    <div class="tabs_o" >
                      <div class="tabs_o_items" v-for="(item, index) in tabsOrderList4" :key="item.id" >
                        <div class="tabs_o_title" >
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                            <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                            </span>
                              <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                              <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                            <span class="multiple">{{ item.lever }}X</span>
                            <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                </div>

                <!-- 平仓 -->
                <div class="over">
                <div class="waiting" v-if="totals4 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 4 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals4 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr4" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>
              </div>

              <div v-show="titleIndex==5">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total5 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr5" :key="item.buyOrderId">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.now_price }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total5 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 5 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 持仓 currentIndex: 0 -->


                <div class="over">
                <div class="waiting" v-if="totalss5 == 0 && tabsCurrentIndex === 1">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj124') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 5 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                  v-show="tabsCurrentIndex === 1 && totalss5 != 0"  :immediate-check="immediate">
                  <div class="tabs_o" >
                    <div class="tabs_o_items" v-for="(item, index) in tabsOrderList5" :key="item.id" >
                      <div class="tabs_o_title" >
                        <div style="width: calc(100% - 3.5rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                          </span>
                            <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                            <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                          <span class="multiple">{{ item.lever }}X</span>
                          <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                </div>

                <!-- 平仓 -->
                <div class="over">
                <div class="waiting" v-if="totals5 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 5 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals5 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr5" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>

                <!-- 新股 -->
                <div class="over">
                <div class="waiting" v-if="xgTotal == 0 && tabsCurrentIndex === 3">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj129') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { listid: 6 } })">
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
                        <span class="title">{{ item.newName }}</span>
                        <span class="buy_to_sell" :class="item.type == 1 ? 'mairu' : 'maichu'">
                        <span class="fontclass">{{item.type == 1 ? $t('hj45') : $t('hj46')}}</span></span>
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

                        <div class="right_btn" style="padding: 0 0.2rem;" @click="zcsg(item)" :class="item.status == 1 ? 'pink' : item.status == 2 ? 'red'
                        : (item.status == 3 && item.type != 1) ? 'green' : item.status == 4 ? 'blue' : item.status == 5 ? 'purple' : ''" v-if="!(item.type == 1 && item.status == 3)">
                          <span>{{ item.status == 1 ?
                              $t('hj131') : item.status == 2 ? $t('hj132')
                                : (item.status == 3 && item.type != 1) ? $t('hj133') : item.status == 4 ? $t('hj134') : item.status == 5 ?
                                  $t('hj135')
                                  : ''
                          }}</span>
                        </div>
                        <div v-if="item.type == 1 && item.status == 3" class="right_btn pingbtn"
                          style="width: 2rem !important;" @click="getrenjiao(item.id)">
                          {{ $t('hj250') }}
                        </div>
                      </div>


                    </div>
                  </div>
                </van-list>
                </div>


              </div>

              <div v-show="titleIndex==6">
                <!-- 持仓 currentIndex: 0 -->
                <div class="over">
                  <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')"
                    v-show="tabsCurrentIndex === 0 && total6 != 0" @load="onLoad" :immediate-check="immediate">
                    <div class="tabs_o">
                      <div class="tabs_o_items" v-for="(item, index) in tabsPositionNumArr6" :key="item.id">
                        <div class="tabs_o_title">
                          <div style="width: calc(100% - 3.5rem);">
                            <span class="title">{{ item.futuresName ? item.futuresName : '' }}</span>
                            <span class="buy_to_sell" :class="item.orderDirection == $t('hj353') ? 'maichu' : 'mairu'">
                              <span class="fontclass">{{ item.orderDirection == $t('hj354') ? $t('hj84') : $t('hj85') }}</span>

                            </span>
                            <span class="multiple">{{ item.allProfitAndLose }}</span>
                            <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                          </div>

                          <div class="right_btn pingbtn" @click="getpingcang(item.positionSn)">
                            <span style="margin-right: 0;">{{ $t('hj121') }}</span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="profit">
                            <span>{{ item.profitAndLose }}</span>
                          </div>
                          <div class="start_price jiantou">
                            <span>{{ item.buyOrderPrice }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ item.nowPrice }}</span>
                          </div>
                        </div>
                        <div class="bottom_price_title">
                          <div class="profit_title">
                            <span>{{ $t('hj118') }}</span>
                          </div>
                          <div class="start_price">
                            <span>{{ $t('hj119') }}</span>
                          </div>
                          <div class="new_price">
                            <span>{{ $t('hj120') }}</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </van-list>
                  <div class="waiting" v-if="total6 == 0 && tabsCurrentIndex === 0">
                    <div class="waiting_box">
                      <div class="img_cont">
                        <img src="../../assets/img/zhaobudao.png" alt />
                        <span class="gd">{{ $t('hj122') }}</span>
                        <div class="trading" @click="$router.push({ path: '/trading-list', query: { type: 2 } })">
                          <span>{{ $t('hj123') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- 持仓 currentIndex: 0 -->

                <div class="waiting" v-if="totalss6 == 0 && tabsCurrentIndex === 1">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj124') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { type: 2 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <van-list v-model="loadingss" :finished="finishedss" :finished-text="$t('hj43')"
                  v-show="tabsCurrentIndex === 1 && totalss6 != 0"  :immediate-check="immediate">
                  <div class="tabs_o" >
                    <div class="tabs_o_items" v-for="(item, index) in tabsOrderList6" :key="item.id" >
                      <div class="tabs_o_title" >
                        <div style="width: calc(100% - 3.5rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.buyType == 1 ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.buyType == 1 ? $t('hj84') : $t('hj85')}}</span>
                          </span>
                            <span class="buy_to_sell" :class="item.status == 1 ? 'mairu' : 'maichu'">
                            <span class="fontclass">{{item.status == 1 ? $t('hj254') : $t('hj255')}}</span></span>
                          <span class="multiple">{{ item.lever }}X</span>
                          <span class="nums">{{ item.buyNum + $t('hj117') }}</span>
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
                <div class="over">
                <div class="waiting" v-if="totals6 == 0 && tabsCurrentIndex === 2">
                  <div class="waiting_box">
                    <div class="img_cont">
                      <img src="../../assets/img/zhaobudao.png" alt />
                      <span class="gd">{{ $t('hj127') }}</span>
                      <div class="trading" @click="$router.push({ path: '/trading-list', query: { type: 2 } })">
                        <span>{{ $t('hj123') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
                  :immediate-check="immediate" v-show="tabsCurrentIndex === 2 && totals6 != 0">
                  <div class="tabs_o">
                    <div class="tabs_o_items oes" v-for="(item, index) in tabsPcArr6" :key="index">
                      <div class="tabs_o_title">
                        <div style="width: calc(100% - 2.8rem);">
                          <span class="title">{{ item.stockName ? item.stockName : item.indexName }}</span>
                          <span class="buy_to_sell" :class="item.orderDirection == '买跌' ? 'maichu' : 'mairu'">
                          <span class="fontclass">{{item.orderDirection == "买跌" ?$t('hj84') : $t('hj85')}}</span></span>
                          <span class="multiple">{{ item.allProfitAndLose }}</span>
                          <span class="nums">{{ item.orderNum + $t('hj117') }}</span>
                        </div>
                        <div class="right_count"
                          :class="item.profitAndLose > 0 ? 'red' : item.profitAndLose == 0 ? 'white' : 'green'">
                          <span style="margin-right: 0;">{{ item.profitAndLose }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj421') }}: {{ item.buyOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj422') }}: {{ item.sellOrderPrice }}</span>
                        </div>
                      </div>
                      <div class="bottom_price_title">
                        <div class="profit_res">
                          <span>{{ $t('hj420') }}: {{ item.buyOrderTime | gettime }}</span>
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
                </div>
              </div>
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
      tabsArr: [this.$t('hj2'), this.$t('hj109'), this.$t('hj136'), this.$t('hj3')],
      tabsqhArr: [this.$t('hj2'), this.$t('hj109'), this.$t('hj136')],
      tabsCurrentIndex: 0,
      titleName: this.$t('hj288'),
      indexSettingInfo: {},
      futuresSettingInfo: {},
      tabsPositionNumArr: [],
      tabsPositionNumArr1: [],
      tabsPositionNumArr2: [],
      tabsPositionNumArr3: [],
      tabsPositionNumArr4: [],
      tabsPositionNumArr5: [],
      tabsPositionNumArr6: [],
      titleIndex: 4,
      settingInfo: {},
      tabsPcArr: [],
      tabsPcArr1: [],
      tabsPcArr2: [],
      tabsPcArr3: [],
      tabsPcArr4: [],
      tabsPcArr5: [],
      tabsPcArr6: [],
      titleDialog: false,
      total: 0,
      total1: 0,
      total2: 0,
      total3: 0,
      total4: 0,
      total5: 0,
      total6: 0,
      totals: 0,
      totals1: 0,
      totals2: 0,
      totals3: 0,
      totals4: 0,
      totals5: 0,
      totals6: 0,
      totalss: 0,
      totalss1: 0,
      totalss2: 0,
      totalss3: 0,
      totalss4: 0,
      totalss5: 0,
      totalss6: 0,
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
      tabsOrderList1: [],
      tabsOrderList2: [],
      tabsOrderList3: [],
      tabsOrderList4: [],
      tabsOrderList5: [],
      tabsOrderList6: [],
      xgTotal: 0,
      tabsXgArr: [],
      loadingXg: false,
      finishedXg: false,
      stockType:"th",
    };
  },
  mounted() {
    this.getListDetail(4);
    this.getUserInfo();
    //this.getIndexSettingInfo();
    this.getSettingInfo();
    this.getFuturesSetting();
    this.getListDetails(4);
    this.getorderList(4);
    this.getNewXg();
    //console.log(this.tabsCurrentIndex,88)
  },
  created() {
    if (this.$route.query.index) {
      //console.log(this.$route.query.index,222)
      this.tabsCurrentIndex = Number(this.$route.query.index)
    }


  },
  methods: {
    getrenjiao(val) {
      MessageBox.confirm(this.$t('hj251') + '?', this.$t('hj165'), {
        confirmButtonText: this.$t('hj161'),
        cancelButtonText: this.$t('hj106'),
      }).then(async () => {
        let opt = {
          id: val
        }
        let data = await api.submitSubscribe(opt)
        if (data.status == 0) {
          Toast(this.$t('hj326'))
          this.finishedXg = false;
          this.getNewXg();
          this.getUserInfo();
        } else {
          Toast(this.$t('hj327'))
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
      if (this.titleIndex == 0 || this.titleIndex == 1 || this.titleIndex == 2 || this.titleIndex == 3 || this.titleIndex == 4 || this.titleIndex == 5) {
        //股票
        MessageBox.confirm(this.$t('hj139') + '?', this.$t('hj165'), {
          confirmButtonText: this.$t('hj161'),
          cancelButtonText: this.$t('hj106'),
        }).then(async () => {
          let opt = {
            positionSn: val
          }
          let data = await api.sell(opt)
          if (data.status === 0) {
            Toast(this.$t('hj326'))

            //股票持仓
            this.finished = false;
            this.getListDetail(this.titleIndex);
            this.tabsPositionNumArr=[]
            this.tabsPositionNumArr1=[]
            this.tabsPositionNumArr2=[]
            this.tabsPositionNumArr3=[]
            this.tabsPositionNumArr4=[]
            this.tabsPositionNumArr5=[]
            this.tabsPositionNumArr6=[]
            //股票平仓
            this.finisheds = false;
            this.tabsPcArr = [];
            this.tabsPcArr1 = [];
            this.tabsPcArr2 = [];
            this.tabsPcArr3 = [];
            this.tabsPcArr4 = [];
            this.tabsPcArr5 = [];
            this.tabsPcArr6 = [];

            this.getListDetails(this.titleIndex);

          } else if (data.msg.indexOf('交易时段内') > -1) {
            Toast(this.$t('hj140'))
          } else if (data.msg.indexOf('用户已被锁定') > -1) {
            Toast(this.$t('hj380'))
          } else if (data.msg.indexOf('用户不存在') > -1) {
            Toast(this.$t('hj394'))
          } else if (data.msg.indexOf('订单不存在') > -1) {
            Toast(this.$t('hj393'))
          } else if (data.msg.indexOf('周末或节假日不能交易') > -1) {
            Toast(this.$t('hj395'))
          } else if (data.msg.indexOf('此订单已平仓') > -1) {
            Toast(this.$t('hj396'))
          } else if (data.msg.indexOf('fail:') > -1) {
            Toast(data.msg)
          } else if (data.msg.indexOf('Cannot close position for') > -1) {
            Toast(data.msg)
          } else {
            Toast(this.$t('hj327'))
          }
        }).catch(() => {

        });
      } else {
        //期货
        MessageBox.confirm(this.$t('hj139') + '?', this.$t('hj165'), {
          confirmButtonText: this.$t('hj161'),
          cancelButtonText: this.$t('hj106'),
        }).then(async () => {
          let opt = {
            positionSn: val
          }
          let data = await api.sellFutures(opt)
          if (data.status === 0) {
            Toast(this.$t('hj326'))
            //持仓
            this.finished = false;
            this.getQhListDetail();
            this.tabsPositionNumArr=[];
            this.tabsPositionNumArr1 = [];
            this.tabsPositionNumArr2 = [];
            this.tabsPositionNumArr3 = [];
            this.tabsPositionNumArr4 = [];
            this.tabsPositionNumArr5 = [];
            this.tabsPositionNumArr6 = [];
            //平仓
            this.finisheds = false;
            this.tabsPcArr = [];
            this.getQhListDetails();
          } else if (data.msg.indexOf('交易时段内') > -1) {
            Toast(this.$t('hj140'))
          } else {
            Toast(this.$t('hj327'))
          }
        }).catch(() => {

        });



        //指数
        // MessageBox.confirm(this.$t('hj139') + '?', this.$t('hj165'), {
        //   confirmButtonText: this.$t('hj161'),
        //   cancelButtonText: this.$t('hj106'),
        // }).then(async () => {
        //   let opt = {
        //     positionSn: val
        //   }
        //   let data = await api.sellIndex(opt)
        //   if (data.status === 0) {
        //     Toast(data.msg)
        //     //指数持仓
        //     this.finished = false;
        //     this.getzhishuListDetail();
        //     this.tabsPositionNumArr=[];
        //     //指数平仓
        //     this.finisheds = false;
        //     this.tabsPcArr = [];
        //     this.getzhishuListDetails();
        //   } else if (data.msg.indexOf('不在交易时段内') > -1) {
        //     Toast(this.$t('hj140'))
        //   } else {
        //     Toast(data.msg)
        //   }
        // }).catch(() => {

        // });
      }
    },
    onLoad() {
      //持仓
      this.page++;
      switch (this.titleIndex) {
        case 0:
          //泰股持仓
          this.getListDetail(this.titleIndex);
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
          //泰股平仓
          this.getListDetails(this.titleIndex);
          break;
          // case 1:
          //   //指数平仓
          // this.getzhishuListDetails();
          break;
        default:
          break;
      }
    },
    onLoadss() {
      this.pagess++;
      switch (this.titleIndex) {
        case 1:
          this.getorderList(this.titleIndex);
          break;
        default:
          break;
      }
    },
    onLoadXg() {
       this.getNewXg();
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
        this.tabsPositionNumArr1=[];
        this.tabsPositionNumArr2=[];
        this.tabsPositionNumArr3=[];
        this.tabsPositionNumArr4=[];
        this.tabsPositionNumArr5=[];
        this.tabsPositionNumArr6=[];
        this.tabsPcArr = [];
        this.tabsPcArr1 = [];
        this.tabsPcArr2 = [];
        this.tabsPcArr3 = [];
        this.tabsPcArr4 = [];
        this.tabsPcArr5 = [];
        this.tabsPcArr6 = [];
        this.tabsOrderList = [];
        this.tabsOrderList1 = [];
        this.tabsOrderList2 = [];
        this.tabsOrderList3 = [];
        this.tabsOrderList4 = [];
        this.tabsOrderList5 = [];
        this.tabsOrderList6 = [];
        switch (this.titleIndex) {
          case 0:
            this.titleName = this.$t('hj284');
            this.getListDetail(0);
            this.getListDetails(0);
            this.getorderList(0);
            break;
          case 1:
            this.titleName = this.$t('hj285');
            this.getListDetail(1);
            this.getListDetails(1);
            this.getorderList(1);
            break;
          case 2:
            this.titleName = this.$t('hj286');
            this.getListDetail(2);
            this.getListDetails(2);
            this.getorderList(2);
            break;
          case 3:
            this.titleName = this.$t('hj287');
            this.getListDetail(3);
            this.getListDetails(3);
            this.getorderList(3);
            break;
          case 4:
            this.titleName = this.$t('hj288');
            this.getListDetail(4);
            this.getListDetails(4);
            this.getorderList(4);
            break;
          case 5:
            this.titleName = this.$t('hj290');
            this.getListDetail(5);
            this.getListDetails(5);
            this.getorderList(5);
            break;
          case 6:
            this.titleName = this.$t('hj289');
            this.getQhListDetail();
            this.getQhListDetails();
            this.getorderList(6);
            break;
          default:
            break;
        }
      } else {
        Toast(this.$t('hj327'))
      }
    },
    zcsg(item) {
      this.$router.push({ path: '/trading-list', query: { listid: 6 } })
    },
    SetTitleIndex(index) {
      //账户选项卡
      this.titleIndex = index;
      this.page = 1;
      this.pages = 1;
      this.finished = false;
      this.finisheds = false;
      this.finishedss = false;
      this.tabsPositionNumArr = [];
      this.tabsPositionNumArr1 = [];
      this.tabsPositionNumArr2 = [];
      this.tabsPositionNumArr3 = [];
      this.tabsPositionNumArr4 = [];
      this.tabsPositionNumArr5 = [];
      this.tabsPositionNumArr6 = [];
      this.tabsPcArr = [];
      this.tabsPcArr1 = [];
      this.tabsPcArr2 = [];
      this.tabsPcArr3 = [];
      this.tabsPcArr4 = [];
      this.tabsPcArr5 = [];
      this.tabsPcArr6 = [];
      this.tabsOrderList = [];
      this.tabsOrderList1 = [];
      this.tabsOrderList2 = [];
      this.tabsOrderList3 = [];
      this.tabsOrderList4 = [];
      this.tabsOrderList5 = [];
      this.tabsOrderList6 = [];

      switch (index) {
        case 0:
          this.titleName = this.$t('hj284');
          this.getListDetail(0);
          this.getListDetails(0);
          this.getorderList(0);
          this.handleTabsClick('', 0);
          this.stockType = "us";
          break;
        case 1:
          this.titleName = this.$t('hj285');
          this.getListDetail(1);
          this.getListDetails(1);
          this.getorderList(1);
          this.handleTabsClick('', 0);
          this.stockType = "hk";
          break;
        case 2:
          this.titleName = this.$t('hj286');
          this.getListDetail(2);
          this.getListDetails(2);
          this.getorderList(2);
          this.handleTabsClick('', 0);
          this.stockType = "my";
          break;
        case 3:
          this.titleName = this.$t('hj287');
          this.getListDetail(3);
          this.getListDetails(3);
          this.getorderList(3);
          this.handleTabsClick('', 0);
          this.stockType = "th";
          break;
        case 4:
          this.titleName = this.$t('hj288');
          this.getListDetail(4);
          this.getListDetails(4);
          this.getorderList(4);
          this.handleTabsClick('', 0);
          this.stockType = "in";
          break;
        case 5:
          this.titleName = this.$t('hj290');
          this.getListDetail(5);
          this.getListDetails(5);
          this.getorderList(5);
          this.handleTabsClick('', 0);
          this.stockType = "vn";
          break;
        case 6:
          this.titleName = this.$t('hj289');
          this.getQhListDetail();
          this.getQhListDetails();
          this.getorderList(6);
          this.handleTabsClick('', 0);
          this.stockType = "qh";
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
      this.tabsCurrentIndex = index;
      //持仓已平仓选项卡
      if (index == 6) {
        this.finishedXg =false;
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
    async getorderList(index) {
      let opts = {}
      opts.type = index
      let data = await api.getorderList(opts);
      this.loadingss = false;
      if (data.status === 0) {
        if(index==1){
          data.data.forEach(element => {
            this.tabsOrderList1.push(element)
          })
          this.totalss1 = data.data.length
        }else if(index==2){
          data.data.forEach(element => {
            this.tabsOrderList2.push(element)
          })
          this.totalss2 = data.data.length
        }else if(index==3){
          data.data.forEach(element => {
            this.tabsOrderList3.push(element)
          })
          this.totalss3 = data.data.length
        }else if(index==4){
          data.data.forEach(element => {
            this.tabsOrderList4.push(element)
          })
          this.totalss4 = data.data.length
        }else if(index==5){
          data.data.forEach(element => {
            this.tabsOrderList5.push(element)
          })
          this.totalss5 = data.data.length
        }else if(index==6){
          data.data.forEach(element => {
            this.tabsOrderList6.push(element)
          })
          this.totalss6 = data.data.length
        }else{
          data.data.forEach(element => {
            this.tabsOrderList.push(element)
          })
          this.totalss = data.data.length
        }


        this.finishedss = true; //只有一页，所以锁住翻页。有需要刷新数据的时候在调用方法前重新解锁
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    async getIndexSettingInfo() {
      // 网站设置信息 指数
      let data = await api.getIndexSetting()
      if (data.status === 0) {
        // 成功
        this.indexSettingInfo = data.data
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    async getFuturesSetting() {
      // 网站设置信息 期货
      let data = await api.getFuturesSetting()
      if (data.status === 0) {
        // 成功
        this.futuresSettingInfo = data.data
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    async getSettingInfo() {
      let data = await api.getSetting()
      if (data.status === 0) {
        // 成功
        this.settingInfo = data.data
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    // async getUserInfo() {
    //   // 获取用户信息
    //   //   let showcookie = this.getCookie('USER_TOKEN');
    //   let data = await api.getUserInfo()
    //   if (data.status === 0) {
    //     // this.getProductSetting()
    //     this.$store.state.userInfo = data.data
    //   } else {
    //     Toast(data.msg)
    //   }
    //   this.$store.state.user = this.user
    // },

    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // 判断是否登录
        this.$store.commit('dialogVisible', false);
        this.$store.state.userInfo = data.data;
      } else {
        this.$store.commit('dialogVisible', true);
      }
    },
    async getListDetail(index) {
      //获取股票的持仓列表
      this.loading = true;
      let opt = {
        state: 0,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        pageNum: this.page,
        type:index,
        pageSize: 15,
      }
      let data = await api.getOrderList(opt)
      this.loading = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finished = true;
        }
        if(index==1){
          data.data.list.forEach(element => {
            this.tabsPositionNumArr1.push(element)
          })
          this.total1 = data.data.total
        }else if(index==2){
          data.data.list.forEach(element => {
            this.tabsPositionNumArr2.push(element)
          })
          this.total2 = data.data.total
        }else if(index==3){
          data.data.list.forEach(element => {
            this.tabsPositionNumArr3.push(element)
          })
          this.total3 = data.data.total
        }else if(index==4){
          data.data.list.forEach(element => {
            this.tabsPositionNumArr4.push(element)
          })
          this.total4 = data.data.total
        }else if(index==5){
          data.data.list.forEach(element => {
            this.tabsPositionNumArr5.push(element)
          })
          this.total5 = data.data.total
        }else{
          data.data.list.forEach(element => {
            this.tabsPositionNumArr.push(element)
          })
          this.total = data.data.total
        }

      } else {
        //Toast(this.$t('hj327'))
      }
    },
    // async getzhishuListDetail() {
    //   //获取指数持仓
    //   this.loading = true;
    //   let opt = {
    //     state: 0,
    //     stockCode: '', // 代码
    //     stockSpell: '', // 简拼
    //     pageNum: this.pageNum,
    //     pageSize: this.pageSize
    //   }
    //   let data = await api.getIndexOrderList(opt)
    //   this.loading = false;
    //   if (data.status === 0) {
    //     if (data.data.list.length < 15) {
    //       this.finished = true;
    //     }
    //     data.data.list.forEach(element => {
    //       this.tabsPositionNumArr.push(element)
    //     })
    //     this.total = data.data.total
    //   } else {
    //     Toast(data.msg)
    //   }
    // },
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
          this.tabsPositionNumArr6.push(element)
        })
        this.total6 = data.data.total
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    async getListDetails(index) {
      //获取沪深我的平仓列表
      this.loadings = true;
      let opt = {
        state: 1,
        stockCode: '', // 代码
        stockSpell: '', // 简拼
        pageNum: this.pages,
        type:index,
        pageSize: 15
      }
      let data = await api.getOrderList(opt)
      this.loadings = false;
      if (data.status === 0) {
        if (data.data.list.length < 15) {
          this.finisheds = true;
        }
        if(index==1){
          data.data.list.forEach(element => {
            this.tabsPcArr1.push(element)
          })
          this.totals1 = data.data.total
        }else if(index==2){
          data.data.list.forEach(element => {
            this.tabsPcArr2.push(element)
          })
          this.totals2 = data.data.total
        }else if(index==3){
          data.data.list.forEach(element => {
            this.tabsPcArr3.push(element)
          })
          this.totals3 = data.data.total
        }else if(index==4){
          data.data.list.forEach(element => {
            this.tabsPcArr4.push(element)
          })
          this.totals4 = data.data.total
        }else if(index==5){
          data.data.list.forEach(element => {
            this.tabsPcArr5.push(element)
          })
          this.totals5 = data.data.total
        }else{
          data.data.list.forEach(element => {
            this.tabsPcArr.push(element)
          })
          this.totals = data.data.total
        }
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    // async getzhishuListDetails() {
    //   //获取指数平仓
    //   this.loadings = true;
    //   let opt = {
    //     state: 1,
    //     stockCode: '', // 代码
    //     stockSpell: '', // 简拼
    //     pageNum: this.pageNum,
    //     pageSize: 15
    //   }
    //   let data = await api.getIndexOrderList(opt)
    //   this.loadings = false;
    //   if (data.data.list.length < 15) {
    //     this.finisheds = true;
    //   }
    //   if (data.status === 0) {
    //     data.data.list.forEach(element => {
    //       this.tabsPcArr.push(element)
    //     })
    //     this.totals = data.data.total
    //   } else {
    //     Toast(data.msg)
    //   }
    // },
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
          this.tabsPcArr6.push(element)
        })
        this.totals6 = data.data.total
      } else {
        //Toast(this.$t('hj327'))
      }
    },
    async getNewXg() {
      //获取新股
      this.loadingXg = true;
      let opt = {
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
        //Toast(this.$t('hj327'))
      }
    },
  },
  filters: {
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
.white{
  color: #fff;
}

.red {
  color: #f5222d;
  // background: #fff1f0;
  // border-color: #ffa39e;
}

.blue {
  color: #1890ff;
  background: #e6f7ff;
  border-color: #91d5ff;
}

.green {
  color: #52c41a;
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
  height: 100%;
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
    color: #fff;
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

.linetag{
  width: 36px;
  height: 36px;
  background:  rgba(255,255,255,0.05);
  margin-right: 8px;
  text-align: center;
  line-height: 36px;
  color: #fff;
}

.left_line,.right_yue{
  display: flex;

}

.warehouse_card {
  width: 100%;
  height: calc(100% - 1rem);
  position: absolute;
  top: 1.5231rem;
  z-index: 0;
  padding: 0 0.3333rem;

  .top_card {
    width: 100%;
    height: 5.2308rem;
    border-radius: 0.15rem;
    margin-top: 0.3rem;
    background: #082E66;

    .card_content {
      width: 100%;
      height: 100%;
      padding: 0.4rem;

      .card_top{
        display: flex;
        justify-content:space-between;
      }
      .t_tag{
        opacity:0.15;
        height: 100px;
        margin-right: 16px;
        font-weight: 500;
        background: linear-gradient(180deg, #FFFFFF 0%, rgba(255,255,255,0) 100%);
        font-size: 148px;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }

      .t_title {
        width: 100%;
        height: 0.5128rem;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        color:#fff;
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
          font-size: 0.5rem;
          margin-top: 0.07rem;
          color: #fff;
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
            color: #fff;
            font-size: 0.3rem;
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
        margin-top: 0.8rem;
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
  height: calc(100% - 4.24rem - 0.5rem - 0.6rem);
  margin-top: 0.3rem;
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
    background: #030E1E;
    border-radius: 100px;

    display: flex;
    align-items: center;
    font-size: 0.2103rem;
    padding: 0.2rem 0.3rem 0;
    justify-content: space-between;
    overflow-x: scroll;

    &::-webkit-scrollbar {
      display: none;
    }

    >div {
      width: 25%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      white-space: nowrap;

      span {
        width: 100%;
        display: inline-block;
        height: 100%;
        line-height: 0.7179rem;
        text-align: center;
        color: #fff;
      }

      span.active {

        color: rgb(62, 121, 226);
        text-align: center;
        background: #89B9FF;
        border-radius: 100px;
        // border-bottom: 0.1rem solid rgb(62, 121, 226);

      }

      span.active::after {
        content: '';
        width: 100%;

        height: 0.001rem;
        display: block;
        margin: 0 auto;
      }

    }
  }

  .tabs_o {
    width: 100%;
    margin-top: 0.3rem;

    >.tabs_o_items {
      width: 100%;
      // height: 2.2rem;
      position: relative;
      margin-bottom: 0.3rem;
      padding: 0.3rem 0;
      background: rgba(255,255,255,0.05);
      border-radius: 8px;

      .tabs_o_title {
        width: 100%;
        // height: 0.7179rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;

        span {
          display: inline-block;
        }

        .title {
          font-weight: 600;
          font-size: 0.4059rem;
          color: #fff;
        }

        .buy_to_sell {
          padding:0.1rem 0.2rem;
        }

        .multiple {
          padding:0.1rem  0.2rem;
          background-color: rgba(0, 0, 255,0.2);
          color: #1377FE;
        }

        .nums {
          color: @topCardColor;
        }
      }

      .center_price {
        width: 100%;
        // height: 0.3846rem;
        display: flex;
        align-items: center;
        margin-top: 0.3rem;
        color: #fff;
        margin-left: 0.2rem;
        >div {
          width: 28%;
          height: 100%;

          span {
            font-weight: 600;
          }
        }

        .profit {
          color: rgb(209, 79, 91);
        }
      }

      .bottom_price_title {
        width: 100%;
        // height: 0.4rem;
        margin-top: 0.2rem;
        display: flex;
        align-items: center;
        margin-left: 0.2rem;

        >div {
          width: 28%;
          height: 100%;
          color: @topCardColor;

          span {
            font-weight: 600;
          }
        }
      }
    }
  }
}

.waiting {
  width: 100%;
  height: 400px;
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

.right_btn {
  width: 1.9949rem;
  height: 0.6667rem;
  // line-height: 0.6667rem;
  // position: absolute;
  right: 1%;
  top: 27%;
  // background: #f7f7f7;
  // color: #3773dd;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.15rem;
  margin-right: 10px;
  span {
    font-weight: 600;
    font-size: 0.2846rem;
  }
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
  margin-top: .2rem;
}

.oes {
  // height: 1.5rem !important;
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
  width: 100%;
  height: 1.2rem;
  border-radius: .2rem;
  padding: 0 .3rem;
  margin: .1rem 0;
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
  //width: auto !important;
  // padding-left: 0.5rem;
  letter-spacing: 0.02rem;
}

.kuans {
  width: auto !important;
  padding-left: 0.5rem;
  letter-spacing: 0.02rem;
}

// .left_price {
//   font-weight: normal;

//   span {
//     font-size: 0.3rem;
//     color: #fff;
//     font-weight: 500 !important;
//     ;
//   }
// }

.left_price {
  font-weight: normal;

  span {
    color: #fff;
    line-height: 0.6rem;
    font-weight: 500 !important;
    ;
  }
}

.numDemo {
  font-size: 0.3rem;
  color: #fff;
  font-weight: 500 !important;
  ;
}

.maichu {
  background-color:rgba(0,255,0,0.2);
  border-radius: 8px;
  color: #07F8B5;
}

.mairu {
  background-color:rgba(255,0,0,0.2);
  border-radius: 8px;
  color: #DD4444;

}

.jiantou {
  position: relative;
}

.jiantou::before {
  content: '';
  background-image: url('../../assets/img/youyou.svg');
  background-size: 100% 100%;
  width: 0.6rem;
  height: 0.2rem;
  font-size: 0.8rem;
  position: absolute;
  right: 0.5rem;
  top: calc(50% - 0.15rem);
}
</style>
