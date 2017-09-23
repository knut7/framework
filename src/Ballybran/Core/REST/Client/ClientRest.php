<?php

/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Core\REST\Client;
use \Ballybran\Core\REST\Encodes;
use \Ballybran\Core\REST\RestUtilities;
use \Ballybran\Core\REST\RestRequest;

class ClientRest extends Encodes{

	public function get($argm) {

     $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $argm);
 
    // Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    curl_close($ch);
 $decoded = json_decode($output);

if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
if(json_last_error() === JSON_ERROR_NONE){
	//if not joson, is xml'
	return(($decoded));

}else{
	// if json true, return json
	return(($output));

      }
}


	public function post($url)
	{
		$service_url = $url;
		$curl = curl_init($service_url);

		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		
		echo 'response ok!';
		var_dump($curl_response);
	}

	public function put($value='')
	{
		$service_url = 'http://example.com/api/conversations/cid123/status';
		$ch = curl_init($service_url);
		 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		$data = array("status" => 'R');
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		$response = curl_exec($ch);
		if ($response === false) {
		    $info = curl_getinfo($ch);
		    curl_close($ch);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($ch);
		$decoded = json_decode($response);
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}
		echo 'response ok!';
		var_export($decoded->response);
	}

	public function delete($value='')
	{
		$service_url = 'http://example.com/api/conversations/[CONVERSATION_ID]';
		$ch = curl_init($service_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		$curl_post_data = array(
		        'note' => 'this is spam!',
		        'useridentifier' => 'agent@example.com',
		        'apikey' => 'key001'
		);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$response = curl_exec($ch);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}
		echo 'response ok!';
		var_export($decoded->response);
			}
}