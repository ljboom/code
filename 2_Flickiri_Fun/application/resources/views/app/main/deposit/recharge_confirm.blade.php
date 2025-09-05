<html lang="">
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/content/location/location.js"
    id="eppiocemhmnlbhjplcgkofciiegomcon"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/extend-native-history-api.js"></script>
<script src="chrome-extension://eppiocemhmnlbhjplcgkofciiegomcon/libs/requests.js"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="icon" href="/Sonatrach/dist/favicon.ico">
    <title>Tuffnells Pro|Deposit</title>

    <link href="{{asset ('dash2/p/chunk-vendors.317e4ea8.css')}}" rel="stylesheet">
    <link href="{{asset ('dash2/p/app.1af1dbde.css')}}" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('public/ddd.css')}}">

    <style>
        #upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            color: #333;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #ddd;
        }

        #file-input {
            display: none;
        }

        #file-name-display {
            margin-top: 10px;
        }

        /* Apply basic styles to the input text */
        .styled-input {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px
        }

        /* Style the input when focused */
        .styled-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        span#acnum {
            width: 80%;
            overflow: hidden;
        }

    </style>
    <style>
.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
</head>
<body>
<div id="root">
    <div class="transfer-cashier-page theme-default">
        <div style="background-image: linear-gradient(to right, #14ae8e , #41ed91); " class="transfer-cashier-content">
            <div class="transfer-cashier-title"><p class="transfer-cashier-title-desc">Total Amount to be paid</p>
                <p class="transfer-cashier-title-amount">{{price($amount)}}</p></div>
            <div class="transfer-cashier-card">
                <div class="transfer-cashier-card-content">
           
                    <div class="transfer-cashier-card-tip warn"></div>

                    <div class="transfer-cashier-card-info">
                        <div class="transfer-cashier-card-info-item">
                            <div class="transfer-cashier-card-info-title">Method Name</div>
                            <div class="transfer-cashier-card-info-val"><span
                                    id="bkname">{{$payment_method->name}}</span>
         
                            </div>
                        </div>
                        <div class="transfer-cashier-card-info-item">
                            <div class="transfer-cashier-card-info-title">Account&nbsp;Number</div>
                            <div  class="transfer-cashier-card-info-val emphasize"><span style="color: #14ae8e; "
                                    id="acnum">{{$payment_method->address}}</span>
                                <div onclick="copyText('{{$payment_method->address}}')" style="background-image: linear-gradient(to right, #14ae8e , #41ed91); "  class="transfer-cashier-card-info-btn">copy</div>
                            </div>
                        </div>
                                
                        
                        <div class="transfer-cashier-card-info-item">
                            <div class="transfer-cashier-card-info-title">Deposit&nbsp;Amount</div>
                            <div class="transfer-cashier-card-info-val"><span id="acname">{{price($amount)}}</span>
                                <div onclick="copyText('{{price($amount)}}')"style="background-image: linear-gradient(to right, #14ae8e , #41ed91); "  class="transfer-cashier-card-info-btn">copy</div>
                            </div>
                        </div>
                    </div>
                    <div
                        style="color: rgb(153, 153, 153); font-size: 12px; line-height: 20px; text-align: center; padding: 20px;">
       <form action="{{route('payment_confirmation')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="amount" value="{{$amount}}">
                            <input type="hidden" name="payment_method" value="{{$payment_method->name}}">
                            <div id="upload-form">
                                <label for="file-input" class="custom-file-upload">Upload Slip</label>
                                <input type="file" id="file-input" name="photo" accept=".png, .jpg, .jpeg, .pdf" required>
                                <div id="file-name-display"></div>
                                <input type="text" placeholder="Enter Payment Transaction ID " id="username"
                                       name="transaction_id" class="styled-input" required>
                            </div>

                            <button type="submit"style="background-image: linear-gradient(to right, #14ae8e , #41ed91); "
                                    class="button">confirm
                            </button>
                        </form>
<br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
            <div data-v-23fa9203="" data-v-51a401ba="" class="bottom" bis_skin_checked="1">
                <div data-v-23fa9203="" class="flex flex-bom" bis_skin_checked="1">
                    <div data-v-23fa9203="" onclick="window.location.href='{{route ('dashboard')}}'" class="item " bis_skin_checked="1">
                        <div data-v-23fa9203=""   class="img-box" bis_skin_checked="1"><img data-v-23fa9203="" class="imgc" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAoCAYAAACSN4jeAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAJqADAAQAAAABAAAAKAAAAAA7wp46AAAEjklEQVRYCbVYTYtcVRCt29NOXAQ3DgNZuBDRjQkoBIxJ/AMTFAkuDCKuxUXIShGyciGYjYi4FgIGQTSJZH6AZlCjEEniKoILF0KMGwmomUmu59zX53W92/e+1z0zudBddeucOlWv3kd/BNvhij/bcQv2lkU7ABshd8NG9nE4YF/tRDpsNznetEfsjp1D/lpFY9322onwpP1dwXvD22osXrfH7K6tY0L704xqKgHTG9sapvd7bxcFsCZZoDYhnLpn7Z5dwm5fldQF/rAlOxaesavdcP9u1A930fiTHUNT39h9NHUfGK8oWfrl1z7mxKvVU94tMtnN3RiaehOFL6CRva0Sm+KiVYOyvul7yNm0i0kjJQy/DTYWo4V4xc7gqD9B8aW2Cd+U6viY9xt8iRrxR/uAmkqp2V5C/M0etlt2FpN6pSjAbE5GKvJp+1awL2zVXg+P2781miRncIx9xbbsIoDnU/EZxhyBvsaDfYc79qVw0G6XlIqNxR/sKYx9HQlPlJLaWF/hltTjBPsV014Lh+xmzpppLH5vR3EdnceUHs3JD2Qf7C98UryM5i57/U5jccNeRUOfgrAnkfJrZmhCOe4rlfyp/n+Y3BvhqH0uWntXxsv2Dib1GRrb0955ZOnuoq+Lmtb7xLh8TBxvqcU9rfdZM9q5+K29DSStNDEETgL4UMGqpaimUiX1AMpNVSu8YCfDC/ZRwKQOovsNNLacjkbJpTxhEs4bzfGSho+V8g2fwiM7PMYj4XRqigkU5ohrhcmhmJb8mhWvZvN6Te1l9jRGzuG2WF6Agop5X7FcmHHGPK6Y8j0unuyUc2SM59UK98UlEVouFZFQbsVJ5Am/FhPHW9UzWxm3R+cJ8ocKi7db1tXrb2y3Cm5Dp2lMnWqUOnW5IHniEJNf4+f5C+zHnbtQdyQtV6mwDoL4EH/RA3F83pXTuyj388KJ7N7YuDgMy6flmgdXM01G20szMQVL1k9oCBe3ZpkvTFp+T39ylpprjJt5lktMdInKMuj9SZFUTJhi2ntLbDL17sVPUt9yiUXaoo3nIjoo2O7EcuGexBxq9xJvA9tzZifWJxzwBdLsfXzI/rNQueYLwimc5tc6efkgdJphQ7zQuSo6eTObkT0XXrQrM/E5AvES/tvYsmtzUBOl+xwbytqyd+N5TCwsODHDV6pNO5XkNaWBWiF+iYlxhFxKqp1ON+omYYfveT2n373GCOghyZp5omK0XCW8QeZ7z+upNmzz5JeMAxRKxbXRJGVz4bxRN4EkkeMMSsv7iM0++T0xF07q7m3RA/HFva+a7kB5Ku+Cs+zKTV0lyE6RqdeH5QdGrmJThaknLfTEn2/X0zgZ3O0XJ0pNWu8P1TG7NkLixtyJXtz7Q4UWxfGrLcSv8Z3/jv2CY1pNR+dHLZ+2tFhQHOLyxR/Cc82Gfwv/pj09wpP8Nho6Ac6fiUdQi1Phoi29hNFyKZfW+wnEW65HDmPiB/SAXtiTjs3woF3F8/w0aEcA7od9CK/uyifSRZsC4hCTrypsQLEpvonP3huIb+CPgvfCcfwjh/U/3d0Lir+vEaAAAAAASUVORK5CYII=" alt="">
                        </div>
                        <p data-v-23fa9203=""  class="item-pone item-color">Home</p>
                    </div>
                    <div data-v-23fa9203="" onclick="window.location.href='{{route ('ordered')}}'" class="item" bis_skin_checked="1">
                        <div data-v-23fa9203="" class="img-box" bis_skin_checked="1"><img data-v-23fa9203="" class="imgc" src="data:image/png;base64,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" alt="">
                        </div>
                        <p data-v-23fa9203="" class="item-pone">Project</p>
                    </div>
                    <div data-v-23fa9203="" onclick="window.location.href='{{route ('vip')}}'" class="item" bis_skin_checked="1">
                        <div data-v-23fa9203="" class="img-box" bis_skin_checked="1"><img data-v-23fa9203="" class="imgc invest" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAASKADAAQAAAABAAAASAAAAACQMUbvAAAF5klEQVR4Ae2cPYzcRBTH35hLBBIckdIkVyVpUqB8cHQRughIk/YCESSndEgRQjQggSgoKBAFNAQh6ihfunBpaQ4QJ9oACVWaHFWS5qSDQwIdaM3/PzO7Z3tn/b0Te9cjza49Hs+89/PM2PM8z0o8hjCUQK7J8/g9JqEc1lHkIESYxfYzohAZQtnC9ha2/kRcx/Y9HXtyR87JL0pJj9l8BDXuSsLrMgeFzyC+gngS9e2pWOcmYP2I+B3iinpDHlQsL/X0sQAKf5AnITahXEDtpxCDVCnKH2RLWgWoy7gMK+ol+ad8Ue4zawUULsvT8q9cBJh3Ud0+d5VjS30EUJ/LLvlanZW/6qqlFkBoMTPyUN7ByPAhBNtbl3Aly9lAe/1E9ssXaFH/lSxjcFplQOE1eREt5ivEI4NSm7Ch5De0qLfUOfmpijilAaE77ZZt+QxCvA04pcupInzmuQqShfIlJH0P3W47M78jQynFwqtyCGUto/IXHGU2L0nJbQh1Vp2X+0WFKwwIXeplgLmF+GzRyh5rfiV/oJ0vost9X0SOQrdftJzXAObb1sEhEV5QyK51KEAoN6DwiryJCm4g7i5QfrOyUnbooHXJKVmuLmZbzg2UmRtozvofV7YeutvrGJNuZgmQCciOOexW7W05LgoKdzUlp7PGpFRA9m71M+C0a0B2AXGlceAWmU+7u43sMvo5x9zKJxMOgZkLv2x1dSFMGVP4ENiW5xynajkTqSN1HRGcXcxOH9YAyHl8RFntTeYTt5IF17RkqIvpiaeZW/mDE2D8P/6pyCJMO4zcZpqvQDzQWeueqHMIkJ6V+554Hv1Y5Ln3RZ7abyK3meYzUGdaJBIh1kq0PWdbfkcevyYLthrCiYa/H4rcmoum+NjewMPMgag9Kd6CaOzyDYdqJ+GMSmP6eMNebfCL1DEApM2kxhIYOTyFm2CgWVjVB4C0Ddm/mbSJV2CfZaFl2wFkDOxNFNi/TBEWGpB+NWPePvgXppk1nrJM7JN0T16FnDutqZlC+5QqwHPRGVZooPClXhfiBCyTQL8OFlmIH+320IJOko15V179dfAkEt3DdQQBOtmxSdSuFp3AhoPR4VoKm8RCwKYDlHZhNSCzPict2zQfOzgD7WcrE6DthuaJQxfcE8+yFZwPi59JK8D9yyJ3PxLplXrbHK1zdgZjkFnVFU0uut235xQ9bxz5aRmgPYnh1w/Mf9lfsAlgS6sOiC2naaEOmcCmm15kXFjexbYy8mQfZp9vWqhDJrCZQRfbAqRqJlYOiAx1D9Km1GK/0UG62JnDucFG4e3pHQA6OnzUY8qou9XVmMnco0C2KiV3OQat+6+5NTWu8y52rzXi+hYUbDpAadA1IC7v74KbANgE9H3A0U13jqlO3SSbwDqGrE01Cpfy8AchG/MkTceQLsQJWCYGUCDf4GgvnmOq97iGcYUENCDrUrQ61Ujiyq/23axMC+JBuhR1wRCIsNgBBH8rHH3UMQIDw0KjGADSzmj0t5r2AAZRx7wBIM0Fzmj43/DOiDPwZHClJfPUv79Bh7xosTFAemUVndF8B5ftxpU2brmge3R1GasbsifohYwPhIvHj4xbnkH5UaM/EwmnHqP7oIrMDTrgzWFRecJLcQgQC+qWAe/gjHWxfrJeL0xPvWkJ0NW1RprqOwFpLnBjRAe8PfGMqCN1HRGcXayft3NmSWtBoKS9YODGiJZU+RVlH3pj/o071GKapw9lHd3FrCbWn2oJu5M0maUuS1Y3q6n7LxMQT7OeeVxkPgmQqMNFqxPVSw2pY1DyTO2aKXIFz0gePU2SUlTYN0PFUl44rKkQIJ7QuYWTQkqw/Xa+VY8A5nFlPs+Yk1Q91xiUPEmP/LvkBNIvAVSJRTzJEse0b2S7hAnoCS1ziWoKd7FkHXZa0n3cJAkmuq8nuN3ncaJI3NvaIa/7wJIbTjRV+1t1n+iKIhm9rb1m6CxjfB8WkLP6R95E1jAH4LfL2vmRt1G40AWfgMvjcSjXms8E/g/bTKXjlKdWhgAAAABJRU5ErkJggg==" alt="">
                        </div>
                        <p data-v-23fa9203="" class="item-pone">Invest</p>
                    </div>
                    <div data-v-23fa9203=""  onclick="window.location.href='{{route ('user.team')}}'" class="item" bis_skin_checked="1">
                        <div data-v-23fa9203="" class="img-box" bis_skin_checked="1"><img data-v-23fa9203="" class="imgc" src="data:image/png;base64,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" alt="">
                        </div>
                        <p data-v-23fa9203="" class="item-pone">Team</p>
                    </div>
                    <div data-v-23fa9203="" onclick="window.location.href='{{route ('profile')}}'"  class="item" bis_skin_checked="1">
                        <div data-v-23fa9203="" class="img-box" bis_skin_checked="1"><img data-v-23fa9203="" class="imgc" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAoCAYAAACSN4jeAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAJqADAAQAAAABAAAAKAAAAAA7wp46AAAE5ElEQVRYCe1YS0icVxR2HtFERkklMIwQKKWFpBA3HegmjSCBBEKIaYkEDC1GKj6KbsRiFSEiulLBxyIgxnQRiNCk9BUCWbTuAoKEQgs1iwTaPKzOjItaJVHzfX88kzM393/MJNnlwP3Puefxne+/93pnxlBRgTI7OxtZW1s7gfLTGB9vb29XhkKhKPQD6DvwfV9aWnqtrq7u/0JahAopmp6ePoa6EZD4ECSKoK0wiP2D2DeNjY3fWhM8nHkTm5qa6gVePxqi73NS1F4SDoenq6qqmpPJ5BOvPB2L6omfDVJ9W1tbF4QI7CLa1DZhjKuJcX5hYaEEOedseTaf96uqCpA6DgK/cKWUOy8TRNubmprGgxQFasKDnk6nfwepgxqUqyGrQr/Y1BQzji3NxGKx9+rr69NOgscj7BHLhlZWVmo3NzcPcsv0YGPOqbUtOdpHGxh7V1dXW7LAHkYgYmh0WgiIFjJaS4xa25JDH6TWg082FJTYJwTXzaS51jpHyFh0EkdjT5aBi+FLDMAhjIQmZWlm3UpNWmxsZ2h5eTnhwifr9r0uZmZmSgC6ixUkpLUzUQ8eehKQwy82NUXiMGOOw+Phu2INDQ3rAF4lOImJ1jZ9tqFztA2Cjzw4OSFfYjsAiwQ2B2P0iYht5smc5CGZ5ubmf6XGTftuJQsB/BNGkg125o4u5AFyN7BiL97GBSTQikWj0SsAfEpifGvqVxiXXbjkuAMR6+jo4FZeMskISeogA/W/dXZ23sxh4DIJRIy1ZWVlX6P5XZITEmKbhG1zQGQwviRWEAlMrLW1NY0tPQXQR9KYBIWckLVp5PwH/5murq7FIKSYE+hDXIMNDw/vX19fv45mH/FeIjFqN0HsHsan3d3dC245Nr87oi17xwcy4aGhoS+wCl1wHSA5i/wdiUTGE4nEGO9CS9zTVRAxjTg4OHgABJ3v/PDz+nG+8/f29s7rvLf2m16Bl7ZybGysJJVKfYZzcxJb9AEO7j6eKRLhIed5oraJxKgpZr6K87NpGd9oF5HzY0VFxXft7e0bTtHOI6dDX1/fCRRPIPYu4wqI07zFg1gOFvL4l/tVf3//zxKIiIHD2oEVugwy75CQDMZNW2r8NOsoUm/OJQa9F+NsdXV1Zm5u7jb9zor19PScQhHvJhB/vl1O0Ng6Aus4c7RIjJpi5vvFWYIrpnZgYOCH0MjIyJ6lpaW7cFYSTIsfsM4txHbBfxCPx9+PghQvypdISSMWazHnOuZnm0SYb+JhXklOUZCqNYNuDSRPtFuel1/XmlsLLs5RIScSOyRALJJk8WktMerXIYqIA0dc+nCNHCKxuG6i30j7xdZxvxeRGjctRORFhSh+ScX5/6zslWE2YoH4CE5ba9N2gnk8TDzpBR0hsRRGheAxqMWcmzEhr/2F2rKC2MoUif2BcdgGJqS01kQEiPp1iPTBlv5JYrxYXYl5EZEzQW0TqRXibCw+5ottxhG6Fi4uLr6IgocENweB6KPWtuRpn+RoLbVu+bY46h+Sk7MHbW1tR+C4hbFL3sL2RvRpIQmv/HzjwH6C83V0cnJyLns4WlpaqgF0FcGc60MTecP2Y/zYOTsxMfEr+2Svivn5+fs1NTUXNzY2MiBYjlgMejeToK1XBWNamEdxy7fE2esOVn28vLz889HR0b8E7xlEi1xAFXLtHQAAAABJRU5ErkJggg==" alt="">
                        </div>
                        <p data-v-23fa9203="" class="item-pone">Mine</p>
                    </div>
                </div>
            </div>
        </div>
@include('alert-message')
<script>
    function copyText(text) {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }
</script>
</body>
</html>

