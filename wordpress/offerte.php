<?php
	/*
	Plugin Name: Offerte!!!
	Description: Plugin per gestire le offerte sui miei prodotti
	Author: Daniele Simoncini
	Version: 1.0.0
	*/
	
	add_action("init", "registrazione_custom_post");
	
	function registrazione_custom_post(){
		register_post_type(
			"offerta",
			array(
				"labels"	=> array(
								"name"			=> "Offerte",
								"singular_name" => "offerta",
								"add_new_item"	=> "Aggiungi nuova offerta"
							),
				"public"	=> true,
				"menu_icon"	=> "dashicons-tickets",
				"supports"	=> array("title", "editor")
			)
		);
	}
	
	add_action("add_meta_boxes_offerta", "aggiungi_box");
	
	function aggiungi_box(){
		add_meta_box(
						"boxOfferta", 
						"Dati dell'offerta", 
						"contenutoBoxOfferta",
						null,
						"side"
					);
	}
	
	function contenutoBoxOfferta($post){
		$prezzo = get_post_meta($post->ID, "prezzo", true);
		$scadenza = get_post_meta($post->ID, "scadenza", true);
		echo "<p>
				<label for='prezzo'>Prezzo</label>
				<input type='number' id='prezzo' name='prezzo' value='".$prezzo."'>
			</p>";
		echo "<p>
				<label for='scadenza'>Scadenza</label>
				<input type='date' id='scadenza' name='scadenza' value='".$scadenza."'>
			</p>";
	}
	
	add_action("save_post_offerta", "salvaOfferta");
	
	function salvaOfferta($post_id){
		update_post_meta($post_id, "prezzo", $_POST["prezzo"]);
		update_post_meta($post_id, "scadenza", $_POST["scadenza"]);
	}