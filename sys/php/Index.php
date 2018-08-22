<?php

defined('MAD') or die('ERROR');

class Index extends Core {

	function main() {
		$res['title']['ru'] = 'Мультфильмы';
		$res['title']['en'] = 'Cartoons';
		$p = 1; $i = 0;

		do {
			$l = get_curl('movie/now_playing?page='.$p.'&',$this->l['l'],$this->env['api_key']);
			for ($j=0; $j < count($l['results']); $j++) { 
				foreach ($l['results'][$j]['genre_ids'] as $x) {
					if ($x == 16) {
						$movie[$i] = $l['results'][$j];
						$i++;
					}
				}
			}
			$p++;
		} while ($i < 7);


		$res['movie'] = $movie;

		$key = '5d54c6cdf5d1d5da8e9ee559a3bb96b4bd6444bd91e28caa653cf56ceec4d4027741c8f4ee54289cd1ab0';
		$query = 'https://api.vk.com/method/wall.get?v=5.80&owner_id=-58512634&count=10&access_token='.$key;
		$response = file_get_contents($query);
		if (!$response) {
			$res['err'] = 'Reload page please / Перезагрузите страницу пожалуйста';
		} else {
			$res['vk'] = json_decode($response,1)['response']['items'];
		}

		return $res;
	}
}

?>