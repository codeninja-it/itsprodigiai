
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
	"-": sottrazione,
	"meno": sottrazione,
	"sottratto": sottrazione,
	"minus": sottrazione,
	"+": addizione,
	"più": addizione,
	"sommato": addizione,
	"sum": addizione,
	"*": moltiplicazione,
	"moltiplicato": moltiplicazione,
	"X": moltiplicazione,
	":": divisione,
	"diviso": divisione,
	"/" : divisione
};