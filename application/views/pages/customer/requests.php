
<h1 class="toggler">Request Loan</h1>
<div>loan form here</div>
<h1 class="toggler">Request Credit Card</h1>
<div>Card form here</div>

<script>
$(".toggler").next().hide();
$(".toggler").click(function(){
        $(this).next().toggle();
    });
</script>
