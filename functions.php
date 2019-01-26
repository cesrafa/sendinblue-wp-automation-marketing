<?php 


public function send_ma_curl($args){
	$curl = curl_init();

	$curl_opt = array(
		CURLOPT_URL => $args['base_url'] . $args['endpoint'],
		CURLOPT_HTTPHEADER => array('ma-key: '.$args['ma_key'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST"
	);

	if (!empty($args['data'])){
		$curl_opt[CURLOPT_POSTFIELDS] = json_encode($args['data']);
	}
	
	curl_setopt_array($curl, $curl_opt);

	$response = curl_exec($curl);
	$err = curl_error($curl) || (curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400);

	curl_close($curl);                              

	return $err;
}