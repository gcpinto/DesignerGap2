<?php
require_once '../base.php';
require_once 'validation.php';
//$domain=$_SESSION['domain'];;
if ($_POST)
{
	//var_dump($_POST);
	$object= gLogic::GetPreAdvertiser($_POST['id']);
	$object->name="{$_POST['name']}";
	$object->email="{$_POST['email']}";
	$object->phone="{$_POST['phone']}";
	$object->reference=$_POST['reference'];
	$object->pubtype_id=$_POST['pubtype'];
	//var_dump($object);
	$return = gLogic::SavePreadvertiser($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="pub-management.php">Pub Management</a>  <?php
}
else 
{
	$pubtypes = gLogic::GetAllpubtypes();
	$object = gLogic::GetPreadvertiser($_GET['id']);
	var_dump($object);
	
?>
<form action="" method="post">
Name: <input type="text" name="name" value="<?php echo $object->name ?>"/> <br />
Email: <input type="text" name="email" value="<?php echo $object->email ?>"/> <br />
Phone <input type="text" name="phone" value="<?php echo $object->phone ?>"/> <br />
Reference <input type="text" name="reference" value="<?php echo $object->reference ?>"/> <br />
<input type="hidden" name="id" value="<?php echo $object->id ?>" />
Total : <?php echo $object->total ?> <br />
State : <?php echo $object->state ?> <br />

Section:<select name="pubtype">
	<?php foreach ($pubtypes as $object) {?>
		
<option value="<?php echo $object->id;  ?>"> <?php echo $object->section;  ?></option>
 <?php } ?>
</select>
<input type="submit" />
</form>
<?php }?>
