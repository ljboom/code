<template>
  <div class="user_page">
    <div class="content">
      <div class="top_icon">
        <div class="left_back" @click="handleBack()">
          <img src="@/assets/img/back.svg" alt />
        </div>
        <div class="right_icon">
          <!-- <div @click="goOnline()">
            <img src="@/assets/img/kefu.svg" alt />
          </div> -->
          <van-popover v-model="showPopover" trigger="click" placement="bottom-end" :actions="actions"
            @select="onSelect">
            <template #reference>
              <img style="width: 21px;height: 21px;" src="@/assets/img/yuyan.svg" />
            </template>
          </van-popover>
        </div>
      </div>
      <div class="tabs">
        <div v-for="(item, index) in tabsArr" :key="index" @click="handleTabsClick(item, index)"
          :class="tabsCurrentIndex === index ? 'active' : ''">
          <span>{{ item }}</span>
        </div>
      </div>
      <div class="center_card" v-if="tabsCurrentIndex === 0">
        <div class="topcard">
          <div class="lefttop">
            <div class="keyon">
              <span>{{ $t('hj49') }}</span>
            </div>
            <div class="num_price">
              <!-- <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">
                ¥ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
                class="account">
                ¥ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userFuturesAmt).toFixed(2)
                }}
              </p>
              <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
                class="account">¥ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt).toFixed(2) }}</p> -->
              <p class="account">
                $ {{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                    $store.state.userInfo.userIndexAmt + $store.state.userInfo.userFuturesAmt).toFixed(2)
                }}
              </p>
            </div>
          </div>
          <div class="rightcard">$</div>
        </div>

        <!-- <div class="yk es">
          <div>
            <span>{{ $t('hj284') }}</span>
          </div>
          <div>
            <span>{{ $t('hj285') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span>{{ '$ ' + $store.state.userInfo.enableAmt }}</span>
          </div>
          <div>
            <span>{{ 'HK$ ' + $store.state.userInfo.hkEnableAmt }}</span>
          </div>
        </div> -->
        <!-- <div class="yk es">
          <div>
            <span>{{ $t('hj286') }}</span>
          </div>
          <div>
            <span>{{ $t('hj287') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span>{{ 'RM ' + $store.state.userInfo.myEnableAmt }}</span>
          </div>
          <div>
            <span>{{ '฿ ' + $store.state.userInfo.thEnableAmt }}</span>
          </div>
        </div> -->
        <div class="yk es">
          <div>
            <span>{{ $t('hj288') }}</span>
          </div>
          <!-- <div>
            <span>{{ $t('hj290') }}</span>
          </div> -->
          <div>
            <span>{{ $t('hj289') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span>{{ 'Rs ' + $store.state.userInfo.inEnableAmt }}</span>
          </div>
         <!-- <div>
            <span>{{ '₫ ' + $store.state.userInfo.vnEnableAmt }}</span>
          </div> -->
          <div>
            <span>{{ '$ ' + $store.state.userInfo.enableFuturesAmt }}</span>
          </div>
        </div>
        <!-- <div class="yk es">
          <div>
            <span>{{ $t('hj289') }}</span>
          </div>

        </div>
        <div class="yk as">
          <div>
            <span>{{ '$ ' + $store.state.userInfo.enableFuturesAmt }}</span>
          </div>

        </div> -->

        <div class="btns" @click="handleGoToTransfers()">
          <span>{{ $t('hj157') }}</span>
        </div>
      </div>
      <div class="withdrawal" v-if="tabsCurrentIndex === 1">
        <div class="ttxall">
          <div class="leftttx">
            <div class="ttx">
              <span>{{ $t('hj158') }}</span>
            </div>
            <!-- <div class="ttx_price">
              <span>{{ $store.state.userInfo.enableAmt }}</span>
            </div> -->
          </div>
          <div class="rightttx">$</div>
        </div>
        <div class="walletinfo">
          <div class="info-item">
            <div class="info-label">US(USD)</div>
            <div>{{ $store.state.userInfo.enableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">HK(HK$)</div>
            <div>{{ $store.state.userInfo.hkEnableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">MY(MYR)</div>
            <div>{{ $store.state.userInfo.myEnableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">TH(THD)</div>
            <div>{{ $store.state.userInfo.thEnableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">IN(RS)</div>
            <div>{{ $store.state.userInfo.inEnableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">VN(VND)</div>
            <div>{{ $store.state.userInfo.vnEnableAmt }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">FUTURE(USD)</div>
            <div>{{ $store.state.userInfo.enableFuturesAmt }}</div>
          </div>
        </div>
      </div>

      <div class="banks" v-if="tabsCurrentIndex === 1">
        <div class="bank_1">
          <div class="left_name">
            <span>{{ $t('hj320') }}</span>
          </div>
          <div class="retype">
            <!-- <el-select v-model="txType" @change="selectType($event)" :placeholder="$t('hj320')">
              <el-option
                v-for="item in txList"
                :key="item.key"
                :label="item.label"
                :value="item.amount">
              </el-option>
            </el-select> -->

            <select class="set-account" v-model="txType"  @change="selectType($event)">
              <option :label="$t('hj361')" selected></option>
              <option v-for="item in txList" :key="item.key" :label="item.label" :value="item.key">
              {{item.label}}
              </option>
            </select>
          </div>
        </div>

        <div class="bank_1">
          <div class="left_name">
            <span>{{ $t('hj321') }}</span>
          </div>
          <div class="retype">
            <!-- <el-select v-model="bankaccount" @change="selectBank($event)" :placeholder="$t('hj321')">
              <el-option
                v-for="item in bankList"
                :key="item.id"
                :label="item.bankName"
                :value="item.bankNo">
              </el-option>
            </el-select> -->
            <select class="set-account" v-model="bankaccount"  @change="selectBank($event)">
              <option :label="$t('hj360')" selected></option>
              <option
              v-for="item in bankList"
              :key="item.id"
              :label="item.bankName+' '+item.bankNo"
              :value="item.bankNo">
              {{item.bankName}}
              </option>
            </select>
          </div>
        </div>

        <div class="bank_1" style="margin-top: 1px;">
          <div class="left_name">
            <span>{{ $t('hj159') }}</span>
          </div>
          <div class="center_input">
            <input type="text" v-model="withdrawalValue" :placeholder="$t('hj171')" />
          </div>
          <div class="right_copy" @click="withdrawalAll()">
            <span style="color: rgba(19, 210, 160, 1);">{{ $t('hj160') }}</span>
          </div>
        </div>

        <!-- <div class="btns" @click="handleGoToTransfers()">
          <span style="color: #fff;text-align: center;">{{ $t('hj157') }}</span>
        </div> -->
        <div style="background-color: #202020;" class="bank_1">
        <div style="color: #fff;" class="btns" @click="handleToSure()">
          <span>{{ $t('hj161') }}</span>
        </div>
        </div>

        <div style="margin-top: 30px;" class="bank_1">
          <div class="left_name">
            <span>{{ $t('hj162') }}</span>
          </div>
          <div class="center_input"></div>
          <div class="right_copy img_right" @click="handleGoToCashWithdrawalRecord()">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>

      </div>

      <div class="banks" v-if="tabsCurrentIndex === 0">
        <div class="tabs" style="margin-bottom: 30px;">
          <div v-for="(item, index) in tabsTwoArr" :key="index" @click="handleTabsClickTwo(item, index)"
            :class="tabsTwoCurrentIndex === index ? 'active' : ''">
            <span>{{ item }}</span>
          </div>
        </div>



          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span>{{ $t('hj409') }}</span>
            </div>
            <div class="retype">

              <select class="set-account" v-model="walletType"  @change="selectWallet($event)">
                <option :label="$t('hj314')" selected></option>
                <option v-for="item in wallets" :key="item.key" :label="item.label" :value="item.key">
                {{item.label}}
                </option>
              </select>
            </div>
          </div>
          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span>{{ $t('hj319') }}</span>
            </div>
            <div class="retype">
              <select class="set-account" v-model="rechargeType"  @change="selectModel($event)">
                <option :label="$t('hj362')" selected></option>
                <option v-for="item in options" :key="item.id" :label="item.channelName" :value="item.channelAccount">
                {{item.channelName}}
                </option>
              </select>

            </div>
          </div>
          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span v-if="currpaytype==2">{{ $t('hj414') }}</span>
              <span v-else>{{ $t('hj166') }}</span>
            </div>
            <div class="center_input">
              <input type="text" readonly v-model="currBankName" :placeholder="$t('hj166')" />
            </div>
            <div class="right_copy">
              <span v-clipboard:copy="currBankName" v-clipboard:success="onCopy" v-clipboard:error="onError">{{ $t('hj164')
              }}</span>
            </div>
          </div>
          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0 && currpaytype==1">
            <div class="left_name">
              <span>{{ $t('hj411') }}</span>
            </div>
            <div class="center_input">
              <input type="text" readonly v-model="channelDesc" :placeholder="$t('hj411')" />
            </div>
            <div class="right_copy">
              <span v-clipboard:copy="channelDesc" v-clipboard:success="onCopy" v-clipboard:error="onError">{{ $t('hj164')
              }}</span>
            </div>
          </div>


          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span>{{ $t('hj318') }}</span>
            </div>
            <div class="center_input">
              <input type="text" readonly v-model="rechargeType" :placeholder="$t('hj318')" />
            </div>
            <div class="right_copy">
              <span v-clipboard:copy="rechargeType" v-clipboard:success="onCopy" v-clipboard:error="onError">{{ $t('hj164')
              }}</span>
            </div>
          </div>


          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span>{{ $t('hj410') }}</span>
            </div>
            <div class="center_input">
              <el-upload
              :with-credentials="true"
              class="avatar-uploader"
              :action="admin + '/user/upload.do'"
                list-type="picture-card"
                name="upload_file"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :on-error="handleError"
                :before-upload="beforeAvatarUpload"
                :disabled="!showBtn">
                <img v-if="form.img1key" :src="form.img1key" class="id-img avatar" style="width: 100%;height: 100%;"/>
                <i v-else class="iconfont icon-zhaopian"></i>
                <span v-if="!form.img1key && !imgStatus" class="btn-title">{{$t('hj410')}}</span>
                <span v-if="imgStatus" class="btn-title">{{$t('hj410')}}</span>
              </el-upload>
            </div>

          </div>

          <div class="bank_1" v-if="tabsTwoCurrentIndex === 0">
            <div class="left_name">
              <span>{{ $t('hj170') }}</span>
            </div>
            <div class="center_input">
              <input type="text" v-model="walletNum" :placeholder="$t('hj171')" />
            </div>
            <div class="right_copy" @click="handleGoCz()">
              <span style="background: #2d6ae9;color: #fff;padding: 0.2rem 0.4rem;border-radius: 0.2rem;white-space: nowrap;">{{ $t('hj172')
              }}</span>
            </div>
          </div>

          <div class="kefu_1" v-if="tabsTwoCurrentIndex === 1">
            <div class="kefu_img">
              <img src="../../assets/img/rgcz.svg"/>
            </div>
            <div class="kefucz" @click="peopleCz()">
              <button>{{ $t('hj413') }}</button>
            </div>

          </div>

          <div style="margin-top: 30px;" class="bank_1" @click="handleGoToTransferRecord()">
            <div class="left_name">
              <span>{{ $t('hj168') }}</span>
            </div>
            <div class="center_input"></div>
            <div class="right_copy">
              <span>{{ $t('hj169') }}</span>
            </div>
          </div>


    </div>
    <div class="mess_content" v-if="tabsTwoCurrentIndex === 0">
      <div class="top_title" style="color: #fff;">
        <div class="tt">
          <div class="left_icon">
            <img src="../../assets/img/liucheng.png" alt />
          </div>
          <div class="right_title">
            <span>{{ $t('hj173') + ':' }}</span>
          </div>
        </div>
        <div class="_on">
          <span>{{ '①' }}</span>
          <span>{{ $t('hj174') }}</span>
        </div>
        <div class="_on">
          <span>{{ '②' }}</span>
          <span v-if="currpaytype==2">{{ $t('hj415') }}</span>
          <span v-else>{{ $t('hj175') }}</span>
        </div>
      </div>
      <div class="top_title" style="color: red;">
        <div class="tt">
          <div class="left_icon">
            <img src="../../assets/img/jinggao.png" alt />
          </div>
          <div class="right_title">
            <span>{{ $t('hj173') + ':' }}</span>
          </div>
        </div>
        <div class="_on">
          <span>{{ '①' }}</span>
          <span class="hgg">{{ $t('hj176') }}</span>
        </div>
      </div>
    </div>
  </div>
 </div>
</template>

<script>
import * as api from "@/axios/api";
import { Toast } from "mint-ui";
import { mapState } from "vuex";
import { compress } from "@/utils/imgupload";

export default {
  name: "newUser",
  data() {
    return {
      name: "大狗子",
      admin:"https://api.bpeasia.net/dtapi",
      form: {
        img1key: "",
      },
      channelDesc:'',
      currBankName:'',
      img1Key: "",
      imgStatus: false,
      showBtn:true,
      walletType:'',
      selectUserFlag: true,
      // tabsArr: [this.$t('hj172'), this.$t('hj177')],
      tabsCurrentIndex: 0,
      tabsTwoCurrentIndex: 0,
      walletNum: "",
      skName: "",
      skBankName: "",
      skUser: "",
      messShow: false,
      bankaccount:"",
      txType:"",
      mess: "",
      messDialog: false,
      withdrawalValue: 0,
      settingInfo: {},
      onlineService: "",
      showPopover: false,
      rechargeType:'',
      name:'',
      payid:'',
      options: [],
      bankList:[],
      wallets:[
        // {
        //   key: '1',
        //   label: this.$t('hj284'),
        //   amount: 0
        // }, {
        //   key: '2',
        //   label: this.$t('hj285'),
        //   amount: 0
        // }, {
        //   key: '3',
        //   label: this.$t('hj286'),
        //   amount: 0
        // },
        // {
        //   key: '4',
        //   label: this.$t('hj287'),
        //   amount: 0
        // },
        {
          key: '5',
          label: this.$t('hj288'),
          amount: 0
        }
        // , {
        //   key: '6',
        //   label: this.$t('hj290'),
        //   amount: 0
        // }
      ],
      txList: [
      // {
      //   key: '1',
      //   label: this.$t('hj284'),
      //   amount: 0
      // }, {
      //   key: '2',
      //   label: this.$t('hj285'),
      //   amount: 0
      // }, {
      //   key: '3',
      //   label: this.$t('hj286'),
      //   amount: 0
      // }, {
      //   key: '4',
      //   label: this.$t('hj287'),
      //   amount: 0
      // },
      {
        key: '5',
        label: this.$t('hj288'),
        amount: 0
      },
      // {
      //   key: '6',
      //   label: this.$t('hj290'),
      //   amount: 0
      // },
      {
        key: '7',
        label: this.$t('hj289'),
        amount: 0
      }],
      currallamt:0,
      currbankid:'',
      currtxtype:"",
      currpaytype:'',
      actions: [
        // { text: '简体中文', icon: require('@/assets/ico/Chinese.png') , lang: 'zh-CN'},
         //{ text: '繁體中文', icon: require('@/assets/ico/tw.png'), lang: 'tww' },
         { text: 'English', icon: require('@/assets/ico/english.png'), lang: 'en' },
        // { text: 'แบบไทย', icon: require('@/assets/ico/taiguo.jpg'), lang: 'th' }
        { text: 'हिंदी', icon: require('@/assets/ico/yindu.png'), lang: 'in' }
      ],
    };
  },
  computed: {
    ...mapState(["userInfo", "bankInfo"]),
    tabsArr() {
      return [this.$t('hj172'), this.$t('hj177')];
    },
    tabsTwoArr(){
      return [this.$t('hj412'), this.$t('hj413')];
    }
  },
  created() {
    this.getSettingInfo();
    this.getCardDetail(); // 获取银行卡信息
    this.getUserInfo();
    this.getInfoSite();
    this.getPayInfos(5);
  },
  methods: {
    handleAvatarSuccess(res, file) {
      this.imgStatus = false;
      this.form.img1key = res.data.url;
    },
    beforeAvatarUpload(file) {
      this.imgStatus = true;
      const isLt10M = file.size / 1024 / 1024 < 10;
      if (!isLt10M) {
        this.$message.error(this.$t('hj205'));
        return false;
      } else {
        this.form.img1key = URL.createObjectURL(file);
        compress(file, function (val) { });
      }
    },
    handleError() {
      this.imgStatus = false;
    },
    selectWallet(event){
      let obj = {};
      obj = this.wallets.find((item)=>{//model就是上面的数据源
          return item.key === event.target.value;//筛选出匹配数据
      });
      this.walletType = obj.key;
      this.getPayInfos(this.walletType);
    },
    selectModel(event){
        let obj = {};
        obj = this.options.find((item)=>{//model就是上面的数据源
            return item.channelAccount === event.target.value;//筛选出匹配数据
        });

        this.currpaytype = obj.type;
        this.channelDesc = obj.channelDesc;
        this.currBankName = obj.channelName;
        this.payid=obj.id;
    },
    selectType(event){
        let obj = {};
        obj = this.txList.find((item)=>{//model就是上面的数据源
            return item.key === event.target.value;//筛选出匹配数据
        });
        this.currallamt=obj.amount;
        this.currtxtype = obj.key;
        //console.log(obj)
    },
    selectBank(event){
        let obj = {};
        obj = this.bankList.find((item)=>{//model就是上面的数据源
            return item.bankNo === event.target.value;//筛选出匹配数据
        });

        this.currbankid = obj.id;

    },
    async getPayInfos (type) {
      // 获取支付渠道 详细信息
      let opt = {
        type: type
      }
      let data = await api.getPayInfo(opt)
      if (data.status === 0) {
        this.options = data.data;
        // this.payInfo = data.data[0]
        // this.skName = this.payInfo.channelName
        // this.skBankName = this.payInfo.channelType
        // this.skUser = this.payInfo.channelAccount
      } else {
        Toast(this.$t('hj327'))
      }
    },
    peopleCz(){
        var ua = navigator.userAgent;
        var url=this.settingInfo.kefuUrl;
        if (url!='1'){
          if (ua.match(/Bingo/i) == "Bingo") {
            document.location = "telegram://"+url;
          }else{
            document.location = "https://"+url;
          }
        }

        // if (url!='1'){

        //   if (ua.match(/Bingo/i) == "Bingo") {

        //     //document.location = "https://wa.me/"+ url;
        //     document.location = "whatsapp://api.whatsapp.com/send?phone="+url;
        //   }else{
        //     document.location = "https://api.whatsapp.com/send?phone="+url;
        //   }
        // }
    },
    onSelect(e) {
      this.$i18n.locale = e.lang;
      window.localStorage.setItem('language', e.lang);
    },
    goOnline() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push('/service');
    },
    async getInfoSite() {
      let data = await api.getInfoSite()
      if (data.status === 0) {
        this.onlineService = data.data.onlineService
      } else {
        Toast(this.$t('hj327'))
      }
    },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // 判断是否登录
        this.$store.commit('dialogVisible', false);
        this.$store.state.userInfo = data.data;
        //提现账户
        this.txList = [
        // {
        //   key: '1',
        //   label: this.$t('hj284'),
        //   amount: data.data.enableAmt
        // }, {
        //   key: '2',
        //   label: this.$t('hj285'),
        //   amount: data.data.hkEnableAmt
        // }, {
        //   key: '3',
        //   label: this.$t('hj286'),
        //   amount: data.data.myEnableAmt
        // }, {
        //   key: '4',
        //   label: this.$t('hj287'),
        //   amount: data.data.thEnableAmt
        // },
        {
          key: '5',
          label: this.$t('hj288'),
          amount: data.data.inEnableAmt
        },
        // {
        //   key: '6',
        //   label: this.$t('hj290'),
        //   amount: data.data.vnEnableAmt
        // },
        {
          key: '7',
          label: this.$t('hj289'),
          amount: data.data.enableFuturesAmt
        }]


      } else {
        this.$store.commit('dialogVisible', true);
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
    handleTabsClickTwo(item, index) {
      this.tabsTwoCurrentIndex = index;
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
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
      this.withdrawalValue = this.currallamt;
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },


    async handleToSure() {

      // 点击确定提现
      if (!this.currbankid) {
        Toast(this.$t('hj377'));
        return;
      }
      if (!this.currtxtype) {
        Toast(this.$t('hj378'));
        return;
      } else {
      }
      if (!this.withdrawalValue || this.withdrawalValue <= 0) {
        Toast(this.$t('hj180'));
      } else if (this.withdrawalValue - this.settingInfo.withMinAmt < 0) {
        Toast(this.$t('hj181') + this.settingInfo.withMinAmt);
      } else {
        let opts = {
          amt: this.withdrawalValue,
          type:this.currtxtype,
          bankId:this.currbankid
        };
        let data = await api.outMoney(opts);
        if (data.status === 0) {
          // 成功
          Toast(this.$t('hj182'));
          this.$router.push("/cashWithdrawalRecord");
        } else if( data.msg.indexOf('有持仓单不能出金') > -1 ){
          Toast(this.$t('hj379'));
        } else if( data.msg.indexOf('用户被锁定') > -1 ){
          Toast(this.$t('hj380'));
        } else if( data.msg.indexOf('未实名认证') > -1 ){
          Toast(this.$t('hj381'));
        } else if( data.msg.indexOf('未添加银行卡') > -1 ){
          Toast(this.$t('hj382'));
        } else if( data.msg.indexOf('模拟用户不能出金') > -1 ){
          Toast(this.$t('hj383'));
        } else if( data.msg.indexOf('周末或节假日不能出金') > -1 ){
          Toast(this.$t('hj384'));
        } else if( data.msg.indexOf('出金失败，出金时间在') > -1 ){
          Toast(this.$t('hj418'));
        } else if( data.msg.indexOf('提现失败，用户可用资金不足') > -1 ){
          Toast(this.$t('hj385'));
        } else {
          Toast(data.msg ? this.$t('hj327') : this.$t('hj183'));
        }
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async getCardDetail() {
      // 获取银行卡信息
      let data = await api.getBankList();
      if (data.status === 0) {
        this.bankList = data.data;
        //this.$store.state.bankInfo = data.data;
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
        //sconsole.log(this.settingInfo, "settingInfo");
      } else {
        Toast(this.$t('hj327'))
      }
    },
    handleGoToTransferRecord() { // 充值记录
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push('/transferRecord');
    },
    handleGoToCashWithdrawalRecord() { // 提现记录
      this.$router.push('/cashWithdrawalRecord');
    },
    handleGoToTransfers() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push('/transfers');
    },
    handleGoCz() {
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      if (this.walletNum === "") {
        this.messShow = true;
        this.mess = this.$t('hj171');
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
      } else if (this.walletNum < this.settingInfo.chargeMinAmt) {
        this.messShow = true;
        this.mess = this.$t('hj184')+this.settingInfo.chargeMinAmt;
        setTimeout(() => {
          this.messShow = false;
        }, 1500);
      } else if (this.walletNum !== "" && this.walletNum >= this.settingInfo.chargeMinAmt) {
        this.getPayInfo();

      }
    },
    onCopy() {
      Toast(this.$t('hj185'));
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    onError() {
      Toast(this.$t('hj186'));
    },
    async getPayInfo() {
      this.getrecharge()
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
        this.$message.error(this.$t('hj375'));
        return;
      }
      if(!this.payid){
        this.$message.error(this.$t('hj374'));
        return;
      }
      // this.dialogTableVisible = true;

      let opts = {
        amt: this.walletNum,
        payType: this.payid,
        img: this.form.img1key,
      };

      let data = await api.inMoney(opts);
      if (data.status == 0) {
        Toast(this.$t('hj326'));
        this.$router.push('/transferRecord');
        //this.messDialog = true;
      } else if( data.msg.indexOf('未实名认证') > -1 ){
        this.mess = this.$t('hj381');
      } else {
        Toast(this.$t('hj376'));
      }
    },
  }
};
</script>

<style scoped lang="less">
  .kefu_1{
    width: 100%;
    display: flex;
    flex-direction: column;

    .kefu_img{
      width: 210px;
      height: 210px;
      margin:0px auto;
    }
    .kefucz{
      width: 100%;
      height: 48px;
      margin-top: 20px;
      text-align: center;
      button{
        width: 260px;
        height:48px;
        border: 0;
        border-radius: 8px;
        background-color: #13D2A0;

      }

    }
    img{
      width: 210px;
      height: 210px;
    }
  }

  /deep/ .el-upload--picture-card {
    background: none;
    width: 100%;
    height: 1.6rem;
    line-height: 1.6rem;
  }

  /deep/ .el-upload__input {
    display: none;
  }
  .walletinfo{
    display: flex;
    flex-wrap: wrap;
    color: #fff;
    .info-item{
      width: 33%;
      text-align: left;
      font-size: 20px;
      margin: 20px 0;
    }
    .info-label{
      opacity: 0.6;
      margin-bottom: 15px;
    }
  }
.set-account {
    border: none;
    width: 280px;
    color: #13D2A0;
    font-size: 18px ;
    height: 68px;
    background-color: #434343;
  }
.user_page {
  width: 100%;
  height: calc(100% - 1.3rem);

  .content {
    width: 100%;
    height: 100%;
    padding: 0 0.3rem;

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
        width: 10%;
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
    .titletx{
      color: #fff;
      font-size: 26px;
      margin-top: 30px;
      margin-bottom: 20px;
    }

    .center_card {
      width: 100%;
      height: auto;
      margin-top: 30px;
      background: #082E66;
      //background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);
      // background-image: linear-gradient(to right, #ffffff , #dfedfc);
      border-radius: 0.15rem;
      padding: 0.5rem 0.4rem;
      .topcard{
        display: flex;
        justify-content: space-between;
      }

      .keyon {
        width: 100%;
        height: 0.5128rem;
        font-size: 0.359rem;
        display: flex;
        align-items: center;
        color: #fff;
        opacity: 0.6;

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
        color: #fff;

        span {
          font-weight: 600;
        }
      }
      .rightcard{
        font-size: 130px;
        font-weight: 500;
        line-height: 68px;
        padding-top: 15px;
        opacity: 0.1;
        background: linear-gradient(180deg, #FFFFFF 0%, rgba(255,255,255,0) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }

      .yk {
        width: 100%;
        height: 0.5rem;
        display: flex;
        align-items: center;

        >div {
          width: 50%;
          height: 100%;
          color: #fff;

          display: flex;
          align-items: center;
        }
      }

      .yk.es {
        opacity: 0.6;
        margin-top: 0.3rem;
      }

      .yk.as {
        font-size: 0.4033rem;
        margin-top: 0.1rem;

        span {
          color: #fff;
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
        background: #89B9FF;
        font-size: 0.4015rem;
        color: #000;
        margin-top: 0.65rem;

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
  height: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #030E1E;
  border-radius: 100px;
  color: #fff;

  >div {
    width: 50%;
    height: 100%;
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .active {
    background: #89B9FF;
    border-radius: 100px;
    color: #000;
    height: 58px;
  }
}
.kongbai{
  width: 100%;
  height: 1.8rem;
}
.banks {
  width: 100%;

  color: #fff;
  margin-top: 30px;
  .bank_1{
    padding:0.5rem;
    border-radius: 0.3rem;
    background-color: #434343;
    margin-bottom: 1px;
  }

  /deep/.el-select .el-input.is-focus .el-input__inner {
      background-color: #434343 !important;
  }

  /deep/.el-input--suffix .el-input__inner {
      background-color: #434343 !important;
      border: none;
      color: #13D2A0;
      font-size: 18px !important;
  }


  >div {
    width: 100%;
    // height: 1.5385rem;
    // margin-top: 0.3rem;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.359rem;

    span {
      // font-weight: 600;
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
        color: #13D2A0;
      }
    }

    .right_copy {
      // width: 15%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
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
  height: 420px;
  margin-top: 30px;
  background: #433A4B;
  border-radius: 0.15rem;
  padding: 0.5rem 0.4rem;
  //background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);
  .ttxall{
    display: flex;
    justify-content: space-between;
  }
  .rightttx{
    font-size: 120px;
    opacity: 0.1;
    padding-top: 15px;
    font-weight: 500;
    line-height: 68px;
    background: linear-gradient(180deg, #FFFFFF 0%, rgba(255,255,255,0) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .ttx {
    width: 100%;
    height: 0.5rem;
    display: flex;
    align-items: center;
    font-size: 0.35rem;
    color: #fff;
    opacity: 0.6;
  }

  .ttx_price {
    width: 100%;
    height: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 0.7615rem;

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
      color: #fff;
      opacity: 0.6;
    }

    .num {
      width: 70%;
      height: 100%;
      font-size: 0.35rem;
      color: #07F8B5;

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
      color: #07F8B5;
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
  background: #89B9FF;
  font-size: 0.4015rem;
  color: #000;
  margin-top: 0.35rem;

  span {
    font-weight: 600;
  }
}

.bank_1:last-child {
  border: none;
}
</style>
