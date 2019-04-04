<?php

class Tour {

    // id int NOT NULL AUTO_INCREMENT,
    // sailing_date date DEFAULT NULL,
    // duration int NOT NULL,
    // ship int NOT NULL,
    // from_city int NOT NULL,
    // to_city int NOT NULL,
    // oneway int(1) not null,

    private $id = 0;
    private $sailing_date = null;
    private $duration = 0;
    private $ship = 0;
    private $from_city = 0;
    private $to_city = 0;
    private $oneway = 0;

    private $to_city_name;
    private $from_city_name;
    private $ship_name;

    //Getters
    public function getId() : int {
        return $this->id;
    }

    // Format date to the Database
    public function getSQLSailingDate() {
        return $this->sailing_date;
    }

    // Format date to be shown on the page
    public function getFormatedSailingDate() : String {
        $date = @DateTime::createFromFormat("Y-m-d", $this->sailing_date );
        if($date) {
            return $date->format('d-M-Y');
        } else {
            return 'Not Defined';
        }
    }
    public function getDuration() : int {
        return $this->duration;
    }
    public function getShip() : int {
        return $this->ship;
    }
    public function getFromCity() : int {
        return $this->from_city;
    }
    public function getToCity() : int {
        return $this->to_city;
    }

    public function getOneway() : int {
        return $this->oneway;
    }

    public function getToCityName() : String {
        return $this->to_city_name;
    }

    public function getFromCityName() : String {
        return $this->from_city_name;
    }

    public function getShipName() : String {
        return $this->ship_name;
    }

    // Setters
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setSailingDate(String $date)  {
        $this->sailing_date = $date;
    }
    public function setDuration(int $duration) {
        $this->duration = $duration;
    }
    public function setShip(int $ship) {
        $this->ship = $ship;
    }
    public function setFromCity(int $city) {
        $this->from_city = $city;
    }
    public function setToCity(int $city) {
        $this->to_city = $city;
    }

    public function setOneway(int $ow) {
        $this->oneway = $ow;
    }

}

?>