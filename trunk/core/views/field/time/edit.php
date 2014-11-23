<div class="form-group">
	<label><?=$this->getLabel();?></label>
	<input 
		data-provide="timepicker"
		class="form-control timepicker" 
		name="<?=$this->getName()?>" 
		value="<?=$this->getValue()?>" />
</div>
