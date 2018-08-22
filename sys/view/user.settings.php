<?php
	switch ($r['user']['sex']) {
		case 'mars': $m_a = 'active'; $m_ch = 'checked'; break;
		case 'venus': $v_a = 'active'; $v_ch = 'checked'; break;
		default: break;
	}
?>
<div class="col-lg-12 mt-3">
	<ul class="breadcrumb">
		<a href="/<?=$l['l']?>/" class="breadcrumb-item"><i class="fa fa-home"></i></a>
		<a href="/<?=$l['l']?>/user/<?=$_SESSION['nick']?>" class="breadcrumb-item"><?=$_SESSION['nick']?></a>
		<a href="#" class="breadcrumb-item active"><?=$l['settings']?></a>
	</ul>
	<div class="card">
		<form action="" class="card-body" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-6">
					<div class="input-group mb-2">
						<span class="input-group-addon p-2 text-light"><i class="fa fa-user"></i></span>
						<input name="nick" class="form-control" value="<?=$r['user']['nick']?>" placeholder="<?=$l['username']?>">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-addon p-2 text-light"><i class="far fa-id-card"></i></span>
						<input name="full_name" class="form-control" value="<?=$r['user']['full_name']?>" placeholder="<?=$l['full_name']?>">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-addon p-2 text-light"><i class="far fa-envelope"></i></span>
						<input name="email" type="email" class="form-control" value="<?=$r['user']['email']?>" placeholder="E-mail">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-addon p-2 text-light"><i class="fa fa-globe"></i></span>
						<input name="web_page" class="form-control" value="<?=$r['user']['web_page']?>" placeholder="WWW">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-addon p-2 text-light"><i class="fa fa-key"></i></span>
						<input name="n_pass" type="password" class="form-control" placeholder="<?=$l['n_pass']?>">

						<span class="input-group-addon p-2 text-light"><i class="fa fa-redo-alt"></i></span>
						<input name="r_pass" type="password" class="form-control" placeholder="<?=$l['r_pass']?>">
					</div>

					<div class="btn-group btn-group-toggle mt-2 p-3" data-toggle="buttons">
						<label class="btn btn-primary btn-lg md-btn-sex pl-5 pr-5 <?=$m_a?>">
							<input type="radio" name="sex" autocomplete="off" <?=$m_ch?> value="mars"> <i class="fa fa-fw fa-mars"></i>
						</label>
						<label class="btn btn-danger pink accent-2 md-btn-pink btn-lg md-btn-sex pl-5 pr-5 <?=$v_a?>">
							<input type="radio" name="sex" autocomplete="off" <?=$v_ch?> value="venus"> <i class="fa fa-fw fa-venus"></i>
						</label>
					</div>
				</div>
				<div class="col-sm-6">
					<label class="md-img-upload ml-5 mt-2 mb-4">
						<img src="/src/data/ava/<?=$r['user']['photo']?>" class="rounded-circle" style="width:150px;height:150px">
						<span><i class="fa fa-upload"></i></span>
						<input type="file" class="d-none" name="ava">
					</label>
				</div>
				<div class="col-sm-12">
					<hr>
					<div class="card-columns">
						<? foreach ($r['bgs'] as $key => $x): ?>
							<label class="card md-radio" style="background: url('/src/img/bg/<?=$x?>') repeat;">
								<div class="card-body">
									<? if ($r['user']['bg'] == $x): ?>
										<input type="radio" name="bg" value="<?=$x?>" checked>
									<? else: ?>
										<input type="radio" name="bg" value="<?=$x?>">
									<? endif ?>
									<span>&nbsp;</span>
								</div>
							</label>
						<? endforeach ?>
					</div>
					<hr>
					<button class="btn float-right ml-2 btn-success" type="submit"><i class="fa fa-check"></i> OK</button>
					<a href="/<?=$l['l']?>/user/<?=$_SESSION['nick']?>/" class="btn float-right ml-2 btn-light"><?=$l['cancel']?></a>
				</div>
			</div>
		</form>
	</div>
</div>