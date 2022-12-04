<?php
    mysqli_query($con,"DELETE FROM rights WHERE id='$_GET[id]'");
    ugras("index.php?oldal=jogosultsagok",1);
?>