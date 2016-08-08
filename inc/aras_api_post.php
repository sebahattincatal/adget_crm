<?php
session_start(); ob_start();
include("include.php");

error_reporting();

//echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />';

	$siparis_id= (int)$_POST["x"];
	if(empty($siparis_id)){
		exit("0");
	}




	$row = $db->get_row("SELECT * FROM siparisler where siparis_id='".$siparis_id."'");






 #SETDISPATCH - PHP SAMPLE	
	  
      class arascargo {
      var $Servis;
      //var $DefaultEncoding = 'ISO-8859-9';
	  var $DefaultEncoding = 'UTF8';
      var $Url = 'http://appls-srv.araskargo.com.tr/arascargoservice/arascargoservice.asmx?WSDL';
      var $UserName          = ''; 
      var $Password          = '';
      var $CargoKey          = '';
      var $invoiceKey        = '';
      var $receiverCustName  = '';
      var $receiverAddress   = '';
      var $receiverPhone1    = '';
      var $cityName          = '';
      var $townName          = '';
      var $urunKodu          = '';
      var $orgReceiverCustId = '';
      var $Date              = '';
      var $waybillNo         = '';
      var $TtInvoiceAmount   = '';
      
      var $data = array();
      var $Error = array();
      
      function arascargo(){
          try {
              $return = $this->Servis = new SoapClient($this->Url, array('encoding'=>$this->DefaultEncoding)); 
          } catch(Exception $exp) {
            echo  $this->Error['construct'] = $exp->getMessage();
          }
      }
      
      function ShippingOrder() {
          return array(
                    "UserName"              => $this->UserName,
                    "Password"              => $this->Password,
                    "CargoKey"              => $this->CargoKey,
                    "InvoiceKey"            => $this->invoiceKey,
                    "ReceiverCustName"      => $this->receiverCustName,
                    "ReceiverAddress"       => $this->receiverAddress,
                    "ReceiverPhone1"        => $this->receiverPhone1,
                    "CityName"              => $this->cityName,
                    "TownName"              => $this->townName,
                    "CustProdId"            => $this->urunKodu,
                    "OrgReceiverCustId"     => $this->orgReceiverCustId, 
                    "Desi"                  => "0",
                    "TtDocumentId "         => $this->waybillNo,
                    "Kg"                    => "0",
                    "CargoCount"            => "1",
                    "TtInvoiceAmount"       => $this->TtInvoiceAmount,
                    "TtDocumentId"          => $this->invoiceKey,
                    "waybillNo"             => $this->waybillNo,
                    "TaxOfficeId"           => "0",
                    "UnitID"                => "0",
                    "Date"                  => $this->Date,
                    "LovPayortypeID"        => "0",
                    "TtDocumentSaveType"    => "0",
                    "TtCollectionType"      => "0",
				            "IsExchangedOrder"      => "0"
          );
      }
      
      function createShipment(){
          try {
			  $return = $this->Servis->SetDispatch(array("shippingOrders"=>array("ShippingOrder"=>$this->ShippingOrder()), "userName"=>$this->UserName, "password"=>$this->Password));
			  return $return;
          } catch(Exception $exp) {
             echo $this->Error['CreateShipment'] = $exp->getMessage();
			  
          }
      }
      
      function Functions(){
          return $this->Servis->__getFunctions();
      }
      function LastRequest(){
          return $this->Servis->__getLastRequest();
      }
  }

   
	
	#Assing values to function
	
    
	
		$aras = new arascargo();        
		$aras->UserName           = 'tibetpazarlama';  	#Username
		$aras->Password           = 'tibetpazarlama';	#Password
		$aras->CargoKey           = $row->siparis_id; 		#Unique value for every shipment
		$aras->cityName           = $row->il;		#Receiver City Name
		$aras->invoiceKey         = $row->siparis_id;		#Customers Waybill Number
		$aras->orgReceiverCustId  = $row->siparis_id;	#Integration Code
		$aras->receiverAddress    = $row->adres;	#Receiver Address of the shipment
		$aras->receiverCustName   = $row->ad_soyad;		#ReceiverCustomerName
		$aras->receiverPhone1     = $row->Telefon_no;			#Receiver Phone Number
		$aras->townName           = $row->ilce;					#Receiver Town Name
		$aras->Date               = date('Y-m-d').'T'.date('H:i:s'); # YYYY-mm-ddTHH:ii:ss - 2012-12-07T10:11:77
   	$aras->TtInvoiceAmount    = $row->fiyat;
    $aras->waybillNo          = $row->siparis_id;
		
		// String olan deðiþkenlerde bulunan türkçe karakter sorununu ortadan kaldýrmak için
		// ConvertToTr fonksyonu çaðýrýlýr.


    function replace_tr($text) {
    $text = trim($text);
    $search = array('Ä±','ç','Ğ','ğ','ı','I','İ','Ö','ö','Ş','ş','Ü','ü');
    $replace = array('I','c','G','g','ı','ı','i','O','o','S','s','U','u');
    $new_text = str_replace($search,$replace,$text);
    return $new_text;
    }  




		
		# Convert values to utf-8 format
		$aras->cityName = (replace_tr(ConvertToTR($aras->cityName)));
		$aras->receiverCustName = (replace_tr(ConvertToTR($aras->receiverCustName)));
		$aras->receiverAddress = (replace_tr(ConvertToTR($aras->receiverAddress)));
	
      	# Call createShipment method
      	$sonuc = $aras->createShipment();
         //ResponseArray($sonuc);

 
 $dns=  $sonuc->SetDispatchResult->DispatchResultInfo->ResultMessage;

echo $dns;

@$db->query("UPDATE siparisler set cargoPrint=1 where siparis_id='".$siparis_id."'");




  

  function ConvertToTR($data){
  return $data;
  }

    function ResponseArray($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }



?>