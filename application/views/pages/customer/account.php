<p>Your Accounts:</p>
<table class="table"> 
 <tbody>
  <tr>
    <th style="width:30%">Account Id</th>
    <th style="width:30%">IBAN</th>
    <th style="width:20%">Branch</th>
    <th style="width:20%">Balance</th>
  </tr>
  <?php 
  if($accounts){
  foreach($accounts as $row) {
      echo "
      <tr>
        <td>$row->id</td>
        <td>$row->IBAN</td>
        <td>$row->branch_name</td>
        <td>$row->balance</td>
      </tr>";
  }
  }
  ?>
 </tbody>
</table>
