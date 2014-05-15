<p>Select you bank account to transfer</p>
<form action="transfer" method="post">
    <select id="account" name="account">
    <?php
    if($accounts)
        foreach($accounts as $row) {
            echo "<option value=\"$row->id\">$row->id</option>";
        }
    ?>
    </select><br>
    Amount: <input type="text" name="amount"/><br>
    Enter either IBAN or account no<br>
    IBAN: <input type="text" name="IBAN"/><br>
    Account no: <input type="text" name="target_account"/><br>
    Description:<br><input type="text" name="description"/><br>
    <input type="submit" >
</form>

