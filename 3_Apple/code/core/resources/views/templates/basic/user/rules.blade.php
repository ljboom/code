@extends('layouts.users')


@section('content')
    <style type="text/css">
        .topname {
            line-height: 46px;
            width: 75%;
            text-align: center;
            color: #000;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            font-size: 14px;
        }
    </style>

    <body style="min-height: 100%; width: 100%; background-size: 100% auto;  background: #000;; ">
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
        <div style=" max-width:450px; margin:0 auto;">
            <div class="top1">
            </div>
            <div class="top" style="background: #4B4B4B; ">
                <div onclick="window.history.go(-1); return false;" style="float:left; line-height:46px;width:50%;cursor:pointer;" id="btnClose">
                    <i class="layui-icon" style="color:#fff;  margin-left:12px; font-size:16px;  font-weight:bold;"></i>
                </div>
                <font class="topname" id="title" style="color: #fff; text-overflow: ellipsis; overflow: hidden; ">
                    RULES
                </font>
                <div style="float:right; text-align:right; line-height:46px;width:50%;">
                </div>
            </div>

            <div style="width: 98%; margin: 0 auto; margin-top:45px; background: #000;; border-radius: 5px;">
                <div style="padding: 10px;">
                    <div style=" width:100%;" id="info">

                        <style>
                            body {
                                background: #aaa;
                                margin: 0;
                                font-family: Arial, Helvetica, sans-serif;

                            }

                            .header {
                                padding: 5px;
                                text-align: center;
                                background: #640000;
                                color: #fffaf0;
                            }

                            .header h1 {
                                font-size: 25px;
                            }

                            h2 {
                                color: #fffaf0;
                                text-align: center;
                                font-size: 20px;
                            }

                            .navbar {
                                overflow: hidden;
                                background-color: #ddd;
                            }

                            .navbar a {
                                float: left;
                                display: block;
                                color: #fffaf0;
                                text-align: center;
                                padding: 14px 20px;
                                text-decoration: none;
                            }

                            .navbar a.right {
                                float: right;
                            }

                            .navbar a:hover {
                                background-color: #aaa;
                                color: #fffaf0;
                            }

                            .main {
                                display: flex;
                                flex: 95%;
                                background-color: #000;
                                padding: 0px;
                                padding-top: 10px;
                                /*border-bottom-left-radius: 20px;*/
                                /*border-bottom-right-radius: 20px;*/
                                justify-content: center;
                                align-items: center;
                            }

                            table {
                                border-collapse: collapse;
                                width: 100%;
                                font-size: 8px;
                                font-weight: 500;
                            }

                            th,
                            td {
                                text-align: center;
                                padding: 5px;
                            }

                            td {
                                font-size: 8px;
                            }

                            tr:nth-child(odd) {
                                background-color: #fff;
                                color: #000
                            }

                            tr:nth-child(even) {
                                background-color: #000;
                                color: #fff
                            }
                        </style>

                        <h2 style="background: #000; padding-top: 5px; font-size: 10px; display: none">Apple Intelligence
                            Product Income Table.</h2>
                        <div class="main" style="display: none">
                            <table style="white-space: nowrap;">
                                <tbody>
                                    <tr style="background: #000; color: #fff">
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Daily Income</th>
                                        <th>Validity Period</th>
                                        <th>Total Income</th>
                                    </tr>
                                    <tr>
                                        <td>iPhone 13 Mini</td>
                                        <td>₦2,800</td>
                                        <td>₦700</td>
                                        <td>40 Days</td>
                                        <td>₦28,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 13</td>
                                        <td>₦8,800</td>
                                        <td>₦2,200</td>
                                        <td>40 Days</td>
                                        <td>₦88,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 13 Pro</td>
                                        <td>₦18,000</td>
                                        <td>₦4,800</td>
                                        <td>40 Days</td>
                                        <td>₦192,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 15 Mini</td>
                                        <td>₦28,000</td>
                                        <td>₦7,000</td>
                                        <td>40 Days</td>
                                        <td>₦280,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 15</td>
                                        <td>₦58,000</td>
                                        <td>₦14,500</td>
                                        <td>40 Days</td>
                                        <td>₦580,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 15 Pro</td>
                                        <td>₦108,000</td>
                                        <td>₦27,000</td>
                                        <td>40 Days</td>
                                        <td>₦1,080,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 16 Mini</td>
                                        <td>₦280,000</td>
                                        <td>₦70,000</td>
                                        <td>40 Days</td>
                                        <td>₦2,800,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 16</td>
                                        <td>₦580,000</td>
                                        <td>₦145,000</td>
                                        <td>40 Days</td>
                                        <td>₦5,800,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 16 Pro</td>
                                        <td>₦1,080,000</td>
                                        <td>₦270,000</td>
                                        <td>40 Days</td>
                                        <td>₦10,800,000</td>
                                    </tr>
                                    <tr>
                                        <td>iPhone 16 Pro Max</td>
                                        <td>₦2,080,000</td>
                                        <td>₦520,000</td>
                                        <td>40 Days</td>
                                        <td>₦20,800,000</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div style="width: 100%; height: 3px; background: #000"></div>
                        <div style="background: #000; padding: 1px; color: #fff; font-weight: 800; display: none">
                            <p style="text-align: center; font-size: 8px">Invite friends to invest, get 35% cash back.</p>
                        </div>

                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                        <div style="background: #000; padding: 0px; font-family: 'Segoe UI', sans-serif;">
                            <!-- Benefits List -->
                            <div style="padding: 5px; background: #000; border-radius: 12px;">
                                <ul
                                    style="list-style-type: square; padding-left: 10px; margin: 0; text-align: left; color: #fff">
                                    <!-- <li style="font-size: 15px; color: #fff; margin-bottom: 12px;">
                                            <i class="fa-solid fa-thumbs-up" style="color: #00ff7f; margin-right: 8px;"></i>
                                            Registration Bonus: ₦500
                                        </li>
                                        <li style="font-size: 15px; color: #fff; margin-bottom: 12px;">
                                            <i class="fa-solid fa-calendar-check" style="color: #00ff7f; margin-right: 8px;"></i>
                                            Daily Check-in Bonus: ₦100
                                        </li> -->
                                    <br>
                                    <br>
                                    <li style="font-size: 12px; color: #fff; margin-bottom: 12px;">
                                        Apple Intelligence, established in 1976 by Steve Jobs, Steve Wozniak, and Ronald
                                        Wayne, is a pioneering tech company famous for groundbreaking devices like the
                                        iPhone, iPad, and Mac. It has transformed computing and continues to set trends in
                                        innovation and design.<br>
                                        <br>

                                        1. Start with ₦2800 today and collect ₦1400 by tomorrow.<br>
                                        2. Join the Telegram community to discover ways to increase your earnings.<br>
                                        3. Withdraw anytime you want, with no limits on withdrawal times or the number of
                                        withdrawals.<br>
                                        4. Get a ₦500 bonus just for registering.<br>
                                        Receive ₦50 daily as a login reward.<br>
                                        5. Apple Intelligence commenced operations in Nigeria on January 01, 2025.<br>
                                        6. Earn 25% of your friend’s investment amount as a bonus when you invite them to
                                        join.<br>
                                        <br><br>
                                        <!-- <i class="fa-solid fa-people-arrows" style="color: #00ff7f; margin-right: 8px;"></i> -->
                                        When a friend you invite registers and invests, you will immediately receive a cash
                                        reward of 30% of the friend's investment amount.<br><br>
                                        When your Level 2 team members invest, you will receive a 3% cash bonus.<br><br>
                                        When your Level 3 team members invest, you will receive a 2% cash bonus.<br><br>
                                        Once your team member invests, the cash bonus is instantly credited to your account
                                        balance and you can withdraw it right away.
                                    </li>
                                    <!-- <li style="font-size: 15px; color: #fff; margin-bottom: 12px;">
                                            <i class="fa-solid fa-coins" style="color: #00ff7f; margin-right: 8px;"></i>
                                            Level 1 Commission: 30%
                                        </li>
                                        <li style="font-size: 15px; color: #fff; margin-bottom: 12px;">
                                            <i class="fa-solid fa-coins" style="color: #00ff7f; margin-right: 8px;"></i>
                                            Level 2 Commission: 3%
                                        </li>
                                        <li style="font-size: 15px; color: #fff;">
                                            <i class="fa-solid fa-coins" style="color: #00ff7f; margin-right: 8px;"></i>
                                            Level 3 Commission: 2%
                                        </li> -->
                                </ul>
                            </div>
                        </div>

                        <!-- <div class="header">
                              <h1>Apple Intelligence</h1>
                              <p>Durable, Affordable & Suitable</p>
                            </div> -->


                        <!-- <img style="width: 100%;" src="/images/welcome2.jpg"> -->
                    </div>
                </div>
            </div>
        </div>

    </body>
@endsection
