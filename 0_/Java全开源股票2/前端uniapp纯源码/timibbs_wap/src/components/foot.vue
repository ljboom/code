<template>
  <div class="footCss">
    <div :class="touch == 1 ? 'footDemos' : 'footDemo'" @click="goRouter('/home', 1)">
      <div class="homeImgOut" v-show="$store.state.select == '/home'">
        <div class="homeImg">
          <img src="~@/assets/foot/ic_home_tab_def.png" />
        </div>
      </div>
      <div v-show="$store.state.select != '/home'" class="footImgDeft">
        <img src="~@/assets/foot/tab_main_home_default.png" />
      </div>
      <div v-show="$store.state.select != '/home'">{{ $t('hj224') }}</div>
    </div>
    <div :class="touch == 2 ? 'footDemos' : 'footDemo'" @click="goRouter('/trading-list', 2)">
      <div class="footImgDeft">

        <img v-show="$store.state.select == '/trading-list'" src="~@/assets/foot/trade_selected.png" />
        <img v-show="$store.state.select != '/trading-list'" src="~@/assets/foot/tab_main_trade_default.png" />
      </div>
      <div :class="$store.state.select == '/trading-list' ? 'blueFont' : ''">{{ $t('hj225') }}</div>
    </div>
    <div :class="touch == 3 ? 'footDemos' : 'footDemo'" @click="goRouter('/warehouse', 3)">
      <div class="footImgDeft">

        <van-badge :content="warehouseTotal()" max="99">
          <img v-show="$store.state.select == '/warehouse'" src="~@/assets/foot/positions_selected.png" />
          <img v-show="$store.state.select != '/warehouse'" src="~@/assets/foot/tab_main_positions_default.png" />
        </van-badge>

      </div>
      <div :class="$store.state.select == '/warehouse' ? 'blueFont' : ''">{{ $t('hj226') }}</div>
    </div>
    <div :class="touch == 4 ? 'footDemos' : 'footDemo'" @click="goRouter('/user', 4)">
      <div class="footImgDeft">
        <van-badge :content="myOrderTotal()" max="99">
          <img v-show="$store.state.select == '/user'" src="~@/assets/foot/mine_selected.png" />
          <img v-show="$store.state.select != '/user'" src="~@/assets/foot/tab_main_mine_default.png" />
        </van-badge>
      </div>
      <div :class="$store.state.select == '/user' ? 'blueFont' : ''">{{ $t('hj227') }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      touch: 0,
    }
  },
  mounted() {
  },
  methods: {
    myOrderTotal() {
      var waitCount = window.localStorage.getItem('waitCount')
      if (typeof waitCount === 'string') {
        waitCount = Number(waitCount);
      }
      return waitCount > 0 ? waitCount : "";
    },
    warehouseTotal() {
      var total = window.localStorage.getItem("warehouse_total")
      if (typeof total === 'string') {
        total = Number(total);
      }
      return total > 0 ? total : "";
    },
    goRouter(url, index) {
      if (index == 3 || index == 4) {
        if (window.localStorage.getItem('USERTOKEN') == "" || window.localStorage.getItem('USERTOKEN') == null || window.localStorage.getItem('USERTOKEN') == undefined) {
          this.$emit('close')
          return;
        }
      }
      this.touch = index
      setTimeout(() => {
        this.touch = 0
      }, 500)
      this.$router.push(url)
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    }
  },

}
</script>

<style>
.footCss {
  border-top: 0.01rem solid rgba(192, 192, 192, 0.1);

  position: fixed;
  bottom: 0;
  width: 100%;
  height: 1.3rem;
  display: flex;
  justify-content: space-around;
}

.footDemo {
  width: 0.8rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  font-size: 0.24rem;
}

.footDemos {
  width: 0.8rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  font-size: 0.24rem;
}

.footDemos::before {
  content: '';
  width: 0.9rem;
  height: 0.9rem;
  border-radius: 100%;
  position: absolute;
  background-color: rgba(25, 122, 246, 0.14);
  -webkit-animation: footBlueBg 0.5s linear infinite;
  animation: footBlueBg 0.5s linear infinite;
  transition: all 0.5s;
}

@-webkit-keyframes footBlueBg {
  0% {
    -webkit-transform: scale(1.6);
    transform: scale(1.6);
  }

  25% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  50% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  75% {
    background-color: rgba(25, 122, 246, 0.1);

  }

  100% {
    background-color: rgba(25, 122, 246, 0);
  }
}

.footImgDeft {
  width: 0.56rem;
  height: 0.56rem;
  margin-bottom: 0.08rem;

}

.footImgDeft img {
  width: 100%;
  height: 100%;
}

.homeImgOut {
  width: 0.9rem;
  height: 0.9rem;
  border-radius: 100%;
  background-color: rgb(25, 122, 246);
}

.homeImg {
  width: 0.9rem;
  height: 0.9rem;
}

.homeImg img {
  width: 100%;
  height: 100%;
}

.blueFont {
  color: rgb(25, 122, 246);
}
</style>
