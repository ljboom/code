<template>
  <div>
    <div class="wrapper">
      <div class="header">
        <div class="left_back" @click="handleBackClick()">
          <img src="../../assets/img/zuojiantou.png" alt="" />
        </div>
        <div class="header_titles">{{$t('hj257')}}</div>
      </div>
      <div style="height:1.5rem"></div>
      <div class="containers">
        <div class="mains">
          <p class="titles">{{ detail.stockName }}</p>
          <p class="codes">({{ detail.stockCode }})</p>
          <p class="mairujia">{{ detail.orderTotalPrice.toFixed(2) }}</p>
          <div class="buysell">
            <span>{{$t('hj85')}}:{{ detail.buyOrderPrice }}</span>
            <span v-if="type == 1">{{$t('hj84')}}:{{ detail.sellOrderPrice }}</span>
          </div>
          <div class="mainlist">
            <div class="everylist">
              <span>{{$t('hj258')}}</span>
              <span>{{ type == 0 ? $t('hj2') : $t('hj121') }}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj259')}}</span>
              <span>{{ detail.positionSn }}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj260')}}</span>
              <span>{{ detail.orderTotalPrice }}</span>
            </div>
             <div class="everylist">
              <span>{{$t('hj261')}}</span>
              <span>{{ detail.orderNum }}</span>
            </div>
             <div class="everylist" v-if="type == 0">
              <span>{{$t('hj262')}}</span>
              <span>{{ detail.now_price | formatDecimal}}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj98')}}</span>
              <span>{{ detail.buyOrderPrice }}</span>
            </div>
            <div class="everylist" v-if="type == 1">
              <span>{{$t('hj263')}}</span>
              <span>{{ detail.sellOrderPrice }}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj264')}}</span>
              <span>{{ detail.buyOrderTime | gettime}}</span>
            </div>
            <div class="everylist" v-if="type == 1">
              <span>{{$t('hj265')}}</span>
              <span>{{ detail.sellOrderTime | gettime}}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj266')}}</span>
              <span>{{ detail.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj141')}}</span>
              <span>{{ detail.profitAndLose }}</span>
            </div>
            <div class="everylist">
              <span>{{$t('hj118')}}</span>
              <span>{{ detail.allProfitAndLose }}</span>
            </div>
             <div class="everylist">
              <span>{{$t('hj44')}}</span>
              <span>{{ detail.orderFee }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import '@/assets/style/common.less'
import * as api from "@/axios/api";
import { Toast } from "mint-ui";

export default {
  components: {},
  data() {
    return {
      detail: {},
      type: null,
    };
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
  watch: {},
  computed: {},
  created() {
    this.detail = JSON.parse(this.$route.query.detail);
    this.type = this.$route.query.type
    console.log(this.detail);
  },
  mounted() {},
  methods: {
    handleBackClick() {
      this.$router.go(-1);
    }
  }
};
</script>
<style lang="less" scoped>
.containers {
  padding: 30px 16px;
  .mains {
    background: #fff;
    border-radius: 10px;
    padding: 50px 20px;
    text-align: center;

    .titles {
      font-size: 26px;
      text-align: center;
      font-weight: 600;
    }
    .codes {
      font-size: 18px;
      margin-top: 14px;
      font-weight: 600;
    }
    .mairujia {
      font-size: 30px;
      font-weight: 600;
      margin-top: 16px;
    }
    .buysell {
      font-size: 20px;
      margin-top: 10px;
      span {
        margin: 0 10px;
        font-weight: 600;
      }
    }
    .mainlist {
      padding: 0 20px;
      margin-top: 30px;

      .everylist {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 20px;
        span {
          font-weight: 600;
        }
      }
    }
  }
}
.header {
  width: 100%;
  height: 1.5rem;
  background: #fff;
  position: fixed;
  z-index: 999;
  border-radius: 0 0 0.15rem 0.15rem;

  .left_back {
    width: 1rem;
    height: 100%;
    left: 0;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;

    img {
      width: 0.6rem;
      height: 0.6rem;
    }
  }

  .header_titles {
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: 0.4615rem;
    line-height: 1.5rem;

    span {
      font-weight: 600;
    }
  }
}
</style>
