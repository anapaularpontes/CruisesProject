<?php

class ToursMapper {
    static $db;
    static function initialize() {
        self::$db = new PDOAgent('Tour');
    }
    // +--------------+---------+------+-----+---------+----------------+
    // | Field        | Type    | Null | Key | Default | Extra          |
    // +--------------+---------+------+-----+---------+----------------+
    // | id           | int(11) | NO   | PRI | NULL    | auto_increment |
    // | sailing_date | date    | YES  |     | NULL    |                |
    // | duration     | int(11) | NO   |     | NULL    |                |
    // | ship         | int(11) | NO   | MUL | NULL    |                |
    // | from_city    | int(11) | NO   | MUL | NULL    |                |
    // | to_city      | int(11) | NO   | MUL | NULL    |                |
    // | oneway       | int(1)  | NO   |     | NULL    |                |
    // +--------------+---------+------+-----+---------+----------------+

    // Getting all tours applying the filters
    static function getTours($filters) : Array{
        $fStr = "";
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                switch($key) {
                    case 'Departure':
                        $field = 't.from_city';
                        break;
                    case 'Destiny':
                        $field = 't.to_city';
                        break;
                    case 'Attraction':
                        $field = 'a.id';
                        break;
                    case 'Ship':
                        $field = 't.ship';
                        break;
                    default: unset($field);
                        break;
                }
                if(!empty($field)) {
                    $fStr .= ' '.$field.' = '.$filter.' and ';
                }
            }
            $fStr = substr($fStr, 0, (strlen($fStr)-4));
            if(!empty($fStr)) {
                $fStr = ' where ('.$fStr.')';    
            } else {
                $fStr = '';
            }
        }
        
        self::$db->query('select t.id,t.sailing_date,t.ship,t.duration,t.from_city,t.to_city,
                t.oneway, c.name as to_city_name, ci.name as from_city_name, s.name as ship_name
            from tours t
            inner join cities c on c.id = t.to_city
            inner join cities ci on ci.id = t.from_city
            left join attractions a on a.tour = t.id
            inner join ships s on s.id = t.ship '.$fStr.' order by t.sailing_date;');
        self::$db->execute();
        return self::$db->resultSet();
    }

    // Get a single tour
    static function getTour(int $id) :Tour {
        self::$db->query('select id,sailing_date,duration,ship,from_city,to_city,oneway from tours
            where id = :id limit 1;');
        self::$db->bind(':id', $id);
        self::$db->execute();
        return self::$db->singleResult();
    }

    // Add tour
    static function addTour(Tour $tour) : int {
        self::$db->query('insert into tours (sailing_date, duration, ship, from_city, 
            to_city, oneway) values (:sailing_date, :duration, :ship, :from_city, 
            :to_city, :oneway);');
        $data = array(
            ':sailing_date' => $tour->getSQLSailingDate(),
            ':duration' => $tour->getDuration(),
            ':ship' => $tour->getShip(),
            ':from_city' => $tour->getFromCity(),
            ':to_city' => $tour->getToCity(),
            ':oneway' => $tour->getOneway()
        );
        self::$db->execute($data);
        return self::$db->lastInsertId();
    }

    // Edit Tour
    static function editTour(Tour $tour) : int {
        self::$db->query('update tours set  
            sailing_date = :sailing_date,
            duration = :duration,
            ship = :ship,
            from_city = :from_city,
            to_city = :to_city,
            oneway = :oneway
            where id = :id limit 1;');
            $data = array(
                ':sailing_date' => $tour->getSQLSailingDate(),
                ':duration' => $tour->getDuration(),
                ':ship' => $tour->getShip(),
                ':from_city' => $tour->getFromCity(),
                ':to_city' => $tour->getToCity(),
                ':oneway' => $tour->getOneway(),
                ':id' => $tour->getId()
            );
            self::$db->execute($data);
            return self::$db->rowCount();
    }

    // delete tour
    static function deleteTour(int $id) : int {
        self::$db->query('delete from tours where id = :id limit 1;');
        self::$db->bind(':id', $id);
        self::$db->execute();
        return self::$db->rowCount();
    }
}

?>