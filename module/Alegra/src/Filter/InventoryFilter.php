<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;


use Alegra\Model\Inventory;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\I18n\Filter\NumberFormat;
use Zend\I18n\Validator\IsFloat;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;

class InventoryFilter
{
    protected $unit;
    protected $unitCost;
    protected $initialQuantity;
    protected $availableQuantity;
    protected $warehouses;

    public function createInputFilter()
    {
        $factory = new InputFilterFactory();

        $inputFilter = $factory->createInputFilter([
            'unit' => [
                'name' => 'unit',
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
                            'haystack' => [
                                'unit',
                                'centimeter',
                                'meter',
                                'inch',
                                'centimeterSquared',
                                'meterSquared',
                                'inchSquared',
                                'mililiter',
                                'liter',
                                'gallon',
                                'gram',
                                'kilogram',
                                'ton',
                                'pound',
                                'piece',
                                'service',
                                'notApplicable'
                            ]
                        ]
                    ]
                ]
            ],
            'unitCost' => [
                'name' => 'unitCost',
                'required' => false,
                'filters' => [
                    [   'name' => NumberFormat::class,
                        'options' => [
                            'type' => \NumberFormatter::IGNORE
                        ]
                    ],
                    [ 'name' => MyFilter::class]
                ],
                'validators' => [
                    [ 'name' => IsFloat::class]
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
            'warehouses' => [
                'name' => 'warehouses',
                'required' => false,
                'filters' => [
                    [ 'name' => MyFilter::class]
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
            return new Inventory($inputFilter->getValues());
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