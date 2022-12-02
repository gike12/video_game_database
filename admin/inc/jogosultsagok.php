<?php
    $result = mysqli_query($con, "SELECT * FROM jogosultsagok");
    if (mysqli_num_rows($result) < 10) {
      print  '<a href="index.php?oldal=jog_hozzaad">Jogosultság hozzáadása</a><br><br>';
  }
   
    while($row=mysqli_fetch_assoc($result))
    {
      print "$row[id] - $row[megnevezes]
      <a href=index.php?oldal=jog_torol&id=$row[id]>Töröl</a>
      <a href=index.php?oldal=jog_modosit&id=$row[id]>Módosít</a><br>";;
      
    }
   
?>