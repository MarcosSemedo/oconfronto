<?php
include("lib.php");
define("PAGENAME", "Sobre o Jogo");
include("templates/header.php");

if ($_GET['r']) {
	$usaar = $_GET['r'];
} else {
	$usaar = "1";
}

?>

<fieldset>
<legend><b>O Confronto</b></legend>
O Confronto � um jogo web-based medieval. Em sua jornada, voc� ir� seguir os passos de um guerreiro medieval, lutando contra monstros e criaturas, fazendo miss�es e participando de muitas aventuras.
<br/><br/>
Monstros, PVP, Torneios, Miss�es, Magias, Trabalhos, Mercado, e muitas outras fun��es ir�o te surpreender neste game.
<br/><br/>
Comece j� a jogar e descubra este novo mundo. <a href="register.php?r=<?php echo $usaar?>">Clique aqui para se registar</a>.
</fieldset>

<?php
include("templates/footer.php");
?>