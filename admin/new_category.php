<?php
require_once '../base.php';
require_once 'validation.php';

if ($_POST)
{
	//var_dump($_POST);
	$object= new Category();
	$object->name="{$_POST['name']}";
	$object->description="{$_POST['description']}";
	$object->domain_id=$_POST['domain']; 
	$object->active=$_POST['active']; 
	//var_dump($object);
	$return = gLogic::SaveCategory($object);
	//var_dump($return);
	echo "Adicionado com sucesso";
	?><br/><br /> <a href="category-management.php">Category Management</a>  <?php
}
else 
{
	$domains = gLogic::GetAllDomains();
?>
<form action="" method="post">
Name: <input type="text" name="name" /> <br />
Description: <textarea name="description" > </textarea> <br />
<select name="domain">
	<?php foreach ($domains as $object) {?>
		
<option value="<?php echo $object->id;  ?>"> <?php echo $object->name;  ?></option>
 <?php } ?>
</select>
 <br />
<select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br />
<input type="submit" />
</form>
<?php }?>
