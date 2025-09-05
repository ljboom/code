<html lang="">
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/content/location/location.js"
    id="eppiocemhmnlbhjplcgkofciiegomcon"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/extend-native-history-api.js"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/requests.js"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">

    <title>|Claim Record</title>

    <link href="{{asset ('dash2/p/chunk-vendors.317e4ea8.css')}}" rel="stylesheet">
    <link href="{{asset ('dash2/p/app.1af1dbde.css')}}" rel="stylesheet">

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

.records[data-v-174a5047] {
    min-height: 100vh;
    background: #f7f6f3;
    overflow: hidden;
    position: relative;
    z-index: 1
}

.records[data-v-174a5047]:after {
    content: "";
    width: 100%;
    height: 17.6rem;
    position: absolute;
    top: 0;
    left: 0;
    background: url() no-repeat top/100% auto
}

.records .wire[data-v-174a5047] {
    width: 69.4rem;
    height: .1rem;
    background: #cecece;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 24rem;
    z-index: 111
}

.records .select[data-v-174a5047] {
    width: 65rem;
    margin-top: 1rem;
    margin-bottom: 3rem;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 15rem;
    z-index: 111
}

.records .select .tilese[data-v-174a5047] {
    font-size: 2.8rem;
    font-family: HelveticaNeue;
    color: #fff
}

.records .select .search[data-v-174a5047] {
    width: 36.5rem;
    height: 5.6rem;
    background: #ededed;
    border-radius: .6rem
}

.records .select .search .left[data-v-174a5047] {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center
}

.records .select .search .left .datai[data-v-174a5047] {
    font-size: 2.4rem;
    color: #777;
    margin-right: 1rem;
    font-weight: 500
}

.records .select .search .left .dataimg[data-v-174a5047] {
    width: 2.8rem;
    height: 2.8rem
}

.records .select .search .btnsear[data-v-174a5047] {
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

.records .listrecore .listpro .toptitle[data-v-174a5047] {
    display: flex;
    align-items: center;
    margin-bottom: 2rem
}

.records .listrecore .listpro .toptitle span[data-v-174a5047] {
    width: 2rem;
    height: 2rem;
    background: #777;
    border-radius: 50%;
    margin-right: 2rem
}

.records .listrecore .listpro .toptitle p[data-v-174a5047] {
    font-size: 3.2rem;
    font-weight: 400;
    color: #333841
}

.records .listrecore .listpro .contit[data-v-174a5047] {
    display: flex;
    align-items: center;
    width: 68.4rem;
    height: 15rem;
    border-radius: 1.2rem;
    margin: 0 auto;
    margin-bottom: 3rem;
    background: #fff
}

.records .listrecore .listpro .contit .imgleft[data-v-174a5047] {
    display: block;
    width: 10.5rem;
    height: auto;
    margin-left: 1rem;
    margin-right: 3rem;
    border-radius: .8rem;
    border: .5rem solid #fff
}

.records .listrecore .listpro .contit .rightname[data-v-174a5047] {
    flex: 1;
    padding-right: 2rem
}

.records .listrecore .listpro .contit .rightname .leftname[data-v-174a5047] {
    text-align: left
}

.records .listrecore .listpro .contit .rightname .leftname p[data-v-174a5047] {
    font-size: 2.8rem;
    color: 0;
    font-weight: 700;
    margin-bottom: 1rem
}

.records .listrecore .listpro .contit .rightname .leftname span[data-v-174a5047] {
    font-size: 2.4rem;
    font-weight: 700;
    color: #999
}

.records .listrecore .listpro .contit .rightname .amount[data-v-174a5047] {
    font-size: 3.4rem;
    font-weight: 700
}

[data-v-174a5047] .nav-box {
    overflow: hidden;
    width: 75rem;
    height: 15rem;
    background: none;
    padding-top: 5rem
}

[data-v-174a5047] .nav-box .van-nav-bar__content .van-nav-bar__left img {
    width: 2.6rem;
    height: 3rem
}

[data-v-174a5047] .nav-box .van-nav-bar__content .van-nav-bar__left i {
    color: #000;
    font-size: 4rem
}

[data-v-174a5047] .nav-box .van-nav-bar__content .van-nav-bar__title {
    max-width: 80%;
    padding: .5rem 0
}

[data-v-174a5047] .nav-box .van-nav-bar__content .van-nav-bar__title p {
    font-size: 3.6rem;
    font-weight: 500;
    color: #000
}

[data-v-174a5047] .nav-box:after {
    display: none
}

[data-v-174a5047] .selectuis .van-picker__toolbar {
    padding: 0 4rem
}

[data-v-174a5047] .selectuis .van-picker__cancel {
    width: 15rem;
    height: 5rem;
    border-radius: .8rem;
    border: .2rem solid #0091ff;
    color: #0091ff;
    font-weight: 500
}

[data-v-174a5047] .selectuis .van-picker__confirm {
    width: 15rem;
    height: 5rem;
    background: #0091ff;
    border-radius: .8rem;
    color: #fff;
    font-weight: 500
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
        <div data-v-174a5047="" style="background-image: linear-gradient(#5eeca4, #f0d951);" class="records" bis_skin_checked="1">
            <div data-v-174a5047="" class="wrap" bis_skin_checked="1">
                <div data-v-174a5047="" class="van-nav-bar van-hairline--bottom nav-box" bis_skin_checked="1">
                    <div class="van-nav-bar__content" bis_skin_checked="1">
                        <div class="van-nav-bar__left van-haptics-feedback" bis_skin_checked="1">
                            <i onclick="window.location.href='{{route ('ordered')}}'" class="van-badge__wrapper van-icon van-icon-arrow-left van-nav-bar__arrow"><!----><!----><!----></i>
                            <!---->
                        </div>
                        <div class="van-nav-bar__title van-ellipsis" bis_skin_checked="1">
                            <p data-v-174a5047="">PROJECT INCOME RECORDS</p>
                        </div>
                        <!---->
                    </div>
                </div>
            </div>

<style>
.bottom[data-v-23fa9203] {
    width: 100%;
    position: fixed;
    left: 0;
    bottom: 0;
    z-index: 2;
    height: 13rem;
    background: #fff;
    box-shadow: 0 -.2rem .4rem 0 rgba(0, 0, 0, .1)
}

.bottom .flex-bom[data-v-23fa9203] {
    height: 11.6rem;
    justify-content: space-around !important
}

.item[data-v-23fa9203] {
    flex: 1;
    color: hsla(0, 0%, 100%, .35);
    flex-wrap: wrap;
    flex-direction: column;
    justify-content: center;
    position: relative
}

.item .img-box[data-v-23fa9203],
.item[data-v-23fa9203] {
    display: flex;
    align-items: center
}

.item .img-box .imgc[data-v-23fa9203] {
    width: 4.8rem;
    height: 4.8rem
}

.item .img-box .invest[data-v-23fa9203] {
    width: 7.5rem;
    height: 7.5rem;
    margin-top: -3rem
}

.item .img-box .ballactive[data-v-23fa9203] {
    animation: kserr-23fa9203 1s linear
}

@keyframes kserr-23fa9203 {
    0% {
        transform: translate(-50%, -64%) rotate(0deg)
    }

    to {
        transform: translate(-50%, -64%) rotate(2turn)
    }
}

.item .item-pone[data-v-23fa9203] {
    margin-top: 1rem;
    font-size: 2.4rem;
    color: #666
}

.item .item-color[data-v-23fa9203] {
    color: #ffa400;
    font-weight: 700
}

.img-wrap[data-v-23fa9203] {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10rem;
    position: absolute;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%)
}

img[data-v-23fa9203] {
    width: 3.6rem;
    height: 3.6rem
}

.iconfont[data-v-23fa9203] {
    font-size: 2.4rem;
    margin-bottom: 2rem
}

.active[data-v-23fa9203] {
    font-weight: 600;
    color: #000;
    position: relative;
    z-index: -1
}

.active .img-wrap img[data-v-23fa9203] {
    width: 4.6rem;
    height: 4.6rem
}

.active .iconfont[data-v-23fa9203] {
    color: #333
}

.mine-popup-left[data-v-23fa9203].van-popup {
    width: 81vw;
    padding: 0;
    box-sizing: border-box;
    min-height: 100vh;
    background: #fff
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    height: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
    color: #fff
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup {
    border-radius: 10px;
    width: 94%;
    margin-left: 3%;
    margin-bottom: 10px;
    padding: 25px 15px 15px;
    box-sizing: border-box;
    text-align: left
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .van-icon {
    font-size: 20px;
    color: #2852e5;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 10px;
    background: rgba(40, 82, 229, .05)
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content h3 {
    margin: 0 0 5px;
    font-weight: 900
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content p {
    margin-bottom: 15px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .van-checkbox__icon {
    border-radius: 2px;
    overflow: hidden
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .van-checkbox__label {
    color: #fff;
    font-weight: 700
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-around
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap .confirm {
    background: linear-gradient(90deg, #2852e5, #2852e5)
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap .confirm .van-button__text {
    color: #fff
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap .cancel {
    background: rgba(40, 82, 229, .05)
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap .van-button {
    flex: 0 1 40%;
    height: 40px;
    line-height: 40px;
    border-radius: 6px !important;
    margin-top: 15px !important;
    box-shadow: none !important
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .signout-wrap::v-deep.van-popup .signout-content .btn-wrap .van-button .van-button__text {
    font-size: 16px !important
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head {
    width: 100%;
    margin: 0 auto;
    padding: 35px 15px 15px;
    box-sizing: border-box;
    position: relative;
    z-index: 1
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .recharge-wrap {
    position: absolute;
    top: 35px;
    right: 15px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .recharge-wrap .recharge-item {
    display: flex;
    align-items: center;
    background: #e1f4ff;
    border-radius: 100px;
    padding: 3px 10px;
    font-weight: 600;
    font-size: 14px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .recharge-wrap .recharge-item:nth-of-type(2) {
    margin-top: 10px;
    background: #fff5d5
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .recharge-wrap .recharge-item img {
    width: 27px;
    height: 27px;
    margin-left: 5px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap {
    margin-bottom: 15px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap p {
    font-weight: 700
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap .red {
    position: relative;
    z-index: 1
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap .red:after {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 20px;
    width: 4px;
    height: 4px;
    background: red;
    border-radius: 100%
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap .flex img {
    width: 22px;
    height: 22px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .help-wrap .flex img:nth-of-type(2) {
    margin-left: 10px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text {
    width: 100%;
    margin: 0 auto;
    text-align: center;
    padding: 0;
    margin: 10px 0;
    position: relative;
    justify-content: flex-start !important
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .position-bar {
    position: absolute;
    top: 0;
    right: -3vw;
    padding: 0 10px;
    height: 37px;
    line-height: 37px;
    background: #ffba1c;
    border-radius: 100px 0 0 100px;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .position-bar .van-icon {
    animation: mymoveac-23fa9203 1s infinite
}

@keyframes mymoveac-23fa9203 {
    0% {
        opacity: .1
    }

    50% {
        opacity: 1
    }

    to {
        opacity: .1
    }
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .user-text-logo {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    border-radius: 100px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .user-text-item {
    flex: 1
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .user-text-item p {
    font-size: 14px;
    font-weight: 900;
    line-height: 30px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .user-text-item span {
    font-size: 12px;
    line-height: 19px;
    color: #999
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .head .user-text .user-name {
    font-size: 18px;
    margin: 2px 0
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine {
    width: 100%;
    margin: 15px auto 0
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .after {
    margin-top: 15px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .after:after {
    width: 100%;
    height: 1px;
    transform: scaleY(.5);
    background: hsla(0, 0%, 100%, .5)
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .mymine-box {
    padding: 13px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .mymine-box .mymine-box-div {
    display: flex;
    align-items: center
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .mymine-box .mymine-box-div .mymine-box-p {
    margin-left: 12px;
    font-weight: 500
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .mymine-box .mymine-box-div img {
    width: 22px;
    height: 22px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mymine .mymine-box .van-icon {
    opacity: 0
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .assets-wrap {
    margin-bottom: 20px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .assets-wrap .assets-item {
    flex: 1;
    font-weight: 500
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .assets-wrap .assets-item p {
    font-size: 16px;
    font-weight: 600
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .assets-wrap .assets-item span {
    font-size: 12px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .coupon-card-wrap {
    width: calc(100% - 30px);
    margin: 0 auto;
    height: 65px;
    padding: 10px 15px;
    box-sizing: border-box;
    background: linear-gradient(270deg, #717d91, #424b56);
    border-radius: 10px 10px 0 0;
    margin-bottom: 15px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .coupon-card-wrap img {
    width: 30px;
    height: 30px;
    margin-right: 10px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .coupon-card-wrap .content {
    color: #fff;
    text-align: left;
    font-size: 14px;
    flex: 1
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .coupon-card-wrap .content p {
    font-weight: 500;
    margin-bottom: 5px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .coupon-card-wrap .content span {
    font-size: 12px;
    background: #fff;
    border-radius: 100px;
    padding: 1px 10px;
    color: #424b56
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mine-top-nav {
    padding: 0 15px;
    box-sizing: border-box;
    background: rgba(0, 0, 0, .4)
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mine-top-nav .nav-item {
    flex: 0 1 33%;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, .05);
    border-radius: 8px;
    padding: 10px 5px;
    box-sizing: border-box;
    position: relative;
    text-align: center
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mine-top-nav .nav-item p {
    font-weight: 500;
    font-size: 14px
}

.mine-popup-left[data-v-23fa9203].van-popup .mine-page .mine-top-nav .nav-item img {
    width: 30px;
    height: 30px
}

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

.device[data-v-b2152e56] {
    background: #f7f6f3;
    padding-bottom: 15rem;
    min-height: 100vh;
    padding-top: 5rem;
    overflow: hidden;
    position: relative;
    z-index: 1
}

.device[data-v-b2152e56]:after {
    content: "";
    width: 75rem;
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    background: url() no-repeat top/100% 100%;
    height: 50rem
}

.device .nav-box[data-v-b2152e56] {
    width: 100%;
    padding: 0 3rem;
    height: 6rem;
    overflow: hidden
}

.device .nav-box .dev[data-v-b2152e56] {
    text-align: left;
    font-weight: 400;
    color: #333c40;
    font-size: 4.4rem
}

.device .lease-banner[data-v-b2152e56] {
    height: 29rem;
    width: 69.6rem;
    margin: 3rem auto;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: url() no-repeat top/100% auto
}

.device .lease-banner .accum[data-v-b2152e56] {
    margin-top: 3rem
}

.device .lease-banner .accum .accum-t1[data-v-b2152e56] {
    font-size: 2.4rem;
    color: #444
}

.device .lease-banner .accum .accum-t2[data-v-b2152e56] {
    font-weight: 400;
    font-size: 4.2rem;
    color: #333;
    font-weight: 700;
    margin-top: 1rem
}

.device .existing[data-v-b2152e56] {
    width: 69.4rem;
    border-radius: .8rem;
    margin: 0 auto;
    display: flex;
    margin-top: 5rem;
    align-items: center;
    justify-content: space-around
}

.device .existing .left[data-v-b2152e56] {
    display: flex;
    flex-direction: column
}

.device .existing .left p[data-v-b2152e56] {
    font-size: 2.4rem;
    color: #444
}

.device .existing .left .income[data-v-b2152e56] {
    font-size: 4.2rem;
    font-weight: 700;
    color: #333;
    margin-top: 1rem
}

.device .existing .rightu[data-v-b2152e56] {
    display: flex;
    align-items: center
}

.device .existing .rightu i[data-v-b2152e56] {
    font-size: 4rem;
    color: #ffc108;
    margin-left: 2rem
}

.device .existing .line[data-v-b2152e56] {
    width: .2rem;
    height: 10.5rem;
    background: #cecece
}

.device .section-box[data-v-b2152e56] {
    padding: 0 2.8rem;
    margin-top: 3rem
}

.device .section-box .signin p[data-v-b2152e56] {
    text-align: left;
    text-transform: uppercase;
    font-size: 3.2rem;
    color: #333;
    font-weight: 700
}

.device .section-box .wrap[data-v-b2152e56] {
    width: 100%;
    background: #fff;
    box-shadow: 0 .3rem .6rem 0 rgba(0, 0, 0, .08);
    border-radius: 1.6rem;
    display: flex;
    flex-direction: column;
    margin-top: 3rem;
    padding: 2rem;
    box-sizing: border-box
}

.device .section-box .wrap .wrap-center[data-v-b2152e56] {
    display: flex;
    align-items: center
}

.device .section-box .wrap .wrap-center .wrap-img[data-v-b2152e56] {
    position: relative
}

.device .section-box .wrap .wrap-center .wrap-img .left-img[data-v-b2152e56] {
    width: 8.8rem;
    height: auto;
    border-radius: 1.1rem;
    border: .4rem solid #fff
}

.device .section-box .wrap .wrap-center .listui[data-v-b2152e56] {
    border-radius: 1.4rem;
    padding-left: 3rem;
    flex: 1;
    justify-content: flex-start
}

.device .section-box .wrap .wrap-center .listui .topname[data-v-b2152e56] {
    margin-bottom: 1rem;
    text-align: left
}

.device .section-box .wrap .wrap-center .listui .topname p[data-v-b2152e56] {
    font-size: 2.8rem;
    color: #333;
    font-weight: 700
}

.device .section-box .wrap .wrap-center .listui .topname .rightbtn[data-v-b2152e56] {
    display: flex;
    align-items: center
}

.device .section-box .wrap .wrap-center .listui .topname .rightbtn p[data-v-b2152e56] {
    font-size: 2.6rem
}

.device .section-box .wrap .wrap-center .listui .topname .rightbtn button[data-v-b2152e56] {
    margin-left: 5px;
    width: 14rem;
    height: 5rem;
    background: linear-gradient(90deg, #00c4ff, #0091ff);
    border-radius: .8rem;
    color: #fff;
    font-size: 2.5rem;
    font-weight: 500
}

.device .section-box .wrap .wrap-center .listui .topname .expired[data-v-b2152e56] {
    background: #ededed;
    color: #777
}

.device .section-box .wrap .wrap-center .listui .pric[data-v-b2152e56] {
    display: flex;
    align-items: center;
    justify-content: space-between
}

.device .section-box .wrap .wrap-center .listui .pric .l[data-v-b2152e56] {
    font-size: 2.6rem;
    color: #666
}

.device .section-box .wrap .wrap-center .listui .pric .price[data-v-b2152e56] {
    font-weight: 700;
    font-size: 3.6rem;
    color: #27cf5b
}

.device .section-box .wrap .conttal[data-v-b2152e56] {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 2rem auto
}

.device .section-box .wrap .conttal .right-income[data-v-b2152e56] {
    width: 64.2rem;
    height: 11.5rem;
    border-radius: 1.2rem;
    display: flex;
    background: #f7f7f7;
    align-items: center;
    justify-content: space-between
}

.device .section-box .wrap .conttal .right-income .hourly[data-v-b2152e56] {
    width: 19rem;
    display: flex;
    flex-direction: column;
    align-items: center
}

.device .section-box .wrap .conttal .right-income .hourly p[data-v-b2152e56] {
    font-size: 3rem;
    color: #333841
}

.device .section-box .wrap .conttal .right-income .hourly .bold[data-v-b2152e56] {
    font-size: 3.2rem;
    margin-top: 1rem
}

.device .section-box .wrap .conttal .right-income .odd p[data-v-b2152e56] {
    text-align: left
}

.device .section-box .wrap .conttal .right-income .last[data-v-b2152e56] {
    padding-right: 0
}

.device .section-box .wrap .conttal .right-income .line[data-v-b2152e56] {
    width: .2rem;
    height: 4.9rem;
    border: .1rem solid #625f68
}

.device .section-box .wrap .product-bom[data-v-b2152e56] {
    display: flex;
    align-items: center;
    justify-content: space-between
}

.device .section-box .wrap .product-bom .l-time[data-v-b2152e56] {
    display: flex;
    flex-direction: column;
    align-items: flex-start
}

.device .section-box .wrap .product-bom .l-time .l1[data-v-b2152e56] {
    font-size: 2.2rem;
    color: #999
}

.device .section-box .wrap .product-bom .l-time .l2[data-v-b2152e56] {
    font-size: 2.2rem;
    color: #666;
    font-weight: 700;
    margin-top: 1rem
}

.device .section-box .wrap .product-bom .r-btn[data-v-b2152e56] {
    width: 18.4rem;
    background: #ffa400;
    border-radius: 1.2rem;
    line-height: 5.4rem;
    font-weight: 700;
    font-size: 2.8rem;
    color: #333
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap {
    height: 10rem;
    width: 60rem;
    margin: 0 auto;
    padding: 1.5rem 1.4rem;
    border-radius: 1rem
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav {
    background: none;
    padding-bottom: 0;
    display: flex;
    justify-content: space-around
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab {
    width: 23rem !important;
    padding-top: 1rem;
    flex: none;
    border-radius: .8rem;
    border: .4rem solid;
    border-image: linear-gradient(270deg, #21a2ff, #0038c6) 2 2;
    clip-path: inset(0 round .8rem)
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab span {
    font-family: fontbold;
    font-weight: 400;
    background: linear-gradient(270deg, #21a2ff, #0038c6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 3.1rem
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab--active {
    background: linear-gradient(270deg, #21a2ff, #0038c6);
    border-radius: .8rem;
    border: 0;
    clip-path: inset(0 round 0)
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tab--active span {
    font-family: fontbold;
    font-weight: 400;
    background: none;
    -webkit-background-clip: none;
    -webkit-text-fill-color: #fff;
    font-size: 3.1rem;
    color: #fff;
    border-style: none
}

[data-v-b2152e56] .tabs-box .van-tabs__wrap .van-tabs__nav .van-tabs__line {
    display: none
}

[data-v-b2152e56] .tabs-box .van-tabs__content {
    margin-top: 2rem
}

[data-v-b2152e56] .van-nav-bar {
    background: none
}

[data-v-b2152e56] .van-nav-bar:after {
    display: none
}

[data-v-b2152e56] .van-nav-bar .van-nav-bar__content .van-nav-bar__title {
    font-weight: 500;
    font-size: 3.6rem;
    color: #333
}

[data-v-b2152e56] .van-nav-bar .van-nav-bar__content .van-nav-bar__right .record {
    display: flex;
    flex-direction: column;
    align-items: center
}

[data-v-b2152e56] .van-nav-bar .van-nav-bar__content .van-nav-bar__right .record img {
    width: 4rem;
    height: 4rem
}

[data-v-b2152e56] .van-nav-bar .van-nav-bar__content .van-nav-bar__right .record p {
    font-weight: 400;
    font-size: 2.2rem;
    color: #333
}
</style>


    <div id="app" data-v-app="" style="background-image: linear-gradient(#5eeca4, #f0d951);" bis_skin_checked="1">
        <div data-v-b2152e56="" style="background-image: linear-gradient(#5eeca4, #f0d951);" class="device" bis_skin_checked="1">
          <div data-v-b2152e56="" class="van-nav-bar van-hairline--bottom" bis_skin_checked="1">
                <div class="van-nav-bar__content" bis_skin_checked="1">
                    <!---->
                  
                </div>
            </div>
     @foreach(\App\Models\UserLedger::where('reason', 'Claim')->where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
          <div data-v-b2152e56="" style="background-image: linear-gradient(#5eeca4, #f0d951);" class="lease-banner" bis_skin_checked="1">
                <div data-v-b2152e56="" class="accum" bis_skin_checked="1">
                    <p data-v-b2152e56="" class="accum-t1">{{$element->reason}}</p>
                    <p data-v-b2152e56="" class="accum-t2">{{price($element->amount)}}</p>
                </div>
                <div data-v-b2152e56="" class="existing" bis_skin_checked="1">
              
                    <div data-v-b2152e56="" class="rightu" bis_skin_checked="1">
                        <div data-v-b2152e56="" class="left" bis_skin_checked="1">
                            <p data-v-b2152e56="">Date</p>
                            <span data-v-b2152e56="" class="income">{{$element->created_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
@endforeach

           @include('preloader')
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

</html>