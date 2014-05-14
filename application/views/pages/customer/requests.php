
<h1 class="toggler">Request Loan</h1>
<div>
    <form id="loan" action="request/loan" method="post">
    Amount: <input type="text" name="amount"/><br>
    Due date: <input type="text" name="ddate"/><br>
    Interest Rate: <input type="text" name="fname" value="0.04"/><br>
    <input type="submit" value="Apply for loan"/>
    </form>
</div>
<h1 class="toggler">Request Credit Card</h1>
<div>
    <form id="cards" action="request/creditcard" method="post">
    Limit: <input type="text" name="limit"/><br>
    Statement Day: <select name="statement">
        <?php 
        for($i=1;$i<30;$i++)
            echo "<option value=\"$i\">$i</option>";
        ?>
    </select><br>
    PIN: <input type="password" name="PIN"/><br>
    <input type="submit">
    </form>
</div>

<script>
$(".toggler").next().hide();
$(".toggler").click(function(){
        $(this).next().toggle();
    });
</script>
