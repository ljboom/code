@extends('layouts.auth')


@push('page_title')
    Login
@endpush
@section('content')

    <body style=" background:url('/images/img00.jpg') no-repeat #000; background-size:100% 100%; ">

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

                        <form method="POST" action="">
                            @csrf
                            <div class="layui-form" style="margin:0 auto; width:90%;">
                                <div style="height: 20px; line-height: 20px; font-weight: 500;">
                                    Phone number
                                </div>
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px">
                                        <font
                                            style="color: #333; background: #ddd; border-bottom-left-radius: 20px; border-top-left-radius: 20px; width: 50px; text-align: center; height: 45px; line-height: 45px;"
                                            id="moblie_qu">+234</font>
                                        <input type="number" value="" pattern="[0-9]*"
                                            style="height:45px; border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;"
                                            name="mobile" oninput="if(value.length>10)value=value.slice(0,10)"
                                            placeholder="Your phone number" class="layui-input" autocomplete="off"
                                            required="">
                                    </div>
                                </div>
                                <div style="height: 20px; line-height: 20px; font-weight: 500;">
                                    Password
                                </div>
                                <div class="layui-form-item" style="height:48px;">
                                    <div class="inputdiv" style="border-radius: 20px">
                                        <input type="password" name="password" style="height:45px;border-radius:25px;"
                                            maxlength="20" placeholder="Your password" autocomplete="off"
                                            class="layui-input" required="">
                                    </div>
                                </div>

                                <div class="layui-form-item"
                                    style="margin-top:20px; padding-bottom: 30px; text-align:center;">
                                    <button class="layui-btn"
                                        style="width: 55%; font-weight: 600; height: 45px; line-height: 45px; font-size: 16px; display: inline-block; background: #C0857E; color: #fff; border: 1px groove #c0c0c0; border-radius: 20px;"
                                        type="submit">Login</button>
                                    <a href="{{ route('user.register') }}" class="layui-btn"
                                        style="width: 35%; font-weight: 600; height: 45px; line-height: 45px; font-size: 16px; display: inline-block; background: #000; color: #fff; border: 1px groove #c0c0c0; border-radius: 20px;">Register</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </body>
@endsection
