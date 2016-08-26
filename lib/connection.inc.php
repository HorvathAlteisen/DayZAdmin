<?php
class  connection {

	private $config = null;
	private $pdo = null;

	public function __construct($config) {

		$this->config = $config;

	}

	public function connect() {

		$dsn = "mysql:";

		$dsn .= ";port=". $this->config->get("dataBase.dbPort");
		$dsn .= ";dbname=". $this->config->get("dataBase.db");
		$dsn .= 

		$this->pdo = new PDO($dsn, );

	}

}
?>