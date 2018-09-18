<?php
	include("lib.php");
	define("PAGENAME", "Alterar Senha");
	include("templates/acc-header.php");

	$acc = check_acc($secret_key, $db);

$sucess1 = 0;
$sucess2 = 0;

if ($_POST['changepassword']) {
    //Check password
    if (!$_POST['password']) {
        $errmsg .= "Voc� precisa preencher todos os campos!";
        $error = 1;
    } else if (!$_POST['password2']) {
        $errmsg .= "Voc� precisa preencher todos os campos!";
        $error = 1;
    } else if (!$_POST['oldpassword']) {
        $errmsg .= "Voc� precisa preencher todos os campos!";
        $error = 1;
    } else if ($acc->password != encodePassword($_POST['oldpassword'])) {
	$errmsg .= "Sua senha atual est� incorreta!";
        $error = 1;
    } else if ($_POST['password'] != $_POST['password2']) {
        $errmsg .= "Voc� n�o digitou as duas senhas corretamente!";
        $error = 1;
    } else if (strlen($_POST['password']) < 4) {
        $errmsg .= "Sua senha deve ter mais que 3 caracteres.";
        $error = 1;
    }
    if ($error == 0) {
		$insert['player_id'] = $acc->id;
		$insert['msg'] = "Voc� alterou a senha de sua conta.";
		$insert['time'] = time();
		$query = $db->autoexecute('account_log', $insert, 'INSERT');

        $query = $db->execute("update `accounts` set `password`=? where `id`=?", array(encodePassword($_POST['password']), $acc->id));
        $msg .= "Senha alterada com sucesso.";
	$sucess1 = 1;
    }
}



echo "<span id=\"aviso-a\">";
if ($errmsg != "") {
    echo $errmsg;
}
echo "</span>";

if ($sucess1 == 0){
?>
<br/><p>
<table width="90%" align="center">
<form method="POST" action="accpass.php">
<tr><td width="38%"><b>Senha atual</b>:</td><td width="62%"><input type="password" name="oldpassword" class="inp" size="20"/></td></tr>
<tr><td width="38%"><b>Nova senha</b>:</td><td width="62%"><input type="password" name="password" class="inp" size="20"/></td></tr>
<tr><td width="38%"><b>Digite novamente</b>:</td><td width="62%"><input type="password" name="password2" class="inp" size="20"/></td></tr>
</table>
<br/><center><button type="submit" name="changepassword" value="Atualizar" class="atualizar"></button></center>
</form>
<p />
<?php
}else{
echo "<br/><p><center><b>" . $msg . " <a href=\"characters.php\">Voltar</a>.</b></center></p><br/>";
}

	include("templates/acc-footer.php");

?>