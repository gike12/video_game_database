<?php
	session_start();
	include("inc/_db.php");
	include("inc/_ugro.php");
	include("inc/_classsetter.php");
	if(isset($_GET['oldal']))
	{
		switch($_GET['oldal'])
		{
			case "home"    		: $tartalom="home.php"; break;
			case "login"		: $tartalom="login.php"; break;
			case "reg"			: $tartalom="reg.php"; break;
			case "logout"		: $tartalom="logout.php"; break;
			case "jogosultsagok": $tartalom="jogosultsagok.php"; break;
			case "jog_hozzaad"	: $tartalom="jog_hozzaad.php"; break;
			case "jog_torol"	: $tartalom="jog_torol.php"; break;
			case "jog_modosit"	: $tartalom="jog_modosit.php"; break;
			case "members"		: $tartalom="members.php"; break;
			case "games"		: $tartalom="games.php"; break;
			case "upcoming"		: $tartalom="upcoming.php"; break;
			default		   		: $tartalom="home.html"; break;
		}
	} else {
		$tartalom="home.php";
	}
	
	include("inc/index.html");
?>