<table>
<?php 
$today_date=date("Y-m-d");
print'<h1>Latest game relases</h1>
      <div class="gamelistdiv">';
      $result2 = mysqli_query($con,"SELECT * FROM games WHERE game_relase_date <= '$today_date' ORDER BY game_relase_date DESC LIMIT 4");
      while($row2=mysqli_fetch_assoc($result2)){
        
        $g_img = mysqli_query($con,"SELECT * FROM pictures WHERE id='$row2[game_picture_id]'");
        $g_row = mysqli_fetch_assoc($g_img);
        print '
        <td >
          <div class="gamecontainer" style="height: 600px">
            <div class="card" style="width: 14rem;">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><img class="card-img-top" src=';print $g_row["picture_path"];print ' alt="Card image cap" >
          <div class="card-body">
            <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><h5 class="card-title" style="text-align: center;">';print $row2["game_name"];print '</h5></a>
            <p class="card-text gamecontainer">Relase date: <br> ';print $row2["game_relase_date"];print '<br>Rating: ';print $row2["game_rating"];print '/10 <br>';print $row2["game_platforms"];print ' </p>
            <p class="card-text"></p>
          </div>
        </div>
        </td>
        ';
      }
      ?>
      </table>
<table>
<?php
print'<h1>Closest to relase</h1>
<div class="gamelistdiv">';
$result2 = mysqli_query($con,"SELECT * FROM games WHERE game_relase_date > '$today_date' ORDER BY game_relase_date ASC LIMIT 4");
while($row2=mysqli_fetch_assoc($result2)){

$g_img = mysqli_query($con,"SELECT * FROM pictures WHERE id='$row2[game_picture_id]'");
$g_row = mysqli_fetch_assoc($g_img);
print '
<td >
    <div class="gamecontainer" style="height: 600px">
    <div class="card" style="width: 14rem;">
    <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><img class="card-img-top" src=';print $g_row["picture_path"];print ' alt="Card image cap" >
    <div class="card-body">
    <a href="index.php?oldal=games&game_id=';print $row2["id"] ;print '"><h5 class="card-title" style="text-align: center;">';print $row2["game_name"];print '</h5></a>
    <p class="card-text gamecontainer">Relase date: <br> ';print $row2["game_relase_date"];print '<br>Rating: ';print $row2["game_rating"];print '/10 <br>';print $row2["game_platforms"];print ' </p>
    <p class="card-text"></p>
    </div>
</div>
</td>
';
}      

?>
</table>