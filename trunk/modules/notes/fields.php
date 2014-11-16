<?php

$fields['titre']['typeSQL'] = 'VARCHAR(255)';
$fields['titre']['type'] = 'text';
$fields['titre']['label'] = 'Titre de la note';

$fields['description']['typeSQL'] = 'TEXT';
$fields['description']['type'] = 'largetext';
$fields['description']['label'] = 'Contenu de votre note';

$fields['id_contact']['type'] = 'join';
$fields['id_contact']['typeSQL'] = 'INT(11)';
$fields['id_contact']['label'] = 'Contact';
$fields['id_contact']['join']['table'] = 'contacts';
$fields['id_contact']['join']['field'] = 'nom';
$fields['id_contact']['join']['type'] = '1-n';

$fields['id_entreprise']['type'] = 'join';
$fields['id_entreprise']['typeSQL'] = 'INT(11)';
$fields['id_entreprise']['label'] = 'Entreprises';
$fields['id_entreprise']['join']['table'] = 'entreprises';
$fields['id_entreprise']['join']['field'] = 'nom';
$fields['id_entreprise']['join']['type'] = '1-n';
