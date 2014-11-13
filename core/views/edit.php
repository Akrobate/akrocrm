<form method="post" action="<?=url::internal($this->getModule(),'save')?>">

	<? //print_r($fields); ?>

	<? foreach ($fields as $field): ?>
		<?=$field?>
	<? endforeach; ?>

	<input type="hidden" name="id" value="<?=$id?>" />

  <div class="form-group">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
      <a href="<?=url::internal($this->getModule(),'index')?>" type="button" class="btn btn-default">List</a>
    </div>
     
  </div>

</form>
