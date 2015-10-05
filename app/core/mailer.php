<?php

$ds = DIRECTORY_SEPARATOR;
require_once __DIR__ . "{$ds}Swift{$ds}lib{$ds}swift_required.php";

class Mailer
{
	
	/**
	 * @var Swift_Mailer
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
		
		
// 		$host = $smtp["host"];
// 		$port = $smtp["port"];
// 		$security = $smtp["security"];
// 		$uname = $smtp["uname"];
// 		$password = $smtp["pass"];
// 		$from = $smtp["from"];
// 		$fromName = $smtp["from_name"];
// 		$transport = Swift_SmtpTransport::newInstance($host, $port, $security);
// 		$transport->setUsername($uname);
// 		$transport->setPassword($password);
// 		$mailer = Swift_Mailer::newInstance($transport);
		
		$mandrill = new Mandrill($mandrill['api_key']);
		
		self::$fromEmail = $mandrill['from_email'];
		self::$fromName = $mandrill['from_name'];
		return $mandrill;
	}
	
	/**
	 * the working instance of this class
	 * @return Swift_Mailer
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
		
// 		$msg = Swift_Message::newInstance($subject);
// 		$msg->setTo([$email]);
// 		$msg->setBody($htmlbody, "text/html");
// 		$msg->setFrom([self::$fromEmail => self::$fromName]);
		
// 		if(empty($textbody)){
// 			$textbody = html_entity_decode(strip_tags($htmlbody));
// 		}
		
// 		$msg->addPart($textbody, "text/plain");
		
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