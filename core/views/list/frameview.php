<div class="page-header">
	<h2>
		<?=$mainmodule?>
	</h2>
</div>

<div class="row">

	<div class="col-md-6">
		<p class="text-left">
			<a href="<?=url::internal($this->getModule(),'edit')?>" type="button" class="btn btn-default glyphicon glyphicon glyphicon-new-window btn-xs"> Créer</a>
		<p>
		
	</div>	
	<div class="col-md-6">
		<form method="post" action="<?=url::internal($this->getModule(),'index', null)?>">
			<p class="text-right">
				<button type="submit" name="start" value="<?=$prevStart?>" class="btn btn-default glyphicon glyphicon-chevron-left btn-xs"></button>
				<button type="button" class="btn btn-default glyphicon btn-xs disabled"><?=$start?>/<?=$total?></button>
				<button type="submit" name="start" value="<?=$nextStart?>" class="btn btn-default glyphicon glyphicon-chevron-right btn-xs"></button>
			</p>
		</form>
	</div>
</div>
<? //, '&start='.$start?>
<?=$list ?>
