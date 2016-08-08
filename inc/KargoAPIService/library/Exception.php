<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 1.08.2015
 * Time: 15:51
 */

namespace KargoAPIService\Library;

    class Exception extends \Exception{

        private $function, $class, $object, $method, $return;

        public function __construct(Array $ExceptionData){

            $Debug = debug_backtrace();
            $Debug = $Debug[count($Debug)-1];
            $this->code = @$ExceptionData["code"];
            $this->file = (@$ExceptionData["file"]) ? @$ExceptionData["file"] : $Debug["file"];
            $this->line = (@$ExceptionData["line"]) ? @$ExceptionData["line"] : $Debug["line"];
            $this->function = (@$ExceptionData["function"]) ? @$ExceptionData["function"] : $Debug["function"];
            $this->class = (@$ExceptionData["class"]) ? @$ExceptionData["class"] : $Debug["class"];
            $this->method = (@$ExceptionData["method"]) ? @$ExceptionData["method"] : $Debug["class"]."::".$Debug["function"]."()";
            $this->object = (@$ExceptionData["object"]) ? @$ExceptionData["object"] : $Debug["object"];
            $this->return = (@$ExceptionData["return"]) ? @$ExceptionData["return"] : false;
            $this->message = @$ExceptionData["message"];

        }

        public function getFunction(){

            return $this->function;

        }

        public function getClass(){

            return $this->class;

        }

        public function getMethod(){

            return $this->method;

        }

        public function getObject(){

            return $this->object;

        }

        public function getReturn(){

            return $this->return;

        }

    }