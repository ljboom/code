<html style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="static/login/logo.png">
    <meta name="description" content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public/login.css')}}">
</head>
<body class="uni-body pages-login-login">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/login/login">
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-7b5b23e8="" class="content">
                    <uni-view data-v-58c1703b="" data-v-7b5b23e8="" class="u-toast"></uni-view>
                    <uni-view data-v-7b5b23e8="" class="bj">
                        <uni-view data-v-7b5b23e8="" class="lang">Language</uni-view>
                        <uni-image data-v-7b5b23e8="" class="login_bj">
                            <div style="background-image: url({{asset('public')}}/static/img/loginbj.2e744fc5.png); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                            <img src="{{asset('public')}}/static/img/loginbj.2e744fc5.png" draggable="false"></uni-image>
                        <uni-image data-v-7b5b23e8="" class="logo">
                            <div style="background-image: url({{asset('public')}}/static/img/logo.b086b4ea.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                            <img src="{{asset('public')}}/static/img/logo.b086b4ea.png" draggable="false"></uni-image>
                    </uni-view>
                    <uni-view data-v-7b5b23e8="" class="login_con">
                        <form action="{{url('login')}}" method="post">
                            @csrf

                            <uni-view data-v-7b5b23e8="" class="login_title">Sign In</uni-view>
                            <uni-view data-v-7b5b23e8="" class="login_input">
                                <uni-view data-v-7b5b23e8="" class="login_input_text"></uni-view>
                                <uni-input data-v-7b5b23e8="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input placeholder="Enter phone Number"
                                               name="phone"
                        type="text" class="uni-input-input">
                                    </div>
                                </uni-input>
                            </uni-view>
                            <uni-view data-v-7b5b23e8="" class="login_input">
                                <uni-input data-v-7b5b23e8="" class="login_input_t">
                                    <div class="uni-input-wrapper">
                                        <input maxlength="140" step="" placeholder="Enter you password" autocomplete="off"
                                               name="password"
                                               type="password" class="uni-input-input"></div>
                                </uni-input>
                                <uni-view data-v-7b5b23e8="" class="login_input_img">
                                    <uni-image data-v-7b5b23e8="">
                                        <div style="background-image: url({{asset('public')}}/static/img/showpwd.bcd453fa.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        <img src="{{asset('public')}}/static/img/showpwd.bcd453fa.png" draggable="false"></uni-image>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-7b5b23e8="" class="forgot">
                                <uni-text data-v-7b5b23e8=""><span>Forgot Password?</span></uni-text>
                            </uni-view>
                            <uni-view data-v-7b5b23e8="" class="login_btn" onclick="login()">Sign In</uni-view>
                            <uni-view data-v-7b5b23e8="" class="reg">Dont have an Account? <span style="text-decoration: underline" onclick="window.location.href='{{url('account/register/')}}'">Register</span></uni-view>

                        </form>
                    </uni-view>
                    <uni-view data-v-67ba0544="" data-v-7b5b23e8="">
                        <uni-view data-v-0008f7bc="" data-v-665e262f="" data-v-67ba0544="" class="u-popup">
                        </uni-view>
                    </uni-view>
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
@include('loading')
</uni-app>
@include('alert-message')
<script>
    function login(){
        document.querySelector('.loadingClass').style.display='block';
        document.querySelector('form').submit();
    }
</script>
</body>
</html>
