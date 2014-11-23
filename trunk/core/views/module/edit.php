<div class="page-header">
	<h2>
		<?=ucfirst($this->getModule())?>
	</h2>
</div>

<form method="post" action="<?=url::internal($this->getModule(),'save')?>">

	<? foreach ($fields as $field): ?>
		<?=$field?>
	<? endforeach; ?>

	<input type="hidden" name="id" value="<?=$id?>" />

  <div class="form-group">
    <div class="col-sm-10">
      <a href="<?=url::internal($this->getModule(),'view',$id)?>" type="button" class="btn btn-default">Voir</a>
      <button type="submit" class="btn btn-default">Edit</button>
      <a href="<?=url::internal($this->getModule(),'index')?>" type="button" class="btn btn-default">List</a>
      <a href="<?=url::internal($this->getModule(),'delete',$id)?>" type="button" class="btn btn-default">Supprimer</a>
    </div>
     
  </div>

</form>
