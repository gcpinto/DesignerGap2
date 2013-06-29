<?php
require_once 'base.php';

if ($_POST)
{
	$id=$_POST['ID'];
	//$id=intval($id);
	//var_dump($id);
	echo gLogic::GetNews($id);
	?> <br /><a href="GetNews.php"><h4>Voltar</h4></a>
	<br /><a href="links.php"><h3>HOME - LINKS</h3></a>
	<?php
}
else 
{
?>
<form action="" method="post">
NEWS <input type="text" name="ID" />
<input type="submit" />
</form>
<?php }?>