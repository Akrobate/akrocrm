<div class="table-responsive">
  <table class="table">
	
	<? foreach($datas as $data): ?>
		<tr>
			<? foreach($data as $field): ?>
				<td>
					<?=$field?>
				</td>
			<? endforeach; ?>
			
			<td>			
				<a href="<?=url::internal($this->getModule(),'edit', $data['id'])?>" type="button" class="btn btn-default">Edit</a>
				<a href="<?=url::internal($this->getModule(),'view', $data['id'])?>" type="button" class="btn btn-default">View</a>
			</td>		
		</tr>
	<? endforeach; ?>

  </table>
</div>
