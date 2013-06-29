<?php
require_once '../base.php';
require_once 'validation.php';
 $domain=$_SESSION['domain'];
if ($_POST)
{
	//var_dump($_POST);
	$object= new User();
	$object->firstname="{$_POST['firstname']}";
	$object->lastname="{$_POST['lastname']}";
	$object->pin=$_POST['pin'];
	$object->password="{$_POST['password']}";
	$object->email="{$_POST['email']}";
	$object->phone="{$_POST['phone']}";
	$object->profile_id= 2;
	$return = gLogic::SaveUser($object);
	echo "gravado com sucesso";
	//var_dump($return);
	?><br/><br /> <a href="user-management.php">User Management</a>  <?php
}
else 
{
?>
<form action="" method="post">
Firstname: <input type="text" name="firstname" /> <br />
Lastname: <input type="text" name="lastname" /> <br />
Pin: <input type="password" name="pin" /> <br />
Password: <input type="password" name="password" /> <br />
Email: <textarea name="email" > </textarea> <br />
Phone: <textarea name="phone" > </textarea> <br />
<input type="submit" />
</form>
<?php }?>
