<?php

include("lib.php");
define("PAGENAME", "Imagens");

include("templates/header.php");

?>
<style>

td.off {
background: #FFECCC;
}

td.on {
background: #FFFDE0;
}

</style>

<table width="100%" border="0">
  <tr>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center">
	<a href="images/ss/ss1.png" rel="lightbox[screens]" title="V�rias formas de ca�a dispon�veis."><img src="images/ss/ss1.png" width="180" height="160" border="2px" alt="Batalha" /></a><br />
	<br /><strong>Batalha</strong></div></td>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center">
	<a href="images/ss/ss2.png" rel="lightbox[screens]" title="Equipamentos, itens especiais, o ferreiro e o mercado fazem dos itens uma das principais moedas de troca do jogo."><img src="images/ss/ss2.png" width="180" height="160" border="2px" alt="Invent�rio" /></a><br />
        <br /><strong>Invent�rio</strong></div></td>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center">
	<a href="images/ss/ss3.png" rel="lightbox[screens]" title="A luta em turnos al�m de ser agradavel, permite o uso de magias e ataques especiais."><img src="images/ss/ss3.png" width="180" height="160" border="2px" alt="Monstros" /></a><br />
        <br /><strong>Monstros</strong></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0">
  <tr>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center">
	<a href="images/ss/ss4.png" rel="lightbox[screens]" title="Fa�a amigos, crie grupos e cl�s. Converse, troque itens, e at� ca�e com seus amigos!"><img src="images/ss/ss4.png" width="180" height="160" border="2px" alt="Amigos" /></a><br />
        <br /><strong>Amigos</strong></div></td>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center">
	<a href="images/ss/ss5.png" rel="lightbox[screens]" title="Deixe seu personagem trabalhando antes de sair do jogo, e garanta um pouco de outro extra quando voc� voltar."><img src="images/ss/ss5.png" width="180" height="160" border="2px" alt="Trabalho" /></a><br />
	<br /><strong>Trabalho</strong></div></td>
    <td class="off" onmouseover="this.className='on'" onmouseout="this.className='off'" height="200"><div align="center"><a href="images/ss/ss6.png" rel="lightbox[screens]"><img src="images/ss/ss6.png" width="180" height="160" border="2px" alt="Perfil" /></a><br />
      <br /><strong>Perfil</strong></div></td>
  </tr>
</table>

<?php
include("templates/footer.php");
?>