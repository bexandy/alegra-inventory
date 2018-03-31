<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 28/03/18
 * Time: 10:15 AM
 */

namespace Alegra\Filter;


use Alegra\Model\Tax;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Filter\ToNull;
use Zend\I18n\Filter\NumberFormat;
use Zend\I18n\Validator\IsFloat;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class TaxFilter
{
    protected $id;
    protected $name;
    protected $percentage;
    protected $description;
    protected $type;
    protected $status;

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
            'percentage' => [
                'name' => 'percentage',
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
            'type' => [
                'name' => 'type',
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
                'required' => true,
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
            return new Tax($inputFilter->getValues());
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