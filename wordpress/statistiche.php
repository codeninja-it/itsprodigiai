<?php
	/*
	Plugin Name: Statistiche!!!
	Description: Plugin per gestire singolarmente le statistiche di pagina!
	Author: Daniele Simoncini
	Version: 1.0.0
	*/
	
	function inizializza(){
		register_post_type(
			"statistica",
			array(
				"labels"	=> array(
								"name"			=> "Statistiche",
								"singular_name" => "statistica",
								"add_new_item"	=> "Aggiungi nuova statistica"
							),
				"public"	=> true,
				"menu_icon"	=> "dashicons-chart-line",
				"supports"	=> array("title", "excerpt")
			)
		);
		
	}
	
	add_action("init", "inizializza");
	
	// es.: [statistica id=63]
	function registraStatistica($attributi){
		// se l'utente mi dice quale statistica vuole usare
		if(isset($attributi["id"])){
			// recupero il suo id per poterlo usare
			$idPost = $attributi["id"];
			// con questo trovo quante visite sono già state registrate
			$visitePerAdesso = intval( get_post_meta($idPost, "visite", true) );  // "12" => 12, "ciao" => 0 
			// incremento della visita attuale, perchè php viene lanciato ogni volta
			$visitePerAdesso++;
			// aggiorno in banca dati al nuovo valore
			update_post_meta($idPost, "visite", $visitePerAdesso);
			
			// e salvo anche la data e l'ora attuale
			$dataAttuale = date("Y-m-d H:i:s");
			update_post_meta($idPost, "ultimaVisita", $dataAttuale );
			return $visitePerAdesso."<br>".$dataAttuale;
		}
	}
	
	add_shortcode("statistica", "registraStatistica");
	
	
	add_action("add_meta_boxes_statistica", "attivaBox");
	function attivaBox(){
		add_meta_box(
						"boxStatistica", 
						"Come utilizzarlo", 
						"datiStatistica",
						null,
						"side"
					);
		add_meta_box( "boxModificaVisite", "Visitatori totali", "moduloVisitatori" );
	}
	
	function datiStatistica($post){
		echo "Per utilizzarlo incolla in pagina il seguente testo:";
		echo "<b>[statistica id=".$post->ID."]</b>";
	}
	
	function moduloVisitatori($post){
		$visite = get_post_meta($post->ID, "visite", true);
		echo "<p>
					<label for='nvisite'>Visite</label>
					<input type='number' value='".$visite."' name='nvisite' id='nvisite'>
				</p>";
	}
	
	add_action("save_post_statistica", "salvaStatistica");
	
	function salvaStatistica($post_id){
		// costruisco un array con dentro sia get che post
		$stato = array(
					"get" => $_GET,
					"post" => $_POST
					);
		// lo convert in json
		$buffer = json_encode($stato, JSON_PRETTY_PRINT);
		// lo salvo su disco per vedere cosa vede il mio server
		// quando gli chiedo di salvare un post ( __FILE__ )
		file_put_contents(__DIR__ . "/registro_statistiche.json", $buffer);
		
		$visite = isset($_POST["nvisite"]) ? $_POST["nvisite"] : 0;
		 
		update_post_meta($post_id, "visite", $visite);
	}
	
	add_action("rest_api_init", "init_rest");
	
	function init_rest(){
		// registro un endpoint che risponderà abs
		// http://127.0.0.1/wordpress/wp-json/statistiche/tutte/
		register_rest_route(
			"statistiche",	// radice dell'endpoint, ovvero lo spazio dei nomi
			"tutte",		// nome dell'endpoint
			array(
				"methods"	=> "GET",			// metodo HTTP che innescherà l'endpoint
				"callback"	=> "esporta_json"	// funzione che verrà attivata	
			)
		);
	}
	
	function esporta_json(){
		$buffer = [];
		
		// recuperare tutti i post di tipo statistica
		$tutti = get_posts(
					array(
						"post_type" => "statistica"
					)
				);
		// per ognuno di essi
		foreach($tutti as $singolo){
			// aggiungere un elemento al nostro array
			$buffer[] = array(
							"id" 			=> $singolo->ID,
							"titolo"		=> $singolo->post_title,
							"autore"		=> $singolo->post_author,
							"descrizione"	=> $singolo->post_excerpt,
							"creazione"		=> $singolo->post_date,
							"visite"		=> get_post_meta( $singolo->ID, "visite", true )
						);
		}
		
		return $buffer;
	}