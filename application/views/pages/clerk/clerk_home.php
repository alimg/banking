

<br>
<div class="frame">
	<form method="post" action="" onsubmit="return false;">
		
		<p> Customer Id:  <input type="text" name="customer_id" id="customerid" value="<?php if(isset($customer)) echo $customer?>"/> </p>
		<input type="submit" value="Search" name="submit" onclick="openPage(this,'searchCustomer/'+$('#customerid').val())" />
		<br />
		
	</form>
	<div>
	Customer Name: <?php echo $customerName?><br>
	Accounts: <select id="selAccounts">   
	<?php 
		if(isset($accounts) && $accounts){
			foreach($accounts as $row){
				echo "<option value=\"{$row->id}\" onclick=\"showAccount('{$row->id}')\" >{$row->id}</option>";
			}
		}
	?>
	</select>
	Balance: <?php 
		if(isset($accounts) && $accounts){
			foreach($accounts as $row){
				echo "<span class=\"{$row->aid}\" >{$row->balance}</option>";
			}
		}
	?>
	<script>
		function showAccount( id ){
			$(".tr-row").hide();
			$("."+id).show();
		}
		showAccount($("#selAccounts").val());
	</script>
	</div>
	<br>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:30%">Date</th>
		<th style="width:30%">Type</th>
		<th style="width:20%">Amount</th>
	</tr>
	<?php
	if(isset($result) && $result){
	foreach($result as $row) {
		echo "
		<tr class=\"tr-row {$row->aid}\">
			<td>{$row->date}</td>
			<td>{$row->type}</td>
			<td>{$row->amount}</td>
		</tr>";
		}
		
	}
  ?>
 </tbody>
</table>
</div>
