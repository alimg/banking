
<h1 class="toggler">Request Loan</h1>
<div>
    <form action="request/loan" method="post">
    Amount: <input type="text" name="amount"/><br>
    Due date: <input type="text" name="ddate"/><br>
    Interest Rate: <input type="text" name="fname" value="0.04"/><br>
    <input type="submit" value="Apply for loan"/>
    </form>
</div>
<h1 class="toggler">Request Credit Card</h1>
<div>
    <form id="asds" name="sdsd" action="request/creditcard" method="post">
    Limit: <input type="text" name="limit"/><br>
    PIN: <input type="password" name="PIN"/><br>
    Statement Day: <select name="statement">
        <?php 
        for($i=1;$i<30;$i++)
            echo "<option value=\"$i\">$i</option>";
        ?>
    </select><br>
    <input type="submit">
    </form>
</div>

<script>
$(".toggler").next().hide();
$(".toggler").click(function(){
        $(this).next().toggle();
    });
</script>
