<?php
	require_once  'config/database_functions.php';
	session_start();
  $username = $_SESSION['username'];
  UpdateProfile($username);

include 'includes/header.php';
?>
<h1>User Profile</h1>
<div class="">
  <p>Fill out this form to edit your profile</p>
  <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <div class="form-group ">
        <label class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-8 offset-2">
        <input type="text" name="fname" class="form-control">
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-8 offset-2">
        <input type="text" name="lname" class="form-control">
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Gender</label>
        <div class="col-sm-8 offset-2">
        <select name="gender" class="form-control input-sm form-select-sm" aria-label=".form-select-sm example">
            <option selected>Open this to select gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="unknown">Unknown</option>
        </select>
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Age</label>
        <div class="col-sm-8 offset-2">
        <input type="number" name="age" class="form-control">
      </div>
    </div>
    <div class="form-group">
        <input type="submit" name="edit" class="btn btn-primary">
    </div>
  </form>

</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</body>
