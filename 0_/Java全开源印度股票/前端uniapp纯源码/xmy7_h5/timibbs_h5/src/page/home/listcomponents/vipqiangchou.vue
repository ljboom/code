<template>
    <div>
        <div class="dbox">
            <div class="daz"><span class="d1" style="width: 30%;">{{$t('hj39')}}</span><span class="d2"
                    style="width: 20%;">{{$t('hj81')}}</span><span class="d3"
                    style="width: 20%; text-align: center;">{{$t('hj41')}}</span><span class="d4" style="width: 30%;"></span></div>
        </div>
        <div class="list" v-for="(item, index) in vipqcList" :key="index">
            <div class="lbox">
                <div class="lb1">
                    <h6>{{ item.n }}</h6>
                    <p>
                        <span v-if="item.stockType == 'sz'">{{$t('hj258')}}</span>
                        <span class="sh" v-if="item.stockType == 'sh'">{{$t('hj259')}}</span>
                        <span class="bj" v-if="item.stockType == 'bj'">{{$t('hj260')}}</span>
                        <a :class="item.stockType == 'sh' ? 'shbg' : item.stockType == 'bj' ? 'bjbg' : ''">{{
                                item.c
                        }}</a>
                    </p>
                </div>
                <div class="lb2" :class="item.zdp > 0 ? 'hqred' : 'hqgreen'"> {{ Number(item.p)/1000 }} </div>
                <div class="lb3" :class="item.zdp > 0 ? 'hqred' : 'hqgreen'"> {{ item.zdp ? item.zdp.toFixed(2)+'%' : '0.00%'
                }} </div>
                <div class="lb4"><a @click="getdetail(item)">{{$t('hj238')}}</a></div>
            </div>
        </div>
        <van-popup v-model="show" round position="bottom" :close-on-click-overlay="false">
            <div class="boxd">
                <div class="boxh"> {{$t('hj266')}}  </div>
                <div class="erty"><input :placeholder="$t('hj264')" type="password" class="inpy" v-model="password"></div>
                <div class="maik" @click="getVipList()">{{$t('hj267')}}</div>
            </div>
        </van-popup>
    </div>
</template>
<script>
import * as api from '@/axios/api'
export default {
    components: {

    },
    props: {},
    data() {
        return {
            vipqcList: [],
            password:'',
            show:true
        }
    },
    mounted() {
    },
    methods: {
        getdetail(item) {
            this.$router.push({
                path: '/vipdetail',
                query: {
                    item: encodeURIComponent(JSON.stringify(item))
                }
            })
        },
        async getVipList() {
            let res = await api.getVipList({password:this.password})
            if (res.status == 0) {
                this.vipqcList = res.data
                this.show = false
            }else{
                this.$toast(res.msg)
            }
        },
    },
}
</script>
<style lang="less" scoped>
.boxd {
    background: #fff;
    border-radius: 0.266rem 0.266rem 0 0;
    padding-bottom: 0.53rem;

    .boxh {
        height: 1.2rem;
        border-bottom: 0.0266rem solid #e0e0e0;
        text-align: center;
        line-height: 1.2rem;
        color: #333;
        font-size: 0.43rem;
        width: 9.48rem;
        margin: 0 auto;
        position: relative;

        span {
            position: absolute;
            width: 0.32rem;
            height: 0.32rem;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAStJREFUSEutlk1qhDAUgF+EzG5EWsYTzK6HKO0hcgB3gscR3IgH8BBTeojuegJLQWg3NqDlyUQwRn0xcWeQ7zMv7ycMAKCu61PTNOcsy77x3fUpy/IhDMNfIcQfQ3jbtvUwDFfO+UuSJF8ugqqqLlLKN8bYZxRFguV5/sg5fweAJwD4cJEouGJJKZ8Z/m1RFHEQBDcXiQ7v+/41TdNmFLhK1uDInQRHJVvwhcBWsgc3CqgSCnxVsCehwjcFaxJcxzynZtzskE0Fpqfw/RtyzewKDDvBJXJBkgRazP0K9AP1GiIdjn2q6zpm01ZWQ2SCq05r07uMgi24be9aCChwG8lMYAOnSibBEThFMgpc4HsSryNTz65xZPoe+koyDX3cou9rC14k4jj+wWvLP1ylVM57GzhpAAAAAElFTkSuQmCC) no-repeat 50%;
            background-size: 100%;
            right: 0.266rem;
            top: 0.4rem;
        }
    }

    h5 {
        color: #333;
        font-size: .37rem;
        font-weight: 500;
        width: 9.48rem;
        margin: 0 auto;
        margin-top: 0.32rem;
    }

    h6 {
        color: #ea3544;
        font-size: .43rem;
        width: 9.48rem;
        margin: 0 auto;
        margin-top: 0.32rem;
        font-weight: 600;
    }

    .erty {
        width: 9.21rem;
        height: 1.07rem;
        border: 0.0266rem solid #197af6;
        border-radius: 0.13rem;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        margin-top: 0.59rem;

        .inpy {
            height: 1.07rem;
            width: 5.34rem;
            margin-left: 0.266rem;
            background: transparent;
            font-size: .37rem;
            color: #000;
        }

        a {
            height: 0.64rem;
            border-left: 0.0266rem solid #999;
            width: 1.15rem;
            margin-top: 0.266rem;
            text-align: center;
            font-size: .37rem;
            color: #000;
            line-height: .64rem;
        }
    }

    .tghj {
        border: 0.0266rem solid #197af6;
        margin-top: 0.45rem;
    }

    .plm {
        width: 8.94rem;
        margin: 0 auto;
        margin-top: 0.266rem;

        span {
            color: #999;
            font-size: .32rem;
        }

        a {
            color: #f33030;
            margin-left: 0.11rem;
        }
    }

    .maik {
        width: 9.21rem;
        height: 1.07rem;
        background: #197af6;
        border-radius: 0.26rem;
        margin: 0 auto;
        margin-top: 0.56rem;
        text-align: center;
        line-height: 1.07rem;
        color: #fff;
        font-size: .37rem;
    }
}
.hqred {
    color: #f11614 !important;
}

.hqgreen {
    color: #09965f !important;
}

.dbox {
    width: 100%;
    padding-bottom: 0.266rem;
    border-bottom: 1px solid #e0e0e0;

    .daz {
        width: 9.35rem;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;

        span {
            color: #666;
            font-size: .35rem;
        }

        .d2 {
            text-align: center;
        }
    }
}

.list {
    width: 100%;
    padding: 0.4rem 0;
    border-bottom: 1px solid #e0e0e0;

    .lbox {
        width: 9.35rem;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;

        .lb1 {
            width: 30%;

            h6 {
                color: #333;
                font-size: .4rem;
                font-weight: 600;
            }

            p {
                color: #333;
                font-size: .32rem;
                margin-top: 0.13rem;

                span {
                    width: 0.4rem;
                    height: 0.4rem;
                    background: #3b4fde;
                    border-radius: 0.05rem;
                    padding: 0.04rem;
                    text-align: center;
                    line-height: .4rem;
                    color: #fff;
                    font-size: .3rem;
                }

                a {
                    display: inline-block;
                    height: 0.4rem;
                    line-height: .4rem;
                    padding: 0 0.11rem;
                    background: rgba(59, 79, 222, .1);
                    border-radius: 0.05rem;
                    color: #3b4fde;
                    font-size: .32rem;
                    vertical-align: middle;
                }

                .bj {
                    background: #ea6248;
                }

                .sh {
                    background: #aa3bde;
                }

                .shbg {
                    color: #aa3bde;
                    background: rgba(170, 59, 222, .1);
                }

                .bjbg {
                    color: #ea6248;
                    background: rgba(234, 98, 72, .1);
                }
            }
        }

        .lb2 {
            font-size: .32rem;
            margin-top: 0.32rem;
            width: 20%;
            text-align: center;
        }

        .lb3 {
            font-size: .32rem;
            margin-top: 0.32rem;
            width: 20%;
            text-align: center;
        }

        .lb4 {
            width: 30%;
            text-align: right;

            a {
                display: inline-block;
                width: 1.6rem;
                height: 0.67rem;
                background: #197af6;
                border-radius: 0.35rem;
                text-align: center;
                color: #fff;
                font-sizE: .32rem;
                line-height: .67rem;
                margin-top: 0.08rem;
            }
        }
    }
}
</style>