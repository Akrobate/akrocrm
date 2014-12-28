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

$fields['photo']['type'] = 'photourl';
$fields['photo']['label'] = 'Portrait';

$fields['nom']['type'] = 'text';
$fields['nom']['label'] = 'Nom';

$fields['prenom']['type'] = 'text';
$fields['prenom']['label'] = 'Prenom';

$fields['naissance']['type'] = 'date';
$fields['naissance']['label'] = 'Date de naissance';

$fields['telephone']['type'] = 'text';
$fields['telephone']['label'] = 'Téléphone';

$fields['email']['type'] = 'text';
$fields['email']['label'] = 'E-Mail';

$fields['adresse']['type'] = 'text';
$fields['adresse']['label'] = 'Adresse';

$fields['ville']['type'] = 'text';
$fields['ville']['label'] = 'Ville';

$fields['cp']['type'] = 'text';
$fields['cp']['label'] = 'Code postal';

$fields['id_entreprise']['type'] = 'join';
$fields['id_entreprise']['label'] = 'Entreprise';
$fields['id_entreprise']['join']['table'] = 'entreprises';
$fields['id_entreprise']['join']['field'] = 'nom';
$fields['id_entreprise']['join']['type'] = '1-n';
