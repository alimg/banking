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
<h2> Addition of New Employee</h2>
  <!.. <form method="post" action="managerHome/add_Employee">
		<p> Select name of report from drop down menu </p>
		
		<!..<input type="submit" value="submit" name="submit" />
		<br />
	<!..</form>

    

  <div id="sub_page">
    ..
  </div>
</div>
</div>