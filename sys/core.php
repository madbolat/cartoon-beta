<?php

defined('MAD') or die('ERROR');

class Core {

	public $l;
	public $url;
	public $env;
	public $err;
	
	public function error($type = '404') {
		$raw = raw('SELECT * FROM `info` WHERE `url`="error_'.$type.'"',1);
		$res['err'] = $raw;
		$res['title']['ru'] = $raw['title_ru'];
		$res['title']['en'] = $raw['title_en'];
		return $res;
	}
}

?>