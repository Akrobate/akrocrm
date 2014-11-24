<?php


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
						
						
