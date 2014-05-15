<div class="container"><br>



<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("clerkHome/"+page);
  }
</script>

<div class="frame">
	<ul class="tabbar">
    <li><a class="tab-button" onclick="openPage(this,'clerk_home')">Home</a></li>
    <li><a class="tab-button" onclick="openPage(this,'clerk_transaction_management')">Transaction Management</a></li>

  </ul>

  <div id="sub_page">
    ...
  </div>
</div>
</div>
