<div class="col-lg-12 mt-3">
	<ul class="breadcrumb">
		<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
		<a href="/<?=$l['l']?>/view/<?=$r['media_type']?><?=$r['info']['id']?>-<?=urify(translit($r['info']['name'], $l['l_op']))?><?=urify(translit($r['info']['title'], $l['l_op']))?>" class="breadcrumb-item"><?=$r['info']['name']?><?=$r['info']['title']?></a>
		<a href="#" class="breadcrumb-item active"><?=$l['created_by']?></a>
	</ul>
</div>

<div class="col-lg-6 mt-3" id="Cast">
	<div class="card">
		<div class="card-header"><?=$l['cast']?></div>
		<ul class="list-group list-group-flush">
			<? if (!empty($r['credits']['cast'])): ?>
				<? foreach ($r['credits']['cast'] as $cast): ?>
					<div id="headCast<?=$cast['order']?>">
						<span class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#colCast<?=$cast['order']?>" aria-expanded="true" aria-controls="colCast<?=$cast['order']?>"><i class="fa fa-angle-right"></i> <?=$cast['name']?></span>
					</div>
					<div id="colCast<?=$cast['order']?>" class="collapse" aria-labelledby="headCast<?=$cast['order']?>" data-parent="#Cast">
						<div class="list-group-item list-group-item-action">
							<? if (!empty($cast['profile_path'])): ?>
								<img src="https://image.tmdb.org/t/p/w45/<?=$cast['profile_path']?>" class="rounded float-left mr-2">
							<? else: ?>
								<img src="/src/img/poster.png" style="width: 45px">
							<? endif ?>
							<?=$cast['character']?>
							<div class="clearfix"></div>
						</div>
					</div>
				<? endforeach ?>
			<? else: ?>
				<li class="list-group-item"><?=$l['err']['empty']?></li>
			<? endif ?>
		</ul>
	</div>
</div>
<div class="col-lg-6 mt-3" id="Crew">
	<div class="card">
		<div class="card-header"><?=$l['created_by']?></div>
		<ul class="list-group list-group-flush">
			<? if (!empty($r['credits']['crew'])): ?>
				<? foreach ($r['credits']['crew'] as $crew): ?>
					<div id="headCrew<?=$crew['credit_id']?>">
						<span class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#colCrew<?=$crew['credit_id']?>" aria-expanded="true" aria-controls="colCrew<?=$crew['credit_id']?>"><i class="fa fa-angle-right"></i> <?=$crew['name']?> (<?=$crew['job']?>)</span>
					</div>
					<div id="colCrew<?=$crew['credit_id']?>" class="collapse" aria-labelledby="headCrew<?=$crew['credit_id']?>" data-parent="#Crew">
						<div class="list-group-item list-group-item-action">
							<? if (!empty($crew['profile_path'])): ?>
								<img src="https://image.tmdb.org/t/p/w45/<?=$crew['profile_path']?>" class="rounded float-left mr-2">
							<? else: ?>
								<img src="/src/img/poster.png" style="width: 45px">
							<? endif ?>
							<?=$crew['job']?> [<?=$crew['department']?>]
							<div class="clearfix"></div>
						</div>
					</div>
				<? endforeach ?>
			<? else: ?>
				<li class="list-group-item"><?=$l['err']['empty']?></li>
			<? endif ?>
		</ul>
	</div>
</div>