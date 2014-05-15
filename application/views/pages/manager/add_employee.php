<br>

<div class="frame">
<h2> Addition of New Employee</h2>
   <form method="post" action="managerHome/add_Employee">
		<p>Employment type 
			<select name="employee_type">
				<option value="new_manager">Manager</option>
				<option value="new_clerk">Clerk</option>
				<option value="new_assistant">Customer Assistant</option>
			</select><br>
          
		</p>
	<!--	<p> Admin ("use for only manager employees") 
			<select name="is_admin">
				<option value="admin">Admin</option>
				<option value="not_admin">Not an admin</option>
				
			</select>
          
		</p>  -->
		<p> Which branch employ this new employee?
			<select name="branch_name">
			<?php
				//print_r($branch_list);
				if($branch_list){
					foreach($branch_list as $row) {
						echo '<option value="'.$row->name.'">'.$row->name.'</option>';
					
						}
		
				}	
			?>
		</select>
		</p>
		<p> Title ("use for only clerk employees") <input type="text" name="title" /> </p>
		<p> Password for website <input type="text" name="password" /> </p>
		<p> Name <input type="text" name="name" /> </p>
		<p> Surname <input type="text" name="surname" /> </p>
		<p> Salary <input type="text" name="salary" /> </p>
		<p> Phone Number <input type="text" name="phone_number" /> </p>
		<p> Address <input type="text" name="address" /> </p>
		<input type="submit" value="submit" name="submit" />
		<br />
	</form>


</div>
</div>
