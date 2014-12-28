<?php

/**
 *	Fichier de configuration de champs pour le module profils
 *
 * @brief		Definition du modele de profils
 * @details		Definition des champs de la table profils
 *
 * @author		Artiom FEDOROV
 *
 */
 
$fields = array(
	'nom' => array(
		'type' => 'text',
		'label' => 'Nom'
		),
	
	'acl' => array(
		'type' => 'largetext',
		'label' => 'ACL'
		),
		
	'view' => array(
		'type' => 'largetext',
		'label' => 'View prefs'
		),
);
