<template>
  <div>
    <div v-if="list.length <= 0" class="empty text-center">
      {{ $t('hj228') }}
    </div>
    <div v-else style="margin-top: 50px;">
      <ul class="table-list" v-infinite-scroll="loadMore" infinite-scroll-disabled="loading"
        infinite-scroll-distance="10">
        <li class="list-body" v-for="(item) in list" :key="item.key">
          <div class="order-info-box">
            <div class="order-title">
              <!-- <span :class="['main', item.payChannel == 0 ? 'ali' : item.payChannel == 1 ? 'cart' : 'wechat']">
                {{ item.payChannel == 0 ? $t('hj229') : item.payChannel == 1 ? $t('hj230') : item.payChannel }}
              </span> -->
              <span class="payNumber">{{ $t('hj172') }}
                <span>{{ findTextByCode(item.payChannel) }}</span>
                <span :style="{ color: $state.theme == 'red' ? '#BB1815' : '' }">{{
                  item.payAmt
                }}</span></span>
              <span v-if="item.payStatus != 0"
                :class="item.orderStatus == 1 ? 'green pull-right' : item.orderStatus == 2 ? 'red pull-right' : 'red pull-right'">
                <i v-if="item.orderStatus == 1" class="iconfont icon-tongguo4 animated bounceIn"></i>
                <i v-if="item.orderStatus == 0" class="iconfont icon-dengdai animated bounceInDown"></i>
                <i v-if="item.orderStatus == 2" class="iconfont icon-failure animated bounceInDown"></i>
                <i v-if="item.orderStatus == 3" class="iconfont icon-iconfontweitongguo animated bounceInDown"></i>
                <!-- 1 => 成功 2 失败 3取消 4 等待 -->
                {{ item.orderStatus == 1 ? $t('hj231') : item.orderStatus == 2 ? $t('hj232') : item.orderStatus == 3 ?
                  $t('hj233') :
                  $t('hj202')
                }}
              </span>

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
                <b v-if="item.addTime">{{ new Date(item.addTime) | timeFormat }}</b>
                <b v-else></b>
              </span>
            </div>


          </div>
          <!-- <div class="capital">
              <div class="pro">
                  {{item.payChannel}} <span class="pull-right">金额:{{item.payAmt}}</span>
              </div>
              <div class=" clearfix">
                  <div class="col-xs-4"></div>
                  <div class="col-xs-8">
                      <span class="pull-right">
                          {{new Date(item.addTime) | timeFormat}}
                      </span>
                  </div>
              </div>
          </div> -->
        </li>
      </ul>
      <div v-show="loading" class="load-all text-center">
        <mt-spinner type="fading-circle"></mt-spinner>
        {{ $t('hj235') }}
      </div>
      <div v-show="!loading" class="load-all text-center">
        {{ $t('hj236') }}
      </div>
    </div>


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
import { Toast } from 'mint-ui'
import * as api from '@/axios/api'
import axios from 'axios'

export default {
  components: {},
  props: {},
  data() {
    return {
      rechargeAccount: '',
      uploadUrl: '',
      uploadHeaders: {
        usertoken: window.localStorage.getItem("USERTOKEN"),
      },
      payInfo: [],
      currPayInfo: [],
      orderNo: '',
      orderInfo: {},
      imageUrl: '',
      payPopup: false,
      loading: false,
      list: [],
      pageNum: 1,
      pageSize: 15,
      total: 0,
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
    }
  },
  watch: {},
  computed: {},
  created() {
    this.uploadUrl = axios.defaults.baseURL + "/user/upload.do"
    this.getPayInfos();
  },
  mounted() {
    this.getListDetail()
  },
  methods: {
    handleClose() {
      //弹窗关闭自动提交
      if (this.imageUrl != "") {
        this.submitOrder();
      }
    },
    findTextByCode(code) {
      const matchedAccount = this.accountLists.find(account => account.code === code);
      return matchedAccount ? matchedAccount.text : "";
    },
    findCodePayInfo(code) {
      // 根据充值账户返回充值通道
      return this.payInfo.filter(obj => obj.channelType === code);
    },
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
      console.log(this.orderInfo)

      this.payPopup = true;
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
    async getPayInfos() {
      // 获取支付渠道 详细信息
      let data = await api.getPayInfo();
      if (data.status === 0) {
        this.payInfo = data.data;
      } else {
        Toast(data.msg);
      }
    },
    async getListDetail() {
      let opt = {
        payChannel: '', // 支付方式
        orderStatus: '', // 订单状态
        pageNum: this.pageNum,
        pageSize: 15
      }
      let data = await api.rechargeList(opt)
      if (data.status === 0) {
        data.data.list.forEach(element => {
          this.list.push(element)
        })
        this.total = data.data.total
      } else {
        Toast(data.msg)
      }
    },
    async loadMore() {
      if (this.list.length < 10 || this.total <= this.pageNum * this.pageNum) {
        return
      }
      this.loading = true
      // 加载下一页
      this.pageNum++
      await this.getListDetail()
      this.loading = false
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
  }
}
</script>

<style lang="less" scoped>
.wrapper {
  padding-top: 0.9rem;
}

.table-list {
  padding: 0.2rem 0;

  .list-body {
    padding: 0.1rem 0.3rem;

    .capital:nth-child(1) {
      border-top: 0.01rem solid #3f444a;
    }

    .capital {
      padding: 0.2rem;
      // border-radius: 0.2rem;
      border-bottom: 0.01rem solid #3f444a;

      div {
        line-height: 0.4rem;
      }

      .col-xs-4 {
        padding-left: 0;
        padding-right: 0;
      }

      .pro {
        color: #999;
      }
    }
  }
}

.payNumber {
  font-size: 0.296296rem;
  font-weight: bold;

  span {
    font-family: lightnumber;
  }
}

/deep/.order-info-box {
  background-color: #16171d;
  padding: 0;

  .main {
    padding: 0.05rem .15rem;
    letter-spacing: 0;
    text-align: center;
    margin-right: .16rem;
    font-size: 0.24rem;
    border-radius: 3px;

    &.ali {
      background-color: #138EB4;
    }

    &.cart {
      background-color: #7266BA;
    }

    &.wechat {
      background-color: #009C46;
    }
  }

  .order-info {
    border-bottom: 1px solid #2e3237;
    padding-bottom: .3rem;
  }

  .order-title {
    border-bottom: none;
  }

  .info-mix {
    display: flex;
    font-size: .2rem;
    width: 100%;

    .info-item {
      margin-right: .2rem;
      color: #fff8;
    }
  }
}

.red-theme {
  .list-body {
    background-color: #fff;
    ;
    border-bottom: 0.018519rem solid #e9e9e9;
    padding-bottom: 0.185185rem;
  }

  .order-info-box {
    background-color: #fff;
    color: #4d4d4d;
    ;

    .order-info {
      border-bottom-color: #e9e9e9;
    }
  }

  .order-info-box .main.cart {
    color: #fff;
  }

  .payNumber {
    color: #000;
  }

  .order-info-box .info-mix .info-item {
    color: #666666;
  }

  .load-all {
    background-color: #fff;
  }
}
</style>
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
      color: #000;
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
      color: #000;

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

.order-info0 {
  font-size: 0.296296rem;
}

.order-info {
  padding-bottom: 0;
}

.order-info0 {
  margin-bottom: 0.092593rem;
}

.van-count-down {
  font-size: 0.296296rem;
}

.pull-right {
  font-size: 0.296296rem;
}

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
