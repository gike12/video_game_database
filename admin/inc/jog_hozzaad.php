<?php
    if(isset($_POST['ment'])){
        $jognev=$_POST['jog_nev'];//ucfirst(strtolower())
        $same_name_result=mysqli_query($con,"SELECT * FROM rights WHERE rights_name='$jognev'");
        $jog_szint=$_POST['jog_szint'];
        

        if(mysqli_num_rows($same_name_result) > 1) {
            print("<h1>A megadott jogosultság név már használatban van.</h1>");
            ugras("index.php?oldal=jog_hozzaad",1000);
            return false;
            }
            else{
                mysqli_query($con,"INSERT INTO rights VALUES ('','$jognev','$jog_szint')");
                print "<h1>Hozzáadva</h1>";
                ugras('index.php?oldal=jogosultsagok',1000);
                
            }

 }
 else{
?>
<div class="container px-4 px-lg-5">
<div class="row gx-4 gx-lg-5 justify-content-center">
<div class="col-md-10 col-lg-8 col-xl-7">
<div class="my-5">
<form id="contactForm" action="index.php?oldal=jog_hozzaad" method="POST">
    
    <div class="form-floating">
        <input class="form-control" id="jog_nev" name="jog_nev" type="text" placeholder="Jogosultság neve"
            data-sb-validations="required" />
        <label for="name">Jogosultság neve</label>

        <div class="form-floating">
        <select class="form-control" name="jog_szint" data-sb-validations="required">
            <?php
                         while($row = mysqli_fetch_assoc($result1)) array_push($ids,$row['id']);
                         for ($i=0; $i < 11; $i++) { 
                            ?><option value=<?php print $i; ?>><?php print $i;?></option><?php
                         }
                         
                    ?>
        </select>
        <label for="name">Jogosultság szint</label>
    </div>

        <input class="btn btn-primary text-uppercase centers" type="submit" name="ment" value="Hozzáad">
</form>
</div>
</div>
</div>
</div>
<?php
}
?>