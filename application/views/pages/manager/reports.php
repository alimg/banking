<div class="container"><br>
<script>
  function openPage(e,page) {
    p = $(e).parent();
    p.parent().children().removeClass('selected');
    p.addClass('selected');
    $("#sub_page").load("managerHome/"+page);
  }
 
</script>



<div class="frame">
<h2> Select name of report from drop down menu</h2>
  <!.. <form method="post" action="managerHome/add_Employee">
		
		
		<!..<input type="submit" value="submit" name="submit" />
		<br />
	<!..</form>

    

  <div id="sub_page">
    ..
  </div>
</div>
</div>