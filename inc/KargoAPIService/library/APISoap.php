<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 3.08.2015
 * Time: 14:07
 */

namespace KargoAPIService\Library;


class APISoap
{

    private $SoapHeader;

    private $SoapData = array();

    private $charset, $xsi, $xsd, $soap;

    public function __construct(Array $Config = array()){

        $this->soapConfig($Config);

        $this->soapHeader();

        return $this;

    }

    public function soapConfig(Array $Config = array()){

        $C = $Config
            ? $Config
            : array(
                "charset" => "utf-8",
                "xsi" => "http://www.w3.org/2001/XMLSchema-instance",
                "xsd" => "http://www.w3.org/2001/XMLSchema",
                "soap" => "http://schemas.xmlsoap.org/soap/envelope/"
            );

        $this->charset = $C["charset"];
        $this->xsi = $C["xsi"];
        $this->xsd = $C["xsd"];
        $this->soap = $C["soap"];

    }

    private function soapHeader(){

        $this->SoapHeader = '<?xml version="1.0" encoding="'.$this->charset.'"?>';
        $this->SoapHeader .= '<soap:Envelope xmlns:xsi="'.$this->xsi.'" xmlns:xsd="'.$this->xsd.'" xmlns:soap="'.$this->soap.'">';

    }

    public function pushArray(Array $Data){

        $this->SoapData = array_merge($this->SoapData, $Data);

    }

    public function charset($charset){

        return "This method still on developting";

        $this->charset = $charset;

        $this->soapHeader();

    }

    public function utf8(){

        $this->charset = 'utf-8';

        $this->soapHeader();

        return utf8_encode($this->parseSoap());

    }

    public function parseSoap($SoapData = false, $countI = 0){

        $F = true;

        if(!$SoapData){

            $F = true;

            $Return = $this->SoapHeader;

            $Return .= '<soap:Body>';

            $SoapData = $this->SoapData;

        }else{

            $F = false;

            $Return = null;

        }

        foreach($SoapData as $i => $Data){

            if(!is_array($Data)&&!is_object($Data)){

                $Return .= '<'.$i.'>'.$Data.'</'.$i.'>';

            }else{

                if(is_numeric($i)||is_int($i)){

                    foreach($Data as $iQ => $DataX){

                        if(!is_array($DataX)&&!is_object($DataX)){

                            $Return .= '<'.$iQ.'>'.$DataX.'</'.$iQ.'>';

                        }else{

                            $Return .= $this->parseSoap(array($i => $DataX), $countI+1);

                        }

                    }

                }else{

                    if(@isset($Data["attr"])||@isset($Data["value"])){

                        $Attr = null;

                        if(@isset($Data["attr"])){

                            foreach($Data["attr"] as $attKey => $attrValue){

                                $Attr .= ' '.$attKey.'="'.$attrValue.'"';

                            }

                        }

                        $Return .= '<'.$i.$Attr.'>';

                        $Value = null;

                        if(!is_array(@$Data["value"])&&!is_object(@$Data["value"])){

                            $Value = @$Data["value"];

                        }else{

                            $Value = $this->parseSoap($Data["value"], $countI+1);

                        }

                        $Return .= $Value;

                        $Return .= '</'.$i.'>';

                    }else{

                        foreach($Data as $_i => $_Data){

                            $Return .= "<".$i.">";

                            $Return .= $this->parseSoap(array($_i => $_Data));

                            $Return .= '</'.$i.'>';

                        }

                    }

                }

            }

        }

        if($F){

            $Return .= '</soap:Body>';

            $Return .= '</soap:Envelope>';

        }

        return $Return;

    }

    public function __set($property, $args){

        $this->pushArray(array($property => $args));

    }

    public function __call($function, Array $args){

        $args = count($args) <= 1 ? $args[0] : $args;

        $this->pushArray(array($function => $args));

    }

}