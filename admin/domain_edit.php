<?php
require_once '../base.php';
require_once 'validation.php';
if ($_POST)
{
	//var_dump($_POST);
	$object= new Domain();
	$object->codname="{$_POST['codname']}";
	$object->name="{$_POST['name']}";
	$object->url="{$_POST['url']}";
	$object->domain="{$_POST['domain']}";
	$object->active=$_POST['active']; 
	$return = gLogic::SaveDomain($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="showdomain.php">Show Domain</a>  <?php
}
else 
{
	$id = $_GET['id'];
	$object = gLogic::GetDomain($id);
	
?>
<form action="" method="post">
CodName: <input type="text" name="codname" value="<?php echo $object->codname ;?>"/> <br />
Name: <input type="text" name="name" value="<?php echo $object->name ;?>"/> <br />
URL: <input type="url" name="url" value="<?php echo $object->url ;?>"/> <br />
<input type="hidden" name="id" value="<?php echo $object->id ;?>"/>
Domain: <input type="text" name="domain" value="<?php echo $object->domain ;?>"/> <br />
<br />
<select name="active" value="value="<?php echo $object->activo ;?>"">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br />
<input type="submit" />
</form>
<?php }?>
