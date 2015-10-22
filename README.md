SkimpyPHP
===
The slim and sexy micro-framework

SkimpyPHP is a very simple URL Routing and Controller micro-framework. It is intended to be used inline and let you do the magic. 

It is inspired by GluePHP and follow the same principles:

* Do one job and do it well
* Easily work with others
* Enforce as little conformity as possible

###Simple use
```php
	require_once 'skimpy.php';
	
	$app = new SkimpyPHP();
	
	$app->[post|put|get|delete]($path, function(){
		// An awesome code
	});
	
	//Show the magic
	$app->reveal();
```
The method can be any of get|post|put|delete.  
You can use regex in your url paths.  
When using regex, the matches will be passed as vars to the function, see the example below.  

###Example
```php
	require_once 'skimpy.php';

	$app = new SkimpyPHP();
	
	$app
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
		->reveal();
```

The url http://localhost/skimpydir/params/hello/world will echo 
```html
Section with params<br>
Var1 is hello
<br>Var2 is world
```

You can assign custom helpers like the previous example using $skimpy->method($name, function), and call the function using $skimpy->call($name[, $array_of_arguments]).

###Example
```php
	require_once 'skimpy.php';

	$app = new SkimpyPHP();
	
	$app
		->method('hello', function($name = null){
			return $name != null ? 'Hello '. $name : 'Hello world';
		})
		->get('/hello/(\w*)', function($name = null) use ($app){
			echo $app->call('hello', array($name));
		})
		->reveal();
```


###Apache configuration
SkimpyPHP needs mod_rewrite. Use the .htaccess provided or add the next to your .htaccess file. 
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php
```

###Root folder?
SkimpyPHP works from any sub-directory, not just the root of the site. This makes it great for creating RESTful apis on sites already developed.

So, if you site looks like http://example.com, you can put the contents of SkimpyPHP on the rute http://example.com/api and just start making your simple, sexy and awesome Api. 
