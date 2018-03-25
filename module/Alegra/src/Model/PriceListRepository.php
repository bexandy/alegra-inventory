<?php 

namespace Alegra\Model;

use Alegra\Hydrator\PriceListHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Reflection;

class PriceListRepository implements PriceListRepositoryInterface
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
    public function findAllPriceLists()
    {
        $apiUrl = $this->config['api-url']['price-list'];
        
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
            $error = array('message' => $message);
            return $error;
        }

        if (! $response->isSuccess()) {
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $error = array('message' => $message);
            return $error;
        }

		$data = json_decode($response->getBody(), true);

		$resulset = new HydratingResultSet(new PriceListHydrator(), new PriceList());
		$resulset->initialize($data);

	    return $resulset;
	}

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findPriceList($id)
    {
        $apiUrl = $this->config['api-url']['price-list'].$id;
        
        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMetadata(['id' => $id]);
        $request->setMethod(Request::METHOD_GET);
        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);

        $client->setParameterGet([
            'id' => $id
        ]);


         try {
            $response = $client->dispatch($request);
        } catch (RuntimeException $e) {
            $message = $e->getMessage();
            $error = array('message' => $message);
            return $error;
        }

        if (! $response->isSuccess()) {
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $error = array('message' => $message);
            return $error;
        }

        $data = json_decode($response->getBody(), true);
        $hydrator = new  PriceListHydrator();
        $priceList = $hydrator->hydrate( $data,new PriceList());

        return $priceList;
    }
}