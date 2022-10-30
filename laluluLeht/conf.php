<?php
$serverinimi="localhost";
$kasutaja="Aia21";
$parool="123456";
$andmebaas="aia21";
$yhendus=new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset('UTF8');



/*CREATE TABLE laulud(
id int PRIMARY KEY AUTO_INCREMENT,
lauluNimi varchar(50),
lisamisAeg datetime,
punktid int DEFAULT 0,
kommentaarid text Default 0,
avalik int DEFAULT 1
)*/

/*ALTER TABLE laulud add avalik int DEFAULT 1*/
?>