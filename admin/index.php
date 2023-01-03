<?php
	session_start();
	include("inc/_db.php");
	include("inc/_ugro.php");
	include("inc/_classsetter.php");
	
	
	if((isset($_SESSION['login_jog']) and $_SESSION['login_jog'] < 7) or !isset($_SESSION['login_jog']))
	{
			session_destroy();
			$tartalom="login.php";
	}
	else{
	
	if(isset($_GET['oldal']))
	{
		
				switch($_GET['oldal']){
				case "login"		:$tartalom="login.php"; break;
				case "logout"		:$tartalom="logout.php"; break;
				case "jogosultsagok":$tartalom="jogosultsagok.php"; break;
				case "jog_hozzaad"	:$tartalom="jog_hozzaad.php"; break;
				case "jog_torol"	:$tartalom="jog_torol.php"; break;
				case "jog_modosit"	:$tartalom="jog_modosit.php"; break;
				case "members"		:$tartalom="members.php"; break;
				case "games"		:$tartalom="games.php"; break;
				case "game_add"		:$tartalom="game_add.php"; break;
				default		   		: $tartalom="home.php"; break;
				
			}
		}
		
	
		else{
			$tartalom="login.php";
		}
	}
	
	include("inc/index.html");
?>