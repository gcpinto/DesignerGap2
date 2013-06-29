<?php
require_once 'base.php';

if ($_POST)
{
	$keyword = $_POST['keyword'];
	echo gLogic::ShowSearch($keyword);
	/*
	 if ($list==null) 
	{
		echo "A procura não retornou qualquer resultado";
	}
	else
	{
		gLogic::ShowSearch($list);
	}
	 */
}
else 
{
?>
<form action="" method="post">
Search: <input type="text" name="keyword" />
<input type="submit" />
</form>
<?php }?>
