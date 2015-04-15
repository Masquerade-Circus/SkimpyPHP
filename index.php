<?php
	//require_once 'skimpy.php';
	class SkimpyPHP{function __construct(){$this->a=new stdClass();$this->a->get=array();$this->a->post=array();$this->a->put=array();$this->a->delete=array();$this->b=str_replace(array('/index.php',' '),array('','%20'),$_SERVER['SCRIPT_NAME']);}public function get($c,$d){$this->a->get[$c]=$d;}public function post($c,$d){$this->a->post[$c]=$d;}public function put($c,$d){$this->a->post[$c]=$d;}public function delete($c,$d){$this->a->post[$c]=$d;}public function reveal(){$e=strtolower($_SERVER['REQUEST_METHOD']);$f=$this->a->$e;$c=str_replace($this->b,'',$_SERVER['REQUEST_URI']);$g=false;krsort($f);foreach($f as $h=>$i){$h='^'.str_replace('/','\/',$h).'\/?$';if(preg_match("/$h/i",$c,$j)){$g=true;array_shift($j);$j=explode("/",preg_replace("/\/$/","",implode('/',$j)));call_user_func_array($i,$j);break;}}if(!$g)throw new Exception("The url \"$c\" requested by ".strtoupper($e).",not found.");}}
	
	$skimpy = new SkimpyPHP();
	
	$skimpy->get('/', function(){
		echo 'SkimpyPhp - The slim and sexy micro-framework.';
	});
	
	$skimpy->get('/params/(\S+)', function($var1 = null, $var2 = null){
		echo 'Section with params<br>'
			.'Var1 is '.$var1
			.'<br>Var2 is '.$var2;
	});
	
	$skimpy->get('/params', function(){
		echo 'Section without params';
	});
	
	$skimpy->reveal();