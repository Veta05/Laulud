<?php
require_once ('conf.php');
global $yhendus;

//tabeli sisu lisamine
if(!empty($_REQUEST["uusnimi"])) {
    $kask = $yhendus->prepare("INSERT INTO laulud(lauluNimi, lisamisAeg) VALUES (?, NOW())");
    $kask->bind_param('s', $_REQUEST["uusnimi"]);
    $kask->execute();

    header("Location: laulud.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Koduleht</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
<header>
    <h1>Koduleht</h1>
    <nav>
        <ul>
            <li>
                <a href="laulud.php">Laulude nimekiri</a>
            </li>
            <li>
                <a href="laulud_adminLeht.php"> Admin lehekülg </a>
            </li>
            <li>
                <a href="laulud_adminLeht.php"> GIT hub</a>
            </li>
        </ul>
    </nav>
</header>
<div>
    <h2>Laulu lisamine</h2>
    <form onclick="" action="?">
        <label for="nimi">Laulu nimi</label>
        <input type="text" name="uusnimi" id="nimi" placeholder="Kirjuta laulu nimi">
        <input type="submit" value="OK">
    </form>
</div>
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