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
    public function insertPost(Product $product)
    {

    	$hydrator = new ProductHydrator();
    	$data = $hydrator->extract($product);
    	$filter = $this->array_filter_recursive($data);
    	$json = new JsonModel($filter);

    	$apiUrl = $this->config['api-url']['items'];

        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMethod(Request::METHOD_POST);
        $request->setContent($json->serialize());


        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);

        //$client->setRawBody($json->serialize());

        //var_dump($client);

        try {
            $response = $client->dispatch($request);
            //var_dump($response);
            //echo '$response->getBody()<br>';
            //var_dump($response->getBody());
        } catch (\RuntimeException $e) {
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
    public function updatePost(Product $product)
    {

    }

    /**
     * Delete a product from the system.
     *
     * @param Product $product The product to delete.
     * @return bool
     */
    public function deletePost(Product $product)
    {

    }

    function array_filter_recursive($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                $value = $this->array_filter_recursive($value);
            }
        }

        return array_filter($input);
    }
}