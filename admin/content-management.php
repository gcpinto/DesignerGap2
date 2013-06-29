<?php

require_once '../base.php';
require_once 'validation.php';
 $domain=$_SESSION['domain'];
 $list= gLogic::GetAllContent($domain);
 //var_dump($list);

?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Link</th>
    <th>Date</th>
    <th><a href="content_new.php"><h3>New</h3></a></th>
  </tr>
  </thead>
  <tbody>
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->title; ?></td>
    <td><?php echo $object->description ; ?></td>
    <td><?php echo $object->link ; ?></td>
    <td><?php echo $object->date ; ?></td>
    <td><a href="content_edit.php?id=<?php echo $object->id ; ?>">edit</a>
    	<a href="content_remove.php?id=<?php echo $object->id ; ?>">remove</a>
	</td>
  </tr>
  	<?php }?>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>

