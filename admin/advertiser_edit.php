<?php
require_once '../base.php';
require_once 'validation.php';
//$domain=$_SESSION['domain'];;
if ($_POST)
{
	//var_dump($_POST);
	$object= gLogic::GetAdvertiser($_POST['id']);
	$object->password="{$_POST['password']}";
	$object->expire="";
	$object->state=0;
	$date = New DateTime();
	$object->lastlogin= $date->format('Y-m-d H:i:s');
	$return = gLogic::Saveadvertiser($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="pub-management.php">PUB Management</a>  <?php
}
else 
{
	$preID = $_GET['preID'];
	$id = $_GET['id'];
	$object = gLogic::GetAdvertiser($id);
	//var_dump($object);
?>
<form action="" method="post">
Username: <input type="text" value="<?php echo $object->username ?>" disabled="disable"/> <br />
Password: <input type="password" name="password" /> <br />
<input type="hidden" name="id" value="<?php echo $object->id; ?>" />
<input type="submit" />
</form>
<?php }?>
