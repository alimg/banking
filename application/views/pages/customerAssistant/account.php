<style>
b.pos_right
{
	position:relative;
	left:20px;
}

</style>

<h1>Personal Information:</h1><br>

<form action="customerAssistantHome" method="post" >
	<b class="pos_right"><?php echo "First Name: "?><input type="text" name="name_first"></b><br><br>
	<b class="pos_right"><?php echo "Last Name: "?><input type="text" name="name_last"></b><br><br>
	<b class="pos_right"><?php echo "Phone: "?><input type="text" name="phone"></b><br><br>
	<b class="pos_right"><?php echo "Address: "?></b><br>
	<p class="pos_right"><textarea name="address" rows="4" cols="50"></textarea></p>
	<b class="pos_right"><?php echo "New Password: "?><input type="password" name="pass"></b><br><br>
	<b class="pos_right"><?php echo "Enter New Password Again: "?><input type="password" name="pass2"></b><br><br>
	<b class="pos_right"><input name="submit" type="submit" value="Submit Info"></b><br><br>
</form>