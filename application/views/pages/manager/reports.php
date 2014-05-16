<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui-1.10.4.custom.js"></script>
  <script>
	$(function() {
		$( "#accordion" ).accordion();
	});
	$('.datepick').each(function(){
		$(this).datepicker({ dateFormat: 'yy-mm-dd' });
	});
  </script>
</head>

<div id="accordion">
  <h3>Salaries of Staff Members In A Specific Branch</h3>
  <div>
	<form action="managerHome" method="post" >
		<b><?php echo "Name of the Branch: "?><input type="text" name="name"></b><br><br>
		<input type="hidden" name="rep" value="rep1">
		<b><input name="submit" type="submit" value="Submit Report"></b><br><br>
	</form>
  </div>
  <h3>Transactions of A Made By A Specific Customer Within A Time Frame</h3>
  <div>
	<form action="managerHome" method="post" >
		<b><?php echo "First Name: "?><input type="text" name="name_first"></b><br><br>
		<b><?php echo "Last Name: "?><input type="text" name="name_last"></b><br><br>
		<b>Date Start: <input name="dateStart" type="text" class="datepick" id="date_1"></b>
		<b>Date End: <input name="dateEnd" type="text" class="datepick" id="date_2"></b><br><br>
		<b>Transaction:</b>
		<input type="radio" name="trans" value="withdraw">Withdraw
		<input type="radio" name="trans" value="deposit">Deposit<br><br>
		<input type="hidden" name="rep" value="rep2">
		<b><input name="submit" type="submit" value="Submit Report"></b><br><br>
	</form>
  </div>
  <h3>Approved Cards That A Customer Has</h3>
  <div>
	<form action="managerHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<input type="hidden" name="rep" value="rep3">
		<b><input name="submit" type="submit" value="Submit Report"></b><br><br>
	</form>
  </div>
</div>
