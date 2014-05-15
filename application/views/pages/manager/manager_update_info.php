<div class="container"><br>
<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("managerHome/"+page);
  }
 
</script>



<div class="frame">
<h2> Update personal information</h2>
  <form method="post" action="managerHome/manager_update_info">
		<p> New password for website <input type="text" name="password" /> </p>
		<p> Name <input type="text" name="name" /> </p>
		<p> Surname <input type="text" name="surname" /> </p>
		<p> Salary <input type="text" name="salary" /> </p>
		<p> Phone Number <input type="text" name="phone_number" /> </p>
		<p> Address <input type="text" name="address" /> </p>
		<input type="submit" value="Update" name="submit" />
		<br />
	</form>

    

  <div id="sub_page">
    ..
  </div>
</div>
</div>