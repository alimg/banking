<style>
b.pos_right
{
	position:relative;
	left:20px;
}

</style>

<h1>Corporation Information:</h1><br>

<form action="CustomerAssistantHome" method="post" >
	<b class="pos_right"><?php echo "Corp. Name: "?><input type="text" name="cName"></b><br><br>
	<b class="pos_right"><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
	<b class="pos_right"><input name="submit" type="submit" value="Submit Corp"></b><br><br>
</form>