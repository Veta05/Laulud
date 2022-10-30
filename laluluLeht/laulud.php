<?php
require_once ('conf.php');
global $yhendus;


//Laulude kommenteerimine
if(!empty($_REQUEST['uus_komment'])){
    $kask= $yhendus->prepare("UPDATE laulud SET kommentaarid=Concat(kommentaarid, ?) WHERE id=?");
    $lisakommentaar=$_REQUEST['komment']."\n"; // \n - murra teksti rida
        $kask->bind_param("si", $lisakommentaar, $_REQUEST['uus_komment']);
        $kask->execute();
        header("Location: $_SERVER[PHP_SELF]");
}




//punktide lisamine ja eemaldamine
if(isset($_REQUEST['haal'])) {
    $kask = $yhendus->prepare("UPDATE laulud SET punktid=punktid+1 Where id=?");
    $kask->bind_param('s', $_REQUEST['haal']);
    $kask->execute();

//aadressiriba sisu eemaldamine
    header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_REQUEST['haal2'])) {
    $kask = $yhendus->prepare("UPDATE laulud SET punktid=punktid-1 Where id=?");
    $kask->bind_param('s', $_REQUEST['haal2']);
    $kask->execute();

//aadressiriba sisu eemaldamine
    header("Location: $_SERVER[PHP_SELF]");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laulude leht</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
<header>
<h1>Laulude leht</h1>
    <nav>
        <ul>
            <li>
                <a href="Koduleht.php"> Koduleht </a>
            </li>
            <li>
                <a href="laulud_adminLeht.php"> Admin lehekülg</a>
            </li>
            <li>
                <a href="laulud_adminLeht.php"> GIT hub</a>
            </li>
        </ul>
    </nav>
</header>
<table border="1">
    <tr>
        <th>Laulunimi</th>
        <th>Punktid</th>
        <th>Lisamis aeg</th>
        <th>+ punkt</th>
        <th>- punkt</th>
        <th>Kommentaarid</th>
        <th>Kirjuta ...</th>
    </tr>
    <?php
    // tabeli sisu näitamine
    $kask=$yhendus->prepare('SELECT id, lauluNimi, punktid, lisamisAeg, kommentaarid FROM laulud Where avalik=1');
    $kask->bind_result($id, $lauluNimi, $punktid, $aeg, $kommentaarid);
    $kask->execute();
    while($kask->fetch()){
        echo"<tr id='tt'>";
        echo "<td>".htmlspecialchars($lauluNimi)."</td>";
        echo "<td>$punktid</td>";
        echo "<td>$aeg</td>";
        echo "<td><a href='?haal=$id'>+1 punkt</a></td>";
        echo "<td><a href='?haal2=$id'>-1 punkt</a></td>";
        echo "<td>".nl2br($kommentaarid)."</td>"; // nl2br - break function before newlines in str
        echo "<td>
                <form action='?'>
                <input type='hidden' name='uus_komment' value='$id'>
                <input type='text' name='komment'>
                <input type='submit' value='OK'>
                </form>
              </td>";
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
<?php
$yhendus->close();
?>
</html>
