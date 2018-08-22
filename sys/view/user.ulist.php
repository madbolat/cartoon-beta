<div class="col-lg-12 mt-3">

	<ul class="breadcrumb">
		<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
		<a href="/<?=$l['l']?>/user/<?=$r['user']['nick']?>" class="breadcrumb-item"><?=$r['user']['nick']?></a>
		<a href="#" class="breadcrumb-item active"><?=$l['list']?></a>
	</ul>

	<nav class="nav nav-tabs mb-3">
		<li class="nav-item"><a href="/<?=$l['l']?>/user/ulist/<?=$url['4']?>/planned/" class="nav-link <?=($url[5]=='planned')?'active':''?>"><?=$l['planned']?></a></li>
		<li class="nav-item"><a href="/<?=$l['l']?>/user/ulist/<?=$url['4']?>/watching/" class="nav-link <?=($url[5]=='watching')?'active':''?>"><?=$l['watching']?></a></li>
		<li class="nav-item"><a href="/<?=$l['l']?>/user/ulist/<?=$url['4']?>/completed/" class="nav-link <?=($url[5]=='completed')?'active':''?>"><?=$l['completed']?></a></li>
		<li class="nav-item"><a href="/<?=$l['l']?>/user/ulist/<?=$url['4']?>/on_hold/" class="nav-link <?=($url[5]=='on_hold')?'active':''?>"><?=$l['on_hold']?></a></li>
		<li class="nav-item"><a href="/<?=$l['l']?>/user/ulist/<?=$url['4']?>/dropped/" class="nav-link <?=($url[5]=='dropped')?'active':''?>"><?=$l['dropped']?></a></li>
	</nav>
	<? if (!empty($r['view'])): ?>
		<ul class="list-group">
			<? foreach ($r['view'] as $x): ?>
				<a href="/<?=$l['l']?>/view/<?=$x['media_type']?><?=$x['title_id']?>" class="list-group-item list-group-item-action">
					<i class="fa fa-fw fa-<?=($x['media_type']==1)?'film':'tv'?>"></i> <?=$x['info']['title']?><?=$x['info']['name']?>
					<span class="badge badge-pill badge-warning float-right ml-1"><i class="fa fa-star"></i> <?=$x['info']['vote_average']?></span>
					<? if (!empty($x['info']['number_of_episodes'])): ?>
						<span class="badge badge-pill badge-info float-right"  data-toggle="tooltip" data-placement="top" title="<?=$l['season']?>: <?=$x['info']['number_of_seasons']?> / <?=$l['episode']?>: <?=$x['info']['number_of_episodes']?>"> <?=$x['info']['number_of_episodes']?> <?=$l['episodes']?></span>
					<? endif ?>
					<span class="clearfix"></span>
				</a>
			<? endforeach ?>
		</ul>
	<? else: ?>
		<div class="alert alert-danger"><?=$l['err']['empty']?></div>
	<? endif ?>
</div>