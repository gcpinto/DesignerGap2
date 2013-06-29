<?php
require_once 'base.php';

if ($_POST)
{
	$email = $_POST['email'];
	$val=gLogic::CheckEmail($email);
	if ($val==1) 
	{
		echo "Email Já Existe";
	}
	else
	{
		gLogic::SaveSubscription($email);
		echo "Registado com Sucesso";
		?> <br /><a href="links.php"><h3>HOME - links</h3></a> <?php
	}
}
else 
{
?>
<form action="" method="post">
Email: <input type="text" name="email" />
<input type="submit" />
</form>
<?php }?>
