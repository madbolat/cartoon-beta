<? if (isset($r['err'])): ?>
	<div class="col-lg-12 mt-3">
		<div class="alert alert-danger">
			<?=$r['err']?>! <a href="/<?=$l['l']?>/"><i class="fa fa-home"></i> <?=$l['go_home']?></a>
		</div>
	</div>
<? else: ?>
	<div class="col-lg-9 mt-3">
		<div class="card card-testimonial text-center">
			<div class="card-header" style="background: url('/src/img/bg/<?=$r['user']['bg']?>') repeat;">
				<img src="/src/data/ava/<?=$r['user']['photo']?>" class="mt-5">
			</div>
			<div class="card-body">
				<? if (!empty($r['user']['full_name'])): ?>
					<h4 class="card-title mt-5 mb-0 md-first"><i class="fa fa-<?=$r['user']['sex']?>"></i> <?=translit($r['user']['full_name'], $l['l'])?></h4>
					<p class="text-muted">@<?=$r['user']['nick']?></p>
				<? else: ?>
					<h4 class="card-title mt-5 mb-0 md-first"><i class="fa fa-<?=$r['user']['sex']?>"></i> <?=$r['user']['nick']?></h4>
				<? endif ?>
				<p class="card-text">
					<?=$l['member']?> <span data-toggle="tooltip" data-placement="top" title="<?=date_format(date_create($r['user']['reg_time']), 'd.m.Y')?>"><?=date_format(date_create($r['user']['reg_time']), 'Y')?></span> 
					<? if (!empty($r['user']['web_page'])): ?>
					 	/ <a href="/<?=$l['l']?>/info/go/?url=<?=url_parse($r['user']['web_page'])['url']?>" target="_blank"><img src="<?=url_parse($r['user']['web_page'])['favicon']?>" class="md-favicon"> <?=url_parse($r['user']['web_page'])['host']?></a>
					<? endif ?>
				</p>
				<hr>
				<div class="row">
					<? if ($r['user']['nick'] == $_SESSION['nick']): ?>
						<div class="col-lg-6"><a class="text-dark" href="/<?=$l['l']?>/user/im/"><p class="mb-0"><i class="fa fa-comments fa-2x"></i></p></a></div>
						<div class="col-lg-6"><a class="text-dark" href="/<?=$l['l']?>/user/settings/"><p class="mb-0"><i class="fa fa-cog fa-2x"></i></p></a></div>
					<? else: ?>
						<pre>
							<?print_r($r['user']['mysubs'])?>
						</pre>
						<div class="col-lg-6"><a class="text-dark" href="/<?=$l['l']?>/user/im/?id=<?=$r['user']['uid']?>"><p class="mb-0"><i class="far fa-envelope fa-2x"></i></p></a></div>
						<? if ($r['user']['friend_flag']): ?>
							<div class="col-lg-6"><a class="text-dark" href="/<?=$l['l']?>/user/<?=$r['user']['nick']?>/?unfollow"><p class="mb-0"><i class="fa fa-user-slash fa-2x"></i></p></a></div>
						<? else: ?>
							<div class="col-lg-6"><a class="text-dark" href="/<?=$l['l']?>/user/<?=$r['user']['nick']?>/?follow"><p class="mb-0"><i class="far fa-handshake fa-2x"></i></p></a></div>
						<? endif ?>
					<? endif ?>
				</div>
			</div>
		</div>
		<div class="card mt-3">
			<div class="card-body">
				<div class="text-primary text-uppercase pb-2 md-first"><i class="far fa-list-alt"></i> <?=$l['list']?></div>
				<div class="progress" style="height: 25px">
					<div class="progress-bar light-blue darken-2" role="progressbar" style="width:<?=$r['w1']?>%" data-toggle="tooltip" data-placement="top" title="<?=$l['completed']?>">
						<?=$r['completed']?>
					</div>
					<div class="progress-bar blue lighten-1" role="progressbar" style="width:<?=$r['w2']?>%" data-toggle="tooltip" data-placement="top" title="<?=$l['planned_2']?>, <?=$l['watching']?>, <?=$l['on_hold']?>, <?=$l['dropped']?>">
						<?=$r['planned']+$r['watching']+$r['on_hold']+$r['dropped']?>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<small>
					<a href="/<?=$l['l']?>/user/ulist/<?=$r['user']['uid']?>/planned/"><?=$l['planned_2']?> (<?=$r['planned']?>)</a> / 
					<a href="/<?=$l['l']?>/user/ulist/<?=$r['user']['uid']?>/watching/"><?=$l['watching']?> (<?=$r['watching']?>)</a> / 
					<a href="/<?=$l['l']?>/user/ulist/<?=$r['user']['uid']?>/completed/"><?=$l['completed']?> (<?=$r['completed']?>)</a> / 
					<a href="/<?=$l['l']?>/user/ulist/<?=$r['user']['uid']?>/on_hold/"><?=$l['on_hold']?> (<?=$r['on_hold']?>)</a> / 
					<a href="/<?=$l['l']?>/user/ulist/<?=$r['user']['uid']?>/dropped/"><?=$l['dropped']?> (<?=$r['dropped']?>)</a>
				</small>
			</div>
		</div>
		<hr>
		
		<a href="#" class="btn btn-link text-uppercase pb-2 md-first"><i class="far fa-comments"></i> <?=$l['comments']?></a>
		<div class="card">
			<div class="card-body row">
				<div class="col-sm-1"><img src="/src/data/ava/empty.png" alt="" class="rounded-circle img-fluid"></div>
				<div class="col-sm-11">
					<a href="#" class="card-title md-first mb-0">Decim</a>
					<div class="card-text">Привет, как дела?</div>
				</div>
			</div>
		</div>
		<div class="form-group mt-4">
			<textarea name="" class="form-control mb-3 border rounded p-2"></textarea>
			<button class="btn btn-success float-right">Написать</button>
		</div>
	</div>
	<div class="col-lg-3 mt-3">
		<div class="card">
			<? if (!empty($r['user']['history'])): ?>
				<a href="/<?=$l['l']?>/user/history/<?=$r['user']['uid']?>/" class="card-header text-uppercase md-first"><i class="fa fa-history"></i> <?=$l['history']?></a>
			<? else: ?>
				<div class="card-header text-uppercase md-first"><i class="fa fa-history"></i> <?=$l['history']?></div>
			<? endif ?>
			<div class="list-group list-group-flush">
				<? $history = (count($r['user']['history'])<3) ? count($r['user']['history']) : 3; ?>
				<? if (!empty($r['user']['history'])): ?>
					<? for ($i=0; $i < $history; $i++): ?>
						<a href="/<?=$l['l']?>/view/<?=$r['user']['history'][$i]['media_type']?><?=$r['user']['history'][$i]['title_id']?>-<?=urify(translit($r['user']['history'][$i]['info']['name'], $l['l_op']))?><?=urify(translit($r['user']['history'][$i]['info']['title'], $l['l_op']))?>" class="list-group-item list-group-item-action flex-column align-items-start">
							<div class="row">
								<? if (!empty($r['user']['history'][$i]['info']['poster_path'])): ?>
									<div class="col-sm-4"><img class="img-fluid rounded" src="https://image.tmdb.org/t/p/w154/<?=$r['user']['history'][$i]['info']['poster_path']?>"></div>
								<? else: ?>
									<div class="col-sm-4"><img class="img-fluid rounded" src="/src/img/poster.png"></div>
								<? endif ?>
								<div class="col-sm-8">
									<div class="w-100 justify-content-between">
										<h5 class="mb-1">
											<?=$r['user']['history'][$i]['info']['name']?>
											<?=$r['user']['history'][$i]['info']['title']?>
										</h5>
									</div>
									<p class="m-0 mt-2 small text-muted">
										<?=$l['added_to']?> «<?=$l[$r['user']['history'][$i]['state']]?>»
									</p>
									<p class="mt-1 small text-muted"><?=$r['user']['history'][$i]['date']?></p>
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
		<? if (!empty($r['user']['subs'])): ?>
			<div class="card mt-3">
				<a href="" class="card-header text-uppercase md-first"><i class="fa fa-users"></i> <?=$l['subs']?></a>
				<div class="card-body">
					<div class="card-columns">
						<? foreach ($r['user']['subs'] as $x): ?>
							<a href="/<?=$l['l']?>/user/<?=$x['info']['nick']?>/" class="card md-btn-round" data-toggle="tooltip" data-placement="top" title="<?=$x['info']['nick']?>">
								<img src="/src/data/ava/<?=$x['info']['photo']?>" class="card-img-top md-btn-round">
							</a>
						<? endforeach ?>
					</div>
				</div>
			</div>
		<? endif ?>
		<div class="card mt-3">
			<a href="" class="card-header text-uppercase md-first"><i class="fa fa-heart"></i> <?=$l['favorite']?></a>
			<div class="card-body">
				<div class="card-columns">
					<a href="#" class="card md-btn-round" data-toggle="tooltip" data-placement="top" title="">
						<img src="/src/img/still.png" class="card-img-top md-btn-round">
					</a>
				</div>
			</div>
		</div>
	</div>
<? endif ?>