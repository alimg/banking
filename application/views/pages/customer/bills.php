<p>Enter your bill id to pay</p>

<script>
    var bid=-1;
    function search(){
        bid = $("#billid").val();
        if(bid==="")
            return;
        $("#amount").load("bills/get/"+bid);
    }
    function pay(){
        if(bid==-1){
            alert("Please enter bill id.");
            return;
        }
        else {
            account = $("#account").val();
            $.ajax({ url: "bills/pay/"+bid+"/"+account })
                .done(function(data) {
                  alert(data);
                });
        }
    }
</script>
<input type="text" id="billid"> <button type="button" onclick="search()">Search</button><br/>
Amount: <span id="amount"></span><br>
Please select an account to pay with:
<select id="account">
<?php
if($accounts)
    foreach($accounts as $row) {
        echo "<option value=\"$row->id\">$row->id</option>";
    }
?>
</select>
<button type="button" onclick="pay()">Pay</button>

<br>
