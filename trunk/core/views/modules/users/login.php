<div class="container-fluid">
	<div class="row" style="margin-top: 80px;">
		<div class="col-md-4 col-md-offset-4">
			<form role="form" action="<?=url::internal('users','login')?>">
			  <div class="form-group">
				<label for="exampleInputEmail1">Login</label>
				<input type="text" name="login" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
			  <input type="hidden" name="action" value="login" >
			  <input type="hidden" name="controller" value="users" >
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
</div>
</div>
