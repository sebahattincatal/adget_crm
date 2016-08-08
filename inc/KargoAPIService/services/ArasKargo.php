<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 7.08.2015
 * Time: 14:48
 */

namespace KargoAPIService\Service;

    use \KargoAPIService\Library;

    class ArasKargo{

        private $Configuration;
        private $Host, $Target, $Port, $Timeout = 60;
        private $SoapSocket, $SoapData;

        public function __construct(\KargoAPIService\Library\Configuration $Configuration){

            $this->Configuration = $Configuration;

            $this->Host = $Configuration->host();
            $this->Target = $Configuration->target();
            $this->port = $Configuration->port();

            $this->SoapData = array(
                "userName"  => $Configuration->username(),
                "password"  => $Configuration->password()
            );

            try{

                $this->SoapSocket = new Library\CSoap(array(
                    "host" => $this->Configuration->host(),
                    "port" => $this->Configuration->port(),
                    "timeout" => $this->Configuration->timeout()
                ));

                $this->SoapSocket->post($this->Configuration->target());

                $this->SoapSocket->curlSet(CURLOPT_CONNECTTIMEOUT, $this->Configuration->timeout());
                $this->SoapSocket->curlSet(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            }catch (Library\Exception $e){

                echo $e->getReturn();

                echo "<br /><br />";

                echo $e->getMessage();

            }

            return $this;

        }

        public function postCargo(Array $Data){

            try{

                $this->SoapSocket->curlSet(CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8', 'SOAPAction: "http://tempuri.org/SetDispatch"'));

                $SoapRaw = new Library\APISoap;

                $this->SoapData = array(
                    "UserName" => $this->Configuration->username(),
                    "Password" => $this->Configuration->password(),
                    "CargoKey" => "0000",
                    "InvoiceKey" => "0000",
                    "ReceiverCustName" => "0000",
                    "ReceiverAddress" => "0000",
                    "ReceiverPhone1" => "0000",
                    "ReceiverPhone2" => "0000",
                    "ReceiverPhone3" => "0000",
                    "CityName" => "0000",
                    "TownName" => "0000",
                    "CustProdId" => "0000",
                    "Desi" => "0000",
                    "Kg" => "0000",
                    "CargoCount" => "0000",
                    "WaybillNo" => "0000",
                    "SpecialField1" => "0000",
                    "SpecialField2" => "0000",
                    "SpecialField3" => "0000",
                    "TtInvoiceAmount" => "0000",
                    "TtCollectionType" => "0000",
                    "TtDocumentSaveType" => "0000",
                    "OrgReceiverCustId" => "0000",
                    "Description" => "0000",
                    "TaxNumber" => "0000",
                    "TtDocumentId" => "0000",
                    "TaxOfficeId" => "0000",
                    "OrgGeoCode" => "0000",
                    "PrivilegeOrder" => "0000",
                    "LovPayortypeID" => "0000",
                    "UnitID" => "0000",
                    "AuthorizedPersonName" => "0000",
                    "AuthorizedPersonPhone" => "0000",
                    "AuthorizedPersonMobile" => "0000",
                    "RegionNumber" => "0000",
                    "IsExchangedOrder" => "0000"
                );

                $SoapRaw->SetDispatch(array(
                    "attr" => array("xmlns" => "http://tempuri.org/"),
                    "value" => array(
                        "shippingOrders"  => array(
                            "ShippingOrder" => array(
                                "value" => array_merge($this->SoapData, $Data)
                            )
                        ),
                        "userName"  => $this->Configuration->username(),
                        "password"  => $this->Configuration->password()
                    )
                ));

                $this->SoapSocket->pushRaw($SoapRaw->utf8());

                $this->SoapSocket->execute();

                $this->SoapSocket->ns("http://tempuri.org/");

                $FetchResult = $this->SoapSocket->fetchObject(array(
                    "xpath" => "//ns1:SetDispatchResponse/ns1:SetDispatchResult/ns1:DispatchResultInfo"
                ));

                return $FetchResult;

            }catch (Library\Exception $e){

                echo $e->getReturn();

                echo "\n\r\n\r";

                echo $e->getMessage();

            }

        }

        public function fetchCargo(Array $Data){

            try{

                $this->SoapSocket->curlSet(CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8', 'SOAPAction: "http://tempuri.org/GetDispatch"'));

                $SoapRaw = new Library\APISoap;

                $SoapRaw->GetDispatch(array(
                    "attr" => array("xmlns" => "http://tempuri.org/"),
                    "value" => array_merge($this->SoapData, $Data)
                ));

                $this->SoapSocket->pushRaw($SoapRaw->utf8());

                $this->SoapSocket->execute();

                $this->SoapSocket->ns("http://tempuri.org/");

                $FetchResult = $this->SoapSocket->fetchObject(array(
                    "xpath" => "//ns1:GetDispatchResponse/ns1:GetDispatchResult/ns1:ShippingOrder"
                ));

                return $FetchResult;

            }catch (Library\Exception $e){

                echo $e->getReturn();

                echo "\n\r\n\r";

                echo $e->getMessage();

            }

        }

    }