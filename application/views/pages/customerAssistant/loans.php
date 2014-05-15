<style>
b.pos_right
{
	position:relative;
	left:20px;
}

p.pos_right
{
	position:relative;
	left:20px;
}
</style>

<form action="CustomerAssistantHome" method="post" >
	<br><br>
	<div class="frame">
		<b class="pos_right"><?php echo "Enter Customer's First Name: "?><input type="text" name="name_first"></b><br><br>
		<b class="pos_right"><?php echo "Enter Customer's Last Name: "?><input type="text" name="name_last"></b><br><br>
		<b class="pos_right"><input name="submit" type="submit" value="Submit Loan Request"></b>
	</div><br><br>
</form>