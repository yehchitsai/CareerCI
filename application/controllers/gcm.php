<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Gcm extends CI_Controller //google cloud mess
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mobile_model');
	}
	
    function sendAndroidMsg()
    {
		$url = 'https://android.googleapis.com/gcm/send';
		$registatoin_ids = $this->mobile_model->getAllRegID("android");
		if(empty($registatoin_ids))
		  return;
//		$message = array( 'title' => $this->input->post('title'), 'message' => $this->input->post('message'), 'soundname' => "beep.wav",'timeStamp'=> date("Y-m-d H:i:s"));
		$message = array( 'title' => $this->input->get_post('title'), 'message' => $this->input->get_post('message'), 'soundname' => "beep.wav",'timeStamp'=> date("Y-m-d H:i:s"));
		$fields = array(
             'registration_ids' => $registatoin_ids,
             'data' =>  $message
         );

		$headers = array(
             'Authorization: key=AIzaSyBz0VqS8eyBt2IC-pLIra0u9XAJzTfpJ_k',
             //'Authorization: key=AIzaSyAe8F2I9L2-figBgZCj-Awp2FQ38Ooxmc8',
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
			if(isset($aErr['error']) && $aErr['error']=='NotRegistered')
				$this->mobile_model->deleteRegID($registatoin_ids[$i]);
        }
		// Close connection
		curl_close($ch);
		echo $result;
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
		$message = $this->input->post('message');

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

		echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default',
			'badge' => 1
			);

		// Encode the payload as JSON
		$payload = json_encode($body);
		
		foreach($deviceTokens as $deviceToken){
		// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
		}
		if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;

		// Close the connection to the server
		fclose($fp);	
	}
	
    function sendMsg()
    {		
	//$this->load->helper('directory');
		if($this->input->post('submit')!==false){
			$this->sendAndroidMsg();
			$this->sendIPhoneMsg();
		}
		$data = array('sendMsgURL' => base_url() . "index.php/gcm/sendMsg"); 
		$this->parser->parse('sendMessage', $data);

    }
}
?>
