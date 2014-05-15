<div class="container">Welcome <?php echo $username?>. You are logged in as "CUSTOMER ASSISTANT"<br>

<?php 
if ($customerAssistant==false){
  ?>You are not a customer assistant<?php
  exit(0);
}
?>

<meta charset="utf-8">
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>
<script>
	var data, table;
	$(function() {
		$( "#dialog1" ).dialog({
			autoOpen: false,
			show: {
				effect: "scale",
				duration: 500
			},
			hide: {
				effect: "scale",
				duration: 500
		  }
		});
		$( "#dialog2" ).dialog({
			autoOpen: false,
			show: {
				effect: "scale",
				duration: 500
			},
			hide: {
				effect: "scale",
				duration: 500
		  }
		});
	});
	window.onload = function() {
		data = '<?php echo $type?>';
		
		if( data == ''){
			openPage(this,'account');
		}else if(data == 'criteria'){
			openPage(this,'cards');
			$( "#dialog1" ).dialog( "open" );
		}else if(data == 'loan'){
			openPage(this,'loans');
			$( "#dialog2" ).dialog( "open" );
		}
	}
	function openPage(e,page) {
		p = $(e).parent();
		p.parent().children().removeClass('selected');
		p.addClass('selected');
		$("#sub_page").load("customerAssistantHome/"+page);
	}
</script>

<div class="frame">
	<ul class="tabbar">
		<li><a class="tab-button" onclick="openPage(this,'account')">Home</a></li>
		<li><a class="tab-button" onclick="openPage(this,'createCustomer')">Create Customer</a></li>
		<li><a class="tab-button" onclick="openPage(this,'createCorporation')">Create Corporation</a></li>
		<li><a class="tab-button" onclick="openPage(this,'createAccount')">Create Account</a></li>
		<li><a class="tab-button" onclick="openPage(this,'cards')">Cards</a></li>
		<li><a class="tab-button" onclick="openPage(this,'loans')">Loans</a></li>
	</ul>
	<div id="sub_page">

	</div>
	<div id="dialog1" title="Card Requests:">
	  <table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>ID</th>
				<th>Card Number</th>
				<th>PIN</th>
				<th>Valid Until</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Is Approved</th>
				<th>Approve Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$list = explode("\\n", $table);
				foreach($list as $row){
					$itemList = explode("\\t", $row);
					echo "<tr>";
					if(!empty($row)){
						$cust_id = intval($itemList[0]);
						$card_num = intval($itemList[1]);
					}
					foreach($itemList as $item){
						echo "<td>" . $item . "</td>";
					}
					if(!empty($row)){
						echo "<td>" . 
								 "<form action=\"CustomerAssistantHome\" method=\"post\" >" . 
								 "<input type=\"hidden\" name=\"cust_id\" value=\"" . $cust_id . "\">" . 
								 "<input type=\"hidden\" name=\"card_num\" value=\"" . $card_num . "\">" . 
								 "<input type=\"submit\" name=\"submit\" value=\"Approve Card\">" . 
								 "</form>" .
							 "</td>";
					}
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	
	<div id="dialog2" title="Loan Requests:">
	  <table id="users" class="ui-widget ui-widget-content">
		<thead>
		  <tr class="ui-widget-header ">
			<th>ID</th>
			<th>Loan ID</th>
			<th>Date Given</th>
			<th>Date Due</th>
			<th>Interest Rate</th>
			<th>Name First</th>
			<th>Name Last</th>
			<th>Is Approved</th>
			<th>Approve Action</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<?php
				$list = explode("\\n", $table);
				foreach($list as $row){
					$itemList = explode("\\t", $row);
					echo "<tr>";
					if(!empty($row)){
						$cust_id = intval($itemList[0]);
						$loan_id = intval($itemList[1]);
					}
					foreach($itemList as $item){
						echo "<td>" . $item . "</td>";
					}
					if(!empty($row)){
						echo "<td>" . 
								 "<form action=\"CustomerAssistantHome\" method=\"post\" >" . 
								 "<input type=\"hidden\" name=\"cust_id\" value=\"" . $cust_id . "\">" . 
								 "<input type=\"hidden\" name=\"loan_id\" value=\"" . $loan_id . "\">" . 
								 "<input type=\"submit\" name=\"submit\" value=\"Approve Loan\">" . 
								 "</form>" .
							 "</td>";
					}
					echo "</tr>";
				}
			?>
		  </tr>
		</tbody>
	  </table>
	</div>
</div>
</div>
