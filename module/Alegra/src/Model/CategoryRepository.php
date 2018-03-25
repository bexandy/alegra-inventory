<?php 

namespace Alegra\Model;

use Alegra\Hydrator\CategoryHydrator;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Hydrator\Reflection;
use Zend\Stdlib\Parameters;

class CategoryRepository implements CategoryRepositoryInterface
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
    public function findAllCategories()
    {
        $apiUrl = $this->config['api-url']['categories'];
        
        $request = new Request();
        $request->setUri($apiUrl);
        $request->setMethod(Request::METHOD_GET);

        $query = new Parameters(['format' => 'plain']);
        $request->setQuery($query);

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

		$resulset = new HydratingResultSet(new CategoryHydrator(), new Category());
		$resulset->initialize($data);

	    return $resulset;
	}

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findCategory($id)
    {
        $apiUrl = $this->config['api-url']['categories'].$id;

        
        $request = new Request();
        $request->setUri($apiUrl);

        //$query = new Parameters(['format' => 'plain']);
        //$request->setQuery($query);

        $request->setMethod(Request::METHOD_GET);


        $client = new Client();
        $user = $this->config['user'];
        $token = $this->config['token'];
        $client->setAuth($user, $token, Client::AUTH_BASIC);
        //$client->getArgSeparator('');
        //$single = new Parameters([$id]);
        //$client->setParameterGet([$id]);
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
        $hydrator = new  CategoryHydrator();
        $category = $hydrator->hydrate( $data,new Category());

        return $category;
    }
}