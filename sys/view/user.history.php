<div class="col-lg-12 mt-3">

	<ul class="breadcrumb">
		<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
		<a href="/<?=$l['l']?>/user/<?=$r['user']['nick']?>" class="breadcrumb-item"><?=$r['user']['nick']?></a>
		<a href="#" class="breadcrumb-item active"><?=$l['history']?></a>
	</ul>

	<? if (($url[4] == $_SESSION['uid']) or ($url[4] == 'feed')): ?>
		<nav class="nav nav-tabs">
			<a class="nav-item nav-link <?=($url[4]!='feed')?'active':''?>" href="/<?=$l['l']?>/user/history/<?=$_SESSION['uid']?>/"><?=$_SESSION['nick']?></a>
			<a class="nav-item nav-link <?=($url[4]=='feed')?'active':''?>" href="/<?=$l['l']?>/user/history/feed/"><i class="fa fa-users"></i> <?=$l['subs']?></a>
		</nav>
	<? endif ?>

	<div class="list-group list-group-flush mt-3">
		<? $history = (count($r['history'])<10) ? count($r['history']) : 10; ?>
		<? if (!empty($r['history'])): ?>
			<? for ($i=0; $i < $history; $i++): ?>
				<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="row">
						<? if (!empty($r['history'][$i]['info']['poster_path'])): ?>
							<div class="col-sm-2"><img class="img-fluid rounded" src="https://image.tmdb.org/t/p/w154<?=$r['history'][$i]['info']['poster_path']?>"></div>
						<? else: ?>
							<div class="col-sm-2"><img class="img-fluid rounded" src="/src/img/poster.png"></div>
						<? endif ?>
						<div class="col-sm-10">
							<div class="w-100 justify-content-between">
								<h5 class="mb-1">
									<?=$r['history'][$i]['info']['name']?>
									<?=$r['history'][$i]['info']['title']?>
								</h5>
							</div>
							<p class="m-0 mt-2 small text-muted">
								<?=$l['added_to']?> «<?=$l[$r['history'][$i]['state']]?>»
							</p>
							<p class="mt-1 small text-muted"><?=$r['history'][$i]['date']?></p>
						</div>
					</div>
				</a>
				<!--  -->
			<? endfor ?>
		<? else: ?>
			<div class="list-group-item">
				<?=$l['err']['empty']?>
			</div>
		<? endif ?>
	</div>
</div>