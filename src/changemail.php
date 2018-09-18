<?php
	include("lib.php");
	define("PAGENAME", "Alterar Email");
	$acc = check_acc($secret_key, $db);

	include("templates/acc-header.php");

if ($_GET['act'] == cancel){
    $query = $db->execute("delete from `pending` where `pending_id`=1 and `player_id`=?", array($acc->id));
    echo "<span id=\"aviso-a\"></span>";
    echo "<br/><p><center>A solicita��o para mudan�a de email foi removida. <a href=\"characters.php\">Voltar</a>.</center></p><br/>";
    include("templates/acc-footer.php");
    exit;
}


if ($_POST['submit']) {
    if (!$_POST['senhadaconta']) {
        $errmsg .= "Voc� precisa preencher todos os campos.";
        $error = 1;
    } else if (!$_POST['emaill']) {
        $errmsg .= "Voc� precisa preencher todos os campos.";
        $error = 1;
    } else if (!$_POST['emaill2']) {
        $errmsg .= "Voc� precisa preencher todos os campos.";
        $error = 1;
    } else if (encodePassword($_POST['senhadaconta']) != $acc->password) {
        $errmsg .= "Seu senha antiga est� incorreta.";
        $error = 1;
    } else if ($_POST['emaill'] != $_POST['emaill2']) {
        $errmsg .= "Voc� n�o digitou os dois emails corretamente!";
        $error = 1;
    } else if (strlen($_POST['emaill']) < 3) {
        $errmsg .= "O seu endere�o de email deve conter mais de 5 caracteres.";
        $error = 1;
    } else if (strlen($_POST['emaill']) > 200) {
        $errmsg .= "O seu endere�o de email deve conter menos de 200 caracteres.";
        $error = 1;
    } else if (!preg_match("/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i", $_POST['emaill'])) {
        $errmsg .= "O formato do seu email � inv�lido!";
        $error = 1;
    } else {
        $query = $db->execute("select `id` from `accounts` where `email`=?", array($_POST['emaill']));
        $query2 = $db->execute("select * from `pending` where `pending_id`=1 and `player_id`=?", array($acc->id));
        $query3 = $db->execute("select * from `pending` where `pending_id`=1 and `pending_status`=?", array($_POST['emaill']));
        if ($query->recordcount() > 0) {
            $errmsg .= "Este email j� est� em uso.";
            $error = 1;
        }
        else if ($query2->recordcount() > 0) {
            $errmsg .= "Voc� j� enviou uma solicita��o de mudan�a de email.";
            $error = 1;
        }
        else if ($query3->recordcount() > 0) {
            $errmsg .= "Este email j� est� em uso.";
            $error = 1;
        }
    }
    if ($error == 0) {
        	$insert['player_id'] = $acc->id;
		$insert['pending_id'] = 1;   	  
		$insert['pending_status'] = $_POST['emaill'];
		$insert['pending_time'] = (time() + 1296000);
		$query = $db->autoexecute('pending', $insert, 'INSERT');
        
        echo "<span id=\"aviso-a\"></span>";
        echo "<br/><p><center>Seu email ser� alterado para: " . $_POST['emaill'] . ".<br/>Aguarde 14 dias para que a mudan�a seja efetuada. <a href=\"characters.php\">Voltar</a>.</center></p><br/>";
        include("templates/acc-footer.php");
        exit;
    }
}

    echo "<span id=\"aviso-a\">";
    if ($errmsg != "") {
        echo $errmsg;
    }
    echo "</span>";
    
    echo "<br/><center><font size=\"1px\"><b>Email Atual:</b> " . $acc->email . ".</font></center>";
?>

<p>
<form method="POST" action="changemail.php">
<table width="90%" align="center">
<tr><td width="38%"><b>Senha da conta</b>:</td><td width="62%"><input type="password" name="senhadaconta" value="<?=$_POST['senhadaconta'];?>" class="inp" size="20"/></td></tr>
<tr><td width="38%"><b>Novo email</b>:</td><td width="62%"><input type="text" name="emaill" value="<?=$_POST['emaill'];?>" class="inp" size="20"/></td></tr>
<tr><td width="38%"><b>Repita o email</b>:</td><td width="62%"><input type="text" name="emaill2" value="<?=$_POST['emaill2'];?>" class="inp" size="20"/></td></tr>
</table>
<br/><center><button type="submit" name="submit" value="Atualizar" class="atualizar"></button></center>
</form>
</p>

<?php include("templates/acc-footer.php");
?>