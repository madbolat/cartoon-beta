<?php

defined('MAD') or die('ERROR');

class View extends Core {

	public function main() {
		if (($this->url[3] == 'movie') or (empty($this->url[3])) or (!isset($this->url[3]))) {
			$type = 'movie';
		} elseif ($this->url[3] == 'tv') {
			$type = 'tv';
		} else {
			$id = explode('-', strtolower(trim($this->url[3], '')));
			$media_type = ($id[0][0] == '1') ? 'movie' : 'tv';
			$res['detail'] = get_curl($media_type.'/'.substr($id[0], 1).'?',$this->l['l'],$this->env['api_key']);
			$res['detail']['overview'] = (!empty($res['detail']['overview'])) ? $res['detail']['overview'] : $this->l['err']['empty_overview'];
			$res['detail']['credits'] = get_curl($media_type.'/'.substr($id[0], 1).'/credits?',$this->l['l'],$this->env['api_key']);
			$res['detail']['ids'] = get_curl($media_type.'/'.substr($id[0], 1).'/external_ids?',$this->l['l'],$this->env['api_key']);

			$similar = get_curl($media_type.'/'.substr($id[0], 1).'/similar?page=1&',$this->l['l'],$this->env['api_key']);
			if (!empty($similar['results'])) {
				$k=0; $z = 0;
				for ($i=1; $i < ($similar['total_pages']+1); $i++) {
					$raw = get_curl($media_type.'/'.substr($id[0], 1).'/similar?page='.$i.'&',$this->l['l'],$this->env['api_key']);
					foreach ($raw['results'] as $j) {
						$s[$k] = $j;
						$k++;
					}
				}
				foreach ($s as $x) {
					foreach ($x['genre_ids'] as $genre) {
						if ($genre == 16) {
							$sim[$z] = $x;
							$z++;
						}
						if ($z==7) break;
					}
					if ($z==7) break;
				}
				$res['detail']['similar'] = $sim;
			}
			$res['in_list'] = (isset($_SESSION['uid'])) ? raw('SELECT * FROM `user_list` WHERE `user_id`='.$_SESSION['uid'].' AND `title_id`='.$res['detail']['id'].' AND `media_type`='.$id[0][0],1) : null;
			$res['media_type'] = $media_type;

			$ins = 'INSERT INTO `user_list`(`title_id`, `media_type`, `user_id`, `date`, `state`) VALUES ('.$res['detail']['id'].', '.$id[0][0].', '.$_SESSION['uid'].', "'.date('Y-m-d H:i:s').'", ';
			$upd1 = 'UPDATE `user_list` SET `state`="';
			$upd2 = '",`date`="'.date('Y-m-d H:i:s').'" WHERE `user_id`='.$_SESSION['uid'].' AND `title_id`='.$res['detail']['id'].' AND `media_type`='.$id[0][0];

			if (isset($_GET['planned'])) {
				$sql = (!$res['in_list']) ? raw($ins.'"planned")',2) : raw($upd1.'planned'.$upd2,2);
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			} elseif (isset($_GET['completed'])) {
				$sql = (!$res['in_list']) ? raw($ins.'"completed")',2) : raw($upd1.'completed'.$upd2,2);
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			} elseif (isset($_GET['watching'])) {
				$sql = (!$res['in_list']) ? raw($ins.'"watching")',2) : raw($upd1.'watching'.$upd2,2);
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			} elseif (isset($_GET['on_hold'])) {
				$sql = (!$res['in_list']) ? raw($ins.'"on_hold")',2) : raw($upd1.'on_hold'.$upd2,2);
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			} elseif (isset($_GET['dropped'])) {
				$sql = (!$res['in_list']) ? raw($ins.'"dropped")',2) : raw($upd1.'dropped'.$upd2,2);
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			} elseif (isset($_GET['remove'])) {
				$sql = ($res['in_list']) ? raw($upd1.'remove'.$upd2,2) : null;
				header('Location: /'.$this->l['l'].'/view/'.$this->url[3].'/');
			}

			$res['title']['ru'] = $res['detail']['title'] . $res['detail']['name'] . ' / ' . $this->l[$media_type];
			$res['title']['en'] = $res['detail']['title'] . $res['detail']['name'] . ' / ' . $this->l[$media_type];
		}
		if (isset($type)) {
			$res['title']['ru'] = $this->l[$type];
			$res['title']['en'] = $this->l[$type];
			$res['genres'] = get_curl('genre/'.$type.'/list?',$this->l['l'],$this->env['api_key']);
			if (!empty($_POST['genre'])) {
				foreach ($_POST['genre'] as $x) $genre .= ','.$x;
				header('Location: /'.$this->l['l'].'/view/'.$type.'/?'.get_query('genre').'&genre='.substr($genre, 1));
			} elseif(is_numeric($_POST['p'])) {
				header('Location: /'.$this->l['l'].'/view/'.$type.'/?'.get_query('p').'&p='.$_POST['p']);
			}
			$query .= (!empty($_GET['genre'])) ? '&with_genres=16,'.$_GET['genre'] : 'with_genres=16';
			$query .= (!empty($_GET['desc'])) ? '&sort_by='.$_GET['desc'] . '.desc': '&sort_by=popularity.desc';
			// $query .= (!empty($_GET['asc'])) ? '&sort_by='.$_GET['asc'] . '.asc': '&sort_by=popularity.desc';
			$query .= (is_numeric($_GET['p'])) ? '&page='.$_GET['p'] : null;
			$query .= (!empty($_GET['studio'])) ? '&with_companies='.$_GET['studio'] : null;
			$res['view'] = get_curl('discover/'.$type.'?'.$query.'&',$this->l['l'],$this->env['api_key']);
			$res['media_type'] = $type;
			$res['err'] = (empty($res['view']['results'])) ? $this->l['err']['not_found'] : null;
		}
		return $res;
	}

	public function search() {
		$res['title']['ru'] = $this->l['search'];
		$res['title']['en'] = $this->l['search'];
		if ((isset($_GET['q'])) and (!empty($_GET['q']))) {
			$total_pages = get_curl('search/multi?page=1&query='.urlencode($_GET['q']).'&',$this->l['l'],$this->env['api_key'])['total_pages'];
			$k=0; $z=0;
			for ($i=1; $i < ($total_pages+1); $i++) {
				$raw = get_curl('search/multi?page='.$i.'&query='.urlencode($_GET['q']).'&',$this->l['l'],$this->env['api_key']);
				foreach ($raw['results'] as $j) {
					$s[$k] = $j;
					$k++;
				}
			}
			foreach ($s as $x) {
				if (($x['media_type'] == 'movie') or ($x['media_type'] == 'tv')) {
					foreach ($x['genre_ids'] as $genre) {
						if ($genre == 16) {
							$search[$z] = $x;
							$z++;
						}
					}
				}
			}
			$res['search'] = $search;
		} else {
			$res['err'] = $this->l['err']['empty_search'];
		}
		return $res;
	}

	public function credit() {
		$id = explode('-', strtolower(trim($this->url[4], '')));
		$media_type = ($id[0][0] == '1') ? 'movie' : 'tv';
		$res['credits'] = get_curl($media_type.'/'.substr($id[0], 1).'/credits?',$this->l['l'],$this->env['api_key']);
		$res['info'] = get_curl($media_type.'/'.substr($id[0], 1).'?',$this->l['l'],$this->env['api_key']);
		$res['media_type'] = $id[0][0];
		$res['title']['ru'] = $this->l['cast'] . ' / ' . $this->l['created_by'];
		$res['title']['en'] = $this->l['cast'] . ' / ' . $this->l['created_by'];
		return $res;
	}

	public function collection() {
		$id = $this->url[4];
		$res['collection'] = get_curl('collection/'.$id.'?',$this->l['l'],$this->env['api_key']);
		$res['title']['ru'] = $this->l['collection'] . ' / ' . $res['collection']['name'] . $res['collection']['title'];
		$res['title']['en'] = $this->l['collection'] . ' / ' . $res['collection']['name'] . $res['collection']['title'];
		return $res;
	}
}

?>