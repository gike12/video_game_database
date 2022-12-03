<?php 
      $result = mysqli_query($con,"SELECT * FROM games");
      $row = mysqli_fetch_assoc($result);
if(isset($_GET['game_id'])){
      $game_result=mysqli_query($con,"SELECT * FROM games WHERE id=$_GET[game_id]");
      $game_row=mysqli_fetch_assoc($game_result);
      $gamepicture= mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pictures WHERE id='$game_row[game_picture_id]'"));
      if(isset($_POST['rating'])){
        $ratingvalue=$_POST['rating'];
        $result_rating=mysqli_query($con,"SELECT rating FROM game_ratings WHERE user_id='$_SESSION[login_id]' AND game_id='$_GET[game_id]'");
        if(mysqli_num_rows($result_rating) == 1){
          mysqli_query($con,"UPDATE game_ratings SET rating='$ratingvalue'WHERE user_id='$_SESSION[login_id]' AND game_id='$_GET[game_id]'");
        }
        else{
          mysqli_query($con, "INSERT INTO game_ratings VALUES ('','$_GET[game_id]','$_SESSION[login_id]','$ratingvalue')");
        }
        $rating_num=mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(rating) AS 'rcount' FROM game_ratings WHERE game_id='$_GET[game_id]'"));
        $rating_sum=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(rating) AS 'rsum' FROM game_ratings WHERE game_id='$_GET[game_id]'"));
        $rating_avg=$rating_sum['rsum'] / $rating_num['rcount'];
        mysqli_query($con,"UPDATE games SET game_rating='$rating_avg' WHERE id='$_GET[game_id]'");
        ugras('index.php?oldal=games&game_id='.$_GET['game_id'],1);
      }
      print'
      <h1>';print $game_row['game_name']; print'</h1> 
      

      <img class="game_img_size" src=';print $gamepicture["picture_path"];print '></img>';
      if(isset($_SESSION['login_id'])){
        $result_rating=mysqli_query($con,"SELECT rating FROM game_ratings WHERE user_id='$_SESSION[login_id]' AND game_id='$_GET[game_id]'");
        $row_rating=mysqli_fetch_assoc($result_rating);
        if(isset($row_rating['rating'])) $rowrating=$row_rating['rating']; else $rowrating=0;
  print '
}
      <form id="contactForm" action="index.php?oldal=games&game_id=';print $_GET['game_id'];print '" method="POST">
      <h3 class="centers">Rate the game:</h3>
      <div class="rating">
        <input id="rating1"  type="radio" name="rating" value="1" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating  == 1){ print 'checked';} print '>
        <label for="rating1" class="m-1">1</label>
        <input id="rating2" type="radio" name="rating" value="2" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 2){ print 'checked';} print '>
        <label for="rating2" class="m-1">2</label>
        <input id="rating3" type="radio" name="rating" value="3" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 3){ print 'checked';} print '>
        <label for="rating3" class="m-1">3</label>
        <input id="rating4" type="radio" name="rating" value="4" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 4){ print 'checked';} print '>
        <label for="rating4" class="m-1">4</label>
        <input id="rating5" type="radio" name="rating" value="5" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 5){ print 'checked';} print '>
        <label for="rating5" class="m-1">5</label>
        <input id="rating6" type="radio" name="rating" value="6" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 6){ print 'checked';} print '>
        <label for="rating6" class="m-1">6</label>
        <input id="rating7" type="radio" name="rating" value="7" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 7){ print 'checked';} print '>
        <label for="rating7" class="m-1">7</label>
        <input id="rating8" type="radio" name="rating" value="8" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 8){ print 'checked';} print '>
        <label for="rating8" class="m-1">8</label>
        <input id="rating9" type="radio" name="rating" value="9" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 9){ print 'checked';} print '>
        <label for="rating9" class="m-1">9</label>
        <input id="rating10" type="radio" name="rating" value="10" onclick="this.form.submit();"'; if(mysqli_num_rows($result_rating) == 1 and $rowrating == 10){ print 'checked';} print '>
        <label for="rating10" class="m-1">10</label>
      </div>
      </form>';
}
print '
<div class="flex_game_about_conainer">
      
      <div class="game_infos"> 
        <p>Genre: ';print $game_row["game_genre"];print ' </p>
        <p>Relase date: ';print $game_row["game_relase_date"];print ' </p> 
        <p>Platforms: ';print $game_row["game_platforms"];print ' </p> 
        <p>Developers: ';print $game_row["game_developers"];print ' </p> 
        <p>Game-modes: ';print $game_row["game_gamemodes"];print ' </p> 
        <p>User rating: ';print $game_row["game_rating"];print '/10 </p> 
     
      <div class="game_rating"></div>
   <h1>About</h1>
  <div class="text_content"> <p>';print $game_row["game_about"];print ' </p> </div> 
</div>    
';
}
     else{
      if(isset($_GET['search'])){
        print'<h1>Search results</h1>
      <div class="gamelistdiv">';
      $result2 = mysqli_query($con,"SELECT * FROM games WHERE game_name LIKE '%$_GET[search]%'");
      if( mysqli_num_rows($result2) == 0) print '
      <div class="gamecontainer">
      <div class="card" style="width: 14rem;">
        <div class="card-body">
          <h5 class="card-title" style="text-align: center;">Az ön álltal keresett kifejezés nem található.</h5></a>
            <p class="card-text"></p>
    </div>
      </div>
        </div>';
      while($row2=mysqli_fetch_assoc($result2) and mysqli_num_rows($result2) != 0){
        
        $g_img = mysqli_query($con,"SELECT * FROM pictures WHERE id='$row2[game_picture_id]'");
        $g_row = mysqli_fetch_assoc($g_img);
        print '
        
          <div class="gamecontainer">
            <div class="card" style="width: 14rem;">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><img class="card-img-top" src=';print $g_row["picture_path"];print ' alt="Card image cap" >
          <div class="card-body">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><h5 class="card-title" style="text-align: center;">';print $row2["game_name"];print '</h5></a>
            <p class="card-text">Relase date: <br> ';print $row2["game_relase_date"];print '<br>Rating: ';print $row2["game_rating"];print '/10 <br>';print $row2["game_platforms"];print ' </p>
            <p class="card-text"></p>
          </div>
        </div>
        </div>
        ';
      }
      print '</div>';
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
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><img class="card-img-top" src=';print $g_row["picture_path"];print ' alt="Card image cap" >
          <div class="card-body">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><h5 class="card-title" style="text-align: center;">';print $row2["game_name"];print '</h5></a>
            <p class="card-text">Relase date: <br> ';print $row2["game_relase_date"];print '<br>Rating: ';print $row2["game_rating"];print '/10 <br>';print $row2["game_platforms"];print ' </p>
            <p class="card-text"></p>
          </div>
        </div>
        </div>
        ';
      }
      print '</div>';
     }}

    ?>
    