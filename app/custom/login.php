<?php

class Login
{
	
	private static $admin;
	private static $voter;
	
	public static function session()
	{
		return Session::getInstance();
	}
	
	public static function adminLogin(Admin $admin)
	{
		self::session()->login = new DataObject();
		self::session()->login->adminLogin = true;
		self::session()->login->admin_id = $admin->getId();
		self::$admin = $admin;
	}
	
	/**
	 * @return Admin
	 */
	public static function getAdmin()
	{
		if(!self::$admin){
			self::$admin = Admin::findById(self::session()->login->admin_id);
		}
		return self::$admin;
	}
	
	public static function isAdminLoggedIn()
	{
		return self::session()->login && self::session()->login->adminLogin;
	}
	
	public static function voterLogin($voter)
	{
		self::session()->login = new DataObject();
		self::session()->login->voterLogin = true;
		self::session()->login->voter_id = $voter->getId();
		self::$voter = $voter;
	}
	
	/**
	 * @return Voter
	 */
	public static function getVoter()
	{
		if(!self::$voter){
			self::$voter = Voter::findById(self::session()->login->voter_id);
		}
		return self::$voter;
	}
	
	public static function isVoterLoggedIn()
	{
		return self::session()->login && self::session()->login->voterLogin;	
	}
	
	public static function logout()
	{
		unset(self::session()->login);
	}
}