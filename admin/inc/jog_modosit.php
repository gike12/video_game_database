<?php

if(isset($_POST['modosit'])){
        //ellentorzes
        $jognev=$_POST['jognev'];
        $id=$_POST['id'];
        $same_name_resoult=mysqli_query($con,"SELECT * FROM rights WHERE rights_name='$jognev' AND NOT id='$id'"); 
        $jog_szint=$_POST['jog_szint'];

       if (mysqli_num_rows($same_name_resoult) > 0) {
           print("<h1>A név már használatban van.</h1>");
          ugras("index.php?oldal=jog_modosit&id=$id",1000);
          return false;
          }
        else{
            mysqli_query($con,"UPDATE rights SET rights_name='$jognev',rights_level='$jog_szint' WHERE id='$id'");
            print "<h1>Sikeresen módosítva.</h1>";
            ugras('index.php?oldal=jogosultsagok',1000);
        }
    
    }
    else {
        
        //urlap
        $result=mysqli_query($con,"SELECT * FROM rights WHERE id='$_GET[id]'");
       
        $row=mysqli_fetch_assoc($result);
?>
<h1>Jogosultságnév módosítás</h1><br>
<div class="container px-4 px-lg-5">
<div class="row gx-4 gx-lg-5 justify-content-center">
<div class="col-md-10 col-lg-8 col-xl-7">
<div class="my-5">
<form id="contactForm" action="index.php?oldal=jog_modosit" method="POST">
    <input hidden name="id" value="<?php print $_GET['id']; ?>">
    <div class="form-floating">
        <input class="form-control" id="jognev" name="jognev" value=<?php print $row['rights_name']; ?> type="text"
            placeholder="Név" data-sb-validations="required" />
        <label for="name">Jogosultság neve</label>
    </div>
    <div class="form-floating">
        <select class="form-control" id="jog_szint" name="jog_szint" data-sb-validations="required">
            <?php
                         
                         for ($i=0; $i < 11; $i++) { 
                            ?><option value="<?php print $i.'"'; if($row['rights_level'] == $i) print 'selected'; ?>><?php print $i;?></option><?php
                         }?>
        </select>
        <label for="name">Jogosultság szint</label>
    </div>
    <br> <input class="btn btn-primary text-uppercase centers" type="submit" name="modosit" value="Mentés">
</form>
</div>
</div>
</div>
</div>
<?php
    }
?>