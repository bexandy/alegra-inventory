<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;

use Alegra\Model\Product;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class ProductFilter
{
    protected $id;
    protected $name;
    protected $description;
    protected $reference;
    protected $price;
    protected $tax;
    protected $category;
    protected $inventory;
    protected $status;
    protected $productKey;

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
                    [   'name' => StringTrim::class],
                    [   'name' => StripTags::class],
                    [   'name' => MyFilter::class]
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
            'reference' => [
                'name' => 'reference',
                'required' => false,
                'filters' => [
                    [   'name' => StringTrim::class],
                    [   'name' => StripTags::class],
                    [   'name' => MyFilter::class]
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
            'description' => [
                'name' => 'description',
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
            'price' => [
                'name' => 'price',
                'required' => false,
                'filters' => [
                    [ 'name' => MyFilter::class]
                ]
            ],
            'tax' => [
                'name' => 'tax',
                'required' => false,
                'filters' => [
                    [ 'name' => MyFilter::class]
                ]
            ],
            'category' => [
                'name' => 'category',
                'required' => false,
                'filters' => [
                    [ 'name' => MyFilter::class]
                ]
            ],
            'inventory' => [
                'name' => 'inventory',
                'required' => false,
                'filters' => [
                    [ 'name' => MyFilter::class]
                ]
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
            ],
            'productKey' => [
                'name' => 'productKey',
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
                            'min' => 8,
                            'max' => 8
                        ]
                    ]
                ]
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
            return new Product($inputFilter->getValues());
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