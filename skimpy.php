<?php
	/**
	 *  Small URL Routing and Controller micro-framework
	 *  By Masquerade Circus
	 *  christian@masquerade-circus.net
	 *  https://github.com/Masquerade-Circus/SkimpyPHP
	 */
	class SkimpyPHP{
		private $_methods;
		
		function __construct(){
			$this->paths = new stdClass();
			$this->paths->get = array();
			$this->paths->post = array();
			$this->paths->put = array();
			$this->paths->delete = array();
			$this->baseUrl = str_replace(array('/index.php', ' '), array('', '%20'), $_SERVER['SCRIPT_NAME']);
		}
		
		public function get($path, $callback){
			$this->paths->get[$path] = $callback;
			return $this;
		}
		
		public function post($path, $callback){
			$this->paths->post[$path] = $callback;
			return $this;
		}
		
		public function put($path, $callback){
			$this->paths->put[$path] = $callback;
			return $this;
		}
		
		public function delete($path, $callback){
			$this->paths->delete[$path] = $callback;
			return $this;
		}
		
		function call($name, $params = array()){
			if (array_key_exists($name,$this->_methods))
				return call_user_func_array($this->_methods[$name], $params);
			else
				throw new Exception("The method '$name' does not exists");
		}
		
		function method($name, $callback){
			$this->_methods[$name] = $callback;
			return $this;
		}
		
		public function reveal() {
			$method = strtolower($_SERVER['REQUEST_METHOD']);
			$urls = $this->paths->$method;
			$path = str_replace($this->baseUrl, '', $_SERVER['REQUEST_URI']);
			$found = false;
			krsort($urls);
			foreach ($urls as $regex => $func) {
				$regex = '^' . str_replace('/', '\/', $regex) . '\/?$';
				if (preg_match("/$regex/i", $path, $matches)) {
					$found = true;
					array_shift($matches);
					$matches = explode("/", preg_replace("/\/$/", "", implode('/', $matches)));
					call_user_func_array($func, $matches);
					break;
				}
			}
			if (!$found)
				throw new Exception("The url \"$path\" requested by ".strtoupper($method).", not found.");
		}
	}
