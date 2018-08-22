<!DOCTYPE html>
<html lang="<?=$l['l']?>">
<head>
	<title><?=$r['title'][$l['l']]?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--  -->
	<link rel="stylesheet" href="/src/css/bootstrap.min.css">
	<link rel="stylesheet" href="/src/css/all.css">
	<link rel="stylesheet" href="/src/css/mdi.min.css">
	<link rel="stylesheet" href="/src/css/bpp.min.css">
	<link rel="stylesheet" href="/src/css/main.css">
	<!--  -->
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Roboto+Slab" rel="stylesheet"> 
	<!--  -->
	<script src="/src/js/jquery-3.3.1.min.js"></script>
	<script src="/src/js/popper.min.js"></script>
	<script src="/src/js/bootstrap.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?hl=<?=$l['l']?>"></script>
</head>
<body>

<? if (!isset($_SESSION['uid'])): ?>
<!-- Auth -->
<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?=$l['auth']?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<nav>
					<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-sign-tab" data-toggle="tab" href="#nav-sign" role="tab" aria-controls="nav-sign" aria-selected="true"><?=$l['sign_in']?></a>
						<a class="nav-item nav-link" id="nav-auth-tab" data-toggle="tab" href="#nav-auth" role="tab" aria-controls="nav-auth" aria-selected="false"><?=$l['sign_up']?></a>
					</div>
				</nav>
				<form action="/<?=$l['l']?>/user/" method="post">
					<div class="tab-content" id="nav-tabContent">
						<!-- АВТОРИЗАЦИЯ -->
						<div class="tab-pane fade show active" id="nav-sign" role="tabpanel" aria-labelledby="nav-sign-tab">
							<div class="input-group mb-3">
								<div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-user"></i></span></div>
								<input name="nick_auth" class="form-control" placeholder="<?=$l['username']?>">
							</div>

							<div class="input-group mb-3">
								<div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-lock"></i></span></div>
								<input name="pass_auth" type="password" class="form-control" placeholder="<?=$l['pass']?>">
							</div>
							<center><div class="g-recaptcha mb-3" data-sitekey="6LcZomEUAAAAAC-iUBV-u08ucPPV9euNOmPZCupJ"></div></center>
							<button name="sign_in" class="btn deep-purple text-white btn-block p-2"><i class="mdi mdi-login-variant"></i> <?=$l['sign_in']?></button>
						</div>
						<!-- РЕГИСТРАЦИЯ -->
						<div class="tab-pane fade" id="nav-auth" role="tabpanel" aria-labelledby="nav-auth-tab">
							<div class="input-group mb-3">
								<div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-user-plus"></i></span></div>
								<input name="nick" class="form-control" placeholder="<?=$l['username']?>">
							</div>

							<div class="input-group mb-3">
								<div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-lock"></i></span></div>
								<input name="pass_1" class="form-control" placeholder="<?=$l['pass']?>" type="password">
							</div>

							<div class="input-group mb-3">
								<div class="input-group-prepend"><span class="input-group-text bg-white border-0"><i class="fa fa-redo-alt"></i></span></div>
								<input name="pass_2" class="form-control" placeholder="<?=$l['r_pass']?>" type="password">
							</div>
							<center><div class="g-recaptcha mb-3" data-sitekey="6LcZomEUAAAAAC-iUBV-u08ucPPV9euNOmPZCupJ"></div></center>
							<button name="sign_up" class="btn deep-purple text-white btn-block p-2"><i class="fa fa-user-plus"></i> <?=$l['sign_up']?></button>
						</div>
						<!-- /////////////// -->
					</div>
					<hr>
					<script src="//ulogin.ru/js/ulogin.js"></script>
					<div id="uLogin07b94bd3" data-ulogin="display=panel;fields=first_name,last_name,email,nickname,sex,bdate,photo,photo_big;verify=1;theme=flat;providers=vkontakte,google,facebook,yandex,mailru;redirect_uri=;callback=" class="text-center"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<? endif ?>

<nav class="navbar navbar-expand-lg navbar-light md-nav-light md-shadow p-4">
	<a class="navbar-brand" style="padding-top: 0rem;padding-bottom: .8rem" href="/<?=$l['l']?>/"><img src="/src/img/logo.png" width="30"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto md-first">
			<li class="nav-item"><a class="nav-link" href="/<?=$l['l']?>/view/movie/"><i class="fa fa-fw fa-film"></i> <?=$l['movie']?></a></li>
			<li class="nav-item"><a class="nav-link" href="/<?=$l['l']?>/view/tv/"><i class="fa fa-fw fa-tv"></i> <?=$l['tv']?></a></li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navInfo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$l['info']?></a>
				<div class="dropdown-menu md-border-none md-shadow" aria-labelledby="navInfo">
					<a class="dropdown-item" href="/<?=$l['l']?>/info/about_us"><i class="fa fa-fw fa-info-circle"></i> <?=$l['about_us']?></a>
					<a class="dropdown-item" href="/<?=$l['l']?>/user/all"><i class="fa fa-fw fa-users"></i> <?=$l['users']?></a>
					<a class="dropdown-item" href="/<?=$l['l']?>/forum/"><i class="fa fa-fw fa-comments"></i> Форум (!)</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="https://vk.com/moody_good" target="_blank"><i class="fab fa-fw fa-vk"></i> <?=$l['vk']?></a>
				</div>
			</li>

			<li class="nav-item">
				<form class="form-inline my-2 my-lg-0 bg-white btn-rounded pl-2 pr-2" action="/<?=$l['l']?>/view/search/" method="get">
					<input class="form-control ml-2 p-2 md-border-none" type="search" placeholder="<?=$l['search']?>" name="q" value="<?=$_GET['q']?>">
					<button type="submit" class="btn btn-link p-2 text-dark rounded-0 md-border-b1"><i class="fa fa-search"></i></button>
				</form>
			</li>
		</ul>

		<ul class="navbar-nav navbar-right">
			<li class="nav-item dropdown">
				<a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/src/img/flag/<?=$l['lf']?>.png"> <span class="d-inline d-lg-none"><?=$l['lang']?></span></a>
				<div class="dropdown-menu dropdown-menu-right mb-3 md-border-none md-shadow" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="<?=$r['set_lang']?>"><img src="/src/img/flag/<?=$l['lf_op']?>.png"> <?=$l['lang_op']?></a>
				</div>
			</li>
			<? if (!isset($_SESSION['uid'])): ?>
				<button class="nav-item btn btn-outline-primary md-btn-round md-shadow-no" type="button" data-toggle="modal" data-target="#authModal"><i class="mdi mdi-login-variant"></i> <?=$l['sign_in']?></button>
			<? else: ?>
				<div class="nav-item dropdown">
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="/src/data/ava/<?=$_SESSION['photo']?>" width="40" height="40" class="md-btn-round">
					</a>
					<div class="dropdown-menu dropdown-menu-right md-border-none md-shadow" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/<?=$l['l']?>/user/<?=$_SESSION['nick']?>/"><i class="fa fa-user"></i> <?=$l['mypage']?></a>
						<a class="dropdown-item" href="/<?=$l['l']?>/user/im/"><i class="fa fa-comments"></i> <?=$l['messages']?></a>
						<a class="dropdown-item" href="/<?=$l['l']?>/user/settings/"><i class="fa fa-cog"></i> <?=$l['settings']?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/<?=$l['l']?>/user/sign_out/"><i class="fa fa-sign-out-alt"></i> <?=$l['sign_out']?></a>
					</div>
				</div>
			<? endif ?>
		</ul>
	</div>
</nav>

<div class="container-fluid">
	<div class="row md-container md-shadow md-roboto">