<?php

require_once '../base.php';
require_once 'validation.php';
 $list= gLogic::GetAllUser();
?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>LastName</th>
    <th>Phone</th>
    <th>Last Update</th>
    <th><a href="user_new.php"><h3>New</h3></a></th>
  </tr>
  </thead>
  <tbody>
  	<form name="myform">
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->firstname; ?></td>
    <td><?php echo $object->lastname; ?></td>
    <td><?php echo $object->phone; ?></td>
    <td><?php echo $object->lastupdate ; ?></td>
    <td><a href="user_edit.php?id=<?php echo $object->id ; ?>">edit</a>
    	<a href="user_remove.php?id=<?php echo $object->id ; ?>">remove</a>
	</td>
  </tr>
  	<?php }?>
  	</form>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>
