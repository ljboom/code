@extends('layouts.users')

@section('content')
    <style type="text/css">
        .indexdiv {
            background: #000000;
            position: fixed;
            left: 0px;
            top: 0px;
            bottom: 0px;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 101;
            filter: alpha(opacity=85);
            opacity: 0.85 !important;
        }

        .layui-layer-btn .layui-layer-btn0 {
            border-color: #0C2467 !important;
            background-color: #0C2467 !important;
            color: #fff;
        }

        .topname {
            line-height: 46px;
            font-weight: 700;
            font-size: 14px;
            width: 80%;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
        }

        .carditem {
            width: 100%;
            font: 12px/1.2em '\5b8b\4f53', tahoma, arial, 'Hiragino Sans GB', sans-serif;
            height: auto;
            margin: 0 auto;
            border-width: 0px;
            border-color: #666;
            border-style: solid;
            border-radius: 5px;
            box-shadow: 0px 0px 0px 0px rgba(34, 34, 34, 0.20);
            background-color: #191A1F;
            color: #808080;
            background: #191A1F;
            overflow: hidden;
        }

        .cmbtn {
            margin: 0 auto;
            width: 30%;
            margin-left: 20%;
            float: left;
            background: #C0857E;
            cursor: pointer;
            font-size: 14px;
            height: 30px;
            line-height: 30px;
            margin-top: 20px;
            border-radius: 20px !important;
            color: #fff;
            border-width: 1px;
            border-color: #C0857E;
            border-style: solid;
            box-shadow: 0 2px 3px 0 #C0857E;
        }

        .cmbtn1 {
            margin: 0 auto;
            width: 30%;
            margin-left: 10%;
            float: left;
            background: linear-gradient(to right, gray, #aaa);
            cursor: pointer;
            font-size: 14px;
            height: 30px;
            line-height: 30px;
            margin-top: 20px;
            border-radius: 20px !important;
            color: #fff;
            border-width: 1px;
            border-color: #aaa;
            border-style: solid;
            box-shadow: 0 2px 3px 0 #aaa;
        }

        input::placeholder {
            color: #333;
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

        .layui-layer-setwin .layui-layer-close2 {
            background-position: -179px -31px;
            cursor: pointer
        }

        .layui-layer-setwin a {
            position: absolute;
            width: 32px;
            height: 40px;
            _overflow: hidden;
            top: -28px;
        }

        .payitem {
            border: 1px solid #fff !important;
            border-radius: 5px;
            background: #000;
            color: #fff !important;
        }

        .payitem:before {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            background: #000;
            /*border: 10px solid #0081ff;
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
            background: #000;
            /*       border: 10px solid #fff;
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
            border-bottom: 1px dotted #ccc !important;
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

    <body style="background: #000">
        <div style="background: rgb(0, 0, 0); display: block;" id="mainb">
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
            <div class="top" style="background: #191A1F; border: 0px !important;">
                <div onclick="window.history.go(-1); return false;"
                    style="float:left; line-height:46px;width:50%; height:46px;cursor:pointer;" id="btnClose">
                    <i class="layui-icon" style="color:#fff; margin-left:12px; font-size:18px;font-weight:bold;"></i>
                </div>
                <div class="topname" style="line-height: 50px; font-weight: bold; color: #fff;">
                    انسحاب
                </div>
                <div onclick="window.location.href='{{ route('user.withdraw.history') }}'" style="float:right; text-align:right; line-height:46px;width:50%;" id="log">
                    <img src="{{ asset('customv2/withdraw/imgss/iconlog.png') }}"
                        style="height: 27px;  margin-right: 10px; margin-bottom: 2px; border-radius: 50px;">
                </div>
            </div>

            <div style=" max-width:450px; margin:0 auto;">
                <div style="  height:auto; overflow:hidden; margin-top:50px; ">
                    <img src="{{ asset('images/img06.jpg') }}" style="width: 100%; border-radius: 5px; margin-bottom: 5px">
                    <div
                        style="width: 100%; margin: 0 auto; background: #000; height: 100px; overflow: hidden; position: relative; ">
                        <div style="width: 100%; margin: 0 auto; ">
                            <img src="{{ asset('customv2/withdraw/ui5/wallet.png') }}"
                                style="position:absolute; bottom:30px; left:10px; height:35px;">
                            <div style="position:absolute; bottom:25px; left:50px;">
                                <div style="color: #fff; padding-left: 20px;  font-size: 22px; ">
                                    EGP<font id="useramount"
                                        style="padding-left: 5px; font-weight: bold; font-size: 22px; padding-top: 15px; font-family: HarmonyOS Sans SC;">
                                        {{ auth()->user()->bonus_balance }}</font>
                                </div>
                                <div
                                    style="padding-left: 20px; padding-top: 5px; font-weight: bold; color: #fff; font-size: 12px; ">
                                    رصيد الحساب</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{route('user.withdraw.money')}}" method="post">
                        @csrf
                        <input type="hidden" id="withdrawBalance" name="balance" value="2">
                        <input type="hidden" id="withdrawMethodCode" name="method_code" value="1">
                        <div
                            style="width: 100%; margin: 0 auto; background: #191A1F; padding-bottom: 3px; padding-top: 10px; ">
                            <div style="width:95%; margin:0 auto;  padding-bottom:3px;border-radius:2px; overflow:hidden;">
                                <!--<div style="text-align: left; display:none; width: 98%; margin: 0 auto; color: #00A478; line-height:17px; font-weight:bold; font-size:12px; margin-bottom: 10px; margin-top: 2px; height: auto; overflow: hidden;">
                                                    *The withdrawals from OPAY, PALMPAY and KUDA are under maintenance and are expected to resume at 8-9 am. If you need to withdraw money, please use other banks. We are deeply sorry for the inconvenience caused to you.
                                            </div>-->
                                <div
                                    style="width:100%; margin:0 auto;  margin-top:10px; padding-top:10px; display:none; padding-bottom:20px;border-radius:5px;height:auto; overflow:hidden; ">
                                    <div style="padding-left:10px; padding-bottom:10px;font-weight:bold; color:#000;">
                                        Withdrawal channel</div>
                                </div>
                                <div>
                                    <div
                                        style="text-align: center; width: 98%; margin: 0 auto; margin-bottom: 15px; margin-top:15px; height: auto; overflow: hidden;">
                                        {{--  <button class="inputdiv"
                                            style="line-height: 38px; width: 100%; height: 45px; border: 0px; background-color: #191A1F; padding: 0 0px; z-index: 500;"
                                            id="selectcard" type="button" onclick="showmainbb()">
                                            <input type="hidden" name="withdraw_account" id="withdrawAccount">
                                            <img src="{{ asset('customv2/withdraw/ui5/bank.png') }}"
                                                style="height: 22px; margin-top: 7px; padding-left:10px; padding-bottom:5px;"
                                                id="imgurl">
                                            <font
                                                style="margin-left: 10px; height: 38px; width: 100%; color: #fff; text-align: left;"
                                                id="chosen">Please select bank account to withdraw</font>
                                            <div
                                                style="float: left; width: 10%; text-align: right; height: 35px; line-height: 38px; color: #fff; ">
                                                <i class="layui-icon layui-icon-right"></i>
                                            </div>
                                        </button>  --}}

                                        <div
                                            style="width: 98%; margin: 0 auto; text-align: left; margin-top: 20px; color: #fff; font-weight: bold;">
                                            مبلغ السحب
                                        </div>
                                        <div class="inputdiv" style="margin-top:15px;">
                                            <div style="width:30px;color:#fff;">
                                                EGP
                                            </div>
                                            <input type="number" name="amount" id="withdrawMoney"
                                                oninput="if(value.length>10)value=value.slice(0,10)"
                                                style="font-size: 12px; color: #fff; background-color: #191A1F; padding-left: 10px; "
                                                placeholder="الرجاء إدخال مبلغ السحب" class="layui-input"
                                                autocomplete="off" required="">
                                        </div>

                                        <div
                                            style="width: 100%; height: 25px; margin-top: 25px; line-height: 25px; text-align: left; margin-top: 10px; display: none;">
                                            <span style="float: left; color: #ff6a00; margin-left:10px; font-size:12px;">
                                                <font id="_withdrawal_t11">Minimum</font>
                                                <font id="wi_min">1000.00</font> EGP
                                            </span>
                                            <font style="float:right;color: #ff6a00; font-size:12px;">
                                                <font id="_withdrawal_t12">Maximum</font>
                                                <font id="wi_max">10000.00</font> EGP
                                            </font>
                                        </div>
                                        <div
                                            style="width: 100%; height: 25px; line-height: 30px; margin-top:10px;border-width: 0px; border-style: solid; border-radius: 2px 2px 2px 2px; text-align: left;">
                                            <span style=" float:left;font-size:12px; color:#fff;  ">
                                                <font>المبلغ المستلم</font>:
                                                <font id="amountFee">EGP 0.00 </font>
                                            </span>
                                            <span style="color: #fff; float: right; font-size: 12px; ">
                                                <font>الضريبة</font>: <font>10%</font>
                                            </span>
                                        </div>
                                        <!--<div style="width: 100%; height: 25px; line-height: 30px; margin-top:10px;border-width: 0px; border-style: solid; border-radius: 2px 2px 2px 2px; text-align: left;">
                                    </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="text-align: center;width:98%; margin:0 auto; margin-bottom:15px;">
                            <button type="submit" class="layui-btn" id="withdrawButton" type="button"

                                style="width: 80%; margin-top: 25px; height: 45px; line-height: 45px; font-weight: bold; color: #fff; font-size: 14px; border-radius: 25px; border: 0px; background: #C0857E; ">سحب المال الآن</button>
                        </div>
                    </form>
                    <br>
                    <div style="width: 98%; margin: 0 auto; background: #191A1F; margin-top: 2px;">
                        <div style="height: 35px; line-height: 35px; text-align: left;"><span
                                style="margin-left:3%; color:#fff; font-weight:bold; ">تعليمات الانسحاب</span></div>
                        <div
                            style="text-align: left; padding:20px; padding-top:0px; height:auto; overflow:hidden;color:#999; ">
                           1. الحد الأدنى للسحب 100 جنيه مصري<br>

                           2. رسوم السحب 15% من قيمة السحب <br>


                            3. يمكنك سحب الأموال في أي وقت على مدار 24 ساعة طوال أيام الأسبوع. سيتم إيداع عمليات السحب خلال 5 دقائق إلى 30 دقيقة. .<br>

                            4. من أجل حماية مصالح المنصة والأعضاء، يجب أن يكون لديك جهاز واحد على الأقل
                            لتفعيل وظيفة السحب.<br>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var amountInput = document.getElementById('amount');
                var amountFeeDiv = document.getElementById('amountFee');
                var charge = 10;

                function updateFee() {
                    var inputValue = parseFloat(amountInput.value);
                    if (!isNaN(inputValue)) {
                        var feeAmounts = (inputValue * charge) / 100;
                        var feeAmount = (inputValue - feeAmounts);
                        amountFeeDiv.textContent = feeAmount.toFixed(2);
                    } else {
                        amountFeeDiv.textContent = '0.00';
                    }
                }

                amountInput.addEventListener('input', updateFee);
            </script>
        </div>

        <div style="background-size: 100% auto; background: #000; display: none" id="mainbb">
            <div class="indexdiv"></div>
            <div style="width: 100%; height: 100%; background: #ffffff; position: fixed; top: 0; left: 0; z-index: 99999; display: none;"
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
            <div style="width: 100%; margin: 0 auto; background: #191A1F; border-bottom: 0px solid #000; " class="top">
                <div style="float:left; text-align:left; line-height:46px;width:50%;" id="" onclick="showmainb()">
                    <i class="layui-icon" style=" color:#fff; margin-left:12px; font-size:18px;  font-weight:bold;"></i>
                </div>
                <font class="topname" style="color: #fff;">
                    Bank Account Management
                </font>
                <div style="float:right; text-align:right; line-height:46px;width:50%;" id="Addbank">
                    <i class="layui-icon"
                        style=" color: #fff; margin-right: 12px; font-size: 18px; font-weight: bold;"></i>
                </div>
            </div>
            <div style=" max-width:450px; margin:0 auto;  ">
                <div class="layui-form layui-tab-content" style="padding:5px 10px; margin-top:46px;">
                    <div id="card" style="width:100%;">
                        <script>
                            function updateAccountDisplay(id, accountNumber) {
                                var mainb = document.getElementById('mainb');
                                var mainbb = document.getElementById('mainbb');

                                // Assuming divElement and other elements exist
                                var chosenElement = document.getElementById('chosen');
                                var withdrawAccountElement = document.getElementById('withdrawAccount');

                                if (chosenElement && withdrawAccountElement) {
                                    chosenElement.innerText = accountNumber;
                                    withdrawAccountElement.value = id; // Set the value to the method ID here
                                }

                                // Update data-id attribute dynamically
                                var itemsElement = document.querySelector(`[data-id='${id}']`);
                                if (itemsElement) {
                                    itemsElement.setAttribute('data-id', accountNumber);
                                }

                                if (mainbb && mainb) {
                                    mainbb.style.display = 'none';
                                    mainb.style.display = 'block';
                                }
                            }
                        </script>
                        <div style="padding:2px; width:100%; margin:0 auto; margin-top:50px;">
                            <div
                                style="border-radius: 5px; color:#fff; text-align:center; margin-top:35px;position:relative;">
                                <img src="/customv2/wi_account/imgss/no.png" style="width:100%;">
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top:25px;">
                        <a href="https://ap-intell.com/main/withdraw/account/create" style="width:60%; margin:0 auto;">
                            <input class="layui-btn" id="add" value="Add"
                                style="width: 100%; border-radius: 25px; color: #fff; font-weight: bold; background: #C0857E; font-size: 16px; border: 0px; height: 45px; line-height: 45px; border-radius: 10px; "
                                type="button">
                        </a>
                    </div>
                </div>
            </div>
            <script>
                // Function to show/hide modal
                function toggleModal(methodId) {
                    var modalId = methodId; // Set modal ID to the same as method ID
                    // Hide all modals
                    var modals = document.querySelectorAll('[id^=""]');
                    for (var i = 0; i < modals.length; i++) {
                        modals[i].style.display = 'none';
                    }
                    // Show modal with corresponding ID
                    document.getElementById(modalId).style.display = 'block';
                }

                function hideModal(modalId) {
                    var modal = document.getElementById(modalId);
                    if (modal) {
                        modal.style.display = 'none';
                    }
                }

                // Add click event listener to all elements with IDs starting with 'pop'
                var popElements = document.querySelectorAll('[id^="pop"]');
                for (var i = 0; i < popElements.length; i++) {
                    popElements[i].addEventListener('click', function() {
                        // Extract the numeric part from the 'pop' ID
                        var methodId = this.id.replace('pop', '');
                        // Call toggleModal function with the extracted ID
                        toggleModal(methodId);
                    });
                }

                // Add click event listener to all elements with IDs starting with 'pop'
                var popElements = document.querySelectorAll('[id^="pop"]');
                for (var i = 0; i < popElements.length; i++) {
                    popElements[i].addEventListener('click', function() {
                        // Extract the numeric part from the 'pop' ID
                        var methodId = this.id.replace('pop', '');
                        // Call toggleModal function with the extracted ID
                        toggleModal(methodId);
                    });
                }

                var mainb = document.getElementById('mainb');
                var mainbb = document.getElementById('mainbb');

                function showmainb() {
                    mainbb.style.display = 'none';
                    mainb.style.display = 'block';
                }

                function showmainbb() {
                    mainbb.style.display = 'block';
                    mainb.style.display = 'none';
                }

                window.onload = showmainb();
            </script>
        </div>

        // <script>
        //     function submitWithdraw() {
        //         const button = $("#withdrawButton");
        //         button.prop("disabled", true);

        //         const methodCode = $("#withdrawMethodCode").val();
        //         const amount = $("#withdrawMoney").val();
        //         const balance = $("#withdrawBalance").val();



        //         $.ajax({
        //             url: "{{ route('user.withdraw.money') }}",
        //             method: "POST",
        //             data: {
        //                 method_code: methodCode,
        //                 amount: amount,
        //                 balance: balance,
        //                 _token: $('meta[name="csrf-token"]').attr("content")
        //             },
        //             success: function(response) {
        //                 if (response.success) {
        //                     // alert(response.message);
        //                     window.location.href = "{{ route('user.withdraw.history') }}";
        //                 } else {
        //                     // alert(response.error);
        //                     if (response.redirect_url) {
        //                         window.location.href = response.redirect_url;
        //                     }
        //                     button.prop("disabled", false);
        //                 }
        //             },
        //             error: function(xhr) {
        //                 if (xhr.status === 422) {
        //                     // Validation error from the controller
        //                     // alert(xhr.responseJSON.error);
        //                 } else {
        //                     // General error

        //                     // alert(xhr.responseJSON.error);
        //                     if (xhr.responseJSON.redirect_url) {
        //                         window.location.href = xhr.responseJSON.redirect_url;
        //                     }
        //                 }
        //                 button.prop("disabled", false);
        //             }
        //         });
        //     }
        // </script>
    </body>
@endsection
