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

		$this->actionPath = $this->createPath(array($this->modulePath, $this->moduleName, $this->actionName));

		if(!file_exists($this->actionPath)) {

			$this->moduleName = $this->missingActionModuleAction[0];
			$this->actionName = $this->missingActionModuleAction[1];
			$this->viewName	  = $this->missingActionModuleAction[1];		

		}

		$this->viewPath = $this->createPath(array($this->themesPath, $this->themeName,$this->moduleName, $this->actionName));

		if(!file_exists($this->viewPath)) {
			if ( $this->viewPath === false ) {
				$this->moduleName = $this->missingViewModuleAction[0];
				$this->actionName = $this->missingViewModuleAction[1];
				$this->viewName   = $this->missingViewModuleAction[1];

				$this->actionPath = $this->createPath($this->modulePath, $this->moduleName, $this->actionName);
				$this->viewPath   = $this->createPath($this->moduleName, $this->viewName);
			}
		}

		// Action File
		include($this->actionPath);

		// Header File
		include($this->createPath(array($this->themesPath, $this->themeName, $this->headerName)));

		// Content File
		include($this->viewPath);

		// footer file
		include($this->createPath(array($this->themesPath, $this->themeName, $this->footerName)));

	}

	private function createPath($join = array()) {

		return sprintf('%s.php', join(DIRECTORY_SEPARATOR,$join));

	}
}
?>