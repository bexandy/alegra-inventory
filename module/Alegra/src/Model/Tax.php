<?php 

namespace Alegra\Model;

/**
* 
*/
class Tax 
{
	
	/**
     * @var string
     */
    private $id;
	
	/**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $percentage;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $status;


	/**
	 * Class Constructor
	 * @param string   $id   
	 * @param string   $name   
	 * @param string   $percentage   
	 * @param string   $description   
	 * @param string   $status   
	 */
	public function __construct($id = null, $name = null, $percentage = null, $description = null, $type = null, $status = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->percentage = $percentage;
		$this->description = $description;
		$this->status = $status;
        $this->type = $type;
	}

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }



    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param string $percentage
     *
     * @return self
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
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