<?php 
	require_once('config.inc.php');

	class ACMS {

		private static $instance;
		private $appConfig;

		private function __construct($pathToConfigFile) {

			$this->appConfig = new Config($pathToConfigFile);			

		}

		public static function getInstance($pathToConfigFile) {

			if(!self::$instance) {
				self::$instance = new ACMS($pathToConfigFile);
			}

			return self::$instance;
		}

		public function config($key) {

			return $this->appConfig->get($key);

		}
	}
?>