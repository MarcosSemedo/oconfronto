<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="-1"/>

        <title>O Confronto :: <?php echo PAGENAME?></title>

	<link rel="stylesheet" type="text/css" href="./css/index.css"/>
<link rel="stylesheet" type="text/css" href="example2.css"/>

	<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="jMyCarousel.js"></script>
<script type="text/javascript">
$(function() {
  
  $(".jMyCarousel").jMyCarousel({
                                visible: '3',
                                eltByElt: true,
                                evtStart: 'mousedown',
                                evtStop: 'mouseup'
                                });
  
  });
</script>

<Script Language=JavaScript>
var nText = new Array()
nText[0] = "<font size=\"1\">Escolha sua vocaÁ„o.</font>";
nText[1] = "<font size=\"1\">Os Cavaleiros possuem uma grande defesa mas um baixo ataque.</font>";
nText[2] = "<font size=\"1\">Os Magos s„o nivelados em ataque e defesa.</font>";
nText[3] = "<font size=\"1\">Os Arqueiros possuem um bom ataque mas uma defesa fraca.</font>"
function swapText(isList){
    txtIndex = isList.selectedIndex;
    document.getElementById('textDiv').innerHTML = nText[txtIndex];
}

</Script>

</head>
<body>
        <div id="tudo">

                <div id="topo"></div>

<div id="box">
    <div class="bg-top"></div>
    <div class="bg-fundo">
        <div id="barra-top">
            <a href="logout.php" id="log"></a>
            <a href="characters.php" id="char"></a>
        </div>

        <div id="conteudos">