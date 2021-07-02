<?php
	require_once  'config/database_functions.php';
	session_start();
	$username = $_SESSION['username'];
	addtask($username);

include 'includes/header.php';
?>


<h1>Create Todo List</h1>

<form method="post" action="index.php">
	<div class="form-group">
		<label for="task">Task</label>
     <input name="task" class="form-control" type="text">
	</div>

 <input type="submit" name="submit" value="submit" class="btn btn-primary">
</form>
<a href="/view.php"> view list of task</a>

</form>
</head>
</html>
