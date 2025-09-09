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
       {{$t('hj247')}}
      </div>

      <div class="right_icon" @click="goToNewBank()">
        <div></div>
        <span>
          <i class="van-icon van-icon-add-o" style="color: rgb(8, 141, 71);"></i>
          {{$t('hj312')}}
        </span>
      </div>

    </div>

    <!-- end -->

<!-- 银行卡号 -->

  <div class="bank-list"  v-if="Object.keys(bankInfo).length > 0">
    <div class="bank-item">

      <div class="item-left">
        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/PjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+PHN2ZyB0PSIxNjgyNTc1MzMyNzQ4IiBjbGFzcz0iaWNvbiIgdmlld0JveD0iMCAwIDE0MzMgMTAyNCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHAtaWQ9IjUzNTciIHdpZHRoPSI4OS41NjI1IiBoZWlnaHQ9IjY0IiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PHBhdGggZD0iTTE0MzMuMDI4IDE4NS45NnYtODMuNjQzQTEwMi4zMTcgMTAyLjMxNyAwIDAgMCAxMzMwLjcxIDBIMTAyLjMxN0ExMDIuMzE3IDEwMi4zMTcgMCAwIDAgMCAxMDIuMzE3djgzLjY0NGExOS4xODQgMTkuMTg0IDAgMCAwIDE5LjE4NCAxOS4xODRoMTM5NC42NmExOS4xODQgMTkuMTg0IDAgMCAwIDE5LjE4NC0xOS4xODR6IiBvcGFjaXR5PSIuNCIgcC1pZD0iNTM1OCIgZmlsbD0iIzdiYzJmOSI+PC9wYXRoPjxwYXRoIGQ9Ik0xNDA3LjQ0OCAzMDcuMjM4SDI1LjU4QTI1LjU4IDI1LjU4IDAgMCAwIDAgMzMyLjgxOHY1ODguODY1QTEwMi4zMTcgMTAyLjMxNyAwIDAgMCAxMDIuMzE3IDEwMjRIMTMzMC43MWExMDIuMzE3IDEwMi4zMTcgMCAwIDAgMTAyLjMxNy0xMDIuMzE3VjMzMi44MThhMjUuNTggMjUuNTggMCAwIDAtMjUuNTgtMjUuNTh6IG0tNjkxLjIzIDQwMC40NzVMNjg2LjkzIDg3My42OWExOS4xODQgMTkuMTg0IDAgMCAxLTE4Ljg2NSAxNS44NDNoLTYzLjMyNGExOS4xODQgMTkuMTg0IDAgMCAxLTE4Ljg2NS0yMi41NTdsMjkuMjU2LTE2NS45NzhhMTkuMTg0IDE5LjE4NCAwIDAgMSAxOC44OC0xNS44MjdoNjMuMzFhMTkuMTg0IDE5LjE4NCAwIDAgMSAxOC44OTYgMjIuNTQyeiBtMjA0LjgyNiAwTDg5MS43NyA4NzMuNjlhMTkuMTg0IDE5LjE4NCAwIDAgMS0xOC44NjQgMTUuODQzaC02My4zMjVhMTkuMTg0IDE5LjE4NCAwIDAgMS0xOC44NjQtMjIuNTU3bDI5LjI1Ni0xNjUuOTc4YTE5LjE4NCAxOS4xODQgMCAwIDEgMTguODY0LTE1LjgyN2g2My4zMjVhMTkuMTg0IDE5LjE4NCAwIDAgMSAxOC44NjUgMjIuNTQyeiBtMzA2Ljk1IDBMMTE5OC43NyA4NzMuNjlhMTkuMTg0IDE5LjE4NCAwIDAgMS0xOC44NjUgMTUuODQzaC0xNjUuNDk3YTE5LjE4NCAxOS4xODQgMCAwIDEtMTguODY1LTIyLjU1N2wyOS4yMjQtMTY1Ljk3OGExOS4xODQgMTkuMTg0IDAgMCAxIDE4Ljg4MS0xNS44MjdoMTY1LjUzYTE5LjM0NCAxOS4zNDQgMCAwIDEgMTguODY0IDIyLjU0MnoiIHAtaWQ9IjUzNTkiIGZpbGw9IiM3YmMyZjkiPjwvcGF0aD48L3N2Zz4=">
      </div>

      <div class="item-right">
        <div class="item-right-x">
          <span class="x-name">{{$t('hj213')}}</span>
          <span>{{bankInfo.bankName}}</span>
        </div>
        <div class="item-right-x">
          <span class="x-name">{{$t('hj215')}}</span>
          <span>{{bankInfo.bankNo}}</span>
        </div>
      </div>

      <div class="item-bottom">
        <div class="market-type">
          <span>{{findByCodeAccount(bankInfo.marketType)}}</span>
        </div>
        <div class="item-btn">
          <!-- <span class="edit-btn">修改</span> -->
        </div>
      </div>

    </div>
  </div>
  <div v-else class="bank-list" style="text-align:center">
    {{$t('hj311')}}
  </div>

<!-- end -->

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
      bankInfo:{},
      accountLists: [
        {
          text : this.$t('hj277'),
          code : "USD"
        },
        {
          text : this.$t('hj278'),
          code : "HKD"
        },
        {
          text : this.$t('hj279'),
          code : "MYR"
        },
        {
          text : this.$t('hj280'),
          code : "THB"
        },
        {
          text : this.$t('hj283'),
          code : "INR"
        }
      ]
    };
  },
  created() {
    this.getCardDetail();
  },
  methods: {
    findByCodeAccount(code) {
      const foundAccount = this.accountLists.find(obj => obj.code === code);
      return foundAccount ? foundAccount.text : '';
    },
    goToNewBank(){
      this.$router.push({ name: 'bankEdit', params: { id: 123 }})
    },
    async toSure() {
      // 添加银行卡
      if (isNull(this.bankNo) || !bankNoReg(this.bankNo)) {
        Toast(this.$t("hj217"));
      } else if (isNull(this.bankName) || !isName(this.bankName)) {
        Toast(this.$t("hj218"));
      } else if (isNull(this.bankAddress) || !isName(this.bankAddress)) {
        Toast(this.$t("hj219"));
      } else {
        let opts = {
          bankName: this.bankName,
          bankNo: this.bankNo,
          bankAddress: this.bankAddress
        };
        let data = await api.addBankCard(opts);
        if (data.status === 0) {
          Toast(this.$t("hj220"));
          this.$router.push("/newUser");
        } else {
          Toast(data.msg);
        }
      }
    },
    async getCardDetail() {
      // 获取银行卡信息
      let data = await api.getBankCard()
      if (data.status === 0) {
        this.bankInfo = data.data;
        this.addBank = false;
      } else {
        this.addBank = true;
      }
    },
  }
};
</script>

<style scoped lang="less">
.bank_card_page {
  width: 100%;
  height: 100%;
  background: rgb(241,242,246);;

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
    padding-left: 2.2rem;
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
