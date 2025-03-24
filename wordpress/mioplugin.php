<?php
/*
Plugin Name: Mio Plugin!!!
Description: Esempio di creazione di un plugin per wordpress
Author: Daniele Simoncini
Version: 1.0.0
*/

// index.php?cerca=gattini 
function ricerca(){
	if(isset($_GET["cerca"])){
		// l'utente ha usato il form e quindi posso analizzare le sue richieste
		return "<p>hai cercato " . $_GET["cerca"] . "</p>";
	} else {
		// nessun ha usato il form
		return "<form method='get'>
					<p>
						<input name='cerca' placeholder='cosa vuoi cercare?' />
					</p>
					<button>cerca</button>
				</form>";
	}
}

// [miaRicerca]
add_shortcode("miaRicerca", "ricerca");

function tabellina(){
	// se l'utente non ha ancora usato il form glielo mostro
	// altrimenti leggo i parametri get base e ripetizioni
	// e con questi stampo quella tabellina
	// es.: ?base=2&ripetizioni=10 => <p>2 x 1 = 2</p>[..]<p>2 X 10 = 20</p>
	$buffer = "";
	
	if(isset($_GET["base"]) && isset($_GET["ripetizioni"])){
		$base = $_GET["base"];
		$ripetizioni = $_GET["ripetizioni"];
		$buffer .= "<h3>Tabellina del ".$base."</h3>";
		for($i=0; $i < $ripetizioni ; $i++){
			$risultato = $base * $i;
			$buffer .= "<p>".$base." X ".$i." = ".$risultato."</p>";
		}
	} else {
		$buffer = "<form>
						<p><input name='base' placeholder='base della tabellina' type='number' /></p>
						<p><input name='ripetizioni' placeholder='numero di righe' type='number' /></p>
						<button>Genera</button>
					</form>";
	}
	
	return $buffer;
}

add_shortcode("miaTabellina", "tabellina");


function analisi($attributi, $contenuto, $nometag){
	$testoDaSpedire = "<h6>TAG ".$nometag."</h6>";
	$testoDaSpedire .= "<p>attributi: " . json_encode($attributi, JSON_NUMERIC_CHECK) . "</p>";
	$testoDaSpedire .= "<p>contenuto: " . $contenuto . "</p>";
	return $testoDaSpedire;
}

add_shortcode("miaAnalisi", "analisi");