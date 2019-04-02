<?php

require_once('inc/config.inc.php');

//Entity
require_once('inc/entities/Facilities_Ship.class.php');
require_once('inc/entities/Facilities.class.php');


//Utilities
require_once('inc/utilities/PDOAgent.class.php');

require_once('inc/utilities/FacilitiesShipMapper.class.php');
require_once('inc/utilities/FacilitiesMapper.class.php');

require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageFacilitiesShip.class.php');

PageIndex::header();

FacilitiesShipMapper::initialize("Facilities_Ship");
FacilitiesMapper::initialize("Facilities");

if(!empty($_GET)){

    switch($_GET['action']){
        case 'delete':
            FacilitiesShipMapper::deleteFS($_GET["id"]);
            break;
        case 'edit':

            $updateFS = FacilitiesShipMapper::getFS($_GET["id"]);
            break;
    }
}


if(!empty($_POST)){
    switch($_POST['post']){
        case 'add':
        $newFS = new Facilities_Ship();

        $newFS->setShip($_POST["shipOptions"]);
        $newFS->setFacilities($_POST["facilityOptions"]);

        FacilitiesShipMapper::addNewFS($newFS);
        break;
        
        case 'update':
        $update = new Facilities_Ship();

        $update->setID($_POST["fsid"]);
        $update->setFacilities($_POST["facilityOptions"]);
        $update->setShip($_POST["shipOptions"]);

        FacilitiesShipMapper::editFS($update);
        break;
    }
}



//get the ship details
$facilities = FacilitiesShipMapper::getShipFacilities();
//var_dump($facilities);

//get all the facility data from the facility class
$allFacilities = FacilitiesMapper::getFacilities();
//var_dump($allFacilities);

$allShips = FacilitiesShipMapper::selectShips();
//var_dump($allShips);

//display the facilities and their corresponding ships
PageFacilitiesShip::displayShipFacilties($facilities);


if(!empty($_GET) && $_GET['action'] == "edit"){

    PageFacilitiesShip::editForm($allShips, $allFacilities, $updateFS);
}else{

        //display the add form with dynamic dropdown menus
        PageFacilitiesShip::addForm($allShips, $allFacilities);
}


?>