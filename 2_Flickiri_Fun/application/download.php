<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus App Download</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
            background-color: #fff;
            z-index: 100;
        }

        .header .logo {
            display: flex;
            align-items: center;
        }

        .header .logo img {
            width: 40px;
            height: auto;
        }

        .header .logo span {
            font-size: 20px;
            font-weight: 900;
        }

        .header img {
            height: 56px;
        }

        .prod-title {
            display: flex;
            justify-content: space-between;
            margin-top: 90px;
            padding: 20px;
        }

        .prod-title img {
            width: 79px;
            height: auto;
            border-radius: 10px;
            border: 1px solid #EEE;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .3), 0 1px 3px 1px rgba(60, 64, 67, .15);
            margin-right: 24px;
        }

        .prod-title .title {
            font-family: "Google Sans", "Roboto", "Arial", "sans-serif";
            font-size: 1.5rem;
            font-weight: 510;
            color: #202124;
            margin-bottom: 5px;
        }

        .prod-title .subtitle {
            color: #01875f;
            font-size: .9rem;
        }

        .down-st {
            display: flex;
        }

        .down-st>div {
            position: relative;
            width: 150px;
            margin: 10px 0;
            text-align: center;
        }

        .down-l::after {
            position: absolute;
            top: 10px;
            bottom: 10px;
            width: 1px;
            right: 0;
            background-color: #d1d1d1;
            content: "";
        }

        .down-fit img {
            width: 16px;
        }

        .down-l>p:last-child {
            color: #666;
        }

        .down-fit>p {
            color: #666;
        }

        .down-fit>p>img {
            width: 12px;
            height: 12px;
            margin-left: 3px;
        }

        .download {
            display: flex;
        }

        .btn {
            flex: 1;
            margin: 30px 20px 20px;
            background: #01875f;
            color: #fff;
            text-align: center;
            height: 40px;
            line-height: 40px;
            border-radius: 5px;
        }

        .share {
            display: flex;
            margin-bottom: 30px;
            align-items: center;
            justify-content: center;
        }

        .share>p {
            margin: 0 20px;
            font-size: 14px;
            color: #01875f;
        }

        .share>p>img {
            width: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .dev {
            margin: 20px;
            color: #666;
            font-size: 14px;
        }

        .dev>img {
            height: 16px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .banner {
            display: flex;
            overflow-y: auto;
            align-items: center;
            justify-content: space-between;
            margin: 10px;
        }

        .banner>img {
            width: 115px;
            margin: 0 8px;
            border-radius: 6px;
        }

        .about {
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #333;
            font-weight: 900;
        }

        .about>img {
            height: 20px;
        }

        .exp {
            color: #666;
            margin: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="data:image/jpeg;base64,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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//9k=" alt="">
            <span>NX</span>
        </div>
        <img src="assets/img/top_right.png" alt="">
    </header>
    <div class="prod-title">
        <img src="logo.png" alt="">
        <div>
            <div class="title">Nexus-core official platform</div>
            <div class="subtitle">NX</div>
        </div>
    </div>
    <div class="down-st">
        <div class="down-l">
            <p>10K+</p>
            <p>Downloads</p>
        </div>
        <div class="down-fit">
            <img src="assets/img/unnamed.png" alt="">
            <p>Everyone<img src="assets/img/copyright.png" alt=""></p>
        </div>
    </div>
    <div class="download">
        <div class="btn" onclick="downApp(0)">Android</div>
        <div class="btn" onclick="downApp(1)">iPhone</div>
    </div>
    <div class="share">
        <p>
            <img src="assets/img/share.png" alt="">
            <span>Share</span>
        </p>
        <p>
            <img src="assets/img/add.png" alt="">
            <span>Add to wishlist</span>
        </p>
    </div>
    <p class="dev"><img src="assets/img/dev.png" alt="">You don't have devices</p>
    <div class="banner">
        <img src="bf1.jpeg" alt="">
        <img src="bf2.jpeg" alt="">
        <img src="bf3.jpeg" alt="">
        <img src="bf4.jpeg" alt="">
          <img src="bf5.jpeg" alt="">
    </div>
    <p class="about">
        <span>About this app</span>
        <img src="assets/img/arrow.png" alt="">
    </p>
    <p class="exp">Nexus-core official platform</p>
    <p class="exp">Nexus-core is a company headquartered in Victoria. There is an office in Victoria. The company obtained the authorized and regulatory of the Seychel Financial Services Authority (FSA), with a license sign number SD039, which provides the difference in the
        price of various basic products (CFD). The company is a rapidly developing differential contract provider and currently provides an investment portfolio of more than 2,800 financial instruments. Nexus-core has been listed on the main market of the London
        Stock Exchange, and is currently developing the Pakistani market</p>
</body>
<script>
    function downApp(t) {
        if (t) {
            window.location.href = ''
        } else {
            window.location.href = 'app.apk'
        }
    }
</script>

</html>