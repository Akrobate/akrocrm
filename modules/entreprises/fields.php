<?php

/**
 *	Fichier de configuration de champs pour le module Entreprises
 *
 * @brief		Definition du modele de Entreprises
 * @details		Definition des champs de la table Entreprises
 *
 * @author		Artiom FEDOROV
 *
 */
 
 
$fields['nom']['typeSQL'] = 'VARCHAR(255)';
$fields['nom']['type'] = 'text';
$fields['nom']['label'] = 'Nom';

$fields['activite']['typeSQL'] = 'VARCHAR(255)';
$fields['activite']['type'] = 'text';
$fields['activite']['label'] = 'Votre activité';

$fields['adresse']['typeSQL'] = 'VARCHAR(255)';
$fields['adresse']['type'] = 'text';
$fields['adresse']['label'] = 'Votre adresse';

$fields['cp']['typeSQL'] = 'VARCHAR(255)';
$fields['cp']['type'] = 'text';
$fields['cp']['label'] = 'Code postal';

$fields['ville']['typeSQL'] = 'VARCHAR(255)';
$fields['ville']['type'] = 'text';
$fields['ville']['label'] = 'Ville';
