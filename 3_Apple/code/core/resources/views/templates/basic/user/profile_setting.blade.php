@extends('layouts.users')


@section('content')

    <body style="min-height: 100%; width: 100%; background-size: 100% auto; background:#000; ">
        <input type="hidden" id="telegram" value="https://t.me/appleinetelservice001">
        <input type="hidden" id="androidurl" value="https://pico-vr.com/PICO.apk">
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
        <div class="indexdiv"></div>


        <div style=" max-width:450px; margin:0 auto;position:relative;">
            <div class="top1">
            </div>
            <form method="POST" action="https://ap-intell.com/logout" id="logoutForm">
                <input type="hidden" name="_token" value="bE6TqtLAUmc0UAedT0daMfO50bGinLxy5V1M8CAZ">
                <div style="background: #000; height:90px; padding-bottom: 30px;  overflow: hidden; position:relative; ">
                    &nbsp;
                    <img style="position:absolute;right:20px; top:30px; height:33px; display: none">
                </div>
            </form>
            <div style="position:absolute; top:45px; left:30px; z-index:100;">
                <div
                    style="height: 65px; line-height: 65px; margin: 0 auto; width: 65px; text-align: center; border-radius: 100px; background: #fff; ">
                    <img src="{{ asset('images/pm.jpg') }}"
                        style="height: 50px; border-radius: 100px;">
                </div>
            </div>
            <div
                style="position: absolute; top: 55px; left: 110px; z-index: 100; font-size:16px; color: #fff; font-weight: bold;">
                Apple Intelligence
            </div>
            <div style="position:absolute; top:35px; left:110px; z-index:100;">
                <div style="padding-top: 1px; color: #fff; font-weight: bold; font-size: 14px; margin-top: 50px;">
                    &nbsp;{{ $user->mobile }}</div>
            </div>

            <div
                style="height: auto; position:relative; bottom:0px; width:96%; overflow: hidden; margin: 0 auto; margin-top:5px; font-size:12px; color:#000; padding-top:10px; padding-bottom:10px; border-radius: 5px">
                <div
                    style="height: auto; overflow: hidden;  font-size: 12px; background: #1A1A1A; color: #fff;  padding: 10px; border-radius: 5px; margin-top: 5px">
                    <div
                        style="text-align: center; width: 100%; margin: 0 auto; border-radius: 5px;color:#fff; background: #000; height: auto; overflow: hidden; position: relative; ">
                        <div style="width:100%;">
                            <div onclick="window.location.href='{{ route('user.deposit') }}'"
                                style="width: 24%; float: left; text-align: left; " id="Recharge">
                                <div style="padding-right:0px; width:100%; ">
                                    <div style="padding: 10px; ">
                                        <div style=" padding: 5px; padding-top:10px;">
                                            <div style=" text-align: center; height: 35px;">
                                                <img src="{{ asset('icons/dow.svg?v2') }}" class="colored"
                                                    style="width: 32px;">
                                            </div>
                                            <div
                                                style=" text-align: center; line-height: 15px; font-size: 12px; font-weight: bold; ">
                                                Recharge
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                style="width: 2%; float: left;  padding-bottom: 10px; height: 73px; border-radius: 2px !important; text-align: left; overflow: hidden; ">
                                &nbsp;
                            </div>
                            <div onclick="window.location.href='{{ route('user.withdraw') }}'"
                                style="width: 24%; float: left; text-align: left; ">
                                <div style=" padding-left:0px; padding-right: 0px; width: 100%; ">
                                    <div style="padding: 10px;" id="Withdraw">
                                        <div style=" padding: 5px; padding-top:10px;">
                                            <div style=" text-align: center; height: 35px;">
                                                <img src="{{ asset('icons/up.svg?v2') }}" class="colored"
                                                    style="width: 32px;">
                                            </div>
                                            <div
                                                style="text-align: center; line-height: 15px; font-size: 12px; font-weight: bold; ">
                                                Withdraw
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                style="width: 2%; float: left;  padding-bottom: 10px; height: 73px; border-radius: 2px !important; text-align: left; overflow: hidden; ">
                                &nbsp;
                            </div>
                            <div onclick="window.location.href='{{ route('user.dailybonus') }}'"
                                style="width: 24%; float: left; text-align: left;">
                                <div style=" padding-left:0px; padding-right: 0px; width: 100%; ">
                                    <div style="padding: 10px;" id="checkin">
                                        <div style=" padding: 5px; padding-top:10px;">
                                            <div style=" text-align: center; height: 35px;">
                                                <img src="{{ asset('icons/calendar.svg') }}" class="colored"
                                                    style="width: 32px;">
                                            </div>
                                            <div
                                                style="text-align: center; line-height: 15px; font-size: 12px; font-weight: bold; ">
                                                Check in
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                style="width: 2%; float: left;padding-bottom: 10px; height: 73px; border-radius: 2px !important; text-align: left; overflow: hidden; display: none">
                                &nbsp;
                            </div>
                            <div onclick="window.location.href='{{ route('user.trx.log') }}'"
                                style="width: 24%; float: left; text-align: left;  " id="Record">
                                <div style=" padding-left:0px;  padding-right: 0px; width: 100%; ">
                                    <div style="padding: 10px;">
                                        <div style=" padding: 5px; padding-top:10px;">
                                            <div style=" text-align: center; height: 35px;">
                                                <img src="{{ asset('icons/rec.svg') }}" class="colored"
                                                    style="width: 32px;">
                                            </div>
                                            <div
                                                style=" text-align: center; line-height: 15px; font-size: 12px; font-weight: bold; ">
                                                Records
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div
                        style="float:left;  position:relative; background: url({{ asset('images/img14.jpg') }}); background-size: 100% 100%; width:49%; height:120px; border-radius: 10px; margin-top: 10px; ">
                        <div
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 10px;">
                            <p style="padding: 5px">Account balance</p>
                            <p style="padding: 5px; font-size: 20px">EGP{{ $user->balance + $user->bonus_balance }}</p>
                        </div>
                    </div>

                    <div
                        style="float: right; position: relative; background: url({{ asset('images/img06.jpg') }}); background-size: 100% 100%; width: 49%; margin-left: 2%; height: 120px; border-radius: 10px; margin-bottom: 10px; margin-top: 10px; ">
                        <div
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 10px;">
                            <p style="padding: 5px;">Accumulated income</p>
                            <p style="padding: 5px; font-size: 20px">EGP{{ $user->total_earnings }}</p>
                        </div>
                    </div>

                </div>
            </div>
            <div
                style="width: 98%; margin: 0 auto; margin-top: 10px; border-radius: 5px !important; display: flex; align-items: center; justify-content: center ">
                <img src="{{ asset('images/ng.jpg') }}"
                    style=" width: 95%; border-radius: 5px !important; cursor:pointer; " id="myd">
            </div>

            <div
                style="width: 95%; margin: 0 auto; height: auto; overflow: hidden; margin-top: 15px; font-size: 12px; background: #191A1F; color:#fff; padding-top: 10px; padding-bottom: 35px; border-radius: 5px !important; margin-bottom: 80px; ">
                <div style="height:45px;line-height:25px; text-align:left;">
                    <div style=" margin-left:15px; font-size:15px;">service</div>
                </div>
                <div style="height:90px;">
                    <div style="float:left;width: 25%; text-align:center;" class="tabs1"
                        onclick="window.location.href='{{ route('user.company') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/1.png') }}" class="colored" style="width:32px;">
                        </div>
                        <div>
                            About us
                        </div>
                    </div>
                    <div style="float: left; width: 25%; text-align: center;" class="tabs1"
                    onclick="window.location.href='{{ route('user.rules') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/4.png') }}" class="colored" style="width: 32px;">
                        </div>
                        <div>
                            Platform rules
                        </div>
                    </div>
                    <div style="float: left; width: 25%; text-align: center;" class="tabs"
                        onclick="window.location.href='{{ route('user.coupon') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/8.png') }}" class="colored" style="width: 32px;">
                        </div>
                        <div>
                             Gift redemption
                        </div>
                    </div>

                    <div style="float: left; width: 25%; text-align: center;" class="tabs"
                        onclick="window.location.href='{{ route('user.cs') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/2.png') }}" class="colored" style="width: 35px;">
                        </div>
                        <div>
                            Helps
                        </div>
                    </div>


                </div>

                <div style="margin-top:20px;">
                    <div style="float:left;width: 25%; text-align:center;" id="down">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/5.png') }}" class="colored" style="width:28px;">
                        </div>
                        <div>
                            Download
                        </div>
                    </div>

                    <div style="float: left; width: 25%; text-align: center;" class="tabs"
                        onclick="window.location.href='{{ route('user.account') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/6.png') }}" class="colored" style="width: 29px;">
                        </div>
                        <div>
                            Bank Account
                        </div>
                    </div>

                    <div style="float: left; width: 25%; text-align: center;" class="tabs"
                        onclick="window.location.href='{{ route('user.change.password') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/mine/7.png') }}" class="colored" style="width: 25px;">
                        </div>
                        <div>
                            Password
                        </div>
                    </div>
                    <div style="float: left; width: 25%; text-align: center;" class="tabs"
                        onclick="window.location.href='{{ route('user.logout') }}'">
                        <div style="height:45px;">
                            <img src="{{ asset('customv2/mine/ui5/out.png') }}" class="colored" style="width: 32px;">
                        </div>
                        <div>
                            Log out
                        </div>
                    </div>
                </div>
                @include('templates.basic.partials.footer')
            </div>



        </div>
    </body>
@endsection
