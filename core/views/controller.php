	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
        
       <? if ($sidebar == true): ?>       
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=url::internal('home','index')?>">AkroCRM</a>
        </div>
        
        <? endif; ?>           
        
        
        <div id="navbar" class="navbar-collapse collapse">
           <? if ($sidebar == true): ?>
         	 <ul class="nav navbar-nav navbar-right">s   

		       <?foreach ($topLinks as $module) : ?>
			        <li><a href="<?=url::internal($module,'index')?>"><?=ucfirst($module)?></a></li>
		       <? endforeach; ?>
       				<li><a href="<?=url::internal('users','logout')?>">Deconnection</a></li>
         	 </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
          <? endif; ?>           
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row" style="margin-top: 20px;">
      
      	<? if ($sidebar == true): ?>
          	<div class="col-md-3 navbar-fixed-top" style="margin-top: 40px;" >
    		 	<?=$left?>
    		 </div>
      
             <div class="col-md-3">
    		 </div>
      
    		 <div class="col-md-9">
				<?=$right?>
    		 </div>
    	<? else: ?>
    		 <div class="col-md-12">
				<?=$middle?>
    		 </div>
    	<? endif; ?>
      </div>
    </div>

 

