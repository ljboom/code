<html class="" style="font-size: 52px;">
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/content/location/location.js"
    id="eppiocemhmnlbhjplcgkofciiegomcon"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/extend-native-history-api.js"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/requests.js"></script>

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="icon" href="/logo1.png">
    <title>Login</title>
     <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js">
        <script>window.addEventListener("error", function (event) {
        if (event.message.indexOf("Unexpected token '<'") > -1) {
          location.reload();
        }
      });
      window.onload = function () {
        document.addEventListener("touchstart", function (event) {
          if (event.touches.length > 1) {
            event.preventDefault();
          }
        });
        var lastTouchEnd = 0;
        document.addEventListener(
          "touchend",
          function (event) {
            var now = new Date().getTime();
            if (now - lastTouchEnd <= 300) {
              event.preventDefault();
            }
            lastTouchEnd = now;
          },
          false
        );
        document.addEventListener("gesturestart", function (event) {
          event.preventDefault();
        });
      };
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            background: #0d2623;
        }
    </style>
    <style>
    .login-footer[data-v-2f38444e] {
    width: 100%;
    margin-top: .68966rem
}

.login-footer .right[data-v-2f38444e] {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: .68966rem
}

.login-footer .right .download-btn[data-v-2f38444e] {
    width: 75%
}

.login-footer .right .text-wrapper[data-v-2f38444e] {
    position: absolute;
    top: .55172rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center
}

.login-footer .right img[data-v-2f38444e] {
    width: .68966rem
}

.download[data-v-2f38444e] {
    position: relative;
    margin-top: .2069rem
}

.download img[data-v-2f38444e] {
    width: 4.82759rem
}

.download .text[data-v-2f38444e] {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    font-size: .24138rem;
    color: #8fe1d1
}

.box1[data-v-2f38444e] {
    height: 5rem
}

html[class=pc] .box1[data-v-2f38444e] {
    height: 5.86207rem
}

.lang .la1[data-v-2f38444e] {
    margin-right: .24rem
}

.lang img[data-v-2f38444e] {
    cursor: pointer
}

.form-wrapper[data-v-2f38444e] {
    border-radius: .34483rem;
    overflow: hidden
}

.form-wrapper .form-input-wrapper[data-v-2f38444e] {
    padding: 0 .37931rem
}

.head[data-v-2f38444e] {
    padding: .10345rem .27586rem 0 .17241rem;
    margin-bottom: .2069rem
}

.head .lang[data-v-2f38444e] {
    display: flex;
    align-items: center
}

.head .lang .la1[data-v-2f38444e] {
    margin-right: .32rem
}

.head .logo img[data-v-2f38444e] {
    width: 1.03448rem
}

.head .so[data-v-2f38444e] {
    margin: 0 .6rem;
    height: .64rem;
    background: #2a292f;
    border-radius: .34rem;
    padding: 0 .24rem 0 .3rem
}

.head .so input[data-v-2f38444e] {
    font-size: .28rem;
    height: .64rem;
    width: 100%;
    background: url(data:image/png;base64,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) no-repeat 100%;
    background-size: auto .32rem;
    border: 0
}

.head .lang img[data-v-2f38444e] {
    height: .4rem
}

.logo[data-v-2f38444e] {
    font-family: PingFangSC-Semibold, PingFang SC;
    font-weight: 400;
    color: #fff
}

.logo .title[data-v-2f38444e] {
    font-size: .6rem;
    font-weight: 600;
    padding: .48rem 0 .35rem .28rem
}

.logo .title .bot[data-v-2f38444e] {
    width: 1.68rem;
    height: .15rem;
    background: linear-gradient(90deg, #fe4263, rgba(254, 66, 99, 0))
}

.logo ul[data-v-2f38444e] {
    margin: .25rem 0
}

.logo ul li[data-v-2f38444e] {
    display: flex;
    align-items: center;
    border: .01724rem solid #38664e;
    padding: .22414rem;
    border-radius: .13793rem;
    margin-bottom: .22414rem
}

.logo ul li img[data-v-2f38444e] {
    width: .34483rem;
    margin-right: .2069rem
}

.logo ul li .name[data-v-2f38444e] {
    font-size: .28rem;
    color: #fe4263;
    margin-bottom: .22rem
}

.logo ul li .input[data-v-2f38444e] {
    display: flex;
    align-items: center
}

.logo ul li .input input[data-v-2f38444e] {
    width: 100%;
    height: .38rem;
    font-size: .28rem;
    font-weight: 400;
    text-align: left;
    color: #8fe1d1;
    background: none;
    border: 0
}

.logo ul li .input input[data-v-2f38444e]::placeholder {
    color: #457c6f
}

.logo ul li .input .in[data-v-2f38444e] {
    flex: 1
}

.logo ul li .input .str[data-v-2f38444e] {
    background: linear-gradient(225deg, #ff4565, #ef1746);
    border-radius: .3rem;
    padding: .12rem .24rem;
    color: #fff;
    text-align: center;
    font-size: .24rem;
    font-weight: 400
}

.logo ul li .input .str[data-v-2f38444e] .van-count-down {
    color: #fff
}

.logo .btn[data-v-2f38444e] {
    width: 100%;
    font-size: .3rem;
    font-weight: 500;
    color: var(--COborder3);
    text-align: center;
    padding: .25rem 0;
    background: linear-gradient(90deg, #0c231d, #074d2e 50%, #00341e);
    border-radius: .13793rem;
    border: .01724rem solid #38664e;
    margin: .25862rem 0
}

.forgot_password[data-v-2f38444e] {
    font-size: .28rem;
    font-family: PingFangSC-Regular, PingFang SC;
    font-weight: 400;
    margin-bottom: .4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #8fe1d1
}

.home[data-v-2f38444e] {
    min-height: 100vh;
    background: #091917 url({{asset ('green/login-bg.af2c8b12.png')}}) no-repeat top;
    background-size: 100%;
    padding-bottom: 2.75862rem
}

.container[data-v-2f38444e] {
    color: var(--COcolor1)
}

.box .flex[data-v-2f38444e],
.box[data-v-2f38444e] {
    width: 100%
}

.box .info[data-v-2f38444e] {
    padding: 0 .2rem
}

.box ul[data-v-2f38444e] {
    padding-top: 1rem;
    width: 100%
}

.box ul li[data-v-2f38444e] {
    height: .88rem;
    background: rgba(0, 0, 0, .57);
    border-radius: .44rem;
    margin-bottom: .4rem;
    padding: 0 .5rem
}

.box ul li .area_name[data-v-2f38444e] {
    border-right: .02rem solid #989898;
    padding-right: .2rem;
    margin-right: .2rem
}

.box ul li .area_name i[data-v-2f38444e] {
    font-size: .24rem;
    margin-left: .06rem
}

.box ul li input[data-v-2f38444e] {
    width: 100%;
    height: .38rem;
    font-size: .28rem;
    font-weight: 400;
    text-align: left;
    color: #989898;
    background: none;
    border: 0
}

.bottom .txt[data-v-2f38444e] {
    margin-top: .7rem;
    text-align: center
}

.bottom[data-v-2f38444e] .van-checkbox__label {
    color: #9ba0a5;
    font-size: .24rem
}

.bottom[data-v-2f38444e] .van-checkbox {
    justify-content: center
}

.logo_icon[data-v-2f38444e] {
    text-align: center;
    margin-top: 1.23rem;
    margin-bottom: .34483rem
}

.logo_icon img[data-v-2f38444e] {
    width: 1.55172rem
}

.login-header[data-v-2f38444e] {
    padding: 0 .24138rem
}

.logo_nav[data-v-2f38444e] {
    padding-top: .24138rem;
    padding-bottom: .25862rem;
    font-size: .28rem;
    display: flex;
    border-bottom: .01724rem solid hsla(0, 0%, 100%, .1)
}

.logo_nav .item[data-v-2f38444e] {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    text-align: center;
    padding: 0 .24rem;
    color: #fff
}

.logo_nav .item .name[data-v-2f38444e] {
    word-break: break-all;
    word-wrap: break-word
}

.logo_nav .active[data-v-2f38444e] {
    color: #53ec7c
}

.logo_nav .active[data-v-2f38444e]:after {
    position: absolute;
    bottom: -.24138rem;
    left: 50%;
    transform: translateX(-50%);
    content: "";
    display: block;
    width: 20%;
    height: .06897rem;
    border-radius: .17241rem;
    background: #53ec7c
}

.check[data-v-2f38444e] {
    display: flex;
    justify-content: center;
    width: 80%;
    margin: .34483rem auto 0
}

.check .doc[data-v-2f38444e] {
    color: #d9d1d3
}

.check .doc span[data-v-2f38444e] {
    color: #fff
}
    </style>


    <link href="{{asset ('green/static/css/chunk-vue.84f98cfb.css')}}" rel="stylesheet">
    <link href="{{asset ('green/static/css/chunk-vant.d14f5539.css')}}" rel="stylesheet">
    <link href="{{asset ('green/static/css/app.c8f0910a.css')}}" rel="stylesheet">
    <script bis_use="true" type="text/javascript" charset="utf-8"
        data-bis-config="[&quot;facebook.com/&quot;,&quot;twitter.com/&quot;,&quot;youtube-nocookie.com/embed/&quot;,&quot;//vk.com/&quot;,&quot;//www.vk.com/&quot;,&quot;linkedin.com/&quot;,&quot;//www.linkedin.com/&quot;,&quot;//instagram.com/&quot;,&quot;//www.instagram.com/&quot;,&quot;//www.google.com/recaptcha/api2/&quot;,&quot;//hangouts.google.com/webchat/&quot;,&quot;//www.google.com/calendar/&quot;,&quot;//www.google.com/maps/embed&quot;,&quot;spotify.com/&quot;,&quot;soundcloud.com/&quot;,&quot;//player.vimeo.com/&quot;,&quot;//disqus.com/&quot;,&quot;//tgwidget.com/&quot;,&quot;//js.driftt.com/&quot;,&quot;friends2follow.com&quot;,&quot;/widget&quot;,&quot;login&quot;,&quot;//video.bigmir.net/&quot;,&quot;blogger.com&quot;,&quot;//smartlock.google.com/&quot;,&quot;//keep.google.com/&quot;,&quot;/web.tolstoycomments.com/&quot;,&quot;moz-extension://&quot;,&quot;chrome-extension://&quot;,&quot;/auth/&quot;,&quot;//analytics.google.com/&quot;,&quot;adclarity.com&quot;,&quot;paddle.com/checkout&quot;,&quot;hcaptcha.com&quot;,&quot;recaptcha.net&quot;,&quot;2captcha.com&quot;,&quot;accounts.google.com&quot;,&quot;www.google.com/shopping/customerreviews&quot;,&quot;buy.tinypass.com&quot;,&quot;gstatic.com&quot;,&quot;secureir.ebaystatic.com&quot;,&quot;docs.google.com&quot;,&quot;contacts.google.com&quot;,&quot;github.com&quot;,&quot;mail.google.com&quot;,&quot;chat.google.com&quot;,&quot;audio.xpleer.com&quot;,&quot;keepa.com&quot;,&quot;static.xx.fbcdn.net&quot;,&quot;sas.selleramp.com&quot;,&quot;1plus1.video&quot;,&quot;console.googletagservices.com&quot;,&quot;//lnkd.demdex.net/&quot;,&quot;//radar.cedexis.com/&quot;,&quot;//li.protechts.net/&quot;,&quot;challenges.cloudflare.com/&quot;,&quot;ogs.google.com&quot;]"
        src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/../executers/vi-tr.js"></script>
 

    <link rel="stylesheet" type="text/css" href="{{asset ('green/static/css/chunk-5576a184.9f52f39a.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset ('green/static/css/chunk-141fd6ff.5e63d0ce.css')}}">

</head>


<style>
.loader_bg{
    position: fixed;
    z-index: 999999;
    background: #fff;
    width: 100%;
    height: 100%;
}
.loader{
    border: 0 soild transparent;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    position: absolute;
    top: calc(50vh - 75px);
    left: calc(50vw - 75px);
}
.loader:before, .loader:after{
    content: '';
    border: 1em solid #ff5733;
    border-radius: 50%;
    width: inherit;
    height: inherit;
    position: absolute;
    top: 0;
    left: 0;
    animation: loader 2s linear infinite;
    opacity: 0;
}
.loader:before{
    animation-delay: .5s;
}
@keyframes loader{
    0%{
        transform: scale(0);
        opacity: 0;
    }
    50%{
        opacity: 1;
    }
    100%{
        transform: scale(1);
        opacity: 0;
    }
}






</style>


<div class="loader_bg">
<div id="app" class="applang" bis_skin_checked="1">
        <div class="startUp" bis_skin_checked="1"><img src="{{asset ('green/logo22.a3d7e64d.png')}}" alt=""></div>
    
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>
</body>
</html>


<body __processed_dc36a6d9-c038-4ef6-9514-e3111b3b5822__="true"
    bis_register="W3sibWFzdGVyIjp0cnVlLCJleHRlbnNpb25JZCI6ImVwcGlvY2VtaG1ubGJoanBsY2drb2ZjaWllZ29tY29uIiwiYWRibG9ja2VyU3RhdHVzIjp7IkRJU1BMQVkiOiJkaXNhYmxlZCIsIkZBQ0VCT09LIjoiZGlzYWJsZWQiLCJUV0lUVEVSIjoiZGlzYWJsZWQiLCJSRURESVQiOiJkaXNhYmxlZCIsIlBJTlRFUkVTVCI6ImRpc2FibGVkIiwiSU5TVEFHUkFNIjoiZGlzYWJsZWQiLCJMSU5LRURJTiI6ImRpc2FibGVkIiwiQ09ORklHIjoiZGlzYWJsZWQifSwidmVyc2lvbiI6IjIuMC4xNyIsInNjb3JlIjoyMDAxN31d">
 <form action="{{url('login')}}" class="auth-form" method="post">
       
                               @csrf

        <div data-v-2f38444e="" class="home" bis_skin_checked="1">
            <div data-v-2f38444e="" class="head" bis_skin_checked="1">
                <div data-v-2f38444e="" bis_skin_checked="1">
                    <div data-v-2f38444e="" class="db"
                        style="display: flex; align-items: center; justify-content: space-between;"
                        bis_skin_checked="1">
                        
   
                        <div data-v-2f38444e="" class="logo" bis_skin_checked="1"></div>
                        <div data-v-2f38444e="" class="lang" bis_skin_checked="1">
                            <img data-v-2f38444e="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAACXBIWXMAACxLAAAsSwGlPZapAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAUZSURBVHgB7Vy7UttAFL3OpAzp4QNCH+hxeqAP1Dzq5ANieiZ1gBqTGtPH9CG9Te98AOnJHnPlEcZ3H9plVyvrzOxgrIelo/vW7u1QjfD4+Lih/mypsanGqhorvOlBjbEaIzVuO53OHdUEHaoBFHE76s+BGmuWh0zUOFdE3lBiJCVQEQfCTtX4QNUAIo8VkRNKhDeUCCx1l1SdPAAP4FKdq0uJkEQC+YZPKSx6KVQ6OoGstpC8FQoLOJr92OqcgsBrMjsLeFl4XHheEA2P3LU4bqwI3KOIiEog271vml0gPVDFP8LxH7Gd9ERGVeXYBOqkD9J2pG7+wXAOSOQZyc5nos6xS5EQzQtzkCyRB8kzkgfwPkd8zCKs8W9FQcwwZkuzrWdDXgHe94Sq/VZQxCRwXfh+Itk8HTidk1K6TYqEmARKNmtI1TESvl+lSIhJoBT3/aXquCe33wqOt1QBHAzDUL8j/4vdYM9aBWIaqM55SHaAPcVDhCkZkyOsw5hSqQmxXLQnHBnw7LCrN7YlMyOBijg85a/0JHHLBBB4YkoNtQQq8pAWfaHlBuqO59JGkUC2IbZ2pOkQSVxIYEveQiwk8UUYwwl/S95LHLJJe4ZnEsjhyQ/SVzvg9q/UGKgn4hPD1QbsKOEkP5P53nfLaec8gSg17WhO0FfjwiVvzQ0W5guCM8vDO6UDwfy15kCtN2oSDCQ+k8KyDdTFeYNlIQ/ge+0Lm5FEbBf/lAncJhkXtHzAPUumqlt8KBMo5ZWDlO9dU4FVdChsnnE1JZCTeSm/rc00igSQ6pQrirNpyayQQF1xYOmkrwTjvdvUA6NVd2uIddMO0zCGVfgXtXDBJ9jJqQSywVxmW+eKu0Vx4NLEeQEwKD7MCOQK7JBamDAoz3yYdyLI8YbUQgKE7Hv5C6ke6DpjtOmAvUMt4Gp+g6mkj4i7PFcZ6Am7wy7k4oiQ90tVp97c/2Pd2zrta00+cHYwV2wkDNX+t5QB1H1AcCQC71zqnK4v1nVv/HOqEY4025xe2boSqDt5TtXpf5ptTtNCgklgTuV9Q3UpiQTmWOKXrtkp8gglgTm+XJIIfFUVXnO8mDpDCk2SqHCONcNWhT0hXfM7ckDrRF7idSTQkIXkqMJiLFi877CBiwQ2JQspECQbcSGwKVlIgSDZSBAJzHGSUahsJIQE5jzRyNuRhJDAnKe4eWcjLgQ2KQsp4J2NhFDhnGcutCrsCe9spHUiixFWAhuYhRTwzkZs18pVzkJ43g0mb3d530EdGuYwTNmI0TzZEuiThaC9SXn6MBYXvlck9ik9TNmIcfGhrQ2slIXwAsVFc68PqAYIkY3YEljVgaw5ni8FvByJrwQ2YaGNVzZiS2ATs5ACXtmIrwo3Yf50FBWWIvMmqLBXNuLbdMLpBUxN4XUPtgRK8ZJxFnsGkO7BSrtsCfwtfO/TcSM5St1HFmFEFrAl8F6zrRZBcUXort1qsqgtgUOSvdVezGZfocDXrFsbbdWOyopAXhMx0OxyytOBswCTp2tBOrBdVO7ihX+SLIWwg30sVDaUvpIC9poXU6P/oM52Wy/vdWrA6NBHZkhPET7SIUlNTigecB2QOmiJyek5rcx37mCpSDyj5nYxwgTzI5cDqhCIJ4guvE1bQ4K0dN+1oYZzJsI/cEwWxcaMgJDFmTzAqwltQzoceXUj8e7iy14XAekO5QWEZRe+/SCCtUEupUXoMYjPdYoLH3hAVWF6bkI1D/oPdcmdKJhMDSAAAAAASUVORK5CYII=" class="la1"><img data-v-2f38444e="" src="data:image/png;base64,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" alt="" class="la1"><img data-v-2f38444e="" src="data:image/png;base64,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" class="la1"><img data-v-2f38444e="" src="data:image/png;base64,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" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div data-v-2f38444e="" class="container" bis_skin_checked="1">
                <div data-v-2f38444e="" class="box1" bis_skin_checked="1"></div>
                <div data-v-2f38444e="" class="form-wrapper" bis_skin_checked="1">
                    <div data-v-2f38444e="" class="login-header" bis_skin_checked="1">
                        <div data-v-2f38444e="" class="logo_nav" bis_skin_checked="1">
                            <div data-v-2f38444e="" class="item active" bis_skin_checked="1">
                                <div data-v-2f38444e="" class="name" bis_skin_checked="1">Phone login</div>
                                <div data-v-2f38444e="" class="icon" bis_skin_checked="1"></div>
                            </div>
                            <div data-v-2f38444e="" class="item" bis_skin_checked="1">
                                <div data-v-2f38444e="" onclick="window.location.href='{{url('member/invitation/login&register')}}'" class="name" bis_skin_checked="1">Register Now</div>
                                <div data-v-2f38444e="" class="icon" bis_skin_checked="1"></div>
                            </div>
                        </div>
                    </div>
                    <div data-v-2f38444e="" class="logo form-input-wrapper" bis_skin_checked="1">
                        <ul data-v-2f38444e="">
                            <li data-v-2f38444e="">
                                <div data-v-2f38444e="" class="input flex-1" bis_skin_checked="1"><input data-v-2f38444e="" name="phone" inputmode="numeric"   type="text" placeholder="Phone" onkeyup="this.value=this.value.replace(/[ ]/g,'')">
                                </div>
                            </li>
                            <li data-v-2f38444e="">
                                <div data-v-2f38444e="" class="input flex-1" bis_skin_checked="1"><input data-v-2f38444e="" name="password"   type="password" placeholder="Password" onkeyup="this.value=this.value.replace(/[ ]/g,'')">
                                </div>
                            </li>
                        </ul>
                        <div data-v-2f38444e="" class="mflex justify-between items-center" bis_skin_checked="1">
                            <div data-v-2f38444e="" role="checkbox" tabindex="0" aria-checked="true"
                                class="van-checkbox" bis_skin_checked="1">
                                <div class="van-checkbox__icon van-checkbox__icon--round van-checkbox__icon--checked"
                                    style="font-size: 16px;" bis_skin_checked="1">
                                    <i class="van-icon van-icon-success" style="border-color: rgb(61, 237, 145); background-color: rgb(61, 237, 145);"><!----></i>
                                </div>
                                <span class="van-checkbox__label"><div data-v-2f38444e="" style="color: rgb(143, 225, 209);" bis_skin_checked="1">Remember Account</div></span>
                            </div>
                            <div data-v-2f38444e="" class="text-right" style="color: rgb(143, 225, 209);"
                                bis_skin_checked="1">Forgot Password？</div>
                        </div><button data-v-2f38444e=""   onclick="login()"  class="btn"> Login </button>
                        <div data-v-2f38444e="" class="forgot_password" bis_skin_checked="1">
                            <div data-v-2f38444e="" bis_skin_checked="1"></div>
                            <div data-v-2f38444e="" class="left" bis_skin_checked="1"> Contact customer service </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-v-2f38444e="" class="login-footer" bis_skin_checked="1">
                <div data-v-2f38444e="" class="right" bis_skin_checked="1"><img data-v-2f38444e="" src="{{asset ('green/download-btn.b2c285b3.png')}}" alt="" class="download-btn">
                    <div data-v-2f38444e="" onclick="window.location.href='{{url('member/invitation/login&register')}}'" class="text-wrapper" bis_skin_checked="1"><img data-v-2f38444e="" src="{{asset ('green/add.c366304b.png')}}" alt=""> Create account
                    </div>
                </div>
          
                <div data-v-2f38444e="" class="check" bis_skin_checked="1">
                    <div data-v-2f38444e="" role="checkbox" tabindex="0" aria-checked="true" class="van-checkbox"
                        bis_skin_checked="1">
                        <div class="van-checkbox__icon van-checkbox__icon--round van-checkbox__icon--checked"
                            bis_skin_checked="1">
                            
                       
                    </div></span>
                </div>
            </div>
        </div>
        <!---->
    </div>


<style>



 #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: rgba(31, 28, 28, 0.5);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: white;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

#snackbar_error {
  visibility: hidden;
  width: 40%;
  margin-left: 5px;
  background-color: whitesmoke;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: black;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 30%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar_error.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {
    bottom: 50%;
    opacity: 0;
  }
  to {
    bottom: 50%;
    opacity: 1;
  }
}

@keyframes fadeout {
  from {
    bottom: 50%;
    opacity: 1;
  }
  to {
    bottom: 50%;
    opacity: 0;
  }
}

@media (min-width: 576px) and (max-width: 767px) {
  #snackbar_error {
    width: 60%;
    left: 20%;
    bottom: 70px;
    font-size: 12px;
  }
  #snackbar {
    width: 50%;
    left: 25%;
    bottom: 70px;
    font-size: 12px;
  }
}
@media (max-width: 575.99px) {
  #snackbar_error {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
  #snackbar {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
}

        /* Styles for the preloader */
        #preloade {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
       
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black
        }
        /* Styles for the preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
           
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black
        }
</style>


 <script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('a').click(function() 
    {
        $('#loader').show();
    }) 
})
</script>
<script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('form').submit(function() 
    {
        $('#loader').show();
    }) 
})
</script>



    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
    <title>
         Home
    </title>
    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
</head>

<body class="main-layout m-0 p-0">

    <!-- loader  -->
    <div class="loaderd" id="preloade">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
     <center>  
     
     
      <div class="loaderd">
          <div data-v-a7d12cfc=""
 class="global-loading default"   bis_skin_checked="1">
        <div data-v-a7d12cfc=""  class="global-spinner" bis_skin_checked="1"><img data-v-a7d12cfc="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAArCAYAAAADgWq5AAAACXBIWXMAAAsTAAALEwEAmpwYAAAF6WlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDIgNzkuMTYwOTI0LCAyMDE3LzA3LzEzLTAxOjA2OjM5ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAyMi0wNC0xMlQxNTo0MTowNiswODowMCIgeG1wOk1vZGlmeURhdGU9IjIwMjItMDQtMTJUMTU6NDM6MTQrMDg6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDQtMTJUMTU6NDM6MTQrMDg6MDAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NWU0ZGQwNmEtMWExNS1kYjRmLTkyZmQtZjIzNTAwNzJkMGNmIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjlGMTI0NjE1NTQzQzExRThCQzhCQzEyQjVDOUMzOEJGIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6OUYxMjQ2MTU1NDNDMTFFOEJDOEJDMTJCNUM5QzM4QkYiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5RjEyNDYxMjU0M0MxMUU4QkM4QkMxMkI1QzlDMzhCRiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5RjEyNDYxMzU0M0MxMUU4QkM4QkMxMkI1QzlDMzhCRiIvPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo1ZTRkZDA2YS0xYTE1LWRiNGYtOTJmZC1mMjM1MDA3MmQwY2YiIHN0RXZ0OndoZW49IjIwMjItMDQtMTJUMTU6NDM6MTQrMDg6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hddYGwAABHhJREFUWIXN2XuoFVUUx/HPXG9WmmIPJQtNwQwqe5paEI1pCBZCRvVXDwlKCsLpIURgIZZG1KEXRVJJWPRnIv3TAw/0UCsrUlBLLQ1T01Ip6eZr+mPPOHOP56jXcz3XHxzu3nv2nv29a/bstdaeyJIXdYOG4bLs77k4AzvQFyvxKw7gJ/xZHpjGSZcmam8Csg/uxU0Yi8HHMGYz1uAtfIh/uzrp8QBPwFO4HgfR1oWx52e/CViX3ef9rkwedWFJXIQncE+da7uwHcuwF1uQClbvi1G4tMF9V+GuNE5+6C7gUzANT2Joqb0Dm/A6XsO+I9yjD/7DaMzArTi1ps/iNE6mNAvcjqfxKE4rtS/BXHxytAnqqBcuwHQ8XnNtP0amcfJLo8FHWn/98QIeK8Fuw3W48ThhCbvFBsxEhMWla+3YEFUrfbsKfDpewcOKR/e5sBssPU7QusqWwTTBurlWN+rfCHg67i7V3xasurFZwHpK42QBxmFP1jQkqlbW1utbD3g0ygt7Fe7T2QLdrjROVmBSqWlkVK28WtuvHvB7pfImXNvNbA2VxsmXeKnU9FBUrVxT7lMLHGNkVt6JO/DPiQKspzROZuC3UtM7UbVyiLMMPBDzSvWFWHFC6RprrLCbwCU4ZOUy8G24OivvxCwneN02UhonWwSD5Xo3L5SBpypii/mCu+1JzRHcOwyPqpVhFMD9MSYr78OnLUWrozRO1gk7FCE8mEwBPE7hzVbiu5bSNdabpfKkqFqJcuCr0Dsrr1ETZPegPiiVJ6dxkubAQwW/TohTTxa1K4x3IKpWLmwToqfhWWMqpDEnhdI42SrENYSYpqNN2O+uyBojfN16tPqKqpV2fJNVD+LK3MJbS/0GtRqskdI42Y+zsmob/moTlkHuVQ7qHKifDCpnJtvbBMg8XmjD2S1HaqCoWhmgCDl3o1e+S3xf6tey6OwY1K4IxrZhcw68rNRpjJNHA4WsG7ancbI7B/5CcagxCv1aTVarLKS8OaumAuMh17xFsVb64YaW0tVXO27PyvuxiAL4oJC35Xq+dVwNdbEiDv5btmzL4eXcUnmEwpn0lGYpwoVFaZykdAbeJZziEB7HG0JY13JF1crlyE+BdmQsODynm60ImkcIS6WliqqVQXhO8MCEg5Yf8+u1wFvxANbjfoUHbImiaqU3XsbErGkf5qRx0pH3qXfcOj/79YSeFXaG3JAz0zjZUO7QzIF2tymLyp7BI4oXbYVg7U7qceCoWhmKBRhfal6NKWmcHPYOdeX0/EQoxkc6wy7FxDROfq83oKcsfIvw+MfXtC8VLLuj0cBmgXsLb/RIfCVkK72FrXGfELjsEXLGFHcK580DdI5zd2F2GieVo03YLPCDwqF3nmr1Ek6N1grfN7Zn/8xenNPgHsuFbxw/H8uEzQLvVLwH+UZ/pnDOQfg0UKsD2biPMS+Nk5VdmbBZ4IVCVjtVyAXPE2LYsjqEtGs9vhWCrM8cp1NqFviA4OdzXz9ESLcGC+Abhe9yy4Vk8o8m5/M/9rYMi48jzWIAAAAASUVORK5CYII=" alt="">
        </div>
    </div>
      
    </center>
        </div>
    </div>
    <!-- end loader -->
  <script src="https://novocoders.icu/box/spical/112/public/assets/toast.js"></script>













    <!---->
    <!---->
    <div data-v-58a1bd20="" bis_skin_checked="1"></div>
    </div>

    <div id="veepn-breach-alert" bis_skin_checked="1"></div>
    <style>
        @font-face {
            font-family: FigtreeVF;
            src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
            font-weight: 100 1000;
            font-display: swap
        }
    </style>
    <!---->
</body>

 <style>



 #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: rgba(31, 28, 28, 0.5);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: white;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

#snackbar_error {
  visibility: hidden;
  width: 40%;
  margin-left: 5px;
  background-color: whitesmoke;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: black;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 30%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar_error.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {
    bottom: 50%;
    opacity: 0;
  }
  to {
    bottom: 50%;
    opacity: 1;
  }
}

@keyframes fadeout {
  from {
    bottom: 50%;
    opacity: 1;
  }
  to {
    bottom: 50%;
    opacity: 0;
  }
}

@media (min-width: 576px) and (max-width: 767px) {
  #snackbar_error {
    width: 60%;
    left: 20%;
    bottom: 70px;
    font-size: 12px;
  }
  #snackbar {
    width: 50%;
    left: 25%;
    bottom: 70px;
    font-size: 12px;
  }
}
@media (max-width: 575.99px) {
  #snackbar_error {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
  #snackbar {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
}

        /* Styles for the preloader */
        #preloade {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
       
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black
        }
        /* Styles for the preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
           
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black
        }
</style>


 <script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('a').click(function() 
    {
        $('#loader').show();
    }) 
})
</script>
<script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('form').submit(function() 
    {
        $('#loader').show();
    }) 
})
</script>



    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
    <title>
         Home
    </title>
    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
</head>

<body class="main-layout m-0 p-0">


  <script src="{{asset ('public/assets/toast.js')}}"></script>

  <script>

    function login(){
        document.querySelector('.loaderd').style.display = 'block';
        document.querySelector('form').submit();
    }

    window.onload = function() {
        document.querySelector('.loaderd').style.display = 'none';
    };

    function eye() {
        var pass = document.querySelector('input[name="password"]');
        if (pass.type == 'password') {
            pass.type = 'text'
        } else {
            pass.type = 'password'
        }
    }
</script>
  <script src="{{asset ('public/assets/toas.js')}}"></script>
<script>
    

    </script>
</html>
 @include('alert-message')