<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Mobile extends REST_Controller
{
	private $m_id;

	public function __construct()
	{
		parent::__construct();
	}
	
    function cors_headers() //Cross-origin resource sharing
    {
	header('Access-Control-Allow-Origin: *');
//	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
    function regid_get()
    {
	$this->regid_post();
/*
		$data = array('returned: get'. $this->get('id'));
		$this->response($data);
*/
    }
    function regid_options() {
        $this->cors_headers();
        $this->response($_SERVER['HTTP_ORIGIN']);
    }

    function regid_post()
    {
	$this->cors_headers();
	$this->load->model('mobile_model');
//因為資料表已設定為unique所以不用擔心鍵值重複
	$data = array('success' =>  $this->mobile_model->setRegID($this->post('regId'),$this->post('platform')));
        $this->response($data);
    }
    
    function readMsg_get()
    {
	$this->readMsg_post();
    }

    function readMsg_options()
    {
        $this->cors_headers();
        $this->response($_SERVER['HTTP_ORIGIN']);
    }

    function readMsg_post()
    {
                $this->cors_headers();
                $this->load->model('mobile_model');
                $data = $this->mobile_model->getMsg( $this->input->get_post('deviceID'));
                $this->response($data);
    }


    function sendMsg_options()
    {
	$this->cors_headers();
	$this->response($_SERVER['HTTP_ORIGIN']);
    }
    function sendMsg_get()
    {	
		$this->sendMsg_post();
	}
    function sendMsg_post()
    {		
		$this->cors_headers();
		$this->load->model('mobile_model');
//紀錄訊息內容至DB，並取得編號
		$this->m_id = $this->mobile_model->setMsg($this->input->get_post('sender'),
                        $this->input->get_post('level'),
                        $this->input->get_post('message'),
                        $this->input->get_post('info'));
		$data["android"] = $this->sendAndroidMsg();
		$data["iphone"] = $this->sendIPhoneMsg();
		//array_push($data,array("iphone"=>$this->sendIPhoneMsg()));
		$this->response($data);
    }

    function sendAndroidMsg()
    {
		
		$url = 'https://android.googleapis.com/gcm/send';
		$registatoin_ids = $this->mobile_model->getAllRegID("android");
		$m_id = $this->m_id;
/*
	$this->mobile_model->setMsg($this->input->get_post('sender'), 
			$this->input->get_post('level'), 
			$this->input->get_post('message'), 
			$this->input->get_post('info'));
*/
		$message = array( 'title' => $this->input->get_post('level'), 'message' => $this->input->get_post('message'),'sender' => $this->input->get_post('sender'), 'info' => $this->input->get_post('info'), 'soundname' => "beep.wav",'timeStamp'=> date("Y-m-d H:i:s"));
		$fields = array(
             'registration_ids' => $registatoin_ids,
             'data' =>  $message
         );

		$headers = array(
             'Authorization: key=AIzaSyBUNr59L7EKcpX3KUdODfUYQGNYw7jT0Zs',
             'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		$aGCMresult = json_decode($result,true);
        $aUnregID = $aGCMresult['results'];
        $unregcnt = count($aUnregID);
        for($i=0;$i<$unregcnt;$i++)
        {
			$aErr = $aUnregID[$i];

			if(isset($aErr['message_id'])){
//			   $this->mobile_model->setMsgLog($m_id, $registatoin_ids[$i]);
			   if(isset($aErr['registration_id'])){ //若有設定registration_id則進行registration_id更新
			     $this->mobile_model->updateRegID($registatoin_ids[$i],$aErr['registration_id']);
			     $this->mobile_model->setMsgLog($m_id, $aErr['registration_id']); //紀錄訊息發送紀錄至新註冊ID
			   } else {
				$this->mobile_model->setMsgLog($m_id, $registatoin_ids[$i]); //紀錄訊息發送紀錄
			   }

			}
			if(isset($aErr['error']) && $aErr['error']=='NotRegistered')
				$this->mobile_model->deleteRegID($registatoin_ids[$i]);

        }
		// Close connection
		curl_close($ch);
		//return an array
		return $aGCMresult;
	}
	
	function sendIPhoneMsg()
	{
		// Put your device token here (without spaces):
//		$deviceToken = '90d2cd8a18ac00828915d7bdd4aec4207d45db04d0db87a08e334d6aae8386d3';
		$deviceTokens = $this->mobile_model->getAllRegID("iphone");
//		print_r($deviceTokens);
		// Put your private key's passphrase here:
		$passphrase = 'khuscimd';

		// Put your alert message here:
		$message = $this->input->get_post('level') . "-" . $this->input->get_post('message') ;
		$m_id = $this->m_id;
/*
		$this->mobile_model->setMsg($this->input->get_post('sender'),
                        $this->input->get_post('level'),
                        $this->input->get_post('message'),
                        $this->input->get_post('info'));
*/
//		$message = array( 'level' => $this->input->get_post('level'), 'message' => $this->input->get_post('message'),'sender' => $this->input->get_post('sender'), 'info' => $this->input->get_post('info'), 'timeStamp'=> date("Y-m-d H:i:s"));

		////////////////////////////////////////////////////////////////////////////////

		$this->load->helper('file');
//		$string = read_file('.');
//		echo "$string";
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', './public/ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

//		echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default',
			'badge' => 1
			);

		// Encode the payload as JSON
		$payload = json_encode($body);
		$count = 0;
		foreach($deviceTokens as $deviceToken){
		// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
/*
			if (!$result)
				echo 'Message not delivered' . PHP_EOL;
			else 
				echo 'Message successfully delivered' . PHP_EOL;
*/
			if ($result){
				$this->mobile_model->setMsgLog($m_id, $deviceToken);
				$count++;
			}
		}
		$res = array("success"=>$count);
		// Close the connection to the server
		fclose($fp);	
		return $res;
	}

	
}
?>

