// inizializzazione dei punteggi
var utente = 0;
var pc = 0;

function start(){
	// ciclo del nostro gioco
	do {
		// la manche esegue le regole del gioco
		manche();
	} while (utente < 3 && pc < 3);

	// qualcuno ha vinto
	if (utente > pc){
		alert("hai vinto!");
	} else {
		alert("hai perso!");
	}
}

function manche(){
	// chiedo all'utente
	var testo = prompt("scegli (0 - sasso, 1 - carta, 2 - forbice)");
	var sceltaUtente = parseInt( testo );
	// estraggo la mia sceltaPl1
	var sceltaPc = Math.trunc(Math.random() * 3);
	if(
		(sceltaUtente == 0 && sceltaPc == 2) || 	// sasso su forbice o
		(sceltaUtente == 1 && sceltaPc == 0) || 	// carta su sasso o
		(sceltaUtente == 2 && sceltaPc == 1) 		// forbice su carta
	)
	{
		utente = utente + 1;
	} else {
		pc = pc + 1;
	}
}