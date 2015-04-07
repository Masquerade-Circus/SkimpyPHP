<?php
	class SkimpyPHP{
		
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
		}
		
		public function post($path, $callback){
			$this->paths->post[$path] = $callback;
		}
		
		public function put($path, $callback){
			$this->paths->post[$path] = $callback;
		}
		
		public function delete($path, $callback){
			$this->paths->post[$path] = $callback;
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