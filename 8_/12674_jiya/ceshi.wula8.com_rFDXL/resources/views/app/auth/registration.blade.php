<html style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description" content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public')}}/register.css">
</head>
<body class="uni-body pages-login-reset">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/login/reset">
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-1dd00f74="" class="content">
                    <uni-view data-v-58c1703b="" data-v-1dd00f74="" class="u-toast"></uni-view>
                    <uni-view data-v-1dd00f74="" class="bj">
                        <uni-view data-v-1dd00f74="" class="lang">Language</uni-view>
                        <uni-image data-v-1dd00f74="" class="login_bj">
                            <div style="background-image: url({{asset('public')}}/static/img/loginbj.2e744fc5.png); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                            <img src="{{asset('public')}}/static/img/loginbj.2e744fc5.png" draggable="false"></uni-image>
                        <uni-image data-v-1dd00f74="" class="logo">
                            <div style="background-image: url({{asset('public')}}/static/img/logo.b086b4ea.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                            <img src="{{asset('public')}}/static/img/logo.b086b4ea.png" draggable="false"></uni-image>
                    </uni-view>
                    <uni-view data-v-1dd00f74="" class="login_con">
                        <form action="{{url('register')}}" method="post">
                            @csrf
                            <uni-view data-v-1dd00f74="" class="login_title">User Registration
                                <uni-text data-v-1dd00f74="" class="inviteCode"><span>{{strtolower(\Illuminate\Support\Str::random(5).rand(0,555))}}</span></uni-text>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_input">
                                <uni-view data-v-1dd00f74="" class="login_input_text"></uni-view>
                                <uni-input data-v-1dd00f74="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="10" step="0.000000000000000001" placeholder="Enter Mobile"
                                               name="phone"
                                               pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input">
                                    </div>
                                </uni-input>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_input">
                                <uni-input data-v-1dd00f74="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="20" step="" placeholder="Enter Password" autocomplete="off" type="password"
                                               name="password"
                                               class="uni-input-input"></div>
                                </uni-input>
                                <uni-view data-v-1dd00f74="" class="login_input_img">
                                    <uni-image data-v-1dd00f74="">
                                        <div style="background-image: url({{asset('public')}}/static/img/showpwd.bcd453fa.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        <img src="{{asset('public')}}/static/img/showpwd.bcd453fa.png" draggable="false"></uni-image>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_input">
                                <uni-input data-v-1dd00f74="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="20" step="" placeholder="Enter Withdrawal Password" autocomplete="off" type="password"
                                               name="withdraw_password"
                                               class="uni-input-input"></div>
                                </uni-input>
                                <uni-view data-v-1dd00f74="" class="login_input_img">
                                    <uni-image data-v-1dd00f74="">
                                        <div style="background-image: url({{asset('public')}}/static/img/showpwd.bcd453fa.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        <img src="{{asset('public')}}/static/img/showpwd.bcd453fa.png" draggable="false"></uni-image>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_input">
                                <uni-view data-v-1dd00f74="" class="login_input_text">
                                    <uni-view data-v-59765974="" data-v-1dd00f74="" class="u-icon u-icon--right">
                                        <uni-text data-v-59765974="" hover-class=""
                                                  class="u-icon__icon uicon-plus-people-fill"
                                                  style="font-size: 22px; line-height: 22px; font-weight: normal; top: 0px; color: rgb(155, 155, 155);">
                                            <span></span></uni-text>
                                    </uni-view>
                                </uni-view>
                                <uni-input data-v-1dd00f74="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="12" step="" placeholder="Enter invitation (Optional)" autocomplete="off" type="text"
                                               name="ref_by"
                                               value="{{isset($ref_by) && !empty($ref_by) && $ref_by != null ? $ref_by : ''}}"
                                               class="uni-input-input"></div>
                                </uni-input>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_input">
                                <uni-view data-v-1dd00f74="" class="login_input_text">
                                    <uni-view data-v-59765974="" data-v-1dd00f74="" class="u-icon u-icon--right">
                                        <uni-text data-v-59765974="" hover-class="" class="u-icon__icon uicon-lock-fill"
                                                  style="font-size: 22px; line-height: 22px; font-weight: normal; top: 0px; color: rgb(155, 155, 155);">
                                            <span></span></uni-text>
                                    </uni-view>
                                </uni-view>
                                <uni-input data-v-1dd00f74="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="6" step="0.000000000000000001" placeholder="Enter OTP"
                                               name="otp"
                                               pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input">
                                    </div>
                                </uni-input>
                                <uni-view data-v-1dd00f74="" class="login_input_send">
                                    <uni-view data-v-1dd00f74="" class="text" onclick='getOtp()'>Send OTP</uni-view>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-1dd00f74="" class="login_btn" onclick="login()">Registration</uni-view>
                            <uni-view data-v-1dd00f74="" class="reg" onclick="window.location.href='{{url('login')}}'">I already have an account</uni-view>
                        </form>
                    </uni-view>
                    <uni-view data-v-67ba0544="" data-v-1dd00f74="">
                        <uni-view data-v-0008f7bc="" data-v-665e262f="" data-v-67ba0544="" class="u-popup">
                        </uni-view>
                    </uni-view>
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
@include('loading')
@include('alert-message')
<script>
    function login() {
        document.querySelector('.loadingClass').style.display='block';

        if (document.querySelector('input[name="phone"]').value == ''){
            message('Incorrect Info');
            document.querySelector('.loadingClass').style.display='none';
            return 0;
        }
        if (document.querySelector('input[name="otp"]').value == ''){
            message('Incorrect Otp');
            document.querySelector('.loadingClass').style.display='none';
            return 0;
        }
        document.querySelector('form').submit();
    }

    function getOtp() {
        if (document.querySelector('input[name="phone"]').value == ''){
            message('Enter phone cellphone number');
            return 0;
        }
        document.querySelector('.loadingClass').style.display='block';
        setTimeout(function (){
            document.querySelector('.loadingClass').style.display='none';
            document.querySelector('input[name="otp"]').value = '{{rand(0,9999)}}';
        }, 1000)
    }

    function eye() {
        var pass = document.querySelector('input[name="password"]').value;
        if (pass.type == 'password') {
            pass.type = 'text'
        } else {
            pass.type = 'password'
        }
    }
</script>
</body>
</html>
