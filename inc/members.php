<?php 
$result=mysqli_query($con,"SELECT * FROM users ORDER BY user_name asc");

?>
<table>
   <tr>
    <th style="padding: 9px;">Profilkép</th>
    <th style="padding: 9px;">Felhasználónév</a></th>
    <th style="padding: 9px;">Csatlakozás dátuma</th>
    <th style="padding: 9px;">Kommentek száma</th>
    </tr>
<?php 

while($row=mysqli_fetch_assoc($result)){
    $row_img=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pictures WHERE id=$row[user_profile_picture_id]"));
    $num_comments=(mysqli_num_rows(mysqli_query($con,"SELECT * FROM comments WHERE comment_author='$row[id]'")));
    print '<tr style="text-align:center;"><td><img height=60px width=60px src="';print $row_img['picture_path'];print'" height=60px"></td>';
    print '<td>';print $row['user_name'];print'</td>';
    print '<td>';print substr($row['user_creation_date'], 0, strpos($row['user_creation_date'], ' '));;print'</td>';
    print '<td>';print $num_comments;print'</td></tr>';
}

?>
</table>
