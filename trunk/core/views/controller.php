	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           
           <?foreach ($topLinks as $module) : ?>
	            <li><a href="<?=url::internal($module,'index')?>"><?=ucfirst($module)?></a></li>
           <? endforeach; ?>
           
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row" style="margin-top: 20px;">
          	<div class="col-md-3">
    		 	<?=$left?>
    		 </div>
      
    		 <div class="col-md-9">
				<?=$right?>
    		 </div>
    
      </div>
    </div>

 

