<div class="container">Welcome <?php echo $username?>. You are logged in as "BUSINESS ACCOUNT USER"<br>
<style>
b.pos_right
{
	position:relative;
	left:20px;
}
</style>
<?php 
if ($business==false){
  ?>You are not a business account user<?php
  exit(0);
}
?>
<script>
</script>

<div class="frame">
  <h1>POS Payment Options</h1><br>
	<form action="BusinessHome" method="post">
		<b class="pos_right"><?php echo "Card Number: "?><input type="text" name="card_num"></b><br><br>
		<b class="pos_right"><?php echo "Total Amount: "?><input type="text" name="tot_amount"></b><br><br>
		<b class="pos_right"><?php echo "Installment Amount: "?>
			<select name="installment">
			  <option value="3mon">3 Months</option>
			  <option value="6mon">6 Months</option>
			  <option value="9mon">9 Months</option>
			  <option value="11mon">11 Months</option>
			</select>
		</b><br><br>
		<b class="pos_right"><input name="submit" type="submit" value="Accept"></b><br><br>
		
	</form>
</div>
</div>