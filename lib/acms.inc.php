<?php 
	require_once('config.inc.php');

	class ACMS {

		private static $instance;
		private static $appConfig;

		private function __construct($pathToConfigFile) {

			self::$appConfig = new Config($pathToConfigFile);			

		}

		public static function getInstance($pathToConfigFile) {

			if(!self::$instance) {
				self::$instance = new ACMS($pathToConfigFile);
			}

			return self::$instance;
		}

		public static function config($key) {

			return self::$appConfig->get($key);

		}
	}
?>