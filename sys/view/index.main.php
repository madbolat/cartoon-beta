<div class="col-lg-12 mt-3">
	<h5 class="p-3 md-first"><i class="far fa-heart"></i> Сейчас смотрят</h5>
	<div class="card">
		<div class="container-fluid pt-3">
			<div class="row" style="overflow-x: visible;">
				<? for ($i=0; $i < 6; $i++): ?>
					<div class="col-lg-2">
						<a href="/<?=$l['l']?>/view/<?=($r['media_type']=='movie')?'1':'2'?><?=$r['movie'][$i]['id']?>-<?=urify(translit($r['movie'][$i]['name'], $l['l_op']))?><?=urify(translit($r['movie'][$i]['title'], $l['l_op']))?>" class="card md-card-link md-border-no">
							<div class="position-relative">
								<? if (!empty($r['movie'][$i]['poster_path'])): ?>
									<img src="https://image.tmdb.org/t/p/w300/<?=$r['movie'][$i]['poster_path']?>" class="card-img">
								<? else: ?>
									<img class="card-img" src="/src/img/poster.png">
								<? endif ?>
								<div class="card-img-overlay md-overcard">
									<span class="badge badge-pill badge-warning text-dark"><i class="fa fa-star"></i> <?=$r['movie'][$i]['vote_average']?></span> 
									<span class="badge badge-pill badge-light"><?=date_format(date_create($r['movie'][$i]['release_date']), 'Y')?></span>
								</div>
							</div>
							<div class="card-footer transparent md-first"><?=$r['movie'][$i]['name']?><?=$r['movie'][$i]['title']?></div>
						</a>
					</div>
				<? endfor ?>
			</div>
		</div>
	</div>
	
	<h5 class="mt-3 p-3 md-first"><i class="fa fa-newspaper"></i> <?=$l['news']?> <small class="text-muted">powered by Animatron Inc.</small></h5>
	<div class="card-columns">
	<? foreach ($r['vk'] as $x): ?>
		<? if (($x['marked_as_ada'] == 0) and ($x['post_type'] == 'post') and (!isset($x['copy_history']))): ?>
			<div class="card mb-3">
				<? if (!empty($x['attachments'])): ?>
						<? foreach ($x['attachments'] as $y): ?>
							<? if ($y['type'] == 'photo'): ?>
								<? foreach ($y['photo']['sizes'] as $z): ?>
									<? if ($z['type'] == 'z'): ?>
										<img src="<?=$z['url']?>" class="card-img">
									<? endif ?>
								<? endforeach ?>
							<? elseif($y['type'] == 'video'): ?>
								<a href="https://vk.com/video<?=$y['video']['owner_id']?>_<?=$y['video']['id']?>" target="_blank" class="position-relative">
									<? if (isset($y['video']['photo_640'])): ?>
										<img src="<?=$y['video']['photo_640']?>" class="card-img">
									<? elseif (isset($y['video']['photo_800'])):?>
										<img src="<?=$y['video']['photo_800']?>" class="card-img">
									<? endif ?>
									<div class="card-img-overlay text-center">
										<i class="fa fa-play fa-2x text-white bg-dark rounded-circle p-3"></i>
										<!-- <h6><?=$y['video']['title']?></h6> -->
									</div>
								</a>
							<? endif ?>
						<? endforeach ?>
					<? endif ?>
				<div class="card-body">
					<div class="card-text">
						<?=$x['text']?>
					</div>
					<? if (!empty($x['attachments'])): ?>
						<? foreach ($x['attachments'] as $z): ?>
							<? if ($z['type'] == 'link'): ?>
								<hr>
								<a href="<?=$z['link']['url']?>" target="_blank"><?=$z['link']['title']?></a>
							<? endif ?>
						<? endforeach ?>
					<? endif ?>
				</div>
				<div class="card-footer">
					<i class="fa fa-calendar-alt"></i> <?=gmdate("d.m.Y", $x['date'])?> / 
					<i class="fa fa-clock"></i> <?=gmdate("H:i", $x['date'])?> / 
					<i class="fa fa-eye"></i> <?=$x['views']['count']?>
				</div>
			</div>
		<? endif ?>
	<? endforeach ?>
	</div>
</div>