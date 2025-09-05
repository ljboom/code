<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"  >
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>


<title>NEXUS-CORE |</title>


<meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap">
          

    <script src="{{asset ('css/dash/assets/themes/lightorange/js/perfect-scrollbar.js')}}"></script>


    <link rel="stylesheet" href="{{asset ('css/dash/assets/themes/lightorange/css/color.css')}}">



<link rel="stylesheet" type="text/css" href="{{asset ('css/dash/assets/themes/lightorange/css/bootstrap.min.css')}}"/>
    






<style>



 #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: rgba(31, 28, 28, 0.5);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: white;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

#snackbar_error {
  visibility: hidden;
  width: 40%;
  margin-left: 5px;
  background-color: whitesmoke;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: black;
  text-align: center;
  border-radius: 10px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 30%;
  bottom: 50%;
  font-size: 17px;
}

#snackbar_error.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {
    bottom: 50%;
    opacity: 0;
  }
  to {
    bottom: 50%;
    opacity: 1;
  }
}

@keyframes fadeout {
  from {
    bottom: 50%;
    opacity: 1;
  }
  to {
    bottom: 50%;
    opacity: 0;
  }
}

@media (min-width: 576px) and (max-width: 767px) {
  #snackbar_error {
    width: 60%;
    left: 20%;
    bottom: 70px;
    font-size: 12px;
  }
  #snackbar {
    width: 50%;
    left: 25%;
    bottom: 70px;
    font-size: 12px;
  }
}
@media (max-width: 575.99px) {
  #snackbar_error {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
  #snackbar {
    width: 80%;
    margin-left: 5px;
    left: 10%;
    font-size: 12px;
  }
}

        /* Styles for the preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black
        }
</style>


 <script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('a').click(function() 
    {
        $('#loader').show();
    }) 
})
</script>
<script>
    $(document).ready(function() 
{
    $('#loader').hide();

    $('form').submit(function() 
    {
        $('#loader').show();
    }) 
})
</script>



    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
    <title>
         Home
    </title>
    <script>
        document.onreadystatechange = function () {
            var state = document.readyState;
            if (state == "interactive") {
                // Show the preloader when the page starts loading
                showPreloader();
            } else if (state == "complete") {
                // Hide the preloader when the page finishes loading
                hidePreloader();
            }
        };

        function showPreloader() {
            document.getElementById("preloader").style.display = "flex";
            document.getElementById("blurred-background").style.display = "block";
        }

        function hidePreloader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("blurred-background").style.display = "none";
        }

    </script>
</head>

<body class="main-layout m-0 p-0">
    <!-- loader  -->
    <div id="preloader">
        <i class="fa-regular fa-loader fa-flip fa-10x"></i>
        <div class="loader"><img src="https://sdf-ultrawatch.shop/core/img/preview2.gif" alt="" style="height: 80; width: 80px;">
        </div>
    </div>
    <!-- end loader -->







<style>
.navbar {
    overflow: hidden;
    background-color: #fff;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 879;
    box-shadow: 0px 0px 17px 0px rgb(0 0 0 / 49%);
    padding: 0;
    border-top: 0.1rem solid #000;
}

.navbar a {
  float: left;
  display: block;
  color: #000;
  text-align: center;
  padding: 4px 8px;
  text-decoration: none;
  font-size: 11px;
  font-family: 'Ubuntu', sans-serif;
}

.navbar a:hover {
    background: #000;
    color: #fff;
}

.main {
  padding: 16px;
  margin-bottom: 30px;
}

</style>



<body>
<!-- DASHBOARD-PAGE-LAYOUT -->
<div id="dashboard-page-layout" class="theme-dark" bis_skin_checked="1">
    <!-- DASHBOARD-HEADER -->
    <header id="dashboard-header">

        @yield('app_content')
      

     
      <div class="navbar">
  <!--<a href="https://mipgroup.link/user/payout" class="active"><img src="https://futurelifebusiness.com/resources/views/themes/lightorange/imgs/navbar_icon_8.png" ><br>Witdraw</a>-->
  <a  onclick="login()"  href="{{route ('dashboard')}}"><img style="width: 20px;" src="{{asset ('home.png')}}"><br>Home</a>
    <a onclick="login()"  href="{{route ('user.team')}}"><img style="width: 20px;" src="{{asset ('team.png')}}"><br>Team</a>
    <a onclick="login()"  href="{{route ('ordered')}}"><img style="width: 20px;" src="{{asset ('dev.png')}}"><br>Device</a>

    <!--<a href="#"><img style="width: 20px;" src="https://img.icons8.com/ios-glyphs/100/mine.png"><br>Mine</a>-->
    
    
    <a href="#">
    <!-- NAVBAR | NAVBAR-LOGGEDIN -->
        <nav id="navbar" class="navbar-loggedin" style="background: #fff;">
            <div>
                <div id="pushNotificationArea" style="padding: 0px 0; max-height: initial; box-shadow: none; border-top: 0;">
                    <div class="d-flex">
                        <button class="sidenavbar-toggler d-lg-none" type="button">
                            <div>
                                <img style="width: 20px;" src="{{asset ('mine.png')}}"><br>More
                            </div>
                        </button>
                    </div>

                    <div class="account d-flex d-md-none">
                    </div>
                </div>
            </div>
        </nav>
        <!-- /NAVBAR -->
    </a>
        
    <!--<a href="https://mipgroup.link/user/add-fund"><img src="https://futurelifebusiness.com/resources/views/themes/lightorange/imgs/navbar_icon_9.png" ><br>Deposit</a>-->
</div>


<script>
    function loginTab(_this, tabberName){
        var elements = document.querySelectorAll('.tabber');
        for (let i=0;i<elements.length;i++){
            if (elements[i].classList.contains('active')){
                elements[i].classList.remove('active')
            }
        }

        _this.classList.add('active')

        var loginAuthVia = document.querySelector('.loginAuthVia');

        if (tabberName == 'phone'){
            loginAuthVia.innerHTML = `
                <div class="input-box">
                    <div class="input-left-slot"></div>
                    <input type="text" placeholder="Phone" name="auth" class="w-full">
                    <div class="input-right-slot"></div>
                </div>
                `;
        }
        if (tabberName == 'email'){
            loginAuthVia.innerHTML = `
                <div class="input-box">
                    <div class="input-left-slot"></div>
                    <input type="text" placeholder="Email" name="auth" class="w-full">
                    <div class="input-right-slot"></div>
                </div>
                `;
        }
    }

    function login(){
        document.querySelector('.loader').style.display = 'block';
        document.querySelector('form').submit();
    }

    window.onload = function() {
        document.querySelector('.loader').style.display = 'none';
    };

    function eye() {
        var pass = document.querySelector('input[name="password"]');
        if (pass.type == 'password') {
            pass.type = 'text'
        } else {
            pass.type = 'password'
        }
    }
</script>

     





        <!-- SIDENAVBAR -->
        <div id="sidenavbar" bis_skin_checked="1">
            <div class="sidenav-header" bis_skin_checked="1">
                <p class="sidenav-close">×</p>
            </div>
       <center   ><h1><b Style="color:#f5c33e;">   Nexus Core</b></h1></center>
            <div class="sidenavbar-wrapper" bis_skin_checked="1">
                <div class="dashboard-nav" bis_skin_checked="1">
                    <a class="das-nav nav-item active " href="{{route('dashboard')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
    
        </div>
        <span   style="color:black;">Home</span>
    </div>
</a>

<br>




<a onclick="login()" class="das-nav nav-item" href="{{route('user.invite')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
    
        </div>
        <span style="color:black;">Invite Friend</span>
    </div>
</a>
<br>

<a onclick="login()" class="das-nav nav-item" href="{{route('user.rule')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
    
        </div>
        <span style="color:black;">About Company</span>
    </div>
</a>

<br>



<a onclick="login()" class="das-nav nav-item " href="{{route('ordered')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
  
        </div>
        <span style="color:black;">My Device</span>
    </div>
</a>

<br>
<a onclick="login()" class="das-nav nav-item " href="{{route('user.bank.create')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
  
        </div>
        <span style="color:black;">Bank Setup</span>
    </div>
</a>

<br>

<a onclick="login()" class="das-nav nav-item " href="{{route('user.balance.history')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
            
      </div>
        <span style="color:black;">Total User History</span>
    </div>
</a>

<br>
<a onclick="login()" class="das-nav nav-item " href="{{route('deposit.history')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
            
      </div>
        <span style="color:black;">Deposit History</span>
    </div>
</a>
<br>
<a onclick="login()" class="das-nav nav-item  " href="{{route('withdraw.history')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">

        </div>
        <span style="color:black;" >Withdraw History</span>
    </div>
</a>


<br>





<a onclick="login()" class="das-nav nav-item " href="{{route('user.change.password')}}">
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
 
        </div>
        <span style="color:black;">Change Password</span>
    </div>
</a>

<br>





<a onclick="login()" class="das-nav nav-item" href="{{route('logout')}}" 
                       >
    <div class="icon-wrapper" bis_skin_checked="1">
        <div class="nav-icon" bis_skin_checked="1">
   
        </div>
        <span style="color:black;">Sign Out</span>
    </div>
</a>




                </div>
            </div>
        </div>
     





<script src="{{asset ('css/dash/assets/themes/lightorange/js/jquery-3.3.1.min.js')}}"></script>

<script src="{{asset ('css/dash/assets/global/js/jquery-ui.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/global/js/popper.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/global/js/bootstrap.min.js')}}"></script>

<script src="{{asset ('css/dash/assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>

<script src="{{asset ('css/dash/assets/themes/lightorange/js/fontawesome.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/wow.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/jquery.flagstrap.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/slick.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/owl.carousel.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/multi-animated-counter.js')}}"></script>
<script src="{{asset ('css/dash/assets/themes/lightorange/js/radialprogress.js')}}"></script>

<script src="{{asset ('css/dash/assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/global/js/vue.min.js')}}"></script>
<script src="{{asset ('css/dash/assets/global/js/axios.min.js')}}"></script>

<script src="{{asset ('css/dash/assets/themes/lightorange/js/user-script.js')}}"></script>




<script>
    function loginTab(_this, tabberName){
        var elements = document.querySelectorAll('.tabber');
        for (let i=0;i<elements.length;i++){
            if (elements[i].classList.contains('active')){
                elements[i].classList.remove('active')
            }
        }

        _this.classList.add('active')

        var loginAuthVia = document.querySelector('.loginAuthVia');

        if (tabberName == 'phone'){
            loginAuthVia.innerHTML = `
                <div class="input-box">
                    <div class="input-left-slot"></div>
                    <input type="text" placeholder="Phone" name="auth" class="w-full">
                    <div class="input-right-slot"></div>
                </div>
                `;
        }
        if (tabberName == 'email'){
            loginAuthVia.innerHTML = `
                <div class="input-box">
                    <div class="input-left-slot"></div>
                    <input type="text" placeholder="Email" name="auth" class="w-full">
                    <div class="input-right-slot"></div>
                </div>
                `;
        }
    }

    function login(){
        document.querySelector('.loader').style.display = 'block';
        document.querySelector('a').href();
    }

    window.onload = function() {
        document.querySelector('.loader').style.display = 'none';
    };

    function eye() {
        var pass = document.querySelector('input[name="password"]');
        if (pass.type == 'password') {
            pass.type = 'text'
        } else {
            pass.type = 'password'
        }
    }
</script>

   @include('alert-message')
   
   