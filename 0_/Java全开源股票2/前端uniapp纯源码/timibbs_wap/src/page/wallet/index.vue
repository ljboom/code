<template>
  <div class="user_page">
    <div class="content">
      <div class="top_icon">
        <div class="left_back" @click="handleBack()">
          <img src="@/assets/img/zuojiantou.png" alt />
        </div>
        <div class="title" style="width: calc(100% + 2rem);text-align: center;font-size: 0.4rem;">
          {{ $t('hj172') }}/{{ $t('hj177') }}
        </div>
      </div>
      <div class="tabs">
        <div v-for="(item, index) in tabsArr" :key="index" @click="handleTabsClick(item, index)"
          :class="tabsCurrentIndex === index ? 'active' : ''">
          <span>{{ item }}</span>
        </div>
      </div>
      <div class="center_card" v-if="tabsCurrentIndex === 0">
        <div class="yk es">
          <div>
            <span>US</span>
            <span>(USD)</span>
          </div>
          <div>
            <span>HK</span>
            <span>(HKD)</span>
          </div>
          <div>
            <span>MY</span>
            <span>(MYR)</span>
          </div>
        </div>

        <div class="yk as" style="">
          <div>
            <span>{{ userInfo.usUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.hkUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.myUserAmt | formatDecimal }}</span>
          </div>
        </div>

        <div class="yk es">
          <div>
            <span>TH</span>
            <span>(THB)</span>
          </div>
          <div>
            <span>PH</span>
            <span>(PHP)</span>
          </div>
          <div>
            <span>ID</span>
            <span>(IDR)</span>
          </div>
        </div>

        <div class="yk as" style="">
          <div>
            <span>{{ userInfo.thUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.phUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.idUserAmt | formatDecimal }}</span>
          </div>
        </div>

        <div class="yk es">
          <div>
            <span>IN</span>
            <span>(INR)</span>
          </div>
          <div>
            <span>KR</span>
            <span>(KRW)</span>
          </div>
          <div>
            <span>JP</span>
            <span>(JPY)</span>
          </div>
        </div>

        <div class="yk as" style="">
          <div>
            <span>{{ userInfo.inUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.krUserAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>{{ userInfo.jpUserAmt | formatDecimal }}</span>
          </div>
        </div>

        <div class="yk es">
          <div>
            <span>INDEX</span>
            <span>(USD)</span>
          </div>
          <div>
            <span>FUTURE</span>
            <span>(USD)</span>
          </div>
          <div>
            <span></span>
            <span></span>
          </div>
        </div>

        <div class="yk as" style="">
          <div>
            <span>{{ userInfo.userIndexAmt | formatDecimal }}</span>
          </div>
          <div>
            <span>0.000</span>
          </div>
          <div>
            <span></span>
          </div>
        </div>

      </div>
      <div class="withdrawal" v-if="tabsCurrentIndex === 1">
        <div class="keyon">
          <span>{{ $t("hj158") }}</span>
        </div>
        <div>
          <div class="yk es">
            <div>
              <span>US</span>
              <span>(USD)</span>
            </div>
            <div>
              <span>HK</span>
              <span>(HKD)</span>
            </div>
            <div>
              <span>MY</span>
              <span>(MYR)</span>
            </div>
          </div>

          <div class="yk as" style="">
            <div>
              <span>{{ userInfo.usUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.hkUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.myUserAmt | formatDecimal }}</span>
            </div>
          </div>

          <div class="yk es">
            <div>
              <span>TH</span>
              <span>(THB)</span>
            </div>
            <div>
              <span>PH</span>
              <span>(PHP)</span>
            </div>
            <div>
              <span>ID</span>
              <span>(IDR)</span>
            </div>
          </div>

          <div class="yk as" style="">
            <div>
              <span>{{ userInfo.thUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.phUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.idUserAmt | formatDecimal }}</span>
            </div>
          </div>

          <div class="yk es">
            <div>
              <span>IN</span>
              <span>(INR)</span>
            </div>
            <div>
              <span>KR</span>
              <span>(KRW)</span>
            </div>
            <div>
              <span>JP</span>
              <span>(JPY)</span>
            </div>
          </div>

          <div class="yk as" style="">
            <div>
              <span>{{ userInfo.inUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.krUserAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>{{ userInfo.jpUserAmt | formatDecimal }}</span>
            </div>
          </div>

          <div class="yk es">
            <div>
              <span>INDEX</span>
              <span>(USD)</span>
            </div>
            <div>
              <span>FUTURE</span>
              <span>(USD)</span>
            </div>
            <div>
              <span></span>
              <span></span>
            </div>
          </div>

          <div class="yk as" style="">
            <div>
              <span>{{ userInfo.userIndexAmt | formatDecimal }}</span>
            </div>
            <div>
              <span>0.000</span>
            </div>
            <div>
              <span></span>
            </div>
          </div>
        </div>

        <!--        提现账户-->
        <div class="ttx_input" style="margin-top: 1rem;">
          <div class="titles">
            <span>{{ $t("hj288") }}</span>
          </div>
          <div class="num">
            <input type="text" :placeholder="$t('hj286')" v-model="withdrawalAccount" />
          </div>
          <div class="all">
            <van-popover v-model="txShowPopover" trigger="click" placement="top-start" :actions="accountLists"
              :offset="[-180, 10]" @select="onTxSelect">
              <template #reference>
                <span
                  style="background: rgb(45, 106, 233); color: rgb(255, 255, 255); padding: 0.2rem 0.4rem; border-radius: 0.2rem; white-space: nowrap;">{{
                    $t('hj290') }}</span>
              </template>
            </van-popover>
          </div>
        </div>
        <!--收款银行-->
        <div class="ttx_input">
          <div class="titles">
            <span>{{ $t("hj289") }}</span>
          </div>
          <div class="num">
            <input type="text" :placeholder="$t('hj286')" v-model="bankAccount" />
          </div>
          <div class="all">
            <van-popover v-model="bankShowPopover" trigger="click" placement="top-start" :actions="bankList"
              :offset="[-180, 10]" @select="onBankSelect">
              <template #reference>
                <span
                  style="background: rgb(45, 106, 233); color: rgb(255, 255, 255); padding: 0.2rem 0.4rem; border-radius: 0.2rem; white-space: nowrap;">{{
                    $t('hj290') }}</span>
              </template>
            </van-popover>
          </div>
        </div>
        <!--        提现金额-->
        <div class="ttx_input">
          <div class="titles">
            <span>{{ $t("hj159") }}</span>
          </div>
          <div class="num">
            <input type="text" :placeholder="$t('hj291')" v-model="withdrawalValue" @input="handleInput" />
          </div>
          <div class="all">

          </div>
        </div>

        <p style="color: red; font-size: 0.3rem;">* {{ $t("hj324") }}</p>

        <div class="btns" @click="handleToSure()">
          <span>{{ $t("hj161") }}</span>
        </div>

      </div>
      <div class="banks" v-if="tabsCurrentIndex === 1">
        <div class="bank_1">
          <div class="left_name">
            <span>{{ $t("hj162") }}</span>
          </div>
          <div class="center_input"></div>
          <div class="right_copy img_right" @click="handleGoToCashWithdrawalRecord()">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
      </div>
      <div class="banks" v-if="tabsCurrentIndex === 0">
        <div class="bank_1">
          <div class="left_name">
            <span>{{ $t("hj275") }}</span>
          </div>
          <div class="center_input">
            <input :placeholder="$t('hj276')" type="text" v-model="rechargeAccount" readonly />
          </div>
          <div class="right_copy">

            <van-popover v-model="showPopover" trigger="click" placement="top-start" :actions="accountLists"
              :offset="[-180, 10]" @select="onSelect">
              <template #reference>
                <span
                  style="background: rgb(45, 106, 233); color: rgb(255, 255, 255); padding: 0.2rem 0.4rem; border-radius: 0.2rem; white-space: nowrap;">{{
                    $t('hj290') }}</span>
              </template>
            </van-popover>

          </div>
        </div>


        <div class="pay-type" v-show="channelFlag">
          <div class="pay-type-left">
            <span>{{ $t("hj284") }}</span>
          </div>
          <div class="pay-type-right">


            <van-radio-group v-model="accountRadio" v-show="accountRadioFlag">
              <van-cell-group>
                <!--                渲染充值通道-->
                <van-cell v-for="pay in payRadioList" :key="pay.channelType" :title="pay.channelType" clickable
                  @click="accountRadio = pay.channelType">
                  <template #right-icon>
                    <van-radio :name="pay.channelType" />
                  </template>
                </van-cell>

              </van-cell-group>
            </van-radio-group>

            <van-radio-group v-show="noChannelFlag">
              <span style="color: rgb(199, 199, 199);">{{ $t('hj285') }}</span>
            </van-radio-group>

          </div>
        </div>

        <div class="bank_1">
          <div class="left_name">
            <span>{{ $t("hj170") }}</span>
          </div>
          <div class="center_input">
            <input type="text" v-model="walletNum" :placeholder="$t('hj171')" />
          </div>
          <div class="right_copy" @click="handleGoCz()">
            <span
              style="background: #2d6ae9;color: #fff;padding: 0.2rem 0.4rem;border-radius: 0.2rem;white-space: nowrap;">{{
                $t("hj172") }}</span>
          </div>
        </div>
      </div>
      <div class="banks" v-if="tabsCurrentIndex === 0">
        <div class="bank_1" @click="handleGoToTransferRecord()">
          <div class="left_name">
            <span>{{ $t("hj168") }}</span>
          </div>
          <div class="center_input"></div>
          <div class="right_copy img_right">
            <div class="van-badge" style="position: absolute; right: -0.5rem; top: -0.5rem;" v-if="waitCount > 0">{{
              waitCount }}</div>
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
      </div>

      <!-- 等待充值订单 -->
      <div class="recharge-box" v-if="tabsCurrentIndex === 0 && waitCount > 0">
        <span class="recharge-title">等待上傳憑據</span>
        <div style="margin-top: 10px;">
          <div>
            <ul class="table-list" v-infinite-scroll="loadMore" infinite-scroll-disabled="loading"
              infinite-scroll-distance="10">
              <li class="list-body" v-for="(item) in waitList" :key="item.key"
                style="padding: 0.1rem 0.3rem;background-color:#fff">
                <div class="order-info-box" style="background: #fafafa !important;color: #676565;padding: 0;">
                  <div class="order-title" style="border-bottom: none;">

                    <span class="payNumber">{{ $t('hj172') }}
                      <span>{{ findTextByCode(item.payChannel) }}</span>
                      <span :style="{ color: $state.theme == 'red' ? '#BB1815' : '' }">{{
                        item.payAmt
                      }}</span></span>

                    <span v-if="item.payStatus == 0"
                      :class="item.orderStatus == 1 ? 'green pull-right' : item.orderStatus == 2 ? 'red pull-right' : 'red pull-right'">
                      <span
                        style="padding: 0.092593rem;background-color: #1989fa;border-radius: 0.1rem;font-size: 0.296296rem;color: #ffffff;"
                        @click="uploadPayImg(item)">上傳憑證</span>
                    </span>

                  </div>
                  <div class="order-info0">
                    <span class="info-item">{{ $t('hj234') }}:<b>{{ item.orderSn }}</b></span>
                  </div>

                  <div class="order-info0">
                    <span class="info-item">{{ $t('hj80') }}:
                      <b v-if="item.addTime">{{ new Date(item.addTime) | gettime }}</b>
                      <b v-else></b>
                    </span>
                  </div>

                  <div class="order-info" style="border-bottom: 0.018519rem solid #dfe2e6;padding-bottom: 0.3rem;">
                    <span class="info-item">{{ $t('hj391') }}:

                      <b>
                        <van-count-down style="display: inherit; color: var(--c-font-text-c1);"
                          :time="findCurrOrderTime(item.addTime)" @finish="orderTimeFinish" />
                      </b>


                    </span>
                  </div>

                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>


    <van-notify v-model="messShow" type="primary">
      <span>{{ mess }}</span>
    </van-notify>
    <van-popup v-model="messDialog" position="bottom" :style="{ height: '70%' }">
      <div class="mess_content">
        <div class="top_title">
          <div class="tt">
            <div class="left_icon">
              <img src="../../assets/img/liucheng.png" alt />
            </div>
            <div class="right_title">
              <span>{{ $t("hj173") + ":" }}</span>
            </div>
          </div>
          <div class="_on">
            <span>{{ "①" }}</span>
            <span>{{ $t("hj174") }}</span>
          </div>
          <div class="_on">
            <span>{{ "②" }}</span>
            <span>{{ $t("hj175") }}</span>
          </div>
        </div>
        <div class="top_title" style="color: red;">
          <div class="tt">
            <div class="left_icon">
              <img src="../../assets/img/jinggao.png" alt />
            </div>
            <div class="right_title">
              <span>{{ $t("hj173") + ":" }}</span>
            </div>
          </div>
          <div class="_on">
            <span>{{ "①" }}</span>
            <span class="hgg">{{ $t("hj176") }}</span>
          </div>
        </div>
      </div>
    </van-popup>

    <!-- 支付信息 -->
    <van-popup v-model="payPopup" closeable close-icon="close" close-icon-position="top-right" position="bottom"
      @close="handleClose" :style="{ height: '80%' }">

      <div class="pay-upload">

        <p class="pay-upload-title">{{ $t("hj343") }}</p>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj275") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.rechargeAccount">
          </div>
          <div class="right_copy">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj170") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.walletNum">
          </div>
          <div class="right_copy">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj346") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="orderNo">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="orderNo" v-clipboard:success="onCopy" v-clipboard:error="onError">{{ $t("hj164")
            }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj317") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankUser">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankUser" v-clipboard:success="onCopy" v-clipboard:error="onError">{{
              $t("hj164") }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj213") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankName">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankName" v-clipboard:success="onCopy" v-clipboard:error="onError">{{
              $t("hj164") }}</span>
          </div>
        </div>


        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj214") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankBranch">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankBranch" v-clipboard:success="onCopy"
              v-clipboard:error="onError">{{ $t("hj164") }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj167") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankAccount">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankAccount" v-clipboard:success="onCopy"
              v-clipboard:error="onError">{{ $t("hj164") }}</span>
          </div>
        </div>

      </div>

      <div class="upload-box clearfix">
        <div class="upload-btn">
          <el-upload class="avatar-uploader" :action="uploadUrl" list-type="picture-card" :show-file-list="false"
            name="upload_file" :on-success="handleAvatarSuccess" :headers="uploadHeaders"
            :before-upload="beforeAvatarUpload">
            <img v-if="imageUrl" :src="imageUrl" class="id-img avatar">
            <i v-else class="iconfont icon-zhaopian"></i>
            <div class="btn-title" v-if="!imageUrl">{{ $t("hj308") }}</div>

          </el-upload>

        </div>
      </div>

      <button class="submit-btn van-button van-button--primary van-button--normal" @click="submitOrder">
        <div class="van-button__content">
          <span class="van-button__text">{{ $t("hj344") }}</span>
        </div>
      </button>

      <p style="color: red; margin-bottom: 2.5rem; margin-left: 10%; margin-top: 0.5rem;">{{ $t("hj345") }}</p>

    </van-popup>


    <!-- 超时信息的 支付信息 -->
    <van-popup v-model="waitPayPopup" closeable close-icon="close" close-icon-position="top-right" position="bottom"
      :style="{ height: '80%' }">

      <div class="pay-upload">

        <p class="pay-upload-title">{{ $t("hj343") }}</p>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj275") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.rechargeAccount">
          </div>
          <div class="right_copy">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj170") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.orderInfo.payAmt">
          </div>
          <div class="right_copy">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj346") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.orderNo">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="orderNo" v-clipboard:success="onCopy" v-clipboard:error="onError">{{ $t("hj164")
            }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj317") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankUser">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankUser" v-clipboard:success="onCopy" v-clipboard:error="onError">{{
              $t("hj164") }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj213") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankName">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankName" v-clipboard:success="onCopy" v-clipboard:error="onError">{{
              $t("hj164") }}</span>
          </div>
        </div>


        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj214") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankBranch">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankBranch" v-clipboard:success="onCopy"
              v-clipboard:error="onError">{{ $t("hj164") }}</span>
          </div>
        </div>

        <div class="pay-upload_1">
          <div class="left_name">
            <span>
              {{ $t("hj167") }}
            </span>
          </div>
          <div class="center_input">
            <input type="text" readonly="readonly" :value="this.currPayInfo.bankAccount">
          </div>
          <div class="right_copy">
            <span v-clipboard:copy="this.currPayInfo.bankAccount" v-clipboard:success="onCopy"
              v-clipboard:error="onError">{{ $t("hj164") }}</span>
          </div>
        </div>

      </div>

      <div class="upload-box clearfix">
        <div class="upload-btn">
          <el-upload class="avatar-uploader" :action="uploadUrl" list-type="picture-card" :show-file-list="false"
            name="upload_file" :on-success="handleAvatarSuccess" :headers="uploadHeaders"
            :before-upload="beforeAvatarUpload">
            <img v-if="imageUrl" :src="imageUrl" class="id-img avatar">
            <i v-else class="iconfont icon-zhaopian"></i>
            <div class="btn-title" v-if="!imageUrl">{{ $t("hj308") }}</div>

          </el-upload>

        </div>
      </div>

      <button class="submit-btn van-button van-button--primary van-button--normal" @click="submitOrder">
        <div class="van-button__content">
          <span class="van-button__text">{{ $t("hj344") }}</span>
        </div>
      </button>

      <p style="color: red; margin-bottom: 2.5rem; margin-left: 10%; margin-top: 0.5rem;">{{ $t("hj345") }}</p>

    </van-popup>

  </div>
</template>

<script>
import * as api from "@/axios/api";
import { Toast } from "mint-ui";
import { mapState } from "vuex";
import axios from 'axios'

export default {
  name: "newUser",
  data() {
    return {
      waitPayPopup: false,
      orderInfo: {},
      waitList: [],
      waitCount: 0,
      name: "大狗子",
      uploadUrl: '',
      imageUrl: "",
      uploadHeaders: {
        usertoken: window.localStorage.getItem("USERTOKEN"),
      },
      payPopup: false,
      noChannelFlag: false,
      accountRadioFlag: true,
      accountRadio: "",
      selectUserFlag: true,
      orderNo: '',
      // tabsArr: [this.$t('hj172'), this.$t('hj177')],
      tabsCurrentIndex: 0,
      rechargeAccount: "",
      channelFlag: false,
      walletNum: "",
      skName: "",
      skBankName: "",
      skUser: "",
      messShow: false,
      mess: "",
      messDialog: false,
      withdrawalValue: 0,
      withdrawalAccount: "",
      withdrawalType: "",
      bankAccount: "",
      bankAccountInfo: [],
      settingInfo: {},
      onlineService: "",
      showPopover: false,
      txShowPopover: false,
      bankShowPopover: false,
      rechargeType: '',
      bankList: [],
      payInfo: [],
      payRadioList: [],
      currPayInfo: [],//当前选中账户
      accountLists: [
        {
          text: this.$t('hj277'),
          code: "USD"
        },
        {
          text: this.$t('hj278'),
          code: "HKD"
        },
        {
          text: this.$t('hj279'),
          code: "MYR"
        },
        {
          text: this.$t('hj280'),
          code: "THB"
        },
        {
          text: this.$t('hj283'),
          code: "INR"
        }
      ]
    };
  },
  computed: {
    ...mapState(["userInfo", "bankInfo"]),
    tabsArr() {
      return [this.$t("hj172"), this.$t("hj177")];
    }
  },
  created() {
    this.uploadUrl = axios.defaults.baseURL + "/user/upload.do"
    this.getCardDetail(); // 获取银行卡信息
    this.getUserInfo();
    this.getInfoSite();
    this.getPayInfos();

    //加载超时订单
    this.waitUploadCertOrder();
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

      return d + '-' + mm + '-' + y + ' ' + h + ":" + m + ":" + c;
    }
  },
  mounted() {
    //隐藏底部导航
    this.$route.meta.show = true
  },
  methods: {
    uploadPayImg(obj) {
      //根据选中账户获取账户信息 渲染
      var infoPay = this.findCodePayInfo(obj.payChannel);
      if (infoPay.length > 0) {
        this.currPayInfo = infoPay[0]
      } else {
        this.messShow = true;
        this.mess = this.$t("hj335");
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
        return false;
      }
      //订单信息
      this.orderNo = obj.orderSn;
      this.rechargeAccount = this.findTextByCode(obj.payChannel);

      //打开弹出
      this.orderInfo = obj;

      this.waitPayPopup = true;
    },
    orderTimeFinish() {
      //倒计时结束重新刷新列表
      this.waitUploadCertOrder();
    },
    findCurrOrderTime(date) {
      // 获取当前时间和指定时间的时间戳
      var now = new Date();
      var target = new Date(date);
      // 计算两个时间戳之差，单位为毫秒
      var diff = now - target;
      return 1800000 - diff;
    },
    async waitUploadCertOrder() {

      let opts = {
      };
      let data = await api.waitUploadCertOrder(opts);
      if (data.status === 0) {
        this.waitList = data.data;
        this.waitCount = this.waitList.length
        //写入缓存
        window.localStorage.setItem("waitCount", this.waitCount);
        // this.payPopup = false;
        // this.imageUrl = "";
      } else {
        Toast(this.$t("hj310"));
      }

    },
    async loadMore() {
      if (this.waitList.length < 10 || this.total <= this.pageNum * this.pageNum) {
        return
      }
      this.loading = true
      // 加载下一页
      this.pageNum++
      await this.waitUploadCertOrder()
      this.loading = false
    },
    findTextByCode(code) {
      const matchedAccount = this.accountLists.find(account => account.code === code);
      return matchedAccount ? matchedAccount.text : "";
    },
    handleClose() {
      //刷新超时订单列表
      // this.waitUploadCertOrder();
      //弹窗关闭自动提交
      if (this.imageUrl != "") {
        this.submitOrder();
      }
    },
    async submitOrder() {
      //提交订单
      if (this.imageUrl === "" || this.imageUrl === undefined) {
        this.$message.error(this.$t('hj308'));
        return false;
      }
      //更新凭证
      let opts = {
        image: this.imageUrl,
        orderNo: this.orderNo
      };
      let data = await api.updateOrder(opts);
      if (data.status === 0) {
        this.payPopup = false;
        this.waitPayPopup = false;

        //刷新超时订单列表
        this.waitUploadCertOrder();

        this.imageUrl = "";
        Toast(this.$t("hj309"));
      } else {
        Toast(this.$t("hj310"));
      }

    },
    handleAvatarSuccess(res, file) {
      this.imageUrl = res.data.url;
      console.log("支付凭证上传成功:" + this.imageUrl);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isPNG = file.type === "image/png";
      const isGIF = file.type === "image/gif";
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isJPG && !isPNG && !isGIF) {
        this.$message.error(this.$t("hj306"));
      }
      if (!isLt2M) {
        this.$message.error(
          this.$t("hj307", { size: 2 })
        );
      }
      //this.imageUrl = URL.createObjectURL(file);
      return (isJPG || isPNG || isGIF) && isLt2M;
    },
    handleInput() {
      // 使用正则表达式验证输入值是否为整数
      this.withdrawalValue = this.withdrawalValue.replace(/\D/g, '');
    },
    async getPayInfos() {
      // 获取支付渠道 详细信息
      let data = await api.getPayInfo();
      if (data.status === 0) {
        this.payInfo = data.data;
      } else {
        Toast(data.msg);
      }
    },
    onBankSelect(e) {
      //收款银行选择
      this.bankAccount = e.text;
      this.bankAccountInfo = e;
      console.log(e)
    },
    onTxSelect(e) {
      this.withdrawalType = e.code;
      this.withdrawalAccount = e.text;

      //根据选择的账户 初始化收款银行
      var bankInfo = this.findByCodeBank(e.code);
      if (bankInfo != undefined) {
        this.bankList[0] = bankInfo;
        this.bankList[0]['text'] = bankInfo.bankNo;
      } else {
        Toast(this.$t("hj179"));
      }

    },
    findByCodeBank(code) {
      if (this.$store.state.bankInfo.marketType === code) {
        return this.$store.state.bankInfo;
      } else {
        this.bankAccount = '';
        this.bankList = [];
        return undefined
      }
    },
    onSelect(e) {
      this.rechargeType = e.code;
      this.rechargeAccount = e.text;
      //显示充值方式
      this.channelFlag = true;
      //end

      //获取对应通道
      var payObj = this.findCodePayInfo(e.code);
      //渲染通道
      if (payObj.length === 0) {
        this.noChannelFlag = true;
        this.accountRadioFlag = false;
      } else {
        this.noChannelFlag = false;
        this.accountRadioFlag = true;
        this.payRadioList = payObj;
      }

    },
    findCodePayInfo(code) {
      // 根据充值账户返回充值通道
      return this.payInfo.filter(obj => obj.channelType === code);
    },
    goOnline() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push("/service");
    },
    async getInfoSite() {
      let data = await api.getInfoSite();
      if (data.status === 0) {
        this.onlineService = data.data.onlineService;
      } else {
        Toast(data.msg);
      }
    },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // 判断是否登录
        this.$store.commit("dialogVisible", false);
        this.$store.state.userInfo = data.data;
      } else {
        this.$store.commit("dialogVisible", true);
      }
    },
    handleZh() {
      //cho
      this.selectUserFlag = !this.selectUserFlag;
    },
    handleBack() {
      // 点击返回/
      this.$router.go(-1);
    },
    goToTopUp() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push("/wallet");
    },
    handleTabsClick(item, index) {
      this.tabsCurrentIndex = index;
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    withdrawalAll() {
      // 点击全部提现
      this.withdrawalValue = this.userInfo.enableAmt;
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async handleToSure() {
      // 点击确定提现
      if (!this.userInfo.idCard) {
        Toast(this.$t("hj178"));
        return;
      }
      if (!this.bankInfo.bankNo) {
        Toast(this.$t("hj179"));
        return;
      }

      //未选择银行卡
      if (this.bankAccountInfo.length == 0 || this.bankAccountInfo == []) {
        Toast(this.$t("hj179"));
        return;
      }

      if (!this.withdrawalValue || this.withdrawalValue <= 0) {
        Toast(this.$t("hj180"));
      } else if (this.withdrawalValue - this.settingInfo.withMinAmt < 0) {
        Toast(this.$t("hj181") + this.settingInfo.withMinAmt);
      } else {
        let opts = {
          amt: this.withdrawalValue,
          accountType: this.bankAccountInfo.marketType,
        };
        let data = await api.outMoney(opts);
        if (data.status === 0) {
          // 成功
          Toast(this.$t("hj182"));
          this.$router.push("/cashlist");
        } else {
          Toast(data.msg ? data.msg : this.$t("hj183"));
        }
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async getCardDetail() {
      // 获取银行卡信息
      let data = await api.getBankCard();
      if (data.status === 0) {
        this.$store.state.bankInfo = data.data;

        //end
        // this.skName = data.data.bankName
        // this.skBankName = data.data.bankAddress
        // this.skUser = data.data.bankNo
      } else {
        // Toast(data.msg)
      }
    },
    async getSettingInfo() {
      let data = await api.getSetting();
      if (data.status === 0) {
        // 成功
        this.settingInfo = data.data;
        console.log(this.settingInfo, "settingInfo");
      } else {
        Toast(data.msg);
      }
    },
    handleGoToTransferRecord() {
      // 充值记录
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push("/transferRecord");
    },
    handleGoToCashWithdrawalRecord() {
      // 提现记录
      this.$router.push("/cashWithdrawalRecord");
    },
    handleGoToTransfers() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push("/transfers");
    },
    handleGoCz() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      //充值事件

      //根据选中账户获取账户信息 渲染
      var infoPay = this.findCodePayInfo(this.accountRadio);
      if (infoPay.length > 0) {
        this.currPayInfo = infoPay[0]
      } else {
        this.messShow = true;
        this.mess = this.$t("hj335");
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
        return false;
      }
      //校验是否符合 最低充值跟最高充值
      if (this.walletNum < this.currPayInfo.channelMinLimit || this.walletNum > this.currPayInfo.channelMaxLimit) {
        this.messShow = true;
        this.mess = this.$t("hj336") + this.currPayInfo.channelMinLimit + "-" + this.currPayInfo.channelMaxLimit;
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
        return false;
      }

      if (this.walletNum === "") {
        this.messShow = true;
        this.mess = this.$t("hj171");
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
      } else if (this.walletNum < 200) {
        this.messShow = true;
        this.mess = this.$t("hj184");
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
      } else if (this.walletNum !== "" && this.walletNum >= 200) {
        this.getPayInfo();
      }
    },
    onCopy() {
      Toast(this.$t("hj185"));
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    onError() {
      Toast(this.$t("hj186"));
    },
    async getPayInfo() {
      this.getrecharge();
      // 获取支付渠道 详细信息
      // let data = await api.getPayInfoDetail({ payId: 3 });
      // if (data.status === 0) {
      //   const { channelName, channelAccount, channelDesc } = data.data;
      //   this.skName = channelName;
      //   this.skUser = channelAccount;
      //   this.skBankName = channelDesc;
      // } else {
      //   this.messShow = true;
      //   this.mess = data.msg;
      //   setTimeout(() => {
      //     this.messShow = false;
      //   }, 1500);
      // }
    },
    async getrecharge() {
      if (!this.walletNum) {
        this.$message.error("请输入充值金额");
        return;
      }
      // this.dialogTableVisible = true;
      let opts = {
        amt: this.walletNum,
        payId: this.currPayInfo.id,
        accountType: this.accountRadio,
      };
      let data = await api.inMoney(opts);
      if (data.status == 0) {
        this.orderNo = data.data;
        this.payPopup = true;
        // this.messDialog = true;

        //订单充值完成，加载待上传凭证列表
        this.waitUploadCertOrder();

      } else {
        this.messShow = true;
        this.mess = data.msg ? data.msg : "充值失败,请重新充值";
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
      }
    }
  }
};
</script>

<style scoped lang="less">
.pay-upload {
  width: 100%;
  background: #fff;
  padding: 0 0.4rem;
  border-radius: 0.3rem;
  margin-top: 0.3rem;

  .pay-upload-title {
    text-align: center;
    line-height: 0.7rem;
  }

  >div {
    width: 100%;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 0.05rem solid #F5F5F5;
    font-size: 0.359rem;

    span {
      font-weight: 600;
    }

    .left_name {
      width: 25%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .center_input {
      width: 60%;
      height: 50%;

      input {
        width: 100%;
        height: 100%;
      }
    }

    .right_copy {
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

  }

  .pay-type {
    width: 100%;
    height: auto;

    .pay-type-left {
      width: 25%;
      text-align: center;
      margin: 0;
    }

    .pay-type-right {
      height: auto;
      width: 75%;
    }
  }
}

.upload-box {
  padding: 0.5rem;

  .upload-btn {
    border-radius: 0.074074rem;
    width: 50%;
    height: 1.6rem;
    float: left;
    margin-left: 25%;
    text-align: center;
    position: relative;

    .btn-hidden {
      height: 100%;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 3;
      opacity: 0;
    }

    .id-img {
      width: 100%;
      height: 100%;
    }

    /deep/ .el-upload--picture-card {
      background: none;
      width: 100%;
      height: 2rem;
      line-height: 2rem;
    }

    .btn-title {
      position: absolute;
      top: 0.611111rem;
      left: 0;
      width: 100%;
    }

    /deep/ .el-upload__input {
      display: none;
    }
  }
}


.user_page {
  width: 100%;
  height: calc(100% - 1.3rem);

  .submit-btn {
    width: 80%;
    margin-left: 10%;
    margin-top: 0.8rem;
    height: 1rem;
    letter-spacing: 0.05rem;
    color: #fff;
    background-color: #1989fa;
    border: 0.018519rem solid #1989fa;
  }

  .content {
    width: 100%;
    height: 100%;
    padding: 0 0.3rem;

    .recharge-box {
      height: auto;
      width: 100%;
      margin-top: 0.5rem;

      span.recharge-title {
        padding-left: 0.25rem;
        font-size: 0.35rem;
      }

    }


    .top_icon {
      width: 100%;
      height: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;

      .left_back {
        width: 10%;
        height: 50%;
        display: flex;
        align-items: center;
        justify-content: center;

        img {
          width: 0.6rem;
          height: 0.6rem;
        }
      }

      .right_icon {
        width: 18%;
        height: 35%;
        padding-right: 0.1rem;
        display: flex;
        justify-content: space-between;

        >div {
          width: auto;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;

          img {
            width: 0.55rem;
            height: 0.55rem;
          }
        }
      }
    }

    .users {
      width: 100%;
      height: 1.7949rem;
      background: #fff;
      border-radius: 0.15rem;
      display: flex;
      align-items: center;
      justify-content: space-between;

      .left_tou {
        width: 80%;
        height: 70%;
        display: flex;

        .left_tx {
          width: 20%;
          height: 100%;
          margin-left: 0.3rem;
          display: flex;
          align-items: center;
          justify-content: center;

          >div {
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            overflow: hidden;
            background: rgb(211, 211, 211);

            img {
              width: 100%;
              height: 100%;
            }
          }
        }

        .right_name {
          width: 80%;
          height: 100%;
          display: flex;
          align-items: center;
          font-size: 0.4415rem;

          span {
            font-weight: 600;
          }
        }
      }

      .right_go {
        width: 20%;
        height: 70%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 0.2rem;

        img {
          width: 0.6rem;
          height: 0.6rem;
        }
      }
    }

    .center_card {
      width: 100%;
      height: 7rem;
      background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);
      // background-image: linear-gradient(to right, #ffffff , #dfedfc);
      border-radius: 0.15rem;
      padding: 0.5rem 0.4rem;

      .keyon {
        width: 100%;
        height: 0.5128rem;
        font-size: 0.359rem;
        display: flex;
        align-items: center;
        color: #3d4144;

        span {
          font-weight: 600;
        }
      }

      .num_price {
        width: 100%;
        height: 0.6667rem;
        margin-top: 0.1rem;
        display: flex;
        align-items: center;
        font-size: 0.5528rem;

        span {
          font-weight: 600;
        }
      }

      .yk {
        width: 100%;
        height: 0.5rem;
        display: flex;
        align-items: center;

        >div {
          width: 50%;
          height: 100%;
          color: #97989d;
          display: flex;
          align-items: center;
        }
      }

      .yk.es {
        margin-top: 0.3rem;
      }

      .yk.as {
        font-size: 0.4033rem;
        margin-top: 0.1rem;

        span {
          color: #000;
          font-weight: 600;
        }

        .bzz {
          color: #4ea364;
        }
      }

      .btns {
        width: 100%;
        height: 1.2821rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.25rem;
        background: #2d6ae9;
        font-size: 0.4015rem;
        color: #fff;
        margin-top: 0.35rem;

        span {
          font-weight: 600;
        }
      }

      .active {
        background: #4ea364;
      }
    }

    .jy {
      width: 100%;
      height: 1.5rem;
      border-radius: 0.2rem;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 0.3rem;
      margin-top: 0.3rem;

      .left_gn {
        width: 40%;
        height: 60%;
        display: flex;

        .l_icon {
          width: 30%;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;

          img {
            width: 0.5041rem;
            height: 0.5041rem;
          }
        }

        .r_title {
          width: 70%;
          height: 100%;
          display: flex;
          align-items: center;
          font-size: 0.4046rem;
          color: #404040;

          span {
            font-weight: 600;
          }
        }
      }

      .right_gos {
        width: 20%;
        height: 60%;
        display: flex;
        align-items: center;
        justify-content: flex-end;

        img {
          width: 0.6rem;
          height: 0.6rem;
        }
      }
    }
  }
}

.tabs {
  width: 100%;
  height: 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;

  >div {
    width: 48%;
    height: 70%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .active {
    background: rgb(255, 255, 255);
    border-radius: 0.15rem;
  }
}

.banks {
  width: 100%;
  background: #fff;
  padding: 0 0.4rem;
  border-radius: 0.3rem;
  margin-top: 0.3rem;

  .pay-type {
    width: 100%;
    height: auto;

    .pay-type-left {
      text-align: center;
      margin: 0;
    }

    .pay-type-right {
      height: auto;
      width: 60%;
    }
  }

  >div {
    width: 100%;
    // height: 1.5385rem;
    // margin-top: 0.3rem;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 0.05rem solid rgb(224, 224, 224);
    font-size: 0.359rem;

    span {
      font-weight: 600;
    }

    .left_name {
      //width: 25%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .center_input {
      width: 42%;
      height: 50%;

      input {
        width: 100%;
        height: 100%;
      }
    }

    .right_copy {
      // width: 15%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;

      .van-badge {
        padding-right: 0.148148rem;
        padding-left: 0.148148rem;
        padding-top: 0.074074rem;
        padding-bottom: 0.074074rem;
        font-size: 0.296296rem;
      }

    }
  }
}

.img_right {
  >img {
    width: 0.55rem;
    height: 0.55rem;
  }
}

.mess_content {
  width: 100%;
  height: 100%;
  padding: 0.5rem 0.3rem;

  .top_title {
    width: 100%;
    height: 2.5rem;

    .tt {
      width: 100%;
      height: 30%;
      display: flex;
      align-items: center;

      .left_icon {
        width: 0.5rem;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        img {
          width: 0.4rem;
          height: 0.4rem;
        }
      }

      .right_title {
        margin-left: 0.2rem;
      }
    }
  }

  ._on {
    width: 100%;
    height: 0.5rem;
    padding: 0 0.3rem;
    margin-top: 0.1rem;
  }

  .hgg {
    line-height: 0.5rem;
  }
}

.withdrawal {
  width: 100%;
  height: auto;
  background: #fff;
  border-radius: 0.15rem;
  padding: 0.5rem 0.4rem;
  background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);


  .yk {
    width: 100%;
    height: 0.5rem;
    display: flex;
    align-items: center;

    >div {
      width: 50%;
      height: 100%;
      color: #97989d;
      display: flex;
      align-items: center;
    }
  }

  .yk.es {
    margin-top: 0.3rem;
  }

  .yk.as {
    font-size: 0.4033rem;
    margin-top: 0.1rem;

    span {
      color: #000;
      font-weight: 600;
    }

    .bzz {
      color: #4ea364;
    }
  }

  .ttx {
    width: 100%;
    height: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.35rem;
  }

  .ttx_price {
    width: 100%;
    height: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2d6ae9;
    font-size: 0.6615rem;

    span {
      font-weight: 600;
    }
  }

  .ttx_input {
    width: 100%;
    height: 1rem;
    display: flex;

    >div {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .titles {
      width: 20%;
      height: 100%;
      font-size: 0.35rem;
    }

    .num {
      width: 70%;
      height: 100%;
      font-size: 0.35rem;

      input {
        width: 100%;
        height: 100%;
        padding-left: 1rem;
        font-weight: 600;
        font-size: 0.35rem;
      }
    }

    .all {
      width: 10%;
      height: 100%;
      font-size: 0.35rem;
    }
  }
}

.btns {
  width: 100%;
  height: 1.2821rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.25rem;
  background: #2d6ae9;
  font-size: 0.4015rem;
  color: #fff;
  margin-top: 0.35rem;

  span {
    font-weight: 600;
  }
}

.bank_1:last-child {
  border: none;
}
</style>

<style>
/*.van-popover[data-popper-placement='bottom'] .van-popover__arrow {*/
/*  left: 85%;*/
/*}*/
.van-popover__action {
  width: 4.5rem !important;
  height: 1rem !important;
}

/*.van-nav-bar {*/
/*  line-height: unset;*/
/*}*/

.van-cell {
  height: 1rem;
  line-height: 0.68rem;
  padding: 0.185185rem 0rem;
}

.van-cell::after {
  content: none;
}

.van-hairline--top-bottom::after,

.van-hairline-unset--top-bottom::after {
  border: none;
}
</style>
