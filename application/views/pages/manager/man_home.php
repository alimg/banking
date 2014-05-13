<div class="container">Welcome<br>
<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("managerHome/"+page);
  }
</script>



<div class="frame">
	<?php
		
		$sum = 0;
		if($branch_list){
			foreach($branch_list as $row) {
				$sum+= $row->balance;
			}
		}
		echo  "<h4>Bank Balance:  $sum </h4> " ;
		
		
	?>
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
	<?php 
	if($atm_list){
	foreach($atm_list as $row) {
		echo "
		<tr>
			<td>$row->branch_name</td>
			<td>$row->address</td>
			<td>$row->balance</td>
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