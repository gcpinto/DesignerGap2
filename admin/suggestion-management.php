<?php
require_once '../base.php';
require_once 'validation.php';
 $list= gLogic::GetAllSuggestion();
 //var_dump($list);

?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>IP</th>
    <th>Title</th>
    <th>Suggestion</th>
    <th>Email</th>
    <th>Date</th>
    <th><a href="../suggestion.php"><h3>New</h3></a></th>
  </tr>
  </thead>
  <tbody>
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->ip; ?></td>
    <td><?php echo $object->title ; ?></td>
    <td><?php echo $object->suggestion ; ?></td>
     <td><?php echo $object->email ; ?></td>
    <td><?php echo $object->date ; ?></td>
    <td>    	<a href="suggestion_remove.php?id=<?php echo $object->id ; ?>">remove</a>
	</td>
  </tr>
  	<?php }?>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>


