<p>Update pesonal information</p>

<form method="post" action="customer/updateinfo">
    First name: <input type="text" name="fname" value="<?php echo $fname?>"/><br>
    Last name: <input type="text" name="lname" value="<?php echo $lname?>"/><br>
    Address: <input type="text" name="address" value="<?php echo $address?>"/><br>
    Birt date: <input  id="datePicker" type="text" name="bdate"  value="<?php echo $bdate?>"/><br>
    <input type="submit">
</form>
<script>
    $("#datePicker").datepicker({dateFormat:"yy-dd-mm"});
</script>
