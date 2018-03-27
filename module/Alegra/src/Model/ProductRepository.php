<?php 

namespace Alegra\Model;

use Alegra\Hydrator\ProductHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Reflection;

class ProductRepository implements ProductRepositoryInterface
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

    private $apiUrl;
    private $user;
    private $token;

    /**
     * @param HydratorInterface $hydrator
     * @param Company $companyPrototype
     */
    public function __construct( $config )
    {
        $this->config = $config;
    }


    /**
     * {@inheritDoc}
     */
    public function findAllProducts()
    {
        $apiUrl = $this->config['api-url']['items'];
        
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

		$resulset = new HydratingResultSet(new ProductHydrator(), new Product());
		$resulset->initialize($data);

	    return $resulset;
	}

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findProduct($id)
    {
        $apiUrl = $this->config['api-url']['items'].$id;

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

        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( $data,new Product());

        return $product;
    }
}