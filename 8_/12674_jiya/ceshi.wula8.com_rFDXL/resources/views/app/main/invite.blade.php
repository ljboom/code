<html style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Share</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description"
          content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public/share.css')}}">
    <style>
        .content .box .sbox .sbox_btn[data-v-381b65da] {
            margin-top: 7px;
        }
    </style>
</head>
<body class="uni-body pages-index-share">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/index/share">
        <uni-page-head uni-page-head-type="default">
            <div class="uni-page-head" style="background-color: rgb(13, 165, 97); color: rgb(255, 255, 255);">
                <div class="uni-page-head-hd">
                    <div class="uni-page-head-btn" onclick="window.location.href='{{route('dashboard')}}'"><i class="uni-btn-icon"
                                                      style="color: rgb(255, 255, 255); font-size: 27px;"></i></div>
                    <div class="uni-page-head-ft"></div>
                </div>
                <div class="uni-page-head-bd">
                    <div class="uni-page-head__title" style="font-size: 16px; opacity: 1;"> Share</div>
                </div>
                <div class="uni-page-head-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </uni-page-head>
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-381b65da="" class="content">
                    <uni-view data-v-381b65da="" class="bj_top">
                        <uni-view data-v-381b65da="" class="bj_ty"></uni-view>
                    </uni-view>
                    <uni-view data-v-381b65da="" class="box">
                        <uni-view data-v-381b65da="" class="m1">Invite your friends to make money together</uni-view>
                        <uni-view data-v-381b65da="" class="m2">Easy money at home, stable income</uni-view>
                    </uni-view>
                    <uni-view data-v-381b65da="" class="box">
                        <uni-view data-v-381b65da="" class="mycode">My QR code</uni-view>
                        <uni-view data-v-381b65da="" class="code">
                            <img style="width: 100%" src="{{asset('public/qr.png')}}" alt="">
                        </uni-view>
                    </uni-view>
                    <uni-view data-v-381b65da="" class="box">
                        <uni-view data-v-381b65da="" class="sbox">
                            <uni-view data-v-381b65da="" class="sbox_msg">{{auth()->user()->ref_id}}</uni-view>
                            <uni-view data-v-381b65da="" class="sbox_btn" onclick="openPopShare()">
                                <uni-text data-v-381b65da=""><span>Click</span></uni-text>
                            </uni-view>
                        </uni-view>
                    </uni-view>
                    <uni-view data-v-381b65da="" class="box" style="display: none;">
                        <uni-swiper data-v-381b65da="" class="swiper">
                            <div class="uni-swiper-wrapper">
                                <div class="uni-swiper-slides">
                                    <div class="uni-swiper-slide-frame"
                                         style="width: 100%; height: 16.6667%; transform: translate(0px, 0%) translateZ(0px);"></div>
                                </div>
                            </div>
                        </uni-swiper>
                    </uni-view>
                    <?php
                    $rebate = \App\Models\Rebate::first();
                    ?>
                    <uni-view data-v-381b65da="" class="box">
                        <uni-view data-v-381b65da="" class="news">
                            <ul class=" list-paddingleft-2" style="list-style-type: disc;">
                                <li><p>Please copy your invitation link or send your referral code to your friends. You
                                        can earn huge commissions when your friends join farming development.</p></li>
                                <li><p>Recommend your friends to invest and you can directly receive a commission of {{$rebate->interest_commission1}}%
                                        of the investment amount.</p></li>
                                <li><p>Your secondary team investment commission is: {{$rebate->interest_commission2}}%</p></li>
                                <li><p>Your third-level team commission is: {{$rebate->interest_commission3}}%</p></li>
                            </ul>
                        </uni-view>
                    </uni-view>


                    <uni-view data-v-786d2802="" data-v-381b65da="" class="bjAbck" style="display: none;">
                        <uni-view data-v-786d2802="" class="bj"></uni-view>
                        <uni-view data-v-786d2802="" class="share1">
                            <uni-view data-v-786d2802="" class="share2">
                                <uni-view data-v-786d2802="" class="title">Share</uni-view>
                                <uni-view data-v-786d2802="" class="item">
                                    <uni-view data-v-786d2802="" class="l">
                                        <uni-input data-v-786d2802="" class="uni-input">
                                            <div class="uni-input-wrapper">
                                                <input disabled="disabled" maxlength="140" step="" placeholder="{{url('account/register').'?inviteCode='.auth()->user()->ref_id}}"
                                                       autocomplete="off" type="text" class="uni-input-input"></div>
                                        </uni-input>
                                    </uni-view>
                                    <uni-view data-v-786d2802="" class="r">
                                        <uni-text data-v-786d2802="" class="btn" onclick="copyLink('{{url('account/register').'?inviteCode='.auth()->user()->ref_id}}')"><span>Copy</span></uni-text>
                                    </uni-view>
                                </uni-view>
                                <uni-view data-v-786d2802="" class="mtitle">
                                    <uni-view data-v-786d2802="" class="y"></uni-view>
                                    Invite your friends to make money together
                                </uni-view>
                                <uni-view data-v-786d2802="" class="icolist">
                                    <uni-view data-v-786d2802="" class="ico r5" onclick="window.location.href='https://www.whatsapp.com/'">
                                        <uni-view data-v-786d2802="" class="img">
                                            <uni-image data-v-786d2802="">
                                                <div style="background-image: url(data:image/png;base64,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); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                                <img src="data:image/png;base64,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" draggable="false"></uni-image>
                                        </uni-view>
                                        <uni-view data-v-786d2802="" class="text">WhatsApp</uni-view>
                                    </uni-view>
                                    <uni-view data-v-786d2802="" class="ico r5" onclick="window.location.href='https://telegram.org/'">
                                        <uni-view data-v-786d2802="" class="img">
                                            <uni-image data-v-786d2802="">
                                                <div style="background-image: url(data:image/png;base64,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); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                                <img
                                                    src="data:image/png;base64,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"
                                                    draggable="false"></uni-image>
                                        </uni-view>
                                        <uni-view data-v-786d2802="" class="text">Telegram</uni-view>
                                    </uni-view>
                                    <uni-view data-v-786d2802="" class="ico" onclick="window.location.href='https://web.facebook.com'">
                                        <uni-view data-v-786d2802="" class="img">
                                            <uni-image data-v-786d2802="">
                                                <div style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAUKADAAQAAAABAAAAUAAAAAASKG51AAAEgklEQVR4Ae2d329URRTHz5ndbgv9QQuhJBAxItQmptI2NRAMKhHaRhMh9QGi8mCihCgJ70SNvEgCfwEJDwTUJzRaNdk2/DA8Gik1ElNJKg0EUkM2bS3Irtvd45klvV3a7t3tPW3vde+Zl51753xn7/n0zMyde3emCC6pYfcvq0zE7GWTHkBq5s/1AFjrIimDIpoEgrvsyFAG8BvMZHvHLnZMFHIM5yuofu23dZUV6WNIdAgQq+azCc05oiQBnE5NxU48vNTy12y/5wBs6Lr+BmL2KwSsm20c5mMC+jsLeHA83t6bz8HMHBCu7r72GQJ9r/BmqEznLBND8O2a7oGPAcgJPCfT0Hn9HWPoi2mBfroRwPcS8baz1iIHsL5rcJeBTD8iRt1kWvaYABGlOSJfT/S1X8w14Qhkjyq80sODWVWw9RGrwJrOXxtjmBlFRlp6FWpJPKqkIpXrTQVmehTewgPCMotlUvuMQTiwcLkqLAFE2me4Q2xVHB4JEGw33CGGe6bhkZ2VWXZ2FK4U1BF2aWXeTCTsLLz5rwC9cXNUCtBB4S2jAL1xc1QK0EHhLaMAvXFzVIF/+vLcxirY2VoLzU9XwVONMagqcOOQTGVh/yfDjmPLlQkswHe71sCHPY3QxABLSQ+T2VLMFt0mcACr+d7+zLFnYM+LC3ujwJN7X1KgAFp4vaeaYOvmFb7A8PKlgRpEzn26yTM8fj7nSwoMwLdebYBX2v5/r5wDA/CDvWtFEeRXHxgIgKvrItDRXC0C6FcTDsQgsmFtrCi8q4OTufu89JRPnV2BKwxEBNrRt1j6si8BQYNnr7n4lRfzbBHK7YuZYsmvPq7YdQUCYLGLDHK5AhT+dZB/LLOsvfLXn2+GaPTJJlu3MgItz7rPPm7eTsL9iamC7t4fm4L3T9wqWL5UBcs+Cr/0Qi1EIwt3xz5UaHKRXbk26VK6dEVl04Rv3Ppn6Si51Fw+AIcfubi5dEXlA/BPBeg5TP5NE9y8k/SslwjLIgJ/H3kEfs2FywLgDZ+ar43cZb8PnK+57Gipgd6TW+Yrcs4dPjkCF66MOcdByZRFBPoJUwEK6StABSgkIJRrBCpAIQGhXCNQAQoJCOUagQpQSEAo1whUgEICQrlGoAIUEhDKNQIVoJCAUK4RqACFBIRyjUAFKCQglAfipZLQB1/l2oSF+BWgAhQSEMo1AhWgkIBQrhG4CABTwjpCK+ddnyZ4U0YYDS0BoeO8dmXUIMGgsJ7wygmHOALpp/ASkHnOmwzEOQIpLqsmvGpCjJtEf8cQR2FfeDF49Jzgu/F420juNiYN0aNcjY7GpbNMQdp8ZM1zACfjW//gX/seLl0fckuCQ4nLrXa7+JnlrnZfZG7Kx0OOpqj7lhFvf3xu2vDJVX98tr574E0DdN7u3D1tpJ+8dzlvBU9k3h7ra/sxn8ecqVxur3iMPs8LL37INwx13rJgJrPhWSZzIjAfVH3nwMu8mnwXw9zGO9Zu4i3kN7CiJt+m7PIED9jHe7xwZ5j/BcjP2SxeHu9vv1rIz/8A5t8FipdnpgsAAAAASUVORK5CYII=); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                                <img
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAUKADAAQAAAABAAAAUAAAAAASKG51AAAEgklEQVR4Ae2d329URRTHz5ndbgv9QQuhJBAxItQmptI2NRAMKhHaRhMh9QGi8mCihCgJ70SNvEgCfwEJDwTUJzRaNdk2/DA8Gik1ElNJKg0EUkM2bS3Irtvd45klvV3a7t3tPW3vde+Zl51753xn7/n0zMyde3emCC6pYfcvq0zE7GWTHkBq5s/1AFjrIimDIpoEgrvsyFAG8BvMZHvHLnZMFHIM5yuofu23dZUV6WNIdAgQq+azCc05oiQBnE5NxU48vNTy12y/5wBs6Lr+BmL2KwSsm20c5mMC+jsLeHA83t6bz8HMHBCu7r72GQJ9r/BmqEznLBND8O2a7oGPAcgJPCfT0Hn9HWPoi2mBfroRwPcS8baz1iIHsL5rcJeBTD8iRt1kWvaYABGlOSJfT/S1X8w14Qhkjyq80sODWVWw9RGrwJrOXxtjmBlFRlp6FWpJPKqkIpXrTQVmehTewgPCMotlUvuMQTiwcLkqLAFE2me4Q2xVHB4JEGw33CGGe6bhkZ2VWXZ2FK4U1BF2aWXeTCTsLLz5rwC9cXNUCtBB4S2jAL1xc1QK0EHhLaMAvXFzVIF/+vLcxirY2VoLzU9XwVONMagqcOOQTGVh/yfDjmPLlQkswHe71sCHPY3QxABLSQ+T2VLMFt0mcACr+d7+zLFnYM+LC3ujwJN7X1KgAFp4vaeaYOvmFb7A8PKlgRpEzn26yTM8fj7nSwoMwLdebYBX2v5/r5wDA/CDvWtFEeRXHxgIgKvrItDRXC0C6FcTDsQgsmFtrCi8q4OTufu89JRPnV2BKwxEBNrRt1j6si8BQYNnr7n4lRfzbBHK7YuZYsmvPq7YdQUCYLGLDHK5AhT+dZB/LLOsvfLXn2+GaPTJJlu3MgItz7rPPm7eTsL9iamC7t4fm4L3T9wqWL5UBcs+Cr/0Qi1EIwt3xz5UaHKRXbk26VK6dEVl04Rv3Ppn6Si51Fw+AIcfubi5dEXlA/BPBeg5TP5NE9y8k/SslwjLIgJ/H3kEfs2FywLgDZ+ar43cZb8PnK+57Gipgd6TW+Yrcs4dPjkCF66MOcdByZRFBPoJUwEK6StABSgkIJRrBCpAIQGhXCNQAQoJCOUagQpQSEAo1whUgEICQrlGoAIUEhDKNQIVoJCAUK4RqACFBIRyjUAFKCQglAfipZLQB1/l2oSF+BWgAhQSEMo1AhWgkIBQrhG4CABTwjpCK+ddnyZ4U0YYDS0BoeO8dmXUIMGgsJ7wygmHOALpp/ASkHnOmwzEOQIpLqsmvGpCjJtEf8cQR2FfeDF49Jzgu/F420juNiYN0aNcjY7GpbNMQdp8ZM1zACfjW//gX/seLl0fckuCQ4nLrXa7+JnlrnZfZG7Kx0OOpqj7lhFvf3xu2vDJVX98tr574E0DdN7u3D1tpJ+8dzlvBU9k3h7ra/sxn8ecqVxur3iMPs8LL37INwx13rJgJrPhWSZzIjAfVH3nwMu8mnwXw9zGO9Zu4i3kN7CiJt+m7PIED9jHe7xwZ5j/BcjP2SxeHu9vv1rIz/8A5t8FipdnpgsAAAAASUVORK5CYII="
                                                    draggable="false"></uni-image>
                                        </uni-view>
                                        <uni-view data-v-786d2802="" class="text">Facebook</uni-view>
                                    </uni-view>
                                </uni-view>
                                <uni-view data-v-786d2802="" class="qx" onclick="closePopShare()">Cancel</uni-view>
                            </uni-view>
                        </uni-view>
                    </uni-view>


                    @include('app.layout.manu')
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>

<script>
    function closePopShare(){
        document.querySelector('.bjAbck').style.display='none';
    }
    function openPopShare(){
        document.querySelector('.bjAbck').style.display='block';
    }
</script>
@include('alert-message')
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }
</script>
</body>
</html>
