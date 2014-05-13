<div class="container">Welcome <?php echo $username?><br>

<?php 
if ($customer==false){
  ?>You are not a customer<?php
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
  <ul class="tabbar">
    <li><a class="tab-button" onclick="openPage(this,'account')">Home</a></li>
    <li><a class="tab-button" onclick="openPage(this,'bills')">Pay Bills</a></li>
    <li><a class="tab-button" onclick="openPage(this,'requests')">Requests</a></li>
    <li><a class="tab-button" onclick="openPage(this,'transfer')">Money Transfer</a></li>
    <li><a class="tab-button" onclick="openPage(this,'updateinfo')">Update Info</a></li>
  </ul>

  <div id="sub_page">
    ..
  </div>
</div>
</div>
