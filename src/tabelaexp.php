<?php
include("lib.php");
define("PAGENAME", "Membros");
$player = check_user($secret_key, $db);

include("templates/private_header.php");


    for ($i = 1; $i <= 800; $i++) {
        echo $i;
        echo " - ";
        echo maxExp($i);
        echo "<br/>";
    }

include("templates/private_footer.php");
?>