<?php

session_start();
if(isset($_SESSION['user'])){    
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',0,"/");
    }
    session_write_close();
    session_destroy();
}
$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIRS RPP Office Assistant App</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css3/bootstrap.min.css">
  <link rel="stylesheet" href="front.css">

  <style>
    #cit {
      background-color: transparent;
      color: #fff;
      border: 1px solid #fff;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      font-size: 15px;
      font-weight: thin;
    }

    #cit:hover {
      background-color: rgba(252, 249, 249, 0.5);
      color: #000;
    }

    .panel {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #666;
      background-color: rgba(249, 244, 245, 0.3);
    }

    /* .space{

  width: 100%;
  height: 30px;
} */
  </style>
</head>

<body>
  <!-- <body onload="getDaycolor()"> -->


  <div class="jumbotron text-center" id="jumbotron">

    <br>
    <h1 id="shout">RPP Office Assistant<sup>&reg;</sup></h1>
    <p>Tax Return Processing and Assessment Management System</p>
    <p>&nbsp;</p>


    <p>
      <div class="btn-group" role="group">
        <a id="cit" href="signup" class="btn btn-default"><i class="glyphicon glyphicon-user"></i> &nbsp; Register New Account</a>
        <a id="cit" href="http://192.168.0.100/rpptraining" class="btn btn-default">Visit Training Site &nbsp;<i class="glyphicon glyphicon-share"></i></a>
      </div>
    </p>
    <sup>version 2.5.1</sup>
  </div>
  <div class="row" id="logo">
    <a href=""><img id="pic" src="img/lizardlogo.png" alt=""></a>
  </div>

  <div class="container">
    <div class="row">
      <div class="panel panel-default col-sm-4">
        <h3 class="">Tax Returns</h3>
        <p>All processes and Procedures.</p>
        <p class="panel-content">The Application enables users to recieve and Register Accounts filed by Taxpayers.
          It uniquely groups the Accounts into all applicable Registers used in the Department.
          Advance searches and report generation is flexible and easy to do. It gives you
          Full control and Manages all the Records.</p>
      </div>
      <div class="col-sm-1"></div>
      <div class="panel panel-default col-sm-4">
        <h3 class="">Assessment Management</h3>
        <p>All types of Assessments</p>
        <p class="panel-content">The System generates Assessment Numbers for all applicable Tax Types,
          Its highly customizable to suit your Assessment formats and unique to every office.
          Maintains all categories of Assessment Registers.
          Advance searches and report generation is flexible and easy to do and Manages all the Records.</p>
      </div>

    </div>
  </div>
  <!-- form comes here -->
  <div class="container">
    <div class="forms">

      <form method="POST" action="process_login ">
        <br>
        <div class="box">
          <a href="modfile2">
            <img id="" src="img/logo.png" alt="" />
          </a>
        </div> <br>
        <div class="box1">
          <label for="inputEmail3">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>

        <div class="box2">
          <label for="inputPassword3">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="box3">
          <font color="#FF0000"><?php echo  $errormsg; ?></font>
        </div> <br>
        <div class="box4">
          Don't have an Account? <a href="signup ">Create Account</a>
        </div>
        <div class="box5">
          <button type="submit" class="button" id="sub"><span> Login </span></button>
        </div>

      </form>
    </div>

  </div>

  <div class="space"></div>

  <footer class="text-center"><span id="footy">Copyright © 2018-<?php echo date('Y'); ?> Designed by Damidami Tony, Sunday IR 20956, Tel: 07061823474</span>
  </footer>
  <script src="js3/jquery-1.12.0.min.js"></script>

</body>

</html>