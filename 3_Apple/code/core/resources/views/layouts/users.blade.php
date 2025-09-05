<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="google" content="notranslate">
    <title>{{ $general->sitename }} - @stack('page_title')</title>


    <link href="{{ asset('customv2/dashboard/Lay/css/layui.css?v1.6') }}" rel="stylesheet">
    <link href="{{ asset('customv2/dashboard/css/main.css?v2.7') }}" rel="stylesheet">
    <link href="{{ asset('customv2/dashboard/layer_mobile/need/layer.css?v1.6') }}" rel="stylesheet">
    <script src="{{ asset('customv2/dashboard/Lay/layui.js?v1.6') }}"></script>
    <script src="{{ asset('customv2/dashboard/js/comm.js?v1.6') }}"></script>
    <link href="{{ asset('customv2/dashboard/css/video-js.min.css') }}" rel="stylesheet">
    <script src="{{ asset('customv2/dashboard/js/video.min.js') }}"></script>
    <style type="text/css">
        html,
        body {
            width: 100%;
            height: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .small-font {
            font-size: 12px;
            -webkit-transform-origin-x: 0;
            -webkit-transform: scale(0.80);
        }

        .smallsize-font {
            font-size: 9.6px;
        }

        .tblue {
            background: #1476ff !important;
        }

        .tgreen {
            background: #4caf50 !important;
        }

        .tred {
            background: #f44336 !important;
        }

        .tzs {
            background: #6739b6 !important;
        }

        .tss {
            font-weight: bold;
            font-size: 17px;
            text-align: center;
            border: 0px;
            color: #fff;
            height: 45px;
            line-height: 45px;
            border-radius: 10px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .typeitem {
            color: #999;
            float: left;
            margin-left: 2.5%;
            cursor: pointer;
            margin-bottom: 2px;
        }

        .layui-carousel>[carousel-item]>* {
            display: none;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #f1f1f1;
            transition-duration: .3s;
            -webkit-transition-duration: .3s;
        }

        .typeitemover {
            color: #fff;
            border-bottom: 1px solid #fff;
            float: left;
            margin-left: 2.5%;
            cursor: pointer;
            margin-bottom: 1px;
        }

        .top1 {
            position: fixed;
            background: #fff;
            z-index: 10000;
            width: 100%;
            height: 30px;
            top: -30px;
        }

        .aui {
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .scroll-wrapper {
            -webkit-overflow-scrolling: touch;
            overflow-y: scroll;
        }

        .aui li {
            width: 33.33%;
            float: left;
            padding: 5px 0;
        }

        .aui li img {
            display: block;
            margin: 0 auto;
            width: auto;
            height: 45px;
        }

        .aui li p {
            text-align: center;
            font-size: 14px;
            margin-top: 5px;
            color: #566172;
            font-family: MicrosoftYaHei;
        }

        .announcement-title {
            text-align: left;
            font-size: 20px;
            font-weight: 600;
            color: #434343;
            margin-left: 5%;
        }

        .layui-m-layercont {
            padding: 30px 15px;
            padding-top: 10px;
            line-height: 22px;
            text-align: center;
        }

        .layui-m-layerbtn span[yes] {
            color: rgb(58, 114, 198) !important
        }

        .layui-m-layerchild {
            box-shadow: 8px 8px 8px rgb(0 0 0 / 60%);
        }

        .navtab {
            cursor: pointer;
        }

        .gray {
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            filter: grayscale(100%);
            filter: gray;
        }

        layer-page .layui-layer-btn {
            padding-top: 0px !important;
        }

        .layui-layer-btn {
            text-align: center !important;
            padding: 0 0px 12px;
            pointer-events: auto;
            user-select: none;
            -webkit-user-select: none;
        }

        .layui-layer-btn a {
            margin: 5px 5px 0;
            padding: 0 0px !important;
            height: 28px;
            line-height: 28px;
            text-align: center;
            width: 50%;
            border: 1px solid #dedede;
            background-color: #fff;
            color: #333;
            border-radius: 2px;
            font-weight: 400;
            cursor: pointer;
            text-decoration: none;
            border-radius: 20px !important;
        }

        .layui-layer-page {
            border-radius: 20px !important;
        }

        .layui-layer-btn .layui-layer-btn0 {
            border-color: #e7d1a6 !important;
            background-image: linear-gradient(6deg, #ccaa78 21%, #e7d1a6 77%) !important;
            color: #fff;
        }

        .navtab {
            cursor: pointer;
        }


        .topname {
            line-height: 46px;
            font-weight: 700;
            font-size: 16px;
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

        .cmbtn {
            width: 100%;
            cursor: pointer;
            font-size: 18px;
            height: 40px;
            line-height: 40px;
            margin-top: 20px;
            border-radius: 5px !important;
            color: #000;
            margin: 0 auto;
            background: #FFF;
            font-weight: bold;
        }

        .indexdiv {
            background: #000000;
            position: fixed;
            left: 0px;
            top: 0px;
            bottom: 0px;
            width: 100%;
            height: 100%;
            z-index: 101;
            filter: alpha(opacity=90);
            opacity: 0.90 !important;
            display: none;
        }

        .divWrap {
            width: 100%;
            overflow: hidden;
        }

        .div {
            display: inline-block;
            white-space: nowrap;
            animation: 5s div linear infinite normal;
        }

        div {
            cursor: pointer;
        }

        @keyframes marqueeAnim {
            0% {
                transform: translateX(100vw);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .marquee-content {
            white-space: nowrap;
            display: inline-block;
            animation: marqueeAnim 5s linear 0s infinite;
        }

        .marquee-root {
            width: 100%;
            text-align: left;
            overflow: hidden;
        }
    </style>

    <link id="layuicss-layer" rel="stylesheet"
        href="{{ asset('customv2/dashboard/Lay/css/modules/layer/default/layer.css?v=3.1.1') }}" media="all">
    <link id="layuicss-laydate" rel="stylesheet"
        href="{{ asset('customv2/dashboard/Lay/css/modules/laydate/default/laydate.css?v=5.0.9') }}" media="all">


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.9.21/css/layui.css"
        integrity="sha512-zaj280vn612WMqoKaMNLpGcAVZpSMatiM7MTFwYAHB0dMygshkMFc7hNgO/3IL2ngwwsVdsFEEvNIJOkxEk9VQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.9.21/layui.min.js"
        integrity="sha512-+3nec9IwGC0wwTDP5fSYrOKci7ZtmIev1Ke49YNClP6u2eZoPN7LGXmxZYRd2YZJ9x9rbrWZ3yScu2PSfzkCmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style class="vjs-styles-defaults">
        .video-js {
            width: 300px;
            height: 150px;
        }

        .vjs-fluid {
            padding-top: 56.25%
        }
    </style>


</head>


<body>

    @yield('content')



</body>



@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')


</html>
