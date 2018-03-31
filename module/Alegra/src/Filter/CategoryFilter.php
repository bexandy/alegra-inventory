<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;


use Alegra\Model\Category;
use Zend\Filter\Boolean;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class CategoryFilter
{
    protected $id;
    protected $idParent;
    protected $name;
    protected $description;
    protected $type;
    protected $readOnly;


    public function createInputFilter()
    {
        $factory = new InputFilterFactory();

        $inputFilter = $factory->createInputFilter([
            'id' => [
                'name' => 'id',
                'required' => true,
                'filters' => [
                    [ 'name' => ToInt::class],
                    [ 'name' => MyFilter::class]
                ]
            ],
            'idParent' => [
                'name' => 'idParent',
                'required' => false,
                'filters' => [
                    [ 'name' => StringTrim::class],
                    [ 'name' => StripTags::class],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [   'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 45
                        ]
                    ]
                ]
            ],
            'name' => [
                'name' => 'name',
                'required' => false,
                'filters' => [
                    [ 'name' => StringTrim::class],
                    [ 'name' => StripTags::class],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [   'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 150
                        ]
                    ]
                ]
            ],
            'description' => [
                'name' => 'description',
                'required' => false,
                'filters' => [
                    [ 'name' => StringTrim::class],
                    [ 'name' => StripTags::class],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [   'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 500
                        ]
                    ]
                ]
            ],
            'type' => [
                'name' => 'type',
                'required' => false,
                'filters' => [
                    [ 'name' => StringTrim::class],
                    [ 'name' => StripTags::class],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [
                        'name' => InArray::class,
                        'options' => [
                            'haystack' => ['income', 'expense', 'equity', 'asset', 'liability']
                        ]
                    ]
                ]
            ],
            'readOnly' => [
                'name' => 'readOnly',
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    [ 'name' => Boolean::class,
                        'options' => [
                            'type' => Boolean::TYPE_BOOLEAN,
                            'casting' => false
                        ]
                    ],
                    [ 'name' => MyFilter::class]
                ],
            ],
        ]);

        return $inputFilter;
    }

    /**
     * @return mixed
     */
    public function create($data)
    {
        $inputFilter =$this->createInputFilter();
        $inputFilter->setData($data);

        if ($inputFilter->isValid()) {
            return new Category($inputFilter->getValues());
        }

        return $inputFilter->getMessages();

    }

    public function validate($data)
    {
        $inputFilter =$this->createInputFilter();
        $inputFilter->setData($data);

        return $inputFilter;

    }

}