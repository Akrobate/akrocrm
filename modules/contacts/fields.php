<?php

/**
 *	Fichier de configuration de champs pour le module Contacts
 *
 * @brief		Definition du modele de Contacts
 * @details		Definition des champs de la table Contacts
 *
 * @author		Artiom FEDOROV
 *
 */

$fields['photo']['typeSQL'] = 'VARCHAR(255)';
$fields['photo']['type'] = 'photourl';
$fields['photo']['label'] = 'Portrait';

$fields['nom']['typeSQL'] = 'VARCHAR(255)';
$fields['nom']['type'] = 'text';
$fields['nom']['label'] = 'Nom';

$fields['prenom']['typeSQL'] = 'VARCHAR(255)';
$fields['prenom']['type'] = 'text';
$fields['prenom']['label'] = 'Prenom';

$fields['naissance']['typeSQL'] = 'DATE';
$fields['naissance']['type'] = 'date';
$fields['naissance']['label'] = 'Date de naissance';

$fields['telephone']['typeSQL'] = 'VARCHAR(255)';
$fields['telephone']['type'] = 'text';
$fields['telephone']['label'] = 'Téléphone';

$fields['email']['typeSQL'] = 'VARCHAR(255)';
$fields['email']['type'] = 'text';
$fields['email']['label'] = 'E-Mail';

$fields['adresse']['typeSQL'] = 'VARCHAR(255)';
$fields['adresse']['type'] = 'text';
$fields['adresse']['label'] = 'Adresse';

$fields['ville']['typeSQL'] = 'VARCHAR(255)';
$fields['ville']['type'] = 'text';
$fields['ville']['label'] = 'Ville';

$fields['cp']['typeSQL'] = 'VARCHAR(255)';
$fields['cp']['type'] = 'text';
$fields['cp']['label'] = 'Code postal';

$fields['id_entreprise']['type'] = 'join';
$fields['id_entreprise']['typeSQL'] = 'INT(11)';
$fields['id_entreprise']['label'] = 'Entreprise';
$fields['id_entreprise']['join']['table'] = 'entreprises';
$fields['id_entreprise']['join']['field'] = 'nom';
$fields['id_entreprise']['join']['type'] = '1-n';
