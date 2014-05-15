<div class="container">Welcome<br>
<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("clerkHome/"+page);
  }
</script>



<div class="frame">
		
	<p> Amount:  <input type="text" name="customer_id" /> </p>
	Type Of Transaction:
	<select name="type_transaction">
		<option value="withdraw">withdraw</option>
		<option value="deposit">deposit</option>
	</select><br>
	<?php
    if($loan_list){
	foreach($loan_list as $row) {
		echo "
		<tr>
			<td>$row->branch_name</td>
			<td>$row->address</td>
			<td>$row->balance</td>
			<td><button onclick=\"deleteAtm('$row->atm_id')\" >Delete Atm</button> </td>
		</tr>";
		}
		
	}     
		
	?>
	

	<!--
	
	<p>Atm List:
	<a  href="#" onclick="openPage(this,'atm_management')">
	<button>Add Atm</button>
	</a> </p>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:30%">Branch Name</th>
		<th style="width:30%">Address</th>
		<th style="width:20%">Balance</th>
	
	</tr>
	<?php/* 
	if($atm_list){
	foreach($atm_list as $row) {
		echo "
		<tr>
			<td>$row->branch_name</td>
			<td>$row->address</td>
			<td>$row->balance</td>
			<td><button onclick=\"deleteAtm('$row->atm_id')\" >Delete Atm</button> </td>
		</tr>";
		}
		
	}*/
  ?>
 </tbody>
</table>
    -->

  <div id="sub_page">
    ..
  </div>
</div>
</div>