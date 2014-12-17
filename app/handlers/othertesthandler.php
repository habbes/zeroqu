<?php

class OtherTestHandler extends RequestHandler
{
	public function get($num, $num2){
		$n = (int) $num;
		
		echo "The square of $n is " . $num * $num2;
	}
}