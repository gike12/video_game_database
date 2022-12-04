<?php
    $result = mysqli_query($con, "SELECT * FROM rights");
    print  '<a class="centers" href="index.php?oldal=jog_hozzaad">Jogosultság hozzáadása</a>';
  print'
  <table class="centers">
<tr>
<th style="padding: 9px; text-align:center;">ID</th>
<th style="padding: 9px; text-align:center;">Jognév</th>
<th style="padding: 9px; text-align:center;">Jogszint</a></th>
<th style="padding: 9px; text-align:center;">Módosítás</th>
</tr>';
while($row=mysqli_fetch_assoc($result))
    {
      print '<tr style="text-align:center;"><td>';print $row['id'];print'</td>';
      print '<td>';print $row['rights_name'];print'</td>';
      print '<td>';print $row['rights_level'];print'</td>';
      print '<td>';print' <a href="index.php?oldal=jog_modosit&id=';print $row['id'];print'">Módosít</a><br>
                          <a href="index.php?oldal=jog_torol&id=';print $row['id'];print'">Töröl</a>';print'</td></tr>';
      
    }
   
?>
</table>