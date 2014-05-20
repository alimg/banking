<p>Following money transfer is about to be done:</p>
From account: <?php echo $account_source;?><br>
To account: <?php echo $account_target->id;?><br>
Target account owner: <?php echo $account_target_owner[0]->name_first." ".$account_target_owner[0]->name_last;?><br>
Amount: <?php echo $amount?><br>
Description: <?php echo $description?><br>
<form action="transfer/confirm" method="post">
    <input hidden name="account" value="<?php echo  $account_source;?>"/>
    <input hidden type="text" name="amount" value="<?php echo  $amount;?>"/>
    <input hidden type="text" name="target_account" value="<?php echo  $account_target->id;?>"/>
    <input hidden type="text" name="description" value="<?php echo  $description;?>"/>
    <input type="submit" value="Confirm">
</form>
