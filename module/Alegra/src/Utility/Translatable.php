<?php 

namespace Alegra\Utility;

use Yandex\Translate\Translator;
use Yandex\Translate\Exception;

/**
* 
*/
class Translatable 
{
	private $translatable_fields;
    private $price_fields;
    private $rate_convertion;
	
	public function __construct()
	{
		$this->translatable_fields = array( 'name', 'description', 'observations' );
        $this->price_fields = array( 'price', 'unitCost' );
        $this->rate_convertion = $this->ConverCurrency();
	}

    public function toSpanish($data)
    {
        foreach ($data as $row => $value) {

            if (is_null($value) || $value == '') {
                $data[$row] = $value;
            } elseif (is_array($value)) {
                $data[$row] = $this->toSpanish($value);
            } elseif (in_array($row,$this->price_fields)){
                $data[$row] = $value * $this->rate_convertion;
            } else {
                $data[$row] = in_array($row,$this->translatable_fields) && !is_array($value) ? $this->TranslateEngToEsp($value)->getResult()[0] : $value;
            }

        }
        return $data;
    }

    public function toEnglish($data)
    {
        foreach ($data as $row => $value) {

            if (is_null($value) || $value == '') {
                $data[$row] = $value;
            } elseif (is_array($value)){
                $data[$row] = $this->toEnglish($value);
            } elseif (in_array($row,$this->price_fields)) {
                $data[$row] = $value / $this->rate_convertion;
            } else {
                $data[$row] = in_array($row,$this->translatable_fields) && !is_array($value) ? $this->TranslateEspToEng($value)->getResult()[0] : $value;
            }

        }
        return $data;
    }


	public function TranslateEngToEsp($value='')
	{
		$key = 'trnsl.1.1.20180326T025546Z.8759566ac41c77b4.3c47c8593776b4cfd74613030dd1bac355e6715f';
		try {
		  $translator = new Translator($key);
		  $translation = $translator->translate($value, 'en-es');

		  return $translation; // Привет мир

		  //echo $translation->getSource(); // Hello world;

		  //echo $translation->getSourceLanguage(); // en
		  //echo $translation->getResultLanguage(); // ru
		} catch (Exception $e) {
		  return $value;
		}
	}

	public function TranslateEspToEng($value='')
	{
		$key = 'trnsl.1.1.20180326T025546Z.8759566ac41c77b4.3c47c8593776b4cfd74613030dd1bac355e6715f';
		try {
		  $translator = new Translator($key);
		  $translation = $translator->translate($value, 'es-en');

		  return $translation; // Привет мир

		  //echo $translation->getSource(); // Hello world;

		  //echo $translation->getSourceLanguage(); // en
		  //echo $translation->getResultLanguage(); // ru
		} catch (Exception $e) {
		  return $value;
		}
	}



	public function ConverCurrency()
    {
        // set API Endpoint, access key, required parameters
            $endpoint = 'live';
            $access_key = '697bee86c1bd1128bf49fe7270dfbb97';

            $currencies = 'COP';

            // initialize CURL:
            $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies='.$currencies.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // get the (still encoded) JSON data:
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $conversionResult = json_decode($json, true);

            // access the conversion result
            return $conversionResult['quotes']['USDCOP'];
    }
}