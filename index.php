<?php
	//require_once 'skimpy.php';
	
	$skimpy = new SkimpyPHP();
	
	$skimpy
		->method('hello', function($name = null){
			return $name != null ? 'Hello '. $name : 'Hello world';
		})
		->get('/', function(){
			echo 'SkimpyPhp - The slim and sexy micro-framework.';
		})
		->get('/params/(\S+)', function($var1 = null, $var2 = null){
			echo 'Section with params<br>'
				.'Var1 is '.$var1
				.'<br>Var2 is '.$var2;
		})
		->get('/params', function(){
			echo 'Section without params';
		})
		->get('/hello/(\w*)', function($name = null) use ($skimpy){
			echo $skimpy->call('hello', array($name));
		})
		->reveal();
