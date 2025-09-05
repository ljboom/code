<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 06/08/2022
 * Time: 21:46
 */

namespace App\Http\Services;


use App\Models\BankWithdrawal;
use App\Models\FundTransfer;
use App\Models\GeneralSetting;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;

class TransferServices
{
    private $setting;
    public function __construct()
    {
        $this->setting = GeneralSetting::first();
    }


    function fetchBalance(){
        //https://api.flutterwave.com/v3/balances/:currency


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/balances/NGN",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->setting->flutterwave_key
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            $out = array('status' => false, 'message' => 'Transaction_verification', 'Curl returned error: ' . $err);
            return $out;
        }

        $response_array = json_decode($response,true);

        return $response_array;
    }

    function initiate_transfer($id){
        $withdrawal = Withdrawal::find($id);
        if($withdrawal){
            $amount = $withdrawal->final_amount;
            $mainamount = $withdrawal->amount;

            //check if there is bank_withdrawal

            $bank_withdrawal = BankWithdrawal::where('withdrawal_id', $withdrawal->id)->first();

            if($bank_withdrawal){
                $ref = getTrx();
                $log = $this->make_payment($bank_withdrawal->bank_code, $bank_withdrawal->account_number,$amount,"NGN");
                //dd($log);

                if($log){

                    $transfer = new TransferServices();
                    $balance = $transfer->fetchBalance();
                    $amountandfee = $log['data']['amount'] + $log['data']['fee'];
                    $ava_bal = $balance['data']['available_balance']+$amountandfee;


                    $payment = new FundTransfer();
                    $payment->name = $bank_withdrawal->account_name;
                    $payment->description = $this->setting->sitename;
                    $payment->account_number = $bank_withdrawal->account_number;
                    $payment->bank_code = $bank_withdrawal->bank_code;
                    $payment->amount = $amount;
                    $payment->withdrawal_id = $id;
                    $payment->response = json_encode($log);
                    $payment->reference = $log['data']['reference'];
                    $payment->save();
                    $withdrawal->status = 2;
                    $withdrawal->save();


                }

            }
        }
    }

    function make_payment($account_bank, $account_number, $amount, $currency){

        $params = http_build_query([
            "account_bank" => $account_bank,
            'account_number' => $account_number,
            'amount' => $amount,
            'currency' => $currency,
            'callback_url' => route('flutterwaveipn'),
            'narration' => $this->setting->sitename
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transfers",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->setting->flutterwave_key
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            $out = array('status' => false, 'message' => 'Transaction_verification', 'Curl returned error: ' . $err);
            return $out;
        }

        $response_array = json_decode($response,true);

        //create a payment log

        return $response_array;

    }
}