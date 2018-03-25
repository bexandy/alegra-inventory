<?php 

namespace Alegra\Model;

use Alegra\Hydrator\CompanyHydrator;
use Alegra\Hydrator\CurrencyHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Hydrator\HydratorInterface;
use ReflectionClass;

use Alegra\Model\Company;

class CompanyAlegraRepository implements CompanyRepositoryInterface
{
	    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var Company
     */
    private $companyPrototype;

    /**
     * @var $cofig
     */
    private $config;

    /**
     * @param HydratorInterface $hydrator
     * @param Company $companyPrototype
     */
    public function __construct( HydratorInterface $hydrator, $config ) 
    {
        $this->hydrator      = $hydrator;
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function findCompany()
    {
        // TODO: Implement findCompany() method.

    	$apiUrl = $this->config['api-url']['company'];
        
        $request = new Request();
		//$request->getHeaders()->addHeaders(array(
		//    'Authorization' => 'Basic YmV4YW5keUBnbWFpbC5jb206NDU0NGM1YTY5MDY5MDY1NDA2Y2I='
		//));
		$request->setUri($apiUrl);
		$request->setMethod(Request::METHOD_GET);

		$client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);
        //var_dump($client);

        try {
            $response = $client->dispatch($request);
            //var_dump($response);
            //echo '$response->getBody()<br>';
            //var_dump($response->getBody());
        } catch (RuntimeException $e) {
            $message = $e->getMessage();
            //echo '! Exception<br>';
            $error = array('message' => $message);
            //var_dump($error);
            //die();
            return $error;
        }

        if (! $response->isSuccess()) {
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            //echo '! $response->isSuccess()<br>';
            $error = array('message' => $message);
            //var_dump($error);
            //die();
            return $error;
        }
		
		$data = json_decode($response->getBody(), true);
        //$hydrator = $this->hydrator;
        $hydrator = new  CompanyHydrator();
        $company = $hydrator->hydrate( $data,new Company());

	    return $company;
    }
}