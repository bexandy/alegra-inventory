<?php 

namespace Alegra\Model;
use Alegra\Hydrator\ProductHydrator;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\View\Model\JsonModel;

/**
* 
*/
class ProductCommand implements ProductCommandInterface
{
	private $config;

    private $apiUrl;
    private $user;
    private $token;


	/**
	 * Class Constructor
	 * @param    $config   
	 * @param    $apiUrl   
	 * @param    $user   
	 * @param    $token   
	 */
	public function __construct($config)
	{
		$this->config = $config;

	}


	/**
     * Persist a new product in the system.
     *
     * @param Product $product The product to insert; may or may not have an identifier.
     * @return Product The inserted product, with identifier.
     */
    public function insertProduct(Product $product)
    {

    	$hydrator = new ProductHydrator();
    	$data = $hydrator->extract($product);

        $data['tax'] = $this->array_filter_recursive($data['tax']);
        $data['inventory'] = $this->array_filter_recursive($data['inventory']);
        $data['price'] = $this->array_filter_recursive($data['price']);
        $data['category'] = $this->array_filter_recursive($data['category']);
        $data = $this->array_filter_recursive($data);

    	$json = new JsonModel($data);

    	$apiUrl = $this->config['api-url']['items'];

        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMethod(Request::METHOD_POST);
        $request->setContent($json->serialize());


        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);


        try {
            $response = $client->dispatch($request);
        } catch (\RuntimeException $e) {
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

    /**
     * Update an existing product in the system.
     *
     * @param Product $product The product to update; must have an identifier.
     * @return Product The updated product.
     */
    public function updateProduct(Product $product)
    {
        $hydrator = new ProductHydrator();
        $data = $hydrator->extract($product);
        unset($data['id']);

        $data['tax'] = $this->array_filter_recursive($data['tax']);
        $data['inventory'] = $this->array_filter_recursive($data['inventory']);
        $data['price'] = $this->array_filter_recursive($data['price']);
        $data['category'] = $this->array_filter_recursive($data['category']);
        $data = $this->array_filter_recursive($data);
        $json = new JsonModel($data);

        $id = $product->getId();

        $apiUrl = $this->config['api-url']['items'].$id;

        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMethod(Request::METHOD_PUT);
        $request->setContent($json->serialize());


        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);

        try {
            $response = $client->dispatch($request);
        } catch (\RuntimeException $e) {
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

    /**
     * Delete a product from the system.
     *
     * @param Product $product The product to delete.
     * @return bool
     */
    public function deleteProduct(Product $product)
    {
        $id = $product->getId();

        $apiUrl = $this->config['api-url']['items'].$id;

        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMethod(Request::METHOD_DELETE);


        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);

        try {
            $response = $client->dispatch($request);
        } catch (\RuntimeException $e) {
            $message = $e->getMessage();
            $error = $message;
            return $error;
        }

        if (! $response->isSuccess()) {
            $message = json_decode(explode("\r\n", $response->getContent())[1]);
            $error = 'code '.$message->code.' : '.$message->message;
            return $error;
        }

        $message = json_decode($response->getBody(), true);

        return $message;
    }

    function array_filter_recursive($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                if (empty($value))
                    $value = null;
                else
                    $value = $this->array_filter_recursive($value);
            }
        }

        $filter = array_filter($input, function($v){ return is_null($v) || $v != '' ;});
        return $filter;
    }

}