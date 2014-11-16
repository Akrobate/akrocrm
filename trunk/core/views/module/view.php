<? foreach ($fields as $field): ?>
	<?=$field?>
<? endforeach; ?>

<div class="form-group">
	<div class="row">
		<div class="col-sm-10">
			<a href="<?=url::internal($this->getModule(),'index')?>" type="button" class="btn btn-default">List</a>
		</div>
	</div>
</div>
     
<? foreach ($sublists as $list): ?>
	<div class="row">
		<div class="col-sm-10">
			<?=$list?>
		</div>
	</div>
<? endforeach; ?>
