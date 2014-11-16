<div class="page-header">
	<h1>
		<?=$mainmodule?>
	</h1>
</div>


<? foreach ($fields as $field): ?>
	<?=$field?>
<? endforeach; ?>

<div class="form-group">
	<div class="row">
		<div class="col-sm-10">
			<a href="<?=url::internal($this->getModule(), 'edit', $id)?>" type="button" class="btn btn-default">Modifier</a>
			<a href="<?=url::internal($this->getModule(),'index')?>" type="button" class="btn btn-default">Liste</a>					
		</div>
	</div>
</div>
     
<? foreach ($sublists as $list): ?>

	<div class="page-header">
		<h3>
			<?=$list['title']?>
		</h3>
	</div>
	
	<div class="row">
		<div class="col-sm-10">
			<?=$list['content']?>
		</div>
	</div>
<? endforeach; ?>
