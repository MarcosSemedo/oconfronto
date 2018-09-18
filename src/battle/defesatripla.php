<?php
$selectmana = $db->GetOne("select `mana` from `blueprint_magias` where `id`=6");
if (($player->reino == '1') or ($player->vip > time())) {
	$mana = ($selectmana - 5);
} else {
	$mana = $selectmana;
}

$log = explode(", ", $_SESSION['battlelog'][0]);

$magiaatual = $db->GetOne("select `magia` from `bixos` where `player_id`=?", array($player->id));

if ($player->mana < $mana){
	if ($log[1] != "Voc� tentou lan�ar um feiti�o mas est� sem mana sufuciente.") {
		array_unshift($_SESSION['battlelog'], "5, Voc� tentou lan�ar um feiti�o mas est� sem mana sufuciente.");
	}
	$otroatak = 5;
}elseif ($magiaatual != 0){
	if ($log[1] != "Voc� n�o pode ativar um feiti�o passivo enquanto outro est� ativo.") {
		array_unshift($_SESSION['battlelog'], "5, Voc� n�o pode ativar um feiti�o passivo enquanto outro est� ativo.");
	}
	$otroatak = 5;
}else{
	$db->execute("update `bixos` set `magia`=? where `player_id`=?", array(6, $player->id));
	$db->execute("update `bixos` set `turnos`=? where `player_id`=?", array(3, $player->id));
	$db->execute("update `players` set `mana`=`mana`-? where `id`=?", array($mana, $player->id));
	array_unshift($_SESSION['battlelog'], "3, Voc� lan�ou o feiti�o defesa dupla.");
	$db->execute("update `bixos` set `vez`='e' where `player_id`=?", array($player->id));
}
?>