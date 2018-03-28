<?php 

namespace Alegra\Model;

use Alegra\Hydrator\TaxHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Reflection;
use Zend\Stdlib\Parameters;

class TaxRepository implements TaxRepositoryInterface
{

    /**
     * @var $config
     */
    private $config;

    private $apiUrl;
    private $user;
    private $token;

    /**
     * @param $config
     * 
     */
    public function __construct( $config )
    {
        $this->config = $config;
    }


    /**
     * {@inheritDoc}
     */
    public function findAllTaxes()
    {
        $apiUrl = $this->config['api-url']['taxes'];
        
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

		$resulset = new HydratingResultSet(new TaxHydrator(), new Tax());
		$resulset->initialize($data);

	    return $resulset;
	}

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findTax($id)
    {
        $apiUrl = $this->config['api-url']['taxes'].$id;

        
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
        $hydrator = new  TaxHydrator();
        $tax = $hydrator->hydrate( $data,new Tax());

        return $tax;
    }
}