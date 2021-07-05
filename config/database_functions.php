<?php
require_once("db_connect.php");

function addtask($username){
  if(ISSET($_POST['submit'])){
    $task = $_POST['task'];
    db();
    global $dbc;
    $query="INSERT INTO `todo` VALUES('', '$task', now(), '".$username."', '')";
    $insertTodo =mysqli_query($dbc, $query);
    if ($insertTodo) {
      echo "success";
    }
    else{
      echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
  }
}

function fetchTaskLists($username){
  db();
  global $dbc;
  $query = "SELECT id, task ,date, done FROM todo WHERE username = '".$username."' ";
  $result = mysqli_query($dbc, $query);
  $tasks = [];
  //check if there’s any data inside the table
  if(mysqli_num_rows($result) >= 1){
    while($row = mysqli_fetch_assoc($result)){
      $tasks[] = $row;
    }
  }
  return $tasks;
}

function countTasks($username){
  db();
  global $dbc;
  $query = "SELECT task FROM todo WHERE username  = '".$username."' ";
  $result = mysqli_query($dbc, $query);
  // $count;
  if(mysqli_num_rows($result)>=1){
    $count = mysqli_num_rows($result);
    return $count;
  }
  return 'No pending task';
}

function UpdateProfile($username){
  if (isset($_POST['edit'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    db();
    global $dbc;
    $sql = "UPDATE users SET firstName ='$firstname', gender='$gender', lastName='$lastname', age='$age' WHERE  username = '".$username."';";
    $result = mysqli_query($dbc, $sql);
    if ($result){
      echo "success";
    }
    else{
      echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
  }
}

function RegAuth(){
  db();
  global $dbc;
  // Define variables
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
      $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
      $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
      // Prepare a select statement
      $sql = "SELECT id FROM users WHERE username = ?";
      if($stmt = mysqli_prepare($dbc, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        // Set parameters
        $param_username = trim($_POST["username"]);
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          /* store result */
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            $username_err = "This username is already taken.";
          } else{
            $username = trim($_POST["username"]);
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
      }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
    } else{
      $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Please confirm password.";
    } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
      }
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
      // Prepare an insert statement
      $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

      if($stmt = mysqli_prepare($dbc, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          // Redirect to login page
          header("location: login.php");
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
      }
    }
    // Close connection
    mysqli_close($dbc);
  }
}



function LoginAuth(){
  db();
  global $dbc;
  // Initialize the session
  session_start();

  // Checking if the user is already logged in.
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: home.php");
      exit;
  }



  // Define variables and initialize with empty values
  $username = $password = "";
  $username_err = $password_err = $login_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      } else{
          $username = trim($_POST["username"]);
      }

      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      } else{
          $password = trim($_POST["password"]);
      }

      // Validate credentials
      if(empty($username_err) && empty($password_err)){
          // Prepare a select statement
          $sql = "SELECT id, username, password FROM users WHERE username = ?";

          if($stmt = mysqli_prepare($dbc, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);

              // Set parameters
              $param_username = $username;

              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Store result
                  mysqli_stmt_store_result($stmt);

                  // Check if username exists, if yes then verify password
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      // Bind result variables
                      mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                      if(mysqli_stmt_fetch($stmt)){
                          if(password_verify($password, $hashed_password)){
                              // Password is correct, so start a new session
                              session_start();

                              // Store data in session variables
                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $id;
                              $_SESSION["username"] = $username;

                              // Redirect user to welcome page
                              header("location: home.php");
                          } else{
                              // Password is not valid, display a generic error message
                              $login_err = "Invalid username or password.";
                          }
                      }
                  } else{
                      // Username doesn't exist, display a generic error message
                      $login_err = "Invalid username or password.";
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }

      // Close connection
      mysqli_close($dbc);
  }

}



function deleteTask($username)
    {
        db();
        global $dbc;
        if (isset($_GET['Delete'])) {
	      $id = $_GET['Delete'];
        $sql = "DELETE FROM todo WHERE id = ".$id." and username = '".$username."';";
        $result = mysqli_query($dbc, $sql);
        mysqli_close($dbc);
      }
    }

function updateDone()
{
    db();
    global $dbc;
    if  (isset($_GET['Done'])){
      $id = $_GET['Done'];
      $sql = "UPDATE todo SET done = '1' WHERE (id = '".$id."');";
      $result = mysqli_query($dbc, $sql);
      mysqli_close($dbc);
    }
}
