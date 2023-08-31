<?php
namespace App\Filters;

class ProfanityFilter
{
    public static function filter($text) : bool
    {
        $url = 'https://www.purgomalum.com/service/containsprofanity?text=';

        $response = file_get_contents($url . urlencode($text));
        $data = json_decode($response);

        if ($data !== null) {
            if ($data == 1){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
}

?>
