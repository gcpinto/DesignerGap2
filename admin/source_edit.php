<?php
require_once '../base.php';
require_once 'validation.php';
if ($_POST)
{
	//var_dump($_POST);
	
	$object= gLogic::GetSource($_POST['id']);
	$object->topic="{$_POST['topic']}";
	$object->link="{$_POST['link']}";
	$object->feed="{$_POST['feed']}";
	//$object->active=$_POST['active']; 
	$return = gLogic::SaveSource($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="source-management.php">Source Management</a>  <?php
}
else 
{
	$id = $_GET['id'];
	$list = gLogic::GetSource($id);
?>
<form action="" method="post">
ID:  <?php echo $list->id;  ?><br />
Title: <input type="text" name="topic" value="<?php echo $list->topic  ?>"/> <br />
Link: <input type="text" name="link" value="<?php echo $list->link  ?>"/> <br />
Description: <textarea name="feed" > <?php echo $list->feed;  ?></textarea> <br />
<!-- <select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br /> -->
<input type="hidden"  name="id" value="<?php echo $list->id;  ?>"/>

<input type="submit" />
</form>
<?php }?>
