    <?php 
      $result = mysqli_query($con,"SELECT * FROM games");
      $row = mysqli_fetch_assoc($result);
     if(isset($_GET['game_id'])){
      $game_result=mysqli_query($con,"SELECT * FROM games WHERE id=$_GET[game_id]");
      $game_row=mysqli_fetch_assoc($game_result);

      $gamepicture= mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pictures WHERE id='$game_row[game_picture_id]'"));
      print'

    ';?>
      <?php
if (isset($_POST['torol_game'])) {
    $game_id_value=$_POST['game_id_value'];
    mysqli_query($con,"DELETE FROM games WHERE id='$game_id_value'");
    echo "<h1> Játék adatai törölve! </h1>";
}
if (isset($_POST['frissit'])) {
    $game_name=str_replace("'",'`',$_POST['game_name']);
    $game_genre=$_POST['game_genre'];
    $game_relase_date=$_POST['game_relase_date'];
    $game_platforms=$_POST['game_platforms'];
    $game_developers=$_POST['game_developers'];
    $game_gamemodes=$_POST['game_gamemodes'];
    $game_about=str_replace("'",'`',$_POST['game_about']);
    $game_id_value=$_POST['game_id_value'];


    if (!empty($_FILES['file']['name'])){
        $file=$_FILES['file'];
        $fileName=$_FILES['file']['name'];
        $fileTmpName=$_FILES['file']['tmp_name'];
        $fileSize=$_FILES['file']['size'];
        $fileError=$_FILES['file']['error'];
        $fileType=$_FILES['file']['type'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpg','jpeg','png');
    
        if(in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if($fileSize <= 5_000_000){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = '../assets/images/pictures/'.$fileNameNew;
                    $fileDestination2='assets/images/pictures/'.$fileNameNew;
                    if(!strlen(trim($game_name)) == 0 and !strlen(trim($game_genre)) == 0 
                                                      and !strlen(trim($game_relase_date)) == 0
                                                      and !strlen(trim($game_platforms)) == 0 
                                                      and !strlen(trim($game_developers)) == 0 
                                                      and !strlen(trim($game_gamemodes)) == 0 
                                                      and !strlen(trim($game_about)) == 0){
                        mysqli_query($con,"INSERT INTO pictures VALUES ('','$_SESSION[login_id]','$fileNameNew','$fileDestination2','game_pic')");
                        $row_pic = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pictures WHERE picture_name='$fileNameNew'"));
                        mysqli_query($con,"UPDATE games SET game_name='$game_name',game_genre='$game_genre',game_picture_id='$row_pic[id]',game_relase_date='$game_relase_date',
                                                            game_platforms='$game_platforms',game_developers='$game_developers',' game_gamemodes=$game_gamemodes',game_about='$game_about' WHERE id='$game_id_value'");
                        move_uploaded_file($fileTmpName,$fileDestination);
                        echo "<h1> Játék adatai frissvítve! </h1>";
    
                    } else {echo "<h1> Nem töltötted ki valamelyik beviteli mezőt! </h1>"; return false;}
                } else{echo "<h1>Túl nagy fileméret! (5Mb max) </h1>"; return false;}
            } else {echo "<h1> Hiba történt a file feltöltése közben! </h1>"; return false;}
        } else {echo "<h1> Nem tölthetsz fel ilyen file-formátumot! </h1>"; return false;}
 
}
else{
    if(!strlen(trim($game_name)) == 0 and !strlen(trim($game_genre)) == 0 
    and !strlen(trim($game_relase_date)) == 0
    and !strlen(trim($game_platforms)) == 0 
    and !strlen(trim($game_developers)) == 0 
    and !strlen(trim($game_gamemodes)) == 0 
    and !strlen(trim($game_about)) == 0){
    mysqli_query($con,"UPDATE games SET game_name='$game_name', game_genre='$game_genre', game_relase_date='$game_relase_date',
    game_platforms='$game_platforms', game_developers='$game_developers', game_gamemodes='$game_gamemodes', game_about='$game_about' WHERE id='$game_id_value'");
    echo "<h1> Játék adatai frissítve! </h1>";
}
else{ echo "<h1> Nem töltötted ki valamelyik beviteli mezőt! </h1>"; return false;}
}

} else {
    //urlap
?>
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="my-5">
                <img class="game_img_size" src='..\<?php print $gamepicture["picture_path"]?>'></img>

                    <form id="contactForm" action="index.php?oldal=games&game_id=<?php print $_GET['game_id']?>" method="POST" enctype="multipart/form-data">
                    <input class="btn btn-danger text-uppercase centers" type="submit" name="torol_game" value="Törlés">
                        <div class="form-floating">
                        <input class="form-control" hidden id="game_id_value" name="game_id_value" type="text" placeholder="game_id_value"
                                    data-sb-validations="required" value='<?php print  $_GET['game_id']?>' readonly/>
                              <label for="name">ID</label>
                            </div>

                        <div class="form-floating">
                            <input class="form-control" id="game_name" name="game_name" type="text" placeholder="Game_name" value="<?php print $game_row["game_name"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék neve</label>

                        <div class="form-floating">
                            <input class="form-control" id="game_genre" name="game_genre" type="text" placeholder="Game_genre" value="<?php print $game_row["game_genre"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék műfaj</label>
                       
                        <div class="form-floating">
                            <input class="form-control" id="game_relase_date" name="game_relase_date" type="date" placeholder="Game_relase_date" value="<?php print $game_row["game_relase_date"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék kiadásának ideje</label>

                        <div class="form-floating">
                            <input class="form-control" id="game_platforms" name="game_platforms" type="text" placeholder="Game_platforms" value="<?php print $game_row["game_platforms"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék platformjai</label>
                         <div class="form-floating">
                            <input class="form-control" id="game_developers" name="game_developers" type="text" placeholder="Game_developers" value="<?php print $game_row["game_developers"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék fejlesztői</label>
                         <div class="form-floating">
                            <input class="form-control" id="game_gamemodes" name="game_gamemodes" type="text" placeholder="Game_gamemodes" value="<?php print $game_row["game_gamemodes"]?>"
                                data-sb-validations="required" />
                            <label for="name">Játék játékmódjai</label>

                        <div class="form-floating">
                            <textarea class="form-control" id="game_about" name="game_about" type="text" placeholder="Game_about"
                                data-sb-validations="required" style="height: 300px; resize: none;"><?php print $game_row["game_about"]?></textarea>
                            <label for="name">A játékról</label>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Indexkép</label>
                                <input class="form-control" type="file" id="file" name="file" type="file" placeholder="Game_picture">
                            </div>

                        <input class="btn btn-primary text-uppercase centers" type="submit" name="frissit" value="Frissít">

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
}

?>

      <?php
     }
     else{
      print'<h1>Game List</h1>
      <div class="gamelistdiv">';
      $result2 = mysqli_query($con,"SELECT * FROM games");
      while($row2=mysqli_fetch_assoc($result2)){
        
        $g_img = mysqli_query($con,"SELECT * FROM pictures WHERE id='$row2[game_picture_id]'");
        $g_row = mysqli_fetch_assoc($g_img);
        print '
        
          <div class="gamecontainer">
            <div class="card" style="width: 14rem;">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><img class="card-img-top" src=';print '..\\'; print $g_row["picture_path"];print ' alt="Card image cap" >
          <div class="card-body">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><h5 class="card-title" style="text-align: center;">';print $row2["game_name"];print '</h5></a>
            <p class="card-text">Relase date: <br> ';print $row2["game_relase_date"];print '<br>Rating: ';print $row2["game_rating"];print '/10 <br>';print $row2["game_platforms"];print ' </p>
            <p class="card-text"></p>
          </div>
        </div>
        </div>
        ';
      }

      print ' <div class="gamecontainer">
      <div class="card" style="width: 14rem;">

        <a href="index.php?oldal=game_add"><img src="..\assets\images\pictures\add.png" alt="Plus icon" style="max-height: 206px;"></a>

        <div class="card-body">
          <a href="index.php?oldal=game_add"><h5 class="card-title" style="text-align: center;">Add Game</h5></a>
            <p class="card-text"></p>
    </div>
      </div>
        </div>';  
      ?>
     
  
<?php
     print '</div>';
     }
    
?>