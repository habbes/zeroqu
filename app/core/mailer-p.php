<?php

class Mailer
{
	public static function sendHtml($email, $name, $subject, $htmlbody, $textbody="")
	{
		echo $htmlbody;
		return true;
	}
}