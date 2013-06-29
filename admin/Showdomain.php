<?php
require_once '../base.php';
require_once 'validation.php';

$list=$_SESSION['list'];
?>
<div class="domain">
 <link type="text/css" href="../css/admin.css" rel="stylesheet" media="all">
   <div class="bar">
   	<table> 
   		<tr>
   		<td><a href="domain_new.php">ADD NEW DOMAIN</a></td>
		<td><a href="logout.php"><h3>logout</h3></a> </td>
		</tr>
   	</table>
	</div>
	<div class="op">
 	<table>
<?php
echo gLogic::ShowDomain($list);
?>
	</table>
	</div>
	</div>
<?php	 
?>
