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
	 * returns date-time format suitable for database input
	 * @param int $timestamp
	 * @return string
	 */
	public static function dbDateFormat($timestamp)
	{
		return strftime("%Y-%m-%d %H:%M:%S",$timestamp);
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
}

?>