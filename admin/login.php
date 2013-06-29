<?php
require_once '../base.php';

if ($_POST)
{
	$login['email']=$_POST['email'];
	$login['pass']=$_POST['password'];
	$result = gLogic::login($login);
	if ($result)
		{
		//echo "Login Aceite";
		$user = glogic::GetProfile($login['email']);
		//var_dump($user);
		$list=glogic::GetSelectDomain($user->profile_id);	
		//var_dump($list);
		$_SESSION['list']=$list;
		header("Location: showdomain.php");
		}
	else 
		{
		echo "Password ou Email Errado";
		}
}
else { ?> 
<link type="text/css" href="../css/admin.css" rel="stylesheet" media="all">
<div class="login">
<form  action="" method="post">	<table>
		<tr><td><h1>LOGIN</h1></td></tr>
		<tr><td>Email</td><td><input type="text" name="email"/> </td></tr>
		<tr><td>Password</td><td><input type="password" name="password"/></td></tr>
		<tr><td></td><td align="right"><input type="submit" name="submit"/></td></tr>
	</table>
</form>
</div>
<?php } ?>
