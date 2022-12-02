<?php
if (isset($_POST['reg'])) {

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $username = $_POST['username'];
    $result = mysqli_query($con, "SELECT * FROM users WHERE user_email='$email'");
    $result2 = mysqli_query($con, "SELECT * FROM users WHERE user_name='$username'");
    if (mysqli_num_rows($result) == 1 & mysqli_num_rows($result2) == 1) {
        print("<h1>A megadott e-mail cím és felhasználónév már használatban van.</h1>");
        ugras("index.php?oldal=reg", 2000);
        return false;
    } 
    if(mysqli_num_rows($result) == 1){
        print("<h1>A megadott e-mail cím már használatban van.</h1>");
        ugras("index.php?oldal=reg", 2000);
        return false;
    }
    if(mysqli_num_rows($result2) == 1){
        print("<h1>A megadott felhasználónév már használatban van.</h1>");
        ugras("index.php?oldal=reg", 2000);
        return false;
    }

    if ($pwd == $pwd2) {


        print "<h1>Sikeres regisztráció.</h1>";
        mysqli_query($con, "INSERT INTO users VALUES ('','$email','$username','$pwd','0','0','',now(),now())");
        ugras("index.php?oldal=login", 2000);
    } else {
        print "<h1>A megadott két jelszó nem egyezik.</h1>";
        ugras("index.php?oldal=reg", 2000);
    }
} else {
    //urlap
?>
<div class="page-heading">
    <h1>Regisztráció</h1>
    <!--<span class="subheading">Add meg az adataidat vagy <a href="index.php?oldal=reg">regisztrálj!</a></span>-->
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
                    <form id="contactForm" action="index.php?oldal=reg" method="POST">
                        <!--data-sb-form-api-token="API_TOKEN"-->
                        <div class="form-floating">
                            <input class="form-control" id="username" name="username" type="text" placeholder="Username"
                                data-sb-validations="required" />
                            <label for="name">Username</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" name="email" type="text" placeholder="E-mail"
                                data-sb-validations="required" />
                            <label for="name">Email</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="pwd" name="pwd" type="password" placeholder="password"
                                data-sb-validations="required" />
                            <label for="name">Jelszó</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="pwd2" name="pwd2" type="password" placeholder="password"
                                data-sb-validations="required" />
                            <label for="name">Jelszó újra</label>
                        </div>


                        <input class="btn btn-primary text-uppercase centers" type="submit" name="reg" value="Regisztráció">

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
}

?>