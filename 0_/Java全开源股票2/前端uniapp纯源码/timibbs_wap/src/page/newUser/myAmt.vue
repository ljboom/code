<template>
  <div class="center_card">

    <div class="keyon">
      <span >MY {{ $t('hj49') }}(MYR)</span>
    </div>
    <div class="num_price">{{ userInfo.myUserAmt | formatDecimal }} </div>
    <div class="num">
      <div class="num_box">
        <div class="num_box_left">{{ $t('hj55') }}</div>
        <div class="num_box_right">{{ userInfo.myFreezAmt | formatDecimal }}</div>
      </div>
      <div class="num_box">
        <div class="num_box_left">{{ $t('hj141')}}</div>
        <div class="num_box_right">{{ userInfo.myProfitAndLose | formatDecimal }}</div>
      </div>
      <div class="num_box">
        <div class="num_box_left">{{ $t('hj48')}}</div>
        <div class="num_box_right">{{ userInfo.myEnableAmt | formatDecimal }}</div>
      </div>
      <div class="num_box">
        <div class="num_box_left">{{$t('hj272')}}</div>
        <div class="num_box_right">0.000</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CenterCard',
  props: {
    userInfo:{
      type: Array,
      default: []
    }
  },
  data() {
    return {
      // 可能需要一些数据
    };
  },
  filters: {
    formatDecimal(value) {
      if (typeof value === 'number') {
        return value.toFixed(3); // 使用 toFixed 方法保留 3 位小数
      }
      return value;
    }
  },
  methods:{
    wallet(){
      this.$loading.showTime(1)
      this.$router.push('/wallet');
    }
  }
};
</script>

<style scoped>
.center_card {
  width: 100%;
  background-image: -webkit-gradient(linear, left top, right bottom, from(#ffffff), to(#dfedfc));
  background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);
  margin-top: 0.5rem;
  border-radius: 0.15rem;
  padding: 0.5rem 0.4rem;
  position: relative;
}
.account-type {
  position: absolute;
  font-size: 1.8rem;
  right: 0rem;
  top: 0.15rem;
  color: var(--c-font-text-c4);
  transform: scale(1, 1.5);
  -ms-transform: scale(1, 1.5);
  -webkit-transform: scale(1, 1.5);
  -moz-transform: scale(1, 1.5);
  -o-transform: scale(1, 1.5);
  opacity: 0.1;
}
.keyon {
  width: 100%;
  font-size: 0.359rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  color: #3d4144;
  font-weight: 600;
  justify-content: left;
  padding-bottom: 0.2rem;
  z-index: 10;
  position: relative;
}
.keyon span {
  font-weight: 600;
}
.num_price {
  width: 100%;
  margin-top: 0.1rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: left;
  font-size: 0.5528rem;
  padding-bottom: 0.3rem;
}
.num_price span {
  font-weight: 600;
}
.account {
  font-size: 0.6rem;
  font-weight: 600;
}
.yk {
  width: 100%;
  height: 0.5rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.yk > div {
  width: 33%;
  height: 100%;
  color: #97989d;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
}
.yk.es {
  margin-top: 0.3rem;
}
.yk.as {
  font-size: 0.4033rem;
  margin-top: 0.1rem;
}
.yk.as span {
  color: #000;
  font-weight: 600;
}
.btns {
  width: 100%;
  line-height: 1.2821rem;
  font-size: 0.4015rem;
  color: #fff;
  margin-top: 0.35rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;
  position: relative;
}
.btns button {
  width: 40%;
}
.van-badge {
  padding-right: 0.09rem;
  padding-left: 0.1rem;
  font-size: 0.3rem;
}
.num .num_box {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;
  line-height: 0.5rem;
}
.num .num_box .num_box_left {
  padding: 0rem 0.2rem;
}
</style>

