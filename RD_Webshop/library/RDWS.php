<?php

require_once(dirname(__FILE__).'/../include/conf.php');

/**
 *
 * Interface for making requests to the RDWS.  Due to the non standard method of implementing SOAP this function utilises raw access to send messages
 *
 * @package    system
 * @author     James Leckie <james.leckie@alaress.com.au>
 * @copyright   2010 Alaress Pty Ltd
 * @link        http://www.alaress.com.au
 * @version     SVN: $Id$
 *
 */
class RDWS {

	// Singleton of class
	static private $instance = false;

	// SOAP connection handler
	static private $ws = false;

	// Constructor sets up connection to RDWS
	private function __construct() {
            try {
		self::$ws = new SoapClient(RDWS_WSDL, array('location'=>RDWS_URL, 'trace'=>true));
            }
            catch(SoapFault $fault) {
                throw new Exception('Unable to connect to RDWS.');
                PAGE::errorPage();
            }
	}

	// Creates singleton of object
	static public function getInstance() {
            if (!self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
	}

	// Sets Web Service headers, mainly username and passwords in a security token for authentication purposes
	private function setHeaders($headerVar = '') {
		$headerParams = array(	'Username' =>RDWS_USER,
					'Password'	=> RDWS_PASS,
					'ServiceName' => '',
					'ServiceVersion' => '1',

		);

		if (is_array($headerVar)) {
                    $headerParams = array_merge($headerParams, $headerVar);
                }

		$header = new SOAPHeader('http://www.retaildirections.com/', 'SecurityToken', $headerParams);
		$return = self::$ws->__setSoapHeaders($header);
	}

	/**
	 * Standard method for sending a message built from an array
	 * @param string $requestType The webservice to be requested
	 * @param array $requestArray Array of request
	 * @param string $append String that is appended to request type, normally request but can change on non standard requests
	 * @return SimpleXMLElement
	 */
	public function sendArray($requestType, $requestArray, $append = 'Request') {

			$xml = '<'.$requestType.'>';
			$xml .= self::toXML($requestArray);
			$xml .= '</'.$requestType.'>';
			return self::request($requestType, $xml, $append);
	}

	/**
	 * Builds request xml based on a request xml string and sends the request to the service
	 * @param string $requestType The webservice to be requested
	 * @param string $requestArray Webservice XML request
	 * @param string $append String that is appended to request type, normally request but can change on non standard requests
	 * @return SimpleXMLElement
	 */
	public function request($requestType, $request, $append = 'Request') {
		self::getInstance();
		self::setHeaders(array('ServiceName'=>$requestType));
		$header = '<'.$requestType.$append.' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://www.retaildirections.com/">';
		$request = $header . $request . '</'.$requestType.$append.'>';
	
		$result = self::sendXML($request);

		$markup =  new SimpleXMLElement($result->RDServiceResult);

		if($markup->ErrorResponse) {
                    throw new RDWSException($markup->ErrorResponse);
		}
		else {
                    return $markup;
                }
	}

	/**
	 * Delivers XML message to web service using SOAP
	 * @param string $request Complete XML request
	 * @return string XML response
	 */
	private function sendXML($request) {

		// Wrap request up in RDService SOAP variable
		$params = array('RDService' => array('request'=>$request));

		try {
                    $return = self::$ws->__soapCall('RDService', $params);
		}
		catch (Exception $e) {
                    print_r($e);
                    print_r(self::$ws->__getLastRequest());
		}
		return $return;

	}

	/**
     * Function for retrieving file attachment from SOAP requests
	 * Saves attachment to the provided filename
	 * @param string $requestType Name of webservice
	 * @param array $requestArray Array of of request
	 * @param string $filename Location to where file should be saved
	 * @return bool
	 */

	public function getAttachment($requestType, $requestArray, $filename) {
		self::sendArray($requestType, $requestArray);
		$result = self::$ws->__getLastResponse();
		
		preg_match('/<FileContent>(.*)<\/FileContent>/', $result, $match);

		if (count($match) > 1) {
                    file_put_contents($filename, base64_decode($match[1]));
                    return true;
		}
		else {
                    return false;
		}

	}

	/**
	 * Convert an array to XML for requests
	 * @param array $request
	 * @return string
	 */
	public function toXML($request) {
		$xml = '';
		if(is_array($request)) {
			foreach($request as $key => $value) {
				if(is_numeric($key) ) // Jump through arrays to the elements within
					$xml .= self::toXML($value);
				else if(is_array($value)) {
					$xml .= "<$key>".self::toXML($value)."</$key>";
				}
				else
					$xml .= "<$key>$value</$key>";
			}
		}
		return $xml;
	}

	/**
     * Debugging function for getting information about WS
     */
	public function getDescriptors() {

		self::setHeaders(array('ServiceName'=>'Descriptors'));
		self::sendXML('');
	}

	/**
     * Debugging function for getting information about WS 
     */
	public function getScheme($type) { 

		$xml = '<ServiceSchemaRequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
		  xmlns="http://www.retaildirections.com/"
		  name="'.$type.'"
		  version="1" />';
		
		self::setHeaders(array('ServiceName'=>'Schema'));
		self::sendXML($xml);

	}

    /**
     * Converts an XML object into an array tree
     * @param SimpleXMLElement $xml
     * @param array $arr
     * @return array
     */
	public function xml2phpArray($xml,$arr){
		$iter = 0;
		if(is_object($xml)) {
			foreach($xml->children() as $b){
				$a = $b->getName();
				if(!$b->children()){
						$arr[$a] = trim($b[0]);
				}
				else{
						$arr[$a][$iter] = array();
						$result = self::xml2phpArray($b,$arr[$a][$iter]);
						if(count($result) > 1)
							$arr[$a][$iter] = $result;
						else
							$arr[$a] = $result;
				}
				$iter++;
			}
			return $arr;
		}
	}
    
    public function request2($ServiceName, $requestType, $request, $append = 'Request') {
        self::getInstance();
        self::setHeaders(array('ServiceName'=>$ServiceName));
        $header = '<'.$requestType.$append.' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://www.retaildirections.com/">';
        $request = $header . $request . '</'.$requestType.$append.'>';
    
        $result = self::sendXML($request);

        $markup =  new SimpleXMLElement($result->RDServiceResult);
        if($markup->ErrorResponse) {
            throw new RDWSException($markup->ErrorResponse);
        }
        else                 
        return $markup;
    }

}

/**
 * Exception class for handling RDWS exceptions
 * @package system
 */
class RDWSException extends Exception {

	public function __construct($xmlError) {
		$this->exceptionType = $xmlError->exceptionType;
		$this->errorNumber = (int)$xmlError->errorNumber;
		$this->errorMessage = $xmlError->errorMessage;
		$this->errorSource = $xmlError->errorSource;

		parent::__construct($this->errorMessage, $this->errorNumber);
	}


}

/*class RDWSSoapClient extends SoapClient
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $response = parent::__doRequest($request, $location, $action, $version, $one_way);
        // strip away everything but the xml.
		print_r($response);
        $response = preg_replace('#^.*(<\?xml.*>)[^>]*$#s', '$1', $response);
        return $response;
    }
}
*/

?>
