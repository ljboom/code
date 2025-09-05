@extends('layouts.users')

@push('style')
@endpush



@section('content')
    <script>
        "use strict"

        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function() {
                var distance = tms * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes + "m " +
                    seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                tms--;
            }, 1000);
        }
    </script>


    <style>
        p {
            line-height: 20px;
            font-size: 12px;
        }

        .typeover {
            background: linear-gradient(to right, #00A478, #3DC46D);
            border-width: 0px;
            border-color: #FCC12D;
            border-style: solid;
            color: #fff !important;
        }

        .type {
            background: linear-gradient(to right, #aaa, #ccc);
            border-width: 0px;
            border-color: rgb(9, 30, 76);
            border-style: solid;
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
        <div class="top" style="background: #191A1F; ">
            <div onclick="window.history.go(-1); return false;"
                style="float:left; line-height:46px;width:50%;cursor:pointer;" id="btnClose">
                <i class="layui-icon" style="color:#fff;  margin-left:12px; font-size:16px;  font-weight:bold;"></i>
            </div>
            <font class="topname">
                جهازي
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">
            </div>
        </div>
        <div style=" max-width:450px; margin:0 auto; position:relative; ">
            <div style="width:98%; margin:0 auto; margin-top:60px;">
                <div
                    style="background: #191A1F; height: 80px; width: 98%; margin: 0 auto; margin-top: 10px; border-radius: 5px; ">
                    <div id="in1"
                        style=" text-align: center; float: left; color: #fff; height: 80px; width: 48%; margin-left: 2%; border-radius: 5px; background-size: 100% 100%; ">
                        <div style="float: left; width: 30%; line-height: 80px; ">
                            <img src="{{ asset('iconsv2/product.svg') }}" style="height:36px; border-radius: 5px;"
                                class="colored">
                        </div>
                        <div style="float:left; width:70%; line-height: 30px;">
                            <div style="margin-top: 10px; font-size: 15px; font-weight: bold;">{{ $total_order }}</div>
                            <div style="font-size:12px;">أجهزتي</div>
                        </div>
                    </div>

                    <div id="in2"
                        style=" text-align: center; float: left; color: #fff; height: 80px; width: 48%; margin-left: 2%; border-radius: 5px; background-size: 100% 100%; ">
                        <div style="float: left; width: 30%; line-height: 80px; ">
                            <img src="{{ asset('iconsv2/product.svg') }}" style="height:36px; border-radius: 5px;"
                                class="colored">
                        </div>
                        <div style="float: left; width: 70%; line-height: 30px; ">
                            <div style="margin-top: 10px; font-size: 15px; font-weight: bold; ">₦ {{ number_format(auth()->user()->total_earnings, 2) }} </div>
                            <div style="font-size:12px;">إجمالي الإيرادات</div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                style="border-radius: 5px; padding: 5px; margin-top: 10px; background: #000; text-align: center; position: relative;">

                @forelse ($logs as $plan)
                    <div
                        style="height:auto; text-align:left; overflow:hidden; color:#333; background:#191A1F; margin:0 auto; width:100%; margin-top:10px;">
                        <div style="padding:10px; border-bottom: 1px solid #eee; height:auto; overflow:hidden;">
                            <div style="float:left; width:100%;">
                                <div
                                    style="height:27px; line-height:27px;display: flex;justify-content: space-between;font-size:12px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#888;">
                                        Amount:
                                    </span>
                                    <span style="color: #fff; font-weight:bolder;">
                                        ₦{{ number_format($plan->amount, 2) }}
                                    </span>
                                </div>
                                <div
                                    style="height:27px; line-height:27px;display: flex;justify-content: space-between;font-size:12px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#888;">
                                        Daily Income
                                    </span>
                                    <span style="color: #fff; font-weight:bolder;">
                                        ₦{{ number_format($plan->interest_amount) }}
                                    </span>
                                </div>
                                <div
                                    style="height:27px; line-height:27px;display: flex;justify-content: space-between;font-size:12px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#888;">
                                        Total Revenue
                                    </span>
                                    <span style="color: #fff; font-weight:bolder;">
                                        ₦{{ number_format($plan->interest_amount * $plan->total_return) }}
                                    </span>
                                </div>
                                <div
                                    style="height:27px; line-height:27px;display: flex;justify-content: space-between;font-size:12px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#888;">
                                        Total Paid
                                    </span>
                                    <span style="color: #fff; font-weight:bolder;">
                                        ₦{{ number_format($plan->total_paid * $plan->interest_amount, 2) }}
                                    </span>
                                </div>
                                @php
                                    $nextTime = \Carbon\Carbon::parse($plan->next_return_date);
                                @endphp

                                <script>
                                    createCountDown('counter{{ $plan->id }}', {{ $nextTime->diffInSeconds() }});
                                </script>

                                <div
                                    style="height:27px; line-height:27px;display: flex;justify-content: space-between; font-size:12px;">
                                    <span
                                        style="padding:3px; padding-left:0px; padding-right:10px; border-radius:10px; color:#888;">
                                        Next Date
                                    </span>
                                    <span style="color: #fff; font-weight:bolder;">
                                        <span class="info-value" id="counter{{ $plan->id }}"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="height:150px;line-height:150px; color: #fff">ليس لديك جهاز بعد</div>
                @endforelse




            </div>
        </div>


    </body>
@endsection
