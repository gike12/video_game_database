<?php

    if(isset($_POST['login'])){
        //ellentorzes
        $email=$_POST['email'];
        $pwd=$_POST['pwd'];
        $result=mysqli_query($con,"SELECT * FROM users WHERE (user_email='$email' OR user_name='$email') AND user_pwd='$pwd'");
        if(mysqli_num_rows($result) == 1) {
            print "<h1>Sikeres bejelentkezés</h1>";
           // mysqli_query($con,"UPDATE user SET utolso_belepes=now() WHERE email='$email' and password='$pwd'");

            $row=mysqli_fetch_assoc($result);
            mysqli_query($con,"UPDATE users SET user_last_sign_in=now() WHERE id='$row[id]'");
            $_SESSION['login_id'] = $row['id'];
            $rightrow=mysqli_fetch_assoc(mysqli_query($con,"SELECT rights_level FROM rights WHERE id='$row[user_rights_id]'"));
            $_SESSION['login_jog'] = $rightrow['rights_level'];
            $_SESSION['username'] = $row['user_name'];
            $result1=mysqli_query($con,"SELECT * FROM pictures WHERE id='$row[user_profile_picture_id]'");
            $row2=mysqli_fetch_assoc($result1);
            $_SESSION['pic_path']=$row2['picture_path'];
           ugras("index.php",1000);
        }
        else {
            print "<h1>Hibás email vagy jelszó.</h1>";
            ugras("index.php?oldal=login",1000);
        }
    }
    else {
        //urlap
        ?>
<div class="page-heading">
    <h1>Bejelentkezés</h1>
    <span class="centers">Jelentkezzen be vagy <a href="index.php?oldal=reg">regisztráljon!</a></span>
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
                    <form id="contactForm" action="index.php?oldal=login" method="POST">

                        <div class="form-floating">
                            <input class="form-control" id="email" name="email" type="text" placeholder="E-mail"
                                data-sb-validations="required" />
                            <label for="name">Email / Username</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="pwd" name="pwd" type="password" placeholder="password"
                                data-sb-validations="required" />
                            <label for="name">Jelszó</label>
                        </div><br>

                        <input class="btn btn-primary text-uppercase centers" type="submit" name="login" value="Login">

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php    
}

?>