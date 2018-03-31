<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;


use Alegra\Model\Warehouses;
use Zend\Filter\Boolean;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class WarehousesFilter
{
    protected $id;
    protected $name;
    protected $observations;
    protected $isDefault;
    protected $address;
    protected $initialQuantity;
    protected $availableQuantity;
    protected $status;

    public function createInputFilter()
    {
        $factory = new InputFilterFactory();

        $inputFilter = $factory->createInputFilter([
            'id' => [
                'name' => 'id',
                'required' => false,
                'filters' => [
                    [ 'name' => ToInt::class],
                    [ 'name' => MyFilter::class]
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
            'observations' => [
                'name' => 'observations',
                'required' => false,
                'filters' => [
                    [ 'name' => StringTrim::class],
                    [ 'name' => StripTags::class],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [ 'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 500
                        ]
                    ]
                ]
            ],
            'isDefault' => [
                'name' => 'isDefault',
                'required' => false,
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
            'address' => [
                'name' => 'address',
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
            'initialQuantity' => [
                'name' => 'initialQuantity',
                'required' => false,
                'filters' => [
                    [ 'name' => ToInt::class],
                    [ 'name' => MyFilter::class]
                ],
             ],

            'availableQuantity' => [
                'name' => 'availableQuantity',
                'required' => false,
                'filters' => [
                    [ 'name' => ToInt::class],
                    [ 'name' => MyFilter::class]
                ],
            ],
            'status' => [
                'name' => 'status',
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
                            'haystack' => ['active', 'inactive']
                        ]
                    ]
                ]
            ]
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
            return new Warehouses($inputFilter->getValues());
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