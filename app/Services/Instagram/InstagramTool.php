<?php
namespace App\Services\Instagram;

use App\Models\Hashtag;
use App\Models\IgAccount;

class InstagramTool
{
    public static function generateCaption(Hashtag $hashtag, IgAccount $igAccount, string $author, int $numberOfHastags = 20): string
    {
        $caption = "";

        if ($igAccount->include_author) {
            $caption = $igAccount->author_prefix.$author;
        }

        $generatedHashtags = static::generateHashtags($numberOfHastags, $hashtag->hashtags);
        $caption = $caption . " . . .  " . $generatedHashtags;

        return $caption;
    }

    public static function generateHashtags(int $numberOfHastags, string $hashtags): string
    {
        if($numberOfHastags<=0){
            return "";
        }

        $hashtagsArray = explode(" ", $hashtags);
        $randomHashtags = array_rand($hashtagsArray, $numberOfHastags);
        $randomHashtags = array_intersect_key($hashtagsArray, array_flip($randomHashtags));
        $result = implode(" ", $randomHashtags);
        
        return $result;
    }

}
