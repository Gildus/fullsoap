<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use phpDocumentor\Reflection\Types\Null_;

use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use App\Http\Controllers\Operaciones;

use App\Http\Requests;
use Monolog\Formatter\ScalarFormatter;

class SoapController extends Controller
{
    protected $route;
    protected $soap;
    protected $wsdlGenarator;

    /**
     * SoapController constructor.
     */
    public function __construct()
    {
        $this->route = Request()->fullUrl();
        $this->wsdlGenarator = new AutoDiscover();
        $this->wsdlGenarator->setUri($this->route);
        $this->soap = new Server();
        $this->soap->setSoapVersion(1);
        $this->soap->setUri($this->route);
    }


    public function operaciones()
    {
        $request  = Request();
        $response = new Response();

        switch ($request->method()) {
            case 'GET':
                $this->wsdlGenarator->setClass('\App\Http\Controllers\Operaciones');
                $this->wsdlGenarator->setServiceName('Operaciones');
                $wsdl = $this->wsdlGenarator->generate();
                $response->setContent($wsdl->toXml())->withHeaders([
                    //'Content-Type' => 'application/wsdl+xml'
                    'Content-Type' => 'text/xml',
                ]);
                break;
            case 'POST':

                $this->soap->setReturnResponse(true);
                $this->soap->setClass('\App\Http\Controllers\Operaciones');

                $soapResponse = $this->soap->handle();
                if ($soapResponse instanceof \SoapFault) {
                    $soapResponse = (string) $soapResponse;
                }
                $response->setContent($soapResponse)->withHeaders([
                    'Content-Type' => 'text/xml',
                ]);
                break;
            default:
				/// another controls ...
                break;
        }

        return $response;


    }


}
