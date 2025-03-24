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
			$visitePerAdesso = intval( get_post_meta($idPost, "visite", true) );
			// incremento della visita attuale, perchè php viene lanciato ogni volta
			$visitePerAdesso++;
			// aggiorno in banca dati al nuovo valore
			update_post_meta($idPost, "visite", $visitePerAdesso);
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
	
	function datiStatistica(){
		echo "Per utilizzarlo incolla in pagina il seguente testo:";
		echo "<b>[statistica id=".$_GET["post"]."]</b>";
	}
	
	function moduloVisitatori(){
		echo "<p>GET: ".json_encode($_GET)."</p>";
		echo "<p>POST: ".json_encode($_POST)."</p>";
		$idPost = intval($_GET["post"]);
		$visite = get_post_meta($idPost, "visite", true);
		echo "<p>
					<label for='nvisite'>Visite</label>
					<input type='number' value='".$visite."' name='nvisite' id='nvisite'>
				</p>";
	}
	
	add_action("save_post_statistica", "salvaStatistica");
	
	function salvaStatistica(){
		// costruisco un array con dentro sia get che post
		$stato = array(
					"get" => $_GET,
					"post" => $_POST
					);
		// lo convert in json
		$buffer = json_encode($stato, JSON_PRETTY_PRINT);
		// lo salvo su disco per vedere cosa vede il mio server
		// quando gli chiedo di salvare un post
		file_put_contents(__DIR__ . "/registro_statistiche.json", $buffer);
		
		update_post_meta( $_POST["ID"], "visite", $_POST["nvisite"]);
	}
	