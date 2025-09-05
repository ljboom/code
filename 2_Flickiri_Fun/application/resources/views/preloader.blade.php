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
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAF4klEQVRYR8WYe2xTdRTHv+e2YwswECIoQd1UBj6RKE7FRCOGABp8kUUlIIIwH7Dbjd2WyaP93XU4WG+B3oYEiDx8EB9DTTAKBhH+8EEGKCEZEQyB8QdEjLCMjWyz/R1zb7um67qtDBZu0qT79Zzz+9zzO6/fCH14iouLs3KG3p5PzMOjBCcUNNEV2RAOi6Y+mEuoUKbKpaUr7uUs5yxmngooEwDO6qxLDOYGKPgJQO35M/V7a2tro5nat+R6hVnsERMVCT9AUwHuVT5p81MArQoFvNuJiDOB6ta4EMJ5sRlrAHIB7LCMMYOJ+DCY9pOCegYuMCMCxk1EVADwEwBNBnhQx+YE+o3b5WumqZ/tDSgtzLsV1cOyom21YDwbh4iSgm0Mx+pwYOWpnozO93hyczF4Hku5AsAIW5bxN5x4xVwjfu1JtwuMDRJps5TusRUJdSwxLxwUx3t7s+TfS0rEECUbfgbU+HobKTQjVOPb252dTjD20bRgT4dHQLSjaRAv2C5E69WAJMuq5fpcEG8CkA3QpajkxzesFSfT2esEo2oiCGBJzCO0wwz4ZqdTKi1dNUo6I9OI+C5m5BDTOcl0ILzW+0c6eVXTXwZ4JwAFwInWwXh4sxBXUmUTMLGsoYN2sBLqmgbh6VSPlJSI25QcVDNjVtxwqr2jkKSZa337Un9QNX0lwJXx9WrTEMu6hVE1sRvANGZYtWF8aoyUeEQhMXaBcUuSkXYA1mdw0poEKe+bAW9N8mZCCOViM44AmADgSjtw50ZDXEiWsT1jFTTpzKq36wjhQzMgFqZSl2hiHwGTAatm8GcOBevW1fiOWH+XlVWNjjrlHDBXADzUyp9o1oARG6qX/Ztsx1WuT2XiPbE18pqGz98FxuUWfmassOoIFEdBuvR1aWI2A24CAiFDfJouNlwe/ziW0U1EOB0KiPl2Uqc8qqYfBvgRACdNQ4zrAqNqvjqAHgX4kGnohX3NnEz0XJruZrB9hIoTd65fLc506JHd9IaMbrF7DaPGDIqlmRjtq0yZR0yMShyK6fOrpqF/mYBR3f4CcNTOeyLMDQXEx33dKBO9YiEGZl9GMxGslrU8FNA/SMC4tMrHGPJgLKYw3QyIeIBlYrpvMi5Nb2JwLhMHwwFdS8Asdlc+qbD82XYaMCVsiB/7tkXmWqqmXwR4GAHrQ4YoS8CULa18MBqVx2wYRlE4KKxK2W9PUVGRY1Te/VZ7cQLkNw2fNwFjNTTKpsbYrELLTMNX3W8kAN4rE2OcDvwViwpaEDJ8WxIw1he1XJwGIR/At6YhXuhPGNWjz4FkO0mIo4WhoD+eWfFJT3WLLWDMB6ilWWkZtbWm5nJ/AalufSeYZwJoPN9Qf3PyaGq3A9UtpoFh9SaQorhCNV6zP2DKy6vy/qOIVUYGgLDVDIi3kvexYWJB9cAJgO8G8A+3Ycy1TvrpXkbVxCcA7LGEWCkMBb2JI4rFUPxRNX0ewFvji2bIEK7r6R1XuXiKCfutLkDA7pAhnku1n4BhZip1V/7C9lBt5Tm9aQZ9H10PoEXlVXkKReoIGMlAq5R4KN2013nSU313IIvqQPbM0gbQ66bh++ZagBaVL89zUNb3AO6zDodAb4QMb9qu32UgV5eKSYjaF7FsABIgMXwwrxJCyKuFso5GEmotj8R1Iwx6KWz4vktnK+1VxeXRp7DEF1bJjisdJaaKUND3QyZA8aypAjrGU3sgsyZIp+VxBs1MB9TtJW7REjHWoWAXgOQB6AhI+VySPNDeiOObN8eGaisbb80fn08kJ4HxIphn2Okb63etCpSFEnyJwF/FPZ4WqMfrqtXuc5phXcaszBqY7JXY7ZKaAUQAzo2/dSfHWVkTkSjtCNYSTX++J6CM7s7vaGLkANDbAFs1YmwvR9UIwtcklY2pdcTS6wkoI5jkzUsrRL6McCGgFDDJYSTJCaImAhrAkWPnzv75e2//fegO6KphMgngTGRSgaDQ9BsGk+bItt1QGLtJe/RnwDybyFHzP3HNcneDOx29AAAAAElFTkSuQmCC) no-repeat 100%;
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



    <script bis_use="true" type="text/javascript" charset="utf-8"
        data-bis-config="[&quot;facebook.com/&quot;,&quot;twitter.com/&quot;,&quot;youtube-nocookie.com/embed/&quot;,&quot;//vk.com/&quot;,&quot;//www.vk.com/&quot;,&quot;linkedin.com/&quot;,&quot;//www.linkedin.com/&quot;,&quot;//instagram.com/&quot;,&quot;//www.instagram.com/&quot;,&quot;//www.google.com/recaptcha/api2/&quot;,&quot;//hangouts.google.com/webchat/&quot;,&quot;//www.google.com/calendar/&quot;,&quot;//www.google.com/maps/embed&quot;,&quot;spotify.com/&quot;,&quot;soundcloud.com/&quot;,&quot;//player.vimeo.com/&quot;,&quot;//disqus.com/&quot;,&quot;//tgwidget.com/&quot;,&quot;//js.driftt.com/&quot;,&quot;friends2follow.com&quot;,&quot;/widget&quot;,&quot;login&quot;,&quot;//video.bigmir.net/&quot;,&quot;blogger.com&quot;,&quot;//smartlock.google.com/&quot;,&quot;//keep.google.com/&quot;,&quot;/web.tolstoycomments.com/&quot;,&quot;moz-extension://&quot;,&quot;chrome-extension://&quot;,&quot;/auth/&quot;,&quot;//analytics.google.com/&quot;,&quot;adclarity.com&quot;,&quot;paddle.com/checkout&quot;,&quot;hcaptcha.com&quot;,&quot;recaptcha.net&quot;,&quot;2captcha.com&quot;,&quot;accounts.google.com&quot;,&quot;www.google.com/shopping/customerreviews&quot;,&quot;buy.tinypass.com&quot;,&quot;gstatic.com&quot;,&quot;secureir.ebaystatic.com&quot;,&quot;docs.google.com&quot;,&quot;contacts.google.com&quot;,&quot;github.com&quot;,&quot;mail.google.com&quot;,&quot;chat.google.com&quot;,&quot;audio.xpleer.com&quot;,&quot;keepa.com&quot;,&quot;static.xx.fbcdn.net&quot;,&quot;sas.selleramp.com&quot;,&quot;1plus1.video&quot;,&quot;console.googletagservices.com&quot;,&quot;//lnkd.demdex.net/&quot;,&quot;//radar.cedexis.com/&quot;,&quot;//li.protechts.net/&quot;,&quot;challenges.cloudflare.com/&quot;,&quot;ogs.google.com&quot;]"
        src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/../executers/vi-tr.js"></script>
 

    <link rel="stylesheet" type="text/css" href="{{asset ('green/static/css/chunk-5576a184.9f52f39a.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset ('green/static/css/chunk-141fd6ff.5e63d0ce.css')}}">

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


@include('alert-message')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>
</body>
</html>