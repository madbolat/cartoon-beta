<div class="col-lg-12 mt-3">
	<ul class="breadcrumb">
		<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
		<a href="#" class="breadcrumb-item"><?=$l['collection']?></a>
		<a href="#" class="breadcrumb-item active"><?=$r['collection']['name']?><?=$r['collection']['title']?></a>
	</ul>

	<nav class="list-group">
		<? foreach ($r['collection']['parts'] as $x): ?>
			<a href="/<?=$l['l']?>/view/1<?=$x['id']?>-<?=urify(translit($x['name'], $l['l_op']))?><?=urify(translit($x['title'], $l['l_op']))?>" class="list-group-item list-group-item-action">
				<img src="https://image.tmdb.org/t/p/w154<?=$x['poster_path']?>" class="float-left rounded mr-3">
				<h5 class="md-first mb-0"><?=$x['name']?><?=$x['title']?> (<span class="text-muted"><?=$x['original_title']?><?=$x['original_name']?></span>)</h5>
				<p class="p-2"><?=$x['overview']?></p>
				<span class="badge badge-pill badge-warning text-dark"><i class="fa fa-star"></i> <?=$x['vote_average']?></span> 
				<span class="badge badge-pill badge-light"><?=date_format(date_create($x['release_date']), 'Y')?></span>
				<span class="clearfix"></span>
			</a>
		<? endforeach ?>
	</nav>
</div>