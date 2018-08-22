<div class="col-lg-12 mt-3">

	<!--  -->
	<div class="alert alert-danger">not work</div>
	<!--  -->

	<? if (is_numeric($_GET['id'])): ?>
		<nav class="breadcrumb">
			<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
			<a href="/<?=$l['l']?>/user/<?=$_SESSION['nick']?>/" class="breadcrumb-item"><?=$_SESSION['nick']?></a>
			<a href="/<?=$l['l']?>/user/im/" class="breadcrumb-item"><?=$l['messages']?></a>
			<a href="#" class="breadcrumb-item active">%username%</a>
		</nav>
	<? else: ?>
		<nav class="breadcrumb">
			<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
			<a href="/<?=$l['l']?>/user/<?=$_SESSION['nick']?>/" class="breadcrumb-item"><?=$_SESSION['nick']?></a>
			<a href="#" class="breadcrumb-item active"><?=$l['messages']?></a>
		</nav>
		<nav class="nav nav-pills indigo accent-2 md-first">
			<? if (isset($_GET['unread'])): ?>
				<a class="nav-item nav-link white-text m-2" href="/<?=$l['l']?>/user/im/"><?=$l['all_mess']?></a>
				<a class="nav-item nav-link white-text m-2 active" href="/<?=$l['l']?>/user/im/?unread"><?=$l['unread_mess']?></a>
			<? else: ?>
				<a class="nav-item nav-link white-text m-2 active" href="/<?=$l['l']?>/user/im/"><?=$l['all_mess']?></a>
				<a class="nav-item nav-link white-text m-2" href="/<?=$l['l']?>/user/im/?unread"><?=$l['unread_mess']?></a>
			<? endif ?>
		</nav>
		<!--  -->
		<div class="list-group">
			<a href="/<?=$l['l']?>/user/im/?id=1" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-warning">
				<img src="/src/data/ava/empty.png" width="40" height="40" class="btn-rounded float-left mr-3">
				<div class="d-flex justify-content-between">
					<h6 class="mb-1 text-dark">Decim</h6>
					<small>3 days ago</small>
				</div>
				<p class="mb-1 text-muted">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			</a>
			<a href="/<?=$l['l']?>/user/im/?id=1" class="list-group-item list-group-item-action flex-column align-items-start">
				<img src="/src/data/ava/empty.png" width="40" height="40" class="btn-rounded float-left mr-3">
				<div class="d-flex justify-content-between">
					<h6 class="mb-1 text-dark">zombawka</h6>
					<small class="text-muted">3 days ago</small>
				</div>
				<p class="mb-1 text-muted">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			</a>
			<a href="/<?=$l['l']?>/user/im/?id=1" class="list-group-item list-group-item-action flex-column align-items-start">
				<img src="/src/data/ava/empty.png" width="40" height="40" class="btn-rounded float-left mr-3">
				<div class="d-flex justify-content-between">
					<h6 class="mb-1 text-dark">Monolitik1</h6>
					<small class="text-muted">3 days ago</small>
				</div>
				<p class="mb-1 text-muted">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			</a>
		</div>
		<!--  -->
	<? endif ?>
</div>