<?php
	require_once 'skimpy.php';
	
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