<?php

defined('MAD') or die('ERROR');

class Info extends Core {

	public function main() {
		$raw = raw('SELECT * FROM `info` WHERE `url`="'.$this->url[3].'"',1);
		if (!$raw) {
			$this->err = '404';
		}
		$res['info'] = $raw;
		$res['title']['ru'] = $raw['title_ru'];
		$res['title']['en'] = $raw['title_en'];
		return $res;
	}

	public function go() {
		if (isset($_GET['url'])) {
			header('Location: '.$_GET['url']);
		} else {
			header('Location: /'.$this->l['l'].'/');
		}
	}
}


?>