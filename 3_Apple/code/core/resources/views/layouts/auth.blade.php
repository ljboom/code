<html>

<head>
    <meta charset="utf-8">

    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <title> {{ $general->sitename }} - @stack('page_title')</title>
    {{--  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  --}}
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="{{ asset('customv2/register/Lay/css/layui.css') }}">
    <script src="{{ asset('customv2/register/Lay/layui.js') }}"></script>
    <script src="{{ asset('customv2/register/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('customv2/register/Lay/lay/modules/i18n.js') }}"></script>
    <link href="{{ asset('customv2/register/css/main.css?v2.7') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rajdhani&amp;display=swap">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            max-width: 600px;
            margin: 0 auto;
            font: Helvetica Neue, Helvetica, PingFang SC, Tahoma, Arial, sans-serif;
        }

        .layui-form-item .layui-form-checkbox[lay-skin=primary] {
            margin-top: 4px;
        }

        .layui-form-item .layui-form-checkbox[lay-skin=primary] {
            margin-top: 2px;
            padding-left: 22px;
            background: rgba(255, 255, 255, 0.00) !important;
        }


        .layui-form-item .layui-form-checkbox[lay-skin=primary] {
            margin-top: 2px;
            padding-left: 22px;
        }

        .layui-form-checkbox[lay-skin=primary] span {
            padding-left: 0;
            padding-right: 15px;
            line-height: 18px;
            background: 0 0;
            color: #3166fa;
        }

        .layui-form-pane .layui-form-checkbox {
            margin: 5px 3px 4px 2px;
        }

        .layui-form-checked[lay-skin=primary] i {
            border-color: #FED76F !important;
            background: linear-gradient(to right, #FED76F, #ee3810);
            color: #fff;
            border-radius: 5px;
        }

        .layui-form-item .layui-form-checkbox[lay-skin=primary] {
            margin-top: 2px;
            padding-left: 22px;
            background: #ee3810;
        }

        .divxxx {
            width: 60px;
            height: 60px;
            position: fixed;
            z-index: 101;
            top: 15%;
            right: -15px;
        }


        div#div1 {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: -1;
        }

        div#div1>img {
            height: 100%;
            width: 100%;
            border: 0;
        }

        .inputdiv {
            display: flex;
            border: 0px solid #e6e6e6 !important;
            background-color: #fff !important;
            height: 45px;
            line-height: 45px;
            padding: 0px 10px;
            border-radius: 25px;
            color: #000;
            box-shadow: 0 0px 0px 0px rgb(0 0 0 / 30%);
        }

        .layui-input {
            padding: 0px 20px;
            border-style: none;
            /* border-radius: 25px; */
            color: #000 !important;
            background-color: #ddd !important;
        }

        .bgimg {
            position: absolute;
            height: 95%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: auto;
            width: 90%;
            padding: 10px;
            padding-top: 4px;
            background: rgba(255, 255, 255, 0.50);
            color: #000;
            /*  border-width: 1px;
            border-color: #e6e6e6;
            border-style: solid;
            border-radius: 5px;
            box-shadow: 0 5px 15px 0 rgb(0 0 0 / 50%);*/
            border-radius: 5px;
        }


        .topname {
            line-height: 46px;
            font-weight: 700;
            width: 50%;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
        }


        .layui-container {
            position: relative;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .ttt {
            margin: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            margin-top: 200px;
        }


        .layui-btn-disabled,
        .layui-btn-disabled:active,
        .layui-btn-disabled:hover {
            border-color: #eee !important;
            background-color: #FBFBFB !important;
            color: rgb(59, 64, 58) !important;
            cursor: not-allowed !important;
            opacity: 1;
        }

        div#div1 {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: -1;
        }

        div#div1>img {
            height: 100%;
            width: 100%;
            border: 0;
        }
    </style>

</head>


@yield('content')







@stack('script-lib')
@stack('script')

@include('partials.plugins')

@include('partials.notify')

</body>

</html>
