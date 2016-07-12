<?php

class Mailer
{
	
	/**
	 * @var Mandrill
	 */
	private static $instance;
	
	/**
	 * @var string
	 */
	private static $fromEmail;
	
	/**
	 * @var string
	 */
	private static $fromName;

	private static $domain;
	
	private function __construct(){}
	
	private static function mailerFromConfig()
	{
		$ds = DIRECTORY_SEPARATOR;
		require_once DIR_CONFIG.$ds."mailgun.php";
		
		$client = new \Http\Adapter\Guzzle6\Client();
		$mailer = new Mailgun\Mailgun($mailgun['api_key'], $client);
		
		self::$fromEmail = $mailgun['from_email'];
		self::$fromName = $mailgun['from_name'];
		self::$domain = $mailgun['domain'];
		return $mailer;
	}
	
	/**
	 * the working instance of this class
	 * @return Mandrill
	 */
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = self::mailerFromConfig();
		}
		return self::$instance;
	}
	
	public static function setFromEmail($email)
	{
		self::$fromEmail = $email;
	}
	
	public static function getFromName()
	{
		return self::$fromName;
	}
	
	public static function setFromName($name)
	{
		self::$fromName = $name;
	}
	
	public static function sendHtml($email, $name, $subject, $htmlbody, $textbody="")
 	{
		$mailer = self::getInstance();

		try {
			$mailer->sendMessage(self::$domain, [
				"from"=> self::$fromEmail,
				"to"=> $email,
				"subject"=> $subject,
				"html" => $htmlbody
			]);
			return true;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

}
