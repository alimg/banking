<form action="virtualAtm/transaction" method="post">
<p>Select atm 
<select name="atm">
    <?php
    if($atm){
        foreach($atms as $row){
            echo "<option value="{$row->atm_id}">{$row->atm_id} {$row->address}</option>";
        }
    }
    ?>
</select>
</p>
<p> Select bank account 
<select name="account">
    <?php
    if($accounts){
        foreach($accounts as $row){
            echo "<option value="{$row->id}">{$row->id}</option>";
        }
    }
    ?>
</select>
</p>
<select name="type">
    <option value="withdraw">Withdraw</option>
    <option value="deposit">Deposit</option>
</select> 
Amount:
<input type="text" name="amount" />
<input type="submit" value="Submit" />
</form>
