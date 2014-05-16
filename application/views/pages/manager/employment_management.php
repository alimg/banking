<br>


<script>
  function fire(id){
	$.ajax({ url: "managerHome/fireEmployee/"+id})
                .done(function(data) {
				 location.reload();
                });
  }//$name,$id, $surname, $salary, $phone_number, $address
  var selectedId = -1;
  function updateSalary(id){
	selectedId = id;
	$("#_id").val(""+ id);
        $("#light").show();
        $("#fade").show();
  }
</script>

<div class="frame">
	<h3>Employee List </h3>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:20%">Employee Name</th>
		<th style="width:20%">Id</th>
		<th style="width:20%">Surname</th>
		<th style="width:20%">Salary</th>
		<th style="width:20%">Phone Number</th>
	
	</tr>
	<?php 
	if($employment_list){
	foreach($employment_list as $row) {
		echo "
		<tr>
			<td>$row->name</td>
			<td>$row->id</td>
			<td>$row->surname</td>
			<td>$row->salary</td>
			<td>$row->phone_number</td>
			<td><button onclick=\"fire('$row->id')\" >Fire</button> </td>
			<td><button onclick=\"updateSalary('$row->id')\" >Update Salary</button> </td>
		</tr>";
		}
		
	}
  ?>
 </tbody>
</table>
<div hidden id="light" class="white_content">
  Enter Salary
 <form method="post" action="managerHome/updateSalary">
		<p> Salary <input type="text" name="salary" /> </p>
		<input id = "_id" type="text" value="" name="id" hidden/>
		<input type="submit" value="submit" name="submit"  />
		<br />
	</form>
</div>
    <div id="fade" class="black_overlay" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"></div>
<div> 
<p>Atm List:
	<a  href="#" onclick="openPage(this,'add_employee')">
	<button>Add New Employee</button>
	</a> </p>
</div>
</div>
