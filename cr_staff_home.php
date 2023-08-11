<?php
 $errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
   $user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FIRS Central Registry App</title>
<style type="text/css">
<!--
.style5 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style6 {
	color: #006600;
	font-weight: bold;
}
-->
-->
button, .button {
	  -webkit-appearance: none;
	  -moz-appearance: none;
	  border-radius: 2;
	  border-style: solid;
	  border-width: 0;
	  cursor: pointer;
	  font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	  font-weight: normal;
	  line-height: normal;
	  margin: 0 0 1.25rem;
	  position: relative;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  padding: 0.3rem 1.2rem 0.4625rem 1.5rem;
	  font-size: 1rem;
	  background-color: #033;
	  border-color: #007095;
	  color: #FFFFFF;
	  transition: background-color 300ms ease-out; 
	}
	button:hover, button:focus, .button:hover, .button:focus {
	  background-color: #033; 
	}
	button:hover, button:focus, .button:hover, .button:focus {
	  color: #FFFFFF; }
	button.secondary, .button.secondary {
	  background-color: #033;
	  border-color: #b9b9b9;
	  color: #333333; }
	button.secondary:hover, button.secondary:focus, .button.secondary:hover, .button.secondary:focus {
	  background-color: #b9b9b9; }
	button.secondary:hover, button.secondary:focus, .button.secondary:hover, .button.secondary:focus {
	  color: #333333; }
	button.success, .button.success {
	  background-color: #43AC6A;
	  border-color: #368a55;
	  color: #FFFFFF; }
    button.success:hover, button.success:focus, .button.success:hover, .button.success:focus {
      background-color: #368a55; }
    button.success:hover, button.success:focus, .button.success:hover, .button.success:focus {
      color: #FFFFFF; }
	  
	input[type="text"], input[type="password"], input[type="date"], input[type="datetime"], input[type="datetime-local"], input[type="month"], input[type="week"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"], input[type="time"], input[type="url"], input[type="color"], textarea {
	  -webkit-appearance: none;
	  -moz-appearance: none;
	  border-radius: 0;
	  background-color: #FFFFFF;
	  border-style: solid;
	  border-width: 1px;
	  border-color: #cccccc;
	  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	  color: rgba(0, 0, 0, 0.75);
	  display: block;
	  font-family: inherit;
	  font-size: 0.875rem;
	  height: 2.1125rem;
	  margin: 0.5rem 0 0.5rem 0;
	  padding: 0.5rem;
	  width: 95%;
	  -webkit-box-sizing: border-box;
	  -moz-box-sizing: border-box;
	  box-sizing: border-box;
	  -webkit-transition: border-color 0.15s linear, background 0.15s linear;
	  -moz-transition: border-color 0.15s linear, background 0.15s linear;
	  -ms-transition: border-color 0.15s linear, background 0.15s linear;
	  -o-transition: border-color 0.15s linear, background 0.15s linear;
	  transition: border-color 0.15s linear, background 0.15s linear; }
	input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="color"]:focus, textarea:focus {
	  background: #fafafa;
	  border-color: #999999;
	  outline: none; 
	  }
</style>
</head>

<body>
<p>&nbsp;</p>
<div align="center">
	<div align="center">
		<table border="1" width="986" cellspacing="0" cellpadding="0" 
  bordercolor="#808080" height="339" bgcolor="#FFFFFF">
			<tr>
				<td valign="top">
	<div align="center">
		<table border="0" width="930" cellspacing="0" cellpadding="0" 
  height="156">
			<tr>
				<td width="138">
				<p align="center"><img border="0" 
    src="images/out_going_reg.png" width="173" height="139"></td>
				<td width="304">
				<p align="center"><b><font face="Verdana" color="#000080">&nbsp;<a 
    href="outgoing "><input type="submit" value="Outgoing File Register" name="B1" class="button success"></a></font></b><font face="Calibri" color="#808080"><br>
				Register out going Files </font></td>
				<td width="4">&nbsp;</td>
				<td width="156">
				<p align="center"><img border="0" 
    src="images/in_coming_reg.png" width="158" height="139"></td>
				<td>
				<p align="center"><b><font face="Verdana" color="#000080">&nbsp;<a 
    href="incoming "><input type="submit" value="Incoming File Register" name="B1" class="button success"></a></font></b><font face="Calibri" color="#808080"><br>
				Register Returned Files </font></td>
			</tr>
		</table>
		<div align="center">
			<table border="0" width="930" cellspacing="0" cellpadding="0" 
   height="174">
				<tr>
					<td width="138" height="137"><img border="0" 
     src="images/search_records.png" width="173" height="132"></td>
					<td width="304" height="137">
					<p align="center"><b><font face="Verdana" color="#000080">
					<a href="search_home "><input type="submit" value="Search For File" name="B1" class="button success"></a><br>
					</font></b><font face="Calibri" color="#808080">This allows 
					you to search for Files using various criteria's</font><b><font 
     face="Verdana" color="#000080"> </font></b></td>
					<td width="4" height="137">&nbsp;</td>
					<td width="106" height="137"><img border="0" 
     src="images/view_reports.png" width="160" height="96"></td>
					<td height="137">
					<p align="center"><font face="Verdana" color="#000080"><b>
					<a href="report_home "><input type="submit" value="View Reports" name="B1" class="button success"></a><br>
					</b></font><font face="Calibri" color="#808080">Generate 
					specific Reports using various criteria's</font></td>
				</tr>
				<tr>
					<td width="138">&nbsp;</td>
					<td width="304">&nbsp;</td>
					<td width="4">&nbsp;</td>
					<td width="106">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>
	</div>
				</td>
			</tr>
		</table>
	</div>
	<p align="center"><br>
	&nbsp;</div>
</body>
</html>
