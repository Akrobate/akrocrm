<div class="table-responsive">
  <table class="table">
	<th>
		<? if(isset($datas[0])): ?>
			<? foreach(@$datas[0] as $k => $f): ?>
				<td>
					<?=$k?>
				</td>
			<? endforeach; ?>
		<? endif; ?>
	</th>
	
	<? foreach(@$datas as $data): ?>
		<tr>
			<? foreach(@$data as $field): ?>
				<td>
					<?=$field?>
				</td>
			<? endforeach; ?>
			
			<td>			
				<a class="glyphicon glyphicon-eye-open" href="<?=url::internal($this->getModule(),'view', $data['id'])?>" ></a>
				<a class="glyphicon glyphicon-edit" href="<?=url::internal($this->getModule(),'edit', $data['id'])?>" type="button" class="btn btn-default" ></a>
				<a class="glyphicon glyphicon-remove" href="<?=url::internal($this->getModule(),'delete', $data['id'])?>" type="button" class="btn btn-default" ></a>
			</td>		
		</tr>
	<? endforeach; ?>

  </table>
</div>
