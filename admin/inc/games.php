    <?php 
      $result = mysqli_query($con,"SELECT * FROM games");
      $row = mysqli_fetch_assoc($result);
     if(isset($_GET['game_id'])){
      $game_result=mysqli_query($con,"SELECT * FROM games WHERE id=$_GET[game_id]");
      $game_row=mysqli_fetch_assoc($game_result);

      $gamepicture= mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pictures WHERE id='$game_row[game_picture_id]'"));
      print'
      <h1>';print $game_row['game_name']; print'</h1> 
      

      <img class="game_img_size" src=';print'..\\'; print $gamepicture["picture_path"];print '></img>

      <form id="contactForm" action="index.php?oldal=games&game_id=';print $_GET['game_id'];print '" method="POST">';?>
      
      <?php
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