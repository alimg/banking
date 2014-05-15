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
    $("#sub_page").load("managerHome/"+page);
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
</div>
</div>
