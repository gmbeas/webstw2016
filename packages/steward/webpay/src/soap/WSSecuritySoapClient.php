<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:15
 */

namespace Steward\Webpay\Soap;

use DOMDocument;
use SoapClient;

class WSSecuritySoapClient extends SoapClient
{
    private $useSSL = false;
    private $privateKey = "";
    private $publicCert = "";

    function __construct($wsdl, $privateKey, $publicCert, $options)
    {

        $locationparts = parse_url($wsdl);
        $this->useSSL = $locationparts['scheme'] == "https" ? true : false;
        $this->privateKey = $privateKey;
        $this->publicCert = $publicCert;

        return parent::__construct($wsdl, $options);
    }

    function __doRequest($request, $location, $saction, $version, $one_way = 0)
    {

        if ($this->useSSL) {
            $locationparts = parse_url($location);
            $location = 'https://';
            if (isset($locationparts['host']))
                $location .= $locationparts['host'];
            if (isset($locationparts['port']))
                $location .= ':' . $locationparts['port'];
            if (isset($locationparts['path']))
                $location .= $locationparts['path'];
            if (isset($locationparts['query']))
                $location .= '?' . $locationparts['query'];
        }
        $doc = new DOMDocument('1.0');

        $doc->loadXML($request);
        $objWSSE = new WSSESoap($doc);
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array(
            'type' => 'private'
        ));

        /** False para cargar en modo texto, true para archivo */
        $objKey->loadKey($this->privateKey, FALSE);
        $options = array(
            "insertBefore" => TRUE
        );
        $objWSSE->signSoapDoc($objKey, $options);
        $objWSSE->addIssuerSerial($this->publicCert);
        $objKey = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $objKey->generateSessionKey();
        $retVal = parent::__doRequest($objWSSE->saveXML(), $location, $saction, $version);
        $doc = new DOMDocument();
        $doc->loadXML($retVal);
        return $doc->saveXML();
    }

    /**
     * @param getTransactionResult $parameters
     * @access public
     * @return getTransactionResultResponse
     */
    public function getTransactionResult(getTransactionResult $parameters)
    {
        return $this->__soapCall('getTransactionResult', array($parameters));
    }

    /**
     * @param acknowledgeTransaction $parameters
     * @access public
     * @return acknowledgeTransactionResponse
     */
    public function acknowledgeTransaction(acknowledgeTransaction $parameters)
    {
        return $this->__soapCall('acknowledgeTransaction', array($parameters));
    }

    /**
     * @param initTransaction $parameters
     * @access public
     * @return initTransactionResponse
     */
    public function initTransaction(initTransaction $parameters)
    {
        return $this->__soapCall('initTransaction', array($parameters));
    }
}