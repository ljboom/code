<html style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recharge</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description"
          content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public')}}/recharge.css">
    <style>
        .content .itemlist .item[data-v-87ec97b4] {
            margin: 5px 0;
        }
        uni-view.item_mian {
            width: 50%;
            float: left;
        }
    </style>
</head>
<body class="uni-body pages-my-recharge">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/my/recharge">
        <uni-page-head uni-page-head-type="default">
            <div class="uni-page-head" style="background-color: rgb(13, 165, 97); color: rgb(255, 255, 255);">
                <div class="uni-page-head-hd">
                    <div class="uni-page-head-btn"  onclick="window.location.href='{{route('dashboard')}}'"><i class="uni-btn-icon"
                                                      style="color: rgb(255, 255, 255); font-size: 27px;"></i></div>
                    <div class="uni-page-head-ft"></div>
                </div>
                <div class="uni-page-head-bd">
                    <div class="uni-page-head__title" style="font-size: 16px; opacity: 1;"> Recharge</div>
                </div>
                <div class="uni-page-head-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </uni-page-head>
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-87ec97b4="" class="content">
                    <uni-view data-v-87ec97b4="" class="itemlist1">
                        <p>Recharge Modal</p>
                        <uni-view data-v-87ec97b4="" class="itemlist" style="display: block;overflow: hidden;margin-top: 0">
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 300)">
                                <uni-view data-v-87ec97b4="" class="item av">300</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 700)">
                                <uni-view data-v-87ec97b4="" class="item">700</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 2000)">
                                <uni-view data-v-87ec97b4="" class="item">2000</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 5000)">
                                <uni-view data-v-87ec97b4="" class="item">5000</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 10000)">
                                <uni-view data-v-87ec97b4="" class="item">10000</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 20000)">
                                <uni-view data-v-87ec97b4="" class="item">20000</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 30000)">
                                <uni-view data-v-87ec97b4="" class="item">30000</uni-view>
                            </uni-view>
                            <uni-view data-v-87ec97b4="" class="item_mian" onclick="getAmount(this, 50000)">
                                <uni-view data-v-87ec97b4="" class="item">50000</uni-view>
                            </uni-view>
                        </uni-view>
                    </uni-view>
                    <uni-view data-v-87ec97b4="" class="cz">
                        <uni-view data-v-87ec97b4="" class="title">Available Balance：
                            <uni-text data-v-0dd1b27e="" data-v-87ec97b4="" class="u-count-num"
                                      style="font-size: 16px; font-weight: normal; color: rgb(96, 98, 102); margin: 0px 5px;">
                                <span>{{price(auth()->user()->balance)}}</span></uni-text>
                        </uni-view>
                        <uni-view data-v-87ec97b4="" class="je">
                            <uni-view data-v-87ec97b4="" class="je1">{{currency()}}</uni-view>
                            <uni-view data-v-87ec97b4="" class="je2">
                                <uni-input data-v-87ec97b4="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <div class="uni-input-placeholder input-placeholder" data-v-87ec97b4="" style="display: none;">
                                            Please enter the Recharge amount
                                        </div>
                                        <input maxlength="12" step="0.000000000000000001"
                                               pattern="[0-9]*" autocomplete="off" type="number"
                                               value="300"
                                               name="amount"
                                               class="uni-input-input"></div>
                                </uni-input>
                            </uni-view>
                        </uni-view>
                    </uni-view>

                    <uni-view data-v-87ec97b4="" class="my_btn" onclick="deposit()">
                        Pay<uni-text data-v-0dd1b27e="" data-v-87ec97b4="" class="u-count-num"
                                  style="font-size: 19px; font-weight: normal; color: rgb(255, 255, 255); margin-left: 5px;">
                            <span class="ppamount">300</span></uni-text>
                    </uni-view>

                    <uni-view data-v-87ec97b4="" style="margin-bottom: 16px;"></uni-view>
                    <uni-view data-v-87ec97b4="" class="itemlist1">
                        <uni-view data-v-87ec97b4="" class="html">
                            <ul class=" list-paddingleft-2" style="list-style-type: disc;">
                                <li>
                                    Deposit time: 24 hours
                                </li>
                                <li>
                                    Minimum deposit amount: {{price(300)}}
                                </li>
                                <li>
                                    If you encounter deposit problems, please contact official customer service
                                </li>
                            </ul>
                        </uni-view>
                    </uni-view>

                    @include('app.layout.manu')
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
@include('alert-message')
<script>
    function getAmount(_this, amount){
        var elements = document.querySelectorAll('.item');
        for (let i = 0;i<elements.length; i++){
            if (elements[i].classList.contains('av')){
                elements[i].classList.remove('av')
            }
        }
        _this.querySelector('.item').classList.add('av');

        document.querySelector('.ppamount').innerHTML = amount;

        document.querySelector('input[name="amount"]').value = amount;
    }

    function deposit(){
        var amount = document.querySelector('input[name="amount"]').value
        if (amount >= 300){
            window.location.href= '{{url('/deposit')}}'+"/"+amount;
        }else {
            message('Unused amount. ')
        }
    }
</script>

</body>
</html>
