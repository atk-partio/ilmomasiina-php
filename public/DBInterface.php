<?php

/**
 * T�ss� tiedostossa hoidetaan tietokantayhteydenmuodostaminen, sek�
 * tietokantakyselyt. Aiemmin (tml:n aikaan eli ennen 2007) Athenen sivut
 * pohjautuivat p��osin PostgreSQL tietokantaan. T�m� DBInterface tiedosto
 * sai siis alkunsa kun sivuja siirrettiin otaxille, jossa ei ollut kuin
 * MySQL kanta.
 *
 * Tietokantajutut on toteutettu Pear-paketin MDB2 paketilla. Kannattaa
 * jatkossakin k�ytt�� Pear-paketteja jos niist� vain jotain hy�ty� on
 * sill� se s��st�� py�r�n uudelleen keksimist�
 *
 * MDB2 dokumentaatio:
 * http://pear.php.net/manual/en/package.database.mdb2.php
 *
 * created: 28.10.2007
 * author: Mikko Koski (mikko.koski@tkk.fi)
 */

define("DBTYPE", "mysql");    // Tietokannan tyyppi (esim mysql, pgsql)
define("USERNAME", "root");       // Kannan k�ytt�j�nimi
define("PASSWORD", "root");       // Salasana
define("HOST", "localhost");  // Osoite tietokannan hostiin
define("DATABASE", "scotchbox");       // Tietokannan nimi

define("DEBUG", "1");

// ----- �L� MUOKKAA T�ST� ETEENP�IN JOSSET TIED� MIT� TEET ------ ////////////


// Haetaan tarvittava PEAR-paketti
require_once 'AllowPEARInclude.php';
require_once 'MDB2.php';

$dsn = array(
    'phptype'  => DBTYPE,
    'username' => USERNAME,
    'password' => PASSWORD,
    'hostspec' => HOST,
    'database' => DATABASE,
);

$options = array(
    'debug' => DEBUG,
	 'log_line_break' => "\n\t"
);

$conn = MDB2::factory($dsn, $options);

if ((new PEAR)->isError($conn)) {
    // FIXME Vaihda t�h�n jotain muuta
    die($conn->getMessage());
}

/**
 * Funktio tietokantakutsun tekemiseen
 */
function query($conn, $query_string){
  $res =& $conn->query($query_string);

  // Check if query failed
  if(PEAR::isError($res)){
    print $res->getDebugInfo();
    die($res->getMessage());
  } else {
    return $res;
  }
}
