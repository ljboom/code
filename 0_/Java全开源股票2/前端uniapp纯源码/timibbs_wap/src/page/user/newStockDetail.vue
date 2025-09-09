<template>
  <div class="bank_card_page">

    <!-- 头部 -->
    <div class="top_icon">

      <div class="left_back" style="padding-left:30px;">
        <div class="left_back_icon" @click="$router.go(-1)">
          <img src="../../assets/img/zuojiantou.png" alt />
        </div>
      </div>

      <div class="title">
        {{ $t('hj378') }}
      </div>

    </div>

    <!-- end -->

    <div class="cell-list">

      <van-cell-group style="padding: 10px;">
        <van-cell class="van-cell--large" :title="$t('hj376')" :value="$route.params.orderNo" />
        <van-cell class="van-cell--large" :title="$t('hj377')">
          <template>
            <span :class="$route.params.status == 3 ? 'red' : 'green'">{{ payStatusStr() }}</span>
          </template>
        </van-cell>
        <van-cell class="van-cell--large" :title="this.$t('hj366')" :value="$route.params.addTime" />
        <van-cell class="van-cell--large" :title="$t('hj367')" :value="getTextByMark()" />
        <van-cell class="van-cell--large" :title="$t('hj368')" :value="$route.params.newCode" />
        <van-cell class="van-cell--large" :title="$t('hj369')" :value="$route.params.newName" />
        <van-cell class="van-cell--large" :title="$t('hj370')"
          :value="$route.params.type == 1 ? $t('hj352') : $route.params.type == 2 ? $t('hj353') : $t('hj354')" />
        <van-cell class="van-cell--large" :title="$t('hj371')"
          :value="$route.params.buyPrice + ' (' + getCurrency() + ')'" />
        <van-cell class="van-cell--large" :title="$t('hj372')" :value="$route.params.applyNumber" />
        <van-cell class="van-cell--large" :title="$t('hj373')" :value="$route.params.subscribeTime | getTimeYear" />
        <van-cell class="van-cell--large" :title="$t('hj374')" :value="$route.params.subscriptionTime | getTimeYear" />
        <van-cell class="van-cell--large" :title="$t('hj375')" :value="$route.params.bond + ' (' + getCurrency() + ')'" />
      </van-cell-group>


      <div style="margin: 1rem 25px 2rem;">
        <van-button v-if="$route.params.status != 4 && $route.params.status != 1" round block type="info"
          @click="handlePay">{{ $t('hj250') }}</van-button>
        <van-button round block type="primary" native-type="button" style="margin-top: 0.3rem;" @click="$router.go(-1)">{{
          $t('hj106') }}</van-button>
      </div>

    </div>


  </div>
</template>
  
<script>
import * as api from "@/axios/api";
import { Toast, MessageBox } from "mint-ui";

export default {
  name: "NewStockDetail",
  data() {
    return {
      typeShow: false,
      bankField: true,
      usdtField: true,
      marketList: [
        { text: this.$t('hj347'), value: "us" },
        { text: this.$t('hj348'), value: "hk" },
        { text: this.$t('hj349'), value: "my" },
        { text: this.$t('hj350'), value: "th" },
        { text: this.$t('hj351'), value: "in" },
      ],
      columnsCode: ["USD", "HKD", "MYR", "THB", "INR"],
      columns: [this.$t('hj277'), this.$t('hj278'), this.$t('hj279'), this.$t('hj280'), this.$t('hj283')],
      showPicker: false,
    };
  },
  created() {
    //没有数据直接返回
    if (!this.$route.params || Object.keys(this.$route.params).length === 0) {
      this.$router.push({ path: '/warehouse?index=3' });
    }
    this.getUserInfo();
  },
  filters: {
    formatDecimal(value) {
      if (typeof value === 'number') {
        return value.toFixed(3); // 使用 toFixed 方法保留 3 位小数
      }
      return value;
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

      return d + '-' + mm + '-' + y + ' ' + h + ":" + m + ":" + c;
      //return y + '-' + mm + '-' + d + ' ' + h + ":" + m + ":" + c;
    }
  },
  methods: {
    findByCodeMoney(code) {
      //根据货币类型返回额度
      var result = 0.000;
      switch (code) {
        case "USD": result = this.$store.state.userInfo.usEnableAmt; break;
        case "JPY": result = this.$store.state.userInfo.jpEnableAmt; break;
        case "HKD": result = this.$store.state.userInfo.hkEnableAmt; break;
        case "MYR": result = this.$store.state.userInfo.myEnableAmt; break;
        case "THB": result = this.$store.state.userInfo.thEnableAmt; break;
        case "PHP": result = this.$store.state.userInfo.phEnableAmt; break;
        case "IDR": result = this.$store.state.userInfo.idEnableAmt; break;
        case "KRW": result = this.$store.state.userInfo.krEnableAmt; break;
        case "INR": result = this.$store.state.userInfo.inEnableAmt; break;
      }
      return result;
    },
    getCurrency() {
      var stockType = this.$route.params.stockType;
      if (stockType === 'us') {
        return 'USD';
      } else if (stockType === 'hk') {
        return 'HKD';
      } else if (stockType === 'my') {
        return 'MYR';
      } else if (stockType === 'th') {
        return 'THB';
      } else if (stockType === 'in') {
        return 'INR';
      } else {
        return '$';
      }
    },
    getTextByMark() {
      var value = this.$route.params.stockType;
      const market = this.marketList.find(item => item.value === value);
      return market ? market.text : '';
    },
    payStatusStr() {
      var val = this.$route.params.status
      if (val == 1) {
        return this.$t('hj131');
      } else if (val === 2) {
        return this.$t('hj132');
      } else if (val === 3) {
        return this.$t('hj363');
      } else if (val === 4) {
        return this.$t('hj134');
      } else if (val === 6) {
        return this.$t('hj364');
      }
      return val;
    },
    handlePay() {
      var markStr = this.getTextByMark();
      var amt = this.findByCodeMoney(this.getCurrency()).toFixed(3);
      // var msgText = this.$t('hj131') + " [" + markStr + "] " + this.$t('hj132') + " " + amt + " ," + this.$t('hj133') + "?";
      var msgText = "當前 [" + markStr + "] 賬戶可用餘額為 " + amt + " ,是否確認支付此新股訂單?";
      MessageBox.confirm(msgText, this.$t('hj165'), {
        confirmButtonText: this.$t('hj161'),
        cancelButtonText: this.$t('hj106'),
      }).then(async () => {
        let opt = {
          id: this.$route.params.id
        }
        let data = await api.submitSubscribe(opt)
        if (data.status == 0) {
          Toast(data.msg)
          this.$router.push({ path: '/warehouse?index=3' });
        } else {
          Toast(data.msg)
        }
      }).catch(() => {

      });

    },
    selectWithdrawFun(obj) {
      console.log(obj)
    },
    onConfirm(value, index) {
      this.typeShow = true;
      if (index != 0) {
        this.usdtField = false;
      }
      this.formData.market = value;
      this.formData.marketType = this.columnsCode[index];
      this.showPicker = false
    },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo()
      if (data.status === 0) {
        this.$store.state.userInfo = data.data
      } else {
        Toast(data.msg)
      }
      this.$store.state.user = this.user
    },
    async onSubmit(obj) {

      //提交
      let data = await api.addBankCard(this.formData);
      if (data.status === 0) {
        Toast(this.$t("hj220"));
        this.$router.push("bankCard");
      } else {
        Toast(this.$t("hj310"));
      }

    }

  }
}

</script>
  
<style scoped lang="less">
.bank_card_page {
  width: 100%;
  height: 100%;
  background: rgb(241, 242, 246);

  .van-cell--large {
    padding-top: .222222rem;
    padding-bottom: .222222rem;

    .van-cell__title {
      font-size: .296296rem
    }

    .van-cell__label {
      font-size: .259259rem
    }

  }

  .van-cell {
    line-height: 0.5rem;
  }

  .van-radio {
    margin-top: 0.25rem;
  }

  /deep/ .van-field__label {
    width: 10em;
  }

  .top_icon {
    width: 100%;
    height: 1.3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;

    & .left_back {
      width: 10%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;

      & img {
        width: 0.6rem;
        height: 0.6rem;
      }
    }

    & .title {
      width: calc(100% + 2rem);
      text-align: center;
      font-size: 0.4rem;
    }

    & .right_icon {
      width: auto;
      height: 35%;
      padding-right: 0.1rem;
      display: flex;
      justify-content: space-between;

      &>div {
        width: auto;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        & img {
          width: 0.55rem;
          height: 0.55rem;
        }
      }
    }
  }

  .top_icon .title {
    width: 100%;
    text-align: center;
    font-size: 0.4rem;
  }

  .right_icon {
    line-height: 0.5rem;
    width: 60% !important;
    font-size: 0.35rem;
    padding-right: 0.3rem !important;
    color: #088d47;
  }

  .bank-list {
    width: 100%;
    height: auto;
    margin-top: 0.2rem;

    .bank-item {
      float: left;
      width: 95%;
      margin-left: 2.5%;
      background-color: #fff;
      ;
      height: auto;
      margin-top: 0.1rem;
      border-radius: 0.1rem;

      .item-left {
        width: 2rem;
        height: 1.5rem;
        margin-top: 0.25rem;
        margin-left: 0.25rem;
        float: left;

        img {
          width: 100%;
          height: 100%;
        }
      }

      .item-right {
        float: left;
        width: calc(100% - 2.3rem);
        padding-left: 0.4rem;
        padding-top: 0.25rem;

        .item-right-x {
          line-height: 0.7rem;
          font-size: 0.25rem;
        }
      }

      .item-bottom {
        float: left;
        height: 0.7rem;
        width: 100%;

        .market-type {
          float: left;
          display: block;
          width: 2rem;
          line-height: 0.7rem;
          font-size: 0.35rem;
          margin-left: 0.25rem;
          text-align: center;
        }

        .item-btn {
          float: left;
          width: calc(100% - 2.25rem);
          height: 0.7rem;

          .edit-btn {
            float: right;
            padding: 0.15rem 0.35rem;
            background-color: #1989fa;
            color: #FFFFFF;
            margin-right: 0.3rem;
          }
        }
      }
    }
  }


  .content {
    width: 100%;
    height: 100%;
    padding: 0 0.6rem;

    .top_back {
      width: 100%;
      height: 2rem;

      >div {
        width: 10%;
        height: 100%;
        display: flex;
        align-items: center;
      }

      img {
        width: 0.6rem;
        height: 0.6rem;
      }
    }

    .titles {
      width: 100%;
      height: 1.5rem;
      font-size: 0.641rem;
      margin-top: 1rem;

      span {
        font-weight: 600;
      }
    }
  }

  .bank_name {
    width: 100%;
    height: 1.5rem;
    display: flex;
    padding: 0 0.2rem;
    background: rgb(247, 247, 247);
    border-radius: 0.2rem;
    margin-top: 0.3rem;

    .lefts {
      width: 25%;
      height: 100%;
      display: flex;
      align-items: center;
      font-size: 0.3846rem;

      span {
        font-weight: 600;
      }
    }

    .rights {
      width: 75%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;

      input {
        width: 100%;
        height: 100%;
      }
    }
  }
}

.bank_name.bind {
  display: flex;
  align-items: center;
  justify-content: center;
  background: #2d6ae9;
  font-size: 0.4103rem;
  color: #fff;

  span {
    font-weight: 600;
  }
}
</style>
  