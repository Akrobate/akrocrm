<p>
<strong><?=$this->getLabel()?> : </strong>

<? $width = 200; ?>

<style type="text/css"> 
	.roundedImage{     
		overflow:hidden;     
		-webkit-border-radius:<?=(int)$width/2?>px;     
		-moz-border-radius:<?=(int)$width/2?>px;     
		border-radius:<?=(int)$width/2?>px;     
		width:<?=$width?>px;     
		height:<?=$width?>px; 
		} 
</style>

<div class="roundedImage">
	<img src="<?=$this->getValue()?>" width="<?=$width?>" alt="1"/>
</div> 

</p>



