<html data-dpr="1" style="font-size: 38px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Payment - CheckOut</title>
    <link href="{{asset('public')}}/api/css/style.css" rel="stylesheet">
    <style>
        .upi_content {
            padding: 0.3rem !important;
        }
        .upi_content img {
            height: 36px !important;
            width: 40px;
        }
        .radio {
            margin: 0.15rem;
            margin-top: 12px;
        }
        .upi_content {
            box-shadow: 0px 5px 10px #00000036;
        }
    </style>
    <style>
        h4.tx1 {
            font-size: 15px;
            margin-bottom: 8px;
            border-bottom: 1px solid orangered;
            padding-bottom: 8px;
        }
        .modal {
            width: 91%;
        }
        .modal.modal-fixed-footer {
            padding: 0;
            height: 70%;
        }
        .tx3 {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            background: #00000021;
            padding: 6px 7px;
            border-radius: 5px;
            align-items: center;
        }
        .modal .modal-close {
            cursor: pointer;
            background: #446293;
            color: #fff;
        }
        label {
            font-size: 16px;
        }
        input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
            outline: none;
            height: 50px;
        }
        .pay_img img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
        }
        .copied_message {
            color: blue;
        }
        input#photo {
            margin-top: 20px;
            border: 1px solid #0000003b;
            width: 100%;
            padding: 9px 0;
            border-radius: 6px;
        }
        .adminNumber {
            color: #446293;
            font-weight: 800;
            font-size: 17px;
        }

    </style>
    <link rel="stylesheet" href="{{asset('public')}}/api/css/layer.css" id="layuicss-layer">
</head>
<body class="overflow">
<form action="{{route('depositSubmit')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input id="payment_method" name="payment_method" type="hidden" value="{{$payment_method->name}}">

    <div class="main" style="padding-top:0.2rem;background-color:#fff;">
        <div class="money_content">
            <span class="money_title" style="font-size:18px;">UPI CheckOut</span>
            <div class="money" style="font-size:14px">Total Amount Payable: <font id="money">
                    {{price($amount)}}
                </font>
            </div>
        </div>

        <div class="content" style="background-color:#fff0;box-shadow:none;">
            <div class="option"></div>
            <div class="pay_img" style="text-align: center;">
                <img class="ppImage" src="{{asset($payment_method->photo)}}">
            </div>
            <p class="tx2">
                Please upload the payment voucher within the specified time, otherwise the OTC has the right to cancel the order.
                <br>
                <span style="color: #446293;font-weight: 700;">Acceptable money should be sent money</span>
            </p>

            <div class="tx3">
                <div>
                    <div class="copied_message"></div>
                    <div>Copy this address.</div>
                    <div class="adminNumber">{{$payment_method->address}}</div>
                </div>
                <div><img onclick="copyLink('{{$payment_method->address}}')" src="https://img.icons8.com/material-sharp/24/copy.png" alt=""></div>
            </div>

            <div class="custom-form-group">
                <label for="amount">Selected Amount:</label>
                <input type="number" name="amount" id="amount" placeholder="amount" value="{{$amount}}" class="custom-form-control" readonly>
            </div>
            <div class="custom-form-group">
                <label for="number">Wallet name:</label>
                <input type="text" name="acc_acount" id="number" class="custom-form-control" placeholder="" value="{{$payment_method->name}}">
            </div>
            <div class="custom-form-group">
                <label for="trx">Enter your payment transaction ID:</label>
                <input type="text" name="transaction_id" id="trx" class="custom-form-control" placeholder="Transaction ID">
            </div>

            <div class="custom-form-group">
                <label for="photo">Payment evidence screenshot:</label>
                <input type="file" name="photo" id="photo" class="custom-form-control">
            </div>
        </div>
    </div>
</form>

</div>

<div class="foot" style="box-shadow:none;">
    <button id="submit" onclick="goPaymentForm()">
        Pay Confirm</button>
</div>

<input type="hidden" name="payment_operator">
<input type="hidden" name="copied_number">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@include('alert-message')
<script>
    let amount = '{{$amount}}';

    function goPaymentForm(){
        let current_amount = document.querySelector('input[name="amount"]').value;
        let number = document.querySelector('input[name="acc_acount"]').value;
        let trx = document.querySelector('input[name="transaction_id"]').value;

        if (current_amount < amount){
            message('Enter Sizes amount.')
            return 0;
        }

        if (number == ''){
            message('Enter your account name')
            return 0;
        }

        if (trx == ''){
            message('Enter transaction id')
            return 0;
        }

        document.querySelector('form').submit();
    }


    function copyLink(text)
    {
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
        message('Address Copied...')
    }
</script>
</body>
</html>
