// configurazione
var txtAltezza = document.getElementById("txtAltezza");
var txtPeso = document.getElementById("txtPeso");

var divBMI = document.getElementById("divBMI");
var divMessaggio = document.getElementById("divMessaggio");

var classiPeso =
				[
					"severo sottopeso",		// < 16.5
					"sottopeso",			// < 18.5
					"normopeso",			// < 25
					"leggero sovrappeso",	// < 30.1
					"sovrappeso",			// < 35
					"obesità",				// < 40
					"grave obesità"			// tutti gli altri
				];
				
function calcolaBMI(){
	var peso = parseFloat(txtPeso.value); // recupero il peso
	var altezza = parseFloat(txtAltezza.value); // recupero l'altezza
	var decimali = 3;
	var bmi = peso / (altezza * altezza); // calcolo il BMI
	divBMI.innerText = riduceDecimali(bmi, decimali); // e lo inserisco nel div
	var indice = 6; // ipotizzo che la classe sia 6
	if(bmi < 16.5) // per poter smentire
		indice = 0;
	else if (bmi < 18.5)
		indice = 1;
	else if (bmi < 25)
		indice = 2;
	else if (bmi < 30.1)
		indice = 3;
	else if (bmi < 35)
		indice = 4;
	else if (bmi < 40)
		indice = 5;
	divMessaggio.innerText = classiPeso[indice]; // e scrivo il messaggio
}

function riduceDecimali(numero, quanti = 2){
	return Math.round(numero * Math.pow(10, quanti)) / Math.pow(10, quanti);
}