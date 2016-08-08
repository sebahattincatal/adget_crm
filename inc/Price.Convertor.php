<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 15.08.2015
 * Time: 17:29
 */

namespace Price;


class Convertor{

    private $Price;
    private $Alphanumeric;
    private static $Num_sTexts = array(
        //1 => array(0 => "lira", 1 => "birlira", 2 => "ikilira", 3 => "üçlira", 4 => "dörtlira", 5 => "beşlira", 6 => "altılira", 7 => "yedilira", 8 => "sekizlira", 9 => "dokuzlira"),
        1 => array(0 => null, 1 => "bir", 2 => "iki", 3 => "üç", 4 => "dört", 5 => "beş", 6 => "altı", 7 => "yedi", 8 => "sekiz", 9 => "dokuz"),
        2 => array(0 => null, 1 => "on", 2 => "yirmi", 3 => "otuz", 4 => "kırk", 5 => "elli", 6 => "altmış", 7 => "yetmiş", 8 => "seksen", 9 => "doksan"),
        3 => array(0 => null, 1 => "yüz", 2 => "ikiyüz", 3 => "üçyüz", 4 => "dörtyüz", 5 => "beşyüz", 6 => "altıyüz", 7 => "yediyüz", 8 => "sekizyüz", 9 => "dokuzyüz"),
        4 => array(0 => "bin", 1 => "bin", 2 => "ikibin", 3 => "üçbin", 4 => "dörtbin", 5 => "beşbin", 6 => "altıbin", 7 => "yedibin", 8 => "sekizbin", 9 => "dokuzbin"),
        5 => array(0 => null, 1 => "on", 2 => "yirmi", 3 => "otuz", 4 => "kırk", 5 => "elli", 6 => "altmış", 7 => "yetmiş", 8 => "seksen", 9 => "doksan"),
        6 => array(0 => null, 1 => "yüz", 2 => "ikiyüz", 3 => "üçyüz", 4 => "dörtyüz", 5 => "beşyüz", 6 => "altıyüz", 7 => "yediyüz", 8 => "sekizyüz", 9 => "dokuzyüz"),
        7 => array(0 => "milyon", 1 => "birmilyon", 2 => "ikimilyon", 3 => "üçmilyon", 4 => "dörtmilyon", 5 => "beşmilyon", 6 => "altımilyon", 7 => "yedimilyon", 8 => "sekizmilyon", 9 => "dokuzmilyon"),
        8 => array(0 => null, 1 => "on", 2 => "yirmi", 3 => "otuz", 4 => "kırk", 5 => "elli", 6 => "altmış", 7 => "yetmiş", 8 => "seksen", 9 => "doksan"),
        9 => array(0 => null, 1 => "yüz", 2 => "ikiyüz", 3 => "üçyüz", 4 => "dörtyüz", 5 => "beşyüz", 6 => "altıyüz", 7 => "yediyüz", 8 => "sekizyüz", 9 => "dokuzyüz")
    );
    private static $Fact_sTexts = array(
        0 => "kuruş ",
        1 => "lira ",
        2 => "bin ",
        3 => "milyon ",
        4 => "milyar "
    );
    private static $Num_s_Texts = array(
        1 => array(0 => "sıfır", 1 => "bir", 2 => "iki", 3 => "üç", 4 => "dört", 5 => "beş", 6 => "altı", 7 => "yedi", 8 => "sekiz", 9 => "dokuz"),
        2 => array(0 => null, 1 => "on", 2 => "yirmi", 3 => "otuz", 4 => "kırk", 5 => "elli", 6 => "altmış", 7 => "yetmiş", 8 => "seksen", 9 => "doksan"),
        3 => array(0 => null, 1 => "yüz", 2 => "ikiyüz", 3 => "üçyüz", 4 => "dörtyüz", 5 => "beşyüz", 6 => "altıyüz", 7 => "yediyüz", 8 => "sekizyüz", 9 => "dokuzyüz")
    );

    const NUMERIC = "integer";
    const ALPHANUMERIC = "string";

    public function __construct($Price = null){

        $this->Price = $Price;

        return $this;

    }

    public function price($Price){

        $this->Price = $Price;

    }

    /* TODO: This method still isn´t completed, it needs to be compeleted, because of this method more useful than encodeToAlphanumeric()*/
    private static function encodeToAlpha($Numeric){

        $Return = "";

        $Vals = array_reverse(str_split($Numeric));

        $loop = 1;

        $diGit = 1;

        foreach($Vals AS $digit => $value){

            $Factor = null;

            if(($digit+1)==1){

                $Return .= self::$Fact_sTexts[$loop];

                $loop++;

            }

            if(($digit+1)%3 == 0){

                $Factor = self::$Fact_sTexts[$loop];

                $loop++;

            }

            $Return = $Factor . self::$Num_s_Texts[$diGit][(int) $value] . $Return;

            if(($digit+1)%3 == 0){

                $diGit = 1;

            }else{

                $diGit++;

            }

        }

        return $Return;

    }

    private static function encodeToAlphanumeric($Numeric){

        $Return = "";

        $Vals = array_reverse(str_split($Numeric));

        foreach($Vals AS $digit => $value){

            $Return = self::$Num_sTexts[($digit)+1][(int) $value] . $Return;

        }

        return $Return;

    }

    private function encodeToNumeric($Alphanumeric){

        $Return = 0000;

        return $Return;

    }

    private static function changeType($Value, $toType = "string"){

        if($toType == "integer" || $toType == "int"){

            return self::encodeToNumeric($Value);

        }

        return self::encodeToAlphanumeric($Value);

    }

    /**
     * Convertin Alphanumeric from Numeric
     *
     * @param bool|false $Alphanumeric
     * @return bool
     */
    public static function convertToAlphanumeric($Price){

        $ExplodeCoin = explode(",", $Price);

        $Cash = str_replace(array(" ", "."), null, $ExplodeCoin[0]);

        $Return = self::changeType($Cash, Convertor::ALPHANUMERIC)."lira";

        if(count($ExplodeCoin)>=2){
            $Return .= self::changeType(@$ExplodeCoin[1], Convertor::ALPHANUMERIC)."kuruş";
        }

        return $Return;

    }

    public function toAlphanumeric($Price = false){

        $Price = !$Price ? $this->Price : $Price;

        return self::convertToAlphanumeric($Price);

    }

    public function alphanumeric($Alphanumeric = false){

        if(!$Alphanumeric){

            return $this->toAlphanumeric();

        }

        return $this->Alphanumeric = $Alphanumeric;

    }

    /**
     * Convertin Numeric from Alphanumeric
     *
     * @param bool|false $Alphanumeric
     * @return bool
     */
    public static function convertToNumeric($Alphanumeric){

        return true;

    }

    public function toNumeric($Alphanumeric = false){

        $Alphanumeric = !$Alphanumeric ? $this->Alphanumeric : $Alphanumeric;

        return self::convertToNumeric($Alphanumeric);

    }

    public function numeric($Numeric = false){

        if(!$Numeric){

            return $this->toNumeric();

        }

        return $this->Price = $Numeric;

    }

}