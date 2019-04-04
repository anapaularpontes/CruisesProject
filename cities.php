<?php

require_once('inc/config.inc.php');
require_once('inc/entities/City.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageCities.class.php');
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/CitiesMapper.class.php');
require_once('inc/utilities/Validation.class.php');
$errors = array();

PageIndex::header();

CitiesMapper::initialize();

$city = new City();

// Deleting or Getting the City to Edit
if(isset($_GET) && isset($_GET['a']) && is_numeric($_GET['id'])) {
    switch($_GET['a']) {
        case 'e':
            // Showing Edit City
            $city = CitiesMapper::getCity($_GET['id']);
            break;
        case 'd':
            // Deleting City
            $n =  CitiesMapper::deleteCity($_GET['id']);
            PageIndex::showMessages($n.' cities were deleted.');
            break;
    }
    // Executing Add and Edit
} else if(isset($_POST) && isset($_POST['id'])) {
    Validation::validateCity($_POST, $errors);
    if(empty($errors)) {
        $city->setName($_POST['name']);
        if($_POST['id']==0) {
            // Add City
            $lid = CitiesMapper::addCity($city);
            PageIndex::showMessages('City id->'.$lid.' added.');
        } else {
            // Executing the edit
            $city->setId($_POST['id']);
            $n = CitiesMapper::editCity($city);
            PageIndex::showMessages($n.' cities were edited.');
            $city = new City();
        }
    } 
}
$cities = CitiesMapper::getCities();

if(!empty($errors)) {
    PageIndex::showErrors($errors);    
}

PageCities::showCities($cities);

PageCities::FotmCity($city);

PageIndex::footer();

?>