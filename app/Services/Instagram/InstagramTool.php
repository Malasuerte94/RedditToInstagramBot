<?php
namespace App\Services\Instagram;

class InstagramTool
{
    public static function generateHashtags(int $numberOfHastags = 20): string
    {
        if($numberOfHastags<=0){
            return "";
        }
        $randomHashtags = array_rand(static::$hashtags, $numberOfHastags);
        $randomHashtags = array_intersect_key(static::$hashtags, array_flip($randomHashtags));
        $result = implode(" ", $randomHashtags);
        return $result;
    }

    public static function generateCaption(string $caption, int $numberOfHastags = 20): string
    {
        $hashtags = static::generateHashtags($numberOfHastags);
        return $caption . " " . $hashtags;
    }

}
