<template>
  <div class="wrapper">
    <div class="header">
      <div class="left_back" @click="handleBackClick()">
        <img src="../../assets/img/back.svg" alt="">
      </div>
      <div class="header_titles">
      </div>
    </div>
    <div class="bars">
      <div>
        <span>{{ $t('hj187') }}</span>
      </div>
    </div>
    <div class="huaz">

      <div class="huaztype">
        <div class="huaztype-item">
          <!-- <el-select v-model="from_addr" :placeholder=" $t('hj314') ">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select> -->

          <select class="set-account" v-model="from_addr" >
            <option :label="$t('hj314')" selected></option>
            <option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
            {{item.label}}
            </option>
          </select>
        </div>
        <div class="center_img"><img src="@/assets/img/rightshou.svg"></div>
        <div class="huaztype-item">
          <!-- <el-select v-model="to_addr" :placeholder=" $t('hj314') ">
            <el-option
              v-for="item in options2"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select> -->
          <select class="set-account" v-model="to_addr">
            <option :label="$t('hj314')" selected></option>
            <option v-for="item in options2" :key="item.value" :label="item.label" :value="item.value">
            {{item.label}}
            </option>
          </select>
        </div>
      </div>

      <div class="hzprice">
        <el-input type="number" v-model="price" :placeholder="$t('hj315')"></el-input>
      </div>

      <div class="btn" @click="tosubmit()"><el-button type="primary">{{$t('hj331')}}</el-button></div>
    </div>

  </div>
</template>

<script>

import * as api from '@/axios/api'
import { Toast } from 'mint-ui'

export default {
  components: {
  },
  data() {
    return {

      from_addr:'',
      to_addr:'',
      price:'',
      userInfo: {
        realName: ''
      },
      options: [
      // {
      //   value: '1',
      //   label:this.$t('hj284')
      // }, {
      //   value: '2',
      //   label: this.$t('hj285')
      // }, {
      //   value: '3',
      //   label: this.$t('hj286')
      // }, {
      //   value: '4',
      //   label: this.$t('hj287')
      // },
      {
        value: '5',
        label: this.$t('hj288')
      },
      // {
      //   value: '6',
      //   label: this.$t('hj290')
      // },
      {
        value: '7',
        label: this.$t('hj289')
      }],
      options2: [
      // {
      //   value: '1',
      //   label:this.$t('hj284')
      // }, {
      //   value: '2',
      //   label: this.$t('hj285')
      // }, {
      //   value: '3',
      //   label: this.$t('hj286')
      // }, {
      //   value: '4',
      //   label: this.$t('hj287')
      // },
      {
        value: '5',
        label: this.$t('hj288')
      },
      // {
      //   value: '6',
      //   label: this.$t('hj290')
      // },
      {
        value: '7',
        label: this.$t('hj289')
      }],
    }
  },
  watch: {},
  computed: {},
  created() {
  },
  mounted() {
    this.getUserInfo()
  },
  methods: {
    handleBackClick() {
      this.$router.go(-1);
    },

    async tosubmit() {

      let opt = {
        amt: this.price,
        from: this.from_addr,
        to: this.to_addr
      }
      let data = await api.AmtChange(opt)
      if (data.status === 0) {
        Toast(this.$t('hj326'))
        this.$router.push('/user')
      } else if (data.msg.indexOf('請先登錄') > -1) {
        Toast(this.$t('hj386'))
      } else if (data.msg.indexOf('金额不正确') > -1) {
        Toast(this.$t('hj387'))
      } else if (data.msg.indexOf('划转类型不能相同') > -1) {
        Toast(this.$t('hj388'))
      } else if (data.msg.indexOf('可用资金不足') > -1) {
        Toast(this.$t('hj389'))
      } else {
        Toast(this.$t('hj327'))
      }
    },

    // async tosubmit() {
    //   // 融资转指数
    //   let opt = {
    //     amt: this.selected === '1' ? this.form.account1 : this.selected === '2' ? this.form.account2 : this.selected === '3' ? this.form.account3 : this.form.account4,
    //     type: this.selected // 1 融资转指数 2 指数转融资
    //   }
    //   let data = await api.AmtChange(opt)
    //   if (data.status === 0) {
    //     Toast(data.msg)
    //     this.$router.push('/user')
    //   } else {
    //     Toast(data.msg)
    //   }
    // },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo()
      if (data.status === 0) {
        this.$store.state.userInfo = data.data
      } else {
        Toast(data.msg)
      }
    }
  }
}
</script>
<style lang="less" scoped>
.huaz{
  .huaztype{
    width: 90%;
    margin: auto;
    display: flex;
    color: #fff;

    .set-account {
      // border: none;
      width: 210px;
      border-radius: 12px;
      color: #13D2A0;
      font-size: 18px ;
      height: 68px;
      background-color: #030E1E;
    }

  }
  .center_img{
    width: 60px;
    padding-left: 10px;
    padding-top: 20px;
    img{
      width: 30px;
      height: 30px;
    }
  }
  .hzprice{
    width: 90%;
    margin:30px auto;

    /** 修改表单label字体颜色*/
    /deep/ .el-form-item__label {
      color: rgba(19, 210, 160, 0.3);
    }
    /**改变input里的字体颜色*/
    /deep/ input::-webkit-input-placeholder {
      color: rgba(19, 210, 160, 0.6);
      font-size: 22px;
    }
    /**改变input框背景颜色*/
    /deep/ .el-input__inner {
      background-color: transparent !important;
      height: 68px;
      color: rgba(137, 185, 255, 1);
      font-size: 28px;
      border-color: rgba(255, 255, 255, 0.3);
    }
  }
  .btn{
    width: 100%;
    margin: auto;
    button{
      width: 100%;
      height: 60px;
      font-size: 26px;

    }

  }


}

.el-input .el-input__inner {
      background-color: rgba(255, 255, 255, 0.247);
      height: 45px;
  }
.header {
  width: 100%;
  height: 1.5rem;
  position: fixed;
  z-index: 999;
  border-radius: 0 0 .15rem .15rem;

  .left_back {
    width: 1rem;
    height: 100%;
    left: 0;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;

    img {
      width: .6rem;
      height: .6rem;
    }
  }

  .header_titles {
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: .4615rem;
    line-height: 1.5rem;

    span {
      font-weight: 600;
    }
  }
}

.form-block {
  width: 100%;
  height: 1.5rem;
  margin-top: .3rem;
}

/deep/ .mint-field-other {
  padding-right: .3rem;
}

/deep/ .mint-cell-wrapper {
  height: 100%;
  border: none;
  background: rgb(245, 245, 245);
  border-radius: .15rem;
}

.is-selected {
  background: rgb(235, 235, 235) !important;
  border-radius: .15rem;
}

.mint-navbar {
  padding: 0 .3rem;
}

.btnbox {
  width: 94%;
  margin-top: .1rem;
}

.loginout {
  height: 1.2rem !important;
  line-height: 1.2rem !important;
}

.int-cell {
  width: 100%;
  height: 100%;
}

a {
  width: 100%;
  height: 100%;

  .mint-cell-wrapper {
    width: 100%;
    height: 100%;
  }
}

.bars {
  width: 100%;
  height: 6rem;
  display: flex;
  padding: 0 .3rem;
  align-items: flex-end;
  color: #fff;
  >div {
    margin-bottom: 1.2rem;
    font-size: .65rem;

    span {
      font-weight: 600;
    }
  }
}

.mint-cell.mint-field {
  color: #000 !important;
}

/deep/ .mint-cell-text {
  color: #eee !important;
}

.text-center.btnok {
  display: inline-block;
  height: 1rem;
  line-height: 1rem;
  background: #2d6ae9;
  border: none;
  border-radius: .1rem;
}

.wrapper {
  width: 100%;
  height: 100%;
}

/deep/.mint-cell-wrapper {
  background-color: #202020;
  border: 1px solid rgba(255,255,255,0.3);;
  span {
    font-size: 0.35rem !important;
  }

  /deep/input {
    font-size: 0.35rem !important;

  }
}

/deep/.mint-cell-value {
  font-size: 0.35rem !important;
  color: #13D2A0;
}

/deep/.mint-tab-item-label {
  font-size: 0.35rem !important;
}

/deep/.loginout {
  font-size: 0.35rem !important;
}
</style>
