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
	Bank Balance: <input type="text" name="bank_balance"><br>
	

  <div id="sub_page">
    ..
  </div>
</div>
</div>
