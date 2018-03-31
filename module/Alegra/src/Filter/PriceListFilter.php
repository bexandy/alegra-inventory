<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;


use Alegra\Model\PriceList;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\I18n\Filter\NumberFormat;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class PriceListFilter
{
    protected $idPriceList;
    protected $id;
    protected $name;
    protected $status;
    protected $type;
    protected $percentage;
    protected $price;


    public function createInputFilter()
    {
        $factory = new InputFilterFactory();

        $inputFilter = $factory->createInputFilter([
            'idPriceList' => [
                'name' => 'idPriceList',
                'required' => false,
                'filters' => [
                    [ 'name' => ToInt::class],
                    [ 'name' => MyFilter::class]
                ]
            ],
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
                            'haystack' => ['amount', 'percentage']
                        ]
                    ]
                ]
            ],
            'percentage' => [
                'name' => 'percentage',
                'required' => false,
                'filters' => [
                    [   'name' => NumberFormat::class,
                        'options' => [
                            'type' => \NumberFormatter::FRACTION_DIGITS
                        ]
                    ],
                    [ 'name' => MyFilter::class]
                ],
            ],
            'price' => [
                'name' => 'price',
                'required' => false,
                'filters' => [
                    [   'name' => NumberFormat::class,
                        'options' => [
                            'type' => \NumberFormatter::IGNORE
                        ]
                    ],
                    [ 'name' => MyFilter::class]
                ],
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
            return new PriceList($inputFilter->getValues());
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