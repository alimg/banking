<p>Enter your bill id to pay</p>

<script>
    var bid=-1;
    function search(){
        bid = $("#billid").val();
        if(bid==="")
            return;
        $.ajax({ url: "bills/get/"+bid})
                .done(function(data) {
                  var obj = eval("(" + data + ')');
                  if(obj.status=="success"){
                      $("#amount").text(obj.amount);
                      $("#company").text(obj.company);
                  }else {
                      alert("Bill not found");
                  }
                });
        
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
                    if(data.trim()=="success"){
                        window.location.hash = '#home';
                        window.location.reload();
                    }
                    else alert(data);
                });
        }
    }
</script>
<input type="text" id="billid"> <button type="button" onclick="search()">Search</button><br/>
Amount: <span id="amount"></span><br>
Company Name: <span id="company"></span><br>
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
