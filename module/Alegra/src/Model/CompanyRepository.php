<?php 

namespace Alegra\Model;

class CompanyRepository implements CompanyRepositoryInterface
{

	private $data = [
        'name' => 'Mi empresa en Alegra',
        'identification' => '900.123.123-8',
        'phone' =>	'111 111 11 11',
        'website' =>	'www.alegra.com',
        'email' =>	'soporte@alegra.com',
        'regime' =>	'Régimen común',
        'currency' => [
            'code'    => 'COP',
            'symbol' => '$',
            'exchangeRate'  => 2950,
        ],
        'multicurrency' => true,
        'address' => [
            'address'    => 'Calle principal #45',
            'city' => 'Barcelona',
        ],
        'decimalPrecision' => 0,
        'invoicePreferences' => [
            'defaultAnotation' => 'Notas por defecto de mi empresa',
            'defaultTermsAndConditions'  => 'Esta factura se asimila en todos sus efectos a una letra de cambio de conformidad con el Art. 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por mora.',
        ],
        'applicationVersion' => 'colombia',
        'registryDate' => '2016-03-07 17:00:07',
        'logo' => 'https://cdn2.alegra.com/website/Logos_Alegra/Logotipo-Alegra.png',
        'timezone' => 'America/Bogota'
    ];

    /**
     * {@inheritDoc}
     */
    public function findCompany()
    {
        // TODO: Implement findCompany() method.
        return new Company(
        	$this->data['name'],
            $this->data['identification'],
            $this->data['phone'],
            $this->data['website'],
            $this->data['email'],
            $this->data['regime'],
            $this->data['currency'],
            $this->data['multicurrency'],
            $this->data['address'],
            $this->data['decimalPrecision'],
            $this->data['invoicePreferences'],
            $this->data['applicationVersion'],
            $this->data['registryDate'],
            $this->data['logo'],
            $this->data['timezone']
        );
    }
}
