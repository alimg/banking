<div class="container">Welcome<br>
<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("managerHome/"+page);
  }
 
</script>



<div class="frame">
<h2> Addition of New Employee</h2>
   <form method="post" action="managerHome/addEmployee">
		<p> Branch Name 
			<select name="employee_type">
				<option value="new_manager">Manager</option>
				<option value="new_clerk">Clerk</option>
				<option value="new_assistant">Customer Assistant</option>
			</select><br>
          
		</p>
		<p> Admin ("use for only manager employees") 
			<select name="employee_type">
				<option value="admin">Admin</option>
				<option value="not_admin">Not an admin</option>
				
			</select><br>
          
		</p>
		<p> Title ("use for only clerk employees") <input type="text" name="title" /> </p>
		<p> Name <input type="text" name="name" /> </p>
		<p> Surname <input type="text" name="surname" /> </p>
		<p> Salary <input type="text" name="salary" /> </p>
		<p> Phone Number <input type="text" name="phone_number" /> </p>
		<p> Address <input type="text" name="address" /> </p>
		<input type="submit" value="submit" name="submit" />
		<br />
	</form>

    

  <div id="sub_page">
    ..
  </div>
</div>
</div>