<? if ((isset($r['err'])) or (isset($r['detail']['err'])) or (isset($r['view']['err']))): ?>
	<div class="col-lg-12 mt-3">
		<div class="alert alert-danger">
			<?=$r['err']?><?=$r['detail']['err']?><?=$r['view']['err']?>! <a href="/<?=$l['l']?>/"><i class="fa fa-home"></i> <?=$l['go_home']?></a>
		</div>
	</div>
<? elseif (isset($r['detail'])): ?>
	<!-- TITLE PAGE -->
	<div class="col-lg-12 md-backdrop"><style>.md-backdrop::before {background: url(https://image.tmdb.org/t/p/w1400_and_h450_face/<?=$r['detail']['backdrop_path']?>) no-repeat;}</style></div>
	<div class="col-lg-9 mt-3">
		<div class="row">
			<div class="col-lg-3 pr-0">
				<div class="card md-border-none transparent md-shadow-2">
					<div class="position-relative">
						<? if (!empty($r['detail']['poster_path'])): ?>
							<img class="card-img" src="https://image.tmdb.org/t/p/w500/<?=$r['detail']['poster_path']?>">
						<? else: ?>
							<img class="card-img" src="/src/img/poster.png">
						<? endif ?>
						<div class="card-img-overlay md-overcard p-0 pt-2">
							<ul class="nav nav-fill">
								<li class="nav-item" data-toggle="tooltip" data-placement="top" title="LIKE"><a class="nav-link text-white" href="#"><i class="far fa-heart"></i></a></li>
								<li class="nav-item"><a class="nav-link text-white" href="#"><i class="far fa-comment"></i></a></li>
								<li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-plus"></i></a></li>
								<li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="btn-group w-100 mt-1 md-first" role="group">
					<a href="<?=$r['a']?>/?planned" class="btn btn-secondary w-100"><i class="far fa-calendar-plus"></i> <?=$l['planned']?></a>
					<div class="btn-group" role="group">
						<button id="btnMyList" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMyList">
							<a class="dropdown-item" href="<?=$r['a']?>/?completed"><i class="fa fa-fw fa-check"></i> <?=$l['completed']?></a>
							<a class="dropdown-item" href="<?=$r['a']?>/?watching"><i class="fa fa-fw fa-play"></i> <?=$l['watching']?></a>
							<a class="dropdown-item" href="<?=$r['a']?>/?on_hold"><i class="fa fa-fw fa-pause"></i> <?=$l['on_hold']?></a>
							<a class="dropdown-item" href="<?=$r['a']?>/?dropped"><i class="fa fa-fw fa-trash"></i> <?=$l['dropped']?></a>
							<? if ($r['in_list']): ?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="<?=$r['a']?>/?remove"><i class="fa fa-fw fa-times"></i> <?=$l['del_from_list']?></a>
							<? endif ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<div>
								<h3 class="card-title md-first mb-1"><?=$r['detail']['title']?><?=$r['detail']['name']?></h3>
								<h6 class="text-light md-first m-0"><?=$r['detail']['original_title']?><?=$r['detail']['original_name']?></h6>
							</div>
							<small class="text-right">
								<span data-toggle="tooltip" data-placement="bottom" title="<?=$r['detail']['vote_count']?> <?=$l['voted']?>">
									<?=$r['detail']['vote_average']?> 
									<? if (round($r['detail']['vote_average'])%2==0): ?>
										<? for ($i=0; $i < (round($r['detail']['vote_average'])/2); $i++): ?>
											<i class="text-warning fa fa-star"></i>
										<? endfor ?>
										<? for ($i=0; $i < ((10-round($r['detail']['vote_average']))/2); $i++): ?>
											<i class="text-warning far fa-star"></i>
										<? endfor ?>
									<? else: ?>
										<? for ($i=0; $i < ((round($r['detail']['vote_average'])-1)/2); $i++): ?>
											<i class="text-warning fa fa-star"></i>
										<? endfor ?>
										<i class="text-warning fas fa-star-half-alt"></i>
										<? if (round($r['detail']['vote_average']) < 8): ?>
											<? for ($i=0; $i < ((9-round($r['detail']['vote_average']))/2); $i++): ?>
												<i class="text-warning far fa-star"></i>
											<? endfor ?>
										<? endif ?>
									<? endif ?>
								</span>
								<br>
								<span class="md-first text-light"><?=$l['popularity']?>: <?=$r['detail']['popularity']?></span>
								<? if (!empty($r['detail']['ids']['imdb_id'])): ?>
									<br><span class="imdbRatingPlugin md-first text-light" data-user="ur90318039" data-title="<?=$r['detail']['ids']['imdb_id']?>" data-style="p4">IMDb </span>
									<script>(function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js";stags.parentNode.insertBefore(js,stags);})(document,"script","imdb-rating-api");</script>
								<? endif ?>
							</small>
						</div>
						<hr>
						<div class="card-text">
							<?=$r['detail']['overview']?><hr>
							<? if (!empty($r['detail']['genres'])): ?>
								<h6 class="m-0 float-left text-light md-first pt-2 pr-2"><?=$l['genre']?>: </h6>
								<? foreach ($r['detail']['genres'] as $x): ?>
									<? if (count($r['detail']['genres']) == 1): ?>
										<div class="btn btn-info btn-rounded btn-sm"><?=$x['name']?></div>
									<? else: ?>
										<? if ($x['id'] != 16): ?>
											<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?genre=<?=$x['id']?>" class="btn btn-info btn-rounded btn-sm"><?=$x['name']?></a>
										<? endif ?>
									<? endif ?>
								<? endforeach ?>
							<? endif ?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- COMMENT SECTION//////////////////////// -->
			<div class="col-lg-12 mt-3">
				<? if (!empty($r['detail']['similar'])): ?>
					<div class="card">
						<div class="card-header text-uppercase md-first"><i class="far fa-thumbs-up"></i> <?=$l['similar']?></div>
						<div class="card-group">
							<? foreach ($r['detail']['similar'] as $sim): ?>
								<a href="/<?=$l['l']?>/view/<?=($r['media_type']=='movie')?'1':'2'?><?=$sim['id']?>-<?=urify(translit($sim['name'], $l['l_op']))?><?=urify(translit($sim['title'], $l['l_op']))?>" class="card md-card-link md-border-no">
									<div class="position-relative">
										<? if (!empty($sim['poster_path'])): ?>
											<img src="https://image.tmdb.org/t/p/w154/<?=$sim['poster_path']?>" style="height: 225px" class="card-img">
										<? else: ?>
											<img class="card-img" src="/src/img/poster.png" style="height: 225px">
										<? endif ?>
										<div class="card-img-overlay md-overcard">
											<span class="badge badge-pill badge-warning text-dark"><i class="fa fa-star"></i> <?=$sim['vote_average']?></span> 
											<span class="badge badge-pill badge-light"><?=date_format(date_create($sim['release_date']), 'Y')?></span>
										</div>
									</div>
									<div class="card-footer transparent md-first"><?=$sim['name']?><?=$sim['title']?></div>
								</a>
							<? endforeach ?>
							<? if (count($r['detail']['similar'])<7): ?>
								<? for ($i=0; $i < (7-count($r['detail']['similar'])); $i++): ?>
									<div class="card md-border-no" style="height: 1px"></div>
								<? endfor ?>
							<? endif ?>
						</div>
					</div>
				<? endif ?>
				<div class="alert alert-danger mt-3">
					NO COMMENT | КОММЕНТАРИИ НЕ ДОСТУПНЫ
				</div>

				<!-- <pre class="bg-white"><? print_r($r['detail']) ?></pre> -->
			</div>
		</div>
	</div>
	<div class="col-lg-3 mt-3 pl-0" id="accordion">
		<ul class="list-group">
			<div class="list-group-item">
				<i class="fa fa-fw fa-info-circle"></i> <?=$l['status']?>:
				<span class="badge badge-pill <?=get_status($r['detail']['status'])['css']?>"><?=$l[get_status($r['detail']['status'])['l']]?></span>
				<? if ($r['media_type'] == 'movie'): ?>
					<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="<?=date_format(date_create($r['detail']['release_date']), 'd.m.Y')?>"><?=date_format(date_create($r['detail']['release_date']), 'Y')?></span>
				<? else: ?>
					<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="<?=date_format(date_create($r['detail']['first_air_date']), 'd.m.Y')?>-<?=date_format(date_create($r['detail']['last_air_date']), 'd.m.Y')?>"><?=date_format(date_create($r['detail']['first_air_date']), 'Y')?>-<?=date_format(date_create($r['detail']['last_air_date']), 'Y')?></span>
				<? endif ?>
				<? if (!empty($r['detail']['production_countries'])): ?>
					<? foreach ($r['detail']['production_countries'] as $x): ?>
						<img src="/src/img/flag/<?=$x['iso_3166_1']?>.png" data-toggle="tooltip" data-placement="bottom" title="<?=$x['name']?>" alt="<?=$x['iso_3166_1']?>">
					<? endforeach ?>
				<? elseif (!empty($r['detail']['origin_country'])): ?>
					<? foreach ($r['detail']['origin_country'] as $y => $x): ?>
						<img src="/src/img/flag/<?=$x?>.png" data-toggle="tooltip" data-placement="bottom" title="<?=$x?>" alt="<?=$x?>">
					<? endforeach ?>
				<? endif ?>
			</div>
			<? if (!empty($r['detail']['number_of_seasons']) or !empty($r['detail']['number_of_episodes'])): ?>
				<li class="list-group-item">
					<? if (!empty($r['detail']['number_of_seasons'])): ?>
						<i class="fa fa-fw fa-list-ol"></i> <?=$l['season']?>: <?=$r['detail']['number_of_seasons']?> 
					<? endif ?>
					<? if (!empty($r['detail']['number_of_episodes'])): ?>
						/ <?=$l['episode']?>: <?=$r['detail']['number_of_episodes']?>
					<? endif ?>
				</li>
			<? endif ?>
			<? if (!empty($r['detail']['runtime'])): ?>
				<li class="list-group-item"><i class="far fa-fw fa-clock"></i> <?=$l['runtime']?>: <span data-toggle="tooltip" data-placement="bottom" title="<?=date('H:i '.$l['min'], mktime(0,$r['detail']['runtime']))?>"><?=$r['detail']['runtime']?> <?=$l['min']?>.</span></li>
			<? elseif (!empty($r['detail']['episode_run_time'])): ?>
				<li class="list-group-item"><i class="far fa-fw fa-clock"></i> <?=$l['runtime']?>: <span data-toggle="tooltip" data-placement="bottom" title="<?=date('H:i '.$l['min'], mktime(0,$r['detail']['episode_run_time'][0]))?>"><?=$r['detail']['episode_run_time'][0]?> <?=$l['min']?>.</span></li>
			<? endif ?>
			<? if (!empty($r['detail']['homepage'])): ?>
				<a class="list-group-item list-group-item-action" href="/<?=$l['l']?>/info/go/?url=<?=url_parse($r['detail']['homepage'])['url']?>" target="_blank" title="<?=$l['of_website']?>">
					<img src="<?=url_parse($r['detail']['homepage'])['favicon']?>" class="md-favicon fa fa-fw"> <?=url_parse($r['detail']['homepage'])['host']?>
				</a>
			<? endif ?>
			<? if (!empty($r['detail']['ids']['imdb_id'])): ?>
				<a class="list-group-item list-group-item-action" href="/<?=$l['l']?>/info/go/?url=https://www.imdb.com/title/<?=$r['detail']['ids']['imdb_id']?>" target="_blank"><img src="<?=url_parse('https://www.imdb.com')['favicon']?>" class="md-favicon fa fa-fw"> <?=$l['imdb']?></a>
			<? endif ?>
			<? if (!empty($r['detail']['created_by'])): ?>
				<div id="headAuthors" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#colAuthors" aria-expanded="true" aria-controls="colAuthors">
					<i class="fa fa-fw fa-user-edit"></i> <?=$l['created_by']?>
				</div>
				<div id="colAuthors" class="collapse" aria-labelledby="headAuthors" data-parent="#accordion">
					<? foreach ($r['detail']['created_by'] as $x): ?>
						<div class="list-group-item list-group-item-action btn-sm rounded-0">
							<? if (!empty($x['profile_path'])): ?>
								<img src="https://image.tmdb.org/t/p/w45/<?=$x['profile_path']?>" class="rounded float-left mr-2">
							<? endif ?>
							<?=$x['name']?>
							<div class="clearfix"></div>
						</div>
					<? endforeach ?>
				</div>
			<? endif ?>
		</ul>
		<? if (!empty($r['detail']['production_companies'])): ?>
			<div class="card mt-3">
				<div class="card-header text-uppercase md-first"><i class="fa fa-film"></i> <?=$l['studios']?></div>
				<nav class="list-group list-group-flush">
					<? foreach ($r['detail']['production_companies'] as $x): ?>
						<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?studio=<?=$x['id']?>" class="list-group-item list-group-item-action btn-sm"><i class="fa fa-angle-right"></i> <?=$x['name']?></a>
					<? endforeach ?>
				</nav>
			</div>
		<? endif ?>
		<? if (!empty($r['detail']['belongs_to_collection'])): ?>
			<div class="list-group mt-3">
				<a class="list-group-item list-group-item-action" href="/<?=$l['l']?>/view/collection/<?=$r['detail']['belongs_to_collection']['id']?>"><i class="fa fa-list-ul"></i> <?=$r['detail']['belongs_to_collection']['name']?></a>
			</div>
		<? endif ?>
		<!-- жжжж -->
		<? if (!empty($r['detail']['credits']['cast'])): ?>
			<div class="card mt-3">
				<a href="/<?=$l['l']?>/view/credit/<?=($r['media_type']=='movie')?'1':'2'?><?=$r['detail']['credits']['id']?>/" class="card-header text-uppercase md-first d-flex justify-content-between">
					<span><i class="fa fa-users"></i> <?=$l['cast']?></span>					
					<span><i class="fa fa-angle-right"></i></span>
				</a>
				<nav class="list-group list-group-flush">
					<? $count = (count($r['detail']['credits']['cast']) > 5) ? 5 : (count($r['detail']['credits']['cast'])); ?>
					<? for ($i=0; $i < $count; $i++): ?>
						<div id="headCast<?=$i?>">
							<span class="list-group-item list-group-item-action btn-sm" data-toggle="collapse" data-target="#colCast<?=$i?>" aria-expanded="true" aria-controls="colCast<?=$i?>"><i class="fa fa-angle-right"></i> <?=$r['detail']['credits']['cast'][$i]['name']?></span>
						</div>
						<div id="colCast<?=$i?>" class="collapse" aria-labelledby="headCast<?=$i?>" data-parent="#accordion">
							<div class="list-group-item list-group-item-action btn-sm">
								<img src="https://image.tmdb.org/t/p/w45/<?=$r['detail']['credits']['cast'][$i]['profile_path']?>" class="rounded float-left mr-2">
								<?=$r['detail']['credits']['cast'][$i]['character']?>
								<div class="clearfix"></div>
							</div>
						</div>
					<? endfor ?>
				</nav>
			</div>
		<? endif ?>
		<? if (!empty($r['detail']['last_episode_to_air'])): ?>
			<div class="card mt-3">
				<div class="card-header text-uppercase md-first"><i class="fa fa-backward"></i> <?=$l['last_episode']?></div>
				<? if (!empty($r['detail']['last_episode_to_air']['still_path'])): ?>
					<img src="https://image.tmdb.org/t/p/w300/<?=$r['detail']['last_episode_to_air']['still_path']?>" class="card-img">
				<? else: ?>
					<img src="/src/img/still.png" class="card-img">
				<? endif ?>
				<div class="card-img-overlay mt-5" style="background: rgba(0,0,0,0.3);"> 
					<span class="badge badge-pill badge-light text-dark text-left" style="white-space: normal;">№<?=$r['detail']['last_episode_to_air']['episode_number']?> <?=$r['detail']['last_episode_to_air']['name']?></span>
					<span class="badge badge-pill badge-primary"><?=$r['detail']['last_episode_to_air']['air_date']?></span>
					<span class="badge badge-pill badge-info"><?=$l['season']?>: <?=$r['detail']['last_episode_to_air']['season_number']?></span>
				</div>
			</div>
		<? endif ?>
		<!-- жжжж -->
	</div>
<? else: ?>
	<!-- TITLES PAGE -->
	<div class="col-lg-12 mt-3 alert alert-info p-1">
		<h5 class="m-0 p-3 md-first text-muted">(!) Всего: <?=$r['view']['total_results']?> фильмов/сериалов</h5>
	</div>
	<div class="col-lg-9">
		<? for ($i=0; $i < count($r['view']['results']); $i++): ?>
			<? if (($i==0) or ($i%4==0)): ?><div class="card-deck"><? endif ?>
			<a href="/<?=$l['l']?>/view/<?=($url[3][0]=='m')?'1':'2'?><?=$r['view']['results'][$i]['id']?>-<?=urify(translit($r['view']['results'][$i]['name'], $l['l_op']))?><?=urify(translit($r['view']['results'][$i]['title'], $l['l_op']))?>" class="card mb-3 md-border-none md-card-link">
				<div class="position-relative">
					<? if (!empty($r['view']['results'][$i]['poster_path'])): ?>
						<img class="card-img" src="https://image.tmdb.org/t/p/w300/<?=$r['view']['results'][$i]['poster_path']?>">
					<? else: ?>
						<img class="card-img" src="/src/img/poster.png">
					<? endif ?>
					<div class="card-img-overlay md-overcard">
						<span class="badge badge-pill badge-warning text-dark"><i class="fa fa-star"></i> <?=$r['view']['results'][$i]['vote_average']?></span> 
						<? if ($r['media_type'] == 'movie'): ?>
							<span class="badge badge-pill badge-light"><?=date_format(date_create($r['view']['results'][$i]['release_date']), 'Y')?></span>
						<? else: ?>
							<span class="badge badge-pill badge-light"><?=date_format(date_create($r['view']['results'][$i]['first_air_date']), 'Y')?></span>
						<? endif ?>
					</div>
				</div>
				<div class="card-footer transparent md-first"><?=$r['view']['results'][$i]['name']?><?=$r['view']['results'][$i]['title']?></div>
			</a>
			<? if ((($i+1)%4==0) or (($i+1) == count($r['view']['results']))): ?></div><? endif ?>
		<? endfor ?>

		<!-- PAGINATION -->
		<hr>
		<ul class="pagination justify-content-center">
			<? if ($r['view']['page'] != 1): ?>
				<li class="page-item">
					<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('p')?>&p=<?=$r['view']['page']-1?>" class="page-link">
						<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>
					</a>
				</li>
				<li class="page-item"><a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('p')?>" class="page-link">1</a></li>
				<li class="page-item disabled"><span class="page-link">...</span></li>
			<? endif ?>
			<li class="page-item active"><span class="page-link"><?=$r['view']['page']?></span></li>
			<form action="" method="post" class="page-item">
				<input class="page-link text-center" name="p" placeholder="..." style="max-width: 52px">
			</form>
			<? if ($r['view']['page'] != $r['view']['total_pages']): ?>
				<li class="page-item"><a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('p')?>&p=<?=$r['view']['total_pages']?>" class="page-link"><?=$r['view']['total_pages']?></a></li>
				<li class="page-item">
					<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('p')?>&p=<?=$r['view']['page']+1?>" class="page-link">
						<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>
					</a>
				</li>
			<? endif ?>
		</ul>
		<!-- <pre><? print_r($r['view']) ?></pre> -->
	</div>
	<!-- FILTER MENU -->
	<div class="col-lg-3">
		
	<!-- 	<div class="card mb-3">
			<nav class="list-group list-group-flush">
				<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('year')?>&year=2018" class="list-group-item list-group-item-action btn-sm md-grad text-white"><i class="fa fa-calendar-alt"></i> Новинки 2018</a>
			</nav>
		</div> -->

		<div class="card mb-3 md-border-none">
			<div class="card-header md-first text-uppercase transparent"><i class="fa fa-filter"></i> <?=$l['sorting']?></div>
			<nav class="list-group list-group-flush">
				<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('desc')?>" class="list-group-item list-group-item-action btn-sm <?=((!isset($_GET['desc'])) or ($_GET['desc']=='popularity'))?'md-active':''?>"><i class="fa fa-fw fa-fire"></i> <?=$l['by_pop']?></a>
				<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('desc')?>&desc=vote_average" class="list-group-item list-group-item-action btn-sm <?=($_GET['desc']=='vote_average')?'md-active':''?>"><i class="far fa-fw fa-star"></i> <?=$l['by_rank']?></a>
				<? if ($url[3] == 'movie'): ?>
					<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('desc')?>&desc=primary_release_date" class="list-group-item list-group-item-action btn-sm <?=($_GET['desc']=='primary_release_date')?'md-active':''?>"><i class="far fa-fw fa-calendar-alt"></i> <?=$l['by_release']?></a>
				<? else: ?>
					<a href="/<?=$l['l']?>/view/<?=$r['media_type']?>/?<?=get_query('desc')?>&desc=first_air_date" class="list-group-item list-group-item-action btn-sm <?=($_GET['desc']=='first_air_date')?'md-active':''?>"><i class="far fa-fw fa-calendar-alt"></i> <?=$l['by_release']?></a>
				<? endif ?>
			</nav>
		</div>
<!-- 
		<form class="card mb-3" action="<?=$r['a']?>" method="get">
			<nav class="list-group list-group-flush">
				<label class="list-group-item btn-sm list-group-item-action">
					<input type="checkbox" name="status" value="released"> <?=$l['lang']?>
				</label>
				<label class="list-group-item btn-sm list-group-item-action">
					<input type="checkbox" name="status" value="released"> <?=$l['lang']?>
				</label>
				<label class="list-group-item btn-sm list-group-item-action">
					<input type="checkbox" name="status" value="released"> <?=$l['lang']?>
				</label>
			</nav>
		</form>
 -->
		<div id="accordion">
			<form class="card mb-3" method="post">
				<div class="card-header" id="headGenres">
					<div class="btn-group w-100">
						<span class="btn btn-link collapsed w-100 text-left p-2" data-toggle="collapse" data-target="#colGenres" aria-expanded="true" aria-controls="colGenres"><?=$l['genre']?></span>
						<button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
					</div>
				</div>
				<div id="colGenres" class="collapse" aria-labelledby="headGenres" data-parent="#accordion">
					<nav class="list-group list-group-flush">
						<? for ($i=0; $i < count($r['genres']['genres']); $i++): ?>
							<? if ($r['genres']['genres'][$i]['id'] != 16): ?>
								<label class="list-group-item list-group-item-action">
									<? if ($r['genres']['genres'][$i]['id'] == $_GET['genre']): ?>
										<input type="checkbox" name="genre[]" value="<?=$r['genres']['genres'][$i]['id']?>" checked> 
									<? else: ?>
										<input type="checkbox" name="genre[]" value="<?=$r['genres']['genres'][$i]['id']?>"> 
									<? endif ?>
									<?=mb_str($r['genres']['genres'][$i]['name'])?>
								</label>
							<? endif ?>
						<? endfor ?>
					</nav>
				</div>
			</form>
		</div>
	</div>
<? endif ?>