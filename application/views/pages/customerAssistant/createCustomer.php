
<style>
b.pos_right
{
	position:relative;
	left:20px;
}
</style>

<h1>Customer Personal Information:</h1><br>

<form action="customerAssistantHome" method="post" >
	<b class="pos_right"><?php echo "First Name: "?><input type="text" name="firstName"></b>
		<b class="pos_right"><?php echo "Last Name: "?><input type="text" name="lastName"></b><br><br>
	<b class="pos_right"><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
	<b class="pos_right"><?php echo "Password: "?><input type="password" name="pass"></b><br><br>
	<b class="pos_right"><?php echo "Address: "?></b><br>
	<p class="pos_right"><textarea name="address" rows="4" cols="50"></textarea></p>
	<b class="pos_right">Birth Date: <input name="birth" type="text" id="datepicker"></b><br><br>
	<b class="pos_right"><input name="submit" type="submit" value="Submit Customer"></b><br><br>
</form>  

<script>
  $( "#datepicker" ).datepicker();
</script>
