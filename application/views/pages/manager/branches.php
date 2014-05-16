<br>
<script>
  function deleteBranch(bid){
	$.ajax({ url: "managerHome/deleteBranch/"+bid})
                .done(function(data) {
                        window.location.hash="#branches";
                        location.reload();
                });
  }
  function addBranch(){
        $("#light").show();
        $("#fade").show();
        $("#formadd").show();
        $("#formedit").hide();
  }
  
  function editBranch(e,bid){
        $("#light").show();
        $("#fade").show();
        $("#formadd").hide();
        $("#formedit").show();
        $("#formedit #name").val(bid);
        p=$(e).parent();
        console.log($(e).text());
        $("#formedit #address").val(p.siblings(":nth-child(2)").text());
        $("#formedit #balance").val(p.siblings(":nth-child(3)").text());
        
  }
</script>


<div hidden id="light" class="white_content">
  Enter Salary
 <form id="formadd" method="post" action="managerHome/addBranch">
        <p> Branch Name <input  type="text" name="name" /> </p>
        <p> Branch Address <input type="text" name="address" /> </p>
        <p> Initial Balance <input type="text" name="balance" /> </p>
        <input type="submit" value="submit" name="submit"  />
        <br />
</form>
<form id="formedit" method="post" action="managerHome/editBranch">
        <p> Branch Name <input id="name" type="text"   disabled /> </p>
        <input id="name" type="text" name="name"  hidden />
        <p> Branch Address <input id="address" type="text" name="address" /> </p>
        <p> Balance <input id="balance" type="text" name="balance" /> </p>
        <input type="submit" value="submit" name="submit"  />
        <br />
</form>
</div>
<div id="fade" class="black_overlay" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"></div>

<div class="frame">
        
	<p>Branch List:
        <a  href="#" onclick="addBranch()">
	<button>Add Branch</button>
	</a> <br>
	</p>
	<table class="table"> 
	<tbody>
	<tr>
		<th style="width:30%">Branch Name</th>
		<th style="width:30%">Address</th>
		<th style="width:20%">Balance</th>
		<th style="width:20%">Action</th>
	
	</tr>
	<?php 
	if($branch_list){
	foreach($branch_list as $row) {
		echo "
		<tr>
			<td>$row->name</td>
			<td>$row->address</td>
			<td>$row->balance</td>
			<td>
                                <button onclick=\"editBranch(this,'$row->name')\" >Edit</button> 
                                <button onclick=\"deleteBranch(this,'$row->name')\" >Delete</button> 
                        </td>
		</tr>";
		}
		
	}
  ?>
 </tbody>
</table>
    

</div>
