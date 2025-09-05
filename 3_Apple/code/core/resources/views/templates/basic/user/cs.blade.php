@extends('layouts.users')

@push('style-lib')
@endpush

@section('content')
    <style type="text/css">
        .topname {
            line-height: 46px;
            font-size: 14px;
            width: 75%;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            font-weight: bold;
        }

        div {
            cursor: pointer;
        }

        .typeitem {
            color: #888;
            float: left;
            margin-left: 3%;
            cursor: pointer;
            font-family: 黑体;
            font-size: 13px;
            margin-top: 10px;
            margin-bottom: 2px;
        }

        .typeitemover {
            margin-top: 10px;
            color: #085efa;
            border-bottom: 1px solid #085efa;
            margin-bottom: 1px;
            float: left;
            margin-left: 3%;
            cursor: pointer;
            font-family: 黑体;
            font-size: 13px;
        }
    </style>

    <body style="background-size: 100% auto; background: #000;">
        <div style="width: 100%; height: 100%; background: rgb(255, 255, 255); position: fixed; top: 0px; left: 0px; z-index: 99999; display: none;"
            id="loader">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div class="loader">
                    <img src="{{ asset('images/loader.gif') }}" style="width: 40px;">
                </div>
            </div>
        </div>
        <style>
            .colored {
                filter: invert(75%) sepia(30%) saturate(350%) hue-rotate(336deg) brightness(180%) contrast(90%);
            }


            /* .loader {
                 --R: 20px;
                 --g1: #514b82 96%, #0000;
                 --g2: #ffffff 96%, #0000;
                 width: calc(2*var(--R));
                 aspect-ratio: 1;
                 border-radius: 50%;
                 display: grid;
                 -webkit-mask: linear-gradient(#000 0 0);
                 animation: l30 2s infinite linear;
                }
                .loader::before,
                .loader::after{
                 content:"";
                 grid-area: 1/1;
                 width: 50%;
                 background:
                   radial-gradient(farthest-side,var(--g1)) calc(var(--R) + 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
                   radial-gradient(farthest-side,var(--g1)) calc(var(--R) + 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
                   radial-gradient(farthest-side,var(--g2)) calc(var(--R) + 0.5*var(--R)   - var(--R)) calc(var(--R) - 0.866*var(--R) - var(--R)),
                   radial-gradient(farthest-side,var(--g1)) 0 calc(-1*var(--R)),
                   radial-gradient(farthest-side,var(--g2)) calc(var(--R) - 0.5*var(--R)   - var(--R)) calc(var(--R) - 0.866*var(--R) - var(--R)),
                   radial-gradient(farthest-side,var(--g1)) calc(var(--R) - 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
                   radial-gradient(farthest-side,var(--g2)) calc(-1*var(--R))  0,
                   radial-gradient(farthest-side,var(--g1)) calc(var(--R) - 0.866*var(--R) - var(--R)) calc(var(--R) + 0.5*var(--R)   - var(--R));
                  background-size: calc(2*var(--R)) calc(2*var(--R));
                  background-repeat :no-repeat;
                }
                .loader::after {
                transform: rotate(180deg);
                transform-origin: right;
                }

                @keyframes l30 {
                 100% {transform: rotate(-1turn)}
                }

                .image-filter {
                    filter: hue-rotate(180deg) saturate(300%) brightness(120%);
                } */
        </style>
        <script>
            // Function to show the loader for 6 seconds
            function showLoaderFor2Seconds() {
                const loader = document.getElementById('loader');
                loader.style.display = 'block';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 400);
            }

            function showLoader() {
                const form = document.querySelector('form');
                form.addEventListener('submit', function(event) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = true;
                    submitButton.style.backgroundColor = '#ccc';
                });
            }

            document.addEventListener('DOMContentLoaded', showLoader);
            document.addEventListener('DOMContentLoaded', function() {
                // Get all <a> tags
                const links = document.querySelectorAll('aaaa');

                // Add click event listener to each <a> tag
                links.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        showLoaderFor2Seconds(); // Call the function to show the loader
                    });
                });
            });

            showLoaderFor2Seconds()
        </script><input type="hidden" id="telegram" value="https://t.me/appleinetelservice001">
        <input type="hidden" id="whatsapp" value="https://chat.whatsapp.com/CCC">
        <input type="hidden" id="techannel" value="https://t.me/appleintelgroup">
        <input type="hidden" id="telgroup" value="https://t.me/Officialchannelappleintel">
        <input type="hidden" id="whatsgroup" value="https://chat.whatsapp.com/CCC">

        <div style="width: 100%; margin: 0 auto; background: #191A1F; border-bottom: 0px solid #000 " class="top">
            <div onclick="window.history.go(-1); return false;"
                style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
                <i class="layui-icon" style=" color:#fff; margin-left:12px; font-size:18px;  font-weight:bold;"></i>
            </div>
            <font class="topname" style="color: #fff">
                Customer service
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">

            </div>
        </div>
        <div style=" max-width:450px; margin:0 auto; margin-top:60px;">

            <div style="width: 95%; margin:0 auto;">
                <div style="background: #191A1F; border-radius: 5px;">
                    <div style="width: 100%; margin: 0 auto; color: #FFF; height: 55px; margin-top: 10px; line-height: 55px; height: auto; overflow: hidden;"
                        id="btn1">
                        <div style="float:left;width:25%; text-align:center;">
                            <img src="{{ asset('iconsv2/telegram.svg') }}" style="height:35px;">
                        </div>
                        <div style="float:left;width:65%;">Telegram</div>
                        <div style="float:left;width:10%;">
                            <img src="{{ asset('customv2/cs/ui/jt.png') }}" style="height:20px;">
                        </div>
                    </div>

                    <div style="width: 100%; margin: 0 auto; color: #FFF; height: 55px; margin-top: 10px; line-height: 55px; height: auto; overflow: hidden; display: none"
                        id="btn2">
                        <div style="float:left;width:25%; text-align:center;">
                            <img src="{{ asset('customv2/cs/ui1/kf/2.png') }}" style="height:35px;">
                        </div>
                        <div style="float:left;width:65%;">WhatsApp</div>
                        <div style="float:left;width:10%;">
                            <img src="{{ asset('customv2/cs/ui/jt.png') }}" style="height:20px;">
                        </div>
                    </div>

                    <div style="width: 100%; margin: 0 auto; color: #FFF; height: 55px; margin-top: 10px; line-height: 55px; height: auto; overflow: hidden;"
                        id="btn3">
                        <div style="float:left;width:25%; text-align:center;">
                            <img src="{{ asset('iconsv2/telegram.svg') }}" style="height:35px;">
                        </div>
                        <div style="float:left;width:65%;">Telegram channel</div>
                        <div style="float:left;width:10%;">
                            <img src="{{ asset('customv2/cs/ui/jt.png') }}" style="height:20px;">
                        </div>
                    </div>

                    <div style="width: 100%; margin: 0 auto; color: #FFF; height: 55px; margin-top: 10px; line-height: 55px; height: auto; overflow: hidden;"
                        id="btn4">
                        <div style="float:left;width:25%; text-align:center;">
                            <img src="{{ asset('iconsv2/telegram.svg') }}" style="height:35px;">
                        </div>
                        <div style="float:left;width:65%;">Telegram group</div>
                        <div style="float:left;width:10%;">
                            <img src="{{ asset('customv2/cs/ui/jt.png') }}" style="height:20px;">
                        </div>
                    </div>

                    <div style="width: 100%; margin: 0 auto; color: #FFF; height: 55px; display: none; margin-top: 10px; line-height: 55px; "
                        id="btn5">
                        <div style="float:left;width:25%; text-align:center;">
                            <img src="{{ asset('customv2/cs/ui4/Viber-Logo.png') }}" style="height:35px;">
                        </div>
                        <div style="float:left;width:65%;">Viber group</div>
                        <div style="float:left;width:10%;">
                            <img src="{{ asset('customv2/cs/ui/jt.png') }}" style="height:20px;">
                        </div>
                    </div>
                </div>

            </div>


            <div
                style="width: 95%; margin: 0 auto; background: #191A1F; border-radius: 5px; height: auto; overflow: hidden; margin-top: 10px; margin-bottom: 15px; z-index: 999999">
                <div
                    style="padding: 15px; color: #fff; font-size: 20px; font-family: DengXian; padding-bottom: 5px; text-align: center; ">
                    09:00-18:00
                </div>
                <div
                    style="padding: 10px; color: #fff; padding-top: 0px; font-size: 14px; text-align: center; font-family: DengXian; ">
                    Customer service time online
                </div>
                <div style="padding: 25px; color: #fff; padding-top: 0px; font-size: 12px; text-align: left; ">
                    1. If you have any questions about our platform, please contact our online customer service and he will
                    answer all your questions.<br>
                    2. If our online customer service does not respond to your message in time, please wait patiently. This
                    is because there are too many messages. Our online customer service will reply to your message as soon
                    as possible. Thank you for your understanding and support!<br>
                    3. Official personnel will not ask you for your login password, please pay attention to account
                    security.
                </div>
            </div>
        </div>

    </body>
@endsection


@push('script')
    <script type="text/javascript"></script>
@endpush
