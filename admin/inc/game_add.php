<?php
if (isset($_POST['hozzaad'])) {
    $game_name=$_POST['game_name'];
    $game_genre=$_POST['game_genre'];
    $game_relase_date=$_POST['game_relase_date'];
    $game_platforms=$_POST['game_platforms'];
    $game_developers=$_POST['game_developers'];;
    $game_gamemodes=$_POST['game_gamemodes'];;
    $game_about=str_replace("'",'`',$_POST['game_about']);

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
                    $result = mysqli_query($con,"SELECT * FROM pictures WHERE picture_name='$fileNameNew'");
                    $row = mysqli_fetch_assoc($result);
                    mysqli_query($con,"INSERT INTO games VALUES ('','$game_name','$game_genre','$row[id]','$game_relase_date','$game_platforms','$game_developers','$game_gamemodes','$game_about','')");
                    move_uploaded_file($fileTmpName,$fileDestination);
                    echo "<h1> Játék adatbázisba töltve! </h1>";

                } else {echo "<h1> Nem töltötted ki valamelyik beviteli mezőt! </h1>"; return false;}
            } else{echo "<h1>Túl nagy fileméret! (5Mb max) </h1>"; return false;}
        } else {echo "<h1> Hiba történt a file feltöltése közben! </h1>"; return false;}
    } else {echo "<h1> Nem tölthetsz fel ilyen file-formátumot! </h1>"; return false;}
   


   
} else {
    //urlap
?>
<div class="page-heading">
    <h1>Játék adatbázishoz adása</h1>
</div>
</div>
</div>
</div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="my-5">
                    <form id="contactForm" action="index.php?oldal=game_add" method="POST" enctype="multipart/form-data">

                        <div class="form-floating">
                            <input class="form-control" id="game_name" name="game_name" type="text" placeholder="Game_name"
                                data-sb-validations="required" />
                            <label for="name">Játék neve</label>

                        <div class="form-floating">
                            <input class="form-control" id="game_genre" name="game_genre" type="text" placeholder="Game_genre"
                                data-sb-validations="required" />
                            <label for="name">Játék műfaj</label>
                       
                        <div class="form-floating">
                            <input class="form-control" id="game_relase_date" name="game_relase_date" type="date" placeholder="Game_relase_date"
                                data-sb-validations="required" />
                            <label for="name">Játék kiadásának ideje</label>

                        <div class="form-floating">
                            <input class="form-control" id="game_platforms" name="game_platforms" type="text" placeholder="Game_platforms"
                                data-sb-validations="required" />
                            <label for="name">Játék platformjai</label>
                         <div class="form-floating">
                            <input class="form-control" id="game_developers" name="game_developers" type="text" placeholder="Game_developers"
                                data-sb-validations="required" />
                            <label for="name">Játék fejlesztői</label>
                         <div class="form-floating">
                            <input class="form-control" id="game_gamemodes" name="game_gamemodes" type="text" placeholder="Game_gamemodes"
                                data-sb-validations="required" />
                            <label for="name">Játék játékmódjai</label>

                        <div class="form-floating">
                            <textarea class="form-control" id="game_about" name="game_about" type="text" placeholder="Game_about"
                                data-sb-validations="required" style="height: 300px; resize: none;"></textarea>
                            <label for="name">A játékról</label>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Indexkép</label>
                                <input class="form-control" type="file" id="game_picture" name="file" type="file" placeholder="Pame_picture"
                                data-sb-validations="required">
                            </div>

                        <input class="btn btn-primary text-uppercase centers" type="submit" name="hozzaad" value="Hozzáad">

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
}

?>