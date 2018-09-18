<?php
include("lib.php");
define("PAGENAME", "Reino");
$player = check_user($secret_key, $db);

$query = $db->execute("select * from `reinos` where `id`=?", array($player->reino));
$reino = $query->fetchrow();

if ($reino['imperador'] == $player->id) {
	if ($_POST['submit']){
		$query = $db->execute("select `id` from `players` where `id`!=? and `reino`=?", array($player->id, $player->reino));
		if (($_POST['work'] == 10) or ($_POST['work'] == 15) or ($_POST['work'] == 20)){
			if ($_POST['work'] == 10){
				$work = '0.1';
				$preco = ceil(300 * ($query->recordcount() + 1 ));
			} elseif ($_POST['work'] == 15){
				$work = '0.15';
				$preco = ceil(400 * ($query->recordcount() + 1 ));
			} elseif ($_POST['work'] == 20){
				$work = '0.2';
				$preco = ceil(500 * ($query->recordcount() + 1 ));
			}

			if ($preco > $reino['ouro']) {
				include("templates/private_header.php");
				echo "Seu reino n�o possui ouro suficiente para esta mudan�a. <a href=\"reino.php\">Voltar</a>.";
				include("templates/private_footer.php");
				exit;
			}

			if ($reino['worktime'] > time()) {
				header("Location: reino_work.php?success=false");
				exit;
			}

			$db->execute("update `reinos` set `ouro`=`ouro`-?, `work`=?, `worktime`=? where `id`=?", array($preco, $work, time() + 432000, $player->reino));

			while($member = $query->fetchrow()) {
				$logmsg = "Os sal�rios trabalhistas foram alterados. B�nus salarial de " . ($work * 100) . "% por 5 dias.";
				addlog($member['id'], $logmsg, $db);
			}

			$insert['reino'] = $player->reino;
			$insert['log'] = "Os sal�rios trabalhistas foram alterados.<br/>B�nus salarial de " . ($work * 100) . "% por 5 dias.";
			$insert['time'] = time();
			$db->autoexecute('log_reino', $insert, 'INSERT');

			header("Location: reino_work.php?success=true");
			exit;
		}
	}

	include("templates/private_header.php");
	if ($_GET['success'] == 'true') {
		echo showAlert("B�nus salarial adicionado com sucesso.", "green");
	} elseif ($_GET['success'] == 'false') {
		echo showAlert("Um b�nus salarial j� est� ativo.", "red");
	} else {
		echo showAlert($reino['ouro'] . " moedas de ouro nos cofres do reino.");
	}

	echo "<table width=\"100%\" align=\"center\">";
	echo "<tr><td width=\"35%\">";

		echo "<table width=\"100%\" style=\"text-align: center;\">";
			echo "<tr><td class=\"brown\" width=\"100%\"><center><b>B�nus Salarial</b></center></td></tr>";
			echo "<tr><td class=\"off\">";

				echo "<table width=\"100%\">";
				$query = $db->execute("select `id` from `players` where `reino`=?", array($player->reino));
				echo "<tr><td>10%</td><td>de b�nus por</td><td>" . ceil(300 * $query->recordcount()) . "</td></tr>";
				echo "<tr><td>15%</td><td>de b�nus por</td><td>" . ceil(400 * $query->recordcount()) . "</td></tr>";
				echo "<tr><td>20%</td><td>de b�nus por</td><td>" . ceil(500 * $query->recordcount()) . "</td></tr>";
				echo "</table>";

				echo "<font size=\"1px\">Os b�nus sal�riais duram 5 dias.</font>";

			echo "</td></tr>";
		echo "</table>";

	echo "</td>";
	echo "<td width=\"65%\">";

		echo "<table width=\"100%\" style=\"text-align: center;\">";
			echo "<tr><td class=\"brown\" width=\"100%\"><center><b>Ajustar Sal�rios</b></center></td></tr>";
			echo "<tr><td class=\"salmon\">";

				echo "<font size=\"1px\">Voc� pode usar o dinheiro dos cofres do reino para<br/>aumentar o sal�rio dos trabalhadores do reino por 5 dias.</font>";

				if ($reino['gates'] > time()){
					echo "<p><b>B�nus sal�riais de " . ($reino['work'] * 100) . "% j� est�o ativos.</b></p>";
				} else {
					echo "<p><form method=\"POST\" action=\"reino_work.php\">";
					echo "<b>B�nus de:</b> ";

					echo "<select name=\"work\">";
						if (($reino['work'] == '0.1') or ($reino['work'] == '0')){
							echo "<option value=\"10\" selected=\"selected\">10%</option>";
							echo "<option value=\"15\">15%</option>";
							echo "<option value=\"20\">20%</option>";
						} elseif ($reino['work'] == '0.15'){
							echo "<option value=\"10\">10%</option>";
							echo "<option value=\"15\" selected=\"selected\">15%</option>";
							echo "<option value=\"20\">20%</option>";
						} elseif ($reino['work'] == '0.2'){
							echo "<option value=\"10\">10%</option>";
							echo "<option value=\"15\">15%</option>";
							echo "<option value=\"20\" selected=\"selected\">20%</option>";
						}
					echo "</select>";

					echo "<input type=\"submit\" name=\"submit\" value=\"Atualizar Sal�rios\">";
					echo "</form></p>";
				}

			echo "</td></tr>";
		echo "</table>";

	echo "</td></tr>";
	echo "</table>";
	echo "<a href=\"reino.php\">Voltar</a>.";
	include("templates/private_footer.php");
	exit;
} else {
    header("Location: home.php");
}
?>