<?php

/**
 * @brief		Definition du modele de users
 * @details		Definition des champs de la table interne users
 *				
 * @author		Artiom FEDOROV
 */

$fields['email']['typeSQL'] = 'VARCHAR(255)';
$fields['email']['type'] = 'text';
$fields['email']['label'] = 'E-Mail';

$fields['login']['typeSQL'] = 'VARCHAR(255)';
$fields['login']['type'] = 'text';
$fields['login']['label'] = 'Votre login';

$fields['password']['typeSQL'] = 'VARCHAR(255)';
$fields['password']['type'] = 'text';
$fields['password']['label'] = 'Mot de passe';


$fields['id_profil'] = array(
						'typeSQL' => 'INT(11)',
						'type' => 'join',
						'label' => 'Profil join',
						'join' => array(
							'table' => 'profiles',
							'field' => 'nom',
							'type' => '1-n'
							)				
						);


$fields['email_login'] = array(
						'typeSQL' => 'VARCHAR(255)',
						'type' => 'text',
						'label' => 'Email Login'					
						);
						
						
$fields['email_password'] = array(
						'typeSQL' => 'VARCHAR(255)',
						'type' => 'text',
						'label' => 'Email Mot de passe'					
						);						
