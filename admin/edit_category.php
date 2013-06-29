<?php
require_once '../base.php';
require_once 'validation.php';
if ($_POST)
{
	//var_dump($_POST);
	$object= gLogic::GetCategory($_POST['id']);
	$object->name="{$_POST['name']}";
	$object->description="{$_POST['description']}";
	$object->active=$_POST['active']; 
	$return = gLogic::SaveCategory($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="category-management.php">Category Management</a>  <?php
}
else 
{
	$id = $_GET['id'];
	$list = gLogic::GetCategory($id);
?>
<form action="" method="post">
ID:  <?php echo $list->id;  ?><br />
Name: <input type="text" name="name" value="<?php echo $list->name;  ?>"/> <br />
Description: <textarea name="description" > <?php echo $list->description;  ?></textarea> <br />
<select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br />
<input type="hidden"  name="id" value="<?php echo $list->id;  ?>"/>
<input type="submit" />
</form>
<?php }?>
