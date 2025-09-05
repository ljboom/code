{{-- @extends($activeTemplate.'layouts.master') --}}
@extends('layouts.users')

@section('content')

    <body style="min-height: 100%; width: 100%; background-size: 100% auto;  background: #000; ">
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
        <div style=" max-width:450px; margin:0 auto; position:relative;">
            <div class="top1">
            </div>

            <img src="{{ asset('images/ng.jpg') }}" style="width: 100%; border-radius: 5px; margin-top: 10px">

            <div onclick="window.location.href='{{ route('user.investment.log') }}'" style="text-align: center; margin-bottom: 10px; position:relative; ">
                <div
                    style="background: #191A1F; height: 80px; width: 98%; margin: 0 auto; margin-top: 10px; border-radius: 5px; ">
                    <div id="in1"
                        style=" text-align: center; float: left; color: #fff; height: 80px; width: 48%; margin-left: 2%; border-radius: 5px; background-size: 100% 100%; ">
                        <div style="float: left; width: 30%; line-height: 80px; ">
                            <img src="{{ asset('iconsv2/product.svg') }}" style="height:36px; border-radius: 5px;"
                                class="colored">
                        </div>
                        <div style="float:left; width:70%; line-height: 30px;">
                            <div style="margin-top: 10px; font-size: 15px; font-weight: bold;">{{ $orders }}</div>
                            <div style="font-size:12px;">My Devices</div>
                        </div>
                    </div>

                    <div id="in2"
                        style=" text-align: center; float: left; color: #fff; height: 80px; width: 48%; margin-left: 2%; border-radius: 5px; background-size: 100% 100%; ">
                        <div style="float: left; width: 30%; line-height: 80px; ">
                            <img src="{{ asset('iconsv2/product.svg') }}" style="height:36px; border-radius: 5px;"
                                class="colored">
                        </div>
                        <div style="float: left; width: 70%; line-height: 30px; ">
                            <div style="margin-top: 10px; font-size: 15px; font-weight: bold; ">NGN
                                {{ number_format(auth()->user()->total_earnings, 2) }}</div>
                            <div style="font-size:12px;">Total revenue</div>
                        </div>
                    </div>
                </div>
            </div>


            <div
                style="text-align: center; width: 98%; margin: 0 auto; margin-bottom: 70px; background: #000; border-radius: 5px; ">

                @php

                    $count = 0;

                @endphp
                @foreach ($plans as $plan)
                    @php $count++; @endphp
                    <div class="buy" value="1" imgurl=""
                        style="background: #191A1F; width: 98%; margin: 0 auto; margin-top:10px; border-radius: 5px; padding-top:10px; padding-left:5px; padding-bottom:10px; height: auto; overflow: hidden; ">
                        <div style="float:left; width:25%; display: flex; justify-content:center; align-items:center;">
                            <img src="{{ asset('assets/global/images/' . $count . '.jpg') }}"
                                style="width:100%; border-radius: 5px; margin-top:10px;">
                        </div>
                        <div style="float:left; width:75%; text-align:left; position:relative;">

                                <button onclick="flex({{ $plan->id }})" type="button"
                                    style="position: absolute; background: #ddd; color: #000; text-align: center; border-radius: 25px; line-height:25px; right: 10px; bottom: 5px; font-size:12px; width: 70px; height: 25px;border:none;">
                                    Buy
                                </button>

                            {{--  <div
                            style="position: absolute; color:  #C0857E; text-align: right; right: 10px; top: 5px; font-size:12px; width: 70px; height: 25px;">
                            0 / 0
                        </div>  --}}
                            <div style="padding-left:10px; font-size:12px; color: #fff;">
                                <div
                                    style="height:auto; line-height:30px; font-weight:bold; font-size:16px;height: auto; overflow: hidden; color:#fff; font-family: HarmonyOS Sans SC;">
                                    {{ $plan->name }}</div>
                                <div style="height: 18px; line-height: 18px;">Price: <font
                                        style="font-weight:bold; color:  #C0857E;">
                                        EGP{{ number_format($plan->min_amount, 2) }}
                                    </font>
                                </div>
                                <div style="height: 18px; line-height: 18px;">Validity period: <font
                                        style="font-weight:bold; color:  #C0857E;">{{ $plan->total_return }}</font> day
                                </div>
                                <div style="height: 18px; line-height: 18px;">Daily income: <font
                                        style="font-weight:bold; color:  #C0857E;">
                                        EGP{{ number_format($plan->interest_amount, 2) }}</font>
                                </div>
                                <div style="height: 18px; line-height: 18px;">Total income: <font
                                        style="font-weight:bold; color:  #C0857E;">
                                        EGP{{ number_format($plan->interest_amount * $plan->total_return, 2) }}</font>
                                </div>
                                <div style="height: 28px; line-height:38px; display: none">Today's quantity:<font
                                        style="font-weight:bold; color:  #C0857E;"> 5/10</font>
                                </div>
                                <div style="height: 23px; line-height:23px; display: none">
                                    <font style="font-weight:bold; color:  #C0857E;">Updated daily at 12:00</font>
                                </div>

                                <div style="height: 23px; line-height:23px; font-size: 10px">Product purchase not started.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="position: fixed; top: 50%; left: 50%; display: none; transform: translate(-50%, -50%); text-align: center; margin: 0px auto; z-index: 102; height: 470px; width: 100%; max-width: 450px;"
                        id="{{ $plan->id }}">
                        <div
                            style="position: relative; width: 100%; text-align: center; background: #C0857E; height: auto; margin: 0 auto; width: 90%; box-shadow: 0 0.8vw 2.667vw 1px rgb(0 0 0 / 56%);
                            // background:url(/images/product.png); background-size: 100% 100%;
                            height: 420px; border-radius: 10px; color: #000;">
                            <div style="float: left; width: 100%; text-align:center; height:120px;">
                                <img id="imgurlss" src="{{ asset('assets/global/images/' . $count . '.jpg') }}"
                                    style="width: 160px;  border-radius: 5px;">
                            </div>
                            <div style="font-weight: bold;  padding-bottom: 30px; padding-top: 55px; text-align: center;  color:#ddd; font-size: 20px;"
                                id="pname">
                                &nbsp;
                            </div>
                            <div style=" text-align: center; color: #000; font-size: 12px; padding-bottom: 30px;">
                                <div style="font-weight: bold; text-align: center;  color:#000; font-size: 20px;">
                                    {{ $plan->name }}
                                </div>
                            </div>
                            <div
                                style=" text-align: left; color: #fff;  padding-top: 5px; font-size: 12px; height: auto; overflow: hidden;">
                                <div style="float: left; width: 63%; margin-left: 2%;">
                                    <div style="padding: 5px; padding-top: 10px;">السعر: <font id="price"
                                            style="color: #000">EGP{{ number_format($plan->min_amount) }}</font>
                                    </div>
                                    <div style="padding: 5px;" id="dayin">الدخل اليومي : <font id="hour_income"
                                            style="color: #000">EGP{{ number_format($plan->interest_amount) }}</font>
                                    </div>
                                    <div style="padding: 5px;">إجمالي الدخل : <font id="total_income" style="color: #000">
                                            EGP{{ number_format($plan->interest_amount * $plan->total_return) }}</font>
                                    </div>
                                    <div style="padding: 5px;">فترة الصلاحية : <font id="dayss" style="color: #000">
                                            {{ $plan->total_return }} day
                                        </font>
                                    </div>
                                </div>
                            </div>
                            <div
                                style="width: 100%; margin-bottom: 14px; margin-top: 30px; padding-top:0px; padding-bottom:25px; height: auto; overflow: hidden;">
                                <div style="float: left; width: 50%; height: auto; overflow: hidden;">
                                    <button class="cmbtn"
                                        style="color: #aaa; width: 80%; margin: 0 auto; border: 0px; background: #eee; height: 40px; line-height: 40px; border-radius: 25px;"
                                        onclick="hideElement({{ $plan->id }})">يلغي</button>
                                </div>
                                <form action="{{ route('user.investment') }}" method="post" style="float: right; width: 50%; height: auto; overflow: hidden;">
                                    @csrf
                                    <input name="id" type="hidden" value="{{ $plan->id }}">
                                    <button type="submit" class="cmbtn"
                                        style="color: #fff; background: #000; width: 80%; margin: 0 auto; height: 40px; line-height: 40px; border-radius: 25px;">التاكيد</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>


            @include('templates.basic.partials.footer')
        </div>
        <script>
            function flex(id) {
                document.getElementById(id).style.display = "flex";
            }

            function hideElement(id) {
                document.getElementById(id).style.display = "none";
            }
        </script>

    </body>
@endsection



@push('style')
    <style type="text/css">
        #copyBoard {
            cursor: pointer;
            height: 100%;
        }

        .input-group-text {
            background-color: #0a1227;
            border: 1px solid #373768;
            color: #fff;
        }

        #referralURL {
            background: #20204e;
            border-color: #20204e;
            color: #fff;
        }

        #social-links ul li {
            list-style: none !important;
            display: inline-block;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: "classic"
            });
        });
        (function($) {

            "use strict";
            $('.planModal').on('click', function() {
                var modal = $('#planModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find($('#planModalLabel').text($(this).data('name')));
            });
            $('.copyBoard').click(function() {
                "use strict";
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);
    </script>
@endpush
