<?php
	require_once  'config/database_functions.php';
	RegAuth();

	require_once 'includes/header.php';
?>


        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-8 offset-2">
	                <input type="text" name="username" class="form-control">
	                <span class="invalid-feedback"><?php echo $username_err; ?></span>
							  </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-3 control-label">Password</label>
								<div class="col-sm-8 offset-2">
                <input type="password" name="password" class="form-control">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
							</div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password</label>
								<div class="col-sm-8 offset-2">
                <input type="password" name="confirm_password" class="form-control">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
							   </div>
            </div>
            <div class="form-group">
							<div class="col-sm-8 offset-2">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
							</div>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
			</div>
		</div>
	</div>
</div>
</div>
</section>
    </div>
</body>
</html>
