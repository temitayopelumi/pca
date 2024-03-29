

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Todo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <style>
          body{ font: 14px sans-serif; text-align: center; }

      </style>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php
              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
             ?>
             <a class="nav-item nav-link active" href="home.php">Home <span class="sr-only">(current)</span></a>
             <a class="nav-item  nav-link" href="index.php">Add task</a>
             <a class="nav-item nav-link" href="logout.php">Sign out</a>

            <?php
          }
          else {

             ?>

             <a class="nav-item nav-link" href="login.php">Login</a>
             <a class="nav-item nav-link" href="registration.php">Sign up</a>

            <?php
          }
             ?>

          </div>
        </div>
      </nav>
      <br>
      <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <div class="card-body p-4 p-md-5">
        
