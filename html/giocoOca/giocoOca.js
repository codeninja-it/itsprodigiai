// se tengo i punteggi dei miei utenti so se sono arrivati alla fine
var giocatori = [0, 0, 0, 0, 0, 0, 0];
// un percorso definito da eventi positivi e negativi
var percorso = [0, 3, 0, -1, 0, 0, 1, 0, -3, -9, 1, 0, 0];
// es.: posizioni[1] < percorso.length == in gioco

function turnoGiocatore(vecchiaPosizione){
	// lancio un dado da 6
	var dado = Math.trunc(Math.random() * 6) + 1;
	// controllare se c'è un bonus od un malus
	var posizioneIpotetica = vecchiaPosizione + dado;
	// leggo se c'è un bonus od un malus
	var valoreCasella = percorso[posizioneIpotetica];
	// convalido la nuova posizione : 7 + 2 = 9 => 7 + (-3) = 4
	var nuovaPosizione = posizioneIpotetica + valoreCasella;
	// rilascio la nuova posizione a chi la userà
	return nuovaPosizione;
}

function turno(dove){
	// per ogni giocatore
	for(var i = 0; i < giocatori.length; i++){
		// data la sua posizione, la modifico tramite
		// il suo turno di gioco
		giocatori[i] = turnoGiocatore( giocatori[i] );
		// l'utente visto che conta partendo da 0 (compreso)
		// vince da la quantità di caselle - 1 in poi
		var traguardo = percorso.length - 1;
		if(giocatori[i] >= traguardo){ // 13
			if(giocatori[i] == traguardo){
				alert("Ha vinto il Player " + i);
			} else {
				// serie circolare
				// posizione - traguardo = differenza => 16 - 12 = 4
				// rimbalzo
				// posizione = posizione - differenza;
				giocatori[i] = 0;
			}
		}
	}
	// coinvolgere l'utente
	creaTabellone(dove);
}

function creaTabellone(dove){
	// individuo il target su cui lavorare
	var target = document.getElementById(dove);
	// resetto il contenuto del target
	target.innerHTML = "";
	// per ogni casella
	for(var i=0; i < percorso.length; i++){
		var pedine = "";
		// per ogni utente capire se è nella casella i
		for(var j=0; j < giocatori.length; j++){
			if(giocatori[j] == i){
				// se è nella casella i aggiungere una pedina alla variabile pedine 
				pedine += " &#128512;";
			}
		}		
		// così da poter usare la loro somma nella creazione del div
		// inserire nel target la sua rappresentazione
		target.innerHTML += "<div id='Oca" + i + 
							"' class='casella'> " + i + 
							" " + pedine + 
							"</div>";
	}
}