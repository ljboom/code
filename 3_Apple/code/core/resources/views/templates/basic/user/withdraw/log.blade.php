@extends('layouts.users')

@push('style-lib')

    @section('content')
        <style type="text/css">
            .topname {
                line-height: 46px;
                font-size: 14px;
                width: 75%;
                text-align: center;
                color: #fff;
                position: absolute;
                font-weight: bold;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                margin: auto;
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
                font-weight: bold;
                margin-left: 3%;
                cursor: pointer;
                font-family: 黑体;
                font-size: 13px;
            }
        </style>

        <body style="background-size: 100% auto; background:#000 ;">

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
                <font class="topname">
                    سحل الانسحاب
                </font>
                <div style="float:right; text-align:right; line-height:46px;width:50%;">

                </div>
            </div>
            <div style="max-width:450px; margin:0 auto; height:auto; overflow:hidden;">
                <div style=" width: 100%; margin: 0 auto; position: relative; margin-top: 50px;">


                    @foreach ($withdraws as $k => $data)
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
                                        ₦ {{ number_format($data->amount) }}
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
                    @endforeach

                </div>
            </div>

        </body>
    @endsection
