<div class="page-header">
	<h2>
		<?=$mainmodule?>
	</h2>
</div>

<form method="post" action="<?=url::internal($this->getModule(),'index', null, '&start='.$start)?>">
	<p class="text-right">
		<button type="submit" name="commande" value="prev" class="btn btn-default glyphicon glyphicon-chevron-left btn-xs"></button>
		<button type="button" class="btn btn-default glyphicon btn-xs disabled"><?=$start?>/<?=$total?></button>
		<button type="submit" name="commande" value="next" class="btn btn-default glyphicon glyphicon-chevron-right btn-xs"></button>
	</p>
</form>

<?=$list ?>
