<?php

require_once('inc/config.inc.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/entities/Attractions.class.php');
require_once('inc/entities/Tour.class.php');
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/Validation.class.php');
require_once('inc/utilities/AttractionsMapper.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/PageAttractions.class.php');

PageIndex::header();
$errors = array();
AttractionsMapper::initialize();
$attraction = new Attractions();

if(isset($_GET) && isset($_GET['act']) && is_numeric($_GET['attractionID'])) {
    if($_GET['act']=='delete') {
        AttractionsMapper::deleteAttraction($_GET['attractionID']);
        PageIndex::showMessages('Attraction deleted.');
    } else if ($_GET['act']=='edit') {
        $attraction = AttractionsMapper::getAttraction($_GET['attractionID']);
    } 
} else if(isset($_POST) && isset($_POST['attractionID'])) {
    Validation::validateAttraction($errors);
    if(empty($errors)) {
        $na = new Attractions();
        $na->setAttractionName($_POST['attraction']);
        $na->setAttractionTour($_POST['tour']);
        settype($_POST['attractionID'], 'int');
        $na->setAttractionID($_POST['attractionID']);

        if($_POST['attractionID'] == 0) {
            AttractionsMapper::createAttraction($na);
            PageIndex::showMessages('Attraction '. $na->getAttractionName() .'  added.');
        } else {
            AttractionsMapper::updateAttraction($na);
            PageIndex::showMessages('Attraction '. $na->getAttractionName() .'  edited.');
        }
    } else {
        PageIndex::showErrors($errors);
    }
}

$attractions = AttractionsMapper::getAttractions();

PageAttractions::showAttractions($attractions);
PageAttractions::showAttractionForm($attraction);
PageIndex::footer();

?>