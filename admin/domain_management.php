<div class="Domain">

<?php
require_once '../base.php';
require_once 'validation.php';
echo gLogic::ShowManagement($_SESSION['domain']);
if ($_SESSION['level']==10)
{
	?> 
	<table>
	<tr>
		<td align="center" width="40%"><a href="suggestion-management.php"> <h1> Suggestion </h1></a> </td>
		<td align="center" width="40%"><a href="subscription-management.php"> <h1> Subscription </h1></a> </td>
		<td align="center" width="40%"><a href="pub-management.php"> <h1> Pub </h1></a> </td>
	</tr>
	</table>
	<br />
	<a href="user-management.php">User Admin</a>    
	<br /> 
	<br />
	<a href="logout.php"><h3>logout</h3></a> 
	<?php
	
}
?>
	
</div>
