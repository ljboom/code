@extends('layouts.users')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        div#div1 {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: -1;
        }

        div#div1>img {
            height: 100%;
            width: 100%;
            border: 0;
        }

        .inputdiv {
            display: flex;
            border: 1px solid #D2D2D2 !important;
            background-color: #D2D2D2;
            height: 38px;
            line-height: 38px;
            padding: 0px 2px;
            border-radius: 5px;
            color: #000;
        }

        .layui-form-select dl dd.layui-this {
            background: #000;
            color: #fff !important;
        }

        .layui-unselect layui-form-select {
            border-radius: 15px !important;
        }

        .layui-select-title {
            border-radius: 5px !important;
            border: 0px solid rgb(192, 240, 252) !important;
        }

        .layui-input,
        .layui-select,
        .layui-textarea {
            height: 38px;
            line-height: 1.3;
            background-color: #D2D2D2;
            color: rgba(0, 0, 0, 0.85);
            border-width: 0px;
            border-style: solid;
            border-radius: 5px;
        }

        .layui-input-block {
            margin-left: 0px !important;
            min-height: 36px;
        }

        .layui-select-title {
            /* border-radius: 15px !important; */
            border: 1px solid #D2D2D2 !important;
        }
    </style>


    <body style="background: rgb(0, 0, 0);">

        <div style=" max-width:450px; margin:0 auto; height:auto; overflow:hidden;">
            <div class="top" style="background: #191A1F; border:0px groove #000; ">
                <div onclick="window.history.go(-1); return false;" style="float:left; line-height:46px;width:50%;">
                    <i class="layui-icon" style="color:#fff;  margin-left:12px; font-size:18px;  font-weight:bold;"
                        id="btnClose"></i>
                </div>
                <font class="topname" style="color: #fff;">
                     Add a bank accout
                </font>
                <div style="float:right; text-align:right; line-height:46px;width:50%;">

                </div>
            </div>

            <div style=" max-width:450px; margin:0 auto; height:auto; overflow:hidden;">

                <div class="layui-form layui-tab-content" style="padding:10px 10px; margin-top:50px;">
                    <form id="accountForm" class="layui-form" method="post" style="padding:10px;">
                        @csrf
                        <!--<div style="background: #191A1F; border-radius: 10px;">-->
                        <!--    <div style="padding-top: 10px;">&nbsp;</div>-->
                        <!--    <div id="l1"-->
                        <!--        style=" text-align: left; padding-bottom: 10px;  color: #fff; font-family: DengXian;">-->
                        <!--        *Select the bank</div>-->
                        <!--    <div id="l2" class="layui-form-item"-->
                        <!--        style="height: 45px; border-radius: 15px !important; ">-->
                        <!--        <div class="layui-input-block"-->
                        <!--            style=" border: 0px solid #D2D2D2 !important; border-radius: 15px !important;">-->
                        <!--            <select style="border:0px;" name="bank_code" id="bank_name" required-->
                        <!--                onchange="updateHiddenInput(this)">-->
                        <!--                <option value="">Please select the bank.</option>-->
                        <!--                <option value="FNB">FNB</option>-->
                        <!--                <option value="ABSA">ABSA</option>-->
                        <!--                <option value="Capitec">Capitec</option>-->
                        <!--                <option value="Nedbank">Nedbank</option>-->
                        <!--                <option value="Standard Bank">Standard Bank</option>-->
                        <!--                <option value="Tyme Bank">Tyme Bank</option>-->
                        <!--                <option value="Discovery Bank">Discovery Bank</option>-->
                        <!--                <option value="Investec">Investec</option>-->
                        <!--                <option value="African Bank">African Bank</option>-->
                        <!--                <option value="Access Bank">Access Bank</option>-->
                        <!--            </select>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <input type="hidden" name="bank_name" id="bank_code">


                        <div style="text-align: left; padding-bottom: 10px; color: #fff; font-family: DengXian;"
                            id="v1">Select bank</div>
                        <div class="layui-form-item" style="height:45px;">
                            <div class="inputdiv">
                                <input type="number" name="Please enter a bank" id="account" autocomplete="new-password"
                                    style="color:#000;border:0px;" maxlength="49" placeholder="Please select the bank"
                                    class="layui-input" required="">
                            </div>
                        </div>

                        <div style=" text-align: left; padding-bottom: 10px; color: #fff; font-family: DengXian;">
                            *Bank account</div>
                        <div class="layui-form-item" style="height:45px;">
                            <div class="inputdiv">
                                <input type="text" name="account_name" id="account_name" maxlength="49"
                                    autocomplete="new-password" style="color:#000;border:0px;"
                                    placeholder="Please enter a bank account" class="layui-input" required="">
                            </div>
                        </div>

                        <div class="layui-form-item" style="margin-top:25px; text-align:center;">
                            <button id="btnSubmit" class="layui-btn"
                                style="width: 100%; height: 45px; line-height: 45px; border-radius: 25px; color: #fff; font-weight: bold; background: #C0857E; font-size: 16px; border: 0px; "
                                type="submit">
                                Add
                            </button>
                        </div>

                    </form>
                </div>


            </div>
        </div>

        </div>


        <script>
            function updateHiddenInput(selectElement) {
                // Get the selected value
                const selectedValue = selectElement.value;

                // Update the hidden input's value
                document.getElementById('bank_code').value = selectedValue;
            }
        </script>

        <div class="layui-layer-move"></div>
    </body>
@endsection

@push('script-lib')
    <textarea style="display: none;" id="all_banks">{!! $all_banks !!}</textarea>

    <script>
        let all_banks = JSON.parse($("#all_banks").val());
        //console.info(all_banks);
        (function($) {
            "use strict";

            function getByValue(value) {

                let arr = all_banks;
                for (var i = 0, iLen = arr.length; i < iLen; i++) {
                    //console.log(arr[i]);
                    if (arr[i].bank_code == value) return arr[i].name;
                }
            }


            $("#bank_name").change(function(e) {
                //alert($(this).val());
                //let code = $("#bank_name").val(); //getByValue().bank_code;
                //let account = $("#account").val();

                //console.log(t, code);


                let code = $("#bank_name").val(); //getByValue().bank_code;
                let account = $("#account").val();

                //console.log(code, account);

                let t = getByValue(code);

                //console.log(t);

                $("#bank_code").val(t);
                if (account != "" && code != "") {

                    get_account_info(code, account);

                    //console.log(account, code);
                }

            });

            $("#account").change(function() {

                let code = $("#bank_name").val(); // getByValue($("#bank_name").val()).bank_code;
                let account = $("#account").val();
                if (account == "" || code == "") {
                    $("#reg").prop('disabled', true);
                    $("#account_name").val("");
                    $(".text-error").text("Your bank name and account number are required, please try again");
                    return;
                }

                get_account_info(code, account);

                //console.log(account, code);


            });





            function get_account_info(code, account) {

                $(".preloaders").show();
                $(".text-error").text("Fetching account details");

                $.ajax({
                    url: "{{ route('account.fetch') }}",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'bank-verification': '',
                        'code': code,
                        'account': account
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            $("#account_name").val("");
                            $(".preloaders").hide();

                            $("#reg").prop('disabled', true);
                            return;
                        }

                        $(".text-error").text("");
                        $("#reg").removeAttr('disabled');
                        $(".preloaders").hide();
                        console.log(response.data);
                        $("#account_name").val(response.data.account_name);

                        //console.log(response);
                    },

                    error: function(err) {
                        console.log(err.responseText);
                        $(".preloaders").hide();
                    }
                });
            }

            $('.withdraw-thumbnail').hide();
            $('.clickBtn').on('click', function() {
                var classNmae = $('.fileinput').attr('class');
                if (classNmae != 'fileinput fileinput-exists') {
                    $('.withdraw-thumbnail').hide();
                } else {
                    $('.fileinput-preview img').css({
                        "width": "100%",
                        "height": "300px",
                        "object-fit": "contain"
                    });

                    $('.withdraw-thumbnail').show();
                }

            });

        })(jQuery);
    </script>
@endpush
