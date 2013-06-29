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
	//var_dump($return);
	echo "gravado com sucesso";
	/*$profile = new ProfileDomain();
	$profile->profile_id=$_SESSION['profile'];
	$profile->domain_id= $return;
	gLogic::SaveProfileDomain($profile);
	$list=glogic::GetSelectDomain($_SESSION['profile']);
	$_SESSION['list']=$list;
	 */
	header("Location: showdomain.php");	
	//var_dump($return);
}
else 
{
?>
<form action="" method="post">
CodName: <input type="text" name="codname" /> <br />
Name: <input type="text" name="name" /> <br />
URL: <input type="url" name="url" /> <br />
Domain: <input type="text" name="domain" /> <br />
<br />
<select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br />
<input type="submit" />
</form>
<?php }?>
