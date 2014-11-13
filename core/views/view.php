<? foreach ($fields as $field): ?>
	<?=$field?>
<? endforeach; ?>



  <div class="form-group">
    <div class="col-sm-10">

      <a href="<?=url::internal($this->getModule(),'index')?>" type="button" class="btn btn-default">List</a>
    </div>
     
