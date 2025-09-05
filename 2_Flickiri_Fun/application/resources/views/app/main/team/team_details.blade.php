<html lang="">
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/content/location/location.js"
    id="eppiocemhmnlbhjplcgkofciiegomcon"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/extend-native-history-api.js"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/requests.js"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="icon" href="/Sonatrach/dist/favicon.ico">
    <title> |Team Details</title>

    <link href="{{asset ('dash2/chunk-vendors.317e4ea8.css')}}" rel="stylesheet">
    <link href="{{asset ('dash2/app.1af1dbde.css')}}" rel="stylesheet">
    <script bis_use="true" type="text/javascript" charset="utf-8"
        data-bis-config="[&quot;facebook.com/&quot;,&quot;twitter.com/&quot;,&quot;youtube-nocookie.com/embed/&quot;,&quot;//vk.com/&quot;,&quot;//www.vk.com/&quot;,&quot;linkedin.com/&quot;,&quot;//www.linkedin.com/&quot;,&quot;//instagram.com/&quot;,&quot;//www.instagram.com/&quot;,&quot;//www.google.com/recaptcha/api2/&quot;,&quot;//hangouts.google.com/webchat/&quot;,&quot;//www.google.com/calendar/&quot;,&quot;//www.google.com/maps/embed&quot;,&quot;spotify.com/&quot;,&quot;soundcloud.com/&quot;,&quot;//player.vimeo.com/&quot;,&quot;//disqus.com/&quot;,&quot;//tgwidget.com/&quot;,&quot;//js.driftt.com/&quot;,&quot;friends2follow.com&quot;,&quot;/widget&quot;,&quot;login&quot;,&quot;//video.bigmir.net/&quot;,&quot;blogger.com&quot;,&quot;//smartlock.google.com/&quot;,&quot;//keep.google.com/&quot;,&quot;/web.tolstoycomments.com/&quot;,&quot;moz-extension://&quot;,&quot;chrome-extension://&quot;,&quot;/auth/&quot;,&quot;//analytics.google.com/&quot;,&quot;adclarity.com&quot;,&quot;paddle.com/checkout&quot;,&quot;hcaptcha.com&quot;,&quot;recaptcha.net&quot;,&quot;2captcha.com&quot;,&quot;accounts.google.com&quot;,&quot;www.google.com/shopping/customerreviews&quot;,&quot;buy.tinypass.com&quot;,&quot;gstatic.com&quot;,&quot;secureir.ebaystatic.com&quot;,&quot;docs.google.com&quot;,&quot;contacts.google.com&quot;,&quot;github.com&quot;,&quot;mail.google.com&quot;,&quot;chat.google.com&quot;,&quot;audio.xpleer.com&quot;,&quot;keepa.com&quot;,&quot;static.xx.fbcdn.net&quot;,&quot;sas.selleramp.com&quot;,&quot;1plus1.video&quot;,&quot;console.googletagservices.com&quot;,&quot;//lnkd.demdex.net/&quot;,&quot;//radar.cedexis.com/&quot;,&quot;//li.protechts.net/&quot;,&quot;challenges.cloudflare.com/&quot;,&quot;ogs.google.com&quot;]"
        src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/../executers/vi-tr.js"></script>

    <style>
.empty-wrap[data-v-e5ca3ba2] {
    width: 100%
}

.empty-wrap .empty[data-v-e5ca3ba2] {
    width: 52.2rem;
    height: 52rem;
    margin: 0 auto
}

.empty-wrap .text[data-v-e5ca3ba2] {
    color: rgba(0, 0, 0, .7);
    font-weight: 500;
    font-size: 2.8rem;
    margin-top: 2rem
}

.records[data-v-5bc6443d] {
    min-height: 100vh;
    background: #f7f6f3;
    overflow: hidden;
    position: relative
}

.records[data-v-5bc6443d]:after {
    content: "";
    width: 100%;
    height: 17.6rem;
    position: absolute;
    top: 0;
    left: 0;

}

.records .wire[data-v-5bc6443d] {
    width: 69.4rem;
    height: .1rem;
    background: #cecece;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 24rem;
    z-index: 111
}

.records .select[data-v-5bc6443d] {
    width: 65rem;
    margin-top: 1rem;
    margin-bottom: 3rem;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 25rem;
    z-index: 111
}

.records .select .tilese[data-v-5bc6443d] {
    font-size: 2.8rem;
    font-family: HelveticaNeue;
    color: #fff
}

.records .select .search[data-v-5bc6443d] {
    width: 36.5rem;
    height: 5.6rem;
    background: #ededed;
    border-radius: .6rem
}

.records .select .search .left[data-v-5bc6443d] {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center
}

.records .select .search .left .datai[data-v-5bc6443d] {
    font-size: 2.4rem;
    color: #777;
    margin-right: 1rem;
    font-weight: 500
}

.records .select .search .left .dataimg[data-v-5bc6443d] {
    width: 2.8rem;
    height: 2.8rem
}

.records .select .search .btnsear[data-v-5bc6443d] {
    height: 5.6rem;
    width: 15.4rem;
    background: #ffc108;
    font-size: 3.2rem;
    font-weight: 500;
    font-weight: 400;
    color: #333841;
    border-radius: .6rem;
    line-height: 5.6rem
}

.records .listrecore .toptitle[data-v-5bc6443d] {
    display: flex;
    align-items: center;
    margin-bottom: 2rem
}

.records .listrecore .toptitle span[data-v-5bc6443d] {
    width: 2rem;
    height: 2rem;
    background: #777;
    border-radius: 50%;
    margin-right: 2rem
}

.records .listrecore .toptitle p[data-v-5bc6443d] {
    font-size: 3.2rem;
    font-weight: 400;
    color: #333841
}

.records .listrecore .contit[data-v-5bc6443d] {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border-radius: .8rem;
    padding: 1rem;
    margin-bottom: 2rem
}

.records .listrecore .contit .rightname[data-v-5bc6443d] {
    width: 100%;
    padding: 3rem;
    position: relative
}

.records .listrecore .contit .rightname img[data-v-5bc6443d] {
    width: 8.4rem;
    height: 8.4rem;
    position: absolute;
    top: .5rem;
    left: 1rem
}

.records .listrecore .contit .rightname .leftname[data-v-5bc6443d] {
    text-align: left;
    margin-left: 8rem
}

.records .listrecore .contit .rightname .leftname p[data-v-5bc6443d] {
    font-size: 2.6rem;
    font-weight: 700;
    color: #000
}

.records .listrecore .contit .rightname .leftname span[data-v-5bc6443d] {
    font-size: 2.4rem;
    color: #999
}

.records .listrecore .contit .rightname .amount[data-v-5bc6443d] {
    font-family: bold;
    color: #333;
    font-size: 2.8rem;
    font-weight: 500
}

[data-v-5bc6443d] .nav-box {
    width: 75rem;
    height: 5rem;
    background: none;
    padding-top: 5rem
}

[data-v-5bc6443d] .nav-box .van-nav-bar__content .van-nav-bar__left img {
    width: 2.6rem;
    height: 3rem
}

[data-v-5bc6443d] .nav-box .van-nav-bar__content .van-nav-bar__left i {
    color: #000;
    font-size: 3.4rem
}

[data-v-5bc6443d] .nav-box .van-nav-bar__content .van-nav-bar__title {
    max-width: 80%
}

[data-v-5bc6443d] .nav-box .van-nav-bar__content .van-nav-bar__title p {
    font-size: 3.6rem;
    font-weight: 700;
    color: #000
}

[data-v-5bc6443d] .nav-box:after {
    display: none
}

[data-v-5bc6443d] .tabs-box {
    padding: 0 2.8rem;
    margin-top: 3rem
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap {
    height: 23rem;
    background: none
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav {
    width: 100%;
    z-index: 1;
    box-sizing: border-box;
    border-bottom: .1rem solid #cecece;
    margin: 0 auto;
    margin-top: 12rem;
    justify-content: space-between
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab {
    width: 20rem;
    height: 7rem;
    flex: none;
    border: .1rem solid #979797;
    border-radius: .8rem
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab span {
    font-size: 3.2rem;
    font-weight: 400;
    color: #333
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab--active {
    border: 0;
    background: linear-gradient(180deg, #ffd100, #ffa400)
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab--active span {
    font-weight: 700;
    font-size: 3.2rem
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tabs__line {
    display: none
}

[data-v-5bc6443d] .tabs-box .van-tabs__content {
    margin-top: 1rem
}

[data-v-5bc6443d] .selectuis .van-picker__toolbar {
    padding: 0 4rem
}

[data-v-5bc6443d] .selectuis .van-picker__cancel {
    width: 15rem;
    height: 5rem;
    border-radius: .8rem;
    border: .2rem solid #0091ff;
    color: #0091ff;
    font-weight: 500
}

[data-v-5bc6443d] .selectuis .van-picker__confirm {
    width: 15rem;
    height: 5rem;
    background: #0091ff;
    border-radius: .8rem;
    color: #fff;
    font-weight: 500
}

[data-v-5bc6443d] .tabs-box .van-tabs__wrap .van-tabs__nav {
    background: none
}
    </style>
</head>

<body __processed_d59e4eec-1f2c-43a7-909e-d1dcea740794__="true"
    bis_register="W3sibWFzdGVyIjp0cnVlLCJleHRlbnNpb25JZCI6ImVwcGlvY2VtaG1ubGJoanBsY2drb2ZjaWllZ29tY29uIiwiYWRibG9ja2VyU3RhdHVzIjp7IkRJU1BMQVkiOiJlbmFibGVkIiwiRkFDRUJPT0siOiJlbmFibGVkIiwiVFdJVFRFUiI6ImVuYWJsZWQiLCJSRURESVQiOiJlbmFibGVkIiwiUElOVEVSRVNUIjoiZW5hYmxlZCIsIklOU1RBR1JBTSI6ImVuYWJsZWQiLCJMSU5LRURJTiI6ImRpc2FibGVkIiwiQ09ORklHIjoiZGlzYWJsZWQifSwidmVyc2lvbiI6IjIuMC4xNiIsInNjb3JlIjoyMDAxNjB9XQ=="
    class=""><svg aria-hidden="true" style="position: absolute; width: 0px; height: 0px; overflow: hidden;">
        <symbol id="icon-icon-android" viewBox="0 0 1024 1024">
            <path
                d="M634.3 90.1l49.8-77.7c2.1-3.3 1.3-7.9-1.7-10.2l-1.2-0.9c-3.1-2.3-7.3-1.4-9.5 1.9l-51.2 79.9C587 67.5 549.7 58.8 510.3 58.8c-37.4 0-72.9 7.9-105 22L356.2 4.4c-2.1-3.3-6.4-4.2-9.5-1.9l-1.2 0.9c-3.1 2.3-3.9 6.9-1.7 10.2l47.3 73.8c-74.4 38.3-127.9 111.3-138.8 197.4h515.8c-10.6-84.1-62-155.8-133.8-194.7zM401.6 201.4c-14.2 0-25.7-12.4-25.7-27.7s11.5-27.7 25.7-27.7 25.7 12.4 25.7 27.7-11.5 27.7-25.7 27.7z m221.9 0c-14.2 0-25.7-12.4-25.7-27.7s11.5-27.7 25.7-27.7 25.7 12.4 25.7 27.7-11.5 27.7-25.7 27.7zM153.8 325.2h11.4c28.2 0 51.3 31.8 51.3 70.6v226.7c0 38.9-23.1 70.7-51.3 70.7h-11.4c-28.2 0-51.3-31.8-51.3-70.7V395.8c0-38.8 23.1-70.6 51.3-70.6z m705 1.3h11.4c28.2 0 51.3 31.8 51.3 70.6v226.7c0 38.9-23.1 70.7-51.3 70.7h-11.4c-28.2 0-51.3-31.8-51.3-70.7V397.2c0.1-38.9 23.1-70.7 51.3-70.7zM466.1 825.4v127.8c0 38.8-23.1 70.6-51.3 70.6h-11.4c-28.2 0-51.3-31.8-51.3-70.6V825.4h-47.2c-28.8 0-52.4-25.4-52.4-56.5V321.7H772v447.2c0 31.1-23.6 56.5-52.4 56.5h-43.3v129.2c0 38.9-23.1 69.4-51.3 69.4h-11.4c-28.2 0-51.3-30.5-51.3-69.4V825.4h-96.2z m0 0">
            </path>
        </symbol>
        <symbol id="icon-lvdouya" viewBox="0 0 1024 1024">
            <path
                d="M282.5 386.3c65.4 34.4 99.9 106.6 130.2 174 16 35.7 32 71.4 48 107.2 5.8 12.9 24.2 26.8 32.6 38.2 13.3 18 53.7 59.1 73 70.3 107.3 62.1 257 89.1 362.9 44.2l30.6-18.6c-57.3 30.1-127.4 20.4-189.1 0.9-63.9-20.2-126.3-51.4-170-102.2-15.5-18-28.3-38.1-41-58.1-13.1-20.6-26.3-41.3-39.4-61.9-10.7-16.8-21.4-33.6-31.4-50.7-9.7-16.6-18.7-33.6-30.3-48.9-14.7-19.4-33-35.6-52-50.9-38.1-30.7-92.3-58.3-140.3-48.8l16.2 5.3z"
                fill="#DEE3A0"></path>
            <path
                d="M128.7 301.1c-19.2-3-39.7 4.9-52 20s-15.8 36.8-9 55c6.9 18.5 23 32 39.9 42.3 27.8 17.1 60.1 28.2 92.7 26.7s65.3-16.7 83.9-43.5c17.7-25.5 21.1-59.1 14.3-89.3s-22.9-57.7-41.5-82.5c-16.5-22-35.6-42.6-59.5-56.1-24-13.4-53.4-18.9-79.3-9.7s-46.4 35-44.8 62.4c1.8 29.9 26.8 52.5 50.6 70.8l4.7 3.9z"
                fill="#7BAD37"></path>
            <path d="M214.7 352c-43.2-16-86-50.9-86-50.9-17.6-2.7-36.2 3.7-48.6 16.3 32.9 11.9 107.7 37.4 134.6 34.6z"
                opacity=".2"></path>
            <path
                d="M606.8 299.8c24.1 46 15.3 101.5 6 152.5-5 27-9.9 54.1-14.9 81.1-1.8 9.8-3.6 19.7-3.3 29.7 0.5 15.7 14.4 61 21.2 75.1 37.3 78.8 113.1 154 192.2 170.3l25.1 1.4c-45.2-5.4-81.8-38.9-109.8-74.8-28.9-37.1-52.6-80.1-57.6-126.8-1.8-16.6-1.2-33.3-0.6-49.9 0.6-17.2 1.2-34.3 1.9-51.5 0.5-14 1-27.9 2.1-41.9 1-13.4 2.6-26.9 2-40.3-0.8-17.1-4.9-33.8-9.8-50.1-9.8-32.9-30.2-70.5-61.7-84.1l7.2 9.3z"
                fill="#DEE3A0"></path>
            <path
                d="M551.8 189.3c-9.9-9.4-24.9-13-38-9.2-13.1 3.8-23.8 15-27.1 28.2-3.4 13.5 0.6 27.7 6.2 40.4 9.3 21 23.6 40.3 43 52.4 19.5 12.1 44.4 16.4 65.9 8.3 20.4-7.7 35.7-25.8 43.8-46 8.1-20.2 9.8-42.5 8.9-64.3-0.8-19.3-3.6-38.8-12.1-56.2-8.5-17.3-23.4-32.2-42-37.2s-40.8 1.7-50.8 18.2c-10.9 18-5.4 41.1 1.1 61.1l1.1 4.3z"
                fill="#7BAD37"></path>
            <path d="M581.3 253c-18.6-26.5-29.4-63.7-29.4-63.7-9.1-8.6-22.4-12.3-34.6-9.9 14.2 19.9 47.3 64.5 64 73.6z"
                opacity=".2"></path>
            <path
                d="M803.8 336c8.2 43.4-12.8 86.4-33.2 125.6-10.8 20.8-21.6 41.5-32.4 62.3-3.9 7.5-7.9 15.1-10.1 23.3-3.5 12.9-3.5 53.2-1.5 66.4 10.8 73.4 53.7 153.6 114 186.5l20.1 7.4c-35.4-15.7-56.9-52.1-70.7-88.3-14.3-37.4-22.8-78.3-15.3-117.6 2.7-13.9 7.3-27.4 12-40.8 4.8-13.8 9.6-27.6 14.4-41.5 3.9-11.2 7.8-22.5 12.1-33.6 4.2-10.7 8.8-21.2 11.7-32.3 3.6-14.1 4.4-28.7 4.5-43.3 0.2-29.3-7-64.9-29.3-83.9l3.7 9.8z"
                fill="#DEE3A0"></path>
            <path
                d="M786.6 232.3c-5.7-10.1-17.1-16.8-28.7-17-11.6-0.2-23.1 6.2-29.1 16.2-6.1 10.1-6.4 22.7-5 34.4 2.3 19.4 9.1 38.6 21.9 53.4 12.8 14.7 32.1 24.4 51.6 23.2 18.5-1.2 35.5-12.1 47.2-26.5 11.7-14.4 18.5-32.2 23.3-50.1 4.2-15.9 6.8-32.5 4.2-48.7-2.6-16.2-11-32.1-24.9-40.8s-33.6-8.8-45.9 2.2c-13.4 11.9-14.6 32.1-14.4 50l-0.2 3.7z"
                fill="#7BAD37"></path>
            <path d="M794.7 291.5c-8.5-26.2-8.1-59.2-8.1-59.2-5.2-9.2-15.2-15.6-25.7-16.7 6.7 19.8 22.5 64.4 33.8 75.9z"
                opacity=".2"></path>
            <path
                d="M280.3 718.4c57.9 6.5 102.1 47.9 141.8 87.1 21.1 20.8 42.1 41.6 63.2 62.3 7.6 7.5 15.3 15.1 24.6 20.9 14.5 9 64.9 24.2 82.2 26.8 96.4 14.7 215.8-6.8 284.1-67l18.3-21.4c-35.5 36.7-90.6 48.8-142 51.8-53.1 3.1-108-2-153.7-25.9-16.2-8.5-30.9-19.1-45.5-29.7-15.1-10.9-30.2-21.9-45.3-32.8-12.3-8.9-24.5-17.8-36.4-27.2-11.4-9-22.5-18.5-35.1-26.2-15.9-9.7-33.9-16.1-51.9-21.7-36.4-11.3-84.2-16-117.9 3.6l13.6-0.6z"
                fill="#DEE3A0"></path>
            <path
                d="M143.1 700.1c-15.2 3.1-28.6 14.2-34.1 28.1s-2.6 30.1 7.1 41.1c9.9 11.1 25.4 16.3 40.7 19 25.2 4.5 52.3 3.6 76.5-6.3 24.2-9.9 44.9-29.4 52.1-53.3 6.8-22.7 0.9-47.2-11.8-66.6-12.8-19.4-31.8-34.4-52.1-46.8-18-11-37.5-20.3-58.9-23.3s-45 1.2-62.1 14.6-26.1 37.1-17.9 55.9c8.9 20.5 33.5 29.7 55.9 36.1l4.6 1.5z"
                fill="#7BAD37"></path>
            <path
                d="M220.6 712.6c-36.5 0.4-77.5-12.6-77.5-12.6-13.9 2.8-26.3 12.4-32.4 24.6 27.7-0.5 90.4-2.8 109.9-12z"
                opacity=".2"></path>
            <path
                d="M263.1 531s6.3 3.6 8.3 9.5c-1.5-6.1-8-9.9-8.2-9.7-0.2 0.1-0.1 0.2-0.1 0.2zM276.5 527.4s2.2 5 1 9.5c1.5-4.4-0.7-9.7-0.9-9.6l-0.1 0.1zM284.7 528.9s0.3 5.4-2.3 9.3c2.9-3.7 2.6-9.4 2.4-9.4-0.1 0-0.1 0.1-0.1 0.1zM262.9 544.8s5 0.3 8.5 5.3c-3-5.3-8.4-5.8-8.5-5.5-0.1 0.1 0 0.2 0 0.2z"
                fill="#7BAD37" opacity=".3"></path>
        </symbol>
    </svg>
    <div id="app" data-v-app="" bis_skin_checked="1">
        <div data-v-5bc6443d=""  Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="records"  bis_skin_checked="1">
            <div data-v-5bc6443d="" Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="wrap" bis_skin_checked="1">
                <div data-v-5bc6443d="" class="van-nav-bar van-hairline--bottom nav-box" bis_skin_checked="1">
                    <div class="van-nav-bar__content" Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" bis_skin_checked="1">
                        <div class="van-nav-bar__left van-haptics-feedback" bis_skin_checked="1">
                            <i onclick="window.location.href='{{route ('user.team')}}'" class="van-badge__wrapper van-icon van-icon-arrow-left van-nav-bar__arrow"><!----><!----><!----></i>
                            <!---->
                        </div>
                        <div class="van-nav-bar__title van-ellipsis" bis_skin_checked="1">
                            <p data-v-5bc6443d="">Team income</p>
                        </div>
                        <!---->
                    </div>
                </div>
            </div>
            <div data-v-5bc6443d="" class="van-tabs van-tabs--line tabs-box" bis_skin_checked="1">
                <div class="van-tabs__wrap" bis_skin_checked="1">
                    <div role="tablist" class="van-tabs__nav van-tabs__nav--line" aria-orientation="horizontal"
                        bis_skin_checked="1">
                        <!---->
                         @if($generation == 1)
                   <div id="van-tabs-18-0" role="tab"  onclick="window.location.href='{{route('team.details', 1)}}'"  Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="van-tab van-tab--line van-tab--active" tabindex="0"
                            aria-selected="true" aria-controls="van-tab-19" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 1</span></div>
                             <div id="van-tabs-18-1" role="tab"  onclick="window.location.href='{{route('team.details', 2)}}'" class="van-tab van-tab--line" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-20" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 2</span></div>
                        <div id="van-tabs-18-2" onclick="window.location.href='{{route('team.details', 3)}}'"  role="tab" class="van-tab van-tab--line" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-21" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 3</span></div>
                @elseif($generation == 2)
           <div id="van-tabs-18-1" role="tab" onclick="window.location.href='{{route('team.details', 1)}}'" Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="van-tab van-tab--line" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-20" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 1</span></div>
                             <div id="van-tabs-18-1" onclick="window.location.href='{{route('team.details', 2)}}'" role="tab"  Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="van-tab van-tab--line van-tab--active" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-20" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 2</span></div>
                        <div id="van-tabs-18-2" onclick="window.location.href='{{route('team.details', 3)}}'" role="tab"  Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="van-tab van-tab--line" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-21" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 3</span></div>
                @elseif($generation == 3)
   <div id="van-tabs-18-1" role="tab" onclick="window.location.href='{{route('team.details', 1)}}'" Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" class="van-tab van-tab--line" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-20" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 1</span></div>
                             <div id="van-tabs-18-1" onclick="window.location.href='{{route('team.details', 2)}}'" Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" role="tab" class="van-tab van-tab--line " tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-20" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 2</span></div>

                                       <div id="van-tabs-18-2" onclick="window.location.href='{{route('team.details', 3)}}'"  Style="  background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);" role="tab" class="van-tab van-tab--line van-tab--active" tabindex="-1"
                            aria-selected="false" aria-controls="van-tab-21" bis_skin_checked="1">
                            <span class="van-tab__text van-tab__text--ellipsis">Level 3</span></div>
                @else
                    Illegal Generation Code
                @endif
                        
                              


<div class="van-tabs__line" style="transform: translateX(55px) translateX(-50%);"
                            bis_skin_checked="1">
                            

                            
                            </div>



                        <!---->
                    </div>
                </div>
                            
   

           
                                                                                     <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
     background: linear-gradient(to bottom, #62eca1 0%, #e5da58 100%);
  color: white;
}
</style>
</head>
<body>



<table id="customers">
  <tr>
    <th>User ID</th>
    <th>Invested</th>
 
  </tr>

 @foreach($users as $element)
  <tr>
    <td>{{$element->ref_id}}</td>
    <td>{{(\App\Models\Deposit::where('status', 'approved')->where('user_id', $element->id)->sum('amount'))}}</td>
  
  </tr>
      @endforeach
</table>

</body>
</html>           
                            
                            
                  
              
                <!---->
                <div class="van-tabs__content" bis_skin_checked="1">
                    <div data-v-5bc6443d="" id="van-tab-19" role="tabpanel" class="van-tab__panel" tabindex="0"
                        aria-labelledby="van-tabs-18-0" style="" bis_skin_checked="1">
                        <div data-v-5bc6443d="" class="listrecore" bis_skin_checked="1">
                            <div data-v-5bc6443d="" role="feed" class="van-list" aria-busy="false" bis_skin_checked="1">
                                <div data-v-e5ca3ba2="" data-v-5bc6443d="" class="empty-wrap" style="margin-top: 10rem;"
                                    bis_skin_checked="1"><img data-v-e5ca3ba2="" class="empty" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgoAAAIICAYAAAAPCcZeAAAAAXNSR0IArs4c6QAAIABJREFUeF7svQmcJEd15x8v8qiqzKyj7+6570OjGY3uW0JCgCwjhCwwMsaLjf3334ttbLzGizFeH4BtwDZrdhf+6/34WrzG5gaBBAiBMEISAkmjazT32TPTd3dVZmUdmRlv/1nV1V09Z3d1XVn56sPQra6Md3wju/LXES8igNGLCBCBQBFARMU0zaSqxpOuyzTOHc3zPI1zJSaEpwFIMUShAQhNCIhJEpcZY5IQQgZgkv89IpR+VvXPZ+BV/iEyj3N0/a+M8dLPEYXDOdgAzEbkOUQvx7lkC+HkhJBykoS262I2mYxMM8bSAOC3oxcRIAIBJwABj5/CJwIdRQARpWyW9TJW7BeCpyQJUogshShSnFe+RyMISSMyCwBnGIMZAD4jhJsu/zefMgx1lDE2RWIiCD1JMYadAAmFsN8BlH/TCSAiN03WBVAcYIz3MyYGGIN+xtD/2sMY400PqgUOOeeeEN4kYzDGGI4xJsZUNTpaKLCxeLwkIkQLwiKXRIAInEWAhALdEkSggQQQMZJOF1ZFItIqz8M1QuBqAFjJGPOH/ul1YQJFRDjFuTiJyIcVxTsZiUROAUCBoBEBItBcAiQUmsubvHUwAUSMWVZxPQCuAeCrhYDVjGE/Y4x+z+rT78gYjiPCSUniJyVJOhKJsGMkHuoDl6wQgQsRoA8wujeIQI0E0mnslmVnIyLfhOhtYqw0UkC/UzXyrLGZYAyHGWOHhYDDjCmHk0mYqtEWNSMCROA8BOhDjW4LIrBIArZtr/Q82MK5tBERNiJi9yKb0mVNJACA0wBwWAjvEEB0r2GAXzhJLyJABGokQEKhRnDUrPMJjI2hoevOdkR2GWO4AxGSnZ9152UIgFOMwV4AtlfTlH0AkO28LCkjItA4AiQUGseWLAeMgL80MZMpbJBl+TLP83YAwBqaSghYJ146XETEE5Ik7fX/RSLsMC3RvDQ0uiLcBEgohLv/Q5/90aMY7e93dngeuwqAXc4Yi4YeSrgA+BtIvciY8ryus70AUAxX+pQtEbg0ARIKl2ZEV3QYgZGREV3TenYB4FWM+dMKtFSxw7q4pnQ450XGxF7Pgz3xuPwiTVHUhJEadSABEgpt3qn+OnzGWCKbLW23S68aCQAwLoS7GQCvRGRbw7KpUY24qBljAgAOIrKfZLOTzw4ODlJdA90VoSVAQqGNut5fh2/bzuWex3YDlNbg+8VzNBTeRn1EoYSSgMc5e4kx9iNNU14CACeUFCjp0BIgodAGXW/b9hrPk+/lnO8QQtDIQRv0CYVABC5AIAfAnhVC/CgejxwEACRSRKDTCZBQaGEPZzKZXsai9wGw61oYBrkmAkSgBgIA4J9H8ZSmSU/439dggpoQgUAQIKHQom6yLNwN4LxLCObXINCLCBCB4BLwRxVeBlC+r+vsFTrMKrgdSZGfnwAJhRbcGdmse48Q4r4WuCaXRIAINJCAv7kTgPSDQkH6YXc3pBvoikwTgaYRIKHQNNRlR6ZZeBtjcGeT3ZI7IkAEmkvAPyJ7D6J4PJGI7m+ua/JGBOpLgIRCfXle1Fom49wKgO9ooktyRQSIQMsJ4AnO4duapjxHu0C2vDMogBoIkFCoAVotTTKZ/BZJkn+bVjXUQo/aEIHgEyifOYGP6XrEL37MBz8jyiAsBEgoNKGn/TMELKv4J4xBXxPckQsiQATam0COMfyB66qPdXXBTHuHStERAcZIKDThLjDN3B2MSQ82wRW5IAJEICAEOOceIntKCPuRRCIxEZCwKcwQEiCh0OBO9w8d6utzP4yI8Qa7IvNEgAgEkEBZMIinhMiTYAhg/4UhZBIKDe7lTMa5BQB/ocFuyDwRIAIBJzAvGJSHEwmYDHg6FH4HESCh0ODONM3irzPGdjXYDZknAkSgQwiUBYP3pK6rD9OOjx3SqQFPg4RCAzvQP/nRspy/pmOMGwiZTBOBziXgMYaPG4b6DTryunM7OQiZkVBoYC+ZZuFyxuA3G+iCTBMBItDhBACYzRg8rOvy43RyZYd3dpumR0KhgR1jmrnbGJN+voEuyDQRIAIhIQAAkwD4ZU1TfkKnVoak09skTRIKDeyIbNa9Vwjxxga6INNEgAiEjAAiHmcMv5BIRA+ELHVKt0UESCg0ELxlFX8Bkd3SQBdkmggQgfASeF4I5XPJJB1xHd5boDmZk1BoIOdMpvirAOzqBrog00SACISbQBFAfEPXI4/SORLhvhEamT0JhQbStaziLyKyGxvogkwTASJABBhjOILIPptIRPYRDiJQbwIkFOpNtMpeJlO4HwDubqALMk0EiAARmCPAOfuxpimfB4A0YSEC9SJAQqFeJM9jxzSdOxhDOuOhgYzJNBEgAucQKADAV3Vd/h4ACOJDBJZLgITCcglepH02W7xSCPZrDXRBpokAESAC5yWAiEc4d/7JMIwRQkQElkOAhMJy6F2irX8QlGU5H2d0SmcDKZNpIkAELkLABYCv6brsFzvS6ALdKjURIKFQE7bFN7Is532IuGnxLehKIkAEiEB9Cfh7L0iS+o+6Dqfra5mshYEACYUG97JlOa9HxAca7IbMEwEiQAQuRcDjnH9d06Rv0VLKS6Gi96sJkFBo8P0wMzPTJUnah+lgqAaDJvNEgAgsigDncAKx8HdUu7AoXHQRzZ035x4wzcIDjMHrm+ONvBABIkAELk6Ac14EwH/TNOUJYkUELkWARhQuRagO7yOiZlnORxhjWh3MkQkiQASIQL0IPJ/NTn1mcHAwWy+DZKfzCJBQaFKf2rZzs+fhf2iSO3JDBIgAEVgUAUScYQz/PpGI7l9UA7oodARIKDSxyy2r8HOI8JomuiRXRIAIEIHFEEDO+Tc1TXqICh0Xgytc15BQaGJ/I6KUzRbeg8i3NdEtuSICRKCzCSAAHAGAVzwPpwBE2vOwUEvKyWRkDADMWtpSm84lQEKhyX179ChGe3uddzHGrmiya3JHBIhAZxFwEPExx7Ee6+npyXRWapRNOxEgodCC3kBEsG3vPiHET7XAPbkkAkQg4AQA2Kuua/9TKpWaDngqFH4ACJBQaGEnWRbuBHDfIgQOtjAMck0EiECACEgS/24sJvknRNKWzAHqtyCHSkKhxb2HiNyy8rcA8DciQrLF4ZB7IkAE2pgAAH/CMOTPtHGIFFoHEiCh0Cad6gsG0yxsBpCvAPB2I0JPm4RGYRABItAGBADgsK7Lf0WrEtqgM0IWAgmFNu1wRIxlsywpRDEly5BwXZAuFqosI1a/77oAksTuaPK0hsIY422KlMIiAkEmgJKkfFjTYDjISVDswSRAQiGY/daWUfujIowxI5strmVM2o0ormeM+eKBXkSACCyDACL7USKh/v0yTFBTIlAzARIKNaOjhpci4B+Ixbn2FgB2zaWupfeJABG4MAFFUT4ejcIhYkQEWkGAhEIrqIfMp2U5r0PEt4QsbUqXCNSFACKz4nHlfbTKoS44yUgNBEgo1ACNmiydQDbrvkkI8dNLb0ktiEC4CXDO9ui6+ulwU6DsW0mAhEIr6YfIt7/JlGkWfw8ANoQobUqVCCybAAB/3DDkzy7bEBkgAjUSIKFQIzhqtnQC+TxuchznfUtvSS2IQHgJcM6/quvyw+ElQJm3mgAJhVb3QMj8m6bzp4zhQMjSpnSJQM0EAOBLhqF8q2YD1JAILJMACYVlAqTmSyNgmoW3MgZ3La0VXU0EwktAkvi3NU3+YngJUOatJkBCodU9EDL/uZxzu+vi20OWNqVLBGomgMieSSTUv6vZADUkAsskQEJhmQCp+dIIZLPFq4Vgv7q0VnQ1EQgvAc5hWNeVD4WXAGXeagIkFFrdAyHzb5q52xiTfj5kaVO6RGBZBBCVDyQSMLksI9SYCNRIgIRCjeCoWW0EbNu93/PE3bW1plZEIJwEAOCLhqF8O5zZU9atJkBCodU9EDL/2azzh0LgqpClTekSgWURmN2d8Q8AIL8sQ9SYCNRAgIRCDdCoSW0EJift1aoqf7C21tSKCISbACJ+M5GIfDncFCj7VhAgodAK6iH1aZrF9zDGdoQ0fUqbCCyXAAKwTxuG+sJyDVF7IrAUAiQUlkKLrq2ZgGk6dzCGD9ZsgBoSASLgEygoiviv0Wj0COEgAs0iQEKhWaRD7CedLl7HOfslxhgPMQZKnQjUi4ArBPtMMqk+XS+DZIcIXIwACQW6PxpGABGjuZz3Rs8Tr2uYEzJMBEJKwD9VElH5smHASEgRUNpNIkBCoUmgw+LGPyVyaiq3KhpVdyPi7YgYD0vulCcRaAEBZIy9JEmwp1jM7k0mkzMA4P+MXkSgbgTqLhSmpzGlKM46AL6WMdbreW4XgGRwzuruq24UyFBdCCCKCICUEEJIdTFIRohAiAn4I3I1LIcUiJiRJB6YZZSIeEzXlX8CABHi7m7r1Ovy8J6cnEyoauIaRHEDAPgCgV5EgAgQASKwDAJ2sXC3KknPyZI8tgwzgWgKgN83jMi/BCLYEAZZs1Dwh5ht27lSCHYzY+wyKlQL4d1DKRMBItAwArlC/o2qqv5IAj7eMCdtZBgAvmwYyjfbKCQKZZZATULBtu01QigPIuJGIkkEiAARIAL1J2Dn82+KKJEfSlJ4zniQJPYPmkarOep/Ny3P4pKEAiLq2WzxzYhwK2NUc7A89NSaCBABInBhApls9s16TPu+xGE6LJw4554Q3n+PxyN7w5JzEPJctFDI53Gr6zr/LyLTg5AYxUgEiAARCDIBy7Z/JhaNPSZxSAc5jxpiL0iS+5eapp2ooS01aQCBRQkF2y5e73nsnYwxqmZvQCeQSSJABIjA2QQy2eyDcU37GgDYYaMDgBkhCh9NJBITYcu9HfO9pFBIp/P3cM7va8fgKSYiQASIQIcSgLRlvTNpGP/YofktIi08YxjqX9SwRHQRtumSpRC4qFAwzcKDjMEdSzFI1xIBIkAEiMDyCAjhxU07f3fS0D+/PEuBb/2CYSifpk2kWtuPFxQKpuncxhj+fGvDI+9EgAgQgfARcBx3Ra5Q3JUwtNAvF+ScP6zr8lfDdxe0T8bnFQq5HK53Xed9VJPQPh1FkRABIhAeArlicZvrut1xTXsyPFlfOFPO2d/quvossWgNgXOEgr/LoqIYfwAAqdaERF6JABEgAuEmYGbt22RZGolFIgfCTaKcPee8CCB9TNPgJPFoPoFzhIJlFX8LsbTTIr2IABEgAkSgBQSmzMzPJTX9IUmSrBa4b0uXADCl6/KfAYDZlgF2cFALhIJpFrYzBr/dwflSakSACBCBtibgCTQyWfONXfHEv7Z1oC0IDgAO6br81wDgtcB9aF0uEAqW5bwfEdeHlgYlTgSIABFoMYFsLr/VE6I/oWs/aHEobeqePxaPy59r0+A6Mqw5oWBZxd2I7D92ZJaUFBEgAkQgIARmTOt1UVU5HI1EjgQk5KaHCaB82jBgT9Mdh9RhSSiUT4J0/1AIXBlSDpQ2ESACRKDlBITA6FR65q093V3/AshoeP0CPQLAbCHyH6GdG5tzy5aEwsxMbr0kSe9vjkvyQgSIABEgAucjYNn2TiEwkTD0HxKhixMAgKO6Ln+c6hUaf6eUhEI2694nhLin8e7IAxEgAkSACFyIwGQ685a4HntclRU642BRtwk+Fo9HqF5hUaxqv6gkFEyz8IeMwarazVBLIkAEiAARWA6BQqEwkM3lb+5OJb+0HDthawvAPmUY6gthy7uZ+QIidlmW8xfNdEq+iAARIAJEYCGBqZn0T0dUdZ+uxQ4Tm8UTKNcrKB9OJGBy8a3oyqUQANN0bmcM376URnQtESACRIAI1I9Avlhcadr29X2pFI0m1IAVEY/E46pfryBqaE5NLkEALKvwDkS4lUgRASJABIhAawiMT8282dC0Z2NRlbYorrELAMSXDSMa+kO0asR30WZgWc7vIOLWRhgnm0SACBABInBxAlk7t8HO53f0dXc9RKyWRcCTJOUjmganlmWFGp9DwBcKf4aIPcSGCBABIkAEmktACIyMTU490JVMfDui0kqH5dLnHIY1rXQeBO1BsVyYVe3BNIufYIxpdbRJpogAESACRGARBCZnZu6UJCmdisfpCOVF8FrMJZzzR3Rd/spirqVrFkfAFwqfYoxJi7ucriICRIAIEIF6EDBte0M2m9s92NfjP9SoCK8eUMs2UJaVj8ZicLR+JsNtyRcK/zPcCCh7IkAEiEBzCTiup41PTd3f25V8WFXU6eZ6D4M3HDMM9UMAUAxDto3OkYRCowmTfSJABIhAFQFEJo1MTNyrRaMHk3HjFYLTGAIA7ElZVp6us3XPcVjGMNhMmEQIZLPFTwrBInWGSeaIABEgAkTgPARGp6bukkDK9XYl6TyHQN8hOCZJ0p5i0XkulYp19DSHv+rhY4iYDHR/UfBEgAgQgQAQmJyZuc51vO6Bvp5v+XPpAQiZQlwcgZclSflSpy7NhGzW+S90vPTi7gS6iggQASJQK4EZ09yWtfM7Bvt7vyYBOLXaoXZtSwAB4IuGoTzathHWGJhfo/BrjLEra2xPzYgAESACROASBKYzvkjI7h7s7X1IluUsAetcAgDsKV1X/ncnbScNmUzhzQDwU53bbZQZESACRKB1BCbTmcuztn3ZUG/vNxSFRELreqKZnvE78Xjk88302EhfYFnFKxDZuxvphGwTASJABMJIYGImvTuXy28c7Ot9WJGlXBgZhDVnIdg/JJNqvVddtASnf8x0zLIcf3dGaEkE5JQIEAEi0IEExiamrssViytXDvY9LHOp0IEpUkoXIYDIrHhc+QMAyAcdVEkcZDLO+wFwfdCTofiJABEgAq0m4HmonJkYv4MJlIf6+x+VJCpcbHWftMo/5/xhXZe/2ir/9fJbEgqm6dzJGL6tXkbJDhEgAkQgjATyxULq9MjE6w09dqy/p/uZMDKgnOcJzI4qvC/ohY0loYCIhm17HxNC0JkPdJcTASJABGogMJMx101OZ27u7ko82ZWIN3QDHk94Cc8T61RFebGGUKlJEwkIIf4ymYwebKLLuruaq0uwrMI7EOHWunsgg0SACBCBDiaAyPjIxMQ1tl1Yt2Kg79uxqDrTyHQdz1tVdIq3RxTlaVmSDzfSF9lePoFOOM1yTij4uzPatvdhIYS6fDRkgQgQASLQ+QQsO987OjHxGlVRJocGen8oc6mhhxDli8Xdrudui6kxv/ZhsvMJBz9Dzvkzui7/XZAzWbDSIZt17xNC3BPkhCh2IkAEiECjCSAKPjI2dbVl25v7erqeSCXiJxrpExEVK2e/hgEohhZ7DBBoFUUjgdfRNgAcMAzlr+posummFggFRIyapvMRAGY0PRJySASIABEIAIGsbfedGZ+8XZWViRUDfU/KcmNHERzPS1pW9vWyIp2Ia7pfIElnRATgPqmEyDkM67ryoQCFfE6o5+ydYJq52xiTfj7ISVHs4SGAyBQARvvmh6fLW5ap63qRM2PjV9m53PqB3t4fpJLxk40Oxi4U1tq53C1aLPaUFokcabQ/sl9/Aoh4JJGIfLT+lptn8bybLGUyxXcCsJuaFwZ5IgJLJ2Dnc9f6G4Vp0RgtQ1s6PmqxSALlYsXxHdMz5hVxQz8w1N/7vCxJDRWniEyayZjXOa67OpVIPKoq0vQiw6XL2o/AC/G4+qn2C2vxEZ1XKCCinM2670XETYs3RVcSgeYRcD23J5fPvyFhGF9AZA0tIGteVuSp3QiMT02vH5+avj6mqmMrBvqfiURUq9ExFotO90QmfWdEVsZ6uxJPIoLbaJ9kv3EEJIk/qmnyFxrnofGWL7ht8+TkZCISMX4fEbobHwZ5IAJLIgBpy7o/qkaej6hKQ9erLykqurhjCMyY2f7RiYkbEAVbOTDwVFzXxpuR3OTMzK5sLr+zK2n8MK4Zx5rhk3w0lgAA/g/DiAR6v4uLnu9g27hKCPe3ETHeWJRknQgsnoBdKF7heW5/XNM67tz3xVOgKxtBYDpjDY5NTO52HDc50NfzTF93qilC1HFdfWRs4g5Jkrz+vu7HZU4HSDWif5ttk3NWGBtTfm/9+mCf93DJg6AyGeyRJPfdQuCqZkMmf0TgbAKewEQmm3lTykh8EQDoND66RepCYHxqZu3Y5PRuxlDqTaVeGOjr9gsHm7K6YGJ6ZvuMaV3dlTSe70mmXqlLQmSkTQjg9+LxyL+2STA1h3FJoeBbRsSIbTu/JAS7smZP1JAI1IGAmbXuVVRlf1SJHKiDOTIRYgLIGIyOjW8am5reLXM5P9Df83xPKjncLCRmNts3Oj55i6wo+cG+7h9G1UimWb7JT+MJcM6Lnif9cSIR/I2xFiUUZsUCmGbhXgDub8i06HaN7w7yEBYCuXxhS9FzNid14xthyZnyrD8B1/XUM2MTWyanZ3ZGIurk0EDfnlTcGKu/p/NbLLpO5PTI+LX5YmF1f3fPU92pBNUiNAt+E/0AwBcMQ+mI6dElP/CzWVwhhHM/Y2xXE5mTq5ATAGDSZCbzs0nD+JYEfCrkOCj9GghMpTODo+NT2+1cblVc146tGOh/ydBjDT2XoTpMzxPSyMTE9umZzBWJePzAyoH+5yWJVjTU0JVt34RztkfTlP8Z9FMjK6CXLBQqDdPp/GYA6QEAXN/2vUYBBp5ANp+7wnVFV9LQHw98MpRA0wgUnGL09OjElqmp9DZ/B8WeruS+ocHeQxJITVty6HmefGp0/LLJ9MzOuKafWjnQ+1wsGqNphqbdBc115G/ZrOvyJwGgoXttNDOrmoVCJUjLKuxChJsZYzsZY3RMdTN7LyS+BGJkJpN5a9IwviJJUsPXsYcEa0enOT41s2JkfGp7LpddkYgnjqwc6H01buhNHYmy83ltZGxyy2Q6syNpaCdXDvbv0WMkEDr5xgNgT+i68lmAzhopWrZQqHQ6IuqZjLNDkvhWRG8LY9BHtQyd/CvRvNwy2ewNAIBxTftR87ySp6ARmJxO949PTm1IW/Z6RZaz/T2pfUP9vUckqamjB9LpsYl1E1MzWwpFfwDDOLx6xYqXtGiEBG7QbqglxQtjAPgFw1BfWFKzgFxcN6Fwdr7+7o62bfcLIXdzDlEAiHgek8+6bpnLj2odPeS3MgZrAtJHoQ7T8zwjbVlv7kolPwe0A2Oo74XzJT8xPd0/NjG9Ycay1iuSlO9KJo8M9fUc0bWY2UhYiAJyhUI0ly/EcnbBmM5kBi07P1AsFruTcf1Uf2+vv9XzSYDmLLFsZK4dZtsGwLotq0aEM5yzJzVN2QMAXoexmkunYUKhXYEhYsy2nY8KwSLtGiPFNU8gk83eyDnPG7HY88SFCPgEJibT/aOTkxtmMuYGRZJz3anEkaGB3oaLg2r6j/3wmbcgMlmVpXwkqlqpeHysJ5Uc6elOTgBwQT3VFgRyiOwlSWJ7PE85Ho+zdCfVDTSTcOiEgmXl70Lkb20mZPJVGwFEVCZnph/sTnZ9nvNg72xWGwFq5RNwPU8em5gempiaWW1a5jpZVmxfHKwY6PPFAQ3p022ygAAAZhD5Q4Yh/7CT/8pvZreHSiggIrcs908ZQ79+gl5tTiCby13uum53Mh7/9zYPlcKrM4HptNk1Njm5eiZtrcoXC72xaHSsO5k4OdTfe5zEQZ1hd5A5zvkjmiY9AgCFDkqr5amESihYVvEKRPbullOnABZFYHw6/bZkXHtUlZWmVqsvKji6qK4ECoVi5MzY5MqJaX/UILtKknghlUqe7OtKnezv6xqRaDi/rrw70FiRc/b3uq7SFGUDOjdsQuG9iGxbAziSyToTyBWLa2w7t6snlfx6nU2TuTYg4HqOPDY+0z+RzgzNTKdXO8KLxzXtdE9X8uTQQM+wFo3ZbRAmhRAMAnlJUv5S0+BkMMINXpShEQrZbHaFEMofBa+LwhnxZDrzhpiqHNBisaac3hdOys3L2sxm9fGp6YHpGXMwY1mDRcc1dC02kUrEzwz2dA/39nQ15Rjn5mVMnppEAGePcX6pSf5C6SY0QsGyCu9AhFtD2csBS9ovYhybmvy5/u7e/wPAOnbJUcC6ZdHh+octjU9Od09MzwxMz2QGrWx2EJiEcSM22pWKj/T19Iz0pBI0nbRoonThhQhwzr+i6/IjRKixBEIhFEZGRvR4vPcvhBBqY3GS9XoQsPO5jbl8cV1PKvlYPeyRjeYQeHn/4R1jE1Nr7Vy+T1XVTHciPpJKJUaH+ntGdI2mEprTC2HyAmOGIf8xrWxofJ+HQiik0/k3cM5/pvE4yUM9CExMz7wuFo0c0mnaoR44m2bj4NETG2PRSK6/r3tMlZVad0NrWrzkKNgEOGd/q+vqs8HOIhjRd7xQ8JdEZrPFjyBCdzC6JNxR+jt6jkxOvn2wp+dfOm2/9HD3LGVPBOpJAMfi8cgf1tMi2bowgY4XCqZZ2M4Y/DbdBMEgYOfzq7P53GV9qa5vBSNiipIIEIHmE8BvxeORLzXfbzg9drxQyGSK7wJg14eze4OX9YxpXs0Y81Lx+J5LRX/45KnLI4qaTcX1SUPX6NjeSwGj94lAhxDwPPGxVCp6uEPSafs0OlooHD2K0d5e5+OMMSpibPtbsRzg2NTUT8U17YVYNHr6UiEPj4yvP3Ji+HX+dRzAUVV1KhZVJ7VodCoR1ye7EokpWZY65kz4S/Gg94lASAgIw1B+HQDoTI0mdXhHCwXbdm70PPzFJrEkN3UgcHps7D8M9PV9VgJY1AP+xX2Hb59Jp7fOHUM6+w2WD+1DRZHNmBqZSCT0M72p5JlUkpbl1aGbyAQRaBkBRJxJJCL/uWUBhNBxRwsFy3J+BxG3hrBfA5my47iJiZmpNwz19X9+sQm4rqf8+KW9D/htEedPLa9873/1fwzAmP+9LEl5LRYbScS1Mz1dyTM9qdTEYn3RdUSACLSeAAAcMwzlz1sfSXgi6FihgIjdluXQzRSgezmby63K2rnt/T3djy4l7Knp9MDLB4+TVk/IAAAgAElEQVTeyxjy0jBCSRxUi4aytfLPysKh8t+c86Khx850J5PHVw70H4vF1PxSfNO1RIAINJ3AK/G4+smmew2xw44VCtmse48Q4r4Q923gUjcta0uhWOzv7e5+YqnBHzh64pqR8cmr5gVBRRj4X+eFQXlkofye/70QCwSFMPTYSG8qeXTlir6jdN7AUnuBricCTSFAQqEpmOeddKxQMM3ChxiD/ibzJHfLIDCVTu9GZLwnlXxuqWYQBf/Ji/vuyxUKpSPELzQNMf+ef+uXRxfOd63/phaNjPX19BzcuHbFAUmSaAOhpXYKXU8EGkOAhEJjuF7QakcKhXw+v8FxOBW7NPlmWq678amZGxVFmk7F4/tqsZXJ2skX9h54wN+0qTyMAHMioDQd4f9ktlZhvoahJB3m3FWuq/zI/29Jkoo9qcT+DWtXvpIwDFqGWUvnUBsiUD8CJBTqx3JRljpSKFiW+3ZEcfuiCNBFbUNgdGLyNbFY9HhC12s+MfLIyTOXnRoZvQWFv3KqfHv7EqE8/VCpXZgfTSgnf9GRhfkRBwA0dO3khtUr9gz29Yy0DTgKhAiEiwAJhSb3d8cJhfKWze7HEdFoMktyt0wCIxOTt2lR9VTCiC9rI5Xn9x6427Sya0oS4DwrIap/vnBVRHVdg79UojzYULLhj0RU1TMkE/Gj2zeu+1EyQSMMy+x2ak4ElkQAAA4ZhuLvj0OvJhHoOKGQTuc3c85/t0n8yE0dCYxOTt4cUZXxVDxxYDlm84Vi7PlX9r3Fcb1YxU7pYV+ejVhQwDi/CmLhaogF7SqTE7OiozI9wQG8/p6uly/buuE5VVYWte/DcvKitkSACPgEYDweVz5ILJpHoOOEgm27b/E8Udqtj17BIjA2OXWDokjprkTy1eVGPjY5tWLf4RP3AENeWhQ5t/ShPBUxP6rg1zGUpynmRx8q9Q3zP6+MKszVLsza9H+BFFWZ2b1t66PdXfHp5cZN7YkAEbg4AX9Js67Lv0mcmkeg44SCaRY+zBiUKt/pFSwCo5PT10jACr3dXS/VI/IjJ0/tOjUyfsOC6YO5UYGSVLjgfgslMTFf47igKHK2IrK8X0PZDOMc3I1rV//7xrUrD9UjdrJBBIjAhQkYhvJBABgnRs0h0FFCIZvFFUI4f9QcdOSl3gSm05ktBafQP9jbt+R9FC4Uywv7Dt6VzlgbZocQSsse5jdkmi1COGuTpqqyhrlNms5dQYEMzrOqYt2qlU9u37T25XqzIXtEgAjMEwCALxiGsqSN2Yhf7QQ6Siik0/l7OOe0yVLt90NLW9r5fP/k1PR1q1cMfb1egfhbPD/78r77i46Tqt7WuWK/UrswOxkxpyfO3sFxdvxhbpTh/LbKOmTzujXf20AjC/XqQrJDBM4hQAWNzb0pOkooWJbz+4i4rrkIyVu9CAhE9ejJ02/duGbl/6mXTd9OxrJSL+07fL9AVM7e3rkkAKqKFKv/e+F75YguuJGTrxBKqyL86QgQV+/c/pX+HjpHop79SLaIQDUBSVI+rGlwkqg0nkDHCIXpaUzJsvPRxiMjD40kcOj48DvWrRz6gixLdT1z4fTI+PrDs0dSl0cHyv8nUJSnEOYKHBcKggsur5ytYThHZMzC8Xd1vO36q77SSFZkmwiEmQAA22sY6t+EmUGzcu8YoWCazu2M4dubBY78NIbAyZHRO7Ro9GRPKln3osD9h49fPzY1fcX5pg0qowULd2ysFg3VOz3OFzHOrricq3uo1D/6drZsWPvdjWuouLExdwpZJQKl39r/Fo9HqCaowTdDBwmF4nsYYzsazIvMN5jATDqzMWPba9cMDX63Aa7guVf23ZPN5lbOLWiYXblQOiTqrJGFc0YTqjZgKk0wzBYzXmjUIRHXT9x41a5vNiAPMkkEiEB5S/asEMqfJRJAx8U38I7oCKGAiFHLcv6aMSY1kBWZbgIB1/UiR06e+tkt69f884JDGOrk2y9u3LN3/725QrHX39e5MgVRWQ557h4L5bqD8ojDfBAXqlWoHlEAAO+Om67+37QZU506j8wQgfMSgNOGIX8UAOo6XUmw5wl0hFCwrMJORPgN6tjOIHD05Kk3dncln08axqlGZFQoFGN7Xt3/5kLRjVfsn3dUoHI89TlnRVRPSZRlxHz72Y2bZlXFtVfs+EJ3KjHViDzIJhEgAmUCnMOwpsn/AwDod60BN0VHCAXbdh/wPPH6BvAhky0gMDmd3pCxrC3rV69s2LC9lbWTL+0/dJ/jetGzxUJpGmLBfgvVwqByoNTC3Rv9KyqFkaI0jVEWD7u2b/r6UH/f6RZgJJdEIFQEAMCUZflvo1FY1hbwoYK2yGQ7Qihks84HhMC1i8yZLmt/ArDvyLEH164YejgWjaQbFe50JtO37+CxN7qep1RPGfj+Fo4wnDWCUBISlamI2ZMnq/Z2rh5h2LVt40ND/X1nGpUD2SUCROAcAs8BFL9iGMYosakPgcALBUSMWZbzibkzhevDhay0mMDIxOSuYrGYWLNiqG67NJ4vpdGJydUHj558g3/qaFkglP5/bvfm862Q4FxiiiIzx3GZ57kLDpk6+/pbrtv9z1o0arcYJ7knAmEjIDhnLwCwPbGY8hIAZMMGoJ75Bl4oWBbuRHSoPqGed0Ub2HJdTz1w7MRb169a8VAsGsk0MqTTo2MbDp84cyeiKImFc0cU5ooV5iSEPzUhyxLjwJnjuiXRMLcSwv9OIJO4VHztLdf+YyNjJ9tEgAhckoB/Tvw4opeWJD6DiLlLtujwC4RgtueJ57u6YscWk2rghQKdFrmYbg7mNaMTk9szWXvt5rWrG1arUCEzMj6x5siJU3e5npArQmFu+ePs+dTVp0uWv/c3amJMloCBLxh8sVA6ibI8MtGdShy8euf27wWTPkVNBIhA5xPAcUT+SDwuPwUA5Q+v87wCLxRMs/AHjMGazu/QcGa4/8jx+3u6ks/1dqWON5rAxHR68MDR43d7rqeeXbNQ3oix+njqs0cefLHgr3jwmJj9ddu+ed0jKwf6aYvZRncc2ScCRGCZBPCM54l/SqViRztOKFB9wjLvjQA0z5jZ/pNnRu7ctnHDFyQJ3EaHPD1j9r565Og9niei6D/xL3jaZLng0S9qFGK2uLGkJsrLIxVFsm677urP+s0bHTPZJwJEgAjUgYAny/BvsZjy/bNtBXpEwbKKVyCyd9cBEJloYwLHTp2+wXE8bfO61Y3YrfGczP2lk3sPHbkrX3B6Km8uLFKcXyK5YBOm2doEv82W9asfW7Ny6HAbY6XQiAARIALnEBBCfC2ZjH6j+o1ACwXTLLyVMbiL+rrjCcDeA0fuTSWNwysG+l9pRraeJ6T9R0/cMDE1vWO2RGHBKZO+QCgvkZyfjqiIBiE87/rduz6XiGtmM2IlH0SACBCB+hKAz8bjyuMVm0EXClSfUN+7o22tFZyitu/w8TevXTH0nVTCGGtWoGfGx9cdOX7mNk940bktn89zNLUfjy8UFFnOJhPagWLRi16za/sPmhUn+SECRIAI1IsA59zL54t/3tOjlWqsAisUEFGxbe9vhBB0vkO97o42tzOVzqw4eWr09s0bVn1di8aa9td60XXUoyfO7JqYmt7pb850vhEG/1dJkbm1Y+umR3Qtan3viR8/eMdN1/6bqirFNsdK4REBIkAEzkMAhw1D/TP/zJrACoVcLrfWdaUPUP+Gi8DI2OSm0YnJazZvWPuQFo00dROVfKEYGz4zunXGtNbYdqEfmeDlwkUl05WIH9myYc1zsiSVCi6f/MmLd/b1dR3fvHY11SmE6xalbIlAxxAQgv1DMqk+HVihkMk4twLgOzqmRyiRRRMYPjO+bWJ6ctf2zRseiihqSzZP8WsYiq6rcA4soijnnFp38OiJTWOTU6tvvmY37aOw6J6lC4kAEWgvAjgcj0c+FFihYFnu2xHF7e0FlaJpFoETp0d2TM2kt2/fuP7rkYjadsfL5grFyGM/ePpn33jXbZ9pFhPyQwSIABGoNwFZ9v4swELBeT8irq83FLIXHALHT41ePjE9vWPr+jXfMnRtpt0i/8Z3f/Dgbddf87W4HqOzHtqtcygeIkAEFkUAQHw5kELBP8DHspxPMsaURWVKF3UsgbGJiXXHT43dvG71iu/1dafa6jjnx37wo7s3rV/z4tpVQ20VV8feDJQYESACjSDwSiCFQjaLK4Rw/qgRRMhm8AjMpM3eg8dOvH6gr+e5NSsG97VLBk8++8INekzLXHHZ5r3tEhPFQQSIABFYGgEYDaRQsO3iDZ7HfmlpydLVnUzAtgv63iOH36BHY6Nb1q99WpK41+p8X3z10La0aXXdet3up1odS6f5R2TccYrxouPFXc+JCWQRRFQFehH0MIKMqQIx4v/zfw7+CV/AgJe/gL9fFi+dFVraoxuQcf+oDo8Dd7gEDjDmAgOHc3AYZw5n3OFcchigwwGKHLjNOdgS5zaAZAOwhm8v3ml9SPkEgwAAswMpFEzT/VnGxGuDgZmibBYB1/Pk/YeP32jn7MHN69Z8N5VMTDbL9/n8vHrw6IYzYxOr77z52nP2Tm9lXEHxjSgky873FB0n5ThO3BUi7nleXHgiIVAosqSYkiyZssT9B3aRc6kgcV7wH+SSzAuyxAvApCKXoSiBJPylrP5RHDJnpWM8GAOsOovDf1tChjIKoXgoFEShCESFMy77+7b43yNDfx8NX4BoyFBDgRpD1IBzDhxsX0AwxByXuM0Z2LIiD0vAW3ofBqW/Kc72JRBIoWBZzu8i4ub2xUqRtZLAmdGJtUeHT93S39398qb1q19oVSyHjp9cfeTY8NbX337jd1oVQ1D8lkRBLt+Ty+X78gWn13GdPhRCl2RpSlHUaVWWTUWWzIgqm9FIJOOLgjbLjQvmxRBB81xPY4CaEEyTJGlMkSQ6QbTNOovCWRIBf4QteC/TLP4NYywavMgp4mYRyOeLsb0Hj97uoSdftmn947oWs5rlu+Ln+PCZwZf3H7zyp1972yPN9t3u/nxhMJ02h+xcfpVdKKz0PM9QZWUqElXHY0pkQtOiE7FopO1WsrQ7V4qPCNSfAE4ETiggYtKynI/VHwZZ7EQCh48PX3ZmdOKq3u7k3s3r177QzNqF4TNjvT9+4eUb77/7zoc6ke1Sc8rm7K5MJrvKyuVWOUWnT4mo44YWHU4YxrAei00v1R5dTwSIQOMJAMChwAmFdDq/mXP+u43HQx46hUA+n4/tP3LyOtPKDq1bM/T0qsGBY83IzbJy0WdffnXX7Tdc9Uwz/LWjj2wulxyfnNlsZe1NkgxuLOILA324Kxk/A9D6gtN2ZEYxEYF2IgDAnwicUMhknJsA8J3tBJJiCQaByemZvgNHT9zMOXe2bFj3w66EQUPbDeg6x3GiY1PTG2fS1mZEEU3GjYO93V0HY9FIpgHuyCQRIAINJADAPhU4oZDNuvcJIe5pIBcy3eEEjp48teX46ZFrUkb8xMZ1q/bEda3p9QudiHg6kxkcGZvaVSjkB+KGfrSnu+tgKm6MdmKulBMRCAMBznlR06T/FDihkMkU/x8Adk0YOinsOXoCuzzh9aiyfKjeLIquoxw6Onz56PjEjmQicXzz+pV74rrRtKOr651PK+2NT02tGxmf3u3vmNrf3fXiQF/XEQBeWoBILyJABIJLAAB/YBiRfw6gUCh8AADWBhc9Rb5YAggsmsvl3qwo6lOKJB1fbLulXOf5ey8cPbljZHTi8rihDW9Zv+b5ZMKgIfJLQPRQSKdHxrZMTM3sUmTV7O9Nvdjf0z28FPZ0LREgAu1LYHY04YMAkA6cULCs4icQmda+eCmyehIQAlN2IffTsWj0WxLwiXrarrblup584OiJy06Pje1M6PFTm9avfKE7maRK/PMAPzM2vvH06MR1eiw6OjTQ/0IyrtOGQo26MckuEWgRAc75N3Rd/prvPlBCYWRkRNf17r9uETdy2yICruuuyObzr4lrsa9xLjW0nsD1POng0ePbT41MXB5RZGvl0ODe9asHjwJwbFH6beN2cibdP3x65Ebg3FuzcsVTKRIIbdM3FAgRqCcBADig6/J/BYDSVviBEgrT07l1siz9fj2BkK1gEMgXClvsfGFXKhH/mr9FbzOiPnF6ZPWx4ZEdubzdM9DTs2/z+jWv6lr4joy28wX9yImT1+fyxb7VK/p/NNjb25Tlpc3oY/JBBIjA2QRwIpdT/7y/H+b+KAuUUMhmi9cKwX6FOjacBDJW9mrHdVamkslHJACnWRQyphU/dOzU9rGJqS26HhtZv3po76qhgVAcHX381MjWM+Pj1w70dL+4btXQy1Sk2Ky7jvwQgeYT4ByGPU/+VCIBC6YTAyYU3HuEEPc1Hx95bBcCM5nMtfmis7K/u/thzpszslDJ3fMEP3z85MaTI6OXDfX1Hrhs84ZX24VLvePIFYrRg0eO3eZ6GN26Yc33dC1GK0LqDZnsEYE2IsA5e17TlH8AgHPOUQmUULCswjsQ4dY2YkuhtIDA5Ez66kKhuGawv/cbzZqGaEGaLXPpH6p1/PSZm3u7Uns3rSsdqhX6+oyWdQY5JgINJwBnAPDLhqFe8AC9QAkF0yz+R8bY7oZzIwdtT2BqJn2lZefWD/X1flNRZLvtAw5AgIgMXj10+CYzmx/avH7N97qTcVrNEIB+oxCJQA0E/DqvVzhnz2qa8iwAXHTfk0AJBcty3oeIm2qAQk06kMDk9MyOadO8YqCn5ztxXRvrwBSbllKx6Kgv7j90lyxJhZ1bNz3ezMOzmpYkOSICTSaAyCwAfLLJbs/nDgG46XmYZkxMJxKRY7CEOq9ACQXTdP6UMRxoA+gUQpsQyGSzQyNjE3d0JeLP9vV072+TsAIVRsayEy/vP3h3b1fq0JYNa58LVPAULBFoYwIAMGkYygfaOMRFhRYooUCbLS2qT0N3Ub5QNI4Pn369JEvTq1cMPhVRlHzoINSY8Mj45IqDx07esW7V4FOrhwaP1GiGmhEBInB+AoV4XH1P0OEERiggomRZzqeCDpzibwwBRMFPnB7dPZXObO/r6vrJqqF+Gl24BOpTI+NrjpwYvmX75nWP9nZ1jTemZ8gqEQg3AcNQ3l3ZuCioJAIjFKamMKkozseCCpribg6BbM5OHjlx+pai40b7urteXD3Ud5jW/p/L/tTo6Jojx0/dsmvbloeTdNx2c25O8hJKAoahvA8AAn1+TGCEgm3jSs9z/kso7zRKeskEJqanB06eHr8il8v3xg3tWHcqPtzX3X1GVZWmbdS05KCb1OD06Njqg8dO3rpr25ZHupJxOs+iSdzJTTgJcO78ia7rgd6gLTBCIZMpbPv/T7F6bzhvNcq6VgJZO2ecGZ9cMzk9szqbzfU5jitzmeduumrXQ2Hcjvn06MSqg0dP3L5z+6ZHupOJqVq5UjsiQAQWR0AI8ZfJZPTg4q5uz6sCIxTS6eK1nNP2ze15GwUnKmQM8rl8JBaLhq7gcXJ6pvelfUfesPuyTY+kSCQE56alSANNAED5tGHAniAnERihYJrOHYzhg0GGTbETgVYRyNo57Zk9e+/btmnN94f6+wI9DNoqhuSXCNRCABE+k0goT9TStl3aBEYoZLPuvUKIN7YLOIqDCASFgOcJ6ennXry3r6fnwJYNq/e2Q9yu58mO68mu68qSxEVEUfP+13aIjWIgAvUkAABfMgzlW/W02WxbgREKtu0+4Hni9c0GRP6IQNAJPPPCK3fKkly86vKtTf2rplAoRsen0/2mZXXbuXxXrlDoKhbchCc8RQhR+uypPkRCAl7kXMpLCs9HFTWTMPSJVEKf6OlOTURUtSlHiwe9ryn+diSA347HI19sx8gWG1OQhMLbPE/cudjE6DoiQAQYe+XA4Stm0tbqm67Z+XAzlommM2ZqZGJq7XTaXJu1cwOIWBYEWJYEpa/+T2YVgv+l8l7l/dLbWPm5fwUwVVUycV0b6e/pOr56Zf9JWVJc6l8iEAQCAPxxw5A/G4RYLxRjYIQCnRwZ5NuMYm8FgamZTPeevfvuvvHKXV9qZPGmv9nV8VMjm06Nju8qFIrds5pgXhjMJr9ALJz9s7JKmG0zTwurFEXpe19ncObFNf1Uf2/X8VVDA8fDuHqlFfcT+ayNAAB7wjDUz9TWuj1aBUgoFH8Rkd3YHtgoCiLQ3gQ8FPwHTz9//7rVK55dt2roWCOiLbqeevTE8GVjE9OXu56nzY8M4DmjBGX/cM7PZ6XBwvdwvn3p/SrlIfwjLktDEnOjE5g09OE1KwdfWbtqxYlG5Ek2icByCADwpwxD/sfl2Gh128AIhWy2+CtCsGtbDYz8E4EgEHjh1QPXFgqOft3uHY83It6jJ09tHx4Zv87zvEjpOe4/3KtGCQBmpw9Y+cGO6Ncplj9uyg/7hdMR1bUKvuCozE6Uvz+7vSj9rGSn5McXFoypimquGOh5dfO6tftiMTV0y18b0c9kc/kEENlPEgn1fy3fUussBEko/JoQ7MrWoSLPRCAYBEYnJvpfevXIa2+9fvcX610EOJU2ew4eO3FrPlfor/qrfvaP/qo6hAUDAeWf+w/26urF6tGCBd9XT0HMFiycW8tQ7otqUVEKAkr/81avWPGTKy7b9EIweoyi7GQCnLPndV39/4KcY2CEgm0Xf8Pz2M4gw6bYiUCjCfj1At954sdv2bZp3ZOrhwaG6+XPt/vqoWPXTUxlLmcMeaVeoDKOUJ52WDi14KuC+bqE0mN9blTh7HqFc66DWVsV0VAlCip+5qctFo5OAABef+WuL/X3pCbrlT/ZIQLLIPBSPK7+92W0b3nTwAgFy8q/F5FvazkxCoAItDGBvQePXD6TMQdvuvqK79QrzEKhGHv54JHX2XZu8HyrFCp+ys/06lGFs2oSZosRz17lMN9+fgJiTnicp5hxfpKDMRSzqyiqpjIGenteuW73jh/WK3+yQwSWQwCA7TUM9W+WY6PVbQMkFJz3IeKmVgMj/0SgXQkUi476vSd/8rM3Xr3zq4m4YdYjzsmZTP+BIyde57qOfnYdQUkWzI4klGsUzh1VWFjgODugMLf0sVKQWC5oKC+dPLfgsZRHVQ3EvN/qkYSySFFkJXfHTdf8W0RVaN+FetwAZGPZBBDFwUQi+pfLNtRCA0ESCr+PiOtayIpcE4G2JvDsC6/ewADw6l3bflSPQE+eGtl64szoLciYdLGljeWBguqljQtrFWaf87PP+7NHDWbHIKqmGOaXSVZfWxYCVYMWVT5nax+AsU3r13x/24a1++uRP9kgAvUgAABHDEP5aD1stcpGYIRCNuv8oRC4qlWgyC8RaGcC6YyZeOr5l+6948ZrP1+Pv6aPDZ/ecWpk/ObKVMPcKoWq2oFKxUGpSHF2ncLcCEOVcCgVHEL1aoeqh77/+C9NH1SNKsyCXrCKYsFqiXlhUj26oMdio3fcdM1X27mfKLYwEsAT8XjkI0HOPDBCwTQLf8wYDAUZNsVOBBpF4Iln9tzV3Z08fdmm9cs+y+HY8OnLT42M3zQ3DXDWsP/ZSyHnahQrUwqzSxbnixvLyxcrrwWbKFW9cd6VD7PDEXMjCXO2y+UQlZEOifPiTdfs+mK9plwa1U9kN4wEcDgej3woyJkHSCg4H2QMVwcZNsVOBBpBYGo6nXrmhVd+6g233/CvALy6lGDJ7o4Nn7n81Oj4TZURhErdQfV0wNl/6ZcEwVkrHOb3N5gfbaj89V/RBn6b8gdQuS5hbnpjbu+F+bqFC/mvJLh904bvbFiz4siSE6YGRKDBBADgmGEof95gNw01HxihYFnO+xFxfUNpkHEiEEACTz370m0JPTa9Y9uml5YT/vFTZ3acHp24ef6BXb2tcvVag9m/5hescJhf/VhdzzBbnzi3KdI54wrVhY1VAmFOVMxOapSnN2ZfC+oZGOvr6dp77RWXNfXAq+VwprbhIgAAhwxD+XiQsw6SUKBVD0G+0yj2hhCw7Fzs359+9oG7brn+31RVcWp1MjY5s+rwieG7/f0SyjshVv6ar4iCWdHg1yiI8mnQ55sOWLifQnWB4+zmSFVTB+c7E2LByodqQVC9uVJlKgQZi8Uik7ddd+VXJEnyas2d2hGBRhIAYPsMQ/1EI3002naAhELxvYiM9lFo9B1B9gNF4NmXXr1GCCFde8WOmlc6WFk7uffQsTd7wovMzfsvOOGxMi0wuy9z1fHQF10NMTcAUNV+weqIs06VrLq+uhPmpyXKUxwVlSLLcu66K7d/NWnEM4HqNAo2bARejsfV/xbkpAMjFEyz+B7G2I4gw6bYiUA9CbiuJ3/z8ScfvOOma75U6wmK/sFOL+8/+Oai46ZKD/2553DV92cVHJavu8CeB7MlCefYmhMB1cdHLzjvqTyKUVk/cZ7lkpVRjPIqCu5cdfm2h/p7UhP1ZEq2iEADCOyJx9VPN8Bu00wGSSi8mzF2RdPIkCMi0OYE9h85vnl8cnrlLdfurvngp5f3H/kpy7bnioTLQ//zKwqqH9xzqxIutClS1e6IpYe6qHrwl4odK4/6C2yqdHb7qk2cyhsyldsDgLdz2+ZvrhjoPdXmXUThEQHGOfuJrtOhUE25FbLZ4q8Kwa5uijNyQgQCQMD1HNkPU5YUt5Zwjw2fuWp0YvKa+bMTKic1nrspUukRPXdYU1VhY+WMh9lVD1UzFuXli2dtxFR52J+98qE8SDEvUir5nFNYCYBb1q357vo1Kw7XkjO1IQLNJgDAnjYM9R+a7bee/gIzopDJFH8ZgF1Xz+TJFhEIK4G0me05cPT4/UIgP/ehPL9UsSwQ5ild6JyGc4RE9XTF3PcXHkk4V4icb+qDi03rVn1/49qVB8Pab5R38AgA8CcMQ/5M8CKfjzgwQsGyiu9EZDcFGTbFTgTagYC/suHF/Yd/Jl8ods+e4lz+y7+qPmHBz0urIPyVDuWPi+qRhcoIwsUPemYHnJsAACAASURBVLpI+9lVEOeIkarpj9KujYw5Ozate3RlHU/EbIe+oBg6nwAAf9ww5M8GOdO6CoVcLrdWCGU3gFjteZBiTETqBQeAxxExVi97ZIcIhJXAkZOnrpuYTu+unhqofH8h4TAnEOYXHSwQDdUCYm7nxurCxnPqD8r0zxEYswFUn+kgS5K9c/umb/Z2UeFiWO/ZYOeNj8Xjkc8FOYe6CIVcDtd5nvsWRNwcZBgUOxHodALTGav/0InhN6EQvPqEpYX7H8w+xKt2W5wXFQtHFRYe4DS7fLFKIJw70nBW+7M2bTp7ZCGqqpO7L9/67biu1eU0zE7vX8qv/Qhwzh/WdTnQZ5AsWyiYpvMaxvBtjLG5uc726yqKiAgQAQ+F9PL+ww8Ui06qQqP6QS78w5n8F/j/AwYcGAdgnucx/73yNs0LixYWCIHyEEHp0V9awji7tXN56KBc2Di/8qHsyrdbnlkot6leGDHQ0/3S5Vs3PAPAyzs80YsIBJAAAHzOMJTHAhj6XMjLEgqm6dw5KxKCzIBiJwKhIHD89Mju8cnpUkFwZZ8D13OZ5/kPaME456V/lfMXZh/fpYf7XA1Dde1AxU7ViZJzB0nNEj3fhkxz/uemHipFjuWhCFmSsls2rv3eUF/P6VB0DCXZ0QQkif29pqk1b4jWDnBqFgr5PG5yHOd35yqc2iEbioEIEIHzEnBcL/rKwcMPuq6n+o/9QtFhxaLjP5SZLMtMksoDghVR4H8wVM5XmNvSuXLB2SKg6ufzownV7St2SxdW/je3v2NlaSQAiO5Ucv/2jWufiUTUAnUlEegMAvjJeDzySpBzqUkoICLYtvv7QuDaICdPsROBsBA4dPzULTOZzGW+QMjl8kxVFBaNqv4Oh1UrGua3Wj7nKOhzjo6efejPbqxUfST1xUcVqkcPZscsEJmhGyc2r1/9dFfCmAlLn1Ce4SDgut6fd3XFjgU525qEgmkWtjMGvx3kxCl2IhAWAlbW7tp/5MQDM5kM93/hNV0rjSSUBwKqt02u3iBpfvOl6qWTZXlQddhTpa7g7FGGqhqF6jqGis/KIIQWiYyuXT3040GaZgjL7Ri6PBHzf5BIJAK91XhNQsGy3J9DFK8JXY9TwkQggAT27D3wpjOj44N6LMY0fX6FcWWlw9zDf27nxfKE4tyZDlVFieee4VC1imHufIZyrcH5zoQon9MAblcyfmjlYN/enhQteQzgLUUhL4HAxITyW+vXQ34JTdru0pqEQiZT+AAA0LRD23UnBUQEFhLYd+jY7kPHT17X3ZVkEVWde3Pu3IYFGyhVCYSyepjbVrlaIMy+NV9vcJ7joMvDFfOjD/5/RSORsZ5U8vDqof4DqqoUqa+IQAgIuPG4+utBz7MmoWBZzkcRcW6JVdAhUPxEoBMJnDh9ZuWLew/duXnDuv0cUMsXnR7HdboQGa8+Q6FSuFje66hqNODsI6H9A5kYMFHapXFOJ5RWSVQKH6tPlZQ45OOafjKZjJ8c7O86qcpUoNiJ9xnldGECAJg2jMjvBZ1RjUKh8DFESAY9eYqfCHQqgROnRoZeeHXfnddeccU3B/u6Jit5+ts3W9lcVzaX78kVCt3FomM4jqs7rqu7wtNYlYiYGzkondw4KyDm93kua4XyQU5CkaRMNBqdikbUKUOLTsV1fcrQtUyn8qW8iMDiCOCpeDzyp4u7tn2vqkkoZLPOB2jFQ/t2KkUWbgIzZsZ4/IfP3XfdlTu+vWKgb3wpNAqFYixfLOiuJyKeh/7IAxdY/uqLDF8bKLKUVxS5oMpKPqKqeVmWnKX4oGuJQFgIAMB+w1D+Ouj51iQULKvwDkS4NejJU/xEoNMIeJ7gj3zviTetXbVi385tm/Z1Wn6UDxEIEgFE9qNEQv37IMV8vlhrEgqmWbicMfjNoCdP8ROBTiPw/aeevckTQr3z5msf77TcKB8iEDQCiOIbiUT0a0GL++x4axIK/jCkZRU/yBisDDoAip8IdAqBQ0dPrHpx38Eb3/i6276syorbKXlRHkQgqAQQ4Z8SCeXJoMZfibsmoeA3nt106bdoC+eg3wIUfycQ8FDwLz38nbdcu3PHD9atWXmmE3KiHIhA0AkoivJX0SgcCHoeNQsFP3HLcu5GxPuDDoHiJwJBJ/CjPS/tmp7O9N59x83fDXouFD8R6BQChqH8PgBMBT2fZQmFWbHwhlmxsGxbQYdJ8ROBVhBIm5b29Ue//zM/fdetX04lEtlWxEA+iQARWEiAc+5pmvQb/mFnQWdTl4d7Po9bHKf4VsZgTdCBUPxEIGgEfvzCK5cJT0jXX7XzpaDFTvESgc4lAOPxuPLBTsivLkLBB+GfKGmahS0A8hUAuAZRpAD4/J6xdaKFiAZjrHyiDb2IABEgAkSACLQhAQCxzzCin2jD0JYcUt2EwpI919gAEX3x4W/8csFXJsM0VWVJRKcfke1EhMsRcf40nBp9UzMiQASIABEgAoshAMCeMAz1M4u5tt2vCZxQqAUoIirZrPsaRLzHP2W3FhvUhggEhYDrOpG0ZfdZ2VxfvpDvKzhu6sTJM5FIRDVVRbViUdXUYjEzrkXNuKGZiXjckmWJllMGpYMpzkAQ4Jx/RdflRwIR7CWCDIVQqDBARM2ynHcxxnZ2QudRDkTAdT3FzGZ7s7l8n53L9+ULxT7HdRPVZDiH4rETpy86DajIcs4XEhHVFxERU4tGTU2PmQnDMJOGZkmS5BFtIkAEFk+Ac/a/dF39yeJbtO+VoRIKfjfMbhb1AGNwV/t2C0VGBM4l4KGQTMvusbJ2f65Q6LVzhX7P85J+fdDFeC1GKFysPQCgLEm5aEQ1/X+RiGrpmpbRohErmdDNhBE3JYkHvrKb7jkiUE8CnDt/ouv66XrabJWt0AmFCuhMpvguAHZ9q8CTXyJwMQL+UdCZbLY7a9t9WbvQly8U/JGCLl/oLpXccoXCpfz5QkKReS4aiWRUVbFi0aipx2KmrmuzUxu6JQEJiUtxpPc7ioBrGMp7AKAjRuJCKxT8ugXLKr6fMVjVUbcnJRNEAmBlcynLFwW5fF8uX+grOk4PItZldU+jhcKlgJdGJGTJLk1r+KMSsWhpesPQdNPQNSuV0C0gIXEpjPR+gAhwDid0XflIgEK+aKihFQo+lUwmvxWA/06ndCblEQwC2VwhkbWzfZad80VBvy8KhEClUdG3WihcKi9fSKiKnFVVxYxGImYsGrG0aMw0jFhpRCJp6FkSEpeiSO+3EwEA9pRhqP/YTjEtJ5ZQCwUfnGUVfwuRXbYciNSWCFyIgJ0vGJa/AiHnr0Ao9BUcp1d4ItJMYu0uFC7FAhgTiqLYfrFlVFXNmOZPbURNQ9NKxZZxI+oLCbyUHXqfCDSLAID4vGFEv9Msf432E3qhYNvF6z2P+Ssh6EUElkWgUCjGTHt2WWKx2JfP5/s80fr9O4IuFC7VKb6QUFU1G4koZlSNlISEFolYhh4tC4m4kQXGSEhcCiS9XzcCiPiJRCKyr24GW2wo9EJhdsnkX11qE6cW9xO5bzMCrvDUdMYq1xT4yxKdYp/reP6uoW336nShcCng/l77/v4RkYhslYRENGLqWsyvjzATcc2M6zqdj3EpiPT+kggYhvKfAMBaUqM2vjj0QsHvG9N0/pgxHGrjfqLQWkgA0ZNnzFyvlc2WliXm88X+s/cqaGF4l3QddqFwSUCMiUgkYkXnRiQipu6v3NBiVioRz+hazF6EDbqECJQIAGDaMCK/10k4SCiU6xTei8i2dVLHUi61EUAUUtq0e7I5u8+2yyMFjuOlLrVXQW3emtOKhMLyOHMAT1UUS/ULLSOzyz+1WGlUIpXQTF3TSUgsD3GntX4lHlc/2UlJkVBgjGWz7i8LIa7rpI6lXBZFANKW3W37dQW5fF+xVGzodteyV8GivLXoIhIKjQXPeVlIREpCQjWjUX/pZ8yM+1MbCd3UorFcYyMg6+1FAL8Vj0e+1F4xLS8aEgqlZZLFXwZgJBSWdy+1fevSXgW52Q2Mirm+QsH19yqQ2z7wZQZIQmGZAJfZnHPuRhTZesMdN3+eiiqXCTMAzTlnf6vr6rMBCHXRIZJQKE095N+LyGnqYdG3TftfmM3lElk712vZuf58vtCXL7q9iKJhexW0MxESCq3tHYlzFo1F8eZrdn9Oj0XSrY2GvDeagOMov9fdDR3VzyQUSsWMhT9mDKiYsdG/QQ2yn88X9Yyd7cv6pyX6yxILxT4hmrtXQYNSq4tZEgp1wbhoIwCMqarKYtEoi0ZUpqplfapFI6e3b1r/9UUbogsDSADH4/HIBwMY+EVDDr1QQMSYZTn+8si6bJfbaTdIO+YzOZNeZWbt/ny+2FfwlyW6Hh0dfpGOIqHQ+LtYkWUWjaosOisOwFcL53mtHur/Tn9P95HGR0QeWkGg03ZkrDAMvVDIZovXCsF+pRU3FfmsjcDzr+x/lwhBbUFtdM5tRUKhXiTn7XAOLBqJlsSBP3IgSYs7q0tWJOvyTZs+J0ng1j8qsthqAojwmURCeaLVcdTbf+iFgmkWf4MxtrPeYMleYwj4pyoeOHryXY7rctdzmRAeQ9pz76KwSSgs/170RwhUVZ4TBxFVrdloVzKxZ8PqFc/UbIAati0BgOIfGYYx0rYB1hhYqIVCOp3fxDl/X43sqFkLCEzOZHalTfuGedfIXNdjvmjwPFH6KoRoQWTt65KEQm19I0vl6YRYNMIiUZVxWNyowaW8+UcPb92w7vN6LJK51LX0fnAIIDIrkVD/U3AiXnykoRUK/hG+pln8zwCwdvG42vdKRIwUis4ax/OSDCEKHAQykVdleUqR5VEOEPi13EKgevLM+IOeENGL9QQilgSDLyA8/6vnjzqEd9iBhMLifm+hNJ0QKf2LRVUmy41bOatr0RPbNqz75uIi65yr/M+pfNFb43pOkjGI+ttr+59TsiRPRxR5JMifU5yzPbqufrpzems+k9AKBcsq/gIiuyXonYooeDZf3O26uBEZstIvnr+NYOkX0H86ggBgKEswHJWV/bIsBVYwjE+mrzPt3O5a+swfbaiIBk/4IsIfdQiHeCChcOE7RlWU0ohB1B81iPirE5r3kbhmxeC3+rpTx2u5n4PWxv+csgvuFY7rbip9Kl3gc0qRpOGYquznPHh/2ADAFwxDeTRofbOYeJv3W7GYaJpwjf8MtW3vTUKIe5rgrqEuEFFJZ3OvFchS/gl6DJivFRCACQAufMXAmBDAOAID//1iLCLvUWV5oqGBNcC447r68Mjk2+q1QZJPxhP+iEN52sJ1O3fKgoTC/A0pSRKLRcpTCb5A4Lw+0wm13PKKLGd2bt3weQDu1dI+KG0AUJ6xcq/1BOsqfU6VFfolPqfUParMA/U5JcvKX8RicDQo/bKUOEMlFI4exWhvr/NOxthVS4HUjtf6RX3pbO5ORNGPJRGAJTFQEgSzIwk4+8tY+qXE0hAfSpx7EVV+Lmhi4cz49O25fGFrI/uiMmXhlaYsPOb4hZIdUO8QZqHgFyFGIrN1Bv6eBkp77bnV2536ydoVg8818r5upW1kjGeyuTs8IQYYlD+bLvY5xdD/DBPIS59T6nMBEgsFw1De69eftJJ3o3yHQij49QiW5d4CIN6ICIlGwWymXdPO3+S47obSEJ7/Cyj86QZemnbg3FftvnioTEP44wwo/Gtn1bwT12JPcmD5ZsZcq69codA9Mj7zQCsOZvILI+dGHUqjD15ZhwXoFTah4IuBanFwoT0N2qELOYC7feP6z0WjasccSVzN1coVbiw6zsbaPqfA0WORp+RgTEPsicc7sz7B789ACYXFHtYzPs40w2BJRKcf0V/6CLsQMd4OHwz1iCFfLK6x88Xby8N3/kjB/EhCWQyUaxN8dTAnDkpKHSvvoaLIZ7SI8lI94mm0jVOjk3f7hZqN9rNY+75wKI04uO7c9MVi27biuk4XCv70QWVlQiyy+D0NWtEX5/OpxbRj2zeu+Xa7xFOvOPKOt9rO5V4Ths8pSYLPaFrn7Z9QuRcCIRSmp3PrFEV+EBHX1+smDqodv/I/befuQ8RoadTAFwVzIwr+CAJDzksjB8KfevC/+r+ovHStP/hQqlUovRdTlGdURW7rJVrZXH5odGLm3nbur1K9Q0k8uMwpLdP02mqJZqcJBf9DS434uyD6qxMibTedUMu9um7V0MM9qeRwLW3bsY3noZLJ5e9DFLFzP6cqI58X/5zySp9lTBgR9RlJktr6c8rz7PenUqnpduyLesTU9kIhk8lvBeDvYYw1bq1SPUg2yUY6a9/mCbauMmoA/sI/KI0W+GWM5akFv5ixNMrgz7pXphvKUw/+6XX+lYyDkDibMKLRPU0KvSY3wyOTby46Tn9NjVvYyFdsnusyV3hzyzRbtUSzE4SCv1TRX7LoL12M+EWIF9giuYVdvizXiiLP7Nyy4Qv+9OGyDLVJ40w2f4srxIbK59TslKf4v+y9CZRtx1ke+lftfabuc7rv1Pf2lWRLsiVZkoVH2ZaMLU/YYNmWB6zYznsEMz0eBAhhWnkxEDAGHl4E8x4JCSYsSEjysEnwIg+CA4/BzIMtDwhka7BsDff27e7b05n3UP/LX7X3GfY5fepUn33m2step3V37Rr+2rvqq3/4fsYGr1O0bpEvFZdm03id4rvFfHaG1yl8ulTKvX9GRD+Wbsw0UIjyMPwE5VMZy+jnrNIgFBtHtcabpJYASTsgFxXyDlJOQtj2UVBRD6Q4UOYJ5SREuAEE2SToQ6ToiNVc7pOOw2YSrR+Wa8+6enD0VXM2Tcd2l1gkfdI8EICgcE0xGX+HeQQKZE6I/QwIHLju4qdi2Thz+q+eec2Fz877++4F4lyl3nhzvE6pNYiLwesUk1EQx61ThVzmUxnHmcmMjI7DP76y4n5s3udtUP9nGihUKo2vQeRvX+QJMBnbQaV2byiATtfIGaGATg2CQurKmZH+nZA5mR4iPwUCCgxbGgUqQ2jDAbZXXJlJrQL/8qWd+0MikFrUSxJDKTbJ2GFyHKyS8wAUpDkhS+YE0hrkIZvLzJcDVQrvKGPcf+4tz/pILuPWUqhualUcVupvDAVeoMVn0DrFOKf1SLtOIa1TjrO3mptNrYIQ4qfX1/OPTE3gE2h4poGCzcPQfgPIgbHa8L8qck5UvgnSsqBAgQyPjEwPEplLoiUkvYMkXFJmCeWjoDQKFCehtA3FfO4Bx5mt/Ol7h+XnHhxVv3IC38BMNaFCNCNK6ohZkiZqlGtWgQJpCSQTYmRSmCanwSjyTfPZUnHl0VtueOYfpFnnJOtq+P511br3hsHrFGlCI3+pAeuUZIXhIJD0DIyJlXzm0xnHOZjkeIZoq14sZr53UcMi4/HPNFCoVv0fFgKvHWKyFr7IQbn2DgF4SmkN6MMRAqTpodOZUf13N+FSMm6ZIh+Y8mOQTo2MuBX2Z8kGSI5QT17ZebcIyRHKXiGFaEpzhYq2IGZJE+wwK0CBciUQ+6FMxZzPAqVmtlevBJ71jGv+39Pra5fnUTb7R9V3IIM+65TynYrDuI9bp6TpgctDUO86xfhBsZD99CzJBRE+tbaW/fAs9WkcfZlpoFCp+N+DiGMl2RmHUNOus970bql7/itjDYD6pQ8JJHkJ0S8qwiUe+S5EjkARb4JiQ+uIepBAAVWEhCojCrnMZ2cFrW/vHd5ZqdbnnhQr7fegsz4FGmKThQIQx13TBAqZbAYKkvCIzAnZpTMnnOQdyGbcva94zk3/dd44xhtN7+aa599zknWKnKxVhNbgdSqfyXwum3FmJrrAcdivrKxk/uIk8zxPz8w0UKhWgzcKId42TwJNu6+MgXP1qPouAFYgUwP5JSizAZ0p45wO5KwYcSp0EC4p00OnM6NS98mwI6lRiAAF8SJnnINZsAEGIiw8eWmXQmFni0Iv7YlNuz5E5SgZAQhJSR2pHSYJFByHR0mVVP4Ea0442URfOHf2z6/b3HjwZE9P5Sl+tVx7F5OO58pfSmosB65TqgyVH3adclznsJifGa0Cel75B86ePTuTzuBpvgUzDRQo01il4v0wADuX5qDnqa5qw3t+w/NfGid6ijf3vhoFinoAjEKLFEOjIM8FinAgHwUyVxByj21/kUaBdAvcYSKXcR+kbJPTlM/W7v4ravXm7dPsw6K0TcZdoqMWQoiDoyN+VKlCs9EEMmWkdSmK5Ix0QCROg0zGmhPSkC2Bu9uffeNHcrnsXCRxqzWbz6s3g5fFflOD1ikZ2yCjrmLn62PWKekMSQebaE2L1qlC1n3Qdaa7TtEcMwafLxazH0pjvme9jpkGCiS8w8PGza7rfpcQIjvrwky7f8ggu39Yfw8wGnsH42JsepBoXVE1x8mg4mQrMgZZ8SZEtM3t8MhOrgWlJqRPF9Bx+NHqFOOVG16wfnn76v3DMnCmLe9lqE9GVwQ+NDwPKtU61Go1aDY9I/BAYIBMCflcVoYwzjJF8jzP6drqysM33/jMP5r1MSBi9qDSeDeCyB27TqlQ7uHWKeJaiNetiBOmc51yXedoJZeZOq/CorMxdr53Mw8UqLOIuFGtBu9FxJtm/aNJs3/Vuveyhu8/X4kgpmNWoIBz5WPAyCtYkit1Rjaoj5J4E8h5QTo3Sm1D2CYyiaIeKEySaooRfiGX+XvX4VPRKlza2Xt9o+EtPftmmu+Qvq4oyiLwoV5vQrVeh1q9Dp7nA6XmpovMBwQK8oW89DegDIz2Gr8EGGP4rGde+5unSsXt8bd28haqDe+lDc+n9O991ilan5SD9aB1ipympIP1EOsUrW35XPahrMuvnrzXoz1JSatWVpzvZ4xVR6tpPp6eC6AQi7JWowgI/7owZDpv+FcD4MX5mIL+vRSAqwflepxWOcrZEHElSAITChqKEkERKGBIqCDa8FXoI/khxEAhJjKRgIN4FiKk3mJOi3wZuMMq0/BVqNYaF65cPXjrPM/ZovRdhmgGgcxlcXX/AIqrus9tUUY+e+PIZTK7dzzn2b8xez1TPRIIK4eV2rsFItmc2usUOVl3aD4l4VKK6xTjrLqaz356WhuY48Dfrqxk/9Wszkva/ZqWnNMeR1d95bL/WgB811gbGXPlR7Xmq/wgiCM+JFKXp38EwaOwSInUgcBAlNtdRj0ocwRxJxCKJ28i+m9O9ySoj5kZFdGJinpoOx/Rx57Lup/Puu5E0fqTW7v3+X6wOWax2uoNJECvzuNPPgHFlVXre2Agt7SLXjx/9k+uOb/xUNr1Un1+iKfCwD+DjGfJH9Z14CjjuFeVk6H+Kteb93h+cGtUsu1gPWCdkj4KdFiJOF6OW6ekL1WUl+aYdeoLWdfd1fcy/RJCwC+vr2f/Mv2aZ7PGhQQKlCmyUvE/SFrT2RT74F75IZ4u1+rv7EirLMmViMmMgIJC7t0ahTjqoRUJEUU/EA2TMkN0mB4igCDDKuOwJPooI8TPHae6ks1+ZlJ0+keV+vW7+4dfPY9ztch9bjSa8OSlS5K/YfP80voTT32KHe407rjlho+4bqaZVmf8MFirN/yXBaE4TWp09e3LQwRFVTXzGefhXDb7pUHtEciI1ql4nZ3oOuW4bnUlOxVfBb9YzHwfY6yR1nzMej0LCRRI6LWa9x1hSCmm5+86rNS/JhCiM61yt+mh00eBPIclkYnc6CWAkGq+Fmtj7KyomBpjfwRJfiL9F7DFfBanqCajYiGXfTjr8kmgdfbE5Z13BkF4ev5manF7TC/T0dEhbF/dg1qtAadPrUGpuLq4A57xka2XSn9/0/XX/mka3QzC4Ey55r8OGHKgDEwq42woPQxkNAKGxM/iOuzyaj7/ucixsKfpo2r9DX4obui40WedUiGSMsIhpXUqdtimdWo1n33YdSayTnWO/4FSKfsLaczFvNSxsEChWvVeIgR887xMRNxPPxCbR7X6fZ39Jqcm+bG1CElIJUcaBRXZ0JnPIf473vTbqaYVxXPLhCEjJRSrY0fmSWmyIO9G1+G11Qlkltw/qty6f1i5Z97madH72/Q8qNVrsLu3L4ECZWu8uHkeiCfBXpOXAK0Bz77+uo+tF1dHAu+hCIuHlcbXMAZZYJEmQWkWpZmSqIjJMZoBhHSYcF1+eTWXI7DQdTX9YLNSbx6/TkWRWLp1qrUetQiX+q9TkSkkzpDbsU65tZVc9rOSpn5CF+fwC6ur2Qcm1NxMNLOwQIFCdioV/6cBIDcTkh6yEweV+ttCIZJplSMfhbbpgTgSFFKXpKgKNHTQN8cfYExkIkEChFEmyW7bX2fUQyf5Sc7lj+WymZ0hu25cjHievnxp+91CoM0Oaiy98T5wVD6SIZO7V/ehVlca1kIhBxtnz4y3YVv7sRLI5zNXnnvTs39zFBEdVutfEwo8q3Ix0SGBhzExEpkiOWNkhqC1RP5N2oZCPvNA0hfgqNq4zw/DpE9RtAbp1qnIp6rFo6Dyz8R8L611ivoRR2dR2Y7orM51aiWXecx1+NjWqSRGiswO3ijzMG/PLixQoImoVLz3IsLd8zIpdc+/sdbwXp/sL50mhBDIpY9CxIEeJVWRFM4yggGQjgTk8Cj/LaJEkx9fpImQueA74pNjCmcVvsSJh10i9TgrpcNZYzWfpbS3Y0HrO/tHLyxXai+Zl/lZln56vg/Vmor62rm6D/UIKNB/nztzGlZW8ssiipkb57UXNv5oc+PswyfpWK3h3Vr3vJcqbSMBAuXETGaH6GARRht2SKSu0jypSNkqpdX8n8dtNj3vhkrDf4P5OqW0l7p1qp0wKgEUEusUrXOkTqV1aiXnfpYxPpZ1qnOcjMFfFIvZXzmJ/Of5mYUGCuVy8zYA9t1zMkFsv1y/X6A41ae/EqlTtAOh/s5cD+QNTOEMbR8FRc0c+yu0qFHpI5NaBYXm5XMxD0MYczTEkRLy45OAI5d1Hx8HWg+CMP/UlV3SJiwdkdasv49HlXIrd0QSKDj/yUuz7QAAIABJREFUU+96cXPDUjNPaRIdzup33HLTR1zXMTrRUhjjQaX6DkVyGB0eItODOqnLw4YA6augNArkvyB9C4i3IOP8XT6XpURVbK9cI1K0odYpmWZa+UBo1inF9yK1ogPXqXbiO1q/4nXKdfmXchl37HwTYSg+eOpU/rEpTf/Uml1ooEAfRbXq/Tgim3l9ad3zbqs1/Fce8yZ0hB3JDRxj9Vz8IUuyE9IodFGjEhiIQUCcRVJFOpDTkiwfES4RhbNKRR3zrqtFgjPWXM1nyUaZKlrf2tl/ea3RvGNqb75tuK8EfD+ASq3SupcECnSjuLoCZ06vWwlOSQKn10t/+6xnXGuUiKhca77C84OblPaAwqQlhXLYcm6Ooh4gMj0wWmBkdBSEERlbrVjI/WXd855Ta/jH+RS11im1lpDKQuWXGXmdciL/Kun70G+d4s2VnPO3UjM6potz9vTqaub9Y6p+pqtdaKBAkq9Wg3uFEDNN5IMI7n6lRomQjrPVRxENKtOjQuhkKIiTQikVotQ6UHxyZHogc4TyYlZInU4IKtJBOS/Ff3cSNdHHHYMLJ/JUzrj8yZzrXknrTfb8sPTU1g7xXFjPuLSEmlI95UoFgjBoA4Xdfag3eqPALmycgVxurtx/UpLQ9KuhTfeWG575X4urhaGyKPpheOqw0ni7cvgj86LSKERRCIrFNdrMgZwY46y0KNQGTxpIzsK86zxSbfivEojHhb8MvU515noYuE5J84daswatUyGGmM24T+Yzma3xzRD7tVIp84fjq392a154oLC3h+u5XPiTQoiZ5Z2tNLwXNT3/zuNeExmJEJ/+iaQkCoOUZgTllaTCjySRCakQY9OD8mSWJgtSI0rCJfV8zKHQek6Bh0gFGZ0Gon8jLYXD4MhxncsZx2kfN0/4Xl/e2X9tvdFcKjruE4pqoo8FQQjlarmrzX4aBSqQcV3YvLBBiXHsNQUJrOTzl2676YbfGqbpo2r99X4onqEOBwooRL5KMelRBBbkWqLuS57XtulB8rYwvhoE4bGMt9p1ioCKiNamgeuUMoUojUS8LkXrW+c6FZlY4zK0TnGAcjbjXHJSWKc6Zcs591ZWnB9gjM1Fkq5h3guTMkvxmZfL3rcCwItMBDOpskJg/qBaJ23CIFt9y5s4dkYk9SEBAmI4k36LkapP2hpbPgqKhVH9N/2ltAhSGxEnaImel9klI8BBFZLtr/MDVOpKEBnH2cqNgNrrTf/c1s7e2zvIpCYlatuORgKVWhV83+8GCrt7UG/05/lZL5Vgfb1o5TolCTzj4vnfP3/2zEB7uR+IC4fV2ltoE5VkbcSzophb2xqFWMOgoh4iJ0ZVTrE0g2AOo0yk1wsBzgBw2H+dYrydcnrAOiX7qF2nYh8FZVY9dp1y3a2c66amXVhWJ8b41V4KoHB01LyVMfZPp/Q9D2y2XGu83AtCna2+pdKjr0P5DnQQmUTewC2npCjsKHZcjDkVmPwKO00PERlTp0YionimZ8j00PJxIEpoie6JY8HZzmUy5NhkfD21tfsmzw+uNX7QPjBWCQgh4LB81NPG9u4eEENj/4vBxQvnLL3zWGfm+Modh1e/4tabfs1RTol9r4Nq/b4wlOHWsbmRNIsq46w8LKhfdcCQBwkJDLj8pdOB+ncUeEZEDoyKfqXv1tGxTsVO0/p1SkVaxQccySXbZ51SGgXuxCaI9iGoc52iRxXFvcCs625nXPdE61RSmJmM+Kl8Pv/FKU311JtdCqBAp9dKxXs/AEvyE0x1AkKBpcNq/R8QMNZ0pMv2R17JykmIS8Ag8zl0IPVWchbF0hRpGJQzY8uBMQp9kk6KknM9Im6ixUOCArJNdpI5KY0CZ44gO0g2m30y47ADEwFWqvXrtvcO7zV5xpadjASq9Rp4Xq8j/fbuPjT6+CjEvcrlMnBhw9I7T2aWVCu5bHa3tLry+Lkzpx9bLeR60V3UmaYfXl+pN4gavQMkxFqFSKMgTZKxH5MCCXQgkLkYCD2qezwQ4jqK0AagLUMPFOKU0n3XKaacrlX0liJ+O36diojhBqxTVAdVourqXqcyrvtUNuMM5ctx/Bzi06VSbimdGGOZLAVQoMFWKv7rEfGdk/ygdW0d1Rqv9YNwGFt9BBQU4lfORh2ES1IjwOUGHjszdtKcxqaHmJlRLgIdzoxJZkdCEw53IvME1Ul/k6aSVIgENgQhez+fyTzCBpxmkuN/8vLu1/pBcFYnF3t/shKgFVtqEyTNRvc1WKOgyp45vQbFVUvvPM5Zy2azO+vF1S+eO3Pqiyv5XLcjSf+G2UGl/rWhEGeIeyVOKCd9FGLTA60lKneM0hrEpgeVol75NTEmQsSzQoiSdEghbQKdJPqDBe06pQ4m0jmyvZZ1aDGVj2Xb32rwOtXOlkvd7b9OMT+fcY3WqV5xhr9WKhWW0olx6YACIq5GiaIoHerUr2qz+bxGM7jLoCPyo5VOjZEtT9kQIxrmDqAg4xs6nBzVItHho9D6MKOkUPThtsIjI4ZHuZgopB4ztcUORqQaZJyRCWJr2Oxth0fVm68ell9jMF5bdEISqDfq0Gj2Ny8MAxQUvfMGOI5OMTahAS1AM0Sylsu522urxcfPnpbgwMiJuOF7t1Tr/qsjUagohwgARFoC5aOgnKM7EkK1fRSi6KliiOIMgQO6ZDJaebHjHFm71imlfqB24pDM9oHmpOtUHP0gDzjHrFMEaeTYOBitU8lXZ9mdGJcOKNCAK5Xg6xDFK6a9jhzHbDa4X+okIOlIJH2zQt6SyCTO2dDiTFBaB+VfQOidoh6EJDKJgUXMutadG4JJtN92ElJqvxhoRDHKKs8EMaIBq+VzWa3dDhGcJy5tvysUwnq+TfvlS7RPr87h0ZHi2Olzbe9chUZTz+2zUsjBOUvvPNLsSnCQzVxZLxW/uHH21BdzmWztJBUyBs7eUe1dAjH+3iJ/hMgMqb5f6bRIoD/SUkZahchnQWkeckEYbtCbIbUIkf5ZGh8kYOgHFqJ1irFI6znhdSrStiqAYrZO9ZM1Y/yPikX3/znJPCzSM0tjelBAATcR/R+d5gRSdMN+pfYuRCgY9EOp9GTilkjdFnG1y40/VuPR+SDmRlfmBQLtMpukQtj0eBSTLOtphx5J4CCfbzswxk5CnUChFUERqRBX8rm/H2YcTc8/U603LjYa/qYXBJtCCKurHkZwYy5D/gf15vHZcrd3r0KjoQcK1M2Ns6ehULD0ziZTRt9TLpfdOlUqffHcqbXHc7nsyOF3Nc9/Xr3htbWViMrnQDEeSrOCMjV0gALF1KqiHqJ080FI6yU4wCJzg8SSyj9B4QRlhOi4aI2S2kz9OtVOUJfKOiWZa5XmVK53caRXe5166ASkcQjQ/KFSqTSpPBImr85Eyy4VUCDJlsvedwBML/30CUwO8QsRqfQisqWkRqGtapP87LFzolIztsKOVCIYAgVxdrdWIillF5SLRBwmGdNGo0omxTo1E5xoUEAUCtmHGbI2Q8+Qr68fBsVatXmx7vmbTc+7KASu25DJIYWXWjGlTSBj9HHX9s7esWaJ5DNkepD0zpZcYeAM0beUz+UunVpbJbPC47lM5nikZjjX8iBSbrwHQXSyYbVMD+r7l/liFCAgqubOMMiIoI0StVGUA3HAxhoFsj50RTzIBDM9jo2TW6dIyREdbBRXzPHrVC6XfcRhrDv2VyNbRPjU2lr2w4ZTsJDFlw4oNBp4i+/73zut2dwv194pEE9CKa0+dtqeJVpWH4XK2aD8COK45zjqgQBBi3CJnIQi04P6uBRPOjkuAnJBYUfEsRA5NynNRJxASgIPpZmIc0gopyQu8jn3Uc7YcEfOAUIPRJir1esX6/Vgk1LYBkFArvSWuXGML2qcSnpQE1d2rkJzCNNDXEexuAJnTll656RMiS65kCdwUPzi2dPrX8q6meNiTkea8WrDe2nD81/QWUkr7JE0C8qvSYEESd/eDoukb5y0DFQ+DPEcoJDcLqQmYJEGIfZRUOGRMp1c0lehZ52KaeW161TCRHrcOtX2UYg0qMesU0QaRT4KtE4VCplHGYLROhUE4U+ePl340kgTsiAPLx1QoHk7Omr+c8bY9ZOew4iq+b1k9jdsmzZuqQ0g70KVYrqDQz3SIKjQxzhplDI9xPSsMmpBeTgroBGbHTpYHLuchFpIPdJIRCo9tToIae5g9AHmM59X/ArpXojCqTW8C7V6c9Pzgk0/DM7bBFLpyviwXAYhjg3Bl40N66PQ2bMLG2chl7O5vgi+EwdFrdGAV7z4ef95ZaVg5JBoOtuU+OmwUnu3QEw6bLc5EmQ4pGJn7HRupDVBRkeotQFFiJtkq5CrjnJKkLtyOzKmbXZQGEJuJa11SmknydE6oozuCIc80ToVaUA7qZxj/yp1GGprTik6q2edKmS+QPkrhpUpY+wLxWLmZ4Ytv+jllhIoVKvenULAt0x6cpuef0Ol4fWkZx2yH10qPRWf1PYmjn0YWuGTXfSmRELiqMgHcoCMox64SiMrU8320Si0E0rJFUMwCpMk9V7kTczAaRZy7iND9n/UYqze9M8ScLh6cHCXwzhn3BRvjdqFxXmeGBiJiVF3XdnZg+YxERHHPSvpnTc3Ij95XQuLdZ9O3PWGB/V6DWqNpqIsAoB7X3P3v8/l8mPRIsQSLNcb93h+eGsfibZ4FCL/g5a5QdE0q82cfBSk9gEhK4SItJ5RKGTLG6HT1KBI5CNlg2xWHhpkdJY60MzCOsW506QQSbM3DX+uVMo9aPbM4pZeSqCgskoGH0DEicb0H1Qbbw7D8JoTvE6t+GT1AUZkJRT3zCPCpVh7ILkOlOYg3uhbPAoyaqKlrouYFmOgoMiYYpufMkvI7HHRIqIYz+JscLQEcM78fC77yDg0CoNk9Om/+8I30qmJUh67rguu48pfboHD0K9WZyrpQQ+Zmh7iuk6tlWBtbTmCXEh/LzUHtYZ0/KT/Tl7jBgohJX6qNd95jLZSagqiFPURGEBKKR1FPcT5H5TfQhjiaQDMtU0OUYB0R9SDHF8U+SDLqQEPXqfiUGup1Th+nVIhOBHNdGcUgzzQJNcpHplXj1+nGGNBIec+PGxmyWXOEnncWrCUQIGEUS77rwHAdw+9so5YMAjFmcNq/cSETx30qu2wI+kzIL/WiIQpJjFpb/gEKqSaUYZHRmaHCPVzmflFeiVEH2DbCTKOT5b6QxlmSaQtpFEgqNG2/bmus511+e6I4jF6PAYKyYdIw+A6jgQOmYwLDrdx/f0E6wcBVKrDacGvbF8F8mUwvUgTvXn+PGQyizkHpCmoNRtQrzVkLow2v0B/SY0bKBxWG28IwvCGY+YpWgMiHwUC/xGvQmc2yYh7hQshzrWDGdoahZYzY0SO0Mo8HxMx0W4i66YDRUwKRwcMCVImv07JvBbKRyGbcbZdZ7h1ynHgl1dWsn9p+s4vcvmlBQqImKlWvR9HZBPxvCrXm/d4ftBPLah9vyi+WrkbS1LVtkZBag6UOSEiS1Mnh1bUgzJPKKYzgSqBlNISEECINAGK/pmiGMjOF/kxdDpCqpBLFXaUtP0hiGAll3s00mJox5JGgeOAQk/djEGGtA1S4+CA47g22yGB5GoFgmC4QJUrO7vQbBo5i7emgfwUyF9hUS76+AgU1OqkOWj0I7I8dqjjBApBKM4fVutvGyBnCQykH4J0Xow0CMrMEGsgpTaBuBco3T0dP1QYpDKdxCGRChO0ORTk3y2gILkTovBI+jsmg5vwOsV5ZFJt+1IxJoJCLvdodKg6VlSM4f7qavZ95Hy6KO9tGuNYWqAwSa1ClCHyH2Kvk9HQcxiFOyoehDjzY9u2qByHJAUrhQm1NQoyMqLNzKielRs/i6IeFCmTqj8CJDHbWeQwKY0TkWZCARZC6lxGSNC/uw67lHGcYznnhx7kkAWHBgqJ+mg949yRZgoJIFwCDsv1CQRhCOXKMAzASnhb27vgeScDCvT8mdPrUFxdGXJmZ68Y2d9qjbrUHJB54fhA0sF9HydQOKjW3xKGYkD65zjSQWWQlN87RT4Q8Ec6M0TppKVtQpyVxwu5+Udj6giL7E4IJZPOqG8oBgwdaewHrVOq9oj9NVqvRl6norDuOH9En3XqcsZxDgfPFPtIqZT5g9l7E6fbo+VaJROyVloF6atwapzTUPe822oN/5UjtiHVaEJSrsbexPJDR/rgIyck+fHR5xsRp3RQOSNpC+jBHmdGqUmQGeK6CZfo61eZ2KS9QanxFJubBA6k0qOlhTN+mM9lLo04vqEfPylQ6NcAxf5LjQP9LoGfQ7VWBS+RSnqQ4E9qeojrJL8RSe88R/4jpDkgrQH9n0JDdWaFYV7ccQGFuhfcWms079H0IU493wIKcaKoSKsYEzBlwzBca+37SpcQ+SMqR4QYKEhcEDEsKE4j5clIWSfpT4Es7FmnOBG/xUmeBq1TXK43Safr5DpFnYlp5odZpxzHOcxl3GPXqUib8EPMkG9hmPmf9zJLDRSUVqH+GgBnrL4KQ6aSHvgudagOo7Aj2vClT7Xc/OmjbOV+6Ah5JBBBGoYWa1nkJCR9E+SGryhcZdpqCRTkEhA5MFK4ZaShkFEPsUpPaS+kKYK+aYH+Sl6q9SZypQkUkh0msiCHNA5uRgKHedrgdMI/LpX0oOdG1ShQ3SuFApw7O1Ysrhu69n5IZoVaQ4YyNkfQHBzX0DiAgueH11YazXt1RGWRWbDFzEjrhjxQxBTOUXppQFwhoiWlWIwdFBVQiJJGdgyPlA6qnGJoVAuK2rDV2kLhlmTuUCHbEmJo1ykmn1GcMNL8eew61Q79luGRKaxTjsN+dWUl86fal2UJCyw9UCCtQrnsfYAxNraVrFJv3tn0gxeN8n4p0wA5JESAIEqyogiXovhl6ZsYZZfs5EHoND3E9cQgQaLy1scdnzxUfngVF638E6TpQTkzShtn5CSkNAsCJxn9ME6gkJwjUqvGPg4qwoKc8+bzs6nVa8aOiWkABZLpLNI7h2EItTr5HNSNSKVO8h2PASjw/bLkTNCGlsRrRyvddETpTBA/9lGIqN8LIYpVSa5E73iHRSFWHigW58hvQRZTfgwSKFA+akXiFB84wjgZ1KB1KlJTKAIolbwuYpaNOGGiMMvIoVuZPDvCv7vXKadDy9pnncpniXipj/8B2y4W3R+xvgn93+75XPFO8qUOeKZcpixr+J6Uq21VV296z6k1/VeNWH+sHqQTvCRNUicDpVGIM6nFQIE+2DBKO92KeojUft2MZ0p9J8tILt/Y3EBoXv0twUlknojPCrFGgUktIYhCLktxyqkTL/WT2SSBQm/7TDpGKnOFcpKcBz8HWr2JYMnIAy8FH4VYfo7D4ZoL54Hx6S45Chy0zQojfpNDP542UGg0g5uqzeZrh+yA2lijlNLKwZmsA9IMILWJkckyG4a4JnUIMRtjy/Sg7I6kRZBGB+mb0NYoKL9F0ixITYW6QRvycetU5MtA/Rq4TsUahciP6th1KtYonHCdEgJ+aX09+9dDynPpik33q50RcZOTYbXqfQCRnR5Hl4TAwkG1/r+cgJGx1Z3YQQcpQoFFWgUKWZT54mUkgwpbjEwNMY1zTMNMKj3F7ii9n+kQIBRXggIBcXmZziUCDjHjWUSrEpUh8wMqkwXy6BQAwUrOXQjTw0nmX/k5RGGZbmbqm2G/MQxKJT1ozGlpFKiNUnEFTk+B3pkiPEhzUCefgxOEep7knUg+kzZQMImiih2YVdpocniW6n1yaFbREFGaaeqzEHC2Zcpo+TMqjYECCLE2ITY2qH+PDBTAHS4wpCVE2iRDaQ6N1impK1AUTZp1itOyNcQ6pQ4xyolbhWCq3BWkkehep6Qyljl+v3WKeBNWVtwfk9Fl9uorAQsUIrEcHflfyRj+o3G9J+V64zWeH948Qv0R7aq0/EV5HtoaBQkCWkBBmQxi2506RkpSVaUZiHkX2maLNlCQyaY42QYjCmj138r0EKkCOyicpTOjw/fzmczWCGMzenS6GgV9V8mvQfo5OC4QiKD/T/PSpZIe1LfL27vgjxD1kKz7wvmzkMuOn945Bge1Wt3IeXNc85Q2UNir1N6DAktD9jf6dunbp++YPm/loyDV+FHUgwqPDEuU2TZOBNUyNShc0HF1+yjEmiryFYhoFogGWq5Z0v9JeUGqw8qI61RkLpF+DIPXqfaBhtYpx3X2c67bs04xBj9fLGY/O6Qsl7KYBQrRtNNpv1LxfhCAXTuONwEZ5g6OavcTH/tJ6o83aZX1MXY47AQKkj0hUjFGSaLinA6SaImiHmKkLnUClDAlAgMSPCjNgvSPVFEUcUKpGGgowqUo10PkzMg4imwm85hpZraTyCB+ZtaBQnJs0s8hZpCMwMMkozIbRAzUOFmCwq0ru6lutJlMBi5eIG6F9JceAgfVugpl9PzheCJGeQ9Nnk0TKDQ974ZKwzehgm/xKCjzYEeuhyhcUjkaKtOhEOKsQHRaWgRldFDmiMhZIWl6kFkmKeqBEV8TgkOMsWTvkhFZg9cpUh+QqVSFVxyzTnVww+jWKaVRiHwVOtcpJ/OY43RnkGSMfalYzPykyVwuY9n0v9Y5lmKzibd7nv9PxjUEolk9qjXeJBBWT9BGS6Mg7YDS3BB9gBF46Bv1IMMlVfZHZXpUCaHo35xYo0BeyaHSQsTJp2KnySiLZFeudxWfrBjPchn+lDNBDgWS2wN/9/A3IIrMCWQ4E48QSIh9HBzXkZqH8TFBIRyUy1G4vPnwt67spL7ppknvTKGeZFIgvwN/xsBBp7TTBAqmVPCtqIdEaunILBlpGWK/BRn+TKFOZ4QQkqEsCn5U+Wljv4QozkHFO0QBkhJIyLVJWjcZ42HL1KEyOCmzZeRw3WKUbflI9K5TUSbrKM39oHWqHW7ZIofrWqfcpxyH9eF6wZ8tlXIPmX8Zy/WEBQqJ+a5UvH+CCLeP6zUQiCvlWvPlQRg+y7ANAgoyvjjmQu90Zoy+ZxmORN+t9F2QzowxAZO0C0q1XxQNLRRQaPsoKGcnFQURUbxKChaVktaJWCC5IA8HBB7kskS05B4YjmPk4mGI7mce+sI3jlzRDFVArJExl0PGcSCthFdNT3n1n/S6fGUXKIFUmhdpWC5eOCe1LCe5CBxQXgUCB8MyTJ6knTSfSQsonIQKvk2yFkcLdGoUFBlTB0V8HFHAUIRrQsBqZ3ik0oRFkQ5xMklyYpSqRqVRiFwRCC6QvSFwupyuI0bYtNapyBx63DrFAIJM1um7TjEGny8Wsx9Kc54XtS4LFBIzW6vhdWHo/+BYdKMdbdEH3/SDm4IwPIMAWRSYAcYyiEgGXPrtMmzHhEqEyuUmLr9GlWq6FRKp1Ipyo4/ZGVWGSWUX5JyFAtFnnIeSqlk6GSnULz2h5QdNIEFQKGRIyJw7TogBOS9LU0XAgIXIwMu57g4lW5nWh/GpBz//v02r7Um0S1EC7ciKkye8GiaV9KDxpG16iNsypXcmdkgCPAoczB+7blpAoVxvvtTzgxeYvINd4ZExZTNxsMTOjNGaIiMKItOEMmMS8btwEfkKA5Ehm6Q8VjDgdBYhXECppWIiJkm4pJwIZY5pGe4oIKS9XNUdOU0ft05JLwgyPTDyz9auU5ET47HrFDDwsm5mhzHot06h4wQ/trKy8rSJLJe1rAUKfWb+6Mj7esbg5VN+KTgyzGAImabvX1tv+q+UXO1Sy6d8FGKgoBgTVfhTHMHQ8mVQeeYlBztRLRcL+QemPK5Uml90oJAUUpzwSlJPD5nwyvM8qNZrI8n78pWdsan0z5w5BcWVwrH9owgF0hyQf8U8goPOgaUFFI5qjVf7QXiL4aRGKeqJmIiFisJZxjcppsTIZ6HF1qg2eFpfWoyOrfBoSR+vOF1UiCWgCsJiEApRDAXeEK1RdLiglSqM6xl2ncq4zqXVfHbM6xT+YamU+zVDOS5tcQsU+kz9/j6eymbDHxNCjN89e8hXr9rwnt/0gzul6UFGPVAkAgoObCdEpNzxMo9Di4gkNim0Ejo5wuFwuWSBwpASn+1iZBuWDpIRpwNFWSQ/ZsrpQLkdRrkube2MTb3POZkgNrqiQlrggDQHI/Z9lHGn/WxaQKHa8F7a8HwjjUK8qUfJ47qcGSlzrIxoisIklWaRCQylFkCCCqVlUFFPSrPZBheKmE3do3b8MLgQCrhOBVqR/sEJGccwuU7103wq3wK5Tm2VCvlPpT0HcX2MsUqlcvWHNzc3q+NqY9HqtUDhmBmtVoM3CSHum6UJ98PwdL3p3QTAyBmymc84TzgOPzysNt8SA4UoiKkd7hhrFBgKl7uXi4VxI/XJSGzZNAo6qcYJrzJRdAUd5UbVJlCbl69sg++PBjYG9X21UIDV4krkkFiHMJwIZ5dOnKnfTwsoeEF4bbnWeJNhB6M8LTIjYmtTl5t8x6YvmV8VHbI0RyoTpDJH9GoUVMpqdT/KRhmVC0ORD0V4FhGy3OEHuYzzqMvcg6N6/T4ZPBFlqG07M5KDdaT5ZCgyTubyaj4zRo0C+0+lUuaPDWW41MUtUDhm+onauVLx/gUA25jlNyQMw+JhLQYKsTlC+SjQB+5yLh0W6UO0GoVZnsnZ7NvlrR3wh0xJPZsjmI1epQUUaDQHlfrbQyFM1qUWM6PUOKpogMj00NJCdm/6Qq4lERtsd5mY4TEyPSgQEaWxlkRJ5OckfRwgXMm7j5L5gcLCDyq1t6oDzTHrlHJuQMdhpPkck0YBnyoWsz8eaV5n4+WYg15YoDBgksrl5nMB2HfN8jx2AgX6gGU8slT6qfTRMrw58jB2HeeS1SjM8mzOXt/GaXqYvdGOr0dpAoVQhOtHteZbZAKnIa7ILEB+TUqjEGkA2j4KpPLnYaw9UD5NZHaQ4ddRjhmgtPTyeTJ+xmUpckoSN0Waiij0UfpLuS7bzrruLnWxEyj0rlMz4n5aAAAgAElEQVSxNkGtXRnXvTQujYIQ4qfX1/NEN28vAwlYoKARVrXq/e9CwAsNZDrRogQUjmqN+yKPYsmDoGKZo7BHCRIUAZPD2SXrozDR6Zn7xi5vbYM/h1EGsyb4NIECjS0UuFapN14ThOLCEGOV/gakWoydGZXCkUADb5kj5JpBEVGxXxOBBaV5QM6BzBHyeeWjoMBFTNTUkTwuJI1C1mG7mQ4WRAIKh5Xq21rrVETwdsw6NRaNAufwN6ur2X83hLxskYQELFDQvBKHh3iGc/9HAWBmHBs7u9wCCjJlrELkKiKiDRTijI8O59aZ0S4BRhK4tLU99xEHRgMeU+G0gULcTc8Pr2v6wfUAmBeIWQTIAEJGAGYZsozAlkO2ZGNVG77kV4nCohGVmYA0CMofIdYoOJwdAGBIgKClMWBEzUY0zTIpDIVXS18GSaYEEHJGvAns0HWdLkfBGCioaKz48HLsOjUOZ0avWMz8MGNsf0xTvNDVWqAwxPRWKo2vQeRvH6LoxIso00P9PsV/IGOfI6CguBNkJjeparRRDxOfnAVo8NLlHQjCqdFlLIAE1RDGBRSGEBAjJkchwvOALFS8KopETeZegFiDoJwYKYUs/YJgoria/V0nJa4UZXqovG3wOqWo5Mfho8CY+FixmP/4EPKyRfpIwAKFIV4LIj+q1YIfFgI3hyg+0SKxRoE41WPWxW7CpSg3BLOmh4lOzII0duny9kKFKU5rWqYIFIjiwC1XGy/xgvCZxG1AvkqOww8avn+HSk/PpYlBpZ+n1PJEeCRwvbjyPxj2JSsyFmNbozDUOpWq6YFz9sTKivt/ktbEuOP2ASkBCxSGfBGOjhq3MMa/d8jiEyvW6aMQ53qQDoxRbLTM2RA7M3LrzDixiVmQhqzpIZ2JnCZQ6DeCuuffWG96d0Xp62N2V9Hpo1BaKfyPNDUKsY9Ca52K/BQUXXx7nco4qTozCs8LfuLs2ZUn05nJ5azFAgWDea9UgvcgilcbPDL2osr00LhP2v4keUocfhSZIDqYGR3HOjOOfUIWrIGnL19ZWG6DSU7VrAGFWtO/seF5dyk2V/JXQHQcZXqQ4EGgWF9LV6NwUKm+LaKbbzldK0frDh6FlE0PnPP/vrrq/uYk53oR27JAwWBWH38c8xsbwQ8jIuXJnYkraXqgqAchmRtbIUySsZGITmzUw0xM2Vx1wpoe0pmuWQMKsUZBMjF2UTLH/AlMpKlR8INwtVJvvDU2kfZdp1SYJa1TKZkecKtYzH6Ase7U0unM6HLVYoGC4XyXy83bANh3Gz42tuJdGgVpbySHoA6v4vnSKFCymUIYYkH+IuYA6P+QQ0T5f4GQB8TcQ49+aZiwsLHJfVkqfvryNoQLRKU8rXmbNaBAGoW6591FWWaVbxNFRPBQyAAG5eSYvjNj9W0qu23vOkWmB0kTnZ5GATMZ8cF8Pv/Fac35IrVrgcIJZrNSaf6viOyVJ3g09Uf6+SgonwRl86MQJsSQYp6npVEgasgVZFgQIlxFASvIoIACCwiigAIKwOhv+W9Dh6B+4bEnUpelrbBXAhYopPNWzB5Q8G5seP5dXRqFmI5ZbtjpA4VuHwUihaMIi5gGumudSkGjwH+/VHI/ms7s2VosUDjBO4CIhWrV+xeI7PQJHk/1kVCExcNq4z6KdFAnA5lbssOZUaaJlzZB13EuF/PZ1KhRGZMn/NUgDIqAuBoirILAVQRYFShWEGGFMakNSP09s0Ah1dfo2MqevnSFsgJOprEFbuUNr7r7t1fy+X3GYLR0ninJSPoo+N5dUvtIIQ5x+ukobJI0DcWVXGrOjIHA1aMqUTi3NZ4D1qmtYj77yZMPFXeLxeyPMsa8k9dhn+yUQOoL+LKIt1xu3gHAvnPa4w1FWDqqNt4iGdKIQyEiXVK0rTJhS4tXIeM4W8XC0B8gIY9VIbCEKIphKOi3BABFBFxFhFVEdKc1fgsUJiN5CxTSkfOrX/5iyGRcSr1MFMpVYLzCGasw+YsVzpwK/ZvrsjKKdEISB/W8y5mRaN+jFPUqUyQdLDBVHwU60BxVFYPsoHWKTA+u41wpFrJ/c1LJI+KH1tZynz/p8/a5XglYoDDCWzELJgg/DNbKNe/NSoWonBYxcmbkcUIolTuevJq3S4XcX8dDJnMAClwLQ7EWCrGGiPT/EjAsRkBgZt8PCxRGeHENHrWmBwNhDSgaA4VhamOM1xlAmTFW5pwfccbKjEd/A6tEGWKHqerYMvXIR0GFR8bgoDMTZMpAIQxLMnndEOsU52xnbSX/VycbIP5BqZT7yMmetU8dJ4GZ3QjmYcoQMVurBe+bJhETcb4fVWtvlhzqDJFLn4TOqAdkHOh/4DAA33FYlQABAygJxMw8yLlfHy1QmMzMWY1COnK+68V3wOpKATjnI1UYpXsuA+OHRJXMGD9kDI8cxz3kBiAiNj2ofA+KVlnma2iloU4XKPh+uFZpNI5dp4joqc33wneLhdxfmgqKc/ZURKzkmz5ryw+WgAUKI74htRo+Iwz9/wMAnBGrOtHjfhieqtQa9zLGSK1JrggcGKP1iDMAh4jWTlTxjD9kgcJkJuipS1dAWB+FkYX9wjueA27GhXwuA9lMZmTA0K9DUb6GI0A4cFxnnwE7cBg/cF1+gAmGxVrTe1bdC15GWkhppoyiHzgnfwWVinp9ZeV3GYNUNt3OA02UYVKGcKtEt4AqGkL5UjnA9kqr+T83ETrn3ANwfmJ1lV02ec6WHU4CFigMJ6eBpSoV//WI+M4UqtJVwYQI1wMhzgiBp4UQpwHwLAKQyWCp5tICBd2rks79py5tyfQ/9hpNAi/8iueA6ziSC5cBg2w2A7nseABDsqdE2wwAFc74ATDYd7mz54ei4Pn+7VIT2WV6oM1bSG6F9eLK7zEGqTgEhiGuH9Vqb1I+CpSHRmovkLd8qSKna8mjwPdLK7k/M5E4IvuPa2uZPzF5xpYdXgJLtbkMLxazkrRJV6v+dyHC7WZPHl+aMcj6oTgrwvAsgjgTCjyLiKen6UCY1tjSqMcChTSkqK/DahT0MhqmxIu+4lZwXEdy5sewizMmHRwnBRj6AQiKdkCUGSUDBO4DgicAAnJmLBZyv+9ypzHM+HRlYs2nAiaUzloClIgYjiKoCTeo7Lcu44el1ZzJpv/pUin7b3V9sPdPLgELFE4uu64n/6en7Xq1Klkbi6ZVUpihFwQbiHAuCMINBEF/G9dj2u48l7dAYTKz99TTV4jNdzKNLXArBBRcN2GdjFAD4wQYHMhlsmMxSRiLlZJCCfCzGecRhztb3OG7HFjZuJ6OB3w/PF1uNN8os1ZKoCDDuSVQUKaHyFeCbKeMVddW8n84THuM4X6lsv9jm5ubXWmth3nWlhleAhYoDC8rbclKxXs+Inz7oIKMgROGYsMPwwsCww0hcENGGtjLSAIWKBiJ68SFn3p6S67k9hpNAi9+HgGF7mhitT8qPTxdnHFwJWCYjEnCbESsyRjUASGkxFEUW8UYEJOb+huYBww8znmTIXiMsyZnzGPAGsCxJhBz5Yr3epThoRS1zcl/Eckngjhg6D9ImxD5LTRPra783hD9QyHEv1xfzz8yRFlbZAQJWKAwgvD6PVouN98BwL46vicAS0EQXkARXggRz1OeiEV1MExZlAOrs0BhMtK2QCEdOfcDCsfVTC7JpGEYl9NjOiM6QS2EiSLTA6JMQEVgI0BkPmMYhJTWjqikGYbrqyu/o2sBUfz22lr+v+nK2fujS8AChdFl2FXD7m75NsbZjwrEFwgUF4UwN0Wk3KWFrM4ChclMqzU9pCPnO59PPgpul49CrE2gX7qSGgb6V/JhWDjAcIxISZsggAeAws+5mc9xx9l1GNtjjDWTjzDGHl5ddT8UhVSmM0m2lmMlYIHCiC/H5f36DSygqAfxegbsVQh4fsQq7eNDSMAChSGElEKRJ5/ekpzg9hpNAgQUXJdoS0iWZssuyZ+iJLIZdzZ8GEYThfHTnBODJdvlzLniOOxKxnEeXl3Nvp8IqYwrsw+cSAJmb+yJmlish65exbUAK18lCBggfBUC3rRYI5yP0VigMJl5skAhHTnf+YLbIOO6XTAhhgwxDIsjIo5blGPAQPWMStyUzqimVAv5PiA8gAz/lHP4vfNn1v+YMZZKdMaURjTzzVqgMMQUbR8e3iQ8eDMAvhmA3YNzzGg4xHDnoogFCpOZpiefviyzhdhrNAnc+fzboqiHzgDJJDRIQodkm+3ypF3ISKdHu4QDQB2AfYIBfNxh7OMbG2tfGG227NP93jwrlT4S2Nk5uFMgvFMw9lZAvNUKabYkYIHCZObjyacut+L+J9PiYrbykhcQUDDLoSbTuVGSlgioxX/Tr7xQ+TBYwND9zjCABwHYRzjAR86fX7cRESl8UhaOdghRggOA+xHhfgS4MQX52irGJAELFMYk2ES1Tzy1lUYOosl0doZbOQlQGHY4yukxIzUWS22S6CcwBp/mwP9TIQe/sra2dnVYmdpyPeBruUWyt1d7phf4/wgAvt76G8zPu2CBwmTmymoU0pHzS194OziOQ/lYWs6hyaiHVkjEkMc38lnorI9AgsO51TD0nTLWBAYf5Zz9mwtn1/4inVldnlqGfCUXSyCImNu+enQ/Ir4XgL122fIkLMJsWqAwmVl84imbYycNSRNQMDU9nLRdAg+uw2WUhfVh6CNF0jIw5wPnzxY/FuXBOKmol+a5pQIKV6/WnuGHwbch4LcA4LmlmeUFHKgFCpOZVAsU0pEzAQUyD8RaAFlrwncxyaOQbFnHu9BTXgIGx5okjplCBvA55jjvP3+m+BsWMAx+z5cCKOzuHr7EF/jPGGNvRcSppINOZ7mxtcQSsEBhMu+CBQrpyPllL3quVqOQNCXEZgX6HeWi58kkYX0YjkMM7JMu4LdtbJz65ChyXuRnR3sDZ1wy23tHrwgD/EEAbFEqz3iXbfeGlIAFCkMKasRiFiiMKMDo8bte9NweZsZ0am7Xogu2jE0SjkM8DAu99BuLlhgeEeHf5jNr7zt9mh0YV7DgDyzk23Jlv/J8DIJ/iQivW/D5W9rhWaAwmam3QCEdOd/14jukGaAz3rGHcClydGxpEBLxkVqCpgRS6AmvjK0dZJIgx0dJ3LSQW8CJJ40xdok57B9cOLP2ZyeuZAEfXKi3ZLtS2RT14AMA7Bts4qUFfFs7hmSBwvjnlzYminqw1+gSINNDj4/C6NWOVAPNb8ZxZDSGBQwdmhnGAgD4gc2N9Q+NJOAFenhhgMLl3aP3MhQ/iwjrCzQ/dijHSMAChcm8GlajkI6cX/biO3oonHu8GU3jIxNd02ockt6THe0RYOAWMHRJlAH88oWN9W+2iadMs5Ok882kWovSIoS/iEj0yvZaFglYoDCZmbZAIR0533XnV/TyKESsi7Gvoo6JMXlf17MeJscksEgwP9Jtq2HoFhJj8EsXzq1/y7JHRcy1RoGYFENgv4mI1+g+Gnt/sSRggcL459OaHtKTsfRRSGSP7HU+RIhDIFXL3SV0zoq9vR0+d0SyNccl8iZrkpByYexDmxvr35Pe2zB/Nc0tULi8fXA/APx7ACjMn9htj0eVgAUKo0pwiOcR4ImnrY/CEJLSFiGgkHEzEHMl0ANJ3oQepsakBgC6gUQyfLInvBJYV3tJy4auPPWPHDCtDwOA47A3nj+7/nHtRC9ogbkECld2j96GiP/FciIs6Fs5xLAsUBhCSCkUsaaHFIQIAHf3NT0oOud2lEOHEqFfszqVgul93dA6FBKOw5caMFA0RM5de+6yhk7OHVDY3i7fE4L4XQDM6d5ze39xJWCBwvjn1poe0pPxy+98Xh8fhW6g0MPMmLAcmBIw6erTja5fe5wAA+dLGSXBGf/+CxtrP62T2yLenyugsLODpQAOHwSEZy7iZNgxDS8BCxSGl9WJS1rTw4lFl3yQNApa00MPj0K3hkFH8Zxss2ej11BG6yiiOxUWCjAslw8DA/bYhY21m5fRsXGugMLW9uHPIeB3pPb12ormVgIWKExm6qzp4WRypkyOa6VVOL1egvW1EqwVV3uTO+iq7jElMACGABgt2/Hf9Nvj+ghgGiWRdJ5Mhm8moyjIbKJYHpdHw8Bd9/kXzhQ/p5u6Rbs/N0Dh6lVc88JD8qxaWbRJsOMxl8DBYRlqjSY0Gh74AfGj2GscErBAYTip0um9VCRgUGwBA7Lrd/og6J0Xu4/8pht9j3Nj0vkx4dxomluit/9tKMFkiuvF1zBwzt9x4dzax4Z7Kxan1NwAha3to29CEP9ucURvR5KWBIIwhHq9CY2mB3UCD01PLtD2GlECiPDE01sjVrK4j5dWV+DUeglOnSKtwSo4jHdRNPeMPHEk7406aG+8Q0mt94g/mCK6Q6cxTP1aAqc+7UvSJsaklmERL8bYP93cWP/ZRRzboDHND1DYOfwQIn73sk2QHa+5BGgBbjZ9qDebEjjQ/4MgNK9o2Z+wPgpdb8DKSh5Or5UUOFgrymyMAxfXhM9BEhik/3rpwh66W9SGV47QfwUYFtAk4fBvvHh27ZfTn7vZrnFugMLl7YNfB4B3zrY4be9mVQJS60Cgod6UAIKAhNU6DJ6tZY96KORzChSsF+Vv1nUTGoPExqzbp5P3dR+LlqoxGU7ZEybRdlTo15ZWZZB4qMcWMnj8VFw6PS4SYGDOay9ulP5QN3WLdn9ugMLWzsEvIsI3L9oE2PFMRwIEEjpNFQQgCEzYq0MCS2Z6yOUycGqtJB0QT62vQTaXaXEUkVR0+7xu39Xdn/S7p+uP7n6yv4PKq5BK3uaMmPRgU2iPMTi6cG79PGOsmUJ1c1XF3ACFy7uH3wECf26upGs7O1cSIKdIco6Ufg70f2/JtQ4LDhQyriv9CyQwWCtCoZCf6PuqU/1PtDMTakxGSMypDwMH9isXzq9/w4RENVPNzA1QuHq19gxf+I9bNsaZen8WujNS69DwoCF9HRSAWCatw6KZHoiOuNOUsLq60q2aT6jWR97INc6GvVEKba2F/LBM+5Nor8cSErFAtkxupv1LPq/7+gfUH0dItFgpdXVN+z5jHstkb908VXh82l2ZRvtzAxRIOJd3Dv8DIH7dNARl27QSIAkEfgD1pheFZjah6VGExeLKZp7DI+n0SpoCAgekNSgWV6X5YNjLVPU+bL3HlZt0e7r+TqI/MQfDrAMGxvlPbJ5be59OZot63+S7mboMlFbB+xwinJp6Z2wHrAQAQES+Do3ISZJARLgoERZzFvVAKu1SqQhnopBFIjma9Q3IfkRKAjMNGBh8YvPc+usYY0vrxDRXQIFeqCtXy1+LQvw6YkxPZj81K4HZkoBPWgfJ50BRFh40PG+2Ojhkb0hF/eQM8yjQ4lWK2A9Pr6/BGnEZdMTvawmLepz2u7Mt6sIZNZr7HinryuvuJ70ptc6VOJjWobe+6Y+faKQpUmJmAB5jD7E8f/VmqbQ95GezkMXmDijQLGztHH43In5oIWfEDmrhJCAE8Tq0/RwIQAShmItxzprpobhagNPr64oaeb0o0yArmqJ+l3YrTcQXmsY3JpXzyT6Y1pd8Xqf8N21/1Pp140lv/MTBoPirprhFMfb3vOC89kKxeGUuPtYxdnKKszDaqAgsAMDPWM3CaHK0T09HAl6sdSBuh6YHzeYMah1mwPSwUshLUHCaohPW1sDNuNOZMNvqVCRAQIFzNnHAwID9biEH71lfX9+bysBnrNG5BQokx+2r5XeKMPxlBCjOmFxtd6wEjCSAQkjAEEdXkNYhnLLWgVT3Tz5N6VUmd+VzWTh9ak3yGJw5VYRsJgvxoVLLP5RQtZuef3vOw2xgUMTYhaIzRWjvJyibdfqHWR4/Iw0D5cQas4aBMSYA2QcvbJTeJ/+2l5TAXAMFGsDOztFzQhQfRYDn2Tm1ElgkCZDWoeUk2aAIC3/Cw0N44qnx5nrIZTOtqITTp9ehkM0qw7q8TLe2nq1utK1Sp/kfdTZ66k8gEzv+JPUkkA8DG5eGgbGHucO+8cKZtT8bdWoX7fm5BwpyOUHMbe0evY8B/DNEzCzaJNnxWAmQBASKFiGUIoXyIBTjPPSkDxQyrgPrp9akOeHM+hpQ/oT2eUUHDHQ+B8n3xLS+UZGB7nnT+zrgo/suFnf8PNIupKRhqAFjP715bu0nGWMNnVSX8f5CAIV44rb2yndAGP7fiPCaZZxMO+blkwBpGeLoCsph4aWodUjD9OBEJEcyZHF9DUrFlWNdD3WzN6opwXTbTXub1dVnxz9YAv3mn3JUnlTDQOGODOFXHZ75wXPnVp7WyX+Z7y8UUGgBht2jtyLiTwHic5Z5cu3Yl08CgnwdiE1SOkmqSAv6t5NcJwEKFA+/vlaUfgakNVgrEclRtMxodnpjTbwOOejuJ4SiO+8nwwl1PhM9lgM7/u482gmBjzL/pGEgzdRQGgZiWQT8DzzLfur8+vqjJ/k2lu2ZhQQKkTnC2b569B6B8EOAeMuyTawdr5VALAHSMkjQQJwOlDlzaK2D3vRACzOBgRgYEEggL/V0LsOdfuRGJ92ersOT7s+k20t//NKHgfUHDAzYFeDsl1xwf95qEHSy776f1hdt1uoES1NuiK2dw69ljH0vIr50gk3bpqwEZlIC5NfQ0jpIYqj+WofjCJfIfCCBAUUnEMmRE4cs6pTrphuRWXnaJBCwpcHo7Y2uf6bTZda/3vyTuv6Y1W/H3zn/BBYk46MAwD9AhF/c3Fj/GGNs0h7Bpi/VTJZfeKDQKfXtvaNXiBC/EwDebp0eZ/J9tJ2akgRIy0AOkqR5oEgLiriITQ+rK0RyRFwG65Ie2XGJ5KhP2mXdvmaoek+KQufKqAMGyY20R9SG/evpjx3/QNNCT55ujelhpPln/EFE8TuI/KNhc//BG2+80TopjrC2LBVQiOV0pVK5gLXgmwDgmxDgWSPIzz5qJbCQEiAOh8NyGVYKBci6kcbAdKc23ThnTZJap4VEh3Xldfft+EeQAPMA8JMI8Akh8BOBCLriepFl9rl3uG0Bw8lEvJRAIRYVsTru7JRfIZj4egC4HxHWTiZG+5SVwOJKgBJfLXSKzMWdugUeGfOA4YOA7AHE8AFk8IDvh3XdgNELDsSzrrlyM2NNXVl7vy2BpQYKnS/C/4ySKGzvVe4VYfguAHgTAKzYF8VKwEpASYDyVZBeOVbfDyMXvUKh26cgSbDUewBP+iAM7k+vzb67/Kj3dTKw49dZIoaff8ZZGYB/RkDwgIP8AQzZg/Ww4WchCx70pz+P79EvXVQu/jfkmYNnX3Nmm1nAoHuN5X0LFPqIaQtxFXcO7wXG3gIIbwTAc0NJ0xayElhQCZBjoyJAiLfvPk4KPTbnwRtzr6gSFfRwFOtyOCXTJSa2av3OndjZRqsvdqykX7XYJjfGpATs+Bl3AkTxBCA8Bg57lInwMeHwR0WAX0QPUO75MS6I/1Y4AICytBKzZytba6JAT3kAvpo/qO8Vdm6+2WoYBi1dFihoFnZE5Nv75bshEG9Bxt6MiM9d0L3ADstKYKAEEImPoWPJ0NncNfeTaZwprC3+N9kRXf2afbbHeW7U8qbP2/G3PV7jY2kHzkSAA8bYX4tQPCoQH3MymUe9ZuMJ7jgqMoEAwSBgkJyPEco7DhzW62csYDhmBbBAwXBz2Dqo3wiB92YUcC8DfCUCrBpWYYtbCcytBGgjV+djyZ2u8jLQr9wIkrkKDIdpWp9peV13TOszLb/k7XPGyN3lbxHwT4GxPwnC8MHOHOGe57FsNov0S6KK/6bffqIzLa8TP9WXX80cNPbP7loNQ7e0LFDQvT0D7lOI5fZ++aUQ4msR8DWI7G4AJPJ6e1kJLK4EIrCQLguAnmVAZzlICrynPKIk45FmlD7ARle/7r62/Z4UR72LcceBW6tQMZb/NMbP2KMO4l8iw78KhPgbR8DRcQnV+1gGBlsaEgqHpPyT9fm+zzKZDNKvxLmZDDLfZ/QrgUmHEiMM4ajR2N+9+eabrdOj9VFIdy1HxPzWbuVuxsRrQcBrgMFLLV9DujK2tU1fAq2NNtGVWbcUJCWnUwjo7vfUp3GhmHR53ZuiG5/ufk/9jCFDfEQg+xRjFKqIf+WHYi8bebcky3sAjO7Rb7RRy7/TKq8bv+cBy2YB6Ve2H/1Nv/Tf9O+rq3h4cHBwddkBg9Uo6N6mEe5TJMXOfvnFGMJdAsXdjLG7EPGaEaq0j1oJzIYESKugMzUY7zTdQ+vxYdAkjdad+HU0EEnTia59rallwcfPGKNwxAcZwmcE558EcB5ACMutWfSaANkcAP3KnTj6m36HuDzfY9lMFulXPo6IHmOMfuVGHv1Nvye539OFRP8623cyeNRcYsBggcIQL2yaRa5erT3DCz0JGgDhbgR4IQAO9+Wk2RFbl5XAiBKIDcfHaRiSzok650XdfdPu6upL3k/W3+NcmShg+rxpf3Tt6+Rh2p5u/JyxihD4/zHOPsMY+0zT9x9x3Ezgec2++0g2m0O6R7/qhK7+jsub3teNN3nftL3k88n+0f0AnLJ/cGlv2TQMFiiYvn0pl0fE7O7u4fNC4C9ExBcwBRyeZ50kUxa0rW4sEpAgQR3oei/diVp3P1ljorwOiGhP/DqJJPvXu5O2HTqXYPwM4LHQD+6Nh4rZLDLPY/Tbb/jxPfql+8nyuvs94o7aiutLOjsmnRt1/dNNf7J/neVzOSifO3fuKmPECLn4lwUKMzjHFJJ59Wr5lkACB3whInshArwAADdmsLu2S0ssAXlqbZkEzAiRdGIzJUTqwRWGBFFp9yfJo6Crv2dj7ElyZcZLMWr7yf5wxo78pndnLqc0BM1mk9Hf9Ev/Hf993H3T8evqS95P1p/sn2n7yfL9+7NSPjy8vL/oGgYLFEZ9eyb4/M5O9RrB/TtQsNsB8HZAdjsy+oXTE+yGbcpKoEsCCiy0ORBiU0TPiVRVfrYAACAASURBVD+xcesIiExV56O2p5tWHYGStr8LMP6s495eF3XJc5DFLHrMY/RL/60LV4zL0m+/55Py19anCac0bU83/4Prcyvnz6/uL6qGwQIF3dsxB/e3K5VN0cDbEQSBhhhEPNcySs7B5C1MF1HRKkSnYDWsbvfBXmfDJAWz1t2wS1r6+nrP6N3UizrhD47j0Le/gON3gtuC0JVAIQeATQBGv1LDAE2WgxzSr5IsuV6RI6NywTItr5sdfX09OoGu/ujqb/c9jpAcZjxQOX/+/MIBBgsU9G/L3JY4ODg4XQ/YzQzhJgZwkwC4if5GgJstiJjbaZ3ZjsttNWZ6lvxLBB6Y/JUXsqiAWnZ0PACmA9XBjJ5tP9G/uK/0K2GO7r4uCmPBxg/AaiwLdzSbKpyQCGMod3NMHBP/HedzzuUAqSz9Snk2gWEOkH7pv5PlTec7WT7Zn+R9Xf/ivsbjS/Y/eX/Q+ENwqzcukIbBAoVR3845fX5vD9fD8PCmEOEmAAIP7GZgeCMAXM+AXYuIUW7hOR2g7fZUJBD7LJyocdNwy2Qjoz6v63RP7olkLghdBZr7o/Z/1Od13ePO5yEU92Lko8CaTUZ/0++II1fAMaorrr9nejXtjfq8bgzJ+ocbv1O9cKFIVNVz7fSYygTrBGzvz5cEENHZ369fG0DwTAzxekS8Hhhcj8jkLyA+02bXnK85nUpvdVEDU+mUQaOmwMC0vEFXplI0OR4Bv57P5b6/0Wj03Tfy+TzSPfqVGoPo7+PKT2VMBo2ajmdQecaatQsXLswtYLBAweDFsUXbEiiXyxuNRnh9yPi1DMQ1COwaALwGBbuG0S+waxiDsxjrca3wlkYCytDQqeiPl5mE8j91KseE8aEn/DKZ/HK0KA1dVIaWlHrOxs8d/j2Ci9+IX+QC5KEODaBfuuK/6VddGuME0TUV5IPqiv+m336XtnyivXoDoJAHoN8+9ev7P/iT1T/fO37murWrxeLhHXOmYbBAYWmW78kPlDgiDg4aF0MWPJuh8yYA8RIhoASIBaGWhTxgWBAo/7amjslP0Rhb7EgeFbeS2Bh7oxS6kw0mvRj0G3P3cPTlBwMLXRSFNhlDUrpzPH7GeBM5e3Geu5UWENBu3AkBJMoXCnmo1xtAvwpodOOGpBeDfmPubk9ffjCw6O2fAkVpjJ8xt7a5WTycF5OEBQpjXCpt1d0SODrCs5z79yHCy5J5RpCBiwh5RFEQIiwAsLwQWBAoCgzo33E9FOKClekcSYAcG5mKbKDLPK6/N65gYN7ikd0jde0lZT+4vB6o6OZS1x/dfV39w4+Hc/7fhCO+q/uJwRoD/Uat65/OXVJ3X1d/8r5pfaOPf140DBYomL5LtvzIEqjVateGofs2AHieQWW81mjcL1CsGzxji05RApKRvysMwlD1n7Jqfvwbd0LYmv5r+zNL43f4G4FnHxoc5zBYg5A0LWiBxIgaC+P2tN+KIZDQ9L9z/K6br325CDNrkrBAQfty2ALjkkC9Xr9eCOdeIYh1Un/5YXhD02u+QV/SlpgVCSiK57g36Z7AezfawaYLnamgp76etMyGQKdnEuZz/IDwOxjit42+8Y5+Au8UaS/QGGy66LFtJHwieuqLzCJkHpGXrnzkr9H20TDTWFD7DTeobRZnzyRhgcKsrKhL3A/SMASBey9j8GJd6vO613xzGIY2A+ccvS/KW6Fzk+ybGqCHoEkxODGVT4EuHVGCZmPu3aaThE86jUDUl1ZuC51zpqa8DkjMwPg5Y1UQ7HVCiK2WY2DkU9DDhNBzgo4cCY8r3zN+M2dE/SfQXV/SV7LX+VKnEdGMJ8XxMzdf2yzCzPgwWKCgf9tsiQlJoFLBCwDhGxEF+TDwfs0i4Jlao/E2y/MwoUlJsZmke+P4T/C6zuts/Lr73fVrTQmJ7szD+DlnPySc7K+qrg+mSNKaEhLjH/8JXjf/OlOC7n53/eMYP2vMhtOjBQq6d8nen7gEjo7wHOfhGxiDu4UQ2WQHvCC4yfO91068Y7bBkSQggUJ8CB+qJkNVfY+pIHGiNzyhm27kPUMy9THQaRgSthN9/0YbPwf+30VGfHsr/FGjiu/pvqmPgU7DkAAqeqCR0ABowiWTzevr7wjV6Pc+pzj+WjOoP3uKxE0WKAy1YNlC05DA1tbWarF46pVCsNcwxk519qHheS8NwmAo34Zp9N222SuBtr9Cf14F0xO5Tsa6+nT3dfWPnsuiG0mM3h8zDceg9hhjDwN33oE8qBwvB1PVfro+Crr50Z3wdfd19Sd5IvSmjdHHX2s268+eAnGTBQr6t8GWmLIEiCmyVvNfhMhehyhppuXV8BpfHYTi+il3zzZvIAET58Ze50OdzV9jKtCd8CcdpdDjdDGqz0M64+fAnsaQvQPz4krLAVD68mkIloxP0KaETDqfB9P6EhoBgygFeuV7fBwmOH7eDOqTpIa2QMFgkbNFpy+BRqPxLM/jX8UYvJAxyNYazdeHInzG9HtmezC8BPqQMQ3xsF7VnsjSpK2ze2M1dnbUbPRj1xBoojK0w++T3RMYu+ICf4/rul/UOvtpmBe1wELfwa4SI5sCetoz1YgkKxhdQ2Aign7j59ydCGCwQMFkpmzZmZEAJbXKZoO7AcQ9tUbz/lAISm5lrzmRAC08AhJRB7oTv+HY0t6oe8IuRvV5mLHxMwZPOjnnHwZh+GR/UY8WlaAFDsYn8sEvhLY9w/eph5J6VJ+HZDjlCOPnzWZ9nLkkLFAwflnsA7MkAcol0WzCLeVq5V8HYfi6Weqb7ctgCSSdG5Mbe/LpnrTUhhu1LvfCtIHFNMfPODy4ksl+Y1V428fnbjB9o82ARXJjT7bWQ/FsuFHrck9MG1ikMf5xAQYLFEzffVt+ZiWwtXv0zwHx/eTTMLOdtB3rkkA7gdTogtFvtIYajFF9FnqGZBZuaSqRk46fM/5bDrDv892w0emTYExQNCLhkOl4k+X1G61hroZRfRZ6BmQWbmkqj26mx6BeLKaX3toCBdPZsOVnWgJXrh7djaH4zwhww0x31HauJYEW/ZJWQ2C40fZs9IOdIY2ZHhNzqNNIaOuf8Pg5Zz4H/sHACX6RhmLMdJgYv+5Erq1fqyEw3GgNCZC0/RuRR0Jb/xjGz0tuvby1dXjzzTc3R1lyLFAYRXr22ZmUAPkveOHRLyDiu2ayg7ZTfbUKuo02KTbT8sZiNwQaOopoXfum4zEt39k+A/Yl1+Xf6bPwb4/tl+FGq9NA6MavAxo6DYLe+VLXg8T9BRo/d0cDDBYoGL47tvj8SGBr++ibgIkPIUJpfnq9rD2NIiEGETJpnR0TGgfNCX2UjZZmSf/8iOGKyVchhfFzxn0E/CXM8f+rEGbq8eZKTZlutPqNfcRwxeT4tc5+o/lELMP4edOtl8vmGgYLFJZ1XV6ScW9XKpthPfwgIH7dkgx5bofZ46yoYyJMRg0YmgJ0UQyMMSDeB/qlqydNtnbjTnQoUb63/sFJrfTApLu9Hp8FDn+dcfPv87D+iCo5eGMtFPJACZHoty+Q0G7cg0/ovfUPTuqkBybd7enLL+/4TTUMFijM7bJqO24igSt7R1+JgfhXCMNlqjSp25ZNRwK9jo06nwTdfdN+mdZnSDGtATa9vdX1R3df1cgY3wMufgI5/JfBEjH0ARg7j4KuP7r7pvNvWt+4eRR0/dHd14+/eurU1s2Maf0XLFDQy9KWWBAJUDTE9tWjbxUC3g+AZxdkWAs3jBYd04gn9iQfkumJ3HzjHqxBMO7PiONnnDdBwK/xTPgzIWOH+hO27lUy3JhGjRoYUWMxelropDwWZ/xhiMHZs4Udxpinm3UJNocpZMtYCSySBHZ2sBSyw3+Mgn0vAJ5bpLEtxFiiDbJH1Z8YnDaKIOldaBruqGE+NAce6Wogjhs/MN4ExI8Ah3+NTvaKyvrYQVdMGzBdieQEpsyH5sAj3RO4NoogGaVgClw0SbDmdfys0ahtbm5eZYyJYdcLCxSGlZQtt3AS2EJcxd3ytzPE70PA8ws3wHkeEEUyCiS9OQA5JcbHmhGyTxpTNI8c9aDLTZGcIDNnzJ6nGW8AAgGEn0dHXDFPWpSocWSvf11uBs2JXRsuqHvBR6RoXsDxB0F+b2ODlXWS6/dmmj5jy1sJLJQEEHHlyu7RtyLg9wDCdQs1uDkdTCt5VAcwMD/B6wavs/Hr7nfXb9o/09wVx9XPAGrI4SOZDPs3nhDbulG37+tU6br73S2ZnrDHr8HQSUI3Pt39+Rl/GIbBdWfPDm1qsEBB9+7Y+0srAeXDUL4PUXw7gMxUaTVuU30bYm+FeBo0aZl7TAWJE72W0Eiz8ZsmYTL1MeiR9WCg4jD+MDL41QzLf4xzUYkjFOhXXhStEJ/K6b8NT+imG3lP9019DHoqMDRV9JgK7PhpzovFU9VSCfZMTA0WKEx14bONz4sEdnaObgkBvw0A34sIp+al34vYz5PlmtTzHJhqAHpl272R600bo/soMM49BvA7nOF/DDj+zaD51p3wdff175Kpat9w49dSQg/uoW58uvvzPv485jAMq/sbGxvGpgYLFPSzb0tYCbQkIM0SO+V3AxNfB8DuQURuxTNZCUgzBF2xv0LEa0DMBt3MAyMSHJk6O46c/XH4/jLGHgfOP+qI8CNBJr+nBEKag3jzpf8ekeDI1Nlv5OyHpv3V+TyY1tfh4Ck1Lh0OnlIj031fCyyMNSim/R1+/BTVcHi2sHPHkFENui/aqlZ1ErL3rQQiCezsVK8JIXgXArwHEF9iBTM5CXRGQJAmgK6YDKkNJCQrkkEsl6lGoN85q7NBjWnEkEeB0j4DsN8CZL+FGfF3I5sCeqbLVCOQrGDKGgJNVIL+7VzM8TNmHtWgk5UFCjoJ2ftWAn0ksH14eBN68B4B8G5AvN0KacwSQARTj5HRTQsaYDCqz0MfjQTn7GkA+G0HxG/5LvtcVzZHQxFrT8CG9emYHJMn8GT12v4Yn8gHD0Db3oKNHxExc/r03nnGKsZD0zxggULaErX1LZ0EtrcPbxYM3gSAb0Jg9wBidumEMIEB91A8G27UPZTNI1JE64c8XLgj4+wLCPAJh/GPh074AG1w/a7kPmrqnKgzTUx7Y9WniU5QPBs6Zy7y+Cmq4fBwa+eOO+4YikBJ/+52l7BAwVRitryVwAAJbCMW8Wr59YjiTQDsXkS8aAWWrgSOc27syW2QaNY4V8OoPgs9w46AA+MHnLE/RRR/DCz7CXSaV9KQkH6jbbRSScv2dCf4UW32PYMyCzc0lcmyjr/oONVSqTRSVINO1hYo6CRk71sJnFACFF65c1B9vgjC1wDgPYjslZY6+oTCjB5T/Ar9wyV7ajYkTDJmekw0eCzPAWMBAHyWAfvjkIV/XHDynyFvCnMNgeFGa0gYZMx0mBi/TiOhrV+rIbDjbzuwko9OHTPB6b3z59M3NSS/JQsURlu37NNWAkNLgIDDlf3Kc5kQ9yDCqwDhHgTcHLoCW7Algb7OjYbOglpxGgKNtiMlO+AIDyCHT4kQPpVd4Z/xwzAiNzi+Vd1Gm3zStLx2vMkChkBDq6HQdMB0PKblF2n8mWzWv/L447vjMjVYoGD8ttgHrATGJwHyb0AOL0OEFyPAixniCxGgOL4WF6PmfsyNurTRxkmZNKKS0RcMkDP+KCI+gICfyjDnU54TPKYeNQ1/S4TraTfuZPnBaZONw/1G3tjt+Ds1AD3hrDrTz7Hz71QvXhyvqcEChcVYJ+0oFlQCxNNw9WqZyJ7utOBBM8mRGWJYn4XeJFODnQ0ZY60QTOoJY1ABZF8ADg8BhJ9nkHlIMPgCNgPlZZ6Iu+/pfWJjKBTyELMpUtkeU0SCJ8H0BK0vPxhY9PbP0MdBA3Ts+M3mnwiUgqCyd/78+dSjGnTLqTU96CRk71sJTFkCZLLY368/w0f/NhRwGwDehgC3AjL6e2PK3Ztq8wokDOmzoO2pAg6MOQ0EfJIhPsId/hCC+DzLZB8Kw+ZT3VWMm0dAZ5PX3dcOOFHAtD47/kEaAz1Q081PW76ZQPjnzq1QrgZf99Q47lugMA6p2jqtBCYkgaOjo7ONAG4TIdwKDG4ExOsR4XpgeAMDds2iM0kqzsaIudEgSoExdiAAv+ww/mXk+GVEfAJCeIJx9mXhiK3+02e4kY4aNXBi1XTUe1NmQe07a8c/0JSg0aAYm35a8+9UP/zh0t6P/MjwaaG1U2lYwAIFQ4HZ4lYC8yIB4l+5cti4Dv3geocRgMAbEPBaAHYeECit9nlgeB4RSvMypr79bJkgADjjTQTYAWDbwMIdAL7NEXcEY9tMwA53nS3h4ZNC+EfahVvD/Gd+Ykz3BK6NIkhSPJsCFzt+iM0j8r0bGXiZzX9NRjUEUzE1JL8zCxTmeoW0nbcSGF0CiJjf36+fD0PvPCI7H3J2niOcAcCSACwxICDBCEyUEJB+1xiq/waGK4jgMsYyiOiepDeU1Q4RfAboIwMfkAXAsMGAHQHCIQIcMQaHAHiEAIcc2BHSv3N2xAEOBbKDLBd1lnOqDd8/avdhRIrekb3+ddz8SWmZOSPqZW3H36kBSLqQ1HVJp6Y4/9M2NVigoP+6bAkrASuBE0qAUnUDQGYHwM0cgOu6lUyjwV3OmSsEhvm88IOg6DdPgX8BgOytwSjpb+Nukh/H7u7upu+6BqyYOlW67n63kEw1DKa5G0zr10+hbny6+3b8nRIwnZ/j53+/+uEPX5yqqcECBf3XY0tYCVgJzKEESKOxt1e/2Gw2VYbPQuJEryX00Wx8pkmITH0MemRupqqOIyjo145//uafcjU4p09f3WSsOmufnzU9zNqM2P5YCVgJnFgCTz75ZMEpFsn/okVXHOdOSKqaTU+AvZ0yVe0bbvw61bhGSrrx6e7rJ8GO38y0cfz8B0HgP+PcualFNejm2gIFnYTsfSsBK4G5ksDeHq43WOOUMcGNqbNfciM31iCYEhLpfB5M60sQNtnxd2edMnVePOH8F51TlVIJKFdDFL4ze5+bBQqzNye2R1YCVgIjSEBSZVcqGyIIaKkfcJmeiJNVTVlDYGoK0Zg2jJ39NMyTo2ssUjYFzdj4Z9nUkBSVBQojLEj2USsBK4HZlMBHP/pR581vvn/zoHngHmd6MO/5aFEJ2o3T+EQ6eATa9owFYMffxaMwgs9LMGUCJdOpt0DBVGK2vJWAlcBcSAARs5cPDjrSfE9WA9CT60GzsejTJHdrxsFwo9Llnpg2sFiW8YuqX7n2WpmrYWZNDVajMBdLnO2klYCVQBoSQMTiwUHjLNXVEzevO8GParPXqLp7fChGHLB+ozXM1WDHP5rPQmI+EXPoeEdXNzc3Zy6qQffqWY2CTkL2vpWAlcBcS+Cpp47Och4We8IltUmXEif4JNNhQiq6E7mWSVGrITDjNehN+zzYGVLbPzv+joygvZ/EoPmf9agG3QdugYJOQva+lYCVwFxLQJIx1WqbvucZkDH1SeeY5GUwpEjWCVEHNJLPm5bXtd9zf2RmQk3abEOgNa/jF0Wncm1pvkwN1vRg/LXYB6wErATmXQKSjKlev9g8aHLJ2T8Ez4JuzPqNesRwxWQHdKaSZBSCoU+EltLYeGNf7vHPs6nBAgXd12/vWwlYCSykBBCxcHDQOE8boroGe/HHCYHoly5jHwfNRt9b/2BThx6YdDeoL2/HPyiKYZT5z2Sz3pcfemj3zjvvnEpa6LQ/YGt6SFuitj4rASuBmZXA/v7+qTrAev8OGvoAjJ1HQNcf3X3TaTCtb9xRJLr+6O5PZ/zC8efe1GA1Cqbvji1vJWAlsDASIH+FarV63vedvKmqXRde2COkUaMGtKaGRIujtqedZcONedT+zNn4JYGS581lVINu6q1GQSche99KwEpgoSRA6/nTT+9d5KvcaUUG9PNZ0DAf6lX7SbGlewI3jlIw3bjt+CE2P8iZHEDpnM0K76EFMjVYjcJCLXl2MFYCVgInkQAi5i4fHGzGm23fOkb2+tflZtAACW24pG7kI1JU2/EneBT6z+cq98pra2v780SgpHtzLFAwlZAtbyVgJbCQEtjZ2Sn5rntGmRToIifHeHOl/zZTtZtqGHrKp36C102bbny6+931L9v4ydTATp/evYaxmk7S837fmh7mfQZt/60ErAROLIFLl47OQSFc7VeB6UbeU4epjb2nAkNTRQ/QSJyADTUUdvz5VqQLTU29Q76ZTOCdU2mhgxO/fHP0oAUKczRZtqtWAlYC6UrgRxD5P96tbbouz4zq3KjPvmi48SfTWBsOXXfC193XN2dq2liM8a9yvvCmhuTcW6Cg/xpsCSsBK4EFlsAnETMX9/cvsgZjLYc1Gu8A5zV5wkxu5P9/e2eznLaSxXFJCAsBsQEbGzzJTJKpzGIWs52q2eUl8gCznZe4zzMvcJeputvJ0lllkXvLN8Y3fFjGMSAD6qnGxh8tzPGxQEjqP5tUSq3uPr8juY/6fDR7B4FbkIiKeeD2p1RO5AY7aiZ/xXECz/O6h4eHmXc1wFDI8B88iAYCIPA8Aicnoui6o/p8rVxoCER1Dax6h4CIaaBJcHcE1B43vEMQo/xXk8nVXzRyNcBQoN8etAABENCQwG+eV80Lsf246MsrGao7EGo/5FY/e0diuZLI8dg61lP+qWVdvMx4VgP1KMD1QBHCdRAAAS0IyCD2X9vtg0r+hfO0HQUKC29hpY+JVko8M4MTqSyOTRsWSZM/cETge2738DD7WQ3UkwxDgSKE6yAAAtoQkMWYer1e07fuFWOSX/ryx41ZYLoqokKmF9qR8aBuBLWDETVmIcXy6+5qgOsh6tuI+0EABDJNQBZj8rxRQ10nw3UWHmKgvsjJSorkDgGvrsFt1clbQ2d5MCQ5v1CdiWzKr2NWA/VCY0eBIoTrIAAC2hH40u1ul3yr+jALgsg6oL7QCYqUoaHezm3PVmLkyoxKVkXC5XeCIPB9X8usBurZgKFAEcJ1EAABLQm0Wq26KBSKjwlPL9QR0xXVgUlDJFpMBLeORJbkz+cLfqlkdHQpoMR9oWEocImhPQiAgBYEhBBW56YYkxQ4ct0EZaGfHzgk/73uXwlWVLb66YWZ5woIBTcqro/w/JgxDoShkxT5pz+si5cvs31WQ9QXFoZCVIK4HwRAILMEhBD5E1mMyTQX/K1cdx0BKiaBus5VC7e/dMsvgiA4rNXkLsI8ioMLTJv2MBS0UTUEBQEQeA6B09PTUuA4e1R6YajvqFkDpKtBGTHqeCQcpiERdT5rlB+uBlLZDxrAUODxQmsQAAENCRwfH9dy5fKLW//AzE2gHBpEVl5c7Rc4O0uBu3Cv/DTLZMhfNM3+zs6Ol+VjoVf9isJQWDVR9AcCIJA5ArIYU/vy8mDSHzvGTUxBKF2SmyUQosQLRqQhRyzRzJWH2z5m+Z1ABLWaC1cD/eCEWsBQeAY03AICIKAfgY8fP9p/+8c/m6blW4uk5+4wcI9x5vZPa4hyJVDXH47AnV+c8tv5vP+5VOq81+RYaFr3vBYwFHi80BoEQEBjAkKIQqvlHcwQqOdKq1y4PnbqC5vKggi5CpS6D2RBJ2Lh5x7ClBD5x0Wz/2e4GiK9tTAUIuHDzSAAAroR6Ha7275lVdXgRtVuCNclWK2PnuJOfeFT16n+ky6/EzjBoOZ2XiGrgVYl0QKGQmSE6AAEQEA3AhcXon4x8YqssxOYOwbcEsxkVgb1hc8NdlSDN6n+Y5TfHk/9z5//13n//v1Et2dzHfLCUFgHVfQJAiCQaQKyGNPv3WEzl/Pt6wVa/kbG3WL9nKyI5ci4Pn1aARGDHWdyz2VOjvxwNdCa57aAocAlhvYgAAIgYBjG0dHRVvXwbcMc+dd/R4mYBXKrn/1FzjQsyPRNSq3RsjLWLb8soBQMBp1Xr16hgBKlSuZ1GApMYGgOAiAAAnMCp0KUAs/bW0yEt7DSx0QrJZ6ZwYmUa4JcyNlqj09+3x/7v/76Ga4Gto6edgMMhadxQisQAAEQWEjg/FzUgmD0gj5UiZduyMVNGxrMsxqixiyEBFiP/GMTWQ3cZ4XbHoYClxjagwAIgMA9ArIY02+dTmPHLm/NjQV5WTUcyEqK5A4Bc6FlFkAi56fEYKgPAbUjQfbPlF8EA7gaYnoTYSjEBBrDgAAIZJeAEMI+Oek1zaJlzbIV5I+qs6DgoBZa7sIcmTbT0Ahnadw7EvMJk+HI74/H/ut6vW2a5vQJXaNJRAIwFCICxO0gAAIgIAkcHx+75fLevtxJuP4ROwDc4EWyfbSYANp18lDP9MK+HvldwzivVCrnOKshvvcOhkJ8rDESCIBAxgn0er2dkWlWFoqpLPSuWzCGN9UOZXvVDoiabsleyJWt//D8mDEOKoSI8s8KKA26yGrYwDsEQ2ED0DEkCIBANgnIeIU/fvyoB5OJSy/UFAMqJoG6TvWvXuf2t+46Cnf95/KF0X7JkAc6wdXAVesK2sNQWAFEdAECIAACcwKyGFN3OGxeeb59G6cgLyoxC6QhQboaFOYrz1KIaEhEnc/N/XA1bP7dgqGweR1gBiAAAhkjIITYOjs7a4xM897f2NV+gZNZBGqWAnfhJg6BIg2dkE558geOmNbc2bHQ86CPjD0l6REHhkJ6dIWZggAIpIjA9++iPJl4u4a7uMRzWBReMCKNImKJ5shZD8rplUR65f3gz1x+OtovleBqoJUcSwsYCrFgxiAgAAI6Euj3+7s/ptPyItm5Zzfwv+Ap4lRMAnX9Yf/c+T0mv+eNzl+/RlYDpb04r8NQiJM2xgIBENCKgAxu7HQGjfH4aotbV4FKr6QNDeWLnixoRCz8hCsipFhmjIXjONO+63bewNWQuHcEhkLiVIIJgQAIZImALMbU6/WavlW0NnraonIoFHcHgHKVqPWlwnUZHt+hyOXzcDUk+KGHoZBg5WBqIAAC2SBwLISb87z9h9JwEBFk4gAABjNJREFUCxJRPn9uf0rlRG6wo3oaJXMHYb5j4hvG+WsUUEr0gw5DIdHqweRAAASyQuDr2VmlYhR27io38iSjXQ28ksmqa4PeEVDny8tiUHcYnCCY9ms1uBp4j8FGWsNQ2Ah2DAoCIKAbARmv8P379/2tre1ZGkRoa579Rb6cYHTXAmEYRIh5uLqajvb3kdWQlncAhkJaNIV5ggAIpJ7Af4XI/etbr2lZVo4qwKQKGyrxzFyo2cGRqmuBTX9xumdBDL1qtdrHWQ1soBu7AYbCxtBjYBAAAR0JfPnyxSntvWyoZzlEZaHuIIQNDeZZDVFjFpQJBIEzHff/6Lx58wYFlKIqO+b7YSjEDBzDgQAIgEC73X4xtsu1eVzAjAi5Q8CraxA+9nl5MCS70qOixmWujtHV1ejN/j4KKKX00YehkFLFYdogAALpJnDS7+8Z02lpLgU3poDbnk0rcmXG6+DKQkHA1cCGn6wbYCgkSx+YDQiAgCYEfvpJWP/+T6dhj+38TGQ17SDsO7hrs7A9rwR0VEODuh+uhuw8yDAUsqNLSAICIJAyAp8+fcq/ffv3pmmaZihYUTkbgVqYVdHp9ssNC9ctGMObaowzzwijboJl28ODcrmLY6FT9kA+Ml0YCtnQI6QAARBIKYGTk5Oi4br18PSpmATqOhcIt7/F7Ydi6L1FVgMXfqLbw1BItHowORAAAR0IeJ5XHQixPd8FmMnMrauw4iwFruESBMH0T7Va2zRNXwed6SQjDAWdtA1ZQQAEEklAFmO6vDT2+2OvII2FhVv9yszZWQpcQ4I4BOr++LY9Gf5cLnc/mOY0kYAxqUgEYChEwoebQQAEQGA1BIQQuW89WYypmLu2FEaG4d6kNMr/U8GOoWk8dA2wSzQ/MesBrobV6D/JvcBQSLJ2MDcQAAGtCAghnFbLa8yEVlZ2OjiRi4qKSVh+Ha4GLu/0toehkF7dYeYgAAIZJPCl290uWVaVXXI55CpQCiwxdyiWHUJlWfbwl19+7n748AGuhgw+g6pIMBQ0UDJEBAEQSBeBVuuiLgqT4oPgRqYI1A4Edf2x4ZwgONvd3e0zp4PmKSYAQyHFysPUQQAEsklACGF1Op3G2Lbzs+yHmStieQlmageCzKIggh2dwJn2am77HbIasvnQLZEKhoJ2KofAIAACaSAghMifnJ3NijHN7ASjcFv0SP5/XgxJ/nttSNxLqXySgE8PdrR8f3hwcCDPagie1DUaZYoADIVMqRPCgAAIZImAEKLY8rwFxZhoKZ/rWlB7hquBZp31FjAUsq5hyAcCIJBqAp4nqkKMtkMlnpnBiZRrQjUspo6Y7Lqu3EVAAaVUP0HRJw9DITpD9AACIAACayMgizG12+2DST7vLBtEXejVtpyzGga+P/wrXA1r02naOoahkDaNYb4gAALaEZDFmHpDo+n7Xu56Z0D+ZGzCPM5gAZInFky67ucuBgKuBu0eL1JgGAokIjQAARAAgc0T+Pr1a8GpVA7mM1lVDMK8vy3HmZx9+9Z59+4dXA2bV3eiZgBDIVHqwGRAAARA4HEC3W532/dlMaZFWQ7Lj41eVunRtguDctmQx0IjqwEPYIgADAU8FCAAAiCQIgIXFxf1ycQuhmIOFBnoHYdrw+IyCM7eoYBSip6A+KcKQyF+5hgRBEAABJ5NQBZj+r3bbeZyJfsuTkF2R8QsKCPC1fBsFWh3IwwF7VQOgUEABNJO4OjoaKt6eNiYF2OaycM4Rtq2J4NyuQxXQ9ofhJjmD0MhJtAYBgRAAARWSUAIUWp53p50MSyyE0I7DDeGRH5S6dXr5sUq54K+sk0AhkK29QvpQAAEMkzg+Py8lguCF4tFfBjcuDUVk91dt22a5lWGkUC0NRCAobAGqOgSBEAABOIgMCvGdHl5MBmPlxZjMm170ICrIQ6VZHIMGAqZVCuEAgEQ0IWAEMLu9YZN3/ct1y3MDoua/W5Om8zn4WrQ5VlYl5wwFNZFFv2CAAiAQEwEhBCFlufdFmOSw25NHbgaYuKf9WFgKGRdw5APBEBACwK9Xm9nZJoVWdbZHE0GjQayGrRQfAxCwlCIATKGAAEQAIF1E5DxCqenp3u2bY/q9TqyGtYNXKP+/w8iikqoDye7bwAAAABJRU5ErkJggg==" alt="">
                                    <p data-v-e5ca3ba2="" class="text">No More yet!</p>
                                </div>

                                <!---->
                                <div class="van-list__finished-text" bis_skin_checked="1"> </div>
                                <!---->
                                <div class="van-list__placeholder" bis_skin_checked="1"></div>
                            </div>
                        </div>
                    </div>
                    <div data-v-5bc6443d="" id="van-tab-20" role="tabpanel" class="van-tab__panel" tabindex="-1"
                        aria-labelledby="van-tabs-18-1" style="display: none;" bis_skin_checked="1">
                        <!---->
                    </div>
                    <div data-v-5bc6443d="" id="van-tab-21" role="tabpanel" class="van-tab__panel" tabindex="-1"
                        aria-labelledby="van-tabs-18-2" style="display: none;" bis_skin_checked="1">
                        <!---->
                    </div>
                </div>
            </div>
            <!---->
            <!---->
        </div>
        <!---->
    </div>
    <script>
        window.fbAsyncInit = function() {
        FB.init({
          appId            : '448726619988568',
          autoLogAppEvents : true,
          xfbml            : true,
          version          : 'v14.0'
        });
      };
    </script>
</body>
  @include('preloader')
</html>