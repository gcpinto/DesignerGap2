<?php

require_once '../base.php';
require_once 'validation.php';
 //$domain=$_SESSION['domain'];
 $list= gLogic::GetAllPreadvertiser();
 //var_dump($list);

?>
<table border="5">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Reference</th>
    <th>Total</th>
    <th>State</th>
    <th>Date</th>
    <th><a href="preadvertiser_new.php"><h3>New</h3></a></th>
    <th>Filename of PUB</th>
    <th>Advertiser Action</th>
  </tr>
  </thead>
  <tbody>
  	<?php  foreach ($list as $object)	{ ?>
  <tr>
    <td><?php echo $object->id ; ?> </td>
    <td><?php echo $object->name; ?></td>
    <td><?php echo $object->email ; ?></td>
    <td><?php echo $object->phone ; ?></td>
    <td><?php echo $object->reference ; ?></td>
    <td><?php echo $object->total; ?></td>
    <td><?php echo $object->state ; ?></td>
    <td><?php echo $object->date ; ?></td>
    <td><a href="preadvertiser_edit.php?id=<?php echo $object->id ; ?>">Edit</a>
    	<a href="preadvertiser_remove.php?id=<?php echo $object->id ; ?>">Remove</a>
	</td>
	<td>
		<?php $pub= gLogic::GetPubFilename($object->id);
		if ($pub != null)
		{
			echo $pub->filename; ?>
			<a href="pub_remove.php?id=<?php echo $pub->id ; ?>">Delete</a>
		<?php }	else {?>	
			<a href="pub_new.php?id=<?php echo $object->id;?>&pubtype=<?php echo $object->pubtype_id;?>">Add Pub</a>
		<?php } ?>
	</td>
	<td>
		<?php  
		  $advertiser = gLogic::GetAdvertiserBy($object->id);
		 // var_dump($advertiser);
		  if ($advertiser==NULL) {?> 
		  	<a href="advertiser_new.php?preID=<?php echo $object->id ;?>">New</a>
		  	<?php }
		  else  {		?>
		<a href="advertiser_edit.php?preID=<?php echo $advertiser->id ; ?>&id=<?php echo $advertiser->id;?>">EDIT</a>
		<a href="advertiser_remove.php?id=<?php echo $advertiser->id ; ?>">REMOVE</a>
		<?php }?>
	</td>
  </tr>
  	<?php }?>
  </tbody>
</table>
<a href="domain_management.php"> Management </a>

