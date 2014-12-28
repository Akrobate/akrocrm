<?php

/**
 *	Fichier de configuration de champs pour le module interne Users
 *
 * @brief		Definition du modele de users
 * @details		Definition des champs de la table interne users
 *				Il s'agit ici d'une table interne qui ne doit pas etre alterée
 *
 * @author		Artiom FEDOROV
 *
 */


$fields = array(
	'email' => array(
						'type' => 'text',
						'label' => 'E-Mail'					
						),
						
	'login' => array(
						'type' => 'text',
						'label' => 'Votre login'					
						),

	'password' => array(
						'type' => 'text',
						'label' => 'Mot de passe'			
						),

	'id_profil' => array(
						'type' => 'join',
						'label' => 'Profil join',
						'join' => array(
							'table' => 'profiles',
							'field' => 'nom',
							'type' => '1-n'
							)				
						),

	'email_login' => array(
						'type' => 'text',
						'label' => 'Email Login'					
						),
												
	'email_password' => array(
						'type' => 'text',
						'label' => 'Email Mot de passe'					
						)
					);						
