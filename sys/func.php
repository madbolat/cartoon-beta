<?php

function translit($text, $type) {
	if ($type == 'en') {
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '',  'ы' => 'y',   'ъ' => '',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		$res = strtr($text, $converter);
	} else {
		$res = $text;
	}
	return $res;
}

function urify($str) {
	$str = strtolower($str);
	$str = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/","",$str);
	$str = str_replace(' ', '-', $str);
	return $str;
}

function url_parse($url) {
	$res = parse_url($url);
	if (!$res['scheme']) {
		$res = parse_url('http://'.$url);
	}
	$res['url'] = $res['scheme'] . '://' . $res['host'] . $res['path'];
	$res['url'] .= ($res['query']) ? '?' . $res['query'] : '';
	$res['url'] .= ($res['fragment']) ? '#' . $res['fragment'] : '';
	$res['favicon'] = 'https://www.google.com/s2/favicons?domain='.$res['scheme'].'://'.$res['host'];
	return $res;
}

function get_status($status) {
	switch ($status) {
		case 'Ended': 			$res['l'] = 'ended'; $res['css'] = 'bg-success'; break;
		case 'Rumored': 		$res['l'] = 'rumored'; $res['css'] = 'bg-light'; break;
		case 'Planned': 		$res['l'] = 'planned'; $res['css'] = 'bg-warning'; break;
		case 'In Production': 	$res['l'] = 'in_prod'; $res['css'] = 'bg-info'; break;
		case 'Post Production': $res['l'] = 'postprod'; $res['css'] = 'bg-primary'; break;
		case 'Released': 		$res['l'] = 'released'; $res['css'] = 'bg-success'; break;
		case 'Canceled': 		$res['l'] = 'canceled'; $res['css'] = 'bg-danger'; break;
		case 'Returning Series':$res['l'] = 'ret_series'; $res['css'] = 'bg-primary'; break;
		default: break;
	}
	return $res;
}

function get_curl($query,$l,$key) {
	$query = 'https://api.themoviedb.org/3/'.$query.'language='.$l.'&api_key='.$key;
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $query,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "{}",
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$res['err'] = "cURL Error #:" . $err;
	} else {
		$res = json_decode($response,true);
	}
	return $res;
}

function get_query($del) {
	$x = $_GET;
	if (array_key_exists($del, $x)) {
		unset($x[$del]);
	}
	return http_build_query($x);
}

function mb_str($str) {
	mb_internal_encoding("UTF-8");
	return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
}

?>