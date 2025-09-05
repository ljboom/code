<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta name="format-detection" content="telephone=no,date=no,address=no,email=no,url=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <style>
        * {
            -webkit-touch-callout: none;
            /*系统默认菜单被禁用*/
            -webkit-user-select: none;
            /*webkit浏览器*/
            -khtml-user-select: none;
            /*早期浏览器*/
            -moz-user-select: none;
            /*火狐*/
            -ms-user-select: none;
            /*IE10*/
            user-select: none;
        }

        .countdown-text {
            font-size: 16px;
            font-weight: bold;
            position: absolute;
            top: 40px;
            right: 25px;
        }

        .bank-icon {
            width: 5rem;
            height: 5rem;
            position: absolute;
            left: 40vw;
            top: 30px;
            z-index: 99;
        }

        .bank-card {
            margin-top: 55px;
            background: linear-gradient(127deg, #276981 0%, #23637E 30%, #073853 100%);
            border-radius: 8px 8px 0px 0px;
        }

        .bank-amount {
            background: linear-gradient(270deg, #184A57 0%, #061A23 100%);
            border-radius: 0px 0px 0px 0px;
        }

        .bank-name {
            font-size: 10px;
            font-weight: 400;
            color: #9BBCCB;
        }

        .amount-text {
            font-size: 32px;
            font-weight: 400;
            color: #FFFFFF;
        }

        .step-text {
            font-size: 14px;
            color: #3D3D3D;
            display: flex;
        }

        .input-view {
            margin-top: 8px;
            width: 92vw;
            height: 36px;
            background: #FFFFFF;
            border-radius: 4px 4px 4px 4px;
            opacity: 1;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .info-card-view {
            background: #FFFFFF;
            border-radius: 8px 8px 0px 0px;
            width: 100%;
            /* height: 100%; */
        }

        .info-text {
            margin-top: 32px;
            margin-left: 42px;
            margin-right: 42px;
            font-size: 14px;
            font-weight: 400;
            color: #003A5E;
            line-height: 18px;
            text-align: center;
        }

        .pay-text {
            margin-top: 44px;
            margin-left: 55px;
            font-size: 14px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.25);
        }

        .bank-text {
            margin-top: 20px;
            margin-left: 55px;
            font-size: 13px;
            font-weight: 400;
            color: #000000;
        }

        .bank-title {
            font-size: 14px;
        }


        .bank-num {
            font-size: 14px;
            font-weight: 700;
            color: #459FA8;
            text-align: right;
        }

        .copy-btn {
            width: 50px;
            height: 22px;
            background: #f44336;
            border-radius: 4px 4px 4px 4px;
            border: 0;
            margin-left: 10px;
            text-align: center;
            color: #FFFFFF;
            font-size: 12px;
        }

        .copy-btn2 {
            width: 50px;
            height: 22px;
            background: #f44336;
            border-radius: 4px 4px 4px 4px;
            border: 0;
            margin-left: 10px;
            text-align: center;
            color: #FFFFFF;
            font-size: 12px;
        }

        .copy-btn3 {
            width: 50px;
            height: 22px;
            background: #f44336;
            border-radius: 4px 4px 4px 4px;
            border: 0;
            margin-left: 10px;
            text-align: center;
            color: #FFFFFF;
            font-size: 12px;
        }

        .submit {
            margin-top: 32px;
            margin-left: 17px;
            margin-right: 17px;
            /* width: 92vw; */
            height: 44px;
            width: 90%;
            border: none;
            background: #429EA9;
            border-radius: 4px 4px 4px 4px;
            color: #FFFFFF;
            text-align: center;
            line-height: 45px;
        }

        .box-view {
            box-shadow: 2px 2px 10px 0px rgba(140, 140, 140, 0.1);
            border-radius: 4px 4px 4px 4px;
            padding-left: 25px;
            padding-right: 25px;
        }

        #orderTimeOut {
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            line-height: 60px;
        }

        /* Style the upload container */
        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        /* Style the custom file upload button */
        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #2980b9;
        }

        /* Hide the actual file input */
        #file-upload {
            display: none;
        }

        /* Font Awesome icons (you can use any icon library you prefer) */
        .fas {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        /* Optional: Add additional styling to the icon */
        .fas.fa-cloud-upload-alt {
            margin-right: 10px;
        }

        .styledInput {
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 5px;
            font-size: 16px;
            width: 300px;
            transition: border-color 0.3s ease-in-out;
            margin-bottom: 10px;
        }

        .styledInput:focus {
            border-color: #00cc00;
            outline: none;
        }
    </style>
</head>


<body class="" style="height:100vh;">



    <div style="padding: 16px;background: #F7F7F7;">
        
        <div id="countdown" class="countdown-text">579</div>
        <div class="bank-card">
            <div style="padding-top: 42px;padding-bottom: 15px;text-align: center;">
                <div class="amount-text">R <span
                        class="payNumber">{{ number_format($data['final_amo'], 0, '', '') }}</span></div>
            </div>
        </div>
        <div class="bank-amount">
            <div style="padding: 10px;display: flex;">
                <div style="color: #CACACA;font-size: 12px;">Amount</div>
                <div style="margin-left: 8px;color: #FFFFFF;font-size: 12px;">R<span
                        class="payNumber">{{ number_format($data['final_amo'], 0, '', '') }}</span></div>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            
    </div>
    <div id="orderTimeOut"></div>
    <div class="orderExist">
        <div class="box-view">
            <div style="display: flex;justify-content: space-between;margin-top: 20px;">
                <div class="bank-title">
                    Account Number
                </div>
                <div style="display: flex;justify-content: space-between;">
                    <div class="bank-num" id="accountNumber">{{ $general->account_number }}</div>
                    <button type="button" onclick="copyText('accountNumber')" data-clipboard-action="copy"
                        class="copy-btn" id="copy1">
                        copy
                    </button>
                </div>
            </div>
            <div style="display: flex;justify-content: space-between;margin-top: 20px;">
                <div class="bank-title">
                    Bank
                </div>
                <div style="display: flex;justify-content: space-between;">
                    <div class="bank-num" id="bankName">{{ $general->bank_name }}</div>
                    <button type="button" onclick="copyText('bankName')" data-clipboard-action="copy" id="copy2"
                        class="copy-btn2">
                        copy
                    </button>
                </div>
            </div>
            <div style="display: flex;justify-content: space-between;margin-top: 20px;">
                <div class="bank-title">
                    Account Name
                </div>
                <div style="display: flex;justify-content: space-between;">
                    <div class="bank-num" id="accountName">{{ $general->account_name }}</div>
                    <button type="button" onclick="copyText('accountName')" data-clipboard-action="copy"
                        class="copy-btn3" id="copy3">
                        copy
                    </button>
                </div>
            </div>
            <div style="height:20px;"></div>
            
            <div style="-webkit-user-select:text !important">

                    @if ($method->gateway_parameter)
                        @foreach (json_decode($method->gateway_parameter) as $k => $v)
                            @if ($v->type == 'text')
                            <div class="step-text" style="margin-top: 20px;">
                                <div style="color: red;">*</div>
                                <div style="font-weight: bold;">step 1:</div>
                                <div style="margin-left: 4px;">input the sender phone number</div>
                                <div style="color:red;margin-left:2px;">(Required)</div>
                            </div>
                                <input id="senderdata" style="-webkit-user-select:text !important"
                                    contenteditable="true" class="cmn--form--control form-control" type="text" name="{{ $k }}"
                                    value="{{ old($k) }}" placeholder="{{ __($v->field_level) }}">
                            @elseif($v->type == "file")

                                <div class="step-text" style="margin-top: 20px;">
                                    <div style="color: red;">*</div> 
                                    <div style="font-weight: bold;">step 2:</div>
                                    <div style="margin-left: 4px;">upload the payment reciept</div>
                                    <div style="color:red;margin-left:2px;">(Required)</div>
                                </div>
                                <input type="file" accept="image/*" class="form-control cmn--form--control"
                                       name="{{$k}}"
                                       value="{{old($k)}}" placeholder="{{__($v->field_level)}}">


                            @endif
                        @endforeach
                    @endif

                </div>
        </div>
        
        
        


        <div class="info-card-view">
            <div class="info-text">
                <div>Copy our bank account above and do immediate payment if you are using a different bank.  </div>
                <div>Reference use your phone number you register with.</div>
                <!--<div>input the amoun shown above.</div>-->
            </div>
        </div>
        <center>
            <button type="submit" id="submit-btn" class="submit">
                I Have Paid
            </button>
        </center>
        <div style="height: 40px;"></div>
        <div class="modal fade" id="myModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div style="display: flex;justify-content: center;margin-top: 16px;">
                        <div class="modal-title" style="font-size: 1.4rem;font-weight: 700;color: #3D3D3D;">
                            Tips</div>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <p id="tips-text">Please enter the sender name of the payer first</p>
                    </div>
                    <div style="display: flex;justify-content: center;margin-bottom: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script>
        function copyText(elementId) {
            var textToCopy = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(textToCopy)
                .then(function() {
                    alert('Payment Info Copied!');
                })
                .catch(function(error) {
                    console.error('Unable to copy link: ', error);
                });
        }
    </script>
    <script>
        function updateFileName() {
            const fileInput = document.getElementById("file-upload");
            const fileNameDisplay = document.getElementById("file-name");

            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = "Selected file: " + fileInput.files[0].name;
            } else {
                fileNameDisplay.textContent = "";
            }
        }
    </script>

    <script>
        // Get the target element where countdown will be displayed
        var countdownElement = document.getElementById("countdown");

        // Set the initial countdown value
        var countdownValue = 600; // Change this value to set the starting number

        // Define a function to update the countdown
        function updateCountdown() {
            // Update the countdown element with the current countdown value
            countdownElement.textContent = countdownValue;

            // Decrease the countdown value by 1
            countdownValue--;

            // Check if countdown has reached 0, if not, call the function again after 1 second
            if (countdownValue >= 0) {
                setTimeout(updateCountdown, 1000); // Call the function again after 1 second (1000 milliseconds)
            } else {
                // Countdown has reached 0, do something when countdown finishes
                countdownElement.textContent = "Countdown Finished!";
            }
        }

        // Start the countdown
        updateCountdown();
    </script>

</body>

</html>
