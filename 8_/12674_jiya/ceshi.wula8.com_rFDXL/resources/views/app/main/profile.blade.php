<html
    style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description"
          content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public/profile.css')}}">
    <style>
        .content .bj_top2[data-v-66f4062e] {
            display: flex;
            padding: 53px 26px 53px 26px;
            background-image: url({{asset('public')}}/static/img/mybj.1bc89ffe.jpg);
            color: #fff
        }

        .content .bj_top[data-v-66f4062e] {
            padding: 26px;
            height: 241px;
            background-image: url({{asset('public')}}/static/img/mybj.1bc89ffe.jpg);
            background-size: cover
        }
        img.iconn {
            width: 26px;
        }
        .content .item_box .item_top .tops[data-v-66f4062e] {
            margin: 0 5px;
            width: calc(100% - 10px);
            text-align: center;
            background-color: #0da561;
            padding: 21px 10px;
            border-radius: 10px;
            color: #fff;
        }
        .content .item_box .item_top .tops .tip[data-v-66f4062e] {
            color: #fff;
            font-size: 13px;
            padding-top: 10px;
        }
    </style>
</head>
<body class="uni-body pages-my-my">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/my/my">
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-66f4062e="" class="content">
                    <uni-view data-v-66f4062e="" class="bj_top">
                        <uni-view data-v-66f4062e="" class="nav">
                            <uni-view data-v-66f4062e="" class="left">
                                <uni-view data-v-59765974="" data-v-66f4062e="" class="u-icon u-icon--right">
                                    <uni-text data-v-59765974="" hover-class="" class="u-icon__icon uicon-arrow-left"
                                              style="font-size: 16px; line-height: 16px; font-weight: normal; top: 0px; color: rgb(13, 165, 97);">
                                        <span></span></uni-text>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-66f4062e="" class="Phone">{{auth()->user()->phone}}</uni-view>
                            <uni-view data-v-66f4062e="" class="right">ID:{{auth()->user()->ref_id}}</uni-view>
                        </uni-view>
                        <uni-view data-v-66f4062e="" class="logo">
                            <uni-image data-v-66f4062e="" class="img">
                                <div
                                    style="background-image: url({{asset('public')}}/static/img/logo.b086b4ea.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                <img src="{{asset('public')}}/static/img/logo.b086b4ea.png" draggable="false">
                            </uni-image>
                        </uni-view>
                        <uni-view data-v-66f4062e="" class="nav2">
                            <uni-view data-v-66f4062e="" class="vipbox">
                                <uni-view data-v-66f4062e="" class="vip">
                                    <uni-image data-v-66f4062e="" class="vipgif">
                                        <div
                                            style="background-image: url({{asset('public')}}/static/546040dcc9031bdca5b39e4f866081ec.svg); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        <img
                                            src="{{asset('public')}}/static/546040dcc9031bdca5b39e4f866081ec.svg"
                                            draggable="false"></uni-image>
                                </uni-view>
                                <uni-view data-v-66f4062e="" class="vip_next">
                                    <uni-image data-v-66f4062e="" class="vipgif">
                                        <div
                                            style="background-image: url({{asset('public')}}/static/546040dcc9031bdca5b39e4f866081ec.svg); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        <img
                                            src="{{asset('public')}}/static/546040dcc9031bdca5b39e4f866081ec.svg"
                                            draggable="false"></uni-image>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-66f4062e="" class="text">0/500</uni-view>
                            <uni-view data-v-66f4062e="" class="jindu">
                                <uni-progress data-v-66f4062e="" class="uni-progress" border-radius="20">
                                    <div class="uni-progress-bar"
                                         style="background-color: rgb(235, 235, 235); height: 20px;">
                                        <div class="uni-progress-inner-bar"
                                             style="width: 0%; background-color: rgb(0, 122, 255);"></div>
                                    </div>
                                </uni-progress>
                            </uni-view>
                        </uni-view>
                    </uni-view>
                    <uni-view data-v-66f4062e="" class="item_box">
                        <uni-view data-v-66f4062e="" class="item_top">
                            <uni-view data-v-66f4062e="" class="tops">
                                <uni-view data-v-66f4062e="" class="num">
                                    <uni-text data-v-0dd1b27e="" data-v-66f4062e="" class="u-count-num"
                                              style="font-size: 16px; font-weight: normal; color: #fff;">
                                        <span>{{price(auth()->user()->balance)}}</span></uni-text>
                                </uni-view>
                                <uni-view data-v-66f4062e="" class="tip">Balance</uni-view>
                            </uni-view>
                            <uni-view data-v-66f4062e="" class="tops">
                                <uni-view data-v-66f4062e="" class="num">
                                    <uni-text data-v-0dd1b27e="" data-v-66f4062e="" class="u-count-num"
                                              style="font-size: 16px; font-weight: normal; color: #fff;">
                                        <span>{{price(auth()->user()->receive_able_amount)}}</span></uni-text>
                                </uni-view>
                                <uni-view data-v-66f4062e="" class="tip">Receivable Balance</uni-view>
                            </uni-view>
                        </uni-view>
                        <uni-view data-v-a0cad060="" data-v-66f4062e="" class="u-divider" style="display: none;">
                            <uni-view data-v-2f0e5305="" data-v-a0cad060="" class="u-line"
                                      style="margin: 0px; border-bottom: 1px solid rgb(220, 223, 230); width: 100%; transform: scaleY(0.5); border-top-color: rgb(220, 223, 230); border-right-color: rgb(220, 223, 230); border-left-color: rgb(220, 223, 230); flex: 1 1 0%;"></uni-view>
                            <uni-text data-v-a0cad060="" class="u-divider__text"
                                      style="font-size: 14px; color: rgb(144, 147, 153);">
                                <span>Recharge or Withdraw</span></uni-text>
                            <uni-view data-v-2f0e5305="" data-v-a0cad060="" class="u-line"
                                      style="margin: 0px; border-bottom: 1px solid rgb(220, 223, 230); width: 100%; transform: scaleY(0.5); border-top-color: rgb(220, 223, 230); border-right-color: rgb(220, 223, 230); border-left-color: rgb(220, 223, 230); flex: 1 1 0%;"></uni-view>
                        </uni-view>
                        <uni-view data-v-66f4062e="" class="cw" style="display: none;">
                            <uni-navigator data-v-66f4062e="" class="">
                                <svg data-v-66f4062e="" t="1696658349071" viewBox="0 0 1024 1024" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" p-id="13598" width="48" height="48"
                                     class="icon">
                                    <path data-v-66f4062e=""
                                          d="M898.33 877.71H127.98c-31.19 0-56.56-25.37-56.56-56.56V204.08c0-31.19 25.37-56.56 56.56-56.56h770.35c31.19 0 56.56 25.37 56.56 56.56v617.06c0 31.2-25.37 56.57-56.56 56.57z m-751.5-75.42h732.65V222.94H146.83v579.35z"
                                          fill="#ffffff" p-id="13599"></path>
                                    <path data-v-66f4062e=""
                                          d="M917.18 710.53H112.84c-20.84 0-37.71-16.86-37.71-37.71 0-20.84 16.86-37.71 37.71-37.71h804.34c20.84 0 37.71 16.86 37.71 37.71s-16.87 37.71-37.71 37.71z"
                                          fill="#ffffff" p-id="13600"></path>
                                    <path data-v-66f4062e=""
                                          d="M482.76 516c-6.41 0-12.89-1.62-18.82-5.04-18.04-10.42-24.23-33.47-13.81-51.51l89.59-155.13c10.42-18.08 33.47-24.23 51.51-13.81s24.23 33.47 13.81 51.51l-89.59 155.13c-6.99 12.11-19.66 18.85-32.69 18.85zM604.12 516c-6.41 0-12.89-1.62-18.82-5.04-18.04-10.42-24.23-33.47-13.81-51.51l89.55-155.13c10.42-18.01 33.51-24.23 51.51-13.81 18.04 10.42 24.23 33.47 13.81 51.51l-89.55 155.13c-6.99 12.08-19.65 18.85-32.69 18.85zM725.49 516c-6.41 0-12.89-1.62-18.82-5.04-18.04-10.42-24.23-33.47-13.81-51.51l89.55-155.13c10.42-18.01 33.47-24.23 51.51-13.81s24.23 33.47 13.81 51.51l-89.55 155.13c-6.99 12.08-19.66 18.85-32.69 18.85z"
                                          fill="#ffffff" p-id="13601"></path>
                                    <path data-v-66f4062e=""
                                          d="M344.93 516H207.81c-20.84 0-37.71-16.86-37.71-37.71 0-20.84 16.86-37.71 37.71-37.71h137.13c20.84 0 37.71 16.86 37.71 37.71-0.01 20.85-16.88 37.71-37.72 37.71z"
                                          fill="#ffffff" p-id="13602"></path>
                                </svg>
                                <uni-text data-v-66f4062e=""><span>Recharge</span></uni-text>
                            </uni-navigator>
                            <uni-navigator data-v-66f4062e="" class="">
                                <svg data-v-66f4062e="" t="1696658496144" viewBox="0 0 1024 1024" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" p-id="19013" width="48" height="48"
                                     class="icon">
                                    <path data-v-66f4062e=""
                                          d="M921.5488 200.0384A71.9872 71.9872 0 0 0 849.8176 128H174.1312C138.24 128 102.4 163.9936 102.4 200.0384v111.0272h819.1488V200.0384zM102.4 388.1984V835.072C102.4 885.248 131.0976 921.5488 174.1312 921.6h675.6864c28.6976 0 43.0848-7.168 57.3952-28.8256-107.6224-194.6368-236.7488-158.6432-236.7488-158.6432v115.3792l-179.3536-187.4176 179.3536-151.1936v115.072s222.208-28.8256 251.136 237.9264V388.1984H102.4z"
                                          fill="#ffffff" p-id="19014"></path>
                                </svg>
                                <uni-text data-v-66f4062e=""><span>Withdraw</span></uni-text>
                            </uni-navigator>
                        </uni-view>
                    </uni-view>
                    <uni-view data-v-66f4062e="" class="item_gn">
                        <uni-view data-v-c496bc48="" data-v-66f4062e="" class="u-cell-group">
                            <uni-view data-v-c496bc48="" class="u-cell-group__wrapper">
                                <uni-view data-v-2f0e5305="" data-v-c496bc48="" class="u-line"
                                          style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content"
                                                  onclick="window.location.href='{{route('message')}}'">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-email"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: green;">
                                                        <span><img class="iconn" src="https://img.icons8.com/water-color/50/chat-message.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text"><span>Message</span>
                                                </uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>
                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell"
                                          onclick="window.location.href='{{route('user.change.password')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-order"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: blueviolet;">
                                                        <span><img class="iconn" src="https://img.icons8.com/fluency/48/lock-2--v1.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text">
                                                    <span>Security Password</span>
                                                </uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>
                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell" onclick="window.location.href='{{url('history')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-shopping-cart"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: #0f6674;">
                                                        <span><img class="iconn" src="https://img.icons8.com/fluency/48/bag-front-view.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text">
                                                    <span>Records</span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>


                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell" onclick="window.location.href='{{url('spin')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-gift"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: darkred;">
                                                        <span><img class="iconn" src="https://img.icons8.com/emoji/48/wrapped-gift.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text">
                                                    <span>Treasure Key</span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>

                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell"
                                          onclick="window.location.href='{{route('recharge.history')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-list-dot"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: rgb(96, 98, 102);">
                                                        <span><img class="iconn" src="https://img.icons8.com/fluency/48/ingredients-list.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text">
                                                    <span>Recharge Details</span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>
                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell" onclick="window.location.href='{{route('withdraw.history')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-checkmark-circle"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: rgb(96, 98, 102);">
                                                        <span><img class="iconn" src="https://img.icons8.com/fluency/48/ingredients-list.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text"><span>Withdrawal Details</span>
                                                </uni-text>
                                            </uni-view>
                                        </uni-view>
                                        <uni-view data-v-77b16486=""
                                                  class="u-cell__right-icon-wrap u-cell__right-icon-wrap--">
                                            <uni-view data-v-59765974="" data-v-77b16486=""
                                                      class="u-icon u-icon--right">
                                                <uni-text data-v-59765974="" hover-class=""
                                                          class="u-icon__icon uicon-arrow-right u-icon__icon--info"
                                                          style="font-size: 18px; line-height: 18px; font-weight: normal; top: 0px;">
                                                    <span></span></uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                    <uni-view data-v-2f0e5305="" data-v-77b16486="" class="u-line"
                                              style="margin: 0px; border-bottom: 1px solid rgb(214, 215, 217); width: 100%; transform: scaleY(0.5); border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-left-color: rgb(214, 215, 217);"></uni-view>
                                </uni-view>

                                <uni-view data-v-77b16486="" data-v-66f4062e="" class="u-cell"
                                          onclick="window.location.href='{{url('logout')}}'">
                                    <uni-view data-v-77b16486="" class="u-cell__body u-cell__body--large">
                                        <uni-view data-v-77b16486="" class="u-cell__body__content">
                                            <uni-view data-v-77b16486="" class="u-cell__left-icon-wrap">
                                                <uni-view data-v-59765974="" data-v-66f4062e=""
                                                          class="u-icon u-icon--right">
                                                    <uni-text data-v-59765974="" hover-class=""
                                                              class="u-icon__icon uicon-close-circle"
                                                              style="font-size: 24px; line-height: 24px; font-weight: normal; top: 0px; color: rgb(96, 98, 102);">
                                                        <span><img class="iconn" src="https://img.icons8.com/stencil/32/exit.png" alt=""></span></uni-text>
                                                </uni-view>
                                            </uni-view>
                                            <uni-view data-v-77b16486="" class="u-cell__title">
                                                <uni-text data-v-66f4062e="" class="u-cell-text"><span>Sign out</span>
                                                </uni-text>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                        </uni-view>
                    </uni-view>

                    @include('app.layout.manu')
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
</body>
</html>
