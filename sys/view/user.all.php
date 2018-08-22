<div class="col-lg-12">
	<form action="" class="mb-3 mt-3">
		<div class="input-group">
			<h4 class="input-group-prepend mr-4 pt-1 md-first"><?=$l['users']?></h4>
			<input type="text" class="form-control md-border-none blue-grey lighten-5 pl-3" placeholder="<?=$l['search']?>">
			<button class="input-group-btn btn btn-dark"><i class="fa fa-search"></i></button>
		</div>
	</form>
	<hr>
	<div class="card-columns">
		<? foreach ($r['users'] as $x): ?>
			<a href="/<?=$l['l']?>/user/<?=$x['nick']?>/" class="card p-3 pl-2">
				<span class="card-body">
					<img src="/src/data/ava/<?=$x['photo']?>" width="30" height="30" class="md-btn-round mr-2"> <?=$x['nick']?>
				</span>
			</a>
		<? endforeach ?>
	</div>
</div>