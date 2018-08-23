<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsertRecipient;
use App\Models\GetRecipient;
use App\Models\InsertSpecialOffer;
use App\Models\GetSpecialOffer;
use App\Models\InsertVoucherCode;
use App\Models\GetVoucherCode;
use Validator;

class voucherController extends Controller
{
     /**
     * function to retrieve and return all the voucher code
     */
    public function generateAllVoucherPool(){
    	 $recipients = GetRecipient::join('voucher_code', 'recipient.recipientID', '=', 'voucher_code.recipientID')
    	 //->join('special_offer', 'recipient.recipientID', '=', 'special_offer.recipientID')
    	 ->get();

    	 return view('welcome', compact('recipients'));
    }
    /**
     * function to generate new voucher code and Save It
     */
    public function generateVoucherCode(Request $request){
    /**
     * Check and make sure name, email and offer type is not Empty
     */
    	 $validation = Validator::make($request->all(), [
            'Name' => 'required',
            'Email'  => 'required',
            'offerType'  => 'required',
        ]);

        if ($validation->fails()){
        
        return json_encode(array('error' => $validation->getMessageBag()->toArray()));

        }else{

    /**
     * Check if Email (Record) exists
     */
     
     	if (GetRecipient::where('email', '=', $request->Email)->exists()) {
     		$post = array('emailexists' => "true",
     					 'message' => "This email is already in use by another customer." 
     					); 
    		return response()->json($post);
     	}else{
     	$post =  new InsertRecipient();
    	$post ->name = $request->Name;
    	$post ->email = $request->Email;
    	$post ->save();

    	$recipient = GetRecipient::where('email', '=', $request->Email)->get();
    	$recipientID = '';
        foreach($recipient as $rec){
             $recipientID = $rec->recipientID;
         }
        $getofferType = $request->offerType;
    	$vCode = $this->getCode($length = 8);
    	$expirationDate = date("d-m-Y", strtotime("+1 week"));
    	$postcCode =  new InsertVoucherCode();
    	$postcCode ->recipientID = $recipientID;
    	$postcCode ->recipientType = $getofferType;
    	$postcCode ->code = $vCode;
    	$postcCode ->expiration = $expirationDate;
    	$postcCode ->date_of_usage = " ";
    	$postcCode ->save();
    	 /**
	     * Check if offer Type is Special Offer then insert into special offer table
	     */
	     
	     if($getofferType == "SpecialOffer"){
	    	$postSpecialOffer =  new InsertSpecialOffer();
	    	$postSpecialOffer ->recipientID = $recipientID;
	    	$postSpecialOffer ->percentageDiscount = $request->fDiscount;
	    	$postSpecialOffer ->save();
	    	$recipient = GetRecipient::where('email', '=', $request->Email)
     ->join('voucher_code', 'recipient.recipientID', '=', 'voucher_code.recipientID')->first();

         return json_encode($recipient);
	     }else{
	     $recipient = GetRecipient::where('email', '=', $request->Email)
     ->join('voucher_code', 'recipient.recipientID', '=', 'voucher_code.recipientID')->first();

         return json_encode($recipient);
	     }
    	
    	
    	} 
     

    	
    }

          
 }

 	/**
     * function to generate 8 digit voucher code
     */
    function getCode($length = 8){

    $randomCode = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';

    return substr(str_shuffle(str_repeat($randomCode, $length)), 0, $length);
    }
  

}
