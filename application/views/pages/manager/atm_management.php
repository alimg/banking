<div id="sub_page">
   <h2> Addition of New ATM</h2>
   <form method="post" action="managerHome/addAtm">
		<p> Branch Name 
			<select name="branch_name">
			<?php
				print_r($branch_list);
				if($branch_list){
					foreach($branch_list as $row) {
						echo '<option value="'.$row->name.'">'.$row->name.'</option>';
					
						}
		
				}	
			?>
		</select>
		</p>
		<p> Balance <input type="text" name="balance" /> </p>
		<p> Address <input type="text" name="address" /> </p>
		<input type="submit" value="submit" name="submit" />
		<br />
	</form>

  </div>  