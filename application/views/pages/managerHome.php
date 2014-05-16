<div class="container">Welcome <?php echo $username?><br>

<?php 
if ($manager==false){
  ?>You are not a manager<?php
  exit(0);
}
?>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/ui-lightness/jquery-ui-1.10.4.custom.css">
<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/jquery-ui-1.10.4.custom.js"></script>
<script>
	var data = '';
	var	table = '';
	function openPage(e,page) {
		p = $(e).parent();
		p.parent().children().removeClass('selected');
		p.addClass('selected');
		$("#sub_page").load("managerHome/"+page);
	}
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
		$( "#dialog3" ).dialog({
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
			openPage(this,'man_home');
		}else if(data == 'rep1'){
			openPage(this,'reports');
			$( "#dialog1" ).dialog( "open" );
		}else if(data == 'rep2'){
			openPage(this,'reports');
			$( "#dialog2" ).dialog( "open" );
		}else if(data == 'rep3'){
			openPage(this,'reports');
			$( "#dialog3" ).dialog( "open" );
		}
	}
</script>

<div class="frame">
	<ul class="tabbar">
    <li><a class="tab-button" onclick="openPage(this,'man_home')">Home</a></li>
    <li><a class="tab-button" onclick="openPage(this,'atm_management')">Atm Management</a></li>
    <li><a class="tab-button" onclick="openPage(this,'employment_management')">Employment Management</a></li>
    <li><a class="tab-button" onclick="openPage(this,'reports')">Reports</a></li>
	<li><a class="tab-button" onclick="openPage(this,'manager_update_info')">Update Info</a></li>
  </ul>

  <div id="sub_page">
    ...
  </div>
  
  <div id="dialog1" title="Report:">
	  <table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>Job</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Salary</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$list = explode("\\n", $table);
				foreach($list as $row){
					$itemList = explode("\\t", $row);
					echo "<tr>";
					foreach($itemList as $item)
						echo "<td>" . $item . "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	<div id="dialog2" title="Report:">
	  <table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>Date</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Trans. Type</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$list = explode("\\n", $table);
				foreach($list as $row){
					$itemList = explode("\\t", $row);
					echo "<tr>";
					foreach($itemList as $item)
						echo "<td>" . $item . "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	<div id="dialog3" title="Report:">
	  <table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>Card Number</th>
				<th>Valid Until</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$list = explode("\\n", $table);
				foreach($list as $row){
					$itemList = explode("\\t", $row);
					echo "<tr>";
					foreach($itemList as $item)
						echo "<td>" . $item . "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
</div>
</div>
