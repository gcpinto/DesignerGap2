<?php
require_once '../base.php';
require_once 'validation.php';
 $domain=$_SESSION['domain'];
if ($_POST)
{
	//var_dump($_POST);
	$object= new Source();
	$object->topic="{$_POST['topic']}";
	$object->link="{$_POST['link']}";
	$object->feed="{$_POST['feed']}";
	$object->rank="NULL";
	$object->user_id="NULL";
	//$object->active=$_POST['active'];
	$object->domain_id=$domain;
	$return = gLogic::SaveSource($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="source-management.php">Source Management</a>  <?php
}
else 
{
?>
<form action="" method="post">
Topic: <input type="text" name="topic" /> <br />
Link: <input type="text" name="link" /> <br />
Feed: <textarea name="feed" > </textarea> <br />
<!-- <select name="active">
<option value="1"> Activo</option>
<option value="0"> Desactivo</option>
</select> <br /> -->
<input type="submit" />
</form>
<?php }?>
