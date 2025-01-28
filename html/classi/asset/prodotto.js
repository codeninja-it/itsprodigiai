/*
	CREATE TABLE prodotto (
		text nome DEFAULT "",
		text descrizione DEFAULT "",
		double prezzo DEFAULT 5
	)
*/

// ricetta del prodotto
class Prodotto {
	// quello che capita qui dentro
	// viene eseguito alla creazione del prodotto
	constructor(Nome, Descrizione, Euro){
		this.nome = Nome;
		this.descrizione = Descrizione;
		this.prezzo = Euro;
		this.categorie = [];
		this.componenti = [];
	}
	
	addComponente(prodotto){
		this.componenti.push(prodotto);
	}
	
	dammiPrezzo(){
		if(this.componenti.length > 0){
			var somma = 0;
			for(var i=0; i < this.componenti.length; i++){
				somma += this.componenti[i].dammiPrezzo();
			}
			return somma;
		} else {
			return this.prezzo;
		}
	}
	
	aggiungiCategoria(categoria){
		if(this.categorie.indexOf(categoria) == -1){
			this.categorie.push(categoria);
		}
	}
	
	applicaSconto(quanto = 20){
		var residuo = (100 - quanto) / 100;
		this.prezzo = this.prezzo * residuo;
	}
	
	rimuoviSconto(quanto = 20){
		var residuo = (100 - quanto) / 100;
		this.prezzo = this.prezzo / residuo;
	}
	
	toHTML(){
		var buffer = "";
		buffer += "<div class='col-4'>";
			buffer += "<div class='card'>";
				buffer += "<div class='card-header'>" + this.nome + "</div>";
				buffer += "<div class='card-body'>" + this.descrizione + "</div>";
				buffer += "<div class='card-footer'>" + this.dammiPrezzo() + "</div>";
			buffer += "</div>";
		buffer += "</div>";
		return buffer;
	}
}