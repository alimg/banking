<div class="container">Welcome <?php echo $username?><br>

<?php 
if ($manager==false){
  ?>You are not a manager<?php
  exit(0);
}
?>

<script>
  function openPage(e,page) {
    p = $(e);
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("managerHome/"+page);
    
  }
  $(document).ready(function (){
    var hash = window.location.hash;
    if(hash==="")
      hash="#home"
    $(""+hash).click();
  });
</script>

<div class="frame">
	<ul class="tabbar">
    <li id="home" class="tab-button" onclick="openPage(this,'man_home')"><a>Home</a></li>
    <li id="atmMan" class="tab-button" onclick="openPage(this,'atm_management')"><a>Atm Management</a></li>
    <li id="empMan" class="tab-button" onclick="openPage(this,'employment_management')"><a>Employment Management</a></li>
    <li id="reports" class="tab-button" onclick="openPage(this,'reports')"><a>Reports</a></li>
    <li id="updateinfo" class="tab-button" onclick="openPage(this,'manager_update_info')"><a>Update Info</a></li>
    <?php if($manager[0]->admin){?>
    <li id="branches" class="tab-button" onclick="openPage(this,'branch_management')"><a>Branch Management</a></li>
    <?php  }?>
  </ul>

  <div id="sub_page">
    ...
  </div>
</div>
</div>
