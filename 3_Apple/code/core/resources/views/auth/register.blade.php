@extends('layouts.auth')


@push('page_title')
    Register
@endpush
@section('content')

    <body style="  background:url(/images/img00.jpg) no-repeat #000; background-size:100% 100%; ">jkjhkh

        <div
            style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color:rgb(226, 225, 225);">
            <div style="max-width:450px; width: 100%; margin: 0 auto;">
                <div style="padding: 20px;">
                    <div style="width: 98%; margin: 0 auto; background: #fff; border-radius: 20px;">
                        <div
                            style="text-align: center; font-size: 35px; color: #C0857E; font-weight: 500; display: flex; align-items: center; FLEX-DIRECTION: ROW; justify-content: space-around">
                            <div style="text-align: center; font-size: 25px; font-weight: 500; position: relative;">
                                <img src="{{ asset('assets/images/logoIcon/logo.png') }}" style="width:80%;" alt="logo">
                            </div>
                        </div>
                        <div class="layui-form" style="margin: 20px auto; width: 95%;">
                            <form action="" method="post">
                                @csrf
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px;">
                                        <font
                                            style="color: #333; background: #ddd; border-bottom-left-radius: 20px; border-top-left-radius: 20px; width: 50px; text-align: center; height: 45px; line-height: 45px;"
                                            id="moblie_qu">+234</font>
                                        <input type="number" value="" pattern="[0-9]*"
                                            style="height:45px; border-top-right-radius:20px; border-bottom-right-radius:20px;"
                                            name="mobile" placeholder="Enter Your phone number" class="layui-input" autocomplete="off"
                                            required="">
                                    </div>
                                </div>
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px;">
                                        <input type="password" name="password" style="height:45px;border-radius:25px;"
                                            maxlength="20" placeholder="Enter Your password" autocomplete="off"
                                            class="layui-input" required="">
                                    </div>
                                </div>
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px;">
                                        <input type="password" name="password_confirmation"
                                            style="height:45px;border-radius:25px;" maxlength="20"
                                            placeholder="Confirm Your password" autocomplete="off" class="layui-input"
                                            required="">
                                    </div>
                                </div>
                                {{--  <div class="layui-form-item" style="height:42px; margin-bottom: 5px; display: none">
                                    <div style="width:65%;float:left;">
                                        <div class="inputdiv" style="border-radius: 20px">
                                            <input type="hidden" name="verification_code" value="7874" maxlength="4"
                                                placeholder="Verification code"
                                                style="width:100%; height: 45px; border-radius: 20px" class="layui-input"
                                                autocomplete="off" required="">
                                        </div>
                                    </div>
                                    <style>
                                        .custom-span {
                                            font-family: 'Great Vibes', cursive;
                                        }
                                    </style>
                                    <div
                                        style="float:left; margin-left:3%;width:32%; display: flex; align-items: center; justify-content: space-around; flex-direction: column">
                                        <img class="verifyImg" id="verifyImg"
                                            style="width: 100%; height:46px;border-radius: 20px; background: #ddd">
                                        <a href="https://ap-intell.com/reg.html" class="custom-span" id="code"
                                            style="margin-top: -38px; font-size: 30px; font-weight: 800; font-family: Rajdhani; color: rgb(59, 59, 109);">7874</a>
                                    </div>
                                </div>  --}}
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px;">
                                        <input type="text" name="referBy"
                                            @if (session()->get('reference') != null) value="{{ session()->get('reference') }}" @endif
                                            enterkeyhint="done" autocomplete="off"
                                            style="height:45px;border-radius:25px;" maxlength="20"
                                            placeholder="Enter Invitation Code" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item"
                                    style="margin-top:20px; text-align:center; padding-bottom: 30px;">
                                    <button class="layui-btn"
                                        style="width: 55%; font-weight: 600; height: 45px; line-height: 45px; font-size: 16px; display: inline-block; background: #C0857E; color: #fff; border: 1px groove #c0c0c0; border-radius: 20px;"
                                        type="submit">Register</button>
                                    <a href="{{ route('user.login') }}" class="layui-btn"
                                        style="width: 35%; font-weight: 600; height: 45px; line-height: 45px; font-size: 16px; display: inline-block; background: #000; color: #fff; border: 1px groove #c0c0c0; border-radius: 20px;">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            // Array of Google Fonts to import
            var googleFonts = [
                "Amatic SC",
                "Bebas Neue",
                "Cormorant Garamond",
                "Dancing Script",
                "Exo",
                "Fjalla One",
                "Gochi Hand",
                "Indie Flower",
                "Josefin Sans",
                "Kalam",
                "Lobster",
                "Muli",
                "Noto Sans",
                "Oxygen",
                "Pacifico",
                "Questrial",
                "Rajdhani",
                "Satisfy",
                "Titillium Web",
                "Vollkorn",
                "Yanone Kaffeesatz",
            ];

            var colors = [
                "#8B0000", // dark red
                "#00008B", // dark blue
                "#8B008B", // dark magenta
                "#FF4500", // dark orange red
                "#4B0082", // indigo
                "#2F4F4F", // dark slate gray
                "#483D8B", // dark slate blue
                "#8B4513", // saddle brown
                "#556B2F", // dark olive green
                "#191970", // midnight blue
                "#2E0854", // dark purple
                "#800000", // maroon
                "#003366", // dark navy blue
                "#006400", // dark green
                "#3B3B6D", // dark violet-blue
                "#6A5ACD", // slate blue
                "#4C004C", // deep purple
                "#292421", // dark brownish-gray
                "#5F9EA0", // cadet blue
                "#2C3539", // gunmetal

            ];

            //select random color
            var randomColor = colors[Math.floor(Math.random() * colors.length)];

            // Select a random font from the array
            var randomFont = googleFonts[Math.floor(Math.random() * googleFonts.length)];
            var googleFontUrl = "https://fonts.googleapis.com/css2?family=" + randomFont.replace(/ /g, '+') + "&display=swap";

            // Create a link element to load the selected Google Font
            var linkElement = document.createElement("link");
            linkElement.rel = "stylesheet";
            linkElement.href = googleFontUrl;
            document.head.appendChild(linkElement);

            // Apply the selected font and color
            var codeElement = document.getElementById("code");
            codeElement.style.fontFamily = randomFont;
            codeElement.style.color = randomColor;
        </script>
    </body>
@endsection
