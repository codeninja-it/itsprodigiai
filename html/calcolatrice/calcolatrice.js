
// unica funzione di interfaccia
function Esegui(idDa, idA){
	// aggancio i campi di inizio e fine
	var da = document.getElementById(idDa);
	var a = document.getElementById(idA);
	// recupero quanto ha scritto il mio utente
	var comando = da.value;
	// tolgo le maiuscole
	comando = comando.toLowerCase();
	// tolgo tutti gli spazi eccedenti
	comando = comando.trim();
	console.log("l'utente scrive : " + comando);
	var segmenti = comando.split(" ");
	var operazione = segmenti[1]; // 0 -> primo numero, 1 -> operazione, 2 -> secondo numero 
	console.log("l'utente sceglie come operazione : " + operazione );
	if(comandi[operazione] != undefined){
		var risultato = comandi[operazione](segmenti[0], segmenti[2]);
		console.log("il risultato è : " + risultato);
		a.innerText = risultato;
	} else {
		console.log("ma non la conosco");
		a.innerText = "non ho capito cosa mi stai chiedendo...";
	}	
}

function moltiplicazione(a, b){
	return a * b;
}

function divisione(a, b){
	return a / b;
}

function addizione(a, b){
	return parseFloat(a) + parseFloat(b);
}

function sottrazione(a, b){
	return a - b;
}
//						  [0,    1,   2]
// "12 + 4".split(" ") => ["12", "+", "4"];
// "12 più 4".split(" ") => ["12", "più", "4"];
// "12 sommato 4".split(" ") => ["12", "sommato", "4"];

var comandi = {
	"-": sottrazione,			// [12, "-", "2"]	NTN
	"meno": sottrazione,		// 12 meno 2		NTN
	"sottratto": sottrazione,	// 12 sottratto 2	NTN
	"minus": sottrazione,		// 12 minus 2
	"+": addizione,				// 12 + 2
	"più": addizione,
	"sommato": addizione,
	"sum": addizione,
	"*": moltiplicazione,
	"moltiplicato": moltiplicazione,	// 12 moltiplicato 2, 12 moltiplicato per 2
	"X": moltiplicazione,				// radice di 4	TTN
	"per": moltiplicazione,				// 2 elevato per 8	NTTN
	":": divisione,
	"diviso": divisione,
	"/": divisione,
	"su": divisione 
};


function analisiSegmenti(testo){
	
	var daEliminare = [
					"il", "lo", "la", "i", "gli", "le", 
					"di", "a", "da", "in", "con", "tra", "fra", 
					"un", "uno", "una",
					"del", "dei"
					];
					
	for(var i=0; i < daEliminare.length; i++){
		var vecchio = daEliminare[i];
		testo = testo.replaceAll(vecchio, "");
	}
	
	var segmenti = testo.trim().split(" ");
	
	var pattern = "";
	for(var i=0; i < segmenti.length; i++){
		var segmento = segmenti[i];
		pattern += isNaN(segmento) ? "T" : "N";
	}
	return pattern;
}


function segnaNumero(dove, numero){
	var campo = document.getElementById(dove);
	campo.value += numero.toString();
}