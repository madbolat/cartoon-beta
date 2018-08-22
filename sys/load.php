<?php

defined('MAD') or die('ERROR');

class Load {
	
	public function run() {
		$url = explode('/', strtolower(trim($_SERVER['REQUEST_URI'], '')));
		unset($url[0]);
		// INCLUDE db, env and core class
		$env = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/sys/sys.env');
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/core.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/func.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/db.php');

		// SET language
		$lang = ($url[1] == 'en') ? 'en' : 'ru';
		$l = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/src/lang/'.$lang.'.ini',1);
		
		// GET class and method from url
		$class = (!empty($url[2])) ? ucfirst(strtolower($url[2])) : 'Index';
		$method = (!empty($url[3])) ? strtolower($url[3]) : 'main';

		// REQUIRE class and method files
		$c_file = (file_exists($_SERVER['DOCUMENT_ROOT'].'/sys/php/'.$class.'.php')) ? $class : 'Index';
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/php/'.$c_file.'.php');

		$class = (class_exists($class)) ? $class : 'Index';
		// CREATE class and SET vars
		$start = new $class; ##CLASS START

		$start->l = $l;
		$start->url = $url;
		$start->env = $env;

		// RUN method
		$res = method_exists($start, $method) ? $start->$method() : $start->main(); ##METHODD
		// GEN. path to view's file
		$view_file = strtolower($class).'.';
		$view_file .= (file_exists($_SERVER['DOCUMENT_ROOT'].'/sys/view/'.$view_file.$method.'.php')) ? $method : 'main';

		// REWRITE if error
		if (!empty($start->err)) {
			$res = Core::error($start->err);
			$view_file = 'index.error';
		}

		// GENERATE curent url
		$res['a'] = $_SERVER['REQUEST_URI'];
		$res['set_lang'] = '/'.$l['l_op'];
		for ($i=2; $i <= count($url); $i++) $res['set_lang'] .= '/'.$url[$i];
		// GEN. VIEW
		$this->html($res, $view_file, $l, $env, $url);
	}

	public function html($r, $file, $l, $env, $url) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/view/etc/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/view/'.$file.'.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/sys/view/etc/foot.php');
	}
}

?>