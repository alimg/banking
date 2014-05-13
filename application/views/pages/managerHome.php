<div class="container">Welcome <?php echo $username?><br>

<?php 
if ($manager==false){
  ?>You are not a manager<?php
  exit(0);
}
?>

<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("customerHome/"+page);
  }
</script>

<div class="frame">
	<?php
		echo "<h6>Bank Balance: $bank_balance </h6>"
	?>
	<p>Branch List:</p>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:30%">Name</th>
		<th style="width:30%">Address</th>
		<th style="width:20%">Balance</th>
	
	</tr>
	<?php 
	if($branch_list){
	foreach($branch_list as $row) {
		echo "
		<tr>
			<td>$row->name</td>
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
