<?php

/**
 *	Fichier de configuration de champs pour le module Messages
 *
 * @brief		Definition du modele de Messages
 * @details		Definition des champs de la table Messages
 *
 * @author		Artiom FEDOROV
 *
 */
 
 
$fields['mobilephone']['type'] = 'text';
$fields['mobilephone']['label'] = 'Titre de la note';

$fields['message']['type'] = 'largetext';
$fields['message']['label'] = 'Contenu de votre note';

$fields['id_contact']['type'] = 'join';
$fields['id_contact']['label'] = 'Contact';
$fields['id_contact']['join']['table'] = 'contacts';
$fields['id_contact']['join']['field'] = 'nom';
$fields['id_contact']['join']['type'] = '1-n';

$fields['id_user']['type'] = 'join';
$fields['id_user']['label'] = 'Utilisateur';
$fields['id_user']['join']['table'] = 'users';
$fields['id_user']['join']['field'] = 'nom';
$fields['id_user']['join']['type'] = '1-n';

$fields['created']['type'] = 'date';
$fields['created']['label'] = 'Recu le';

