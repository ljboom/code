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
        {{$t('hj313')}}
      </div>

    </div>

    <!-- end -->

    <van-form @submit="onSubmit">
      <van-field
        readonly
        clickable
        name="picker"
        :value="formData.market"
        :label="$t('hj62')"
        :placeholder="$t('hj314')"
        @click="showPicker = true"
      />
      <van-popup v-model="showPicker" position="bottom">
        <van-picker
          show-toolbar
          :columns="columns"
          @confirm="onConfirm"
          @cancel="showPicker = false"
        />
      </van-popup>


      <van-field name="bankType" :label="this.$t('hj315')" v-show="typeShow">
        <template #input>
          <van-radio-group v-model="formData.bankType" direction="horizontal" @change="selectWithdrawFun">
            <van-radio name="1" v-show="bankField">{{$t('hj316')}}</van-radio>
            <van-radio name="2" v-show="usdtField">USDT</van-radio>
          </van-radio-group>
        </template>
      </van-field>

      <!-- 银行信息 -->
      <div v-if="this.formData.bankType == 1">
          <van-field
            v-model="formData.accountName"
            required
            name="accountName"
            :label="this.$t('hj317')"
            :placeholder="this.$t('hj318')"
          />
          <van-field
            v-model="formData.bankName"
            required
            name="bankName"
            :label="this.$t('hj213')"
            :placeholder="this.$t('hj218')"
          />
          <van-field
            v-model="formData.bankAddress"
            required
            name="bankAddress"
            :label="this.$t('hj214')"
            :placeholder="this.$t('hj219')"
          />
          <van-field
            v-model="formData.bankNo"
            required
            name="bankNo"
           :label="this.$t('hj215')"
           :placeholder="this.$t('hj217')"
          />
      </div>
      <!-- end -->

      <!-- USDT信息 -->

      <div v-if="this.formData.bankType == 2">

        <van-field
          value="USDT TetherUS"
          required
          readonly
          name="currencyName"
          :label="this.$t('hj319')"
          :placeholder="this.$t('hj320')"
        />

        <van-field name="networkType" :label="this.$t('hj321')" >
          <template #input>
            <van-radio-group v-model="networkType" >
              <van-radio name="trc20">TRX Tron (TRC20)</van-radio>
              <van-radio name="erc20">ETH Ethereum (ERC20)</van-radio>
            </van-radio-group>
          </template>
        </van-field>

        <van-field
          v-model="usdtAddress"
          required
          name="usdtAddress"
          :label="this.$t('hj322')"
          :placeholder="this.$t('hj323')"
        />

      </div>

      <!-- end -->

      <div style="margin: 16px;">
        <van-button round block type="info" native-type="submit">{{$t('hj216')}}</van-button>
        <van-button round block type="primary" native-type="button" style="margin-top: 0.3rem;" @click="$router.go(-1)">{{$t('hj106')}}</van-button>
      </div>
    </van-form>

    <!-- <div>
      <h1>{{ $route.params.id }}</h1>
    </div> -->


  </div>

</template>

<script>
import * as api from "@/axios/api";
import { Toast } from "mint-ui";

export default {
  name: "editBank",
  data() {
    return {
      typeShow: false,
      bankField: true,
      usdtField: true,
      formData: {
        marketType:'',
        accountName:'',
        bankName:'',
        bankAddress:'',
        bankNo:'',
        market: '',
        bankType:'',
        networkType:'',
        currencyName:'',
        usdtAddress:'',
      },
      columnsCode: ["USD", "HKD", "MYR", "THB", "INR"],
      columns: [this.$t('hj277'), this.$t('hj278'), this.$t('hj279'), this.$t('hj280'), this.$t('hj283')],
      showPicker: false,
    };
  },
  created() {
  },
  methods:{
    selectWithdrawFun(obj){
      console.log(obj)
    },
    onConfirm(value, index) {
      this.typeShow = true;
      if(index != 0){
        this.usdtField = false;
      }
      this.formData.market = value;
      this.formData.marketType = this.columnsCode[index];
      this.showPicker = false
    },
    async onSubmit(obj){

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
  background: rgb(241,242,246);

  .van-cell {
    line-height: 0.9rem;
  }

  .van-radio {
    margin-top: 0.25rem;
  }

  /deep/ .van-field__label{
    width: 10em;
  }

  .top_icon{
    width: 100%;
    height: 1.3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    & .left_back{
      width: 10%;
      height: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      & img{
        width: 0.6rem;
        height: 0.6rem;
      }
    }
    & .title{
      width: calc(100% + 2rem);
      text-align: center;
      font-size: 0.4rem;
    }
    & .right_icon{
      width: auto;
      height: 35%;
      padding-right: 0.1rem;
      display: flex;
      justify-content: space-between;
      & > div{
        width: auto;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        & img{
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

  .bank-list{
    width: 100%;
    height: auto;
    margin-top: 0.2rem;

    .bank-item{
      float: left;
      width: 95%;
      margin-left: 2.5%;
      background-color: #fff;;
      height: auto;
      margin-top: 0.1rem;
      border-radius: 0.1rem;

      .item-left{
        width: 2rem;
        height: 1.5rem;
        margin-top: 0.25rem;
        margin-left: 0.25rem;
        float: left;

        img{
          width: 100%;
          height: 100%;
        }
      }

      .item-right{
        float: left;
        width: calc(100% - 2.3rem);
        padding-left: 0.4rem;
        padding-top: 0.25rem;

        .item-right-x{
          line-height: 0.7rem;
          font-size: 0.25rem;
        }
      }

      .item-bottom{
        float: left;
        height: 0.7rem;
        width: 100%;

        .market-type{
          float: left;
          display: block;
          width: 2rem;
          line-height: 0.7rem;
          font-size: 0.35rem;
          margin-left: 0.25rem;
          text-align: center;
        }

        .item-btn{
          float: left;
          width: calc(100% - 2.25rem);
          height: 0.7rem;

          .edit-btn{
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
