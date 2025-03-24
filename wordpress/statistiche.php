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