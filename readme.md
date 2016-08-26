# Service RestFull and Soap with Laravel

##How configurate

You need to add a file `/routes/soap.php` to add the routes to services soap. 
And you can add more routes in `/routes/api.php` for services Restfull.

Then it´s neccesary to add some lines code in the file `/app/Http/Kernel.php` in `$middlewareGroups`:

```php
'soap' => [
	'throttle:60,1',
	'bindings',
],
```

Then in the file `/app/Providers/RouteServiceProvider.php` it´s neccesary to add the method `mapSoapRoutes()` for the 
new map of routes.

And the last is add the library ZendSoap with composer:

```sh
composer require zendframework/zend-soap
```


##How works?

###For Restfull:

For example if you call for any services Restfull is quickly to deploy with Laravel 
like only to return in the format json (more details in RestfullController.php):

```php
return response()->json(
	[
		'status' => '200',
		'response' => $response,
		'request' => request()->all(),
	]
);
```


###For Soap:

We add some class for example in `/app/Http/Controllers/Operaciones.php` :

```php
class Operaciones
{

    /**
     * @var integer
     */
    public $operando1;

    /**
     * @var integer
     */
    public $operando2;


    /**
     * Operación de Suma
     *
     * @param integer $a
     * @param integer $b
     * @return integer
     */
    public function suma($a, $b)
    {
       return ($a + $b);
    }

    /**
     * Operación de Resta
     *
     * @param integer $a
     * @param integer $b
     * @return integer
     */
    public function resta($a, $b)
    {
        return ($a - $b);
    }
}
```

Then add the file `/app/Http/Controllers/SoapController.php` to make the logic with ZendSoap for Zend.

Adding the library ZendSoap and the class Operaciones:

```php
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use App\Http\Controllers\Operaciones;
```
The main logic is detect when these a method POST or method GET like:

```
IF is GET:
	Return definition WSDL
IF is POST:
	Return the handle bindings for Operaciones
```
	
More details in the file `/app/Http/Controllers/SoapController.php`.


