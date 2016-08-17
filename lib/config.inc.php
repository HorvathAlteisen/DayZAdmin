<?php

class Config {

	private $configArr;
	

	private $defaultSetOptions = array('overwrite' => true, 'force' => true);
	

	private $exceptionClass = 'CMSexception';
	

	/*public function __construct(array &$configArr)
	{
		$this->configArr = &$configArr;
	}*/

	public function __construct($pathToConfigFile) {

		if(is_array($pathToConfigFile)) {
			$this->configArr = &$configArr;
		} else {

			
			$file = file_get_contents($pathToConfigFile);
			$this->configArr = json_decode($file, true);
		}
	}
	

	public function &toArray()
	{
		return $this->configArr;
	}
	

	public function &getChildrenConfigs()
	{
		$children = array();
		foreach ($this->configArr as $key => &$child) {
			if (is_array($child)) {
				$children[$key] = new Config($child);
			}
		}
		return $children;
	}
	

	public function get($key, $configObjectIfArray = true)
	{
		$keys = explode('.', $key);
		$base = &$this->configArr;
		$size = count($keys) - 1;
		
		for ($i = 0; $i < $size; ++$i) {
			$currentKey = $keys[$i];
			if (is_array($base) && array_key_exists($currentKey, $base)) {
				$base = &$base[$currentKey];
			}
			else {
				// Short-circuit and return null.
				return null;
			}
		}
		
		$currentKey = $keys[$size];
		if (array_key_exists($currentKey, $base)) {
			$value = &$base[$currentKey];
			if (is_array($value) && $configObjectIfArray) {
				$configClassName = get_class($this);
				return new $configClassName($value);
			}
			elseif ($value instanceOf Config && !$configObjectIfArray) {
				return $value->toArray();
			}
			else {
				return $value;
			}
		}
		else {
			// We want to avoid a traditional PHP error when referencing
			// non-existent keys, so we'll silently return null as an
			// alternative ;)
			return null;
		}
	}

	/*public function get() {



	}*/
	

	public function set($key, $value, $options = array())
	{
		$opts = array_merge($this->defaultSetOptions, $options);
		$keys = explode('.', $key);
		$base = &$this->configArr;
		$size = count($keys) - 1;
		
		for ($i = 0; $i < $size; ++$i) {
			$currentKey = $keys[$i];
			if (is_array($base) && array_key_exists($currentKey, $base)) {
				$base = &$base[$currentKey];
			}
			elseif ($opts['force']) {
				$base[$currentKey] = array();
				$base = &$base[$currentKey];
			}
			else {
				// Short-circuit and return false.
				return false;
			}
		}
		
		$currentKey = $keys[$size];
		if (array_key_exists($currentKey, $base) && !$opts['overwrite']) {
			return false;
		}
		
		$base[$currentKey] = $value;
		return $value;
	}
	

	public function raise($message)
	{
		$exceptionClass = $this->exceptionClass;
		throw new $exceptionClass($message);
	}
	
	public function __call($method, $args = array())
	{
		if (preg_match('/^get(\S+)$/', $method, $m)) {
			return $this->get($m[1]);
		}
		elseif (preg_match('/^set(\S+)$/', $method, $m)) {
			$options = array();
			$argc    = count($args);
			if ($argc > 1) {
				$options = $args[1];
			}
			elseif ($argc < 1) {
				$class = get_class($this);
				$this->raise("Missing value argument in $class::$method()");
			}
			return $this->set($m[1], $args[0], $options);
		}
	}
	
	public function merge(Config $config, $recursive = true)
	{
		$mergeMethod     = $recursive ? 'array_merge_recursive' : 'array_merge';
		$this->configArr = $mergeMethod($this->configArr, $config->toArray());
	}
}
?>