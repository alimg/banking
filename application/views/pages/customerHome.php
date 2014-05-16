<div class="container">Welcome <?php echo $username?><br>

<?php 
if ($customer==false){
  ?>You are not a customer<?php
  exit(0);
}
?>

<script>
  function openPage(e,page) {
    p = $(e);
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("customerHome/"+page);
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
    <li id="home" class="tab-button" onclick="openPage(this,'account')"><a >Home</a></li>
    <li id="bills" class="tab-button" onclick="openPage(this,'bills')"><a>Pay Bills</a></li>
    <li id="rquests"  class="tab-button" onclick="openPage(this,'requests')"><a>Requests</a></li>
    <li id="transfer" class="tab-button" onclick="openPage(this,'transfer')"><a>Money Transfer</a></li>
    <li id="updateinfo" class="tab-button" onclick="openPage(this,'updateinfo')"><a>Update Info</a></li>
  </ul>

  <div id="sub_page">
    ..
  </div>
</div>
</div>
<a href="/virtualAtm">virtual atm</a>
