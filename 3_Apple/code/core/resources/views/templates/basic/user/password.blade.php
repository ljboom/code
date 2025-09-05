@extends('layouts.users')

@section('content')
    <style type="text/css">
        .topname {
            line-height: 46px;
            font-weight: 700;
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
            border: 1px solid #D2D2D2 !important;
            background-color: #fff;
            height: 38px;
            line-height: 38px;
            padding: 0px 19px;
            border-radius: 5px;
            color: #000;
        }

        .layui-input {
            border-style: none;
            border-radius: 5px !important;
        }

        .layui-select-title {
            border-radius: 10px !important;
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
        <div style="width: 100%; margin: 0 auto; border-bottom: 0px solid #000; background: #191A1F; " class="top">
            <div onclick="window.history.go(-1); return false;"
                style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
                <i class="layui-icon" style=" color: #fff; margin-left: 12px; font-size: 18px; font-weight: bold;"></i>
            </div>
            <font class="topname" style="color: #fff;" id="topname1">
                Change Login Password
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">

            </div>
        </div>
        <div style=" max-width:450px; margin:0 auto;  ">
            <div class="layui-form layui-tab-content"
                style="padding: 5px 10px; margin-top: 60px; width:98%;  background: #191A1F;">
                <div class="layui-form layui-tab-content" style="padding: 10px 0;">
                    <form action="" method="post" class="layui-form">
                        @csrf
                        <div class="layui-form layui-form-pane">
                            <div class="layui-form-item layui-form-text">
                                <div class="layui-input-block" style="">
                                    <div style="margin: 10px; line-height:20px; color:#808080;   margin-top:0px;">
                                        <br>
                                        <div class="layui-form layui-form-pane">
                                            <div class="layui-form-item" style="height:48px;">
                                                <div class="inputdiv">
                                                    <i class="layui-icon layui-icon-password"></i>
                                                    <input type="password" maxlength="20" name="current_password"
                                                        placeholder="Old login password" class="layui-input"
                                                        autocomplete="off" required="">
                                                </div>
                                            </div>
                                            <div class="layui-form-item" style="height:48px;">
                                                <div class="inputdiv">
                                                    <i class="layui-icon layui-icon-password"></i>
                                                    <input type="password" name="password" id="password1" maxlength="20"
                                                        placeholder="New login password" class="layui-input"
                                                        autocomplete="off" required="">
                                                </div>
                                            </div>
                                            <div class="layui-form-item" style="height:48px;">
                                                <div class="inputdiv">
                                                    <i class="layui-icon layui-icon-password"></i>
                                                    <input type="password" name="password_confirmation" id="password2"
                                                        maxlength="20" placeholder="Confirm New login password"
                                                        class="layui-input" autocomplete="off" required="">
                                                </div>
                                            </div>
                                            <div class="layui-form-item" style="height:48px;">
                                                <button class="layui-btn" id="confirm"
                                                    style="width: 100%; border: 0px; color: #fff; background: #C0857E; height: 45px; line-height: 45px; border-radius: 25px; "
                                                    type="submit">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
@endsection
