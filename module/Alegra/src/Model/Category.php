<?php 

namespace Alegra\Model;

/**
* 
*/
class Category 
{
	
	private $id;
    private $idParent;
	private $name;
    private $description;
    private $type;
    private $readOnly;

    /**
     * Category constructor.
     * @param $id
     * @param $idParent
     * @param $name
     * @param $description
     * @param $type
     * @param $readOnly
     */
    public function __construct($id = null, $idParent = null, $name = null, $description = null, $type = null, $readOnly = null)
    {
        $this->id = $id;
        $this->idParent = $idParent;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->readOnly = $readOnly;
    }

    /**
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @param mixed $idParent
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param mixed $readOnly
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
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

    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {
            $return[$row] = $value;
        }
        return $return;
    }
}