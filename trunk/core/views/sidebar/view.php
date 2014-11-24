<div class="page-header">
	<h2>
		<?=$content?>
	</h2>
</div>

<? foreach($moduleslist as $module) : ?>
	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<a href="<?=url::internal($module, 'index')?>" type="button" class="btn btn-default btn-lg btn-block">
					<?=$module?>
				</a>
			</div>
		</div>
	</div>
<? endforeach; ?>

	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<a href="<?=url::internal('users', 'index')?>" type="button" class="btn btn-default btn-lg btn-block">
					Utilisateurs
				</a>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<a href="<?=url::internal('profiles', 'index')?>" type="button" class="btn btn-default btn-lg btn-block">
					Les profils
				</a>
			</div>
		</div>
	</div>
	
	
	<? if(users::isConnected() && users::issetId()): ?>
	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<a href="<?=url::internal('users', 'edit', users::getId())?>" type="button" class="btn btn-default btn-lg btn-block">
					Mon profil
				</a>
			</div>
		</div>
	</div>
	
	
	
	<? endif; ?>
	
