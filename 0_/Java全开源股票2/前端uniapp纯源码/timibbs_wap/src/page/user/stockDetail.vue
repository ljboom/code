<template>
    <div>

        <!-- 头部 -->
        <div class="top_icon">
            <div class="left_back" style="padding-left:30px;">
                <div class="left_back_icon" @click="$closePageParams()">
                    <img src="../../assets/img/zuojiantou.png" alt />
                </div>
            </div>

            <div class="title">
                {{ $t('hj378') }}
            </div>

        </div>
        <!-- end -->

        <div class="content">
            <div class="top">
                <div class="name">
                    ({{ currency }}&nbsp;{{ stockInfo.stockCode }}){{ stockInfo.stockName }}
                </div>
                <div class="detail"><span class="type">
                        {{ stockInfo.orderDirection == "买跌" ? $t('hj84') : $t('hj85') }}
                    </span> <span class="leave">{{ stockInfo.orderLever }}X</span>
                    <span class="num">{{ stockInfo.orderNum / 100 }}Lot</span>
                </div>
                <div class="price">
                    <div class="float-price">
                        <span class="amount" style="color: green;">{{ stockInfo.profitAndLose | formatDecimal }}</span>
                        <span class="amount">{{ stockInfo.buyOrderPrice | formatDecimal }}</span>
                        <span class="amount">{{ stockInfo.now_price | formatDecimal }}</span>
                    </div>
                    <div class="float-text">
                        <span class="text">{{ $t('hj118') }}</span>
                        <span class="text">{{ $t('hj119') }}</span>
                        <span class="text">{{ $t('hj120') }}</span>
                    </div>
                </div>
            </div>
            <div class="cell-list">

                <van-cell-group>
                    <van-cell class="van-cell--large" :title="$t('hj380')" :value="currency" />

                    <van-cell class="van-cell--large" :title="$t('hj381')" :value="stockInfo.positionSn" />

                    <van-cell class="van-cell--large" :title="$t('hj382')" :value="stockInfo.orderNum" />

                    <van-cell class="van-cell--large" :title="$t('hj383')" :value="stockInfo.buyOrderTime | gettime" />

                    <van-cell class="van-cell--large" :title="$t('hj104')"
                        :value="stockInfo.profitTargetPrice != null ? stockInfo.profitTargetPrice : $t('hj384')" />

                    <van-cell class="van-cell--large" :title="$t('hj105')"
                        :value="stockInfo.stopTargetPrice != null ? stockInfo.stopTargetPrice : $t('hj384')" />

                    <van-cell class="van-cell--large" :title="$t('hj118')"
                        :value="stockInfo.profitAndLose | formatDecimal" />

                    <!-- 平仓盈亏 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj385')"
                        :value="stockInfo.allProfitAndLose | formatDecimal" />

                    <!-- 手续费 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj44')"
                        :value="stockInfo.orderFee | formatDecimal" />

                    <!-- 印花费 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj386')"
                        :value="stockInfo.orderSpread | formatDecimal" />

                    <!-- 留倉費 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj387')"
                        :value="stockInfo.orderStayFee | formatDecimal" />

                    <!-- 點差費 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj388')"
                        :value="stockInfo.spreadRatePrice | formatDecimal" />

                    <van-cell class="van-cell--large" :title="$t('hj55')"
                        :value="stockInfo.orderTotalPrice | formatDecimal" />

                    <van-cell class="van-cell--large" :title="$t('hj119')"
                        :value="stockInfo.buyOrderPrice | formatDecimal" />

                    <!-- 平仓价格 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj389')"
                        :value="stockInfo.sellOrderPrice | formatDecimal" />

                    <van-cell class="van-cell--large" :title="$t('hj120')" :value="stockInfo.now_price | formatDecimal" />

                    <!-- 总盈亏 -->
                    <van-cell v-if="type === 1" class="van-cell--large" :title="$t('hj390')"
                        :value="stockInfo.allProfitAndLose | formatDecimal" />

                </van-cell-group>

                <div style="margin: 1rem 25px 2rem;">
                    <van-button round block type="primary" native-type="button" style="margin-top: 0.3rem;"
                        @click="$closePageParams()">{{ $t('hj106') }}</van-button>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
// 这里可以导入其他文件（比如：组件，工具js，第三方插件js，json文件，图片文件等等）

export default {
    components: {},
    data() {
        return {
            currency: "USD",
            stockInfo: [],
            type: '',
        };
    },
    computed: {},
    watch: {},
    created() {
        this.type = this.$getRouteParams().params.type;
        this.stockInfo = this.$getRouteParams().params.data;
        this.currency = this.getCurrency();

        console.log(this.type);
        console.log(this.stockInfo);
    },
    mounted() {

    },
    filters: {
        formatDecimal(value) {
            if (typeof value === 'string') {
                value = Number(value)
            }
            if (typeof value === 'number') {
                return value.toFixed(3); // 使用 toFixed 方法保留 3 位小数
            }
            return value;
        },
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

            return d + '-' + mm + '-' + y + ' ' + h + ":" + m + ":" + c;
        }
    },
    beforeCreate() { }, // 生命周期 - 创建之前
    beforeMount() { }, // 生命周期 - 挂载之前
    beforeUpdate() { }, // 生命周期 - 更新之前
    updated() { }, // 生命周期 - 更新之后
    beforeDestroy() { }, // 生命周期 - 销毁之前
    destroyed() { }, // 生命周期 - 销毁完成
    activated() { }, // 如果页面有keep-alive缓存功能，这个函数会触发
    // 方法集合
    methods: {
        getCurrency() {
            var str = this.stockInfo.stockGid;
            const stockType = str.substring(0, 2);
            if (stockType === 'us') {
                return 'USD';
            } else if (stockType === 'hk') {
                return 'HKD';
            } else if (stockType === 'my') {
                return 'MYR';
            } else if (stockType === 'th') {
                return 'THB';
            } else if (stockType === 'in') {
                return 'INR';
            } else {
                return '$';
            }
        },
    },
};
</script>

<style lang="less" scoped>
.top_icon {
    width: 100%;
    height: 1.3rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;

    .left_back {
        width: 10%;
        height: 50%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;

        img {
            width: 0.6rem;
            height: 0.6rem;
        }
    }

    .title {
        width: calc(100% + 2rem);
        text-align: center;
        font-size: 0.4rem;
    }

    .right_icon {
        width: auto;
        height: 35%;
        padding-right: 0.1rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;

        &>div {
            width: auto;
            height: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;

            img {
                width: 0.55rem;
                height: 0.55rem;
            }
        }
    }
}

.top {
    width: 100%;
    height: auto;
    background: #fff;

    .name {
        line-height: 0.8rem;
        font-size: 0.38rem;
        font-weight: 600;
        padding-left: 0.3rem;
    }

    .detail {
        height: auto;

        span {
            &.type {
                margin-left: 0.3rem;
                color: #6bbc15;
                padding: 0.03rem 0.08rem;
                background-color: #d7ffd4;
                font-weight: 600;
            }

            &.leave {
                margin-left: 0.1rem;
                color: #0070b7;
                padding: 0.03rem 0.08rem;
                background-color: #cbebf7;
                font-weight: 600;
            }

            &.num {
                color: #9d9c9c;
            }
        }
    }

    .price {
        width: 100%;
        margin-top: 0.55rem;
        height: 1.45rem;
    }
}

.top .price .float-price,
.top .price .float-text {
    width: 100%;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    height: auto;
}

.top .price .float-price>span,
.top .price .float-text>span {
    width: 33.3%;
    text-align: center;
}

.top .price .float-price .amount,
.top .price .float-text .amount {
    font-size: 0.4rem;
}

.top .price .float-price .amount:first-child,
.top .price .float-text .amount:first-child {
    text-align: left;
    padding-left: 0.35rem;
}

.top .price .float-price .text:first-child,
.top .price .float-text .text:first-child {
    text-align: left;
    padding-left: 0.05rem;
}

.top .price .float-price .amount:last-child,
.top .price .float-text .amount:last-child {
    text-align: right;
    padding-right: 0.35rem;
}

.top .price .float-price .text:last-child,
.top .price .float-text .text:last-child {
    text-align: right;
    padding-right: 0.05rem;
}

.top .price .float-price .text,
.top .price .float-text .text {
    margin-top: 0.2rem;
    color: grey;
    font-size: 0.422222rem;
    -webkit-transform: scale(0.82, 0.82);
    transform: scale(0.82, 0.82);
}

.cell-list {
    margin-top: 0.15rem;

    .van-cell--large {
        padding-top: .222222rem;
        padding-bottom: .222222rem;

        .van-cell__title {
            font-size: 0.35rem
        }

        .van-cell__value {
            font-size: 0.35rem
        }

        .van-cell__label {
            font-size: .259259rem
        }

    }

}
</style>