<?php
require_once '../base.php';
require_once 'validation.php';
 $domain=$_SESSION['domain'];
 $list= gLogic::GetAllSourcesByDomain($domain);
 //var_dump($list);

?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>Topic</th>
    <th>Feed</th>
    <th>Link</th>
    <th>Date</th>
    <th><a href="source_new.php?domain=<?php echo $domain ;?>"><h3>New</h3></a></th>
  </tr>
  </thead>
  <tbody>
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->topic; ?></td>
    <td><?php echo $object->feed ; ?></td>
    <td><a href="http://<?php echo $object->link ; ?>"> <?php echo $object->link ; ?> </a></td>
    <td><?php echo $object->date ; ?></td>
    <td><a href="source_edit.php?id=<?php echo $object->id ; ?>">edit</a>
    	<a href="source_remove.php?id=<?php echo $object->id ; ?>">remove</a>
	</td>
  </tr>
  	<?php }?>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>


