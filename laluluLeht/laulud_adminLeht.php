<?php
require_once ('conf.php');
global $yhendus;

// kustutamine
if (isset($_REQUEST["kustuta"])){
    $kask=$yhendus->prepare("DELETE FROM laulud WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

//peitmine
if(isset($_REQUEST['peitmine'])) {
    $kask = $yhendus->prepare("UPDATE laulud SET avalik=0 Where id=?");
    $kask->bind_param('s', $_REQUEST['peitmine']);
    $kask->execute();
}

//näitamine
if(isset($_REQUEST['naitamine'])) {
    $kask = $yhendus->prepare("UPDATE laulud SET avalik=1 Where id=?");
    $kask->bind_param('s', $_REQUEST['naitamine']);
    $kask->execute();
}

//nullita
if(isset($_REQUEST['nullita'])) {
    $kask = $yhendus->prepare("UPDATE laulud SET punktid=0 Where id=?");
    $kask->bind_param('s', $_REQUEST['nullita']);
    $kask->execute();
}

//kommentaaride kustutamine
if(isset($_REQUEST['komment_eemaldamine'])){
    $kask =$yhendus->prepare("UPDATE laulud SET kommentaarid=' ' Where id=?");
    $kask->bind_param('s', $_REQUEST['komment_eemaldamine']);
    $kask->execute();
}


?>
<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laulude admin leht</title>
    <link rel="stylesheet" type="text/css" href="StyleAdmin.css">
</head>
<header>
    <h1>Laulude admin leht</h1>
    <nav>
        <ul>
            <li>
                <a href="Koduleht.php"> Koduleht </a>
            </li>
            <li>
                <a href="laulud.php">Laulude nimekiri</a>
            </li>
            <li>
                <a href="laulud_adminLeht.php"> GIT hub</a>
            </li>
        </ul>
    </nav>
</header>
<body>
<table border="1">
    <tr>
        <th>Laulunimi</th>
        <th>Punktid</th>
        <th>Lisamis aeg</th>
        <th>Staatus</th>
        <th>Haldus</th>
        <th>Kustutamine</th>
        <th>Punktide nullitamine</th>
        <th>Kommentaarid</th>
        <th>Kustuta kommentaarid</th>
    </tr>
    <?php
    // tabeli sisu näitamine
    $kask=$yhendus->prepare('SELECT id, lauluNimi, punktid, lisamisAeg, avalik, kommentaarid FROM laulud');
    $kask->bind_result($id, $lauluNimi, $punktid, $aeg, $avalik, $kommentaarid);
    $kask->execute();
    while($kask->fetch()){
        $seisund="Peidetud";
        $param="naitamine";
        $tekst="Näita";
        if($avalik==1){
            $seisund="Avatud";
            $param="peitmine";
            $tekst="Peida";
        }
        echo"<tr id='tt'>";
        echo "<td>".htmlspecialchars($lauluNimi)."</td>";
        echo "<td>$punktid</td>";
        echo "<td>$aeg</td>";
        echo "<td>$seisund</td>";
        echo "<td><a href ='?$param=$id'>$tekst</a></td>";
        echo "<td><a href ='?kustuta=$id'>Kustuta laul</a></td>";
        echo "<td><a href ='?nullita=$id'>Punktid nulliks</a></td>";
        echo "<td>".nl2br($kommentaarid)."</td>";
        echo "<td><a href ='?komment_eemaldamine=$id'>Kustuta</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<footer>
    <strong>&copy; Jelizaveta Aia</strong>
    <?php
    echo "<strong>";
    echo date('Y');
    echo "</strong>"
    ?>
</footer>
</body>
</html>
<?php
$yhendus->close();
?>