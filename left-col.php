<div id="left-col-container">
<div style="cursor:pointer" onclick="document.getElementById('new-message').style.display='block'" class="white-back">
<p align="center">New Message </p>
</div>

<?php 
$q='SELECT DISTINCT `receiver_name`,`sender_name`
FROM `messages` WHERE 
`sender_name`="'.$_SESSION['username'].'" OR
`receiver_name`="'.$_SESSION['username'].'"
ORDER BY `date_time` DESC';
$r=mysqli_query($con,$q);
if($r){
	if(mysqli_num_rows($r)>0){
		$counter=0;
		$added_user=array();
		while($row=mysqli_fetch_assoc($r)){
			$sender_name=$row['sender_name'];
			$receiver_name=$row['receiver_name'];
			
			if($_SESSION['username']==$sender_name){
				//add the receiver_name but only once
				//so to do that check the user in array
				if(in_array($receiver_name,$added_user)){
					//dont add receiver_name because
					//he is already added
				}else{
					//add the receiver_name
					?>
					<div class="grey-back">
                    <img src="images/s.jpg" class="image"/>
                    <?php echo '<a href="?user='.$receiver_name.'">'.$receiver_name.'</a>'; ?>
                    </div>
					<?php
					//as receiver_name added so
					///add it to the array as well
					$added_user=array($counter=>$receiver_name);
					//increment the counter
					$counter++;
				}
			}elseif($_SESSION['username']==$receiver_name){
				//add the sender_name but only once
				//so to do that check the user in array
				if(in_array($sender_name,$added_user)){
					//dont add sender_name because
					//he is already added
				}else{
					//add the sender_name
					?>
					<div class="grey-back">
                    <img src="images/s.jpg" class="image"/>
                    <?php echo '<a href="?user='.$sender_name.'">'.$sender_name.'</a>'; ?>
                    </div>
					<?php
					//as sender_name added so
					///add it to the array as well
					$added_user=array($counter=>$sender_name);
					//increment the counter
					$counter++;
				}
			}
			}
		}
		else{
		//no message sent
		echo 'no user';
	    }
	}else{
	//query problem
	echo $q;
}

?>



<!-- end of left-col-container -->
</div>