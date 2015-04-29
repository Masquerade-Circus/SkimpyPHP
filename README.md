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
// Inline and minified SkimpyPHP
	class SkimpyPHP{function __construct(){$this->a=new stdClass();$this->a->get=array();$this->a->post=array();$this->a->put=array();$this->a->delete=array();$this->b=str_replace(array('/index.php',' '),array('','%20'),$_SERVER['SCRIPT_NAME']);}public function get($c,$d){$this->a->get[$c]=$d;}public function post($c,$d){$this->a->post[$c]=$d;}public function put($c,$d){$this->a->put[$c]=$d;}public function delete($c,$d){$this->a->delete[$c]=$d;}public function reveal(){$e=strtolower($_SERVER['REQUEST_METHOD']);$f=$this->a->$e;$c=str_replace($this->b,'',$_SERVER['REQUEST_URI']);$g=false;krsort($f);foreach($f as $h=>$i){$h='^'.str_replace('/','\/',$h).'\/?$';if(preg_match("/$h/i",$c,$j)){$g=true;array_shift($j);$j=explode("/",preg_replace("/\/$/","",implode('/',$j)));call_user_func_array($i,$j);break;}}if(!$g)throw new Exception("The url \"$c\" requested by ".strtoupper($e).",not found.");}}

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

The url http://localhost/skimpydir/params/hello/world will echo 
```html
Section with params<br>
Var1 is hello
<br>Var2 is world
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
