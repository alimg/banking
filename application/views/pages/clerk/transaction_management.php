
<div class="frame">
	<form method="post" action="" onsubmit="return false;">
		
		<p> Customer Id:  <input type="text" name="customer_id" id="customerid" value="<?php if(isset($customer)) echo $customer?>"/> </p>
		<input type="submit" value="Search" name="submit" onclick="openPage(this,'trans_search/'+$('#customerid').val())" />
		<br />
		
	</form>

	<form method="post" action="" onsubmit="return false;">
	Accounts: <select id="account" name = "account">   
	<?php 
		if(isset($accounts) && $accounts){
			foreach($accounts as $row){
				echo "<option value=\"{$row->id}\" onclick=\"showAccount('{$row->id}')\" >{$row->id}</option>";
			}
		}
	?>
	</select>
	<script>
		function showAccount( id ){
			$(".tr-row").hide();
			$("."+id).show();
		}
		showAccount($("#selAccounts").val());
	</script>
	
	<p> Amount:  <input type="text" name="amount" id = "amount" /> </p>
	Type Of Transaction:
		<select name="typetransaction" id = "typetransaction">
			<option value="withdraw">withdraw</option>
			<option value="deposit">deposit</option>
		</select><br>
		<input type="submit" value="Execute" name="submit" onclick="openPage(this,'exe_transaction/'+$('#customerid').val()+'/'+$('#account').val()+'/'+$('#amount').val()+'/'+$('#typetransaction').val())" />
		
</form>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:30%">Amount</th>
		<th style="width:30%">Interest Rate</th>
		<th style="width:20%">Date Given</th>
		<th style="width:20%">Date Due</th>
		
	</tr>
	<?php
	if(isset($loan_list) && $loan_list){
	foreach($loan_list as $row) {
		echo "
		<tr >
			<td>$row->amount</td>
			<td>$row->interest_rate</td>
			<td>$row->date_due</td>
			<td>$row->date_given</td>
			
		</tr>";
		}
		
	}
  ?>
 </tbody>
</table>


	
  <div id="sub_page">
    ..
  </div>
</div>
</div>