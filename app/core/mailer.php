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
	
	private function __construct(){}
	
	private static function mailerFromConfig()
	{
		$ds = DIRECTORY_SEPARATOR;
		require_once DIR_CONFIG.$ds."mandrill.php";
		
		$mailer = new Mandrill($mandrill['api_key']);
		
		self::$fromEmail = $mandrill['from_email'];
		self::$fromName = $mandrill['from_name'];
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
		
		$msg = [
			'html'=> $htmlbody,
			'subject' => $subject,
			'from_email' => self::$fromEmail,
			'from_name' => self::$fromName,
			'to' => [
				[
					'email' => $email,
					'type' => 'to'
				]
			]
			
		];
		
		try {
			$mailer->messages->send($msg, true);
			return true;
		}
		catch(Mandrill_Error $e){
			echo $e->getMessage();
			return false;
		}
	}
	
}