<?php
include("lib.php");
define("PAGENAME", "Tutorial");
$player = check_user($secret_key, $db);

if ($_GET['skip'] == true)
{
$query = $db->execute("update `pending` set `pending_status`=90 where `pending_id`=2 and `player_id`=?", array($player->id));
header("Location: home.php");
exit;
}

include("templates/private_header.php");

if (!$_GET['act'])
{
$numero = 1;
}else{
$numero = $_GET['act'];
}

echo"<br/><center><img src=\"images/tutorial/" . $numero . ".png\" border=\"0\"></center>";


	echo "<table width=\"100%\" border=\"0\"><tr>";
	echo "<td width=\"50%\">";
		if ($numero == 1){
			echo"<a href=\"tutorial.php?skip=true\"><img src=\"images/tutorial/skip.png\" border=\"0\"></a>";
		}else{
			echo"<a href=\"tutorial.php?act=" . ($numero - 1) . "\"><img src=\"images/tutorial/previous.png\" border=\"0\"></a>";
		}
	echo "</td>";
	echo "<td width=\"50%\" align=\"right\">";
		if ($numero == 14){
			echo"<a href=\"tutorial.php?skip=true\"><img src=\"images/tutorial/end.png\" border=\"0\"></a>";
		}else{
			echo"<a href=\"tutorial.php?act=" . ($numero + 1) . "\"><img src=\"images/tutorial/next.png\" border=\"0\"></a>";
		}
	echo "</td>";
	echo "</tr></table>";

include("templates/private_footer.php");
?>