<?php 

class StatsMapper {
    static $db;
    static function initialize() {
        self::$db = new PDOAgent('stdClass');
    }

    // Stats from counting number of tours grouping by month/Year
    static function getDateProjection() : Array {
        self::$db->query('select count(id) as n, YEAR(sailing_date) as year, MONTH(sailing_date) as month from tours where tours.sailing_date is not null GROUP BY YEAR(sailing_date), MONTH(sailing_date);');
        self::$db->execute();
        return(self::$db->resultSet());

    }
}
 