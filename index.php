<?php
define('BASE_PATH', realpath(dirname(__FILE__)) . '/');

(new Phalcon\Loader()) -> registerDirs(array(BASE_PATH . 'app/controllers/', BASE_PATH . 'app/models/')) -> register();

$di = new Phalcon\DI\FactoryDefault();

$di -> set('view', function() {
	$view = new Phalcon\Mvc\View();
	$view -> setViewsDir(BASE_PATH . 'app/views');
	return $view;
});

$di -> set('db', function() {
	return new Phalcon\Db\Adapter\Pdo\Mysql(array(
		'host'     => 'rdsyaa2eyyaa2ey.mysql.rds.aliyuncs.com',
		'username' => 'tuanzu',
		'password' => 'tuanzu_52',
		'dbname'   => 'tuanzu',
		'port'     => 3306,
		'options'  => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
		))
	);
});

$di -> set('router', function() {
	$router = new Phalcon\Mvc\Router(false);
	$router -> setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
	$router -> removeExtraSlashes(true);
	
	$router -> notFound(array('controller' => 'index', 'action' => 'notFound'));
	
	$router -> addGet('/', array('controller' => 'index', 'action' => 'index')) -> setName('index');
	$router -> addGet('/faq', array('controller' => 'index', 'action' => 'faq')) -> setName('faq');
	$router -> addGet('/about', array('controller' => 'index', 'action' => 'about')) -> setName('about');
	$router -> addGet('/fd', array('controller' => 'index', 'action' => 'fd')) -> setName('fd');
	$router -> addGet('/join', array('controller' => 'index', 'action' => 'join')) -> setName('join');
	$router -> addGet('/list(\??)(.*)', array('controller' => 'list', 'action' => 'index')) -> setName('list');

	return $router;
});

try {
	if (PHP_OS == 'Linux') {
		$uri = $_SERVER['REQUEST_URI'];
	} else {
		$uri = null;
	}

	(new Phalcon\Mvc\Application($di)) -> handle($uri) -> send();
} catch (\Exception $e) {
	echo 'Exception:', $e->getMessage();
}
?>