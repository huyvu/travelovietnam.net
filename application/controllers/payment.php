<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$requests = $_GET;
		$params = explode('/', current_url());
		
		$key = "";
		$paymentOk = false;
		http://www.travelovietnam.com/payment.html?vpc_AuthorizeId=391132&vpc_AVS_StateProv=North&vpc_CardLevelIndicator=88&vpc_AVSRequestCode=Z&vpc_BatchNo=20140317&vpc_Version=2&vpc_Card=VC&vpc_TransactionIdentifier=1234567890123456789&vpc_AcqAVSRespCode=Unsupported&vpc_AVSResultCode=Unsupported&vpc_Merchant=TESTONEPAYUSD&vpc_CommercialCard=U&vpc_Amount=63900&vpc_SecureHash=216F11751DE7E1E12670D91609F970A5DC62C092514CC313AB7C6B1E8D520DE7&vpc_AVS_Country=VNM&vpc_MarketSpecificData=8&vpc_MerchTxnRef=tour_3a106a26bfb83826fff2b8391b458dd8&vpc_CSCResultCode=Unsupported&AgainLink=http%253A%252F%252Fwww.travelovietnam.com%252Ftours%252Fbooking%252Freview.html&vpc_OrderInfo=T1&vpc_Command=pay&vpc_AcqResponseCode=00&vpc_VerType=2D&vpc_CardNum=400555xxxxxxx001&vpc_TransactionNo=3106&vpc_ReceiptNo=407611391132&vpc_Message=Approved&Title=Settle+payment+online+at+TraveloVietnam.Com&vpc_AVS_City=Hanoi&vpc_AcqCSCRespCode=Unsupported&vpc_Locale=en_VN&vpc_TxnResponseCode=0&vpc_ReturnACI=8&vpc_AVS_Street01=Tran+Quang+Khai&vpc_CommercialCardIndicator=3&vpc_AVS_PostCode=1234
		// OnePay
		if (isset($_GET['vpc_TxnResponseCode']))
		{
			$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
			$vpc_MerchTxnRef = $_GET["vpc_MerchTxnRef"];
			$vpc_AcqResponseCode = $_GET["vpc_AcqResponseCode"];
			unset($_GET["vpc_SecureHash"]);
			
			$key = $vpc_MerchTxnRef;
			
			// set a flag to indicate if hash has been validated
			$errorExists = false;
			
			if (strlen($this->util->get_OP_SECURE_SECRET()) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned")
			{
			    ksort($_GET);
			    
			    $md5HashData = "";
			    
			    // sort all the incoming vpc response fields and leave out any with no value
			    foreach ($_GET as $k => $v) {
			        if ($k != "vpc_SecureHash" && (strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
					    $md5HashData .= $k . "=" . $v . "&";
					}
			    }
			    
			    $md5HashData = rtrim($md5HashData, "&");
			
				if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$this->util->get_OP_SECURE_SECRET())))) {
			        // Secure Hash validation succeeded, add a data field to be displayed later.
			        $hashValidated = "CORRECT";
			    } else {
			        // Secure Hash validation failed, add a data field to be displayed later.
			        $hashValidated = "INVALID HASH";
			    }
			} else {
			    // Secure Hash was not validated, add a data field to be displayed later.
			    $hashValidated = "INVALID HASH";
			}
			
			if($hashValidated=="CORRECT" && $_GET["vpc_TxnResponseCode"]=="0") {
				// Transaction successful
				$paymentOk = true;
			} else if ($hashValidated=="INVALID HASH" && $_GET["vpc_TxnResponseCode"]=="0") {
				// Transaction is pendding
				$paymentOk = false;
			} else {
				// Transaction is failed
				$paymentOk = false;
			}
		}
		// G2S
		else if (@$requests['customField1'])
		{
			$key = $requests['customField1'];
			
			//Status, could be APPROVED, PENDING, DECLINED or ERROR
			$checksum = md5(urldecode(G2S_SECRET_KEY.$requests['totalAmount'].$requests['currency'].$requests['responseTimeStamp'].$requests['PPP_TransactionID'].$requests['Status'].$requests['productId']));
			
			if ($requests['Status'] && $checksum === $requests['advanceResponseChecksum']) {
				if ($requests['Status'] == 'APPROVED') {
					$paymentOk = true;
				}
				else {
					$paymentOk = false;
					$errMsg = '';
					$checksum = md5(G2S_SECRET_KEY.$requests['TransactionID'].$requests['ErrCode'].$requests['ExErrCode'].$requests['Status']);
					if ($checksum === $requests["responsechecksum"]) {
						$errMsg = 'Your payment failed with status: ';
						$errMsg .= '<b>'.$requests['Status'].'</b>';
						$errMsg .= ' and reason ';
						$errMsg .= '<b>'.$requests['message'].'</b>';
					}
					else {
						$errMsg = 'Your payment failed because of invalid checksum! Possible fraud attemp!';
					}
				}
			}
			else {
				$paymentOk = false;
				$errMsg	 = '';
				$errMsg	 = 'Your payment failed with status: ';
				$errMsg .= '<b>Failed</b>';
				$errMsg .= ' and reason ';
				$errMsg .= '<b>'.$requests['message'].'</b>';
			}
		}
		else if (!empty($params[4]) && !empty($params[5]))
		{
			if ($params[4] == 'sucess')
			{
				$key = $params[5];
				$paymentOk = true;
			}
			else if ($params[4] == 'failure')
			{
				$paymentOk = false;
				$key = $params[5];
				
				$errMsg  = 'Your payment failed with status: ';
				$errMsg .= '<b>Failed</b>';
				$errMsg .= ' and reason ';
				$errMsg .= '<b>Canceled by user</b>';
			}
		}
		
		if (!empty($key))
		{
			if ($paymentOk)
			{
				if (substr($key, 0 , 5) == "tour_") {
					header('Location: '.BASE_URL."/tours/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 7) == "flight_") {
					header('Location: '.BASE_URL."/flights/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 6) == "hotel_") {
					header('Location: '.BASE_URL."/hotels/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 5) == "visa_") {
					header('Location: '.BASE_URL."/visa/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 3) == "po_") {
					header('Location: '.BASE_URL."/payment-online/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 2) == "m_") {
					header('Location: '.BASE_URL."/member/payment-success.html?key=".$key);
					die();
				}
			}
			else
			{
				$this->session->set_flashdata("payment_error", $errMsg);
				
				if (substr($key, 0 , 5) == "tour_") {
					header('Location: '.BASE_URL."/tours/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 7) == "flight_") {
					header('Location: '.BASE_URL."/flights/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 6) == "hotel_") {
					header('Location: '.BASE_URL."/hotels/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 5) == "visa_") {
					header('Location: '.BASE_URL."/visa/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 3) == "po_") {
					header('Location: '.BASE_URL."/payment-online/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 2) == "m_") {
					header('Location: '.BASE_URL."/member/payment-failure.html?key=".$key);
					die();
				}
			}
		}
	}
	
	function getResponseDescription($responseCode)
	{
	    switch ($responseCode) {
	        case "0" :
	            $result = "Transaction Successful";
	            break;
	        case "?" :
	            $result = "Transaction status is unknown";
	            break;
	        case "1" :
	            $result = "Bank system reject";
	            break;
	        case "2" :
	            $result = "Bank Declined Transaction";
	            break;
	        case "3" :
	            $result = "No Reply from Bank";
	            break;
	        case "4" :
	            $result = "Expired Card";
	            break;
	        case "5" :
	            $result = "Insufficient funds";
	            break;
	        case "6" :
	            $result = "Error Communicating with Bank";
	            break;
	        case "7" :
	            $result = "Payment Server System Error";
	            break;
	        case "8" :
	            $result = "Transaction Type Not Supported";
	            break;
	        case "9" :
	            $result = "Bank declined transaction (Do not contact Bank)";
	            break;
	        case "A" :
	            $result = "Transaction Aborted";
	            break;
	        case "C" :
	            $result = "Transaction Cancelled";
	            break;
	        case "D" :
	            $result = "Deferred transaction has been received and is awaiting processing";
	            break;
	        case "F" :
	            $result = "3D Secure Authentication failed";
	            break;
	        case "I" :
	            $result = "Card Security Code verification failed";
	            break;
	        case "L" :
	            $result = "Shopping Transaction Locked (Please try the transaction again later)";
	            break;
	        case "N" :
	            $result = "Cardholder is not enrolled in Authentication scheme";
	            break;
	        case "P" :
	            $result = "Transaction has been received by the Payment Adaptor and is being processed";
	            break;
	        case "R" :
	            $result = "Transaction was not processed - Reached limit of retry attempts allowed";
	            break;
	        case "S" :
	            $result = "Duplicate SessionID (OrderInfo)";
	            break;
	        case "T" :
	            $result = "Address Verification Failed";
	            break;
	        case "U" :
	            $result = "Card Security Code Failed";
	            break;
	        case "V" :
	            $result = "Address Verification and Card Security Code Failed";
	            break;
			case "99" :
	            $result = "User Cancel";
	            break;
	        default  :
	            $result = "Unable to be determined";
	    }
	    return $result;
	}
	
	// If input is null, returns string "No Value Returned", else returns input
	function null2unknown($data)
	{
	    if ($data == "") {
	        return "No Value Returned";
	    } else {
	        return $data;
	    }
	}
	
	public function pending()
	{
		$this->load->view('payment/pending');
	}
}

?>