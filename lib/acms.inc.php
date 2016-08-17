<?php 
	require_once('config.inc.php');
	class ACMS {

		private static $acms;
		private $appConfig;
		private $session;

		private function __construct($configPath) {

			$config = new Config($configPath);

			$this->setAppConfig($config);

		}

		public static function initialize($configPath) {

			self::setACMS(new ACMS($configPath));
			return ACMS::$acms;
		}

		private static function setACMS(ACMS $acms) {

			self::$acms = $acms;

		}

		private function setAppConfig(Config $config) {

			$this->appConfig = $config;

		}

		public function config($key) {

			return $this->appConfig->get($key);

		}
	}
?>