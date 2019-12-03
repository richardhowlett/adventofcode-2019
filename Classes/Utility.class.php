<?php

class Utility {
    public static function log($message) {
        if (is_array($message)) {
            $message = print_r($message, true);
        }
        echo (date('Y-m-d H:i:s - ') . $message . "\n");
    }
}

ini_set('assert.exception', 1);
