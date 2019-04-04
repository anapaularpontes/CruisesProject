<?php

class AttractionsMapper {
    private static $db;

    static function initialize() {
        self::$db = new PDOAgent('Attractions');
    }

   /*
    mysql> desc attractions;
    +------------+-------------+------+-----+---------+----------------+
    | Field      | Type        | Null | Key | Default | Extra          |
    +------------+-------------+------+-----+---------+----------------+
    | id         | int(11)     | NO   | PRI | NULL    | auto_increment |
    | attraction | varchar(30) | NO   |     | NULL    |                |
    | tour       | int(11)     | NO   | MUL | NULL    |                |
    +------------+-------------+------+-----+---------+----------------+
    */

    static function createAttraction(Attractions $newAttraction) {
        $sql = 'insert into Attractions(attraction, tour) values (:attraction, :tour)';
        self::$db->query($sql);
        self::$db->bind(':attraction', $newAttraction->getAttractionName());
        self::$db->bind(':tour', $newAttraction->getAttractionTour());
        self::$db->execute();
        return  self::$db->lastInsertId();
    }

    static function deleteAttraction(String $id) {
        try {
            $sql = "delete from Attractions where id = :id;";
            self::$db->query($sql);
            self::$db->bind(':id', $id);
            self::$db->execute();
            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting Attraction");
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    static function getAttractions() {
        $sql = 'select Attractions.id, Attractions.attraction, Attractions.tour, Ships.name as shipName, Tours.sailing_date
                from Attractions, Tours, Ships
                where Attractions.tour = Tours.id and Tours.ship = Ships.id
                order by attraction asc;';
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getAttraction(String $id) {
        $sql = 'select * from Attractions where id = :id;';
        self::$db->query($sql);
        self::$db->bind(':id',$id);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function updateAttraction(Attractions $updateAttraction) {
        $sql = 'update Attractions set attraction = :attraction, tour = :tour
                where id = :id;';
        self::$db->query($sql);
        self::$db->bind(':id', $updateAttraction->getAttractionID());
        self::$db->bind(':attraction', $updateAttraction->getAttractionName());
        self::$db->bind(':tour', $updateAttraction->getAttractionTour());
        self::$db->execute();
    }
}

?>