<?php
namespace App\Services\Instagram;

class InstagramTool
{
    public static $hashtags = [
        '#mechanicalkeyboard',
        '#mechanicalkeyboards',
        '#mechanicalkeyboardindonesia',
        '#mechanicalkeyboardsid',
        '#mechanicalkeyboardinfo',
        '#keyboard',
        '#keyboardist',
        '#keyboards',
        '#keyboardplayer',
        '#keyboardgaming',
        '#keyboardwarrior',
        '#keyboardled',
        '#keyboardistindonesia',
        '#keyboarder',
        '#keyboardkomputer',
        '#keyboardbluetooth',
        '#keyboardporn',
        '#keyboardsocute',
        '#keyboardwireless',
        '#keyboardcover',
        '#keyboardmaestro',
        '#keyboardlessons',
        '#KeyboardistOfTheDay',
        '#keyboardreplacement',
        '#keyboarDIYst',
        '#keyboardlove',
        '#gaming',
        '#gamingmemes',
        '#gaminglife',
        '#GamingPosts',
        '#gamingsetup',
        '#Gamingmeme',
        '#gamingpc',
        '#gamingcommunity',
        '#gamingroom',
        '#gamingrig',
        '#gamingislife',
        '#gamingnews',
        '#gaminggear',
        '#gamingchannel',
        '#gamingmouse',
        '#gaminggirl',
        '#gamingart',
        '#gamingphotography',
        '#gamingaddict',
        '#GamingPictures',
        '#gamingchair',
        '#gamingforlife',
        '#gamingfolk',
        '#gamingstation',
        '#gamingheadset',
        '#gamingkeyboard',
        '#gamingbag',
        '#gaming4life',
        '#gamingcomputer',
        '#gamingpost',
    ];


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

}
