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
		require_once DIR_CONFIG.$ds."sendgrid.php";
		
		$mailer = new SendGrid($sendgrid['username'], $sendgrid['password']);
		
		self::$fromEmail = $sendgrid['from_email'];
		self::$fromName = $sendgrid['from_name'];
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
		
		$email = new SendGrid\Email();
		$email->addTo($email)
			->setFrom(self::$fromEmail)
			->setSubject($subject)
			->setHtml($htmlbody);
		
		try {
			$mailer->send($email);
			return true;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

}
