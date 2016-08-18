<?php 
class Template {

	private static $instance;

	private $actionPath;

	private function __construct($arguments) {

		$this->params                    = $config->get('params');
		$this->basePath                  = $config->get('basePath');
		$this->modulePath                = $config->get('modulePath');
		$this->moduleName                = $config->get('moduleName');
		$this->themePath                 = $config->get('themePath');
		$this->themeName                 = $config->get('themeName');
		$this->actionName                = $config->get('actionName');
		$this->viewName                  = $config->get('viewName');
		$this->headerName                = $config->get('headerName');
		$this->footerName                = $config->get('footerName');
		$this->useCleanUrls              = $config->get('useCleanUrls');
		$this->missingActionModuleAction = $config->get('missingActionModuleAction', false);
		$this->missingViewModuleAction   = $config->get('missingViewModuleAction', false);
		$this->referer                   = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	}

	public static function getInstance($arguments) {

		if(!self::$instance) {
			self::$instance = new Template($arguments);
		}

		echo 'test';

		return self::$instance;

	}

	public function render() {

		echo 'test render';

		$this->actionPath = sprintf("%s/%s/%s.php", $this->modulePath, $this->moduleName, $this->actionName);

		if(!file_exists($this->actionPath)) {

			$this->moduleName = $this->missingActionModuleAction[0];
			$this->actionName = $this->missingActionModuleAction[1];
			$this->viewName	  = $this->missingActionModuleAction[1];		

		}

		$this->viewPath = sprintf("%s/%s.php", $this->moduleName, $this->actionName);

		if(!file_exists($this->viewPath)) {
			if ( $this->viewPath === false ) {
				$this->moduleName = $this->missingViewModuleAction[0];
				$this->actionName = $this->missingViewModuleAction[1];
				$this->viewName   = $this->missingViewModuleAction[1];
				$this->actionPath = sprintf('%s/%s/%s.php', $this->modulePath, $this->moduleName, $this->actionName);
				$this->viewPath   = $this->themePath(sprintf('%s/%s.php', $this->moduleName, $this->viewName), true);
			}
		}

	}

}
?>