<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\AccountAccessToken;
use Illuminate\Http\Request;

class AccountAccessTokenController extends Controller
{
    public function account_access_token(){
        return view('facebook.accountaccess');

    }
    public function save_account_access_token(Request $request){
        $request->validate([
            "account_id"=>"required",
            "account_access_token"=>"required",
        ]);
        $account_ids = explode("\r\n",$request->account_id);
        $account_access_tokens =  explode("$",$request->account_access_token);
        $user_id=auth()->user()->id;
        $j=0;
        foreach($account_ids as $account_id){
            AccountAccessToken::create([
                "account_id"=>$account_id,
                "account_access_token"=>$account_access_tokens[$j],
                "user_id"=>$user_id,
            ]);
            $j++;
        }
            return response()->json(['message' => 'AccountAccess records created successfully']);
    }
}
