<?php
/*
 * Generate class (library)
 * Used to get generated string particularly subject to generate a token
 * Author : John Robert Jerodiaz
 * Date : June 13, 2016
 */
class Generate {
    
    /*
     * getString (describes root of string generator)
     * @params : $length (int) - the lenght of string want to generate
     * @return : $randomString (String)
     */
    public function getString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}