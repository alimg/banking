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
		<b class="pos_right"><?php echo "Search Customer Requests: "?><input type="text" name="loan"></b>
		<b class="pos_right"><input name="submit" type="submit" value="Submit Loan Request"></b>
	</div><br><br>
</form>