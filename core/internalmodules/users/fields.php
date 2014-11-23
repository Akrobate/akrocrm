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


$fields['id_contact']['type'] = 'join';
$fields['id_contact']['typeSQL'] = 'INT(11)';
$fields['id_contact']['label'] = 'Contact';
$fields['id_contact']['join']['table'] = 'contacts';
$fields['id_contact']['join']['field'] = 'nom';
$fields['id_contact']['join']['type'] = '1-n';
