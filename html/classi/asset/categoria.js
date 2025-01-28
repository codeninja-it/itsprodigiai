class Categoria{
	constructor(Nome){
		this.nome = Nome;
		this.prodotti = [];
	}
	
	aggiungiProdotto(prodotto){
		if(this.prodotti.indexOf(prodotto) == -1){
			prodotto.aggiungiCategoria(this);
			this.prodotti.push(prodotto);
		}
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