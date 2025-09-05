





<div style="height: 20px; margin-bottom:100px;"></div>
<nav class="nav" style="background-size:100% 100%; height:60px; ">
    <a href="{{ route('user.home') }}">
        <div style="font-weight: bold;" class="navtab {{ Request::is('user/dashboard') == true ? 'active':'' }}">
            <img src="{{ asset('iconsv2/home.svg?v1') }}" class="gray" style="height: 28px;"> <br>
            <span id="nav_btn1">Home</span>
        </div>
    </a>
    <a href="{{ route('user.investment') }}">
        <div url="{{ route('user.investment') }}" class="navtab {{ Request::is('user/investment') == true ? 'active':'' }}">
            <img src="{{ asset('iconsv2/apple.svg') }}" class="gray" style="height: 28px;"> <br>
            <span id="nav_btn2">Product</span>
        </div>
    </a>
    <a href="{{ route('user.referrals') }}">
        <div url="{{ route('user.referrals') }}" class="navtab {{ Request::is('user/referrals') == true ? 'active':'' }}">
            <img src="{{ asset('iconsv2/team.svg') }}" class="gray" style="height:28px;"> <br>
            <span id="nav_btn3">Team</span>
        </div>
    </a>
    <a href="{{ route('user.profile.setting') }}">
        <div url="{{ route('user.profile.setting') }}" class="navtab {{ Request::is('user/profile-setting') == true ? 'active':'' }}">
            <img src="{{ asset('iconsv2/user.svg') }}" class="gray" style="height: 28px;"> <br>
            <span id="nav_btn4">Mine</span>
        </div>
    </a>
    <style>
        .active {
            color: #000 !important;
            font-weight: bold;
            filter: invert(75%) sepia(30%) saturate(350%) hue-rotate(336deg) brightness(110%) contrast(90%);
        }

        .filtered {
            filter: brightness(0) saturate(100%) invert(31%) sepia(82%) saturate(427%) hue-rotate(-50deg) brightness(92%) contrast(92%);
            mix-blend-mode: multiply;
        }
    </style>
</nav>
