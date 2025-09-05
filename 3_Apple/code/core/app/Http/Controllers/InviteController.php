<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    
    public function invite(Request $request)
    {
        $user = Auth::user();
    
        // Get the count of active referrals that have made deposits
        $referralsCount = $user->referrals()->whereHas('successfulDeposits')->count();
    
        // Define rewards based on the number of referrals
        $rewards = [
            1 => 15,
            5 => 75,
            15 => 225,
            40 => 600,
            75 => 1125,
            500 => 7500,
        ];
    
        // Check if the user is eligible for a reward
        foreach ($rewards as $count => $reward) {
            if ($referralsCount == $count) {
                // Check if the user has already claimed this reward
                 $hasClaimed = Task::where('amount', $request->amount)->where('user_id',$user->id)->count();
                 
    
                if ($hasClaimed > 0) {
                    return response()->json(['message' => 'You have already claimed this reward.'], 200);
                }
                
                $task = new Task();
                $task->user_id = $user->id;
                $task->amount = $request->amount;
                $task->save();
                
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->amount = $request->amount;
                $transaction->post_balance = $user->bonus_balance + $request->amount;
                $transaction->charge = 0;
                $transaction->trx_type = '+';
                $transaction->details = 'Invite Task';
                $transaction->trx =  getTrx();
                $transaction->save();
    
                return response()->json(['message' => "You've claimed R{$reward} for inviting {$count} members!"], 200);
            }
        }
    
        return response()->json(['message' => 'No rewards available at this time.'], 200);
    }
    
    public function salary(){
        $pageTitle = 'Salary';
        $user = Auth::user();
        $referralsCount = $user->referrals()->whereHas('successfulDeposits')->count();
        return view($this->activeTemplate . 'user.salary', compact('pageTitle','referralsCount'));
    }
}