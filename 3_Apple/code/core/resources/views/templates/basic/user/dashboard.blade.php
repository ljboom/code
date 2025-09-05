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
        <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; margin: 0px auto; z-index: 102; height: 520px; width: 100%; max-width: 450px;"
            id="notice">
            <div
                style="position: relative; width: 100%; text-align: center; height: auto; margin: 0 auto; width: 90%; background: #191A1F; background-size: 100% 100%; height: 500px; border-radius: 10px; color: #000; margin-top: 10px; ">
                <div style="text-align:center; width:100%;">
                    <img src="{{ asset('images/bell.png') }}" style="height:120px; position:absolute; left:35%; top:-80px;"
                        class="colored">
                </div>
                <div
                    style="background: #191A1F; height: 80px; border-radius: 8px; line-height: 130px; color: #fff; font-weight: bold; font-size: 24px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; ">
                    NOTIFY
                </div>
                <div
                    style="width:90%;position:relative; margin:0 auto;  height:auto; overflow:hidden;border:0px; padding-top:12px; font-size:12px;line-height:19px; text-align:left; ">
                    <div style="max-height: 245px; padding: 10px; border-radius: 5px; overflow: scroll; background: #191A1F; font-size: 12px !important; color: #fff; "
                        id="notice_info">Apple Intelligence, established in 1976 by Steve Jobs, Steve Wozniak, and Ronald
                        Wayne, is a pioneering tech company famous for groundbreaking devices like the iPhone, iPad, and
                        Mac. It has transformed computing and continues to set trends in innovation and design.<br>
                        <br>

                        1. Start with EGP2800 today and collect EGP1400 by tomorrow.<br>
                        2. Join the Telegram community to discover ways to increase your earnings.<br>
                        3. Withdraw anytime you want, with no limits on withdrawal times or the number of withdrawals.<br>
                        4. Get a EGP500 bonus just for registering.<br>
                        Receive EGP50 daily as a login reward.<br>
                        5. Apple Intelligence commenced operations in Nigeria on January 01, 2025.<br>
                        6. Earn 25% of your friend’s investment amount as a bonus when you invite them to join.<br>
                    </div>
                </div>
                <div style="width:100%; text-align:center; margin-top:15px;">
                    <button class="cmbtn" id="close" style=" height: 40px; border: 0px; width: 90%;"
                        onclick="hideNotice()">
                        OK
                    </button>
                </div>
                <div
                    style="line-height:24px; font-size:12px; width:100%; margin-top:20px; bottom:30px;  text-align:center;">
                    <button id="Join"
                        style=" height: 40px; width: 40px; border: 0px; width: 90%; background: #C0857E; color: #fff; border-radius: 5px; ">
                        <a target="none" href="https://yxymk.com" style="color: #fff">
                            <img src="{{ asset('customv2/dashboard/ui/cs_t1.png') }}"
                                style="height:22px; margin-bottom:3px; margin-right:5px;">Click here to join the official channel on Telegram
                        </a>
                    </button>
                </div>
            </div>
        </div>

        <div style="  text-align: center; margin-bottom: 60px;  ">
            <div style="width:98%; margin:0 auto;">
                <div
                    style=" width:100%; margin: 0 auto; font-weight: bold; font-size: 16px; padding-bottom: 10px; height: 130px;  ">
                    <div id="H1"
                        style="background-size: 100% 100%; width: 98%;  margin: 0 auto; height: 190px; border-radius: 5px; margin-top: 10px; margin-bottom: 100px; border: 1px solid #000; position: relative; display: flex; align-items: center; justify-content: space-around; flex-direction: column; background: url({{ asset('images/img06.jpg') }}); background-size: 100% 100%; ">
                    </div>
                </div>
            </div>
        </div>

        <div
            style="height: auto; overflow: hidden; width: 98%; margin: 0 auto; color: #fff; margin-top: 5px; border-radius: 5px !important; font-size: 12px;  padding-top: 10px; padding-bottom: 10px; background: #1A1A1A">
            <div style="height:65px;">
                <div onclick="window.location.href='{{ route('user.deposit') }}'" style="float:left;width: 20%; text-align:center;" id="Recharge">
                    <div style="height:45px;">
                        <img src="{{ asset('icons/dow.svg?v2') }}" class="colored" style="width:32px; ">
                    </div>
                    <div>
                        Recharge
                    </div>
                </div>
                <div onclick="window.location.href='{{ route('user.withdraw') }}'" style="float: left; width: 20%; text-align: center;" id="Withdraw">
                    <div style="height:45px;">
                        <img src="{{ asset('icons/up.svg?v2') }}" class="colored" style="width: 32px;">
                    </div>
                    <div>
                        Withdraw
                    </div>
                </div>
                <div onclick="window.location.href='{{ route('user.cs') }}'" style="float: left; width: 20%; text-align: center;" id="cs">
                    <div style="height:45px;">
                        <img src="{{ asset('icons/cs.svg') }}" class="colored" style="width: 32px;">
                    </div>
                    <div>
                        Helps
                    </div>
                </div>
                <div onclick="window.location.href=''" style="float: left; width: 20%; text-align: center;" id="down">
                    <div style="height:45px;">
                        <img src="{{ asset('icons/down.svg') }}" class="colored" style="width: 32px;">
                    </div>
                    <div>
                        Download
                    </div>
                </div>
                <div onclick="window.location.href='{{ route('user.dailybonus') }}'" style="float: left; width: 20%; text-align: center;" id="ck">
                    <div style="height:45px;">
                        <img src="{{ asset('icons/calendar.svg') }}" class="colored" style="width: 32px;">
                    </div>
                    <div>
                        Check in
                    </div>
                </div>
            </div>
        </div>
        <div
            style="text-align: center; background: #1A1A1A; border: 1px groove #666; width: 98%; margin: 0 auto; margin-top: 10px; padding-top: 5px; padding-bottom: 5px; border-radius: 10px !important; height: auto; overflow: hidden; position: relative; ">
            <div class="divWrap" style="padding: 10px; padding-top: 5px; padding-bottom: 5px;">
                <div style="float: left; width: 10%; font-size: 12px; color: #1476ff;">
                    <img src="{{ asset('customv2/dashboard/ui5/ic.png') }}" class="colored" style="height:17px;margin-right:5px;">
                </div>
                <div class="div" style="float:left; width:80%; color:#fff;">
                    <div class="marquee-root">
                        <div class="marquee-content" id="intext"
                            style="animation: 99.95s linear 0s infinite normal none running marqueeAnim;">******55 recharged
                            EGP186,000&nbsp;&nbsp;******81 recharged EGP245,000&nbsp;&nbsp;******31 withdraw
                            EGP142,000&nbsp;&nbsp;******45 withdraw EGP158,000&nbsp;&nbsp;******14 withdraw
                            EGP206,000&nbsp;&nbsp;******17 recharged EGP91,000&nbsp;&nbsp;******29 recharged
                            EGP256,000&nbsp;&nbsp;******80 withdraw EGP155,000&nbsp;&nbsp;******73 withdraw
                            EGP174,000&nbsp;&nbsp;******37 recharged EGP189,000&nbsp;&nbsp;******77 withdraw
                            EGP17,000&nbsp;&nbsp;******56 recharged EGP99,000&nbsp;&nbsp;******72 withdraw
                            EGP79,000&nbsp;&nbsp;******36 withdraw EGP168,000&nbsp;&nbsp;******88 recharged
                            EGP288,000&nbsp;&nbsp;******58 withdraw EGP254,000&nbsp;&nbsp;******22 recharged
                            EGP129,000&nbsp;&nbsp;******17 recharged EGP14,000&nbsp;&nbsp;******90 withdraw
                            EGP20,000&nbsp;&nbsp;******20 withdraw EGP65,000&nbsp;&nbsp;******28 recharged
                            EGP20,000&nbsp;&nbsp;******70 recharged EGP222,000&nbsp;&nbsp;******37 recharged
                            EGP32,000&nbsp;&nbsp;******78 withdraw EGP90,000&nbsp;&nbsp;******72 withdraw
                            EGP30,000&nbsp;&nbsp;******69 recharged EGP85,000&nbsp;&nbsp;******37 withdraw
                            EGP35,000&nbsp;&nbsp;******85 recharged EGP124,000&nbsp;&nbsp;******48 withdraw
                            EGP55,000&nbsp;&nbsp;******29 recharged EGP84,000&nbsp;&nbsp;******76 recharged
                            EGP72,000&nbsp;&nbsp;******68 recharged EGP27,000&nbsp;&nbsp;******23 recharged
                            EGP196,000&nbsp;&nbsp;******25 recharged EGP34,000&nbsp;&nbsp;******72 withdraw
                            EGP69,000&nbsp;&nbsp;******60 withdraw EGP216,000&nbsp;&nbsp;******71 withdraw
                            EGP217,000&nbsp;&nbsp;******16 recharged EGP134,000&nbsp;&nbsp;******97 withdraw
                            EGP45,000&nbsp;&nbsp;******85 withdraw EGP297,000&nbsp;&nbsp;******93 withdraw
                            EGP172,000&nbsp;&nbsp;******80 withdraw EGP204,000&nbsp;&nbsp;******30 withdraw
                            EGP212,000&nbsp;&nbsp;******97 recharged EGP102,000&nbsp;&nbsp;******60 recharged
                            EGP70,000&nbsp;&nbsp;******10 withdraw EGP12,000&nbsp;&nbsp;******10 recharged
                            EGP255,000&nbsp;&nbsp;******45 withdraw EGP8,000&nbsp;&nbsp;******74 withdraw
                            EGP277,000&nbsp;&nbsp;******57 withdraw EGP118,000&nbsp;&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>

        <div
            style="height: auto; position:relative; bottom:0px; width:96%; overflow: hidden; margin: 0 auto; margin-top:5px; font-size:12px; color:#000; padding-top:10px; padding-bottom:10px; border-radius: 5px">
            <div
                style="height: auto; overflow: hidden;  font-size: 12px; background: #1A1A1A; color: #fff;  padding: 10px; border-radius: 5px">
                <p
                    style="text-align: center; font-size: 20px; color: #fff; padding: 10px; padding-top: 0pc; font-weight: 500">
                    Account Overview</p>
                <div
                    style="float:left;  position:relative; background: url({{ asset('images/img14.jpg') }}); background-size: 100% 100%; width:49%; height:120px; border-radius: 10px;">
                    <div
                        style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 10px;">
                        <p style="padding: 5px">Accumulative income</p>
                        <p style="padding: 5px; font-size: 20px">{{ number_format($user->total_earnings,2) }}</p>
                    </div>
                </div>

                <div
                    style="float: right; position: relative; background: url({{ asset('images/img06.jpg') }}); background-size: 100% 100%; width: 49%; margin-left: 2%; height: 120px; border-radius: 10px; margin-bottom: 10px">
                    <div
                        style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; width: 100%; background: #00000098; border-radius: 10px;">
                        <p style="padding: 5px;">Total withdrawal</p>
                        <p style="padding: 5px; font-size: 20px">EGP{{ number_format($totalWithdraw,2) }}</p>
                    </div>
                </div>
                <div
                    style="width: 100%; background: none; position:relative; border-radius: 5px !important; margin: 10px auto;">
                    <div
                        style="text-align:center; width:100%; position:absolute; font-weight:bold; font-size:25px; background: #00000098; padding-bottom: 25px; color:#fff; border-radius: 5px">
                        <p style="margin-top: 10px; font-size: 18px; margin-bottom: 5px">Account balance</p>
                        EGP{{ $user->balance + $user->bonus_balance }}
                    </div>
                    <img src="{{ asset('images/ng.jpg') }}" style="width: 100%; border-radius: 5px !important;">
                </div>
            </div>
        </div>

        <div style="width: 95%; margin: 0 auto; margin-top: 5px; padding-bottom: 50px;">
        </div>
        

        @include('templates.basic.partials.footer')

        <script>
            function hideNotice() {
                var noticeDiv = document.getElementById("notice");
                noticeDiv.style.display = "none";
            }

            function showNotice() {
                var noticeDiv = document.getElementById("notice");
                if (noticeDiv) {
                    noticeDiv.style.display = "block";
                }
            }

            window.onload = showNotice;
        </script>

    </body>
@endsection
