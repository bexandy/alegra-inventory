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

		$request->setUri($apiUrl);
		$request->setMethod(Request::METHOD_GET);

		$client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);

        try {
            $response = $client->dispatch($request);

        } catch (RuntimeException $e) {
            $message = $e->getMessage();
            $error = $message;
            return $error;
        }

        if (! $response->isSuccess()) {
            $message = json_decode(explode("\r\n", $response->getContent())[1]);
            $error = 'code '.$message->code.' : '.$message->message;
            return $error;
        }
		
		$data = json_decode($response->getBody(), true);
        $hydrator = new  CompanyHydrator();
        $company = $hydrator->hydrate( $data,new Company());

	    return $company;
    }
}