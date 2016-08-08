<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 7.08.2015
 * Time: 01:56
 */

namespace KargoAPIService\Library;


     class CSoap extends CSocket{

        protected $fetchObject, $fetchArray;
        protected $Namespace = null;

        public function _namespace($namespace){

            return $this->ns($namespace);

        }

        public function ns($namespace){

            $this->Namespace = $namespace;

            return $this;

        }

        public function fetchObject($Settings){

            if(is_string($Settings)){

                throw new Exception(array(
                    "return" => $Settings,
                    "code" => "XML_PARSE_ERROR",
                    "message" => "Error: fetchObject() => \$Settings parameter must be Array or Object"
                ));

            }

            $Opt = is_object($Settings) ? (array) $Settings : $Settings;

            $this->fetchObject =  simplexml_load_string($this->responseXML());

            if(@$Opt["ns"] ){
                $this->Namespace = @$Opt["ns"];
            }
            if(@$Opt["namespace"] ){
                $this->Namespace = @$Opt["namespace"];
            }

            if($this->Namespace!=null||strlen($this->Namespace)>=10){

                if(is_string($this->Namespace)){

                    $this->fetchObject->registerXPathNamespace("ns1", $this->Namespace);

                }else if(is_array($this->Namespace)){

                    foreach($this->Namespace as $i => $ns){

                        $this->fetchObject->registerXPathNamespace("ns".($i+1), $ns);

                    }

                }

            }else{

                throw new Exception(array(
                    "return" => "\$Namespace typeOf ".gettype($this->Namespace),
                    "code" => "XML_PARSE_ERROR",
                    "message" => "Error: fetchObject() => \$Namespace parameter must be Array or String"
                ));

            }

            if($this->fetchObject->xpath(@$Opt["xpath"])){

                return $this->fetchObject->xpath(@$Opt["xpath"]);

            }else{

                throw new Exception(array(
                    "return" => $this->fetchObject->xpath(@$Opt["xpath"]),
                    "code" => "XML_PARSE_ERROR",
                    "message" => "Error: Cannot create object"
                ));

            }

        }

        public function fetchArray($Settings){

            return (array) $this->fetchObject($Settings);

        }

    }