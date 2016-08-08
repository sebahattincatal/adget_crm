<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 1.08.2015
 * Time: 15:23
 */

namespace KargoAPIService\Library;

    class Configuration{

        private $username, $password, $customerKey, $apiKey, $publicKey, $privateKey, $host, $target, $port, $timeout;

        public function __construct(Array $Cofiguration){

            foreach($Cofiguration as $prop => $val){

                $this->$prop = $val;

            }

            return $this;

        }

        public function username($username = null){

            if($username != null){

                $this->username = $username;

                return $this;

            }else{

                return $this->username;

            }

        }

        public function password($password = null){

            if($password != null){

                $this->password = $password;

                return $this;

            }else{

                return $this->password;

            }

        }

        public function customerKey($customerKey = null){

            if($customerKey != null){

                $this->customerKey = $customerKey;

                return $this;

            }else{

                return $this->customerKey;

            }

        }

        public function apiKey($apiKey = null){

            if($apiKey != null){

                $this->apiKey = $apiKey;

                return $this;

            }else{

                return $this->apiKey;

            }

        }

        public function publicKey($publicKey = null){

            if($publicKey != null){

                $this->publicKey = $publicKey;

                return $this;

            }else{

                return $this->publicKey;

            }

        }

        public function privateKey($privateKey = null){

            if($privateKey != null){

                $this->privateKey = $privateKey;

                return $this;

            }else{

                return $this->privateKey;

            }

        }

        public function host($host = null){

            if($host != null){

                $this->host = $host;

                return $this;

            }else{

                return $this->host;

            }

        }

        public function target($target = null){

            if($target != null){

                $this->target = $target;

                return $this;

            }else{

                return $this->target;

            }

        }

        public function port($port = null){

            if($port != null){

                $this->port = $port;

                return $this;

            }else{

                return $this->port;

            }

        }

        public function timeout($timeout = null){

            if($timeout != null){

                $this->timeout = $timeout;

                return $this;

            }else{

                return $this->timeout;

            }

        }

    }