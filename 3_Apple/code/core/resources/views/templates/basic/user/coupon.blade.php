@extends('layouts.users')

@section('content')
    <style type="text/css">
        .indexdiv {
            background: #000;
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

        .topname {
            line-height: 46px;
            font-weight: 700;
            font-size: 16px;
            width: 50%;
            text-align: center;
            color: #000;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
        }


        .gray {
            /*grayscale(val):val值越大灰度就越深*/
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            filter: grayscale(100%);
            filter: gray;
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
            background: #C0857E;
        }
    </style>

    <body style="background-size: 100% auto; background: #000; ">
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
        <div class="indexdiv"></div>

        <div style="width: 100%; margin: 0 auto; background: #191A1F; border-bottom: 0px solid #000 " class="top">
            <div onclick="window.history.go(-1); return false;" style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
                <i class="layui-icon"
                    style=" color: #fff; margin-left: 12px; font-size: 18px; font-weight: bold;">&#xe603;</i>
            </div>
            <font class="topname" style="color: #fff;">
                Redeem Gifts
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">
                <!--<i class="layui-icon" style=" color:#fff; margin-right:10px; font-size:20px; " id="Record">&#xe60a;</i>-->
            </div>
        </div>
        <div style=" max-width:450px; margin:0 auto;">
            <div style=" height:auto;  width:100%; margin:0 auto; background:#fff;  overflow:hidden; margin-top:50px;  ">
                <div style="background: #f1f1f1;">
                    <img src="{{ asset('images/img01.jpg') }}" style="width:100%;" />
                </div>
                <div
                    style="width: 100%; max-width: 450px; background: #000; height: 220px; width: 100%; line-height: 35px; color: #000; text-align: center; font-size: 13px; padding-bottom:25px; border: 0px; height: auto; overflow: hidden;">
                    <form method="POST" action="">
                        @csrf
                        <input type="hidden" name="_token" value="bE6TqtLAUmc0UAedT0daMfO50bGinLxy5V1M8CAZ">
                        <div
                            style="background: #191A1F; width: 95%; margin: 0 auto; border-radius: 20px; margin-top: 15px; padding-bottom: 15px; padding-top: 15px;">
                            <div class="layui-form-item" style="height:48px; margin-top:10px;">
                                <div class="inputdiv">
                                    <input type="text" id="code"
                                        style="height:45px;border-radius:25px; width: 95%; margin: 0 auto" maxlength="20"
                                        placeholder="Please enter the gift redemption code" autocomplete="off"
                                        class="layui-input" name="code" required />
                                </div>
                            </div>
                        </div>

                        <div
                            style="width:100%;position:relative; margin:0 auto; margin-top:10px;height:auto;overflow:hidden;border:0px;">
                            <button type="submit" id="checkin"
                                style="width: 70%; margin: 0 auto; text-align: center; height: 40px; line-height: 40px; color: #fff; border-radius: 100px; background: #C0857E; ">
                                Receive
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
