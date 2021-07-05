<?php
	include 'config/database_functions.php';
  session_start();
  $username = $_SESSION['username'];
	$tasks = fetchTaskLists($username);
	$no_of_tasks=countTasks($username);

	updateDone();
	deleteTask($username);
  include 'includes/header.php';
?>

<table>
	<thead>
		<tr>
			<th>Tasks</th>
			<th style="width: 60px;">Done</th>
			<th style="width: 60px;">Save</th>
			<th style="width: 60px;">Delete</th>
		</tr>
	</thead>

<tbody>

<?php
for ($x = 0; $x < $no_of_tasks; $x++) {
?>
<tr>
<td>
<?php
		echo $tasks[$x]["task"];
 ?>
</td>
<td>
<?php
	if ($tasks[$x]['done'])
	{
?>
<input class="form-check-input"  type='checkbox' checked  name='check_list[]' value= <?php $tasks[$x]["id"]?> >
<?php
	}
		else
	{
?>
	<input class="form-check-input"  type='checkbox'  name='check_list[]' value= <?php $tasks[$x]["id"] ?> >
<?php
   }
 ?>
 </td>
 <td>
	 <a class="btn btn-primary" href="view.php?Done=<?php echo $tasks[$x]['id'] ?>"> Done </a>

</td>
<td>
		<a class="btn btn-danger" href="view.php?Delete=<?php echo $tasks[$x]['id'] ?>"> Delete </a>

</td>
</tr>
<?php
}
 ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</body>
