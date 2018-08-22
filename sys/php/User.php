<?php

defined('MAD') or die('ERROR');

class User extends Core {
	
	public function main() {
		// foreach (get_class_methods('User') as $i => $mthd) {$methods[] = $mthd;}
		if (!empty($this->url[3])) {
			$user = raw('SELECT * FROM `users` WHERE `nick`="'.$this->url[3].'"',1);
			if (!$user) {
				$res['err'] = $this->l['err']['user_doesnt_exist'];
				$res['title']['ru'] = 'Пользователь не существует';
				$res['title']['en'] = 'User doesn\'t exist';
			} else {
				$res['title']['ru'] = $user['nick'] . ' / Профиль';
				$res['title']['en'] = $user['nick'] . ' / Profile';
				$res['user'] = $user;
				$res['user']['friend_flag'] = false;

				$history = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' ORDER BY `date` DESC');
				if ($history) {
					for ($i=0; $i < count($history); $i++) { 
						$media_type = ($history[$i]['media_type'] == 1) ? 'movie' : 'tv';
						$history[$i]['info'] = get_curl($media_type.'/'.$history[$i]['title_id'].'?',$this->l['l'],$this->env['api_key']);
					}
					$res['user']['history'] = $history;
				}

				$res['planned'] = count(raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="planned" ORDER BY `date` DESC'));
				$res['watching'] = count(raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="watching" ORDER BY `date` DESC'));
				$res['completed'] = count(raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="completed" ORDER BY `date` DESC'));
				$res['on_hold'] = count(raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="on_hold" ORDER BY `date` DESC'));
				$res['dropped'] = count(raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="dropped" ORDER BY `date` DESC'));

				if (($res['planned']+$res['watching']+$res['completed']+$res['on_hold']+$res['dropped']) != 0) {
					$res['w1'] = (100/($res['planned']+$res['watching']+$res['completed']+$res['on_hold']+$res['dropped']))*$res['completed'];
					$res['w2'] = (100/($res['planned']+$res['watching']+$res['completed']+$res['on_hold']+$res['dropped']))*($res['planned']+$res['watching']+$res['on_hold']+$res['dropped']);
				} else {
					$res['w1'] = $res['w2'] = 50;
				}

				if (isset($_SESSION['uid'])) {
					$mysubs = raw('SELECT * FROM `relationship` WHERE `u_from`='.$_SESSION['uid']);
					foreach ($mysubs as $x) {
						if ($x['u_to'] == $user['uid']) {
							$res['user']['friend_flag'] = true;
						}
					}
				}
				$subs = raw('SELECT * FROM `relationship` WHERE `u_from`='.$user['uid']);
				if ($subs) {
					$res['user']['subs'] = $subs;
					$count_subs = (count($subs) > 3) ? 3 : count($subs);
					for ($i=0; $i < $count_subs; $i++) { 
						$res['user']['subs'][$i]['info'] = raw('SELECT * FROM `users` WHERE `uid`='.$subs[$i]['u_to'],1);
					}
				}
				if (isset($_GET['follow'])) {
					if (isset($_SESSION['uid']) and ($_SESSION['uid'] != $user['uid'])) {
						if (!$res['user']['friend_flag']) {
							$sql = raw('INSERT INTO `relationship`(`u_from`, `u_to`) VALUES ("'.$_SESSION['uid'].'","'.$user['uid'].'")',2);
							if ($sql) {
								header('Location:  /'.$this->l['l'].'/user/'.$user['nick'].'/');
							}
						} else {
							$res['err'] = $this->l['err']['already_sub'];
						}
					} else {
						$res['err'] = $this->l['err']['go_auth'];
					}
				} elseif (isset($_GET['unfollow'])) {
					if (isset($_SESSION['uid']) and ($_SESSION['uid'] != $user['uid'])) {
						if ($res['user']['friend_flag']) {
							$sql = raw('DELETE FROM `relationship` WHERE `u_from`="'.$_SESSION['uid'].'" AND `u_to`="'.$user['uid'].'"',2);
							if ($sql) {
								header('Location:  /'.$this->l['l'].'/user/'.$user['nick'].'/');
							}
						} else {
							$res['err'] = $this->l['err']['dont_sub'];
						}
					} else {
						$res['err'] = $this->l['err']['go_auth'];
					}
				}
			}
		} else {
			if (isset($_SESSION['uid'])) {
				header('Location: /'.$this->l['l'].'/');
			} else {
				if (isset($_POST['sign_in'])) {
					$res['title']['ru'] = $this->l['auth'];
					$res['title']['en'] = $this->l['auth'];
					$nick = (!empty($_POST['nick_auth'])) ? trim(htmlspecialchars($_POST['nick_auth'])) : null;
					$pass = (!empty($_POST['pass_auth'])) ? md5(trim(htmlspecialchars($_POST['pass_auth']))) : null;
					if (($nick != null) and ($pass != null)) {
						$user = raw('SELECT * FROM `users` WHERE `nick`="'.$nick.'" AND `pass`="'.$pass.'"',1);
						if (!$user) {
							$res['err'] = $this->l['err']['user_doesnt_exist'];
						} else {
							$_SESSION = ($user) ? $user : null;
							header('Location: /'.$this->l['l'].'/user/'.$user['nick']);
						}
					} else {
						$res['err'] = $this->l['err']['nick_pass_empty'];
					}
				} elseif (isset($_POST['sign_up'])) {
					////////// DEFINE settings, all, main, im, sign_out etc
					$res['title']['ru'] = $this->l['sign_up'];
					$res['title']['en'] = $this->l['sign_up'];
					////////// СЮДА НАПИСАТЬ БОЛЕЕ СЛОЖНУЮ ПРОВЕРКУ
					$nick = (!empty($_POST['nick'])) ? trim(htmlspecialchars($_POST['nick'])) : null;
					$pass_1 = (!empty($_POST['pass_1'])) ? md5(trim(htmlspecialchars($_POST['pass_1']))) : null;
					$pass_2 = (!empty($_POST['pass_2'])) ? md5(trim(htmlspecialchars($_POST['pass_2']))) : null;
					if (($nick != null) and ($pass_1 != null) and ($pass_2 != null)) {
						$user = raw('SELECT * FROM `users` WHERE `nick`="'.$nick.'"',1);
						if ($user) {
							$res['err'] = $this->l['err']['user_exists'];
						} else {
							if ($pass_1 != $pass_2) {
								$res['err'] = $this->l['err']['pass_not_match'];
							} else {
								$reg = raw('INSERT INTO `users`(`nick`, `pass`, `reg_time`) VALUES ("'.$nick.'","'.$pass_1.'","'.date('Y-m-d').'")',2);
								if ($reg) {
									$user = raw('SELECT * FROM `users` WHERE `nick`="'.$nick.'"',1);
									$_SESSION = ($user) ? $user : null;
									header('Location: /'.$this->l['l'].'/user/'.$user['nick']);
								} else {
									$res['err'] = $this->l['err']['db_err'];
								}
							}
						}
					} else {
						/////// UPDATE LANG FILES
						$res['err'] = $this->l['err']['nick_pass_err'];
					}
				} else {
					header('Location: /'.$this->l['l'].'/');
				}
			}
		}
		return $res;
	}

	public function settings() {
		// RESET SESSION
		$res['title']['ru'] = $this->l['settings'];
		$res['title']['en'] = $this->l['settings'];
		if (isset($_SESSION['uid'])) {
			$res['user'] = raw('SELECT * FROM `users` WHERE `uid`='.$_SESSION['uid'],1);
			$bgs = scandir($_SERVER['DOCUMENT_ROOT'].'/src/img/bg/');
			array_shift($bgs);
			array_shift($bgs);
			$res['bgs'] = $bgs;

			$nick = (!empty($_POST['nick'])) ? htmlspecialchars(trim($_POST['nick'])) : null;
			$email = (!empty($_POST['email'])) ? htmlspecialchars(trim($_POST['email'])) : null;

			$full_name = (!empty($_POST['full_name'])) ? htmlspecialchars(trim($_POST['full_name'])) : null;
			$web_page = (!empty($_POST['web_page'])) ? htmlspecialchars(trim($_POST['web_page'])) : null;

			$n_pass = (!empty($_POST['n_pass'])) ? md5(htmlspecialchars(trim($_POST['n_pass']))) : null;
			$r_pass = (!empty($_POST['r_pass'])) ? md5(htmlspecialchars(trim($_POST['r_pass']))) : null;

			$sex = (!empty($_POST['sex'])) ? htmlspecialchars(trim($_POST['sex'])) : 'genderless';
			$bg = (!empty($_POST['bg'])) ? htmlspecialchars(trim($_POST['bg'])) : 'bg1.png';


			$path = $_SERVER['DOCUMENT_ROOT'].'/src/data/ava/'; // директория для загрузки
			$new_name = $_SESSION['uid'].'.png'; // новое имя с расширением
			$full_path = $path.$new_name; // полный путь с новым именем и расширением

			if(($_FILES['ava']['error'] == 0) and ($_FILES['ava']['size'] != 0)){
				$photo = (move_uploaded_file($_FILES['ava']['tmp_name'], $full_path)) ? $new_name : 'empty.png';
			} else {
				$photo = $_SESSION['photo'];
			}


			if ($n_pass == $r_pass) {
				$pass = ($n_pass != null) ? ',`pass`="'.$n_pass.'"' : null;
				if (($nick != null) and ($email != null)) {
					$sql = raw('UPDATE `users` SET `nick`="'.$nick.'"'.$pass.',`email`="'.$email.'",`web_page`="'.$web_page.'",`full_name`="'.$full_name.'",`sex`="'.$sex.'",`bg`="'.$bg.'", `photo`="'.$photo.'" WHERE `uid`='.$_SESSION['uid'],2);
					if ($sql) {
						$_SESSION['nick'] = $nick;
						$_SESSION['pass'] = $n_pass;
						$_SESSION['email'] = $email;
						$_SESSION['web_page'] = $web_page;
						$_SESSION['photo'] = $photo;
						$_SESSION['full_name'] = $full_name;
						$_SESSION['sex'] = $sex;
						$_SESSION['bg'] = $bg;
						header('Location: /'.$this->l['l'].'/user/settings/');
					}
				} else {
					$res['err'] = $this->l['err']['data_empty'];
				}
			} else {
				$res['err'] = $this->l['err']['pass_not_match'];
			}
		} else {
			header('Location: /'.$this->l['l'].'/');
		}
		return $res;
	}

	public function all() {
		$res['title']['ru'] = $this->l['users'];
		$res['title']['en'] = $this->l['users'];
		$res['users'] = raw('SELECT * FROM `users`');
		return $res;
	}

	public function im() {
		$res['title']['ru'] = 'Сообщения';
		$res['title']['en'] = 'Messages';
		if (!isset($_SESSION['uid'])) {
			header('Location: /'.$this->l['l'].'/');
		}
		return $res;
	}

	public function history() {
		$res['title']['ru'] = $this->l['history'];
		$res['title']['en'] = $this->l['history'];
		if (is_numeric($this->url[4])) {
			$user = raw('SELECT * FROM `users` WHERE `uid`='.$this->url[4],1);
			if ($user) {
				$res['user'] = $user;
			} else {
				header('Location: /'.$this->l['l'].'/');
			}
		} elseif($this->url[4] == 'feed') {
			#code
		} else {
			header('Location: /'.$this->l['l'].'/');
		}

		if (isset($user['uid'])) {
			$history = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' ORDER BY `date` DESC');
			if ($history) {
				for ($i=0; $i < count($history); $i++) { 
					$media_type = ($history[$i]['media_type'] == 1) ? 'movie' : 'tv';
					$history[$i]['info'] = get_curl($media_type.'/'.$history[$i]['title_id'].'?',$this->l['l'],$this->env['api_key']);
				}
				$res['history'] = $history;
			} else {
				header('Location: /'.$this->l['l'].'/user/'.$user['nick'].'/');
			}
		}
		return $res;
	}

	public function ulist() {
		$res['title']['ru'] = $this->l['list'];
		$res['title']['en'] = $this->l['list'];
		if (is_numeric($this->url[4])) {
			$user = raw('SELECT * FROM `users` WHERE `uid`='.$this->url[4],1);
			if ($user) {
				$res['user'] = $user;
			} else {
				header('Location: /'.$this->l['l'].'/');
			}
		} else {
			header('Location: /'.$this->l['l'].'/');
		}
		
		if ($this->url[5] == 'planned') {
			$res['view'] = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="planned" ORDER BY `date` DESC');
		} elseif ($this->url[5] == 'watching') {
			$res['view'] = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="watching" ORDER BY `date` DESC');
		} elseif ($this->url[5] == 'completed') {
			$res['view'] = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="completed" ORDER BY `date` DESC');
		} elseif ($this->url[5] == 'on_hold') {
			$res['view'] = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="on_hold" ORDER BY `date` DESC');
		} elseif ($this->url[5] == 'dropped') {
			$res['view'] = raw('SELECT * FROM `user_list` WHERE `user_id`='.$user['uid'].' AND `state`="dropped" ORDER BY `date` DESC');
		} else {
			header('Location: /'.$this->l['l'].'/user/ulist/'.$this->url[4].'/planned/');
		}
		if ($res['view']) {
			for ($i=0; $i < count($res['view']); $i++) { 
				# code...
				$media_type = ($res['view'][$i]['media_type'] == 1) ? 'movie' : 'tv';
				$res['view'][$i]['info'] = get_curl($media_type.'/'.$res['view'][$i]['title_id'].'?',$this->l['l'],$this->env['api_key']);
			}
		}
		return $res;
	}

	public function sign_out() {
		session_destroy();
		header('Location: /'.$this->l['l'].'/');
		return 0;
	}

}