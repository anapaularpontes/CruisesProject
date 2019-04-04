<?php

class Log {
    static $file;
    static $date;

    // Try to opens the log.
    static function openLog() : bool {
        self::$date = new DateTime();
        self::$file = @fopen(LOG_DIR.'/'.self::$date->format('Ymd').'.log', 'a');
        if(self::$file) {
            return true;
        } else {
            return false;
        }
    }

    // Writes the content
    static function appendLog($cont) {
        if(self::$file) {
            @fwrite(self::$file,self::$date->format('H:i:s').' - '.$cont."\n");
        }
    }

    // Closes the log
    static function closeLog() {
        if(self::$file) {
            @fclose(self::$file);    
        }
    }
}

?>