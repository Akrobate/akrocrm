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
