<?php
        $id=$_SESSION['login_id'];
        $result=mysqli_query($con,"SELECT * FROM users WHERE id='$id'");
        $row=mysqli_fetch_assoc($result);
        $jog_result=mysqli_query($con,"SELECT * FROM rights");
        if (isset($_POST['modos'])) {

            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            $pwd2 = $_POST['pwd2'];
            $username = $_POST['username'];
            $result2 = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
            $same_email_resoult = mysqli_query($con, "SELECT * FROM users WHERE user_email='$email' AND NOT id='$id'");
            $same_name_resoult = mysqli_query($con, "SELECT * FROM users WHERE user_name='$username' AND NOT id='$id'");

           
            if (mysqli_num_rows($same_email_resoult) > 0 & mysqli_num_rows($same_name_resoult) > 0) {
                print $_POST['id'];
                print("<h1>A megadott e-mail cím és felhasználónév már használatban van.</h1>");
                ugras("index.php?oldal=members", 2000);
                return false;
            } 
            if(mysqli_num_rows($same_email_resoult) > 0){
                print("<h1>A megadott e-mail cím már használatban van.</h1>");
                ugras("index.php?oldal=members", 2000);
                return false;
            }
            if(mysqli_num_rows($same_name_resoult) > 0){
                print("<h1>A megadott felhasználónév már használatban van.</h1>");
                ugras("index.php?oldal=members", 2000);
                return false;
            }
        
            if ($pwd == $pwd2) {
                if(isset($_FILES['imgup']) & !empty($_FILES['imgup']['name'])){

                $file=$_FILES['imgup'];
                $fileName=$_FILES['imgup']['name'];
                $fileTmpName=$_FILES['imgup']['tmp_name'];
                $fileSize=$_FILES['imgup']['size'];
                $fileError=$_FILES['imgup']['error'];
                $fileType=$_FILES['imgup']['type'];
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                
                $allowed = array('jpg','jpeg','png');
                if(in_array($fileActualExt, $allowed)){
                    if ($fileError === 0){
                        if($fileSize <= 5_000_000){
                            $fileNameNew = uniqid('',true).".".$fileActualExt;
                            $fileDestination = 'assets/images/pictures/'.$fileNameNew;

                            mysqli_query($con,"INSERT INTO pictures VALUES ('','$_SESSION[login_id]','$fileNameNew','$fileDestination','profile_pic')");
                            $result_pic = mysqli_query($con,"SELECT * FROM pictures WHERE picture_name='$fileNameNew'");
                            $row_pic = mysqli_fetch_assoc($result_pic);
                            mysqli_query($con, "UPDATE users SET user_name='$username',user_email='$email',user_pwd='$pwd',user_profile_picture_id='$row_pic[id]' WHERE id='$id'");
                            move_uploaded_file($fileTmpName,$fileDestination);
                            $_SESSION['pic_path']=$fileDestination;
                        } else{echo "<h1>Túl nagy fileméret! (5Mb max) </h1>"; return false;}
                    } else {echo "<h1> Hiba történt a file feltöltése közben! </h1>"; return false;}
                } else {echo "<h1> Nem tölthetsz fel ilyen file-formátumot! </h1>"; return false;}
            } 
             else mysqli_query($con, "UPDATE users SET user_name='$username',user_email='$email',user_pwd='$pwd' WHERE id='$id'");
                            print "<h1>Sikeres módosítás.</h1>";
                        ugras("index.php?oldal=members", 2000);
            }
             else {
                print "<h1>A megadott két jelszó nem egyezik.</h1>";
                ugras("index.php?oldal=members", 2000);
            }
        } else {
           
            print'
            <h1>Felhasználói fiók módosítása</h1>
    <main class="mb-4">
    <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="my-5">
                        <form id="contactForm" action="index.php?oldal=account_change" method="POST" enctype="multipart/form-data">
                        <div class="form-floating" hidden></div>
                        <div class="form-floating">
                                <input class="form-control" hidden id="id_value" name="id_value" type="text" placeholder="id_value"
                                    data-sb-validations="required" value=';print $row['id'];print' readonly/>
                                <label for="name">ID</label>
                            </div>
    
                            <div class="form-floating">
                                <input class="form-control" id="username" name="username" type="text" placeholder="Username"
                                    data-sb-validations="required" value=';print $row['user_name'];print' />
                                <label for="name">Username</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" name="email" type="text" placeholder="E-mail"
                                    data-sb-validations="required" value=';print $row['user_email'];print' />
                                <label for="name">Email</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="pwd" name="pwd" type="password" placeholder="password"
                                    data-sb-validations="required" value=';print $row['user_pwd'];print' />
                                <label for="name">Jelszó</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="pwd2" name="pwd2" type="password" placeholder="password"
                                    data-sb-validations="required" value=';print $row['user_pwd'];print' />
                                <label for="name">Jelszó újra</label>
                            </div>
    
                            <div class="mb-3 form-control">
                                    <label for="formFile" class="form-label">Indexkép</label>
                                    <input class="form-control" type="file" id="imgup" name="imgup" type="imgup">
                                </div>
                            
    
    
                            <input class="btn btn-primary text-uppercase centers" type="submit" name="modos" value="Módosít">
    
                        </form>
    </div>
    </div>
    </div>
    </div>
    </main>';
}
?>