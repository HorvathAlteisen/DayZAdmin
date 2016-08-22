<?php 
class Template {

	private static $instance;
	private $defaultData;

	private $actionPath;

	private function __construct($arguments) {

		$this->params                    = $arguments->get('params');
		$this->basePath                  = $arguments->get('basePath');
		$this->modulePath                = $arguments->get('modulePath');
		$this->moduleName                = $arguments->get('moduleName');
		$this->themesPath                = $arguments->get('themesPath');
		$this->themeName                 = $arguments->get('themeName');
		$this->actionName                = $arguments->get('actionName');
		$this->viewName                  = $arguments->get('viewName');
		$this->headerName                = $arguments->get('headerName');
		$this->footerName                = $arguments->get('footerName');
		$this->useCleanUrls              = $arguments->get('useCleanUrls');
		$this->missingActionModuleAction = $arguments->get('missingActionModuleAction', false);
		$this->missingViewModuleAction   = $arguments->get('missingViewModuleAction', false);
		$this->referer                   = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	}

	public static function getInstance($arguments) {

		if(!self::$instance) {
			self::$instance = new Template($arguments);
		}

		return self::$instance;

	}

	public function setDefaultData(array &$data) {

		$this->defaultData = $data;
		return $data;

	}

	public function render() {

		//$this->actionPath = sprintf("%s/%s/%s.php", $this->modulePath, $this->moduleName, $this->actionName);
		$this->actionPath = $this->join(DIRECTORY_SEPARATOR, array($this->modulePath, $this->moduleName, $this->actionName));

		if(!file_exists($this->actionPath.'.php')) {

			$this->moduleName = $this->missingActionModuleAction[0];
			$this->actionName = $this->missingActionModuleAction[1];
			$this->viewName	  = $this->missingActionModuleAction[1];		

		}

		$this->viewPath = $this->join(DIRECTORY_SEPARATOR, array($this->moduleName, $this->actionName));

		//$this->viewPath = sprintf("%s/%s.php", $this->moduleName, $this->actionName);

		if(!file_exists($this->viewPath.'.php')) {
			if ( $this->viewPath === false ) {
				$this->moduleName = $this->missingViewModuleAction[0];
				$this->actionName = $this->missingViewModuleAction[1];
				$this->viewName   = $this->missingViewModuleAction[1];
				// = join(DIRECTORY_SEPARATOR, array('root', 'lib', 'file.php');
				$this->actionPath = sprintf('%s/%s/%s.php', $this->modulePath, $this->moduleName, $this->actionName);
				$this->viewPath   = $this->themesPath(sprintf('%s/%s.php', $this->moduleName, $this->viewName), true);
			}
		}


		// Header File
		include(join(DIRECTORY_SEPARATOR, array($this->themesPath, $this->themeName, $this->headerName)).'.php');

		// Content File

		// footer file
		include(join(DIRECTORY_SEPARATOR, array($this->themesPath, $this->themeName, $this->footerName)).'.php');

	}

	private function join($join = array()) {

		return sprintf('%s.php', join(DIRECTORY_SEPARATOR,$join), '.php');

	}
}
?>