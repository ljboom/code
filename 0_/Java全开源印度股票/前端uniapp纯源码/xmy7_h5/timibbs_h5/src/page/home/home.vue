<template>
  <div class="wrapper">

    <div class="page_content">
      <div class="hometop">
        <div class="midd"></div>
        <div class="top_logo">
          <div class="left_logo">
            <div class="img_logo">
              <img :src="Logo" alt />
              <span class="logotitle">TPGAMC</span>
            </div>
          </div>
          <div class="right_search">
            <div>
              <!-- <div class="service_con" @click="goOnline()">
                <img :src="Service" alt />
              </div> -->
              <van-popover v-model="showPopover" trigger="click" placement="bottom-end" :actions="actions"
                @select="onSelect">
                <template #reference>
                  <img style="width: 21px;height: 21px;" src="@/assets/img/yuyan.svg" />
                </template>
              </van-popover>
            </div>
          </div>
        </div>

        <!-- 公告 -->
        <div class="center_tabs">

          <!-- 顶部轮播图 -->
          <div class="banner_top">
            <van-skeleton title :row="3" :loading="loading" />
            <van-swipe class="my-swipe" :autoplay="5000" indicator-color="white" v-if="!loading">
              <van-swipe-item v-for="(item, index) in bannerList" @click="handleBannerClick(index)" :key="index">
                <img :src="item.bannerUrl" alt />
              </van-swipe-item>
            </van-swipe>
          </div>

          <van-skeleton title :row="1" :loading="loading" />
          <div class="announcement" v-if="!loading && close">
            <div class="an_content" @click="$router.push('/newGg')">
              <div class="an_left_icon">
                <img :src="Announcement" alt />
              </div>
              <div class="an_right_message ">
                <div class="animate">
                  {{ artList? artList.artTitle:""}}
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="center_tabs">



        <!-- 排行入门 -->
        <van-skeleton title :row="2" :loading="loading" />

        <div class="navs" v-if="!loading && close">
          <div class="navs_memu">

             <div class="memulist" v-for="(item, index) in navsArr" :key="index" @click="goJy(index)">
               <div class="top_img">
                  <div class="bgimage">
                    <img :src="item.img" alt />
                  </div>
               </div>
               <div class="bottom_navs">
                 <span>{{ item.title }}</span>
               </div>
             </div>
          </div>

        </div>
        <!-- 最多关注 -->
        <van-skeleton title :row="6" :loading="loading" class="focus_skeleton" />
        <div class="focus_on" v-if="!loading">
          <div class="fo_contentnew">
            <div class="top_titlenew">
              {{ $t('hj5') }}
            </div>
            <div class="fo_banner">
              <van-swipe class="fo_my-swipe" :autoplay="0" indicator-color="white" @change="onChange">
                <!-- <van-swipe-item v-for="(item, index)  in proData" :key="index">
                  <div class="item_cont" v-for="(item2, idx) in proData[currentIndex]" :key="idx">
                    <div class="top_fo" style="width: 80%;">
                      <div class="title" style="width: 30%;">
                        <span>{{ item2.f14 }}</span>
                      </div>
                      <div class="percentage"  :class="item2.f3 > 0 ? 'gree' : 'redd'">

                        <span>{{ item2.f3 > 0 ? `+${item2.f3}%` : `${item2.f3}%` }}</span>
                      </div>
                      <div class="percentage"></div>
                      <div class="percentage" style="width: 38%;position: absolute;right: 0;top: 5%;height: 80%;" :class="item2.f3 > 0 ? 'gree' : 'redd'">
                         <echart :colorType="item2.f3" :ids="idx+'1'+index"></echart>
                      </div>
                    </div>
                    <div class="bottom_fo" style="width: 80%;">
                      <div class="title"style="width: 30%;">
                        <span style="margin-right: 0.12rem;">{{ item2.f12 }}</span>
                        <img v-for="item in getHuo()" :src="Huo" alt style="width: 0.4rem;height: 0.4rem;" />
                      </div>
                      <div  class="percentage" >

                        <span>{{ item2.f2 }}</span>
                      </div>
                      <div class="percentage">
                        <span></span>
                      </div>
                    </div>
                  </div>
                </van-swipe-item> -->
                <van-swipe-item v-for="(item, index)  in proData" :key="index">
                  <div class="item_cont" :class="idx != 2 ? 'item_conts' : ''"
                    v-for="(item2, idx) in proData[currentIndex]" :key="idx" @click="goDetail(item2)">
                    <div class="top_fo">
                      <div class="title">
                        {{ item2.code}}
                      </div>
                      <div class="numbers">
                        {{ item2.nowPrice }}
                      </div>
                      <div class="percentage" :class="item2.hcrate > 0 ? 'gree' : 'redd'">
                        <span style="font-weight: 500;">{{ item2.hcrate > 0 ? `${item2.hcrate}` :
                            `${item2.hcrate}`
                        }}</span>
                      </div>
                    </div>
                    <div class="bottom_fo">
                      <div class="title">
                        <span class="numberid" style="margin-right: 0.12rem;">{{ item2.gid }}</span>
                        <!-- <div v-for="(items, indexs) in Number(item2.pnum.slice(0, 1))"
                          style="width: 0.4rem;height: 0.4rem;display: flex;">
                          <img v-if="indexs < 3" :src="Huo" alt style="width: 0.4rem;height: 0.4rem;" />
                        </div> -->

                      </div>
                      <div class="numbers" :class="item2.floatPoint > 0 ? 'gree' : 'redd'">
                        <img :src="Huo" alt style="width: 0.4rem;height: 0.4rem;" />
                        <span class="point" style="height: 0.4rem;">{{ item2.pnum
                        }}</span>
                      </div>
                      <div class="percentage">
                        <!-- <span class="aikesi">100X</span> -->
                        <el-tag key="100X"
                          style="width: 80%;text-align: center;height: 0.45rem!important;line-height: 0.45rem!important;">
                          {{ 100 + 'X' }}
                        </el-tag>
                      </div>
                    </div>
                  </div>
                </van-swipe-item>
              </van-swipe>
            </div>
          </div>
        </div>

      </div>
      <van-skeleton title :row="18" :loading="loading" />
      <div class="news-tabnew">
        <mt-navbar v-model="news">
          <mt-tab-item id="tab_0">
            <span class="tab-name">{{ $t('hj6') }}</span>
          </mt-tab-item>
          <mt-tab-item id="tab_1">
            <span class="tab-name">{{ $t('hj7') }}</span>
          </mt-tab-item>
          <mt-tab-item id="tab_2">
            <span class="tab-name">7×24</span>
          </mt-tab-item>
        </mt-navbar>
        <mt-tab-container v-model="news" :swipeable="true" style="padding-top: 0.5rem;">
          <mt-tab-container-item id="tab_0">
            <div class="news-content">
              <div class="" v-for="(item, inde) in newsContent1" :key="inde" @click="$router.push({
                path: '/newPage', query: {
                  listid: item.id
                }
              })">
                <div class="newdetail">
                <div class="newtext">
                  <!-- <div class="neitu"><img :src="item.imgurl" /></div> -->
                  <div class="titContentnew" style="-webkit-box-orient: vertical;font-size: 0.38rem;margin-top: 0.2rem;padding-top: 0.5rem;">
                    {{ item.title }}
                  </div>
                  <div class="block-out">
                    <div class="blocks">{{ item.sourceName }}</div>
                    <div class="item-times">{{ item.addTime | gettime }}</div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </mt-tab-container-item>
          <mt-tab-container-item id="tab_1">
            <div class="news-content">
              <div class="item-out" v-for="(item, inde) in newsContent4" :key="inde" @click="$router.push({
                path: '/newPage', query: {
                  listid: item.id
                }
              })">
                <div class="item-times">{{ item.addTime | gettime }}</div>
                <div class="titContentnew" style="-webkit-box-orient: vertical;">{{ item.title }}</div>
              </div>
            </div>
          </mt-tab-container-item>
          <mt-tab-container-item id="tab_2">
            <div class="news-content">
              <div class="item-out" v-for="(item, inde) in newsContent3" :key="inde" @click="$router.push({
                path: '/newPage', query: {
                  listid: item.id
                }
              })">
                <div class="item-times">{{ item.addTime | gettime }}</div>
                <div class="titContentnew" style="-webkit-box-orient: vertical;">{{ item.title }}</div>
              </div>
            </div>
          </mt-tab-container-item>
        </mt-tab-container>
      </div>
    </div>
    <!-- tab -->
    <GoToLogin v-show="isGoTo" />
  </div>
</template>
<script>
import AllList from "@/page/list/list-all";
import HomeList from "./components/home-list";
import Echart from "./components/echart.vue";
import * as api from "@/axios/api";
import Logo from "@/assets/img/eslogo.svg";
import Searchs from "@/assets/ico/leng.png";
import Service from "@/assets/img/kefu.svg";
import clear from "@/assets/home/close.png";
import Announcement from "@/assets/img/black_laba.svg";
import Tops from "@/assets/home/hq.svg";
import Rumen from "@/assets/home/cc.svg";
import Xuexi from "@/assets/home/ipo.svg";
import Guanyu from "@/assets/home/mine.svg";
import dazong from "@/assets/home/5.png";
import vip from "@/assets/home/6.png";
import Huo from "@/assets/home/huo.png";
import banner1 from "@/assets/img/b1.png";
import banner2 from "@/assets/img/b2.png";
import banner3 from "@/assets/img/b3.png";
// import indexData from "./data.json";
import GoToLogin from '@/page/home/components/GoLogin.vue';
import { MessageBox } from 'mint-ui'
export default {
  components: {
    HomeList,
    AllList,
    GoToLogin,
    Echart,
  },
  props: {},
  data() {
    return {
      Logo,
      Searchs,
      Service,
      clear,
      Announcement,
      indexData: [],
      Huo,
      is_login: false,
      loading: true,
      close: true,
      proData: [], // 分割好的数据
      currentIndex: 0,
      bannerImgsArr: [{
        img: banner1
      }, {
        img: banner2
      }, {
        img: banner3
      }],
      announcementMess: "20202/10 - 交易时间安排",

      artList: [],
      news: "tab_0",
      newsContent1: [],
      newsContent2: [],
      newsContent3: [],
      newsContent4: [],
      onlineService: "",
      isGoTo: false,
      bannerList: [],
      userInfo: [],
      showPopover: false,
      actions: [
        // { text: '简体中文', icon: require('@/assets/ico/Chinese.png') , lang: 'zh-CN'},
      //{ text: '繁體中文', icon: require('@/assets/ico/tw.png'), lang: 'tww' },
      { text: 'English', icon: require('@/assets/ico/english.png'), lang: 'en' },
     // { text: 'แบบไทย', icon: require('@/assets/ico/taiguo.jpg'), lang: 'th' }
	 { text: 'हिंदी', icon: require('@/assets/ico/yindu.png'), lang: 'in' }
      ],
    };
  },
  computed:{
    navsArr(){
      return [{
        img: Tops,
        title: this.$t('hj1'),
      },
      {
        img: Rumen,
        title: this.$t('hj2'),
      },
      {
        img: Xuexi,
        title: this.$t('hj3'),
      },
      {
        img: Guanyu,
        title: this.$t('hj4'),
      },
      {
        img: dazong,
        title: this.$t('hj261'),
      },
     // {
      //  img: vip,
      //  title: this.$t('hj279'),
     // },

      ]
    }
  },
  methods: {
    getdialog() {
      MessageBox.confirm(this.$t('hj252'), this.$t('hj165'), {
          confirmButtonText: this.$t('hj161'),
          cancelButtonText: this.$t('hj106'),
        }).then(async () => {

        }).catch(() => {

        });
        // MessageBox.confirm('老号被盗请勿转账,请认准新tg：@BEINL2', this.$t('hj165'), {
        //   confirmButtonText: this.$t('hj161'),
        //   cancelButtonText: this.$t('hj106'),
        // }).then(async () => {

        // }).catch(() => {

        // });
    },
    onSelect(e){
      this.$i18n.locale = e.lang;
      window.localStorage.setItem('language', e.lang);
      this.getNewsList(1)
      this.getNewsList(3)
      this.getNewsList(4)
    },
    async getUserInfo() {
      let opt = {
        stockType: 'th'
      };
      // 获取用户信息
      let data = await api.getUserInfo();
      if (data.status === 0) {
        // 判断是否登录
        this.$store.state.userInfo = data.data;
        this.userInfo = data.data;
      } else {
      }
    },
    getHuo() {
      //123随机
      var num = Math.floor(Math.random() * 3 + 1);
      return num;
    },
    //构造随机数列表  50 100 200
    getNum1(num) {
      if (num == 1) {
        return 50;
      } else if (num == 2) {
        return 100;
      } else if (num >= 3) {
        return 200;
      }
    },
    goDetail(item) {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      this.$router.push({
        path: "/kline",
        // query: {
        //   name: item.name,
        //   stockplate: item.stock_plate,
        //   code: item.symbol.substring(2, item.symbol.length),
        //   type: item.market,
        //   sok: this.filterSH(item.market),
        //   if_zhishu: '0',
        // },
        query: {
          pid: item.data_base,
          name: item.name,
          code: item.code,
          if_zhishu: "0",
          sok: item.type ? item.type : this.filterSH(item.stock_type),
          type: item.stock_type,
          gid:item.stock_type+item.data_base,
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
    goJy(index) {
      if (this.userInfo.length == 0) {
        this.$store.commit('dialogVisible', true);
        return;
      }
      switch (index) {
        case 0:
          this.$router.push('/trading-list');
          break;
        case 1:
          this.$router.push('/warehouse');
          break;
        case 2:
          this.$router.push({ path: '/trading-list', query: { listid: 6 } });
          break;
        case 3:
          this.$router.push('/user');
          break;
         case 4:
          this.$router.push('/Subscription?idx=1');
          break;
         case 5:
          this.$router.push('/Subscription?idx=2');
          break;
        default:
          break;
      }
      if (navigator.vibrate) {
        // 支持
        navigator.vibrate([55]);
      }
    },
    async getBanner() {
      // 获取显示的banner
      let result = await api.getBannerByPlat({ platType: 'm' })
      if (result.status === 0) {
        this.bannerList = result.data
      } else {
        this.$store.commit('elAlertShow', { 'elAlertShow': true, 'elAlertText': result.msg });
      }
    },
    goOnline() {
      this.$router.push('/service');
    },
    async getArtList() {
      let data = await api.getArtList();
      if (data.status == 0) {
        this.artList = data.data.list[0];
      }
    },
    async getInfoSite() {

      let data = await api.getInfoSite()
      if (data.status === 0) {
        this.onlineService = data.data.onlineService
      } else {
        this.$store.commit('elAlertShow', { 'elAlertShow': true, 'elAlertText': data.msg });
      }
    },
    async getStock() {
      let data = await api.getIndexMarket();
      for (var i = 0; i < data.data.list.length; i += 3) {

        this.proData.push(data.data.list.slice(i, i + 3));
      }
//console.log(this.proData)
    },
    async getNewsList(type) {
      let data = await api.queryNewsList(type);

      switch (type) {
        case 1:
          this.newsContent1 = data.data.list
          break;
        case 2:
          this.newsContent2 = data.data.list
          break;
        case 3:
          this.newsContent3 = data.data.list
          break;
        case 4:
          this.newsContent4 = data.data.list
          break;
        case 5:
          this.newsContent5 = data.data.list
          break;
      }
    },
    handleBannerClick(ind) {
      // console.log(ind);
    },
    ProcessData() {
      // 把数据分割成三等份
      // for (var i = 0; i < this.indexData.data.diff.length; i += 3) {
      //   this.proData.push(this.indexData.data.diff.slice(i, i + 3));
      // }
    },
    onChange(index) {
      this.currentIndex = index;
      this.proData[index].forEach(item => {

      });

    },
    handleSearchClick() {
      //this.loading = !this.loading;
      this.$router.push({ path: "/trading-list", query: { type: 1 } });
    }
  },
  filters: {
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
      return y + "-" + mm + "-" + d + " " + h + ":" + m + ":" + c;
    }
  },
  created() {
    // this.getdialog()
    this.ProcessData();
  },
  mounted() {
    this.getUserInfo();
    this.getInfoSite();
    this.getNewsList(1);
    this.getNewsList(3);
    this.getNewsList(4);
    this.getStock();
    this.getArtList();
    this.getBanner()


    setInterval(() => {
      if (window.localStorage.getItem('USERTOKEN')) {
        this.isGoTo = false;
      } else {
        this.isGoTo = !this.isGoTo
      }
    }, 50000);

    setTimeout(() => {
      this.loading = false
    }, 100)

  }
};
</script>
<style lang="less" scoped>
.midd{
  height: .5128rem;
}
.wrapper {
  width: 100%;
  height: 100%;

  //padding-top: .3128rem;

  .page_content {
    width: 100%;
    height: 100%;
  }
}
.navs_memu{
  width: 95%;
  height: 100%;
  margin: auto;
  color: #fff;
  display: flex;
  flex-direction:row;
  flex-wrap: wrap;
  .memulist{
    width: 25%;
    margin-top: 1px;
    .top_img{
      width: 100%;
      margin-bottom:8px;
      text-align: center;
      .bgimage{
        width: 76px;
        height: 76px;
        // background: #103E63;
        border-radius:100%;
        margin: auto;
        >img{
          width: 56px;
          height: 56px;
          margin-top: 15px;
        }
      }
    }
    .bottom_navs{
      text-align: center;
    }


  }

}
.hometop{
   // background: #103E63;
   // border-radius: 0 0 50% 50%;
}
.top_logo {
  width: 100%;
  height: 0.7949rem;

  display: flex;
  padding-right: 0.3rem;
  >div {
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .img_logo {
    width: 40px;
    height: 40px;
    margin-left: 0.3846rem;
    display: flex;
    .logotitle{
      margin-left: 2px;
      line-height: 40px;
      font-size: 40px;
      background: linear-gradient(93deg, #D33935 0%, #468CC9 100%);
      //background: linear-gradient(90deg, #BD3627 0%, #D96337 100%);
      // background: linear-gradient(85deg, #1E90FF 0%, #1E83F4 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: bold;
    }

    >img {
      width: 100%;
      height: 100%;
    }
  }

  .right_search {
    justify-content: flex-end;
    width: 50%;
    >div {
      width: 20%;
      height: 0.4615rem;
      display: flex;
      justify-content: space-between;


      >div {
        width: 0.5615rem;
        height: 0.5615rem;

        >img {
          width: 100%;
          height: 100%;
        }
      }
    }
  }
}

.center_tabs {
  width: 100%;
  height: auto;
  margin-top: 0.6308rem;

  >.banner_top {
    width: 100%;
    img {
      width: 100%;
      height: 100%;
    }

    .van-swipe-item {
      height: 4.8615rem;
      padding: 0 0.264rem;
      border-radius: 0.3rem;
    }

    .van-swipe-item img {
      border-radius: 0.3rem;
    }
  }

  >.announcement {
    width: 100%;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.5rem 0 0.5rem 0;

    >.an_content {
      width: 95%;
      height: 0.559rem;
      display: flex;
      justify-content: space-between;
      align-items: center;

      .an_left_icon {
        width: 4%;
        height: 70%;
        display: flex;
        align-items: center;

        >img {
          width: 100%;
          height: 100%;
        }
      }

      .an_right_message {
        width: 93%;
        height: 100%;
        line-height: 0.559rem;
        align-items: center;
        align-content: center;
        font-size: 0.29rem;
        white-space: nowrap;
        overflow: hidden;
        // text-overflow:ellipsis;
      }
    }
  }

  .navs {
    width: 100%;
    //height: 5.6154rem;
    //height: 2.5rem;
    height: 3.8rem;

    display: flex;
    justify-content: center;


    >.navs_content {
      position: relative;
      overflow: hidden;
      width: 95%;
      height: 100%;
      margin: 0 auto;
      border-radius: 0.2564rem;
      display: flex;
      justify-content: space-between;

      >.chacha {
        width: 1rem;
        height: 1rem;
        border-radius: 100%;
        background-color: rgb(210, 210, 212);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: absolute;
        right: -0.4rem;
        top: -0.4rem;

        >div {
          width: 0.3554rem;
          height: 0.3554rem;
          margin-top: 0.3rem;
          margin-left: 0.15rem;

          >img {
            width: 100%;
            height: 100%;
          }
        }

      }

      >div {
        width: 16%;
        height: 100%;
        display: flex;
        align-items: center;

        >div {
          width: 100%;
          height: 60%;

          >.top_img {
            width: 100%;
            height: 70%;
            display: flex;
            align-items: center;
            justify-content: center;

            >div {
              width: 0.9718rem;
              height: 0.9718rem;

              >img {
                width: 100%;
                height: 100%;
              }
            }
          }

          >.bottom_navs {
            width: 100%;
            height: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.33rem;
            margin-top: 0.15rem;
          }
        }
      }
    }
  }

  .focus_on {
    width: 100%;
    height: 6.4231rem;
    margin-top: 0.2564rem;
    display: flex;
    align-items: center;
    justify-content: center;


    .fo_content,.fo_contentnew {
      width: 95%;
      height: 100%;
      padding: 0 0.2564rem;
      border-radius: 0.2564rem;
      padding-top: 0.2rem;

      .top_title,.top_titlenew {
        width: 100%;
        height: 0.8821rem;
        display: flex;
        font-size: 0.4rem;
        font-weight: 800;
        align-items: center;
        color: #fff;
      }
    }

    /deep/.van-swipe__indicators {
      bottom: 0.1rem;
    }

    /deep/.van-swipe__indicator {
      background-color: #2d8cf0 !important;
      opacity: 1;
    }

    /deep/.van-swipe__indicator--active {
      width: 0.35rem !important;
      border-radius: 0.23rem;
      background-color: #aec7ec !important;
    }

    .fo_banner {
      width: 100%;
      height: calc(100% - .8821rem - 0.3rem);
      margin-top: 20px;
    }
  }

  .item_cont {
    width: 100%;
    height: 1.5385rem;
    border-bottom: 0.5px solid #ececec;
    position: relative;
    border: none;
    display: flex;
    flex-wrap: wrap;
    align-content: center;

    >div {
      width: 100%;
      height: 30%;
    }

    .top_fo,
    .bottom_fo {
      display: flex;
      justify-content: space-between;

      span {
        display: inline-block;
      }

      .title {
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        font-weight: bold;

      }

      .aikesi {
        width: auto;
        height: 0.3rem;
        background: #dbe3f0;
        color: #546daf;
        padding-left: 0.2rem;
        padding-right: 0.2rem;
        font-size: 0.15rem;
        line-height: 0.3rem;
        margin-right: 0.1rem;
      }

      .numberid {
        font-size: 0.28rem;
        display: flex;

        line-height: 0.5rem;
      }

      .numbers {
        width: 20%;
        height: 100%;
        display: flex;
        align-items: center;

      }

      .point {
        font-size: 0.28rem;
        height: 0.5rem;
        line-height: 0.5rem;
      }

      .percentage {
        width: 20%;
        height: 100%;
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
      }

      .percentage span {
        height: 0.5rem;
        line-height: 0.5rem;
      }
    }

    .top_fo {
      font-size: 0.3846rem !important;
      color: #fff;
    }

    .bottom_fo {
      margin-top: 0.1rem;
      font-size: 0.1846rem;
      color: #999898;
    }

    .percentage.gree {
      color: green !important;
    }

    .percentage.redd {
      color: red !important;
    }
  }
}

.item_conts::after {
  content: "";
  position: absolute;
  bottom: 0;
  background: #ececec;
  width: 100%;
  height: 1px;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
}

.my-swipe .van-swipe-item {

  font-size: 0.5128rem;
  line-height: 3.8462rem;
  text-align: center;
  overflow: hidden;
}

.fo_my-swipe .van-swipe-item {

  font-size: 0.5128rem;
  line-height: 3.8462rem;
  overflow: hidden;
}

.fo_my-swipe {
  width: 100%;
  height: 100%;
}

.focus_skeleton {
  margin-top: 1rem;
}

.van-skeleton__row,
.van-skeleton__title {
  height: .7rem;
}

.news-tab,.news-tabnew {
  width: 95%;
  position: relative;
  left: 0;
  right: 0;
  margin: auto;
  margin-top: 0.6rem;
  border-radius: 0.4rem 0.4rem 0 0;
  padding-top: 0.3rem;
  padding-bottom: 120px;

  /deep/.is-selected .tab-name {
    position: relative;
  }

  /deep/.mint-navbar .mint-tab-item.is-selected {
    border: 0 !important;
    border-bottom: none;
    background: #89B9FF !important;
    border-radius: 100px !important;
    .mint-tab-item-label{
      color: #fff !important;
    }
  }
  /deep/.mint-navbar {
    background: #030E1E !important;
    border-radius: 100px !important;
  }
  /deep/.mint-tab-item{

    background: #030E1E !important;
  }
  /deep/.mint-tab-item-label{
    color: #fff !important;
  }

  /deep/.is-selected .tab-name:after {
    position: absolute;
    display: block;
    content: '';
    height: .07rem;
    background-color: #1381A4;
    width: 100%;
    left: 0;
    bottom: -.25rem;
  }
}

.news-content {

  position: relative;
  padding: 0.3rem;
  color:#fff;
}
.newdetail{
  background: #2A2F3D;
  margin-bottom: 20px;
  border-radius: 25px;
}
.newtext{
  width: 90%;
  margin: auto;
}

.item-out {
  position: relative;
  border-left: 0.01rem solid rgba(192, 192, 192, 0.8);
  padding: 0 0.25rem 1rem 0.25rem;
}

.item-out::before {
  content: "●";
  position: absolute;
  top: -0.1rem;
  left: -0.128rem;
  margin: auto;
}

.item-times {
  color: #999;
  margin-bottom: 0.15rem;
  padding-top: 30px;
}

.titContent,.titContentnew {
  position: relative;
  font-size: .35rem;
  line-height: .46rem;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-line-clamp: 2;
  display: -webkit-box;
}

.neitu {
  width: 100%;
  border-radius: 25px;

  margin-bottom: 0.8rem;
}

.neitu img {
  width: 100%;
  margin-top: 30px;
  border-radius: 25px;
}

.block-out {
  margin-top: 0.2rem;
  padding-bottom: 20px;
  display: flex;
  justify-content:space-between;
}

.blocks {
  width: 48%;
  font-size: 0.32rem;
  padding: 0.08rem 0.15rem 0.08rem 0.15rem;
  display: inline-block;
  // border: 0.0513rem solid #41AC75;
  color: #41AC75;
}

.animate {

  padding-left: 20px;

  font-size: 0.29rem;

  color: #fff;

  display: inline-block;

  white-space: nowrap;

  animation: 10s wordsLoop linear infinite normal;

}



@keyframes wordsLoop {

  0% {

    transform: translateX(100%);

    -webkit-transform: translateX(100%);

  }

  100% {

    transform: translateX(-100%);

    -webkit-transform: translateX(-100%);

  }

}



@-webkit-keyframes wordsLoop {

  0% {

    transform: translateX(100%);

    -webkit-transform: translateX(100%);

  }

  100% {

    transform: translateX(-100%);

    -webkit-transform: translateX(-100%);

  }

}

</style>
