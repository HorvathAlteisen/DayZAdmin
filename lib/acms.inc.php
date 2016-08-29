<?php 
	require_once('config.inc.php');
	require_once('connection.inc.php');

	class ACMS {

		private static $instance;
		private static $pathToAppConfig;
		private $appConfig;
		private $serversConfig;
		private $connection;
		private $dataBaseHandlerClass = 'connection';
		private $dataBaseHandler = null;


		private function __construct($pathToAppConfig) {

			$this->appConfig = new Config($pathToAppConfig);			

		}

		private function connectToDb($dataBaseConfig) {

			$this->dataBaseHandler = new $this->dataBaseHandlerClass($dataBaseConfig);
		}


		/*
			This function is used as container for all the
			connections to the different services(SQL, RCON, TeamSpeak)
		*/
		public function initializeConnections($pathToServersConfig) {

			if(!(self::$instance instanceof ACMS)) {

				throw new ACMSException("Initialize object first with getInstance()!");

			} elseif(!file_exists($pathToServersConfig)) {

				throw new ACMSException(sprintf("Config file %s does not exists!", $pathToServersConfig));

			}
			$this->serversConfig = new Config($pathToServersConfig);

			/*
				We only need the dataBase array of the config, so we
				initialize another config object and hand it over to the
				function
			*/
			$this->connectToDB($this->serversConfig->get("dataBase"));

		}

		public static function initialize($pathToAppConfig) {

			self::$pathToAppConfig = $pathToAppConfig;

		}

		public static function getInstance() {

			if(!self::$instance) {
				return self::$instance = new ACMS(self::$pathToAppConfig);
			}

			return self::$instance;
		}

		public function config($key) {

			return $this->appConfig->get($key);

		}
	}
?>