<?php
require_once '../base.php';
require_once 'validation.php';
//$domain=$_SESSION['domain'];;
if ($_POST)
{
	//var_dump($_POST);
	$object= new advertiser();
	$object->username="{$_POST['username']}";
	$object->password="{$_POST['password']}";
	$object->expire="";
	$object->preadvertiser_id=$_POST['preadvertiser'];
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
	
?>
<form action="" method="post">
Username: <input type="text" name="username" /> <br />
Password: <input type="text" name="password" /> <br />
<input type="hidden" name="preadvertiser" value="<?php echo $preID ?>" />
<input type="submit" />
</form>
<?php }?>
