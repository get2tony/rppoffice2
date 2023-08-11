<?php


  $errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;

//$errormsg= "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<title>FIRS RPP Office Assistant App</title>

<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"> 
<link rel="icon" href="img/favicon.ico" type="image/x-icon"> 
<link href="css3/bootstrap.min.css" rel="stylesheet">


</head>

<body>
<div class="jumbotron"></div>

<div align="center">
	<div align="center">
		<table  border="1" width="837" cellspacing="0" cellpadding="0" 
  bordercolor="#808080" class="table-bordered" id="mymidtab">
			<tr>
				<td>
	<table  border="0" width="833" cellspacing="0" cellpadding="0" height="350">
		<tr>
			<td width="452" valign="top" align="center" height="97">
                <div style="width: 843px">&nbsp;&nbsp;<img src="img/logo2.jpg" width="150" height="108" class="pull-left" /></div>
			<font face="Verdana" size="7" color="#000080">RPP Office Assistant</font><img src="img/applogo2.png" width="150" height="108"  class="pull-right" /><font size="6" face="Verdana" color="#C0C0C0"><br>
			Application</font><font size="6" face="Times New Roman" 
   color="#C0C0C0">&reg;</font><br >
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  <label class="label label-primary">Lite Edition version 2.0.1 </label>
   </td>
		</tr>
		<tr>
			<td width="452" valign="top" align="center"><p><font face="Calibri" color="#C0C0C0">
			</font>            
			<font face="Calibri" color="#C0C0C0">
			<table  
   height="163" border="0" align="center" cellpadding="0" cellspacing="0" class="table" style="width: 89%">
			  <tr>
			    <td align="center" >
			      <font color="#FF0000"><?php echo  $errormsg; ?></font>
			      <form method="POST" action="process_login " class=" form-horizontal col-sm-offset-3 col-sm-10">
                                                
                            <div class="form-group ">
                                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                <div class="col-xs-4">
                                  <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-xs-4">
                                  <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class=" col-sm-10">
                                  <div class="checkbox">
                                    <label>
                                      
                                    </label>
                                  </div>
                                  Don't have an Account? <a href="signup ">Create Account</a>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class=" col-sm-10">
                                  <button type="submit" class="btn btn-primary">Log in</button>
                                </div>
                              </div>
			        
			        </form>
			      </td>
			    </tr>
			  </table>
			</font></td>
		</tr>
	</table>
				</td>
			</tr>
		</table>
	</div>
	<p></p>
	<div align="center"> Copyright© 2018-<?php echo date('Y');?> Designed by Damidami Tony, Sunday IR 20956, Tel: 07061823474  </div>
    </div>
<script src="js/jquery-1.12.4.js"></script>
     <script src="js/bootstrap.min.js"></script>
</body>
</html>
