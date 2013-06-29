<?php
require_once '../base.php';
require_once 'validation.php';
if ($_POST)
{
	$object= gLogic::GetContent($_POST['id']);
	$object->title="{$_POST['title']}";
	$object->link="{$_POST['link']}";
	$object->description="{$_POST['description']}";
	$object->active=$_POST['active']; 
	$return = gLogic::SaveContent($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="content-management.php">Content Management</a>  <?php
}
else 
{
	$id = $_GET['id'];
	$list = gLogic::GetContent($id);
?>
<form action="" method="post">
ID:  <?php echo $list->id;  ?><br />
Title: <input type="text" name="title" value="<?php echo $list->title  ?>"/> <br />
Link: <input type="text" name="link" value="<?php echo $list->link  ?>"/> <br />
Description: <textarea name="description" > <?php echo $list->description;  ?></textarea> <br />
<select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br />
<input type="hidden"  name="id" value="<?php echo $list->id;  ?>"/>
<input type="submit" />
</form>
<?php }?>
