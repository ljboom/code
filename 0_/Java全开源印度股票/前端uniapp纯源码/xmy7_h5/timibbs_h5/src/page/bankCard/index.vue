<template>
  <div class="bank_card_page">
    <div class="content">
      <div class="top_back">
        <div class="left_back_icon" @click="$router.go(-1)">
          <img src="../../assets/img/back.svg" alt />
        </div>
      </div>

      <div class="bankinfo" v-show="!addBank">
        <ul class="table-list" v-infinite-scroll="loadMore" infinite-scroll-disabled="loading"
          infinite-scroll-distance="10">
          <li class="list-body" v-for="(item) in bankList" :key="item.id">
            <div class="order-info-box">
              <div class="typepay">
                <span :class="['main', item.payChannel == 0 ? 'ali' : item.payChannel == 1 ? 'cart' : 'wechat']">
                  {{ item.payChannel == 0 ? $t('hj229') : item.type == 1 ? $t('hj332') : $t('hj333') }}
                </span>
              </div>
              <div class="order-title">
                <span class="payNumber">{{$t('hj325')}}：<span :style="{ color: $state.theme == 'red' ? '#07F8B5' : '' }">{{
                    item.bankNo
                }}</span></span>
                <span class="red pull-right" @click="delBankInfo(item.id)">
                  <button>{{$t('hj334')}}</button>
                </span>

              </div>
              <div class="order-info">
                <span class="payNumber">{{$t('hj195')}}：<span >{{
                    item.bankAddress
                }}</span></span>
              </div>
              <div class="order-info">
                <span class="payNumber">{{$t('MingCheng')}}：<span >{{
                    item.bankName
                }}</span></span>
              </div>
            </div>
          </li>
        </ul>
        <div class="addbank"  @click="toAdd()">
          <button>{{$t('hj335')}}</button>
        </div>
      </div>


      <div class="addbankinfo" v-show="addBank">
        <div class="bank_name">
           <div class="lefts">
             <span>{{ $t('hj336') }}</span>
           </div>
          <div class="rights">
            <select name="type" @change="getType($event.target.value)">
              <option value="1">{{$t('hj332')}}</option>
              <option value="2">{{$t('hj333')}}</option>
            </select>
           </div>
         </div>
        <div class="bank_name" >
           <div class="lefts">
             <span v-if="type==1">{{ $t('hj213') }}</span>
             <span v-else>{{ $t('hj358') }}</span>
           </div>
          <div class="rights">
             <input type="text"  v-model="bankName"/>
           </div>
         </div>
        <div class="bank_name" v-if="type==1">
           <div class="lefts">
             <span>{{ $t('hj195') }}</span>
           </div>
           <div class="rights">
             <input type="text"  v-model="bankAddress" />
           </div>
         </div>
         <div class="bank_name">
           <div class="lefts">
             <span v-if="type==1">{{ $t('hj215') }}</span>
             <span v-else>{{ $t('hj359') }}</span>
           </div>
           <div class="rights">
             <input type="text"  v-model="bankNo"/>
           </div>
         </div>
         <div class="bank_name bind" @click="toSure()" v-if="addBank">
           <span>{{ $t('hj216') }}</span>
         </div>
      </div>
      <div class="bank_hck"></div>
      <div class="bank_code"></div>
    </div>
  </div>
</template>

<script>
import * as api from "@/axios/api";
import { Toast } from "mint-ui";
import { isNull, bankNoReg, isName } from '@/utils/utils'

export default {
  name: "bankCard",
  data() {
    return {
      bankName: "", //银行名称,
      bankAddress: "", //需要精确到分行或者支行,
      bankNo: "", // 印象卡号
      addBank: false,
      bankList:[],
      type:1
    };
  },
  created() {
    this.getCardDetail();
  },
  methods: {
    toAdd(){
      this.addBank = true;
    },
    getType(value){
      this.type = value
    },
    async delBankInfo(id){
      let opts = {
        id:id
      }
      let data = await api.delBankCard(opts);
      if (data.status === 0) {
        Toast(this.$t("hj337"));
        this.$router.push("/bankCard");
      } else {
        Toast(this.$t('hj327'));
      }

    },
    async toSure() {
      // 添加银行卡
      if (isNull(this.bankNo)) {
        Toast(this.$t("hj217"));
      } else if (isNull(this.bankName) && this.type==1) {
        Toast(this.$t("hj218"));
      } else if (isNull(this.bankAddress) && this.type==1) {
        Toast(this.$t("hj219"));
      } else {
        let opts = {
          bankName: this.bankName,
          bankNo: this.bankNo,
          bankAddress: this.bankAddress,
          type:this.type
        };
        let data = await api.addBankCard(opts);
        if (data.status === 0) {
          Toast(this.$t("hj220"));
          this.$router.push("/newUser");
        } else {
          Toast(this.$t('hj327'));
        }
      }
    },
    async getCardDetail() {
      // 获取银行卡信息
      let data = await api.getBankList();
      if (data.status === 0) {
        this.bankList = data.data;
        this.addBank = false;
      } else {
        this.addBank = true;
      }
    },
    // async getCardDetail() {
    //   // 获取银行卡信息
    //   let data = await api.getBankCard()
    //   if (data.status === 0) {
    //     const { bankAddress, bankName, bankNo } = data.data;
    //     this.bankAddress = bankAddress;
    //     this.bankName = bankName;
    //     this.bankNo = bankNo;
    //     this.addBank = false;
    //   } else {
    //     this.addBank = true;
    //   }
    // },
  }
};
</script>

<style scoped lang="less">

  .addbank{
    width: 90%;
    height: 60px;
    margin:120px auto;

    >button{
      width: 100%;
      height: 100%;
      border-radius: 8px;
      color: #fff;
      font-size: 22px;
      background-color: rgba(137, 185, 255, 1);
    }
  }

.table-list {


  .list-body {
    width: 100%;
    height: 3rem;
    padding: 0.1rem 0.3rem;
    margin: 10px auto;
    background: #434343;
    border-radius: 8px;


    .pull-right{

      >button{
        width: 80px;
        border: 0;
        background-color: #CD5C5C;
        color: #fff;
      }
    }

    // .capital:nth-child(1) {
    //   border-top: 0.01rem solid #3f444a;
    // }
    .order-info-box{
      background-color: #434343;
      padding-top: 20px;
      .order-title{
        border-bottom: 0;
      }
    }
    .capital {
      padding: 0.2rem;
      // border-radius: 0.2rem;
      //border-bottom: 0.01rem solid #3f444a;

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
  font-size: 0.24rem;
  font-weight: bold;

  span {
    font-family: lightnumber;
  }
}


.bank_card_page {
  width: 100%;
  height: 100%;

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
      color: #fff;
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
    // background: rgb(247, 247, 247);
    border-radius: 0.2rem;
    margin-top: 0.3rem;
    background: #030E1E;
    border-radius: 8px;
    opacity: 1;
    border: 1px solid rgba(255,255,255,0.3);

    .lefts {
      width: 25%;
      height: 100%;
      display: flex;
      align-items: center;
      font-size: 0.3846rem;
      color: #fff;
      opacity: 0.5;

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
      color: #fff;
      select{
        width: 100%;
        height: 80%;
        background-color: #030E1E;
        border: 0;
      }

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
  // background: #2d6ae9;
  font-size: 0.4103rem;
  color: #fff;

  span {
    font-weight: 600;
  }
}
</style>
