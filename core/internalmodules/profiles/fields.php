<?php

$fields['nom']['typeSQL'] = 'VARCHAR(255)';
$fields['nom']['type'] = 'text';
$fields['nom']['label'] = 'Nom';


$fields['id_entreprise']['type'] = 'join';
$fields['id_entreprise']['typeSQL'] = 'INT(11)';
$fields['id_entreprise']['label'] = 'Entreprise';
$fields['id_entreprise']['join']['table'] = 'entreprises';
$fields['id_entreprise']['join']['field'] = 'nom';
$fields['id_entreprise']['join']['type'] = '1-n';
