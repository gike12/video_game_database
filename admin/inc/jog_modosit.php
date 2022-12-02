<?php

if(isset($_POST['modosit'])){
        //ellentorzes
        $jognev=$_POST['jognev'];
        $id=$_POST['id'];
       $same_name_resoult=mysqli_query($con,"SELECT * FROM jogosultsagok WHERE megnevezes='$jognev' AND NOT id='$id'"); 

       if (mysqli_num_rows($same_name_resoult) > 0) {
           print("<h1>A név már használatban van.</h1>");
          ugras("index.php?oldal=jog_modosit&id=$id",1000);
          return false;
          }
        else{
            mysqli_query($con,"UPDATE jogosultsagok SET megnevezes='$jognev' WHERE id= '$id'");
            print "<h1>Sikeresen módosítva.</h1>";
            ugras('index.php?oldal=jogosultsagok',1000);
        }
    
    }
    else {
        
        //urlap
        $result=mysqli_query($con,"SELECT * FROM jogosultsagok WHERE id='$_GET[id]'");
       
        $row=mysqli_fetch_assoc($result);
?>
<h1>Jogosultságnév módosítás</h1><br>
<form id="contactForm" action="index.php?oldal=jog_modosit" method="POST">
    <input hidden name="id" value="<?php print $_GET['id']; ?>">
    <div class="form-floating">
        <input class="form-control" id="jognev" name="jognev" value=<?php print $row['megnevezes']; ?> type="text"
            placeholder="Név" data-sb-validations="required" />
        <label for="name">Jogosultság neve</label>
    </div>
    <br> <input class="btn btn-primary text-uppercase" type="submit" name="modosit" value="Mentés">
</form>
<?php
    }
?>