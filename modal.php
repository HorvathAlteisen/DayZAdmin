<div id="SignUp" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Sign Up</h3>
					</div>
					<div class="modal-body">
						<form class="form-horizontal">
							<div class="well well-lg">
							<div class="form-group">
								<label class="control-label col-sm-2" for="Username">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control input-lg" id="Username" placeholder="John Doe">
								</div>								
							</div>
							</div>
							<div class="well well-lg">
								<div class="form-group">
									<label class="control-label col-sm-2" for="Email" data-toggle="collapse" data-target="ConfirmEmail">Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control input-lg" id="Email" placeholder="john@doe.com">
									</div>								
								</div>
								<div id="ConfirmEmail" class="collapse form-group">
									<label class="control-label col-sm-2" for="ConfirmEmailInput">Confirm Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control input-lg" id="ConfirmEmailInput" placeholder="john@doe.com">
									</div>							
								</div>
							</div>
							<div class="well well-lg">
								<div class="form-group">
									<label class="control-label col-sm-2" for="Password">Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control input-lg" id="Password" placeholder="password">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="ConfirmPassword">Confirm Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control input-lg" id="ConfirmPassword" placeholder="password">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-primary btn-lg" data-dismiss="modal">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
		<div id="Login" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Login</h3>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="Email">E-mail address</label>
								<input type="email" class="form-control input-lg" id="Email" placeholder="john@doe.com">
							</div>
							<div class="form-group">
								<label for="Password">Password</label>
								<input type="password" class="form-control input-lg" id="Password" placeholder="Password">
							</div>
							<div class="form-horizontal form-group">
								<button type="submit" class="btn btn-default btn-primary btn-lg" data-dismiss="modal">Login</button>
								<label><input type="checkbox"> Remember me</label>
							</div>
						</form>
						<div class="well">
							<ul class="list-unstyled">
								<li><a href="#">I forgot my password!</a></li>
								<li><a href="#">I forgot my e-mail address!</a></li>
								<li><a href="#">Inform yourself how to keep your account safe!</a></li>
								<li>No account yet? <a href="#">Register here!</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>