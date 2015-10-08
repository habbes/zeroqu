<?php 

/**
 * general utility methods
 * @author Habbes
 *
 */
class Utils
{
	
	/**
	 * converts string to lower case and pluralizes it with an 's'
	 * @param string $s
	 * @return string
	 */
	public static function stringToLowerPlural($s)
	{
		return strtolower($s)."s";
	}
	
	/**
	 * converts symbol-delimited string (such as snake case) to camel case
	 * @param unknown $s
	 * @return Ambigous <string, unknown>
	 */
	public static function delimitedToCamelCase($s, $delimiter = "_")
	{
		$new = "";
		for($i = 0; $i < strlen($s); $i++){
			if($s[$i] == $delimiter){
				$i++;
				$new .= strtoupper($s[$i]);
				continue;
			}
			$new .= $s[$i];
		}
		return $new;
	}
	
	/**
	 * converts from camel case to a symbol-delimited string
	 * @param string $s
	 * @param string $delimiter
	 * @param string $keep_case if false, uppercase letters are converted to lowercase 
	 * @return string
	 */
	public static function camelToDelimitedCase($s, $delimiter = "_", $keep_case = false)
	{
		$new = $keep_case? $s[0] : strtolower($s[0]);
		for($i = 1; $i < strlen($s); $i++){
			if(strtoupper($s[$i]) == $s[$i] && !is_numeric($s[$i])){
				$new .= "_";
				$new .= $keep_case? $s[$i] : strtolower($s[$i]);
				continue;
			}
			$new .= $s[$i];
		}
		return $new;
	}
	
	/**
	 * converts from camel case to a symbol-separated string to which an 's' is appended to make it plural
	 * @param unknown $s
	 * @param string $delimiter
	 * @param string $keep_case if false, uppercase letters are converted to lowercase
	 * @return string 
	 */
	public static function camelToDelimitedCasePlural($s, $delimiter = "_", $keep_case = false)
	{
		return Utils::camelToDelimitedCase($s, $delimiter, $keep_case) . "s";
	}
	
	/**
	 * returns date-time format suitable for database input
	 * @param int $timestamp
	 * @return string
	 */
	public static function dbDateFormat($timestamp)
	{
		return strftime("%Y-%m-%d %H:%M:%S",$timestamp);
	}
	
	/**
	 * returns the date-time in a format suitable for the front-end
	 * @param int $timestamp
	 * @return string
	 */
	public static function siteDateTimeFormat($timestamp)
	{
		$dt = new DateTime("@".$timestamp);
		$dt->setTimeZone(new DateTimeZone(Config::date('timezone')));
		return $dt->format("D d M Y H:i");
	}
	
	/**
	 * returns the date in a format suitable for the front-end
	 * @param int $timestamp
	 * @return string
	 */
	public static function siteDateFormat($timestamp)
	{
		$dt = new DateTime("@".$timestamp);
		$dt->setTimeZone(new DateTimeZone(Config::date('timezone')));
		return $dt->format("D d M Y");
	}
	
	/**
	 * hashes a password
	 * @param string $password
	 * @return string
	 */
	public static function hashPassword($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}
	
	/**
	 * check whether a password and a hash match
	 * @param string $password
	 * @param string $hash
	 * @return boolean
	 */
	public static function verifyPassword($password, $hash)
	{
		return password_verify($password, $hash);
	}
	
	/**
	 * returns a filename which is unique in the given directory
	 * @param string $directory
	 * @return string
	 */
	public static function uniqueFilename($directory)
	{
		$ds = DIRECTORY_SEPARATOR;
		$i = 0;
		do{
			$filename = uniqid($i++);
		} while (file_exists($directory . $ds . $filename));
		
		return $filename;
	}
	
	/**
	 * generates a random unique code
	 * @param number $length the size of the string, should be an even number
	 * @return string
	 */
	public static function uniqueRandomCode($length = 32)
	{
		//the function accepts the length in bytes, 2 hex digits fit one byte
		//hence the division
		return bin2hex(openssl_random_pseudo_bytes($length/2));
	}
	
	/**
	 * send a json response to the user
	 * @param JsonObject/String $json
	 */
	public static function sendJsonResponse($json)
	{
		if($json instanceof JsonObject)
			$json = $json->encode();
		
		header('Content-Type: text/json');
		header('Content-Length: ' . strlen($json));
		echo $json;
		exit;
	}
	
	/**
	 * send the content of the file in the given path as a response to the user
	 * this can be used to implement download functionality without providing the path of the file
	 * @param string $path
	 * @param string $displayName
	 */
	public static function sendFileResponse($path, $displayName)
	{
		if(!Storage::instance()->has($path)) return false;
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header("Content-Disposition: attachment; filename=\"{$displayName}\"");
		header("Content-Transfer-Enconding: binary");
		header("Expires: 0");
		header("Cache-Control: must-revalidate");
		header("Pragma: public");
		header("Content-Length: " . Storage::instance()->getSize($path));
		
		/*
		 discard the content of the output buffer and flush
		 this is to avoid errors that might arise from using readfile()
		 on large files
		*/
		ob_clean();
		flush();
		echo Storage::instance()->read($path);
		exit;
	}
	
	/**
	 * Send file as a response
	 * @param string $path
	 */
	public static function sendDataResponse($path)
	{
		header('Content-Type: '.Storage::instance()->getMimetype($path));
		header("Content-Length: " . Storage::instance()->getSize($path));
		ob_clean();
		flush();
		echo Storage::instance()->read($path);
		exit;
	}
	
	
}

?>