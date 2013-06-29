<?php
require_once '../base.php';
require_once 'validation.php';
$domain= 1 ; //$_SESSION['domain'];
if ($_POST)
{
	//var_dump($_POST);
	$object= new Pub();
	$object->filename="{$_POST['topic']}";
	$object->domain=$domain;
	$object->pubtype_id=$_POST['pubtype'];
	$object->preadvertiser_id=$_POST['preadvertiser'];
	$object->domain_id=$domain;
	$return = gLogic::SavePub($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="pub-management.php">PUB Management</a>  <?php
}
else 
{
	$test = gLogic::GetPub($_GET['id']);
	//var_dump($test);
	if ($test == NULL)
	{
	?>
	<form action="" method="post">
	Filename: <input type="text" name="topic" /> <br />
	<input type="hidden" name="pubtype" value="<?php echo $_GET['pubtype'] ?>"/> <br />
	<input type="hidden" name="preadvertiser" value=" <?php echo $_GET['id'] ?> " /> <br />
	<input type="submit" />
	</form>
	<?php }
	else
	{ echo "Alredyalready exist";?>
	<br/><br /> <a href="pub-management.php">PUB Management</a>
<?php }?>
<?php }?>
