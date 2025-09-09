<template>

  <div class="van-overlay" v-if="show">
    <div class="wrapper">
      <van-loading size="24px" type="spinner" vertical>loading...</van-loading>
    </div>
  </div>

<!--  <van-popup-->
<!--    :close-on-click-overlay="false"-->
<!--    v-model="show" style="background-color:transparent"-->
<!--  >-->
<!--    <div class="loadingWrap">-->
<!--      <van-loading v-if="show" size="24px" type="spinner" vertical>加载中...</van-loading>-->
<!--    </div>-->
<!--  </van-popup>-->
</template>

<script>
export default {
  name:'loading',
  data () {
    return {
      show:false,
    }
  },

}
</script>

<style lang="less" scoped>

.van-overlay {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,.7);

  .wrapper {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    height: 100%;
  }

}

</style>
