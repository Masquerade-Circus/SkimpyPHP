SkimpyPHP
===
The slim and sexy micro-framework

###Simple use
```php
require_once 'skimpy.php';

$app = new SkimpyPHP();

$app->method($path, function(){
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

$app->get('/', function(){
	echo 'SkimpyPhp - The slim and sexy micro-framework.';
});

$app->get('/params/(\S+)', function($var1 = null, $var2 = null){
	echo 'Section with params<br>'
		.'Var1 is '.$var1
		.'<br>Var2 is '.$var2;
});

$app->get('/params', function(){
	echo 'Section without params';
});

$app->reveal();
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
