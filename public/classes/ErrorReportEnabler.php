<?php
/**
 * T�m� funktio laittaa kaikki mahdolliset error viestit n�kyviin.
 * Funktio on tehty debuggaustarkoitukseen sivuja siirrett�essa tml-palvelimelta 
 * otaxille. Normaalik�yt�ss� t�t� ei kannata kutsua.
 */
function enableErrorReports(){
	ini_set('display_errors','1');
	ini_set('display_startup_errors','1');
	error_reporting (E_ALL); 
}

enableErrorReports();