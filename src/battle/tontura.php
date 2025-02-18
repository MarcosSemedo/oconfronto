<?php

declare(strict_types=1);

$selectmana = $db->GetOne("select `mana` from `blueprint_magias` where `id`=11");
$mana = $player->reino == '1' || $player->vip > time() ? $selectmana - 5 : $selectmana;

$log = explode(", ", (string) (($_SESSION['battlelog'] ?? null)[0] ?? null));
$magiaatual = $db->GetOne("select `magia` from `bixos` where `player_id`=?", [$player->id]);

if ($player->mana < $mana) {
	if (($log[1] ?? null) !== "Você tentou lançar um feitiço mas está sem mana suficiente.") {
		array_unshift($_SESSION['battlelog'], "5, Você tentou lançar um feitiço mas está sem mana suficiente.");
	}

	$otroatak = 5;
} elseif ($magiaatual != 0) {
	if (($log[1] ?? null) !== "Você não pode ativar um feitiço passivo enquanto outro está ativo.") {
		array_unshift($_SESSION['battlelog'], "5, Você não pode ativar um feitiço passivo enquanto outro está ativo.");
	}

	$otroatak = 5;
} else {
	$db->execute("update `bixos` set `magia`=? where `player_id`=?", [11, $player->id]);
	$db->execute("update `bixos` set `turnos`=? where `player_id`=?", [6, $player->id]);
	$db->execute("update `players` set `mana`=`mana`-? where `id`=?", [$mana, $player->id]);
	array_unshift($_SESSION['battlelog'], "3, Você lançou o feitiço tontura.");
	$db->execute("update `bixos` set `vez`='e' where `player_id`=?", [$player->id]);
}
