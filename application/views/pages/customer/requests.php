
<h1 class="toggler">Request Loan</h1>
<div>
    <form id="loan" action="request/loanRequest" method="post">
    Amount: <input id="loanamount" type="text" name="amount"/><br>
    Selected Due date: <input  id="datePicker" type="text" name="ddate" /><br>
    Interest Rate: <input id="interestrate" type="text" name="fname" value="-" disabled/><br>
    <select name="branch">
        <?php
        if($branches)
            foreach($branches as $row){
                echo "<option value='{$row->name}'>{$row->name}</option>";
            }
        ?>
    </select>
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
    $("#datePicker").datepicker({dateFormat:"yy-dd-mm"});
    //$('#ui-datepicker-div').css('clip', 'auto');
    //$('#ui-datepicker-div').removeClass('ui-helper-hidden-accessible'); 
    
    
    $(".toggler").next().hide();
    $(".toggler").click(function(){
            $(this).next().toggle();
        });
        
    var loanAmount=0;
    $('#loanamount').keyup(function () { 
        loanAmount = parseInt( $('#loanamount').val() );
        if(isNaN(loanAmount))
            return;
        $.ajax({ url: "ajax/calculateLoan/"+loanAmount })
            .done(function(data) {
              var obj = parseFloat(data.trim());
              if(isNaN(obj)){
                  loanAmount=0;
                  $("#interestrate").val("-");
              }else {
                  $("#interestrate").val(""+obj);
              }
            });
    });
</script>
