<?php
require_once '../base.php';
require_once 'validation.php';
//$domain=$_SESSION['domain'];;
if ($_POST)
{
	//var_dump($_POST);
	$object= new preadvertiser();
	$object->name="{$_POST['name']}";
	$object->email="{$_POST['email']}";
	$object->phone="{$_POST['phone']}";
	$object->reference=$_POST['reference'];
	$object->pubtype_id=$_POST['pubtype'];
	$object->total=0;
	$object->state=0;
	$return = gLogic::SavePreadvertiser($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="content-management.php">Content Management</a>  <?php
}
else 
{
	$pubtypes = gLogic::GetAllpubtypes();
	var_dump($pubtypes);
	
?>
<form action="" method="post">
Name: <input type="text" name="name" /> <br />
Email: <input type="text" name="email" /> <br />
Phone <input type="text" name="phone" /> <br />
Reference <input type="text" name="reference" /> <br />
Section:<select name="pubtype">
	<?php foreach ($pubtypes as $object) {?>
		
<option value="<?php echo $object->id;  ?>"> <?php echo $object->section;  ?></option>
 <?php } ?>
</select>
<input type="submit" />
</form>
<?php }?>
