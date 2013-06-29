<?php
require_once '../base.php';
require_once 'validation.php';
$domain=$_SESSION['domain'];;
if ($_POST)
{
	//var_dump($_POST);
	$object= new Content();
	$object->title="{$_POST['title']}";
	$object->source_id="{$_POST['source']}";
	$object->category_id="{$_POST['category']}";
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
	$sources = gLogic::GetAllSourcesByDomain($domain);
	$category= gLogic::GetAllCategoriesByDomain($domain);
?>
<form action="" method="post">
Title: <input type="text" name="title" /> <br />
Link: <input type="text" name="link" /> <br />
Description: <textarea name="description" > </textarea> <br />
Source:<select name="source">
	<?php foreach ($sources as $object) {?>
		
<option value="<?php echo $object->id;  ?>"> <?php echo $object->topic;  ?></option>
 <?php } ?>
</select>
<br />
Category:<select name="category">
	<?php foreach ($category as $object) {?>
		
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
