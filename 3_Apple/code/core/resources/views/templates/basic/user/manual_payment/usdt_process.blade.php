@extends('layouts.users')

@section('content')


    <div class="dashboard-section pt-120 bg--section">
        <div class="container">
            <div class="pb-120 mb-05">

                <div class="card mb-20">

                    <div class="card-header">
                        <p class="text-danger">Payment Guide</p>
                    </div>

                    <div class="card-body">
                        Send USDT TRC20(Tron Network) to the address above, your payment will be confirmed automatically
                    </div>

                </div>

                <br>

                <div class="card">

                    <div class="card-header">
                        <p>Step 1 - Copy Deposit Wallet Address, Money</p>
                    </div>

                    <div class="card-body">
                        <table class="table">


                            <tr>
                                <td>Amount In Naira</td>
                                <td>
                                    &#8358; {!! number_format($amount) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>Amount in USDT</td>
                                <td>
                                    <span id="final_amount">{{ $usdt_amount }}</span> USDT
                                    <button class="btn btn-sm btn-primary btn-copy-amount"
                                            data-clipboard-target="#final_amount">Copy
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>Naira-USD Exchange Rate</td>
                                <td>
                                    &#8358; 750/$
                                </td>
                            </tr>

                            <tr>
                                <td>USDT Wallet Address</td>
                                <td>
                                    <span id="account_number" style="word-wrap: anywhere">{{ $user->wallet->wallet_address }}</span>
                                    <button class="btn btn-sm btn-primary btn-copy-account"
                                            data-clipboard-target="#account_number">Copy
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

                <br>






                <br>






            </div>

        </div>


    </div>

    </div>




@endsection
@push('style')
    <style>
        .withdraw-thumbnail {
            max-width: 220px;
            max-height: 220px
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush


@push('style')
    <style>
        .fileinput .thumbnail {
            max-height: 300px;
            width: 100%;
        }
    </style>
@endpush

@push('script')
    <script>

        (function ($) {

            "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function () {

                var classNmae = $('.fileinput').attr('class');

                if (classNmae != 'fileinput fileinput-exists') {
                    $('.withdraw-thumbnail').hide();
                } else {

                    $('.fileinput-preview img').css({"width": "100%", "height": "300px", "object-fit": "contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

        })(jQuery);

    </script>





    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>--}}
    <script type="text/javascript">


        $(document).ready(function () {

            /*var clipboard = new ClipboardJS('.btn-copy-amount');

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                iziToast.success({message: "Amount copied: " + e.text, position: "topRight"});
                //e.clearSelection();
            });



            var clipboard_bank = new ClipboardJS('.btn-copy-account');

            clipboard_bank.on('success', function(e) {
                //console.info('Action:', e.action);
                //console.info('Text:', e.text);
                //console.info('Trigger:', e.trigger);

                iziToast.success({message: "Account Number copied: " + e.text, position: "topRight"});
                //e.clearSelection();
            });*/


            /*
            var copyText = document.getElementById("pwd_spn");
        var textArea = document.createElement("textarea");
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
             */

            $(".btn-copy-amount").on("click", function () {
                copy_value("final_amount", "Amount copied ");
            });

            $(".btn-copy-account").on("click", function () {
                copy_value("account_number", " Wallet copied ");
            });


            $(".btn-copy-narration").on("click", function () {
                copy_value("narration", "Narration copied ");
            });

            function copy_value(id, text) {
                var copyText = document.getElementById(id);
                var textArea = document.createElement("textarea");
                textArea.value = copyText.textContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("Copy");
                textArea.remove();


                notify("success",text + ": " + copyText.textContent);
                //iziToast.success({message: text + ": " + copyText.textContent, position: "topRight"});
            }


        });
    </script>

@endpush
