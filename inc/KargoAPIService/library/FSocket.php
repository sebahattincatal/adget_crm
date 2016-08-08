<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 1.08.2015
 * Time: 15:16
 */

namespace KargoAPIService\Library;

class FSocket{

    private $Socket;
    private $Error = array();
    private $QueryData = array();
    private $SocketString = array();
    private $ResponseText, $Response;

    public function __construct(Array $SocketString){

        if($Host!==false){

            return $this->open($SocketString);

        }

        return $this;

    }

    public function open(Array $SocketString){

        $this->SocketString = $SocketString;

        $this->Socket = @fsockopen($this->SocketString["host"], $this->SocketString["port"], $ErrNo, $ErrStr, $this->SocketString["timeout"]);

        if(!$this->Socket){

            $this->Error["no"] = $ErrNo;

            $this->Error["str"] = $ErrStr;

            throw new Exception(array(
                "return" => $this->Socket,
                "code" => $ErrNo,
                "message" => "::Soket bağlantısı oluşturulurken hata oluştu!::<br /> <strong>Hata Kodu => Mesajı ;</strong> <b style='color: blue;'>".$ErrNo."</b> => <font style='color: red;'>".$ErrStr."</font>"
            ));

        }

        $this->Socket = curl_init();

        return $this;

    }

    public function method($Method){

        $this->SocketString["method"] = $Method;

    }

    public function push(Array $Data){

        $this->QueryData = array_merge($this->QueryData, $Data);

    }

    public function build(){

        return http_build_query($this->QueryData);

    }

    public function execute(){

        $Header = $this->SocketString["method"]." /".$this->SocketString["target"]." HTTP/1.0\r\n"
            ."Host: ".$this->SocketString["host"]."\r\n"
            ."Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\r\n"
            ."Accept-language: tr-TR,tr;q=0.8,en-US;q=0.6,en;q=0.4\r\n"
            ."Content-Length: ".strlen($this->build())."\r\n"
            ."Content-type: application/x-www-form-urlencoded\r\n"
            ."User-Agent: ".$_SERVER["HTTP_USER_AGENT"]
            ."Connection: Close\r\n\r\n";

        fwrite($this->Socket, $Header);
        fwrite($this->Socket, $this->build());

        $fGet = null;

        while (!feof($this->Socket)) {
            $fGet .= fgets($this->Socket, 128);
        }

        $this->Response = $fGet;

        @fclose($this->Socket);

        preg_match("/\{.*\}/i", $fGet, $SocketResponseContent);

        $ResponseContent = json_decode(@$SocketResponseContent[0]);

        return $this;

        return $ResponseContent;

    }

    public function responseText(){

        return $this->ResponseText;

    }

    public function response(){

        return $this->Response;

    }

}