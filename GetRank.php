<?php
require_once 'base.php';

if ($_POST)
{
	$id=$_POST['ID'];
	//$id=intval($id);
	//var_dump($id);
	$rank = gLogic::Rank($id);
	if ($rank == Null)
	{
	 echo "Not exist";
	}
	else {
		{
		echo "Rank < ".$rank[2]." > -".$rank[1];	
		}
	}
	?> 	<br /><a href="GetRank.php"><h4>Voltar</h4></a>
		<br /><a href="links.php"><h3>HOME - LINKS</h3></a>
	<?php
}
else 
{
?>
<form action="" method="post">
RANK <input type="text" name="ID" />
<input type="submit" />
</form>
<?php }?>