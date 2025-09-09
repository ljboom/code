<template>
  <div class="tr_list_page">
    <div class="content">
      <div class="tabs">
        <!-- <div class="bottom_content" v-if="tabsIndex === 2">

          <div class="kai_mess" v-show="isToken == ''" @click="$router.push('/login')">
            <div class="left_identity_img">
              <img src="../../assets/img/shenfen2.png" alt />
            </div>
            <div class="text">
              <span>{{ $t('hj38') }}</span>
            </div>
            <div class="right_go">
              <img src="../../assets/img/yuoujiantou.png" alt />
            </div>
          </div>
          <div class="list_title">
            <div class="item_title varieties">
              <span>{{ $t('hj39') }}</span>
            </div>
            <div class="item_title latest_price">
              <span>{{ $t('hj40') }}</span>
            </div>
            <div class="item_title applies">
              <span >{{ $t('hj41') }}</span>
            </div>
          </div>

          <div class="list" :class="isToken == '' ? 'listHeight' : 'listHeights'">
            <van-list v-model="loading" :finished="finished" :finished-text="$t('hj43')" @load="onLoad"
              :immediate-check="false">

              <div class="van-clearfix">
                  <div class="list_items">
                    <div class="item" v-for="(item, index) in qhList" :key="index"
                      @click="handleGoToKlineDetail(item, index)">
                      <div>
                        <div class="left_title">
                          <div class="tp">
                            <span class="collection" @click.stop="options(item)">
                              <span class="shu" :class="item.isOption == '1' ? 'shublue' : ''"></span>
                            </span>
                            <span class="title_color" style="white-space: nowrap;overflow: hidden;">
                              {{ item.futuresName }}
                            </span>
                          </div>
                          <div class="bt">
                            <span>
                              {{ item.futuresGid }}
                            </span>
                          </div>
                        </div>
                        <div class="center_price">
                          <div class="tp">
                            <span class="price_color" :class="item.coinRate > 0 ? 'green' : 'red'">
                              {{ item.nowPrice }}
                            </span>
                          </div>
                          <div class="bt">
                            <span v-if="tabsItemIndex == 5 || tabsItemIndex == 1">{{ tabsItemIndex == 5 ? 'Max:' +
                                Number(item.orderNumber) : $t('hj44') + ':' + Number(item.transFee)
                            }}</span>
                            <span v-else>{{ item.today_min }}</span>
                          </div>
                        </div>
                        <div class="right_bs">
                          <div class="tp" style="justify-content: flex-end;">
                            <span class="price_color" :class="((item.nowPrice - item.lastClose) / item.lastClose * 100).toFixed(2) > 0 ? 'green' : 'red'">
                              {{
                                  item.lastClose == "" ? 0.00 : ((Number(item.nowPrice) - Number(item.lastClose)) /
                                    Number(item.lastClose) * 100).toFixed(2) + '%'
                              }}
                            </span>
                          </div>
                          <div class="bt" style="justify-content: flex-end;">
                            <div v-if="tabsItemIndex != 1 && tabsItemIndex != 5">{{ item.preclose_px }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </van-list>
          </div>
        </div> -->



        <div class="bottom_content" v-if="tabsIndex === 1">
          <!-- 搜索框 -->
          <div class="search">
            <div class="search_content">
              <div class="left_search">
                <div class="search_img">
                  <img src="../../assets/img/searchs.png" alt />
                </div>
                <div class="search_input">
                  <input type="text" class="searchs" :placeholder="$t('hj37')" ref="search" id="sousuo" v-model="gpcode"
                    @input="gpinput" />
                </div>
              </div>
            </div>
          </div>
          <div class="tab_class">
            <div class="scroll_tab">
              <div class="tab_items" v-for="(item, index) in tabsClassArr" :key="index" :class="index == 0 ? 'mrt' : ''"
                @click="handleTabsItem(item, index)">
                <span :class="tabsItemIndex === index ? 'active' : ''">{{ item.name }}</span>
              </div>
            </div>
          </div>
          <div class="kai_mess" v-show="isToken == ''" @click="$router.push('/login')">
            <div class="left_identity_img">
              <img src="../../assets/img/shenfen2.png" alt />
            </div>
            <div class="text">
              <span>{{ $t('hj38') }}</span>
            </div>
            <div class="right_go">
              <img src="../../assets/img/yuoujiantou.png" alt />
            </div>
          </div>
          <div class="list_title">
            <div class="item_title varieties">
              <span>{{ $t('hj39') }}</span>
            </div>
            <div class="item_title latest_price">
              <span>{{ $t('hj40') }}</span>
            </div>
            <div class="item_title applies">
              <span v-show="tabsItemIndex != 1">{{ $t('hj41') }}</span>
              <span v-show="tabsItemIndex == 1" style="width: 100%;text-align: center;">{{ $t('hj42') }}</span>
            </div>
          </div>
          <!-- 市场列表 -->
          <div class="list" :class="isToken == '' ? 'listHeight' : 'listHeights'">

            <van-list v-if="tabsItemIndex==0" v-model="loading" :finished="finished" :finished-text="$t('hj43')" :immediate-check="false" @load="onLoad" >
              <div   class="van-clearfix">
                <div class="list_items">
                  <div class="item" v-for="(item, index) in listArr" :key="index"
                    @click="handleGoToKlineDetail(item, index)">
                    <div v-if="(tabsItemIndex == 1 && item.zt == 0) || tabsItemIndex != 1">
                      <div class="left_title">
                        <div class="tp" style="width:95% ;">
                          <span class="collection" @click.stop="options(item)">
                            <span v-show="tabsItemIndex != 1" class="shu"
                              :class="item.isOption == '1' ? 'shublue' : ''"></span>
                            <span v-show="tabsItemIndex == 1" class="shu hongse"></span>
                          </span>
                          <span class="title_color" style="white-space: nowrap;overflow: hidden;">
                            {{ item.name }}
                          </span>
                        </div>
                        <div class="bt">
                          <span>
                            {{ tabsItemIndex == 1 ? item.stockType + item.code : item.code }}
                          </span>
                        </div>
                      </div>
                      <div class="center_price">
                        <div class="tp">
                          <span class="price_color"
                            v-if="tabsItemIndex != 1" :class="item.hcrate > 0 ? 'green' : 'red'">
                            {{ item.nowPrice}}
                          </span>
                          <span class="price_color" v-else>
                            {{ tabsItemIndex == 1 ? Number(item.price).toFixed(2) : item.currentPoint }}
                          </span>
                        </div>
                        <div class="bt">
                          <span v-if="tabsItemIndex == 1">{{ tabsItemIndex == 1 ? 'Max:' +
                              Number(item.orderNumber) : $t('hj44') + ':' + Number(item.transFee)
                          }}</span>
                          <span v-else>{{ item.today_min }}</span>
                        </div>
                      </div>
                      <div class="right_bs">
                        <div class="tp" style="justify-content: flex-end;">
                          <span class="price_color"
                            v-if="tabsItemIndex != 1" :class="item.hcrate > 0 ? 'green' : 'red'">{{ item.hcrate }}</span>

                          <div v-if="tabsItemIndex == 1" :class="item.type == 1 ? 'xgsgType' : 'xgsgTypeRed'">
                            <!-- {{item.orderNumber}} -->
                            {{ item.type == 1 ? $t('hj45') : $t('hj46') }}
                          </div>
                        </div>
                        <div class="bt" style="justify-content: flex-end;">
                          <div v-if="tabsItemIndex != 1">{{ item.preclose_px }}</div>
                          <!-- class="codeIcon"  item.stock_type.toUpperCase()-->
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            </van-list>



            <van-list v-if="tabsItemIndex==1" v-model="loading2"
            :finished="finished2" :finished-text="$t('hj43')"
            :immediate-check="false" @load="onLoadNew" >
              <div  class="van-clearfix">
                <div class="list_items">
                  <div class="item" v-for="(item, index) in listArr5" :key="index"
                    @click="handleGoToKlineDetail(item, index)">
                    <div v-if="(tabsItemIndex == 1 && item.zt == 0) || tabsItemIndex != 1">
                      <div class="left_title">
                        <div class="tp">
                          <span class="collection" @click.stop="options(item)">
                            <span v-show="tabsItemIndex != 1" class="shu"
                              :class="item.isOption == '1' ? 'shublue' : ''"></span>
                            <span v-show="tabsItemIndex == 1" class="shu hongse"></span>
                          </span>
                          <span class="title_color" style="white-space: nowrap;overflow: hidden;">
                            {{ item.name }}
                          </span>
                        </div>
                        <div class="bt">
                          <span>
                            {{ tabsItemIndex == 1 ? item.stockType + item.code : item.gid }}
                          </span>
                        </div>
                      </div>
                      <div class="center_price">
                        <div class="tp">
                          <span class="price_color"
                            v-if="tabsItemIndex != 1"
                            :class="item.hcrate > 0 ? 'green' : 'red'">
                            {{ item.nowPrice
                            }}
                          </span>
                          <span class="price_color" v-else>
                            {{ tabsItemIndex == 1 ? Number(item.price).toFixed(2) :
                                item.currentPoint
                            }}
                          </span>
                        </div>
                        <div class="bt">
                          <span v-if="tabsItemIndex == 1">{{ tabsItemIndex == 1 ? 'Max:' +
                              Number(item.orderNumber) : $t('hj44') + ':' + Number(item.transFee)
                          }}</span>
                          <span v-else>{{ item.today_min }}</span>
                        </div>
                      </div>
                      <div class="right_bs">
                        <div class="tp" style="justify-content: flex-end;">
                          <span class="price_color"
                            v-if="tabsItemIndex != 1"
                            :class="item.hcrate > 0 ? 'green' : 'red'">{{ item.hcrate }}</span>
                          <div v-if="tabsItemIndex == 1" :class="item.type == 1 ? 'xgsgType' : 'xgsgTypeRed'">
                            <!-- {{item.orderNumber}} -->
                            {{ item.type == 1 ? $t('hj45') : $t('hj46') }}
                          </div>
                        </div>
                        <div class="bt" style="justify-content: flex-end;">
                          <div v-if="tabsItemIndex != 1">{{ item.preclose_px }}</div>
                          <!-- class="codeIcon"  item.stock_type.toUpperCase()-->
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </van-list>
          </div>
        </div>


        <div class="bottom_content" v-if="tabsIndex === 0">
          <!-- 搜索框 -->
          <div class="search">
            <div class="search_content">
              <div class="left_search">
                <div class="search_img">
                  <img src="../../assets/img/searchs.png" alt />
                </div>
                <div class="search_input">
                  <input type="text" class="searchs" :placeholder="$t('hj37')"
                    onkeyup="value=value.replace(/[^a-zA-Z0-9]/g,'')" v-model="gpcodes" @input="gpinputs" />
                </div>
              </div>
            </div>
          </div>
          <div class="list_title">
            <div class="item_title varieties">
              <span>{{ $t('hj39') }}</span>
            </div>
            <div class="item_title latest_price">
              <span>{{ $t('hj40') }}</span>
            </div>
            <div class="item_title applies">
              <span>{{ $t('hj41') }}</span>
            </div>
          </div>


          <!-- 自选列表 -->
          <div class="list zxlist">
            <van-list v-model="loadings" :finished="finisheds" :finished-text="$t('hj43')" @load="onLoads"
              :immediate-check="false">
              <div class="van-clearfix">
                <div class="list_items">
                  <div class="item" @click="handleGoToKlineDetail1(item, index)" v-for="(item, index) in listArrs"
                    :key="item.indexCode">
                    <div class="left_title" style="flex-direction: column;align-items: flex-start;">
                      <div class="tp" style="display: flex;align-items: center;line-height: 2;">
                        <span class="collection" @click="optionszx(item)">
                          <span class="shu" :class="item.isOption == '1' ? 'shublue' : ''"></span>
                        </span>
                        <span class="title_color"
                          style="overflow: hidden;-webkit-line-clamp: 1;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;">{{
                              item.stockName
                          }}</span>
                      </div>
                      <div class="bt">
                        <span>{{ item.stockGid }}</span>
                      </div>
                    </div>
                    <div class="center_price" style="align-items: center;">
                      <div class="tp">
                        <span class="price_color">{{ item.nowPrice }}</span>
                      </div>
                      <div class="bt">
                        <span>{{ item.addTime }}</span>
                      </div>
                    </div>
                    <div class="right_bs" style="justify-content: flex-end;align-items: center;">
                      <div class="tp">
                        <span class="price_color" :class="item.hcrate > 0 ? 'green' : 'red'">{{ item.hcrate }}</span>
                      </div>
                      <div class="bt">
                        <!-- <div>{{ item.stock_type.toUpperCase() }}</div> -->
                        <!-- class="codeIcon" -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </van-list>
          </div>
        </div>
      </div>
    </div>
    <div class="shai" v-if="dialogFlag" @click="openDialog()"></div>
    <div class="top_title" ref="topTitle">
      <div>
        <div class="tabs_title">
          <div class="tb" v-for="(item, index) in tabsArr" :key="index" @click="handleTabsClick(item, index)">
            <span :class="index === tabsIndex ? 'active' : ''">{{ item }}</span>
          </div>
        </div>
        <div class="right_money" @click="openDialog()">
          <div class="content_money" v-if="tabsIndex === 1">
            <div class="top_price">
              <div class="left">
                <span>{{ $t('hj47') }}</span>
              </div>
              <div class="right" v-if="userData.length == 0">$0.00</div>
              <div class="right" v-if="userData.length != 0">
                <span v-if="$store.state.userInfo.userAmt == undefined">$0.00</span>
                <!-- <span v-if="$store.state.userInfo && tabsItemIndex == 3" style="white-space: nowarp;">
                  {{ '฿' + $store.state.userInfo.userIndexAmt
                  }}
                </span> -->

                <span v-if="$store.state.userInfo.inEnableAmt != undefined && tabsItemIndex == 0"
                  style="white-space: nowarp;">
                  {{ 'Rs ' + $store.state.userInfo.inEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.enableFuturesAmt != undefined && tabsItemIndex == 1"
                  style="white-space: nowarp;">
                  {{ '$ ' + $store.state.userInfo.enableFuturesAmt
                  }}
                </span>
                <!-- <span v-if="$store.state.userInfo.enableAmt != undefined && (tabsItemIndex == 0)"
                  style="white-space: nowarp;">
                  {{ '$ ' + $store.state.userInfo.enableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.hkEnableAmt != undefined && tabsItemIndex == 1"
                  style="white-space: nowarp;">
                  {{ 'HK$ ' + $store.state.userInfo.hkEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.myEnableAmt != undefined && tabsItemIndex == 2"
                  style="white-space: nowarp;">
                  {{ 'Rm ' + $store.state.userInfo.myEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.thEnableAmt != undefined && tabsItemIndex == 3"
                  style="white-space: nowarp;">
                  {{ '฿ ' + $store.state.userInfo.thEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.inEnableAmt != undefined && tabsItemIndex == 4"
                  style="white-space: nowarp;">
                  {{ 'Rs ' + $store.state.userInfo.inEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.vnEnableAmt != undefined && tabsItemIndex == 5"
                  style="white-space: nowarp;">
                  {{ '₫ ' + $store.state.userInfo.vnEnableAmt
                  }}
                </span>
                <span v-if="$store.state.userInfo.enableFuturesAmt != undefined && tabsItemIndex == 6"
                  style="white-space: nowarp;">
                  {{ '$ ' + $store.state.userInfo.enableFuturesAmt
                  }}
                </span> -->
                <!-- <span v-if="$store.state.userInfo && tabsItemIndex == 3" style="white-space: nowarp;">
                  {{
                      '¥' + $store.state.userInfo.userFuturesAmt
                  }}
                </span> -->
              </div>
              <div class="sanjiao">
                <img :class="dialogFlag ? 'xuanz' : ''" style="transition: all 0.5s;" src="../../assets/img/xiala.svg"
                  alt />
              </div>
            </div>
            <!-- <div class="bottom_balance">
              <div>
                <span>{{ $t('hj48') }}</span>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="cards">
        <div class="card_item">
          <div class="tops_title">
            <div>
              <span>{{ $t('hj49') }}</span>
            </div>
          </div>
          <div class="bottom_price">
            <div v-if="tabsItemIndex == 0">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                Rs {{ $store.state.hide ? '****' : $store.state.userInfo.inEnableAmt
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                Rs {{ $store.state.hide ? '****' : $store.state.userInfo.inEnableAmt
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">Rs {{ $store.state.hide ? '****' : $store.state.userInfo.inEnableAmt
                }}</p>
            </div>


            <div v-if="tabsItemIndex == 1">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">$ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt).toFixed(2) }}</p>
            </div>
            <!-- <div v-if="tabsItemIndex == 0">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt)).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt)).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">$ {{ $store.state.hide ? '****' :
                    Number($store.state.userInfo.userAmt).toFixed(2)
                }}</p>
            </div>
            <div v-if="tabsItemIndex == 1">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                HK$ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt) * 7.82).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                HK$ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt) * 7.82).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">HK$ {{ $store.state.hide ? '****' :
                    Number(Number($store.state.userInfo.userAmt) * 7.82).toFixed(2)
                }}</p>
            </div>

            <div v-if="tabsItemIndex == 2">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                RM {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt) * 4.7).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                RM {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt) * 4.7).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">RM {{ $store.state.hide ? '****' :
                    Number(Number($store.state.userInfo.userAmt) * 4.7).toFixed(2)
                }}</p>
            </div>

            <div v-if="tabsItemIndex == 3">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                ฿ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt) * 36.8).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                ฿ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt) * 36.8).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">฿ {{ $store.state.hide ? '****' :
                    Number(Number($store.state.userInfo.userAmt) * 36.8).toFixed(2)
                }}</p>
            </div>

            <div v-if="tabsItemIndex == 4">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                Rs {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt) * 83.1).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                Rs {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt) * 83.1).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">Rs {{ $store.state.hide ? '****' :
                    Number(Number($store.state.userInfo.userAmt) * 83.1).toFixed(2)
                }}</p>
            </div>

            <div v-if="tabsItemIndex == 5">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                ₫ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt) * 24333.2).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                ₫ {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt) * 24333.2).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">₫ {{ $store.state.hide ? '****' :
                    Number(Number($store.state.userInfo.userAmt) * 24333.2).toFixed(2)
                }}</p>
            </div>

            <div v-if="tabsItemIndex == 6">
              <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                $ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">$ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt).toFixed(2) }}</p>
            </div>
            -->

          </div>
        </div>

        <div class="card_item">
          <div class="tops_title">
            <div>
              <span>{{ $t('hj50') }}</span>
            </div>
          </div>
          <div class="bottom_price">
            <div>

              <span v-show="tabsItemIndex == 0">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.inEnableAmt
                    +
                    $store.state.userInfo.inAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>
              <span v-show="tabsItemIndex == 1">
                {{ $store.state.hide ? '****' : Number(($store.state.userInfo.enableFuturesAmt
                    +
                    $store.state.userInfo.allFuturesFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                }}
              </span>

              <!-- <span v-show="tabsItemIndex == 6">
                {{ $store.state.hide ? '****' : Number(($store.state.userInfo.enableFuturesAmt
                    +
                    $store.state.userInfo.allFuturesFreezAmt) * settingInfo.forceStopPercent).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 0">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.enableAmt
                    +
                    $store.state.userInfo.allFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 1">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.hkEnableAmt
                    +
                    $store.state.userInfo.hkAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 2">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.myEableAmt
                    +
                    $store.state.userInfo.myAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 3">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.thEnableAmt
                    +
                    $store.state.userInfo.thAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 4">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.inEnableAmt
                    +
                    $store.state.userInfo.inAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span>

              <span v-show="tabsItemIndex == 5">
                {{ $store.state.hide ? '****' : Number(Number($store.state.userInfo.vnEnableAmt
                    +
                    $store.state.userInfo.vnAllFreezAmt) * Number(settingInfo.forceStopPercent)).toFixed(2)
                }}
              </span> -->

            </div>
          </div>
        </div>
        <div class="card_item">
          <div class="tops_title">
            <div>
              <!-- <span>
                {{ tabsItemIndex ==0?$t('hj63'):tabsItemIndex == 1 ? $t('hj51') : tabsItemIndex == 2 ? $t('hj64') : tabsItemIndex == 3 ? $t('hj65') :
                    tabsItemIndex == 4 ? $t('hj66') : tabsItemIndex == 5 ? $t('hj283'): $t('hj52')
                }}{{ $t('hj53') }}
              </span> -->
              <span>
                {{ tabsItemIndex ==0?$t('hj63'):$t('hj52')
                }}{{ $t('hj53') }}
              </span>

            </div>
          </div>
          <div class="bottom_price">
            <div>
              <span v-show="tabsItemIndex == 0">{{ 'Rs ' + Number($store.state.userInfo.inEnableAmt).toFixed(2) }}</span>
              <span v-show="tabsItemIndex == 1">{{ '$ ' + $store.state.userInfo.enableAmt }}</span>
              <!-- <span v-show="tabsItemIndex == 2">{{ 'RM ' + Number($store.state.userInfo.myEnableAmt).toFixed(2) }}</span>
              <span v-show="tabsItemIndex == 0 || tabsItemIndex == 6">{{ '$ ' + $store.state.userInfo.enableAmt }}</span>
              <span v-show="tabsItemIndex == 3">{{ '฿ ' + Number($store.state.userInfo.thEnableAmt).toFixed(2)
              }}</span>
              <span v-show="tabsItemIndex == 1">{{ 'HK$ ' + Number($store.state.userInfo.hkEnableAmt).toFixed(2)
              }}</span>
              <span v-show="tabsItemIndex == 4">{{ 'Rs ' + Number($store.state.userInfo.inEnableAmt).toFixed(2) }}</span>
              <span v-show="tabsItemIndex == 5">{{ '₫ ' + Number($store.state.userInfo.vnEnableAmt).toFixed(2) }}</span> -->
            </div>
          </div>
        </div>
        <div class="card_item">
          <div class="tops_title">
            <div>
              <span>{{ $t('hj54') }}</span>
            </div>
          </div>
          <div class="bottom_price">
            <div>
              <span v-show="tabsItemIndex == 0">{{ 'Rs ' + $store.state.userInfo.inEnableAmt
              }}</span>
              <span v-show="tabsItemIndex == 1">{{ '$ ' + $store.state.userInfo.enableAmt
              }}</span>
              <!-- <span v-show="tabsItemIndex == 0 || tabsItemIndex == 6">{{ '$ ' + $store.state.userInfo.enableAmt
              }}</span>
              <span v-show="tabsItemIndex == 1">{{ 'HK$ ' + $store.state.userInfo.hkEnableAmt
              }}</span>
              <span v-show="tabsItemIndex == 2">{{ 'RM ' + $store.state.userInfo.myEnableAmt
              }}</span>
              <span v-show="tabsItemIndex == 3">{{ '฿ ' + $store.state.userInfo.thEnableAmt
              }}</span>
              <span v-show="tabsItemIndex == 4">{{ 'Rs ' + $store.state.userInfo.inEnableAmt
              }}</span>
              <span v-show="tabsItemIndex == 5">{{ '₫ ' + $store.state.userInfo.vnEnableAmt
              }}</span> -->
            </div>
          </div>
        </div>
        <div class="card_item">
          <div class="tops_title">
            <div>
              <span>{{ $t('hj55') }}</span>
            </div>
          </div>
          <div class="bottom_price">
            <div>
              <span v-show="tabsItemIndex == 0">{{ 'Rs ' + $store.state.userInfo.inAllFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 1">{{ '$ ' + $store.state.userInfo.djzj
              }}</span>
              <!-- <span v-show="tabsItemIndex == 0">{{ '$ ' + $store.state.userInfo.allFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 6">{{ '$ ' + $store.state.userInfo.djzj
              }}</span>
              <span v-show="tabsItemIndex == 2">{{ 'RM ' + $store.state.userInfo.myAllFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 1">{{ 'HK$ ' + $store.state.userInfo.hkAllFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 3">{{ '฿ ' + $store.state.userInfo.thAllFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 4">{{ 'Rs ' + $store.state.userInfo.inAllFreezAmt
              }}</span>
              <span v-show="tabsItemIndex == 5">{{ '₫ ' + $store.state.userInfo.vnAllFreezAmt
              }}</span> -->

            </div>
          </div>
        </div>
        <div class="card_item">
          <div class="tops_title">
            <div>
              <span>{{ $t('hj56') }}</span>
            </div>
          </div>
          <div class="bottom_price">
            <div>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 1">{{ '$ ' + $store.state.userInfo.allProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.inAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 0">{{ 'Rs ' + $store.state.userInfo.inAllProfitAndLose
                }}</span>

              <!-- <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 0 || tabsItemIndex == 6">{{ '$ ' + $store.state.userInfo.allProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.hkAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 1">{{ 'HK$ ' + $store.state.userInfo.hkAllProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.myAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 2">{{ 'RM ' + $store.state.userInfo.myAllProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.thAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 3">{{ '฿ ' + $store.state.userInfo.thAllProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.inAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 4">{{ 'Rs ' + $store.state.userInfo.inAllProfitAndLose
                }}</span>
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.vnAllProfitAndLose < 0 ? ' green' : ''"
                v-show="tabsItemIndex == 5">{{ '₫ ' + $store.state.userInfo.vnAllProfitAndLose
                }}</span> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 新股弹窗 -->
    <van-popup v-model="settingDialog" position="bottom" :style="{ height: '45%' }" @close="popClose">
      <div class="setting_content">
        <div class="old_password">
          <div class="left_titles">
            <span>{{ $t('hj57') }}:</span>
          </div>
          <div class="right_password_input">
            <input type="number" v-model="sgNum"  />
          </div>

        </div>
        <span>{{this.$t('hj419')}}{{this.minTotal}}</span>
        <div class="btn_setting" @click="changeSg()">
          <span>{{ $t('hj58') }}</span>
        </div>
        <div class="shijian">
          <div class="xgsj">

            <div class="sjtlt">{{ $t('hj59') }}: </div>
            <div class="xgTime" v-if="this.sgsj">{{ this.sgsj | getTimeYear }}</div>
          </div>
          <div class="xgsj">
            <div class="sjtlt">{{ $t('hj60') }}: </div>
            <div class="xgTime" v-if="this.rjsj">{{ this.rjsj | getTimeYear }}</div>
          </div>
        </div>
        <!-- <div class="old_password">
          <div class="left_titles">
            <span>{{ '新密码:' }}</span>
          </div>
          <div class="right_password_input">
            <input type="password" v-model="newPassword" />
          </div>
        </div>
        <div class="old_password">
          <div class="left_titles">
            <span>{{ '确认新密码:' }}</span>
          </div>
          <div class="right_password_input">
            <input type="password" v-model="cirNewPassword" />
          </div>
        </div> -->

      </div>
    </van-popup>

  </div>
</template>

<script>
//Toast
import { Toast } from 'vant';
import * as api from "@/axios/api";
import handleDt from "@/utils/deTh";
export default {
  name: "trading",
  components: {
  },
  data() {
    return {
      tabsIndex: 1,
      //tabsArr: [this.$t('hj61'), this.$t('hj62'), this.$t('hj282')],
      tabsArr: [this.$t('hj61'), this.$t('hj62')],
      tabClassActive: 1,
      dialogFlag: false,
      pageNum: 1,
      pageNumNew: 1,
      pageNums: 1,
      stockPlate: "",
      alertShow: false,
      isToken: "",
      elType: "warning",
      indexSettingInfo: {},
      futuresSettingInfo: {},
      settingInfo: {},
      loading: false,
      loadings: false,
      finished: false,
      finisheds: false,
      loading2: false,
      finished2: false,
      settingDialog: false,
      xinguprice:'',
      sgNum: 1000,
      sgCode: '',
      gpcode: "",
      gpcodes: "",
      texts: "",
      sgsj: "",
      minTotal:1,
      rjsj: "",
      orderNumber: "",
      elAlertShow: false,
      userData: [],
      elAlertText: "",
      stockType: 'in',
      tabsClassArr: [

        {
          name: this.$t('hj66'),
          type: 0
        },
        {
          name: this.$t('hj3'),
          type: 1
        }
        // {
        //   name: this.$t('hj63'),
        //   type: 0
        // },
        // {
        //   name: this.$t('hj51'),
        //   type: 1
        // },
        // {
        //   name: this.$t('hj64'),
        //   type: 2
        // },
        // {
        //   name: this.$t('hj65'),
        //   type: 3
        // },
        // {
        //   name: this.$t('hj66'),
        //   type: 4
        // },
        // {
        //   name: this.$t('hj283'),
        //   type: 5
        // },
        // {
        //   name: this.$t('hj3'),
        //   type: 6
        // }
      ],
      tabsItemIndex: 0,
      listArr: [],
      listArr1:[],
      listArr2:[],
      listArr3:[],
      listArr4:[],
      listArr5:[],
      listArrs: [],
      qhList:[]
    };
  },

  created() {
    if (this.$route.query.type == 1) {
      //选中sousuo输入框
      this.$nextTick(() => {
        this.$refs.search.focus();
      });
    }
    if (this.$route.query.listid) {
      this.tabsItemIndex = Number(this.$route.query.listid)
    }
  },

  mounted() {
    this.loading = true;
    this.getStock();
    this.isToken = window.localStorage.getItem("USERTOKEN");
    this.getUserInfo();
    this.getIndexSettingInfo();
    this.getSettingInfo();
    this.getFuturesSetting();
    //this.getFuturesList();//期货列表
    //每隔5分钟定时刷新
    // this.timer = setInterval(() => {
    //   this.getStock();
    // }, 10000);
  },
  methods: {
    onLoad() {
      this.pageNum++;
      switch (this.tabsItemIndex) {
        case 0:
          this.stockPlate = "";
          this.stockType = "in";
          this.loading = true;
          this.getStock();
          break;
        // case 0:
        //   this.stockPlate = "";
        //   this.stockType = "us";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 1:
        //   this.stockPlate = "";
        //   this.stockType = "hk";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 2:
        //   this.stockPlate = "";
        //   this.stockType = "my";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 3:
        //   this.stockPlate = "";
        //   this.stockType = "th";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 4:
        //   this.stockPlate = "";
        //   this.stockType = "in";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 5:
        //   this.stockPlate = "";
        //   this.stockType = "vn";
        //   this.loading = true;
        //   this.getStock();
        //   break;
        // case 6:
        //   this.loading = true;
        //   this.getFutures();
        //   break;
      }

      //加载状态结束
      //this.loading = false;


      //数据全部加载完成
      // if (this.listArr.length >= 1) {
      //   this.finished = true;
      // }
      // if(this.tabsItemIndex==6){
      //   if (this.listArr5.length >= 1) {
      //     this.finished = true;
      //   }
      // }

    },
    onLoadNew(){
      this.pageNumNew++;
      switch (this.tabsItemIndex) {
        case 1:
          this.loading = true;
          this.getFutures();
          break;
      }
    },
    gpinput: handleDt.debounce(function() {

      this.pageNum = 1;
      this.listArr = [];
      this.listArr1 = [];
      this.listArr2 = [];
      this.listArr3 = [];
      this.listArr4 = [];
      this.listArr5 = [];
      this.qhList = [];
      this.loading = true;
      this.finished = false;
      this.stockType = '';

      switch (this.tabsItemIndex) {
        case 0:
          this.stockPlate = "";
          this.stockType = 'in';
          this.getStock();
          break;
        case 1:
          this.getFutures();
          break;


        // case 0:
        //   this.stockPlate = "";
        //   this.stockType = 'us';
        //   this.getStock();
        //   break;
        // case 1:
        //   this.stockPlate = "";
        //   this.stockType = 'hk';
        //   this.getStock();
        //   break;

        // case 2:
        //   this.stockPlate = "";
        //   this.stockType = 'my';
        //   this.getStock();
        //   break;
        // case 3:
        //   this.stockPlate = "";
        //   this.stockType = 'th';
        //   this.getStock();
        //   break;
        // case 4:
        //   this.stockPlate = "";
        //   this.stockType = 'in';
        //   this.getStock();
        //   break;
        // case 5:
        //   this.stockPlate = "";
        //   this.stockType = 'vn';
        //   this.getStock();
        //   break;
        // case 6:
        //   this.getFutures();
        //   break;
      }

    }, 1000),
    gpinputs() {
      this.pageNums = 1;
      this.listArrs = [];
      this.loadings = true;
      this.finisheds = false;
      this.getMyList();
    },
    onLoads() {
      this.pageNums++;
      this.loadings = true;
      this.getMyList();
    },
    closeAlert() {
      this.alertShow = false;
    },
    async getUserInfo() {
      // 获取用户信息
      //   let showcookie = this.getCookie('USER_TOKEN');
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // this.getProductSetting()

        this.$store.state.userInfo = data.data;
        this.userData = data.data;
      } else {


      }
      this.$store.state.user = this.user;
    },
    async getIndexSettingInfo() {
      // 网站设置信息 指数
      let data = await api.getIndexSetting();
      if (data.status === 0) {
        // 成功
        this.indexSettingInfo = data.data;
      } else {
        this.$store.commit('elAlertShow', { 'elAlertShow': true, 'elAlertText': this.$t('hj327') });
      }
    },
    async getFuturesSetting() {
      // 网站设置信息 期货
      let data = await api.getFuturesSetting();
      if (data.status === 0) {
        // 成功
        this.futuresSettingInfo = data.data;
      } else {
        this.$store.commit('elAlertShow', { 'elAlertShow': true, 'elAlertText': this.$t('hj327') });
      }
    },
    async getSettingInfo() {
      let data = await api.getSetting();
      if (data.status === 0) {
        // 成功
        this.settingInfo = data.data;
      } else {
        ` this.$store.commit('elAlertShow',{'elAlertShow':true,'elAlertText': this.$t('hj327')});`
      }
    },
    //  getListMarket:  handleDt.debounce(async function() {
    //   let val = {
    //     pageNum: this.pageNum,
    //     pageSize: 15
    //   };
    //   // 获取指数列表
    //   let result = await api.getListMarket(val);
    //   this.loading = false;
    //   if (result.status === 0) {
    //     if (this.tabsItemIndex == 1) {
    //       this.listArr1 = result.data;
    //       this.finished = true;
    //     }
    //   } else {
    //     this.texts = result.msg;
    //     this.alertShow = true;
    //   }
    // }, 500),


   getStock:  handleDt.debounce(async function() {
      let opt = {
        pageNum: this.pageNum,
        pageSize: 20,
        stockPlate: this.stockPlate,
        keyWords: this.gpcode,
        stockType: this.stockType
      };

      let data = await api.getStock(opt);
      this.loading = false;
      if (data.status === 0) {

        if (data.data.list.length < 20) {
          this.finished = true;
        }

        if (this.tabsItemIndex != 1) {
          if (this.gpcode) {
              this.listArr = data.data.list;
          } else {
            data.data.list.forEach(element => {
              this.listArr.push(element);
            });
          }
        }
      } else {
        this.texts = this.$t('hj327');
        this.alertShow = true;

      }

    }, 500),


    getFutures:  handleDt.debounce(async function() {
      // 获取新股列表
      let opt = {
      };
      let data = await api.getNewGu(opt);
      this.loading2 = false;
      if (data.status === 0) {
        if (this.tabsItemIndex == 1) {
          for (let index = 0; index < data.data.list.length; index++) {
            if (data.data.list[index].zt == 0) {
              this.listArr5.push(data.data.list[index]);
            }
          }
        }
        this.finished2 = true;
      } else {
        this.texts = data.msg;
        this.alertShow = true;
      }
    },500),


    //  getStockUs:  handleDt.debounce(async function() {
    //   //美股
    //   let opt = {
    //     pageNum: this.pageNum,
    //     pageSize: 15,
    //     stockPlate: this.stockPlate,
    //     keyWords: this.gpcode,
    //     stockType: this.stockType
    //   };
    //   let data = await api.getStock(opt);
    //   this.loading = false;
    //   if (data.status === 0) {
    //     if (data.data.list.length < 15) {
    //       this.finished = true;
    //     }
    //     if ( this.tabsItemIndex == 3) {
    //       if (this.gpcode) {
    //           this.listArr3 = data.data.list;
    //       } else {
    //         data.data.list.forEach(element => {
    //           this.listArr3.push(element);
    //         });
    //       }
    //     }
    //   } else {
    //     this.texts = data.msg;
    //     this.alertShow = true;
    //   }
    // },500) ,
    //  getStockHk:  handleDt.debounce(async function() {
    //   //港股
    //   let opt = {
    //     pageNum: this.pageNum,
    //     pageSize: 15,
    //     stockPlate: this.stockPlate,
    //     keyWords: this.gpcode,
    //     stockType: this.stockType
    //   };
    //   let data = await api.getStock(opt);
    //   this.loading = false;
    //   if (data.status === 0) {
    //     if (data.data.list.length < 15) {
    //       this.finished = true;
    //     }
    //     if ( this.tabsItemIndex == 4) {
    //       if (this.gpcode) {
    //           this.listArr4 = data.data.list;
    //       } else {
    //         data.data.list.forEach(element => {
    //           this.listArr4.push(element);
    //         });
    //       }
    //     }
    //   } else {
    //     this.texts = data.msg;
    //     this.alertShow = true;
    //   }
    // },500) ,
    //  getStocks:  handleDt.debounce(async function() {
    //   //科创
    //   let opt = {
    //     pageNum: this.pageNum,
    //     pageSize: 15,
    //     stockPlate: this.stockPlate,
    //     keyWords: this.gpcode
    //   };
    //   let data = await api.getStock(opt);
    //   this.loading = false;
    //   if (data.status === 0) {
    //     if (data.data.list.length < 15) {
    //       this.finished = true;
    //     }
    //     if (this.tabsItemIndex == 2) {
    //       if (this.gpcode) {
    //         this.listArr2 = data.data.list;
    //       } else {
    //         data.data.list.forEach(element => {
    //           this.listArr2.push(element);
    //         });
    //       }
    //     }
    //   } else {
    //     this.texts = data.msg;
    //     this.alertShow = true;
    //   }
    // },500),

    popClose() {
      this.sgCode = '';
      this.sgsj = '';
      this.rjsj = '';
      this.orderNumber = '';
      this.minTotal = 1;
    },
    async changeSg() {
      if (!this.sgNum) {
        Toast(this.$t('hj67'));
        return;
      };
      //this.sgNum必须是数字并且不能小于1
      if (this.sgNum < 1) {
        Toast(this.$t('hj68'));
        return;
      }
      if (this.sgNum > this.orderNumber) {
        Toast(this.$t('hj69') + this.orderNumber);
        return;
      }

      let opt = {
        newCode: this.sgCode,
        applyNums: this.sgNum,
        phone: this.$store.state.userInfo.phone,
      };
      let data = await api.getNewAdd(opt);
      if (data.status === 0) {
        this.sgShow = false;
        this.sgCode = '';
        this.sgsj = '';
        this.rjsj = '';
        this.orderNumber = '';
        this.minTotal = 1;
        Toast(this.$t('hj70'));
        this.$router.push({ path: '/warehouse' });

      } else if( data.msg.indexOf('請先登錄') > -1 ){
        Toast(this.$t('hj386'));
      } else if( data.msg.indexOf('未登录') > -1 ){
        Toast(this.$t('hj386'));
      } else if( data.msg.indexOf('下单失败，请先实名认证') > -1 ){
        Toast(this.$t('hj381'));
      } else if( data.msg.indexOf('周末或节假日不能交易') > -1 ){
        Toast(this.$t('hj395'));
      } else if( data.msg.indexOf('下单失败，账户已被锁定') > -1 ){
        Toast(this.$t('hj380'));
      } else if( data.msg.indexOf('新股代码不存在') > -1 ){
        Toast(this.$t('hj397'));
      } else if( data.msg.indexOf('下单失败，系统设置错误') > -1 ){
        Toast(this.$t('hj390'));
      } else if( data.msg.indexOf('申购失败，不在交易时段内') > -1 ){
        Toast(this.$t('hj356'));
      } else if( data.msg.indexOf('购买数量最小为') > -1 ){
        Toast(this.$t('hj403'));
      } else if( data.msg.indexOf('用户可用余额不足') > -1 ){
        Toast(this.$t('hj389'));
      } else {
        Toast(this.$t('hj356'));
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    handleGoToKlineDetail1(item) {
      var codes = item.stockCode;
      var names = item.stockName;
      var if_zhishu = '0';
      //var if_us = item.stock_type == 'hk' ? '2' : '1';
      this.$router.push({
        path: "/kline",
        query: {
          pid: item.data_base,
          name: names,
          code: codes,
          //if_us: if_us,
          if_zhishu: if_zhishu,
          sok: item.type ? item.type : this.filterSH(item.stock_type),
          type: item.stock_type
        }
      });
    },
    //进入详情
    handleGoToKlineDetail(item) {
      if (this.userData.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      var codes = "";
      var names = "";
      var gid = "";
      var stock_type = "";
      var soks = "";
      var if_zhishu = '0';
      var if_qh = '0';
      if(this.tabsIndex==2){
        codes = item.futuresCode;
        names = item.futuresName;
        gid = item.futuresGid;
        stock_type = 'us'
        if_qh = '1';
      }else{
        switch (this.tabsItemIndex) {
          case 0:
            codes = item.code;
            names = item.name;
            gid = item.gid;
            stock_type = item.stock_type;
            //soks = item.type;
            if_zhishu = '1';
            if_qh = '0';
            //if_us = '2';
            break;
          case 1:
            this.sgCode = item.code;
            this.xinguprice = item.price;
            this.sgsj = item.subscribeTime;
            this.rjsj = item.subscriptionTime;
            this.orderNumber = item.orderNumber;
            this.minTotal = item.minTotal;
            //this.sgNum = Math.floor(this.$store.state.userInfo.enableAmt / this.xinguprice)
            this.settingDialog = true;
            return;
            codes = item.futuresGid;
            names = item.futuresName;
            soks = 0;
            stock_type = 'qh';
            if_qh = '0';
            if_zhishu = item.indexGid;
            break;


          // case 0:
          //   codes = item.code;
          //   names = item.name;
          //   gid = item.gid;
          //   //stock_type = item.stock_type == 'us' ? item.stock_type + 'a' : item.stock_type;
          //   stock_type = item.stock_type;
          //   //soks = item.type ? item.type : this.filterSH(item.stock_type);
          //   if_zhishu = '1';
          //   if_qh = '0';
          //   //if_us = item.stock_type == 'us' ? '1' : '';
          //   break;
          // case 1:
          //   codes = item.code;
          //   names = item.name;
          //   stock_type = item.stock_type;
          //   gid = item.gid;
          //   if_zhishu = '0';
          //   if_qh = '0';
          //   //soks = item.type ? item.type : 0;
          //   break;
          // case 2:
          //   codes = item.code;
          //   names = item.name;
          //   gid = item.gid;
          //   stock_type = item.stock_type;
          //   //soks = this.filterSH(item.stock_type);
          //   if_zhishu = '1';
          //   if_qh = '0';
          //   break;
          // case 3:
          //   codes = item.code;
          //   names = item.name;
          //   gid = item.gid;
          //   stock_type = item.stock_type;
          //   //if_us = '1';
          //   //soks = item.type;
          //   if_zhishu = '1';
          //   if_qh = '0';
          //   break;
          // case 4:
          //   codes = item.code;
          //   names = item.name;
          //   gid = item.gid;
          //   stock_type = item.stock_type;
          //   //soks = item.type;
          //   if_zhishu = '1';
          //   if_qh = '0';
          //   //if_us = '2';
          //   break;
          // case 5:
          //   codes = item.code;
          //   names = item.name;
          //   gid = item.gid;
          //   stock_type = item.stock_type;
          //   //soks = item.type;
          //   if_zhishu = '1';
          //   if_qh = '0';
          //   //if_us = '2';
          //   break;
          // case 6:
          //   this.sgCode = item.code;
          //   this.xinguprice = item.price;
          //   this.sgsj = item.subscribeTime;
          //   this.rjsj = item.subscriptionTime;
          //   this.orderNumber = item.orderNumber;
          //   this.minTotal = item.minTotal;
          //   //this.sgNum = Math.floor(this.$store.state.userInfo.enableAmt / this.xinguprice)
          //   this.settingDialog = true;
          //   return;
          //   codes = item.futuresGid;
          //   names = item.futuresName;
          //   soks = 0;
          //   stock_type = 'qh';
          //   if_qh = '0';
          //   if_zhishu = item.indexGid;
          //   break;
          default:
            break;
        }

      }

      this.$router.push({
        path: "/kline",
        query: {
          name: names,
          stockplate: item.stock_plate,
          code: codes,
          type: stock_type,
          pid: item.data_base,
          gid: gid,
          sok: soks,
          //if_us: if_us,
          usType: item.type,
          if_zhishu: if_zhishu,
          if_qh:if_qh,
        }
      });
    },
    filterSH(val) {
      if (val === "sh") {
        return 1;
      } else if (val === "bj" || val === "sz") {
        return 0;
      }
    },


    async getFuturesList() {
      // 获取期货列表
      let opt = {
        homeShow: 1,
        pageNum: this.pageNum,
        pageSize: 20
      };

      let data = await api.getListFutures(opt);
      console.log(data,99)
      this.loading = false;
      if (data.data.length < 20) {
        this.finished = true;
      }
      if (data.status === 0) {
        data.data.forEach(element => {
          this.qhList.push(element);
        });

      } else {
        this.texts = data.msg;
        this.alertShow = true;
      }
    },
    async getMyList() {
      this.loadings = true;
      //获取自选列表
      let opt = {
        pageNum: this.pageNums,
        pageSize: 20,
        keyWords: this.gpcodes
      };
      let data = await api.getMyList(opt);
      this.loadings = false;
      if (data.status == 0) {
        data.data.list.forEach(element => {
          this.listArrs.push(element);
        });
      }
      if (data.data.list.length < 20) {
        this.finisheds = true;
      }
    },
    handleTabsClick(item, index) {
      if (this.userData.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      if (index == 0) {
        if (this.dialogFlag) {
          this.$refs["topTitle"].style.height = "1.2821rem";
          setTimeout(() => {
            this.dialogFlag = false;

            this.listArrs = [];
            this.pageNums = 1;
            this.finisheds = false;
            this.tabsIndex = index;
            this.getMyList();
          }, 800);
        } else {
          this.listArrs = [];
          this.pageNums = 1;
          this.finisheds = false;
          this.tabsIndex = index;
          this.getMyList();
        }
      } else {
        this.tabsIndex = index;
      }
    },
    handleTabsItem(item, index) {
      this.tabsItemIndex = index;
      this.pageNum = 1;
      this.pageNumNew = 1;
      this.finished = false;
      this.loading = true;
      this.finished2 = false;
      this.loading2 = true;
      switch (item.type) {
        case 0:
          this.stockPlate = "";
          this.stockType = 'in';
          this.listArr = [];
          this.getStock();
        case 1:
          this.listArr5 = [];
          this.getFutures();
          break;


        // case 0:
        //   this.stockPlate = "";
        //   this.listArr = [];
        //   this.stockType = 'us';
        //   this.getStock();
        //   break;
        // case 1:
        //   this.stockPlate = "";
        //   this.stockType = 'hk';
        //   this.listArr = [];
        //   this.getStock();
        //   break;
        // case 2:
        //   this.stockPlate = "";
        //   this.stockType = 'my';
        //   this.listArr = [];
        //   this.getStock();
        //   break;
        // case 3:
        //   this.stockPlate = "";
        //   this.stockType = 'th';
        //   this.listArr = [];
        //   this.getStock();
        //   break;
        // case 4:
        //   this.stockPlate = "";
        //   this.stockType = 'in';
        //   this.listArr = [];
        //   this.getStock();
        //   break;
        // case 5:
        //   this.stockPlate = "";
        //   this.stockType = 'vn';
        //   this.listArr = [];
        //   this.getStock();
        //   break;
        // case 6:
        //   this.listArr5 = [];
        //   this.getFutures();
        //   break;
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async options(val) {

      var codes = val.code;
      if (val.isOption == "1") {
        let data = await api.delOption({ code: codes });
        if (data.status === 0) {
          switch (this.tabsItemIndex) {
            case 0:
              this.stockPlate = "";
              this.stockType = 'in';
              this.pageNum = 1;
              this.loading = true;
              this.listArr = [];
              this.finished = false;
              this.getStock();
              break;
            case 1:
              this.stockPlate = "";
              this.stockType = 'vn';
              this.pageNumNew = 1;
              this.loading2 = true;
              this.listArr5 = [];
              this.finished2 = false;
              this.getStock();
              break;
            // case 1:
            //   this.stockPlate = "";
            //   this.pageNum = 1;
            //   this.stockType = 'hk';
            //   this.listArr = [];
            //   this.loading = true;
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 0:
            //   this.stockPlate = "";
            //   this.pageNum = 1;
            //   this.stockType = 'us';
            //   this.loading = true;
            //   this.listArr = [];
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 2:
            //   this.stockPlate = "";
            //   this.pageNum = 1;
            //   this.stockType = 'my';
            //   this.loading = true;
            //   this.listArr = [];
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 3:
            //   this.stockPlate = "";
            //   this.stockType = 'th';
            //   this.pageNum = 1;
            //   this.loading = true;
            //   this.listArr = [];
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 4:
            //   this.stockPlate = "";
            //   this.stockType = 'in';
            //   this.pageNum = 1;
            //   this.loading = true;
            //   this.listArr = [];
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 5:
            //   this.listArr = [];
            //   this.loading = true;
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.getFutures();
            //   break;
            // case 6:
            //   this.stockPlate = "";
            //   this.stockType = 'vn';
            //   this.pageNum = 1;
            //   this.loading = true;
            //   this.listArr5 = [];
            //   this.finished = false;
            //   this.getStock();
            //   break;
          }
          this.refreshList();
        } else {
          console.log(data.msg);
        }
      } else {
        let data = await api.addOption({ code: codes });
        if (data.status === 0) {
          switch (this.tabsItemIndex) {
            case 0:
              this.stockPlate = "";
              this.stockType = 'in';
              this.pageNum = 1;
              this.finished = false;
              this.listArr = [];
              this.getStock();
              break;
            case 1:
              this.listArr5 = [];
              this.pageNumNew = 1;
              this.finished2 = false;
              this.getFutures();
              break;
            // case 1:
            //   this.stockPlate = "";
            //   this.stockType = 'hk';
            //   this.listArr = [];
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.getStock();
            //   break;
            // case 0:
            //   this.stockPlate = "";
            //   this.stockType = 'us';
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.listArr = [];
            //   this.getStock();
            //   break;
            // case 2:
            //   this.stockPlate = "";
            //   this.stockType = 'my';
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.listArr = [];
            //   this.getStock();
            //   break;
            // case 3:
            //   this.stockPlate = "";
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.stockType = 'th';
            //   this.listArr = [];
            //   this.getStock();
            //   break;
            // case 4:
            //   this.stockPlate = "";
            //   this.stockType = 'in';
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.listArr = [];
            //   this.getStock();
            //   break;
            // case 5:
            //   this.stockPlate = "";
            //   this.stockType = 'vn';
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.listArr = [];
            //   this.getStock();
            //   break;
            // case 6:
            //   this.listArr5 = [];
            //   this.pageNum = 1;
            //   this.finished = false;
            //   this.getFutures();
            //   break;
          }
        } else {
          console.log(data.msg);
        }
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async optionszx(val) {
      let data = await api.delOption({ code: val.stockGid });
      if (data.status === 0) {
        this.listArrs = [];
        this.pageNums = 1;
        this.finisheds = false;
        this.getMyList();
      } else {
        console.log(data.msg);
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    // async refreshList() {
    //   // 刷新指数
    //   if (this.loading) {
    //     return;
    //   }
    //   let opt = {
    //     pageNum: 1,
    //     pageSize: this.currentNum
    //   };
    //   let data = await api.getListMarket(opt);
    //   this.list = data.data;
    // },
    handleCollectionClick(item) {
      item.collection = !item.collection;
    },
    openDialog() {
      if (this.userData.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      if (!this.dialogFlag) {
        this.$refs["topTitle"].style.height = "6.9rem";
      } else {
        this.$refs["topTitle"].style.height = "1.2821rem";
      }
      this.dialogFlag = !this.dialogFlag;
    }
  },
  filters: {
    getName(name) {
      if (name.length > 15) {
        return name.substring(0, 14);
      } else {
        return name;
      }
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
      return h + ":" + m + ":" + c;
    },
    getTimeYear(time) {
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
      return y + '-' + mm + '-' + d + ' ' + h + ":" + m + ":" + c;
    }
  }
};
</script>

<style scoped lang="less">
.tr_list_page {
  width: 100%;
  height: calc(100% - 1.3rem);

  >.content {
    width: 100%;
    height: 100%;
  }
}

.tabs {
  width: 100%;
  height: 100%;
  position: relative;

  .search {
    width: 100%;
    height: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 0.3rem;
    position: relative;

    .search_content {
      width: 100%;
      height: 90%;
      display: flex;
      align-items: center;
    }

    .left_search {
      width: 100%;
      height: 100%;
      background: #f6f6f6;
      border-radius: 0.15rem;
      display: flex;

      .search_img {
        width: 1rem;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        img {
          width: 0.5rem;
          height: 0.5rem;
        }
      }

      .search_input {
        width: 100%;
        overflow: hidden;
        height: 100%;
        display: flex;
      }
    }

    .right_search_class {
      width: 13%;
      height: 100%;
      display: flex;
      justify-content: flex-end;
      align-items: center;

      img {
        width: 0.6rem;
        height: 0.6rem;
      }
    }
  }
}

.top_title {
  width: 100%;
  height: 1.2821rem;
  padding: 0 0.3rem;
  position: fixed;
  top: 0;
  z-index: 2000;
  transition: all 0.5s;
  overflow: hidden;
  border-radius: 0 0 0.2rem 0.2rem;
  background: #202020;

  >div {
    width: 100%;
    height: 1.2821rem;
    display: flex;
    // align-items: center;
    justify-content: space-between;
  }

  .tabs_title {
    // width: 26%;
    height: 100%;
    display: flex;
    color: #fff;
  }

  .tb {
    // width: 50%;
    padding: 0 0.2rem;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.4103rem;
  }

  .active {
    font-size: 0.5003rem;
    font-weight: 800;
  }
}

.bottom_content {
  width: 100%;
  height: calc(100% - 1.2821rem);
  position: relative;
  top: 7%;
}

.scroll_tab {
  width: 100%;
  height: 1rem;
  overflow-x: scroll;
  -webkit-overflow-scrolling: touch;
  display: -webkit-box;
  white-space: nowrap;

  >div {
    display: inline-block;
    // width: 15%;
    height: 100%;
    display: flex;
    font-size: 0.4rem;
    align-items: center;
    padding: 0 0.3rem;

    span {
      display: inline-block;
      min-width: 40%;
      height: 100%;
      text-align: center;
      line-height: 1.1538rem;
    }
  }

  span.active {
    color: rgb(2, 99, 226);
    border-bottom: 0.07rem solid rgb(2, 99, 226);
    font-weight: 800;
    transition: all 0.5s;
  }
}

.scroll_tab::-webkit-scrollbar {
  display: none;
}

.kai_mess {
  width: 100%;
  height: 1.2821rem;
  background: #f5f9fe;
  display: flex;
  justify-content: space-between;
  position: absolute;

  .left_identity_img {
    width: 0.9744rem;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 0.2rem;

    img {
      width: 0.6rem;
      height: 0.6rem;
    }
  }

  .text {
    width: 80%;
    height: 100%;
    display: flex;
    align-items: center;
    color: rgb(2, 99, 226);
    font-weight: 800;
    font-size: 0.35rem;
    padding-left: 0.35rem;
  }

  .right_go {
    width: 10%;
    display: flex;
    align-items: center;
    justify-content: center;

    img {
      width: 0.6rem;
      height: 0.6rem;
    }
  }
}

.list::-webkit-scrollbar {
  display: none;
}

.list {
  width: 100%;
  overflow-x: auto;
  padding-bottom: 1.2821rem;
  padding: 0 0.3rem;

  .list_items {
    margin-top: -0.5rem;
    width: 100%;

    >div {
      width: 100%;
      height: 1.0256rem;
      display: flex;
      margin: 0.5rem 0;

      >div {
        width: 100%;
        height: 1.0256rem;
        display: flex;

        >div {
          >div {
            display: flex;
            align-items: center;
          }

          .tp {
            width: 100%;
            height: 70%;
          }

          .bt {
            width: 100%;
            height: 30%;
            color: #fff;
          }
        }
      }
    }

    .left_title {
      width: 55%;
      height: 100%;
      color: #fff;
    }

    .center_price {
      width: 25%;
      height: 100%;
    }

    .right_bs {
      width: 20%;
      height: 100%;
    }
  }
}

.list_title {
  width: 100%;
  height: 1rem;
  margin-top: 0.29rem;
  padding: 0 0.3rem;
  color: #a1a2a4;
  display: flex;

  >div {
    display: flex;
    align-items: center;
  }

  .varieties {
    width: 45%;
  }

  .latest_price {
    width: 35%;
  }

  .applies {
    width: 20%;
    justify-content: flex-end;
  }
}

.price_color {
  //color: rgb(39, 171, 99);
  font-size: 0.4rem;
  font-weight: 600;
  color: #fff;
}

.title_color {
  color: rgb(2, 2, 2);
  font-size: 0.4rem;
  color: #fff;
  overflow: hidden;
  font-weight: bold;
}

.tab_items {
  font-size: 0.2rem;
  color: #fff;
}

.tab_class {
  padding: 0 0.3rem;
}

.searchs::placeholder {
  color: #8e8f92;
}

.searchs {
  width: 100%;
}

.collection {
  display: inline-block;
  width: 0.1rem;
  height: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 0.1rem;

  .shu {
    width: 60%;
    height: 100%;
    background: #919191;
  }
}

.right_money {
  width: 44%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-end;

  .content_money {
    // width: 80%;
    height: 80%;
  }

  .top_price {
    width: 100%;
    height: 70%;
    display: flex;
    align-items: center;

    .left {
      // width: 0.8rem;
      height: 0.4103rem;
      border-radius: 0.1rem;
      background: #4d73b1;
      color: #fff;
      font-size: 0.3077rem;
      display: flex;
      align-items: center;
      justify-content: center;

      span {
        display: inline-block;
        transform: scale(0.8);
        font-weight: 600;
      }
    }

    .right {
      width: auto;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      white-space: nowrap;
      margin-left: 0.1rem;
      margin-right: 0.1rem;
      min-width: 1.9rem;
      color:#fff;

      // padding-left: 0.2rem;
      span {
        font-weight: 600;
        text-align: right;
      }
    }
  }

  .bottom_balance {
    width: 100%;
    height: 30%;
    display: flex;
    justify-content: flex-end;
    font-size: 0.3077rem;
    color: #acaeaf;
    transform: scale(0.9);
    margin-left: 0.2rem;
    padding-right: 0.68rem;
  }
}

.sanjiao {
  width: 0.4rem;
  height: 0.4rem;
  display: flex;
  align-items: center;
  justify-content: center;

  img {
    width: 0.4rem;
    height: 0.4rem;
  }
}

.dialog {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  top: 7%;
  z-index: 9;
  transition: all 0.5s;
}

.dialog.open {
  top: 7%;
}

.shai {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  top: 0%;
  z-index: 10;
  transition: all 0.5s;
}

.shai.open {
  top: 4%;
}

.cards {
  width: 100%;
  display: flex;
  flex-wrap: wrap;

}

.card_item {
  width: 48%;
  // height: 1.5385rem;
  background: #f6f6f7;
  border-radius: 0.2rem;
  margin-top: 0.2rem;
  padding: 0.4rem 0;

  .tops_title {
    width: 100%;
    // height: 40%;
    display: flex;
    align-items: flex-end;
    padding-left: 0.5rem;
  }

  .bottom_price {
    width: 100%;
    height: 60%;
    display: flex;
    align-items: center;
    padding-left: 0.5rem;
    padding-top: 0.1rem;

    p {
      font-weight: 600;
    }

    span {
      font-weight: 600;
    }
  }
}

.shublue {
  background: #0263e2 !important;
}

.xuanz {
  //旋转
  transform: rotate(180deg);
  transition: all 0.5s;
}

.red {
  color: #ff0000;
}

.green {
  color: #27ab63;
}

.mrt {
  // margin-right: 0.35rem;
}

.codeIcon {
  width: 0.6rem;
  height: 0.6rem;
  background-color: #0263e2;
  color: #fff;

  border-radius: 0.05rem;
  margin-left: 0.1rem;
  //缩放
  transform: scale(0.8);
  display: flex;
  justify-content: center;
  align-items: center;
}

.listHeight {
  height: calc(100% - 1.2821rem - 1rem - 1.1538rem - 1.3333rem);
}

.listHeights {
  height: calc(100% - 1rem - 1.1538rem - 1.3333rem);
}

.zxlist {
  height: calc(100% - 1rem - 1rem);
  padding-bottom: 0.2rem;
}

/deep/.van-list__loading {
  margin-top: 0.2rem;
}

.hongse {

  background-color: #4d73b1 !important;
}

.xgsgType {
  position: relative;
  top: 30%;
  left: 0;
  right: 0;
  margin: auto;
  width: 95%;
  height: 100%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0.1rem;
  background-color: rgba(102, 204, 153, 0.1);
  border: 0.04rem solid #5CE398;
  color: #5CE398;
}

.xgsgTypeRed {
  position: relative;
  top: 30%;
  left: 0;
  right: 0;
  margin: auto;
  width: 95%;
  height: 100%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0.1rem;
  background-color: rgba(223, 59, 59, 0.062);
  border: 0.04rem solid rgb(231, 61, 61);
  color: rgb(231, 61, 61);
}

.setting_content {
  width: 100%;
  height: 5rem;
  padding: 0.3rem;

  .old_password {
    width: 100%;
    height: 1.6rem;
    background: rgb(243, 243, 243);
    border-radius: 0.15rem;
    display: flex;
    margin-top: 0.8rem;

    .left_titles {
      margin-left: 0.2rem;
      width: 25%;
      height: 100%;
      display: flex;
      align-items: center;
      padding-left: 0.2rem;
      font-size: 0.3975rem;

      // justify-content: flex-end;
      span {
        font-weight: 600;
        letter-spacing: 0.04rem;
      }
    }

    .right_password_input {
      width: 75%;
      height: 100%;
      display: flex;
      align-items: center;

      input {
        width: 100%;
        height: 100%;
        padding-left: 0.2rem;
        border-radius: 0 0.2rem 0.2rem 0;
        font-size: 0.3975rem;
        font-weight: 600;
        //文字间距
        letter-spacing: 0.04rem;
      }
    }
  }

  .btn_setting {
    width: 100%;
    height: 1.3rem;
    border-radius: 0.15rem;
    background: #2d6ae9;
    color: #fff;
    font-size: 0.4615rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;

    span {
      font-weight: 600;
    }
  }
}

.shijian {
  width: 100%;
  height: 1.6rem;
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.xgsj {
  font-size: 0.3875rem;
  font-weight: 600;
  display: flex;
  height: 50%;
  align-items: center;

}

.sjtlt {
  width: 25%;
  margin-left: 0.4rem;
}

.xgTime() {
  width: 75%;
}

/deep/.van-popup {
  border-radius: 0.2rem 0.2rem 0 0;
}
</style>
