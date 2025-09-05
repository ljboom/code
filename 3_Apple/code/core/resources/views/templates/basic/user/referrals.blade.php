@extends('layouts.users')


@section('content')



    <body style="min-height: 100%; width: 100%; background-size: 100% auto; background: #000; ">

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
        <div id="error"
            style="position: absolute; width: 100%; height: 100vh; background: rgba(0, 0, 0, 0.5); display: none; align-items: center; justify-content: center; flex-direction: column; z-index: 99999; animation: fadeInOut 3s ease forwards; opacity: 0;"
            class="fadeOut">
            <div style="color: #fff; padding: 20px 30px; background: #000; border-radius: 5px;">
                Copy Success
            </div>
        </div>
        <style>
            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                }

                10% {
                    opacity: 1;
                }

                90% {
                    opacity: 1;
                }

                100% {
                    opacity: 0;
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorElement = document.getElementById('error');

                setTimeout(function() {
                    errorElement.classList.add('fadeOut');
                }, 3000);
            });
        </script>

        <div style=" max-width:450px; margin:0 auto;">
            <div class="top1">
            </div>
            <div style="height: auto; overflow: hidden; ">
                <div style="width: 100%; height: 180px; overflow: hidden; position:relative;">
                    <img src="{{ asset('images/vvp.png') }}" style="width:100%; height: auto">
                    <div
                        style="position: absolute; top: 60px; left: 3%; width: 60%; font-size:30px; text-align: left; color: #fff;">
                        Invite friends
                    </div>

                    <div
                        style="position: absolute; top: 100px; left: 3%; width: 90%; font-size:12px; text-align: left; color: #fff;">
                        Manage your team and get higher profits
                    </div>
                </div>
            </div>

            <div
                style="height:180px; overflow: hidden; margin-top: 5px; font-size: 12px; background: #000; color: #FFF; padding-top: 10px; padding-bottom: 10px;">
                <div style="float:left; width:30%; overflow: hidden;">
                    <img src="{{ asset('images/img0800.jpg') }}"
                        style="height:150px; margin-top:10px; transform: scaleX(-1); margin-left: -5px">
                </div>
                <div style="float:right; width:70%; text-align:left;">
                    <div style="margin-left:5px;">
                        <div style="font-weight:bold; font-size:18px; margin-top:20px;">Share with one click</div>
                        <div style=" font-size: 12px; margin-top: 10px;">Share the invite code or link to invite friiends
                        </div>

                        <div style="font-size: 12px; margin-top: 15px; width: 100%; overflow: hidden; height:auto;">
                            <div
                                style="border: 1px groove #C0857E; float: left; width: 65%; height: 30px; line-height: 30px; text-align: center; border-radius: 25px; ">
                                <font>
                                    Invitation code:
                                </font>
                                <font style="font-weight:bold; font-size:12px;" id="invitation">
                                    {{ auth()->user()->ref_code }}
                                </font>
                            </div>
                            <div
                                style=" float: left; width: 32%; height: 30px; line-height: 30px; text-align: center; border-radius: 25px; ">
                                <input id="copy1" value="Copy"
                                    style="width: 80%; font-weight: 400; height: 30px; line-height: 25px; font-size: 14px; display: inline-block; background: #C0857E; color: #fff; border: 1px groove #C0857E; border-radius: 25px; "
                                    type="button" data-clipboard-text="{{ auth()->user()->ref_code }}">
                            </div>
                        </div>
                        <div
                            style="font-size: 12px; margin-top: 15px; width: 100%; overflow: hidden; height:auto; text-align:center; ">
                            <div
                                style="border: 1px groove #C0857E; float: left; width: 60%; height: 30px; line-height: 30px; text-align: center; border-radius: 25px; padding: 0px 5px">
                                <div style="font-size: 12px; float: left; width: 100%; overflow: hidden; text-align: left; text-overflow: ellipsis; white-space: nowrap; "
                                    id="link">&nbsp;
                                    Link: <b>{{ route('home') }}?invite_code={{ auth()->user()->ref_code }}</b>
                                </div>
                            </div>
                            <div
                                style=" float: left; width: 32%; height: 30px; line-height: 30px; text-align: center; border-radius: 25px; ">
                                <input id="copy2" value="Copy"
                                    style="width: 80%; font-weight: 400; height: 30px; line-height: 25px; font-size: 14px; display: inline-block; background: #C0857E; color: #fff; border: 1px groove #C0857E; border-radius: 25px; "
                                    type="button" data-clipboard-text="{{ route('home') }}?invite_code={{ auth()->user()->ref_code }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                style="height: auto; overflow: hidden; font-size: 12px; background: #A1A1A1; color: #fff; padding: 10px; width: 90%; margin: 0 auto; margin-top: 5px; border-radius: 5px">
                <div>
                    <div
                        style="float:left;  background: url({{ asset('images/img14.jpg') }}); background-size: 100% 100%; width:49%; height: 100px; border-radius: 5px; text-align: center">
                        <div
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 5px;">
                            <div
                                style="margin-top: 0px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);; font-family: HarmonyOS Sans SC; font-size: 16px; width: 100%;">
                                {{ number_format($level1->count() + $level2->count() + $level3->count()) }}</div>
                            <div
                                style="margin-top: 10px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-family: HarmonyOS Sans SC; font-size: 14px; width: 100%;">
                                Number of people</div>
                        </div>
                    </div>
                    <div
                        style="float: left; background: url({{ asset('images/img06.jpg') }}) no-repeat center center/cover, rgba(0, 0, 0, 0); background-size: 100% 100%; width: 49%; margin-left: 2%; height: 100px; border-radius: 5px; text-align: center">
                        <div
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 5px;">
                            <div
                                style="margin-top: 0px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-family: HarmonyOS Sans SC; font-size: 16px; width: 100%; ">
                                EGP {{ number_format($level1_bonus + $level2_bonus + $level3_bonus, 2) }}</div>
                            <div
                                style="margin-top: 10px; font-weight: 500; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-family: HarmonyOS Sans SC; font-size: 14px; width: 100%; ">
                                Total revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-bottom: 10px; background: #000; margin-bottom:65px; color: #fff">
                <div
                    style="text-align: center; background: #000; width: 100%; margin: 0 auto; margin-top: 10px;  padding-bottom:20px; height: auto; overflow: hidden; position: relative; ">
                    <div style="padding: 15px;  background: #000; height: auto; overflow: hidden; padding-bottom:0px;">
                        <div style="float:left;color:#FFF; border-left:3px solid #C0857E;">&nbsp;&nbsp;My team</div>
                        <p onclick="window.location.href='{{ route('user.referrals.lv1') }}'" id="teamdetails" style="float: right; font-size: 12px; color: #fff;">Team details &gt;&gt;</p>
                    </div>
                    <div
                        style="padding-top: 10px; padding-bottom: 15px;  border-bottom: 1px solid #000; height: auto; overflow: hidden; ">
                        <div
                            style="width: 19%; float: left; height: 50px; line-height: 50px; font-weight: bold; background: #C0857E; color: #fff; font-size: 22px; border-top-right-radius: 10px; border-bottom-right-radius: 10px">
                            LV1</div>
                        <div style="width: 27%; float: left; font-size:12px; height: 50px; line-height: 25px; ">
                            <div id="P1">20%</div>
                            <div>Commission</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="task1_count">{{ $level1->count() }}</div>
                            <div>Quantity</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="lv1_team_income">EGP{{ number_format($level1_bonus,2) }}</div>
                            <div>Bonus</div>
                        </div>
                    </div>

                    <div
                        style="padding-top: 10px; padding-bottom: 15px; border-bottom: 1px solid #000; height: auto; overflow: hidden; ">
                        <div
                            style="width: 19%; float: left; height: 50px; line-height: 50px; font-weight: bold; background: #C0857E; color: #fff; font-size: 22px; border-top-right-radius: 10px; border-bottom-right-radius: 10px">
                            LV2</div>
                        <div style="width: 27%; float: left; font-size:12px; height: 50px; line-height: 25px; ">
                            <div id="P2">3%</div>
                            <div>Commission</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="task2_count">{{ $level2->count() }}</div>
                            <div>Quantity</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="lv2_team_income">EGP{{ number_format($level2_bonus,2) }}</div>
                            <div>Bonus</div>
                        </div>
                    </div>

                    <div style="padding-top: 10px; height: auto; overflow: hidden; ">
                        <div
                            style="width:19%;float:left; height:50px;line-height:50px; font-weight:bold; background:#C0857E; color:#fff; font-size:22px; border-top-right-radius: 10px; border-bottom-right-radius: 10px">
                            LV3</div>
                        <div style="width: 27%; float: left; font-size:12px; height: 50px; line-height: 25px; ">
                            <div id="P3">2%</div>
                            <div>Commission</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="task3_count">{{ $level3->count() }}</div>
                            <div>Quantity</div>
                        </div>
                        <div style="width: 27%; float: left; font-size: 12px; height: 50px; line-height: 25px; ">
                            <div id="lv3_team_income">EGP{{ number_format($level3_bonus,2) }}</div>
                            <div>Bonus</div>
                        </div>
                    </div>
                </div>

                <div
                    style="background: #000; width: 100%; margin: 0 auto; margin-top: 5px;  padding-bottom:20px; height: auto; overflow: hidden; position: relative; coloe: #fff">
                    <div style="padding:15px; padding-bottom:0px; text-align:left;">
                        <div style="color:#fff; border-left:3px solid #C0857E;">&nbsp;&nbsp;Invitation award</div>
                    </div>
                    <div style="width:98%;margin:0 auto;">
                        <div
                            style=" text-align:left; font-size:12px;  border-radius: 10px; width: 95%; color:#fff; margin: 0 auto; height: auto; overflow: hidden; margin-top: 10px; position: relative;">
                            when the friend you invite sign up and invest, you will get 25% cashback instantly.<br><br>
                             You'll get 2% cash back when your level 2 team members invest. <br><br>
                            You'll get 1% cash back when your level 3 team members invest. <br><br>
                            Cash rewards will be sent to your account balance once your team members invest. You can withdraw it immediately.<br><br>
                        </div>
                    </div>
                </div>
            </div>
            @include('templates.basic.partials.footer')
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to copy text to clipboard
                function copyToClipboard(text) {
                    var tempInput = document.createElement('input');
                    tempInput.style.position = 'absolute';
                    tempInput.style.left = '-1000px';
                    tempInput.style.top = '-1000px';
                    tempInput.value = text;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);
                }

                // Copy code when button 1 is clicked
                document.getElementById('copy1').addEventListener('click', function() {
                    var code = "{{ auth()->user()->ref_code }}";
                    copyToClipboard(code);
                    showError();
                });

                // Copy link when button 2 is clicked
                document.getElementById('copy2').addEventListener('click', function() {
                    var link = "{{ route('home') }}?invite_code={{ auth()->user()->ref_code }}";
                    copyToClipboard(link);
                    showError();
                });

                // Function to display error message
                function showError() {
                    document.getElementById('error').style.display = 'flex';

                    setTimeout(function() {
                        document.getElementById('error').style.display = 'none';
                    }, 1000);

                }
            });
        </script>



    </body>


@endsection
