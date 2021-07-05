<?php
	require_once  'config/database_functions.php';
	LoginAuth();
	require_once 'includes/header.php';
?>




        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-8 offset-2">
                <input type="text" name="username" class="form-control" value="">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
							</div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password</label>
								<div class="col-sm-8 offset-2">
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
							</div>
            </div>
            <div class="form-group">
							<div class="col-sm-8 offset-2">
                <input type="submit" class="btn btn-primary" value="Login">
							</div>
            </div>
            <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
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
