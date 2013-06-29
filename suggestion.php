<?php
require_once 'base.php';

if ($_POST)
{
	//var_dump($_POST);
	$object= New Suggestion();
	$object->email=$_POST['email'];
	$object->title=$_POST['title'];
	$object->suggestion=$_POST['suggestion'];
	gLogic::SaveSuggestion($object);
	echo "Obrigado Pela Sua Sugestão";
	?> <br /><a href="links.php"><h3>HOME - links</h3></a> <?php
}
else 
{
?>
<form action="" method="post">
Title: <input type="text" name="title" /> <br />
Suggestion: <textarea name="suggestion" > </textarea> <br />
Email: <input type="text" name="email" /> <br />
<input type="submit" />
</form>
<?php }?>
