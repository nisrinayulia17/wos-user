<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Veritrans
{

	/**
	 * Your merchant's server key
	 * @static
	 */
	public static $serverKey;

	/**
	 * true for production
	 * false for sandbox mode
	 * @static
	 */
	public static $isProduction = false;

	/**
	 * Default options for every request
	 * @static
	 */
	public static $curlOptions = array();

	const SANDBOX_BASE_URL = 'https://api.sandbox.midtrans.com/v2';
	const PRODUCTION_BASE_URL = 'https://api.midtrans.com/v2';

	public function config($params)
	{
		Veritrans::$serverKey = $params['server_key'];
		Veritrans::$isProduction = $params['production'];
	}

	/**
	 * @return string Veritrans API URL, depends on $isProduction
	 */
	public static function getBaseUrl()
	{
		return Veritrans::$isProduction ?
			Veritrans::PRODUCTION_BASE_URL : Veritrans::SANDBOX_BASE_URL;
	}

	/**
	 * Send GET request
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 */
	public static function get($url, $server_key, $data_hash)
	{
		return self::remoteCall($url, $server_key, $data_hash, false);
	}

	/**
	 * Send POST request
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 */
	public static function post($url, $server_key, $data_hash)
	{
		return self::remoteCall($url, $server_key, $data_hash, true);
	}

	/**
	 * Actually send request to API server
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 * @param bool    $post
	 */
	public static function remoteCall($url, $server_key, $data_hash, $post = true)
	{
		$ch = curl_init();

		$curl_options = array(
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Accept: application/json',
				'Authorization: Basic ' . base64_encode($server_key . ':')
			),
			CURLOPT_RETURNTRANSFER => 1,
			// CURLOPT_CAINFO => dirname(__FILE__) . "/../data/cacert.pem"
		);

		// merging with Config::$curlOptions
		// if (count(Config::$curlOptions)) {
		// 	// We need to combine headers manually, because it's array and it will no be merged
		// 	if (Config::$curlOptions[CURLOPT_HTTPHEADER]) {
		// 		$mergedHeders = array_merge($curl_options[CURLOPT_HTTPHEADER], Config::$curlOptions[CURLOPT_HTTPHEADER]);
		// 		$headerOptions = array(CURLOPT_HTTPHEADER => $mergedHeders);
		// 	} else {
		// 		$mergedHeders = array();
		// 	}

		// 	$curl_options = array_replace_recursive($curl_options, Config::$curlOptions, $headerOptions);
		// }

		if ($post) {
			$curl_options[CURLOPT_POST] = 1;

			if ($data_hash) {
				$body = json_encode($data_hash);
				$curl_options[CURLOPT_POSTFIELDS] = $body;
			} else {
				$curl_options[CURLOPT_POSTFIELDS] = '';
			}
		}

		curl_setopt_array($ch, $curl_options);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		if ($result === false) {
			throw new Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
		} else {
			try {
				$result_array = json_decode($result);
			} catch (Exception $e) {
				$message = "API Request Error unable to json_decode API response: " . $result . ' | Request url: ' . $url;
				throw new Exception($message);
			}

			if ($info['http_code'] == 201 || $info['http_code'] == 200) {
				return $result_array;
			} else {
				$message = 'Midtrans Error (' . $info['http_code'] . '): '
					. $result . ' | Request url: ' . $url;
				throw new Exception($message, $info['http_code']);
			}
		}
	}

	public static function vtweb_charge($payloads)
	{

		$result = Veritrans::post(
			Veritrans::getBaseUrl() . '/charge',
			Veritrans::$serverKey,
			$payloads
		);

		return $result->redirect_url;


		//$url = Veritrans::getBaseUrl();
		//return Veritrans::$serverKey.Veritrans::getBaseUrl() . '/charge' ;
	}

	public static function vtdirect_charge($payloads)
	{

		$result = Veritrans::post(
			Veritrans::getBaseUrl() . '/charge',
			Veritrans::$serverKey,
			$payloads
		);

		return $result;


		//$url = Veritrans::getBaseUrl();
		//return Veritrans::$serverKey.Veritrans::getBaseUrl() . '/charge' ;
	}

	/**
	 * Retrieve transaction status
	 * @param string $id Order ID or transaction ID
	 * @return mixed[]
	 */
	public static function status($id)
	{
		return Veritrans::get(
			Veritrans::getBaseUrl() . '/' . $id . '/status',
			Veritrans::$serverKey,
			false
		);
	}

	/**
	 * Appove challenge transaction
	 * @param string $id Order ID or transaction ID
	 * @return string
	 */
	public static function approve($id)
	{
		return Veritrans::post(
			Veritrans::getBaseUrl() . '/' . $id . '/approve',
			Veritrans::$serverKey,
			false
		)->status_code;
	}

	/**
	 * Cancel transaction before it's setteled
	 * @param string $id Order ID or transaction ID
	 * @return string
	 */
	public static function cancel($id)
	{
		return Veritrans::post(
			Veritrans::getBaseUrl() . '/' . $id . '/cancel',
			Veritrans::$serverKey,
			false
		)->status_code;
	}

	/**
	 * Expire transaction before it's setteled
	 * @param string $id Order ID or transaction ID
	 * @return mixed[]
	 */
	public static function expire($id)
	{
		return Veritrans::post(
			Veritrans::getBaseUrl() . '/' . $id . '/expire',
			Veritrans::$serverKey,
			false
		);
	}
}
