<div class="page-header">
	<h2>
		<?=$mainmodule?>
	</h2>
</div>

<?=$list ?>

<p class="text-right">
	<a href="<?=url::internal($this->getModule(),'index', null, '&filter='.$this->filter)?>">Voir tout</a>
</p>
