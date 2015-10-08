<?php 

use League\Flysystem\FileSystem;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Adapter\Local;


class Storage
{
	private static $storage;
	
	private static function init()
	{
		if(getenv('S3_KEY')){
		
			$client = S3Client::factory([
					'credentials' => [
							'key'    => getenv('S3_KEY'),
							'secret' => getenv('S3_SECRET'),
					],
					
					'region' => 'us-west-2',
					'version' => '2006-03-01'
			]);
		
			$adapter = new AwsS3Adapter($client, getenv('S3_BUCKET'), getenv('S3_PREFIX'));
		}
		else {
			$adapter = new Local(DIR_ROOT . getenv('STORAGE_PATH'));
		}
		
		self::$storage = new FileSystem($adapter);
	}
	/**
	 * 
	 * @return \League\Flysystem\Filesystem
	 */
	public static function instance()
	{
		if(!self::$storage) self::init();
		return self::$storage;
	}
}
