<?php
require_once('lib/Config.inc.php');
require_once('lib/exception.inc.php');
require_once('lib/template.inc.php');

class Content {

	private static $instance;

	private $modConfig;

	private $defaultModule;

	private function __construct($pathToConfigFile) {

		$this->modConfig = new Config($pathToConfigFile);

	}

	public static function getInstance($pathToConfigFile) {

		if(!self::$instance) {
			self::$instance = new Content($pathToConfigFile);
		}

		return self::$instance;
	}

	public function setDefaultModule($defaultModule) {
		$this->defaultModule = $defaultModule;
	}

	public function render($options = array())
	{
		$app = ACMS::getInstance();
		$config                    = new Config($options);
		$basePath                  = $config->get('basePath');
		$paramsArr                 = $config->get('params');
		$modulePath                = $config->get('modulePath');
		$themesPath                = $config->get('themesPath');
		$themeName                 = $config->get('themeName');
		$defaultModule             = $config->get('defaultModule');
		$defaultAction             = $config->get('defaultAction');
		$missingActionModuleAction = $config->get('missingActionModuleAction');
		$missingViewModuleAction   = $config->get('missingViewModuleAction');
		$useCleanUrls              = $config->get('useCleanUrls');
		
		if (!$defaultModule && $this->defaultModule) {
			$defaultModule = $this->defaultModule;
		}
		if (!$defaultAction && $this->defaultAction) {
			$defaultAction = $this->defaultAction;
		}
		
		if (!$defaultModule) {
			throw new ACMSException('Please set the default module with $dispatcher->setDefaultModule()');
		}
		elseif (!$defaultAction) {
			throw new ACMSException('Please set the default action with $dispatcher->setDefaultAction()');
		}
		
		if (!$paramsArr) {
			$paramsArr = &$_REQUEST;
		}
		
		// Provide easier access to parameters.
		$params  = new Config($paramsArr);
		$baseURI = $app->config('BaseURI');
		
		if ($params->get('module')) {
			$safetyArr  = array('..', '/', '\\');
			$moduleName = str_replace($safetyArr, '', $params->get('module'));
			if ($params->get('action')) {
				$actionName = str_replace($safetyArr, '', $params->get('action'));
			}
			else {
				$actionName = $defaultAction;
			}
		}
		elseif ($app->config('UseCleanUrls')) {
			$baseURI    = preg_replace('&/+&', '/', rtrim($baseURI, '/')).'/';
			$requestURI = preg_replace('&/+&', '/', rtrim($_SERVER['REQUEST_URI'], '/')).'/';
			$requestURI = preg_replace('&\?.*?$&', '', $requestURI);
			$components = explode('/', trim((string)substr($requestURI, strlen($baseURI)), '/'));
			$moduleName = empty($components[0]) ? $defaultModule : $components[0];
			$actionName = empty($components[1]) ? $defaultAction : $components[1];
		}
		elseif (!$params->get('module') && !$params->get('action')) {
			$moduleName = $defaultModule;
			$actionName = $defaultAction;
		}
		
		// Authorization handling.
		/*$auth = Authorization::getInstance();
		if ($auth->actionAllowed($moduleName, $actionName) === false) {
			if (!Flux::$sessionData->isLoggedIn()) {
				Flux::$sessionData->setMessageData('Please log-in to continue.');
				$this->loginRequired($baseURI);
			}
			else {
				$moduleName = 'unauthorized';
				$actionName = $this->defaultAction;
			}
		}*/
		
		$params->set('module', $moduleName);
		$params->set('action', $actionName);
		
		$templateArray  = array(
			'params'                    => $params,
			'basePath'                  => $basePath,
			'modulePath'                => $modulePath,
			'moduleName'                => $moduleName,
			'themesPath'                => $themesPath,
			'themeName'                 => $themeName,
			'actionName'                => $actionName,
			'viewName'                  => $actionName,
			'headerName'                => 'header',
			'footerName'                => 'footer',
			'missingActionModuleAction' => $missingActionModuleAction,
			'missingViewModuleAction'   => $missingViewModuleAction,
			'useCleanUrls'              => $useCleanUrls
		);
		$templateConfig = new Config($templateArray);
		$template       = Template::getInstance($templateConfig);
		
		// Default data available to all actions and views.
		/*
		$data = array(
			'auth'    => Flux_Authorization::getInstance(),
			'session' => Flux::$sessionData,
			'params'  => $params
		);
		$template->setDefaultData($data);*/
		
		// Render template! :D
		$template->render();
	}
}
?>