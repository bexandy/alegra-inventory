<?php 

namespace Alegra\Model;

use Alegra\Hydrator\WarehousesHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Reflection;
use Zend\Stdlib\Parameters;

class WarehousesRepository implements WarehousesRepositoryInterface
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
    public function findAllWarehouses()
    {
        $apiUrl = $this->config['api-url']['warehouses'];
        
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

		$resulset = new HydratingResultSet(new WarehousesHydrator(), new Warehouses());
		$resulset->initialize($data);

	    return $resulset;
	}

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findWarehouse($id)
    {
        $apiUrl = $this->config['api-url']['warehouses'].$id;

        
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
        $hydrator = new  WarehousesHydrator();
        $warehouse = $hydrator->hydrate( $data,new Warehouses());

        return $warehouse;
    }
}