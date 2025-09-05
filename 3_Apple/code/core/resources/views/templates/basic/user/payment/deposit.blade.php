@extends('layouts.users')


@section('content')
    <style type="text/css">
        input::placeholder {
            color: #333;
        }

        h3 {
            color: #fff !important;
            font-weight: bold;
        }

        .layui-m-layerbtn span[no] {
            border-right: 1px solid #D0D0D0;
            border-radius: 0 0 0 5px;
            color: #000 !important;
        }

        .layui-m-layerbtn span[yes] {
            color: orange !important;
            font-weight: bold;
        }

        .layui-m-layerchild {
            color: #fff !important;
            position: relative;
            display: inline-block;
            text-align: left;
            background-color: #35C75A;
            font-size: 14px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgb(0 0 0 / 10%);
            pointer-events: auto;
            -webkit-overflow-scrolling: touch;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation-duration: .2s;
            animation-duration: .2s;
        }

        .topname {
            line-height: 46px;
            font-weight: bold;
            font-size: 14px;
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

        .bofang {
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            height: 30px;
            border-radius: 100px;
        }

        .layui-border-green {
            border-color: #009688 !important;
            color: #009688 !important;
        }

        .layui-border-red {
            border-color: #FF5722 !important;
            color: #FF5722 !important;
        }

        .layui-border-blue {
            border-color: #1E9FFF !important;
            color: #1E9FFF !important;
        }

        .layui-form-item {
            margin-bottom: 10px;
            clear: both;
            *zoom: 1;
        }

        .layui-m-layercont {
            padding: 30px 15px;
            padding-top: 5px;
            line-height: 22px;
            text-align: center;
        }

        .layui-m-layerbtn span[yes] {
            color: #009688;
        }


        .layui-m-layercont {
            padding: 30px 15px;
            padding-top: 5px;
            line-height: 22px;
            text-align: center;
        }

        .layui-m-layerbtn span[yes] {
            color: #009688;
        }

        .payitem {
            border: 1px solid #fff !important;
            border-radius: 25px;
            background: #fff;
            color: #000 !important;
        }

        .payitem:before {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            background: #fff;
            /* border: 16px solid #0081ff;
                border-top-color: transparent;
                border-left-color: transparent;
                border-bottom-right-radius: 3px;*/
        }

        .payitem:after {
            content: '';
            width: 5px;
            height: 12px;
            position: absolute;
            right: 6px;
            bottom: 6px;
            background: #fff;
            /*  border: 2px solid #fff;
                border-top-color: transparent;
                border-left-color: transparent;
                transform: rotate(45deg);
                border-bottom-right-radius: 5px;*/
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
            border-bottom: 0px solid #fff !important;
            background-color: none;
            height: 38px;
            line-height: 38px;
            padding: 0px 0px;
            /*border-radius: 5px;*/
            color: #000;
        }

        .layui-input {
            border-style: none;
            background-color: none;
        }

        .small-font {
            font-size: 12px;
            -webkit-transform-origin-x: 0;
            -webkit-transform: scale(0.80);
        }

        .smallsize-font {
            font-size: 9.6px;
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
        <style>
            a:hover {
                filter: invert(1);
            }
        </style>

        <div class="top" style="background: #191A1F;">
            <div onclick="window.history.go(-1); return false;" style="float:left; line-height:46px;width:50%; height:46px;cursor:pointer;" id="btnClose">
                <i class="layui-icon" style=" color:#fff; margin-left:12px; font-size:18px;  font-weight:bold;"></i>
            </div>
            <div class="topname" style="line-height: 50px; font-weight: bold; color: #fff;">
                Recharge
            </div>
            <div onclick="window.location.href='{{ route('user.deposit.history') }}'" style="float:right; text-align:right; line-height:46px;width:50%;" id="log">
                <img src="{{ asset('customv2/deposit/imgss/iconlog.png') }}"
                    style="height: 27px;  margin-right: 10px; margin-bottom: 2px; border-radius: 50px;">
            </div>
        </div>

        <div style=" max-width:450px; margin:0 auto; position:relative;">
            <div style=" height:auto; overflow:hidden;">
                <div style="width: 100%; margin: 0 auto; background: #000;">
                    <div
                        style="width: 100%; position: absolute; left: 0%; top: 5px; margin-top: 5px; margin-top: 10px; padding-bottom: 3px; border-radius: 2px; height: auto; overflow: hidden;">
                        <div style="width: 100%; margin: 0 auto; overflow: hidden; position: relative; margin-top:40px; ">
                            <img src="{{ asset('images/img06.jpg') }}"
                                style="width: 100%; border-radius: 5px; margin-bottom: 5px">
                        </div>
                        <form method="POST" action="{{ route('user.deposit.insert') }}">
                            <input type="hidden" name="currency">
                            <input type="hidden" name="deposit_method" value="1">
                            <div
                                style="width: 100%; margin: 0 auto; padding-top: 10px; padding-bottom: 10px; height: auto; overflow: hidden; background: #000 ">
                                <div style=" width: 95%; margin: 0 auto; ">
                                    <div
                                        style="width: 100%; margin: 0 auto; margin-top: 10px; padding-top: 10px; padding-bottom: 10px; height: auto; overflow: hidden; ">
                                        <div style="padding-left:5px; padding-bottom:10px;">
                                            <font style="font-weight: bold; color: #fff;">Minimun recharge </font>
                                            <font style="color: #fff; " class="small-font">（is 2,800）</font>
                                        </div>
                                    </div>
                                    <div
                                        style="text-align: center;  width: 98%; margin: 0 auto; margin-bottom: 10px; margin-top: 2px; height: auto; overflow: hidden; display: none">
                                        <button id="jk"
                                            style="width: 100%; font-size: 14px; color: #000; height: 45px; line-height: 20px; font-size: 12px; border-radius: 50px; border: 0px; background: #fff; "
                                            type="button">
                                            If your recharge order does not arrive,<br> please click this button to upload
                                            the recharge voucher
                                        </button>
                                    </div>
                                    <div class="layui-form-item"
                                        style="padding-bottom: 10px; height: auto; overflow: hidden; ">
                                        <div style="width: 98%; margin: 0 auto; height: auto; overflow: hidden; ">
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="2800" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 2800
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="8800" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 8800
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="18000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 18000
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="28000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 28000
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="58000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 58000
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="108000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 108000
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="280000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 280000
                                                </div>
                                            </label>
                                            <label
                                                style="width:24%; float:left;margin-left:1%;background:none; margin-top:10px;cursor:pointer;border:0px; text-align:center;">
                                                <input type="radio" name="money" value="580000" hidden="">
                                                <div style="border: 1px solid #fff; padding:7px; color: #fff; padding-left:0px; padding-right:0px; border-radius: 5px;"
                                                    class="item">
                                                    <i class="layui-icon" style="font-size:12px;"></i> 580000
                                        </div>
                                    </div>
                                </div>
                                {{--  <div
                                    style="width: 95%; margin: 0 auto; padding-top: 10px; padding-bottom: 5px; border-radius: 5px; height: auto; overflow: hidden; background: #000;">
                                    <div
                                        style="padding-left: 0px; padding-bottom: 10px; font-weight: bold; color: #fff; height: auto; overflow: hidden;">
                                        Recharge channels</div>
                                    <p
                                        style="font-size: 12px; text-align: center; font-weight: 500; color: rgb(248, 157, 0);">
                                        For <span style="font-weight: 800">Bank Transfer 5, </span>avoid closing or
                                        refreshing the page until your balance reflected.
                                    </p>

                                    <div
                                        style=" height: auto; overflow: hidden; color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: space-between">
                                        <div style="width:95%;border: 1px solid #fff;cursor:pointer; height:40px;line-height:20px; float:left; margin-top:10px; text-align:center;position: relative;border-radius: 5px;"
                                            class="payitem channelitem">
                                            <input type="radio" name="channel" value="bank1" style="display: none;"
                                                checked="">
                                            <label
                                                style=" padding-top:10px; font-size:12px; padding-bottom:10px; display: block;">Bank
                                                Transfer 1</label>
                                        </div>
                                        <div style="width:95%;border: 1px solid #fff;cursor:pointer; height:40px;line-height:20px; float:left; margin-top:10px; text-align:center;position: relative;border-radius: 5px;"
                                            class="channelitem">
                                            <input type="radio" name="channel" value="monnify-ngn"
                                                style="display: none;">
                                            <label
                                                style=" padding-top:10px; font-size:12px; padding-bottom:10px; display: block;">Bank
                                                Transfer 5</label>
                                        </div>
                                    </div>
                                </div>  --}}


                                <div
                                    style="text-align: center; width: 95%; margin: 0 auto; margin-bottom: 15px; margin-top: 15px; height: auto; overflow: hidden; ">
                                    <div class="inputdiv" style="height: auto; overflow: hidden;">
                                        <div style="width: 50px; color: #000; padding-left: 5px; background: #fff; ">
                                            EGP
                                        </div>
                                        <input type="number" id="selectedAmount" name="amount" maxlength="7"
                                            oninput="if(value.length>7)value=value.slice(0,7)"
                                            style="font-size: 14px; padding-left:10px; color: #000;  background: #fff;"
                                            placeholder="Please enter the return shipping amount" class="layui-input"
                                            autocomplete="off" required="">
                                    </div>

                                    <div
                                        style="text-align: center; float: left; width: 100%; height:auto; overflow: hidden; margin-top: 15px; display:none;">
                                        <div style="width: 100%; margin:0 auto; font-size:12px; color:red;">
                                            <font id="_recharge_t6">Recharge range</font>:
                                            <font id="pay_min">EGP100.00 - EGP49999.00</font>
                                        </div>
                                    </div>
                                    <div class="inputdiv" style="margin-top: 10px; height: 120px; display: none;"
                                        id="cards4">
                                        <div style=" width: 50px; color:#fff;">Transfer voucher</div>
                                        <div style="">
                                            <img src="{{ asset('customv2/deposit/imgs/up.png') }}"
                                                style="height:85px;width:85px; margin-top:10px; border-radius:5px;"
                                                class="upload" id="upload1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                style="width: 100%; margin: 0 auto; background: none; padding-bottom: 15px; height: auto; overflow: hidden; ">
                                <div
                                    style="text-align: center; width: 98%; margin: 0 auto; margin-bottom: 15px; margin-top: 15px; height: auto; overflow: hidden;">
                                    <button class="layui-btn" id="Recharge"
                                        style="width: 90%; font-weight: bold; font-size: 14px; color: #fff; height: 45px; line-height: 45px; border-radius: 100px; border: 0px; background: #C0857E; "
                                        type="submit">
                                        Recharge now
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div
                            style="width: 100%; margin: 0 auto; background: none; margin-top: 10px; height: auto; overflow: hidden;">
                            <div
                                style="width: 98%; margin: 0 auto; background: #191A1F; padding-bottom: 10px; border-radius: 3px; ">
                                <div style="height:35px; line-height:35px; text-align:left;">
                                    <span style="margin-left:5%; color:#fff; font-weight:bold;">Recharge guide instruction</span>
                                </div>
                                <div
                                    style="text-align: left; padding: 20px; padding-top: 0px; height: auto; overflow: hidden; color: #fff;">
                                     1. The minimum recharge amount is 2800 NGN. if the amount is less than the minimum, it will not be credited. <br>

                                    2. Please check the account information carefully when transferring money to avoid payment errors. <br>

                                    3. Please act according to the return shipping rules. if you fail to recharge according to the platform rules . <br>

                                    4. After the conversion is successful, please wait for 20-30 minutes. if your payment has not arrived for a long time, please contact our online customer service.
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('.channelitem').on('click', function() {
                    $('.channelitem').removeClass('payitem');
                    $(this).addClass('payitem');
                });
            });

            $(document).ready(function() {
                $('.item').on('click', function() {
                    $(this).prev('input[type="radio"]').prop('checked', true).trigger('change');

                    $('.item').removeClass('black-bg');
                    $(this).addClass('black-bg');

                    var selectedValue = $('input[name="money"]:checked').val();
                    $('#selectedAmount').val(selectedValue);
                });

                $('input[name="money"]').on('change', function() {
                    var selectedValue = $(this).val();
                    $('#selectedAmount').val(selectedValue);
                });
            });

            $(document).ready(function() {
                $('.channelitem').on('click', function() {
                    // Remove the 'checked' attribute from all radio buttons
                    $('input[name="channel"]').prop('checked', false);

                    // Set the 'checked' attribute for the radio button within the clicked channel item
                    $(this).find('input[type="radio"]').prop('checked', true);
                });
            });
        </script>
    </body>
@endsection
