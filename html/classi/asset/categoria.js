class Categoria{
	constructor(Nome, idTarget){
		this.nome = Nome;
		this.target = document.getElementById(idTarget);
		this.prodotti = [];
	}
	
	aggiungiProdotto(prodotto){
		if(this.prodotti.indexOf(prodotto) == -1){
			prodotto.aggiungiCategoria(this);
			this.prodotti.push(prodotto);
		}
		this.target.innerHTML = this.toHTML();
	}
	
	applicaSconto(sconto = 20){
		for(var i=0; i < this.prodotti.length; i++){
			this.prodotti[i].applicaSconto(sconto);
		}
	}
	
	toHTML(){
		var buffer = "";
		buffer += "<div class='row'>";
		for(var i=0; i < this.prodotti.length; i++){
			buffer += this.prodotti[i].toHTML();
		}
		buffer += "</div>";
		return buffer;
	}
}