<?php

require_once '../base.php';
require_once 'validation.php';
 $domain=$_SESSION['domain'];
 $list= gLogic::GetAllCategoriesByDomain($domain);

?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Active</th>
    <th>Date</th>
    <th><a href="new_category.php"><h3>New</h3></a></th>
  </tr>
  </thead>
  <tbody>
  	<form name="myform">
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->name; ?></td>
    <td><?php echo $object->active ; ?></td>
    <td><?php echo $object->date ; ?></td>
    <td><a href="edit_category.php?id=<?php echo $object->id ; ?>">edit</a>
    	<a href="remove_category.php?id=<?php echo $object->id ; ?>">remove</a>
	</td>
  </tr>
  	<?php }?>
  	</form>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>
