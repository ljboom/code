<html
    style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Withdrawal</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description"
          content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public')}}/withdraw.css">
</head>
<body class="uni-body pages-my-withdrawal">
<form action="{{route('user.withdraw.request')}}" method="post">
    @csrf
    <uni-app class="uni-app--maxwidth">
        <uni-page data-page="pages/my/withdrawal">
            <uni-page-head uni-page-head-type="default">
                <div class="uni-page-head" style="background-color: rgb(13, 165, 97); color: rgb(255, 255, 255);">
                    <div class="uni-page-head-hd">
                        <div class="uni-page-head-btn" onclick="window.location.href='{{route('dashboard')}}'"><i
                                class="uni-btn-icon"
                                style="color: rgb(255, 255, 255); font-size: 27px;"></i></div>
                        <div class="uni-page-head-ft"></div>
                    </div>
                    <div class="uni-page-head-bd">
                        <div class="uni-page-head__title" style="font-size: 16px; opacity: 1;"> Withdrawal</div>
                    </div>
                    <div class="uni-page-head-ft"></div>
                </div>
                <div class="uni-placeholder"></div>
            </uni-page-head>
            <uni-page-wrapper>
                <uni-page-body>
                    <uni-view data-v-7deb710c="" class="content">
                        <uni-view data-v-7deb710c="" class="itembox">
                            <uni-view data-v-7deb710c="" class="item">
                                <uni-view data-v-7deb710c="" class="title">Real Name</uni-view>
                                <uni-view data-v-7deb710c="" class="con">{{auth()->user()->name}}</uni-view>
                            </uni-view>
                            <uni-view data-v-7deb710c="" class="item">
                                <uni-view data-v-7deb710c="" class="title">Code</uni-view>
                                <uni-view data-v-7deb710c="" class="con">{{auth()->user()->gateway_method}}</uni-view>
                            </uni-view>
                            <uni-view data-v-7deb710c="" class="item">
                                <uni-view data-v-7deb710c="" class="title">Bank Account</uni-view>
                                <uni-view data-v-7deb710c="" class="con">{{auth()->user()->gateway_number}}</uni-view>
                            </uni-view>
                            <uni-navigator data-v-7deb710c="" class="charging"
                                           onclick="window.location.href='{{route('user.bank')}}'">
                                <uni-view data-v-7deb710c="" class="btn_b">
                                    <svg data-v-7deb710c="" t="1697075824692" viewBox="0 0 1024 1024" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" p-id="4067" width="200" height="200"
                                         class="icon">
                                        <path data-v-7deb710c=""
                                              d="M482.88 112l-17.28 90.688-20.64 4.512a309.696 309.696 0 0 0-99.776 41.088l-18.688 11.84-73.28-55.04-44.64 44.64 51.904 76.416-11.392 17.76a310.016 310.016 0 0 0-41.568 99.584l-4.8 21.6-90.72 12.896v63.104l90.688 17.312 4.512 20.64a309.984 309.984 0 0 0 41.088 99.776l11.84 18.688-55.04 73.28 44.64 44.64 76.416-51.904 17.76 11.392a310.016 310.016 0 0 0 99.584 41.568l21.6 4.8 12.896 90.72h63.104l17.312-90.688 20.64-4.512a309.984 309.984 0 0 0 99.776-41.088l18.688-11.84 73.28 55.04 44.64-44.64-51.904-76.416 11.392-17.76a310.016 310.016 0 0 0 41.568-99.584l4.8-21.6 90.72-12.896V482.88l-90.688-17.312-4.512-20.64a309.984 309.984 0 0 0-41.088-99.776l-11.84-18.688 55.04-73.28-44.64-44.64-76.416 51.904-17.76-11.392a310.144 310.144 0 0 0-99.584-41.568l-21.6-4.8-12.896-90.72H482.88zM410.56 149.856l19.424-101.856h171.584l14.624 102.624c28 8.064 54.848 19.328 80.128 33.568l85.792-58.304 121.344 121.344-62.272 82.88c14.08 25.408 25.152 52.352 32.96 80.416l101.888 19.424v171.584l-102.624 14.624a373.92 373.92 0 0 1-33.568 80.128l58.304 85.792-121.344 121.344-82.88-62.272c-25.408 14.08-52.352 25.152-80.416 32.96l-19.424 101.888h-171.584l-14.624-102.624a373.92 373.92 0 0 1-80.128-33.568L241.92 898.112l-121.344-121.344 62.272-82.88a373.824 373.824 0 0 1-32.96-80.416L48 594.048v-171.584l102.624-14.624c8.064-27.968 19.328-54.848 33.568-80.128L125.888 241.92l121.344-121.344 82.88 62.272a373.856 373.856 0 0 1 80.416-32.96z"
                                              p-id="4068"></path>
                                        <path data-v-7deb710c=""
                                              d="M512 704a192 192 0 1 1 0-384 192 192 0 0 1 0 384z m0-64a128 128 0 1 0 0-256 128 128 0 0 0 0 256z"
                                              p-id="4069"></path>
                                    </svg>
                                    Bind Withdrawal Bank
                                </uni-view>
                            </uni-navigator>
                        </uni-view>

                        <uni-view data-v-7deb710c="" class="itembox">
                            <uni-view data-v-7deb710c="" class="tx">Amount</uni-view>
                            <uni-view data-v-7deb710c="" class="je">
                                <uni-view data-v-7deb710c="" class="je1">{{currency()}}</uni-view>
                                <uni-view data-v-7deb710c="" class="je2">
                                    <uni-input data-v-7deb710c="" class="login_input_t">
                                        <div class="uni-input-wrapper">
                                            <input maxlength="12" step="0.000000000000000001"
                                                   placeholder="Enter the amount"
                                                   name="amount"
                                                   oninput="getAmount(this)"
                                                   pattern="[0-9]*" autocomplete="off" type="number"
                                                   class="uni-input-input"></div>
                                    </uni-input>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-7deb710c="" class="tips">Balance：
                                <uni-text data-v-0dd1b27e="" data-v-7deb710c="" class="u-count-num"
                                          style="font-size: 15px; font-weight: normal; color: rgb(96, 98, 102); margin: 0px 5px;">
                                    <span>{{price(auth()->user()->balance)}}</span></uni-text>
                            </uni-view>
                            <uni-view data-v-7deb710c="" class="je">
                                <uni-view data-v-7deb710c="" class="je1">
                                    <svg data-v-7deb710c="" t="1693100250501" viewBox="0 0 1024 1024" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" p-id="4274" width="48" height="48" class="icon">
                                        <path data-v-7deb710c=""
                                              d="M768 921.6H256a102.4 102.4 0 0 1-102.4-102.4V512a102.4 102.4 0 0 1 102.4-102.4h25.6v-51.2a230.4 230.4 0 1 1 460.8 0v51.2h25.6a102.4 102.4 0 0 1 102.4 102.4v307.2a102.4 102.4 0 0 1-102.4 102.4z m-307.2-243.456v77.056a38.4 38.4 0 0 0 76.8 0v-76.8-0.256a64 64 0 1 0-76.8 0zM665.6 358.4a153.6 153.6 0 1 0-307.2 0v51.2h307.2v-51.2z"
                                              fill="#bfbfbf" p-id="4275"></path>
                                    </svg>
                                </uni-view>
                                <uni-view data-v-7deb710c="" class="je2">
                                    <uni-input data-v-7deb710c="" class="login_input_t">
                                        <div class="uni-input-wrapper">
                                            <input maxlength="140" step="" placeholder="Enter Withdrawal Password"
                                                   autocomplete="off"
                                                   name="password"
                                                   type="password" class="uni-input-input"></div>
                                    </uni-input>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-7deb710c="" class="tips pwd" style="display: none;">
                                <uni-navigator data-v-7deb710c="" class="">Forgot Password?</uni-navigator>
                            </uni-view>
                            <uni-view data-v-7deb710c="" style="padding: 8px 0px;"></uni-view>
                            @if(auth()->user()->gateway_method && auth()->user()->gateway_number)
                                <uni-view data-v-7deb710c="" class="my_btn" onclick="submitWithdraw()">Withdrawal
                                    <uni-text data-v-0dd1b27e="" data-v-7deb710c="" class="u-count-num"
                                              style="font-size: 19px; font-weight: normal; color: rgb(255, 255, 255); margin-left: 5px;">
                                        <span class="wAmount">0</span></uni-text>
                                </uni-view>
                            @endif
                        </uni-view>

                        <uni-view data-v-7deb710c="" class="itembox">
                            <p>Minimum withdrawal amount is: {{price(setting('minimum_withdraw'))}}</p>
                                          <p>Withdrawal time: Monday to Sunday, 10:00 am to 5:00 pm, 24-hour 
</p>
                            <p>Minimum Charge: {{setting('withdraw_charge') }}%</p>
                        </uni-view>

                        @include('app.layout.manu')
                    </uni-view>
                </uni-page-body>
            </uni-page-wrapper>
        </uni-page>
    </uni-app>
</form>


<script>
    function getAmount(_this){
        document.querySelector('.wAmount').innerHTML = '{{currency()}}'+_this.value
    }
</script>
@include('alert-message')
@include('loading')
<script>
    function submitWithdraw(){
        document.querySelector('.loadingClass').style.display='block';
        document.querySelector('form').submit();
    }
</script>
</body>
</html>
