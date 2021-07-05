<?php
	require_once  'config/database_functions.php';
	session_start();
  $username = $_SESSION['username'];
	$no_of_tasks=countTasks($username);
include 'includes/header.php';
?>

<h5>This is a todo list app</h5>
<?php
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
 ?>
 <h3>The current number of pending Tasks is <?php print_r ($no_of_tasks); } ?> </h3>
 <a  class="btn btn-primary" href="index.php">Add new task</a>
<a  class="btn btn-secondary ml-2" href="view.php">View all tasks </a>
</div>
</body>
