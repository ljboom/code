<template>
  <div class="user_page">
    <div class="content">
      <div class="top_icon">
        <div class="moneyinfo">
          <div class="keyon">
            <span>{{ $t('hj49') }}</span>
          </div>
          <div class="num_price" style="color: #fff;margin-top: 10px;font-size: 18px;" v-if="userInfo.length == 0">
            $0
          </div>
          <div class="num_price" v-if="userInfo.length != 0">
            <!-- <p v-if="this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
              class="account">
              ${{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                  $store.state.userInfo.userIndexAmt).toFixed(2)
              }}
            </p>
            <p v-else-if="!this.$store.state.settingForm.indexDisplay && this.$store.state.settingForm.futuresDisplay"
              class="account">
              ${{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                  $store.state.userInfo.userFuturesAmt).toFixed(2)
              }}
            </p>
            <p v-else-if="!this.$store.state.settingForm.indexDisplay && !this.$store.state.settingForm.futuresDisplay"
              class="account">$&nbsp;&nbsp;{{ $store.state.hide ? '****' :
                  Number($store.state.userInfo.userAmt).toFixed(2)
              }}</p> -->

            <p class="account">
              ${{ $store.state.hide ? '****' : Number($store.state.userInfo.userAmt +
                  $store.state.userInfo.userIndexAmt+$store.state.userInfo.userFuturesAmt).toFixed(2)
              }}
            </p>
          </div>
        </div>

        <div class="right_icon">
          <div @click="goToTopUp()">
            <img src="@/assets/img/qianbao.svg" alt />
          </div>
          <!-- <div @click="goOnline" style="justify-content: flex-end;">
            <img style="width: 0.5rem;height: 0.5rem;" src="@/assets/img/kefu.svg" alt />
          </div> -->
        </div>

      </div>
     <!-- <div class="users" @click="goWall()" style="display:none">
        <div class="left_tou">
          <div class="left_tx">
            <div>
              <img src="@/assets/img/eslogo.png" alt />
            </div>
          </div>
          <div class="right_name">
            <span>{{ userInfo.realName ? userInfo.realName : userInfo.phone }}</span>
          </div>
        </div>
        <div class="right_go">
          <img src="@/assets/img/youjiantou.png" alt />
        </div>
      </div> -->
      <div class="center_card">
        <!-- <div class="yk es">
          <div>
            <span>{{ $t('hj293') }}</span>
          </div>
          <div>
            <span>{{ $t('hj294') }}</span>
          </div>

          <div>
            <span>{{ $t('hj295') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">$ {{ userInfo.length != 0 ? ($store.state.userInfo.allFreezAmt + $store.state.userInfo.djzj).toFixed(2) : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span>
              <span>{{ '$ 0' }}</span>
            </span>

          </div>
          <div v-if="userInfo.length != 0">
            <span >
              <span
                :class="$store.state.userInfo.allProfitAndLose > 0 ? ' red' : $store.state.userInfo.allProfitAndLose < 0 ? ' green' : ''">{{
                    '$ ' + $store.state.userInfo.allProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz">{{ '$ 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz">{{ '$ ' + $store.state.userInfo.enableAmt }}</span>
          </div>

        </div>

        <div class="yk es">
          <div>
            <span>{{ $t('hj296') }}</span>
          </div>
          <div>
            <span>{{ $t('hj297') }}</span>
          </div>

          <div>
            <span>{{ $t('hj298') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">HK$ {{ userInfo.length != 0 ? $store.state.userInfo.hkAllFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span>
              <span>{{ 'HK$ 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span >
              <span
                :class="$store.state.userInfo.hkAllProfitAndLose > 0 ? ' red' : $store.state.userInfo.hkAllProfitAndLose < 0 ? ' green' : ''">{{
                    'HK$ ' + $store.state.userInfo.hkAllProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz">{{ 'HK$ 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz">{{ 'HK$ ' + $store.state.userInfo.hkEnableAmt }}</span>
          </div>

        </div>

        <div class="yk es">
          <div>
            <span>{{ $t('hj299') }}</span>
          </div>
          <div>
            <span>{{ $t('hj300') }}</span>
          </div>

          <div>
            <span>{{ $t('hj301') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">RM {{ userInfo.length != 0 ? $store.state.userInfo.myAllFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span>
              <span>{{ 'RM 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span>
              <span
                :class="$store.state.userInfo.myAllProfitAndLose > 0 ? ' red' : $store.state.userInfo.myAllProfitAndLose < 0 ? ' green' : ''">{{
                    'RM ' + $store.state.userInfo.myAllProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz">{{ 'RM 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz" >{{ 'RM ' + $store.state.userInfo.myEnableAmt }}</span>
          </div>

        </div>
        <div class="yk es">
          <div>
            <span>{{ $t('hj302') }}</span>
          </div>
          <div>
            <span>{{ $t('hj303') }}</span>
          </div>

          <div>
            <span>{{ $t('hj304') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">฿ {{ userInfo.length != 0 ? $store.state.userInfo.thAllFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span >
              <span>{{ '฿ 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span >
              <span
                :class="$store.state.userInfo.thAllProfitAndLose > 0 ? ' red' : $store.state.userInfo.thAllProfitAndLose < 0 ? ' green' : ''">{{
                    '฿ ' + $store.state.userInfo.thAllProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz" >{{ '฿ 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz" >{{ '฿ ' + $store.state.userInfo.thEnableAmt }}</span>
          </div>

        </div> -->
        <div class="yk es">
          <div>
            <span>{{ $t('hj305') }}</span>
          </div>
          <div>
            <span>{{ $t('hj306') }}</span>
          </div>

          <div>
            <span>{{ $t('hj307') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">Rs {{ userInfo.length != 0 ? $store.state.userInfo.inAllFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span>
              <span>{{ 'Rs 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span>
              <span
                :class="$store.state.userInfo.inAllProfitAndLose > 0 ? ' red' : $store.state.userInfo.inAllProfitAndLose < 0 ? ' green' : ''">{{
                    'Rs ' + $store.state.userInfo.inAllProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz" >{{ 'Rs 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz" >{{ 'Rs ' + $store.state.userInfo.inEnableAmt }}</span>
          </div>

        </div>
        <!-- <div class="yk es">
          <div>
            <span>{{ $t('hj308') }}</span>
          </div>
          <div>
            <span>{{ $t('hj309') }}</span>
          </div>

          <div>
            <span>{{ $t('hj310') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">₫ {{ userInfo.length != 0 ? $store.state.userInfo.vnAllFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span>
              <span>{{ '₫ 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span >
              <span
                :class="$store.state.userInfo.vnAllProfitAndLose > 0 ? ' red' : $store.state.userInfo.vnAllProfitAndLose < 0 ? ' green' : ''">{{
                    '₫ ' + $store.state.userInfo.vnAllProfitAndLose
                }}</span>
            </span>
          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz">{{ '₫ 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz">{{ '₫ ' + $store.state.userInfo.vnEnableAmt }}</span>
          </div>

        </div> -->
        <div class="yk es">
          <div>
            <span>{{ $t('hj311') }}</span>
          </div>
          <div>
            <span>{{ $t('hj312') }}</span>
          </div>

          <div>
            <span>{{ $t('hj313') }}</span>
          </div>
        </div>
        <div class="yk as">
          <div>
            <span class="orenge">$ {{ userInfo.length != 0 ? $store.state.userInfo.allFuturesFreezAmt : 0
            }}</span>
          </div>
          <div v-if="userInfo.length == 0">
            <span >
              <span>{{ '$ 0' }}</span>
            </span>
          </div>
          <div v-if="userInfo.length != 0">
            <span>
              <span
                :class="$store.state.userInfo.allFuturesProfitAndLose > 0 ? ' red' : $store.state.userInfo.allFuturesProfitAndLose < 0 ? ' green' : ''">{{
                    '$ ' + $store.state.userInfo.allFuturesProfitAndLose
                }}</span>
            </span>

          </div>

          <div v-if="userInfo.length == 0">
            <span class="bzz" >{{ '$ 0' }}</span>
          </div>
          <div v-if="userInfo.length != 0">
            <span class="bzz">{{ '$ ' + $store.state.userInfo.enableFuturesAmt }}</span>
          </div>

        </div>
        <!-- <div class="btns" @click="handleZh()" :class="selectUserFlag ? '' : 'active'">
          <span>{{ selectUserFlag ? $t('hj291') : $t('hj292') }}</span>
        </div> -->
      </div>
      <div class="memulist">
        <div class="topall">
        <div class="jy" @click="goWall()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/huazhuan2.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj256')}}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
        <div class="jy" @click="goToSettings()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/xiugaimima.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj144') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
        <div class="jy" @click="handleGoToTransfer()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/huazhuan2.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj145') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
        </div>
        <div class="bottomall">
        <div class="jy" @click="handleGoToAuthentication()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/shiming.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj146') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
        <div class="jy" @click="handleGoToBankCard()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/shiming.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj147') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div>
        <!-- <div class="jy" @click="handleDeleteUserClick()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/out2.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj416') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div> -->
        </div>



        <div class="tuichu" @click="handleOutLoginClick()">
          <button>{{ $t('hj148') }}</button>
        </div>


        <!-- <div class="jy" @click="handleOutLoginClick()">
          <div class="left_gn">
            <div class="l_icon">
              <img src="../../assets/img/out2.png" alt />
            </div>
            <div class="r_title">
              <span>{{ $t('hj148') }}</span>
            </div>
          </div>
          <div class="right_gos">
            <img src="../../assets/img/youjiantou.png" alt />
          </div>
        </div> -->
      </div>


    </div>
    <van-popup v-model="settingDialog" position="bottom" :style="{ height: '45%' ,background: '#434343'}">
      <div class="setting_content">
        <div class="old_password">
          <!-- <div class="left_titles">
            <span>{{ $t('hj150') + ':' }}</span>
          </div> -->
          <div class="right_password_input">
            <input type="password" v-model="oldPassword" :placeholder="$t('hj150')"/>
          </div>
        </div>
        <div class="old_password">
          <!-- <div class="left_titles">
            <span>{{ $t('hj151') + ':' }}</span>
          </div> -->
          <div class="right_password_input">
            <input type="password" v-model="newPassword" :placeholder="$t('hj151')"/>
          </div>
        </div>
        <div class="old_password">
          <!-- <div class="left_titles">
            <span>{{ $t('hj152') + ':' }}</span>
          </div> -->
          <div class="right_password_input">
            <input type="password" v-model="cirNewPassword" :placeholder="$t('hj152')"/>
          </div>
        </div>
        <div class="btn_setting" @click="changeLoginPsd()">
          <span>{{ $t('hj153') }}</span>
        </div>
      </div>
    </van-popup>

  </div>
</template>

<script>
import * as api from "@/axios/api";
import { Toast } from "mint-ui";
import { isNull, pwdReg } from "@/utils/utils";
import { MessageBox } from 'mint-ui'


export default {
  name: "newUser",
  data() {
    return {
      name: "大狗子",
      selectUserFlag: true,
      settingDialog: false,
      oldPassword: "", // 旧密码
      newPassword: "", // 新密码
      cirNewPassword: "", //确认新密码
      userInfo: [],
      onlineService: "",
    };
  },
  components: {
  },
  created() {
    this.getUserInfo();
    this.getInfoSite();
  },
  methods: {
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
        Toast(this.$t('hj327'));
      }
    },
    goWall() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      this.$router.push('/wallet')
    },
    // handleZh() {
    //   this.selectUserFlag = !this.selectUserFlag;

    //   if (this.userInfo.length == 0) {
    //     this.$store.commit('dialogVisible', true);
    //     return;
    //   }
    //   if (navigator.vibrate) {
    //     // 支持
    //     navigator.vibrate([55]);
    //   }
    // },
    handleZh() {
      this.selectUserFlag = !this.selectUserFlag;

      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // 判断是否登录
        this.$store.commit('dialogVisible', false);
        this.$store.state.userInfo = data.data;
        this.userInfo = data.data;
      } else {
        this.$store.commit('dialogVisible', true);
      }
    },
    goToTopUp() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
      this.$router.push("/wallet");
    },
    handleOutLoginClick() {
      // 退出登录
      MessageBox.confirm(this.$t('hj149') + '?',this.$t('hj165'), {
        confirmButtonText: this.$t('hj161'),
        cancelButtonText: this.$t('hj106'),
      }).then(() => {
        this.toRegister();
      }).catch(() => {

      });
    },
    //注销
    handleDeleteUserClick(){
      MessageBox.confirm(this.$t('hj417') + '?',this.$t('hj165'), {
        confirmButtonText: this.$t('hj161'),
        cancelButtonText: this.$t('hj106'),
      }).then(() => {
        this.toDelUser();
      }).catch(() => {

      });
    },
    goToSettings() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      // 每次打开dialog 清空密码数据
      this.settingDialog = !this.settingDialog;
      if (this.settingDialog) {
        this.oldPassword = "";
        this.newPassword = "";
        this.cirNewPassword = "";
      }
    },
    handleGoToTransfer() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      this.$router.push("/transfers");
    },
    handleGoToAuthentication() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      this.$router.push("/authentications");
    },
    handleGoToBankCard() {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      this.$router.push("/bankCard");
    },
    async toRegister() {
      // 注销登陆
      window.localStorage.removeItem("USERTOKEN"); // 清空本地存储 USERTOKEN字段
      this.clearCookie();
      let data = await api.logout();
      if (data.status === 0) {
        // Toast(data.msg)
        this.$router.push("/login");
      } else {
        Toast(this.$t('hj327'));
      }
      this.$router.push("/login");
    },
    async toDelUser(){

      let data = await api.delUser();
      if (data.status === 0) {
        window.localStorage.removeItem("USERTOKEN"); // 清空本地存储 USERTOKEN字段
        this.clearCookie();
        Toast(this.$t('hj326'));
        this.$router.push("/login");
      } else {
        Toast(this.$t('hj327'));
      }
      this.$router.push("/login");

    },
    async changeLoginPsd() {
      // 修改密码
      if (
        isNull(this.oldPassword) ||
        isNull(this.newPassword) ||
        isNull(this.cirNewPassword)
      ) {
        Toast(this.$t('hj154'));
        this.settingDialog = false;
      } else if (!pwdReg(this.newPassword)) {
        Toast(this.$t('hj19'));
        this.settingDialog = false;
      } else {
        // 修改密码
        if (this.newPassword === this.cirNewPassword) {
          let opts = {
            oldPwd: this.oldPassword,
            newPwd: this.newPassword
          };
          let data = await api.changePassword(opts);
          if (data.status === 0) {
            this.changeLoginPsdBox = false;
            Toast(this.$t('hj326'));
            this.settingDialog = false;
          } else {
            Toast(this.$t('hj327'));
            this.settingDialog = false;
          }
        } else {
          Toast(this.$t('hj155'));
          this.settingDialog = false;
        }
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    }
  }
};
</script>

<style scoped lang="less">
.green {
  color: #028f52 !important;
}

.red {
  color: #b60c0d !important;
}

.topall{
  margin-bottom: 20px;
}
.tuichu{
  width: 100%;
  height: 230px;
  font-size: 32px;
  button{
    width: 100%;
    height: 65px;
    border-radius: 8px;
    color: #eee;
    background-color: #89B9FF;
    margin:30px auto;
  }

}
.bottomall{
  padding-bottom: 30px;
}

.user_page {
  width: 100%;
  height: calc(100% - 1.3rem);

  .content {
    width: 100%;
    height: 100%;

    .top_icon {
      width: 100%;
      height: 4.5rem;
      display: flex;
      margin: auto;
      justify-content: space-between;
      background: #103E63;
      border-radius: 0 0 120% 120%;
      .moneyinfo{
        margin-top: 50px;
        margin-left: 8%;

        .keyon{
          color: #eee;
        }
        .account{
          color: #fff;
          margin-top: 10px;
          font-size: 36px;
        }
      }

      .right_icon {
        width: 17%;
        height: 60px;
        margin-top: 20px;
        margin-right: 20px;
        display: flex;
        justify-content: flex-end;
        >div {
          width: 50%;
          height: 100%;
          display: flex;
          justify-content: space-between;
          align-items: center;

          img {
            width: 0.6rem;
            height: 0.6rem;
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
            // font-weight: 600;
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
      width: 86%;
      margin: -100px auto;

      // height: 5.3846rem;
      //background-image: linear-gradient(to right bottom, #ffffff, #dfedfc);
      // background-image: linear-gradient(to right, #ffffff , #dfedfc);
      // margin-top: 0.5rem;
      background: #433A4B;
      border-radius: 0.15rem;
      padding: 0.5rem 0.4rem;

      .keyon {
        width: 100%;
        font-size: 0.359rem;
        display: flex;
        align-items: center;
        color: #3d4144;
        font-weight: 600;
        justify-content: center;
        padding-bottom: 0.2rem;

        span {
          // font-weight: 600;
          font-size: 0.6rem;
        }
      }

      .num_price {
        width: 100%;
        // height: 0.6667rem;

        margin-top: 0.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.5528rem;
        padding-bottom: 0.3rem;

        span {
          // font-weight: 600;
        }
      }

      .account {
        font-size: 0.6rem;
        font-weight: 600;
      }

      .yk {
        width: 100%;
        height: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;

        >div {
          width: 33%;
          height: 100%;
          color: #97989d;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .orenge {

          // color: rgb(216, 141, 1) !important;
        }
      }

      .yk.es {
        margin-top: 0.3rem;
      }

      .yk.as {
        font-size: 18px;
        margin-top: 0.1rem;

        span {
          color: #fff;
          // font-weight: 600;
        }

        .bzz {
          // color: #4ea364;
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
          // font-weight: 600;
        }
      }

      .active {
        background: #4ea364;
      }
    }
    .memulist{

      width: 86%;
      margin: 150px auto 0 auto;
    }

    .jy {
      width: 100%;
      height: 1.5rem;
      margin-bottom: 1px;
      background: #434343;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 0.3rem;
      border-radius: 8px;

      .left_gn {
        // width: 40%;
        height: 60%;
        display: flex;

        .l_icon {
          // width: 30%;
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
          // width: 70%;
          height: 100%;
          display: flex;
          align-items: center;
          font-size: 0.4046rem;
          color: #fff;
          padding-left: 0.3rem;

          span {
            // font-weight: 600;
          }
        }
      }

      .right_gos {
        // width: 20%;
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

.setting_content {
  width: 100%;
  height: 5rem;
  padding: 0.3rem;

  .old_password {
    width: 100%;
    height: 1.2rem;

    border-radius: 0.15rem;
    display: flex;
    margin-top: 0.5rem;

    // .left_titles {
    //   width: 25%;
    //   height: 100%;
    //   display: flex;
    //   align-items: center;
    //   padding-left: 0.2rem;
    //   background: #030E1E;
    //   // justify-content: flex-end;
    //   span {
    //     font-weight: 600;
    //   }
    // }

    .right_password_input {
      width: 90%;
      height: 100%;
      margin: auto;
      display: flex;
      align-items: center;

      input {
        width: 100%;
        height: 100%;
        padding-left: 0.2rem;
        background-color: #030E1E;
        border-radius: 0.15rem;
        color: #fff;
      }
    }
  }

  .btn_setting {
    width: 100%;
    height: 1.3rem;
    border-radius: 0.15rem;
    background: #89B9FF;
    color: #000;
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
</style>
