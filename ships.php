<?php

require_once('inc/config.inc.php');
require_once('inc/utilities/PageIndex.class.php');
require_once("inc/entities/Ships.class.php");
require_once("inc/utilities/PDOAgent.class.php");
require_once('inc/utilities/Validation.class.php');
require_once("inc/utilities/ShipsMapper.class.php");
require_once("inc/utilities/PageShips.class.php");

$errors = array();
ShipsMapper::initialize();
$ship = new Ships();

if (!empty($_GET) && isset($_GET['act']) && is_numeric($_GET['shipID']))  {
    if ($_GET["act"] == "delete")    {
        ShipsMapper::deleteShip($_GET["shipID"]);
        PageIndex::showMessages('Ship deleted.');
    } else if ($_GET['act']=='edit') {
        $ship = ShipsMapper::getShip($_GET['shipID']);
    } 
} else if (!empty($_POST) && isset($_POST['shipID'])) {
    Validation::validateShip($errors);
    if (empty($errors)) {
        $ns = new Ships;
        $ns->setShipName($_POST["name"]);
        $ns->setShipYear($_POST["year"]);
        settype($_POST['shipID'], 'int');
        $ns->setShipID($_POST['shipID']);

        if($_POST['shipID'] == 0){
            ShipsMapper::createShip($ns);
            PageIndex::showMessages('Ship '. $ns->getShipName() .' added.');
        } else {
            ShipsMapper::updateShip($ns);
            PageIndex::showMessages('Ship '. $ns->getShipName() .'  edited.');
        }
    } else {
        PageIndex::showErrors($errors);
    }
}

$ships = ShipsMapper::getShips();

PageIndex::header();
PageShips::showShips($ships);
PageShips::showShipsForm($ship);
PageIndex::footer();

?>