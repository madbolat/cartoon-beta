<? if (isset($r['err'])): ?>
	<div class="col-lg-12 mt-3">
		<div class="alert alert-danger">
			<?=$r['err']?> <a href="/<?=$l['l']?>/"><i class="fa fa-home"></i> <?=$l['go_home']?></a>
		</div>
	</div>
<? else: ?>
	<div class="col-lg-12 mt-3">
		<? for ($i=0; $i < count($r['search']); $i++): ?>
			<? if (($i==0) or ($i%6==0)): ?><div class="card-deck"><? endif ?>
				<a href="/<?=$l['l']?>/view/<?=($r['search'][$i]['media_type']=='movie')?'1':'2'?><?=$r['search'][$i]['id']?>-<?=urify(translit($r['search'][$i]['name'], $l['l_op']))?><?=urify(translit($r['search'][$i]['title'], $l['l_op']))?>" class="card mb-3 md-border-none md-card-link">
					<div class="position-relative">
						<? if (!empty($r['search'][$i]['poster_path'])): ?>
							<img class="card-img" src="https://image.tmdb.org/t/p/w185/<?=$r['search'][$i]['poster_path']?>" style="height: 270px">
						<? else: ?>
							<img class="card-img" src="/src/img/poster.png">
						<? endif ?>
						<div class="card-img-overlay md-overcard">
							<span class="badge badge-pill badge-warning text-dark"><i class="fa fa-star"></i> <?=$r['search'][$i]['vote_average']?></span> 
							<span class="badge badge-pill badge-light"><?=date_format(date_create($r['search'][$i]['release_date']), 'Y')?></span>
						</div>
					</div>
					<div class="card-footer transparent md-first"><?=$r['search'][$i]['name']?><?=$r['search'][$i]['title']?></div>
				</a>
			<? if (($i+1)%6==0): ?></div><? endif ?>
		<? endfor ?>
	</div>
<? endif ?>
