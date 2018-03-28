<?php 

namespace Alegra\Model;

//use Alegra\Utility\Translatable;

/**
* 
*/
class Tax //extends Translatable
{
	private $id;
	private $name;
	private $percentage;
	private $description;
	private $type;
	private $status;


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $name   
	 * @param    $percentage   
	 * @param    $description   
	 * @param    $type   
	 * @param    $status   
	 */
	public function __construct($id = '', $name = '', $percentage = '', $description = '', $type = '', $status = '')
	{
		$this->id = $id;
		$this->name = $name;
		$this->percentage = $percentage;
		$this->description = $description;
		$this->type = $type;
		$this->status = $status;
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
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     *
     * @return self
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {
            $return[$row] = $value;
        }
        return $return;
    }
}