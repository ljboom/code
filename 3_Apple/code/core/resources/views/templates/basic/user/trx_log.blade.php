@extends('layouts.users')


@section('content')
    <style type="text/css">
        .topname {
            line-height: 46px;
            font-weight: bold;
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
        }

        .typeitem {
            float: left;
            width: 45%;
            height: auto;
            overflow: hidden;
        }

        .over {
            border-bottom: 1px solid #666;
        }
    </style>


    <style type="text/css">
        div {
            cursor: pointer;
        }

        .payitem {
            border: 1px solid #dd3333 !important;
            border-radius: 5px;
        }

        .payitem:before {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            border: 14px solid #dd3333;
            border-top-color: transparent;
            border-left-color: transparent;
            border-bottom-right-radius: 5px;
        }

        .payitem:after {
            content: '';
            width: 3px;
            height: 7px;
            position: absolute;
            right: 5px;
            bottom: 6px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-left-color: transparent;
            transform: rotate(45deg);
            border-bottom-right-radius: 5px;
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

        .typeitemover {
            color: #fff;
            border-bottom: 1px solid #fff;
            float: left;
            margin-left: 3.5%;
            font-weight: bold;
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




        .layui-m-layercont {
            padding: 30px 15px;
            padding-top: 5px;
            line-height: 22px;
            text-align: center;
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
            filter: blue;
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

        .green_ {
            width: 98%;
            border: 1px solid #7bf2a6;
            border-radius: 10px;
            background: #00b578;
            height: auto;
            overflow: hidden;
            box-shadow: 0 1px 1px 0 rgb(0 0 0 / 10%);
            color: #fff;
        }

        .red_ {
            width: 98%;
            border: 1px solid #fcdbdb;
            border-radius: 10px;
            background: #fa5151;
            height: auto;
            overflow: hidden;
            box-shadow: 0 1px 1px 0 rgb(0 0 0 / 10%);
            color: #fff;
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

        .s_btn {
            margin: auto;
            width: 80%;
            height: 30px;
            background: #fa5151;
            border-radius: 2.13333vw;
            font-family: Source Han Sans CN-Bold, Source Han Sans CN;
            font-weight: 700;
            color: #fff;
            line-height: 8.8vw;
            letter-spacing: 1.06667vw;
        }

        .small-font {
            font-size: 12px;
            -webkit-transform-origin-x: 0;
            -webkit-transform: scale(0.80);
        }

        .smallsize-font {
            font-size: 9.6px;
        }

        .cmbtn {
            width: 60%;
            cursor: pointer;
            font-size: 14px;
            height: 40px;
            line-height: 40px;
            margin-top: 20px;
            border-radius: 20px !important;
            color: #fff;
            margin: 0 auto;
            background: rgb(42, 175, 254);
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
        </script>
        <div style="width: 100%; margin: 0 auto; background: #191A1F; border-bottom: 0px solid #000 " class="top">
            <div onclick="window.history.go(-1); return false;"
                style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
                <i class="layui-icon" style=" color:#fff; margin-left:12px; font-size:18px;  font-weight:bold;"></i>
            </div>
            <font class="topname" style="color: #fff;">
                تفاصيل الحساب
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">

            </div>
        </div>

        <div style=" max-width:450px; margin:0 auto;">
            <div style=" width:100%;margin:0 auto;margin-top:56px;color:#fff;position:relative;">
                <div
                    style=" width: 100%; margin: 0 auto; margin-top: 55px; text-align: center; background: #191A1F; color: #fff; position: relative; height: auto; overflow: hidden;">
                    <div class="typeitem over" id="1" onclick="toggleRecord(1)">
                        <div style="padding: 10px; height: 30px; line-height:30px; overflow: hidden;">سجلات الدخل</div>
                    </div>
                    <div class="typeitem" id="2" onclick="toggleRecord(2)">
                        <div style="padding: 10px; height: 30px; line-height: 30px; overflow: hidden; ">سجلات السحب
                        </div>
                    </div>
                </div>
            </div>
            <div style=" width:100%;margin:0 auto; position:relative;" id="record1">
                @forelse ($logs as $k => $data)
                    <div
                        style="height:auto;overflow:hidden;color:#222;background:#191A1F;margin:0 auto; width:100%; margin-top:5px;">
                        <div style="padding:10px; border-bottom: 1px solid #444; height: auto; overflow: hidden;">
                            <div style="float:left;width:55%; margin-left:5%">
                                <div style="height:27px; line-height:27px;">
                                    <span
                                        style="padding:3px; padding-left: 0px;padding-right:10px;border-radius: 10px; color: #fff">
                                        {{ $data->details }}
                                    </span>
                                </div>
                                <div style="height:27px; line-height:27px;font-size:12px; color:#999;">
                                    {{ $data->created_at->format('M d Y h:i') }}
                                </div>
                            </div>
                            <div style="float:left;width:35%; text-align:right; margin-right:5%">
                                <div
                                    style="height:27px; line-height:27px; font-size:12px; font-weight: bold;color: #35C75A;">
                                    {{ $data->trx_type }}EGP{{ number_format($data->amount, 2) }}
                                </div>
                                <div style="height:27px; line-height:27px;font-size:12px;color:#999;">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding:2px; width:100%; margin:0 auto; margin-top:50px;">
                        <div style="border-radius: 5px; color:#fff; text-align:center; margin-top:35px;position:relative;">
                            <img src="{{ asset('customv2/history/imgs/no.png') }}" style="width:100%;">
                            <br>
                        </div>
                    </div>
                @endforelse

                <p style="text-align: center; padding: 20px; color: #fff">لا مزيد من البيانات</p>
            </div>
            <div style=" width:100%;margin:0 auto; position:relative; display: none" id="record2">

                @forelse ($withdraws as $k => $data)
                    <div
                        style="height:auto; overflow:hidden; color:#333; background:#191A1F; margin:0 auto; width:100%; margin-top:10px;">
                        <div style="padding:10px; border-bottom: 1px solid #eee; height:auto; overflow:hidden;">
                            <div style="float:left; width:45%; margin-left:5%;">
                                <div style="height:27px; line-height:27px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#fff;">
                                        {{ $data->trx }}
                                    </span>
                                </div>
                                <div style="height:27px; line-height:27px; font-size:12px; color:#888;">
                                    Withdraw
                                </div>
                                <div style="height:27px; line-height:27px; font-size:12px; color:#888;">

                                    {{ $data->created_at->format('M d Y h:i') }}
                                </div>
                            </div>
                            <div style="float:left; width:45%; text-align:right; margin-right:5%;">
                                <div style="height:27px; line-height:27px; font-size:12px; font-weight:200; color:#fff;">
                                    EGP {{ number_format($data->amount) }}
                                </div>
                                <div style="height:27px; line-height:27px; font-size:12px; color:#888;">
                                    &nbsp;
                                </div>
                                <div style="height:27px; line-height:27px; font-size:12px; color:#888;">
                                    @if ($data->status == 1)
                                        <span style="color: green">نجاح</span>
                                    @elseif ($data->status == 2)
                                        <span style="color: #db9d00">جاري السحب</span>
                                    @else
                                        <span style="color: red">فشل</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding:2px; width:100%; margin:0 auto; margin-top:50px;">
                        <div style="border-radius: 5px; color:#fff; text-align:center; margin-top:35px;position:relative;">
                            <img src="{{ asset('customv2/history/imgs/no.png') }}" style="width:100%;">
                            <br>
                        </div>
                    </div>
                @endforelse
                <p style="text-align: center; padding: 20px; color: #fff">لا مزيد من البيانات</p>
            </div>
        </div>
        <script>
            function toggleRecord(id) {
                var elements = document.querySelectorAll('.typeitem');
                elements.forEach(function(element) {
                    element.classList.remove('over');
                });

                var clickedElement = document.getElementById(id);
                clickedElement.classList.add('over');

                if (id === 1) {
                    document.getElementById('record1').style.display = 'block';
                    document.getElementById('record2').style.display = 'none';
                } else {
                    document.getElementById('record1').style.display = 'none';
                    document.getElementById('record2').style.display = 'block';
                }
            }
        </script>

    </body>
@endsection
