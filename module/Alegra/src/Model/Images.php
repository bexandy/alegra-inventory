<?php 

namespace Aelgra\Model;

/**
* 
*/
class Image 
{
	
	private $id;
	private $name;
	private $url;


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $name   
	 * @param    $url   
	 */
	public function __construct($id = null, $name = null, $url = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->url = $url;
	}



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}