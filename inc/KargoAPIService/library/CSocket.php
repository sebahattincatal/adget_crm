<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 1.08.2015
 * Time: 15:16
 */

namespace KargoAPIService\Library;

    abstract Class CSocket{

        protected $Socket;
        protected $Error = array();
        protected $QueryData = array();
        protected $SocketString = array();
        protected $ResponseText, $ResponseJSON, $ResponseXML;
        protected $raw = false;

        public function __construct(Array $SocketString){

            $this->Socket = curl_init();

            if($SocketString["host"]!==false){

                return $this->render($SocketString);

            }

            return $this;

        }

        public function render(Array $SocketString){

            $this->SocketString = $SocketString;

            if(@isset($SocketString["post"])&&strlen($SocketString["post"])>=5){

                $this->SocketString["target"] = $SocketString["post"];

                $this->method("post", false);

            }else if(@isset($SocketString["get"])&&strlen($SocketString["get"])>=5){

                $this->SocketString["target"] = $SocketString["get"];

                $this->method("get", false);

            }

            curl_setopt($this->Socket, CURLOPT_HEADER, false);
            curl_setopt($this->Socket, CURLOPT_URL, @$this->SocketString["host"].":".@$this->SocketString["port"]."/".@$this->SocketString["target"]);
            //curl_setopt($this->Socket, CURLOPT_PORT, @$this->SocketString["port"]);
            curl_setopt($this->Socket, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->Socket, CURLOPT_TIMEOUT, @$this->SocketString["timeout"]);

            return $this;

        }

        public function curlSet($Option, $Value){

            curl_setopt($this->Socket, $Option, $Value);

            return $this;

        }

        public function method($Method, $return = true){

            $this->SocketString["method"] = $Method;

            if($Method==="post"||$Method==="POST"||$Method===true){

                curl_setopt($this->Socket, CURLOPT_POST, true);

            }else{

                curl_setopt($this->Socket, CURLOPT_POST, false);

            }

            if($return){

                return $this->render($this->SocketString);

            }

        }

        public function post($target){

            $this->target($target);

            return $this->method("post");

        }

        public function get($target){

            $this->target($target);

            return $this->method("get");

        }

        public function target($target){

            $this->SocketString["target"] = $target;

            return $this->render($this->SocketString);

        }

        public function push(Array $Data){

            $this->raw = false;

            if(is_array($this->QueryData)){

                $this->QueryData = array_merge($this->QueryData, $Data);

                return $this;

            }

            $this->QueryData = $Data;

            return $this;

        }

        public function pushRaw($Data){

            $this->raw = true;

            if(is_string($this->QueryData)){

                $this->QueryData .= $Data;

                return $this;

            }

            $this->QueryData = $Data;

            return $this;

        }

        public function build($raw = false){

            if(!$raw){

                return http_build_query($this->QueryData);

            }

            return $this->QueryData;

        }

        public function execute(){

            @curl_setopt($this->Socket, CURLOPT_POSTFIELDS, $this->build($this->raw));

            $Exec = curl_exec($this->Socket);

            if(!$Exec){

                throw new Exception(array(
                    "return" => $Exec,
                    "code" => curl_errno($this->Socket),
                    "message" => curl_error($this->Socket)
                ));

                return $this;

            }

            @curl_close($this->Socket);

            $this->ResponseText = $Exec;

            preg_match("/\{.*\}/i", $Exec, $SocketResponseContent);

            $this->ResponseJSON = json_decode(@$SocketResponseContent[0]);

            $XMLFormat = null;

            $startXML = strpos($Exec, "<?xml");

            $XMLFormat = substr($Exec, $startXML);

            $this->ResponseXML = $XMLFormat;

            return $this;

        }

        public function responseText(){

            return $this->ResponseText;

        }

        public function responseJSON(){

            return $this->ResponseJSON;

        }

        public function responseXML(){

            return $this->ResponseXML;

        }

        public function __destruct(){

            @curl_close($this->Socket);

        }

    }