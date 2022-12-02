<?php
    if(isset($_POST['ment'])){
        $jognev=$_POST['jog_nev'];//ucfirst(strtolower())
        $same_name_result=mysqli_query($con,"SELECT * FROM jogosultsagok WHERE megnevezes='$jognev'");
        $id=$_POST['jog_id'];
        

        if (mysqli_num_rows($same_name_result) > 0) {
            print("<h1>A megadott jogosultság név már használatban van.</h1>");
            ugras("index.php?oldal=jog_hozzaad",1000);
            return false;
            }
            else{
                mysqli_query($con,"INSERT INTO jogosultsagok VALUES ('$id','$jognev')");
                print "<h1>Hozzáadva</h1>";
                ugras('index.php?oldal=jogosultsagok',1000);
                
            }

 }
 else{


?>
<form id="contactForm" action="index.php?oldal=jog_hozzaad" method="POST">
    <div class="form-floating">
        <select class="form-control" name="jog_id" data-sb-validations="required">
            <?php
                         $maxjog=20;
                         $result1 = mysqli_query($con, "SELECT id FROM jogosultsagok");
                         $unused_ids_a= array();
                         $ids= array();

                         while($row = mysqli_fetch_assoc($result1)) array_push($ids,$row['id']);
                         for ($i=0; $i < $maxjog ; $i++) array_push($unused_ids_a, $i);
                         $unused_ids=array_values(array_diff($unused_ids_a,$ids));
                         for ($i=1; $i < count($unused_ids) ; $i++) { 
                            ?><option value=<?php print $unused_ids[$i]; ?>><?php print $unused_ids[$i];?></option><?php
                         }
                         
                    ?>
        </select>
        <label for="name">Id neve</label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="jog_nev" name="jog_nev" type="text" placeholder="Jogosultság neve"
            data-sb-validations="required" />
        <label for="name">Jogosultság neve</label><br>

        <input class="btn btn-primary text-uppercase" type="submit" name="ment" value="Hozzáad">
</form>
<?php
}
?>