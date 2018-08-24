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
    	$expirationDate = date("Y-m-d", strtotime("+1 week"));
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

    $randomCode = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    return substr(str_shuffle(str_repeat($randomCode, $length)), 0, $length);
    }
    /**
     * function to verify voucher code via HTTP
    */
  public function verifyVoucherCode(Request $request){
  	/**
	  * Check and make sure voucher code and email are not Empty
	*/
    	 $validation = Validator::make($request->all(), [
            'VoucherCode' => 'required',
            'Email'  => 'required',
        ]);

        if ($validation->fails()){
        
        return json_encode(array('error' => $validation->getMessageBag()->toArray()));

        }else{
	        /**
		  	   * Check if email exists in the record
			*/
        	if (GetRecipient::where('email', '=', $request->Email)->exists()) {
        		$recipient = GetRecipient::where('email', '=', $request->Email)
        		->join('voucher_code', 'recipient.recipientID', '=', 'voucher_code.recipientID')
		    	 ->get();
		    	$recipientID = ''; 
		    	$OfferType = ''; 
		    	$VoucherCode =''; 
		    	$getdateOfexpiration = '';
		    	$getdateOfUsage = '';  
		        foreach($recipient as $rec){
		             $recipientID = $rec->recipientID;
		             $OfferType = $rec->recipientType;
		             $VoucherCode = $rec->code;
		             $getdateOfexpiration = $rec->expiration;
		             $getdateOfUsage = $rec->date_of_usage;
		         }
		         /**
			  	   * Check if voucher code exists in the record
				*/
	        	if ($VoucherCode == $request->VoucherCode) {
	        		/**
				     * Check if offer Type is Special Offer then return Percentage Discount
				     */
	        		$todayDate = date("Y-m-d", strtotime("today"));
	        		//$getdateOfexpiration = date("d-m-Y", strtotime($getdateOfexpiration));
	        		/**
				     * Check if voucher code is valid
				     */
	        		//$getdateOfexpiration    = new DateTime($getdateOfexpiration);
	        		$today_usage_Date = str_replace('-', '', $todayDate);
	        		$expirationDate = str_replace('-', '', $getdateOfexpiration);
	        		if($today_usage_Date > $expirationDate){
	        			$postMessage = array('ValidateTrue' => "true",
	     					 'message' => "<div class='alert alert-danger'>This Voucher Code <strong>".$VoucherCode."</strong> has expired on <strong>".$getdateOfexpiration."</strong></div>" 
	     					);
	     					return response()->json($postMessage);
	        		}else{


				     if($OfferType == "SpecialOffer"){
					     
			     		$pDiscount = GetSpecialOffer::where('recipientID', '=', $recipientID)->get();
				    	$PercentageDiscount = '';
				        foreach($pDiscount as $prec){
				             $PercentageDiscount = $prec->percentageDiscount;
				         }
				         GetVoucherCode::where('recipientID', '=', $recipientID)
				         ->where('code', '=', $request->VoucherCode)
						 ->update(['date_of_usage'=> $todayDate]);
				        $postMessage = array('ValidateTrue' => "true",
	     					 'message' => "This customer has ".$OfferType."-".$getdateOfexpiration." and Percentage Discount is <strong>$".$PercentageDiscount."</strong>."  
	     					);
	     				return response()->json($postMessage); 
				     }else{
				     	GetVoucherCode::where('recipientID', '=', $recipientID)
				         ->where('code', '=', $request->VoucherCode)
						 ->update(['date_of_usage'=> $todayDate]);
				     		$postMessage = array('ValidateTrue' => "true",
	     					 'message' => "This customer has ".$OfferType." and Percentage Discount is <strong>$100 by default</strong>." 
	     					);
	     					return response()->json($postMessage); 
				     }

				 }
	     		
		     	}else{
		     		$post = array('codeexists' => "true",
	     					 'message' => "This Voucher Code (".$request->VoucherCode.") is Invalid." 
	     					); 
	    		   return response()->json($post);
		     		
		     	}

     		
	     	}else{
	     		$post = array('emailexists' => "true",
     					 'message' => "This email (".$request->Email.") is NOT a registered customer." 
     					); 
    			return response()->json($post);

	     	}

        }
  }

	/**
     * function to search for voucher code using email
    */
public function searchVoucherCode(Request $request){

	if (GetRecipient::where('email', '=', $request->Email)->exists()) {
 		  $recipient = GetRecipient::where('email', '=', $request->Email)
    	 ->join('voucher_code', 'recipient.recipientID', '=', 'voucher_code.recipientID')
         ->first();

         return json_encode($recipient);
     }else{
     	$post = array('emailexists' => "true",
     					 'message' => "" 
     					); 
    			return response()->json($post);
     }

}

}
