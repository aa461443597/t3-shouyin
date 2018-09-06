<?php
	function https_request($url,$data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

/**
 *加工json格式的字符串
 *@function encode_json
 *@param $str
 *@return 加工后的json格式字符串(并解码)
 */
	function encode_json($str) {
		return urldecode(json_encode(url_encode($str)));
	}

/**
 *对字符串进行加工，编码成URL字符串所有非字母数字字符都将被替换成百分号（%）后跟两位十六进制数
 *@function url_encode
 *@param $str 要编码的字符串
 *@return URL字符串
 */
	function url_encode($str) {
		if( is_array($str) ){
			foreach( $str as $key=>$value ){
				$str[urlencode($key)] = url_encode($value);
			}
		}else{
			$str = urlencode($str);
		}
		return $str;
	}