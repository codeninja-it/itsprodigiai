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
}

add_shortcode("miaTabellina", "tabellina");