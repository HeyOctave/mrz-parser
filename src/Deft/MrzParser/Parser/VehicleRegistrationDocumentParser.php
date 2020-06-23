<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Document\TravelDocumentInterface;
use Deft\MrzParser\Document\VehicleRegistrationDocument;
use Deft\MrzParser\Exception\ParseException;

class VehicleRegistrationDocumentParser extends AbstractParser
{
    public function support(string $mrz): bool
    {
        return strlen($mrz) === 88 && 'CR' === $this->getToken($mrz, 1, 2);
    }

    /**
     * Extracts all the information from a MRZ string and returns a populated instance of TravelDocumentInterface
     *
     * @param $string
     * @return TravelDocumentInterface
     * @throws ParseException
     */
    public function parse($string)
    {
        if ('CR' !== $this->getToken($string, 1, 2)) {
            throw new ParseException("First characters are not 'CR'");
        }

        $secondLine = 44;

        $fields = [
            'issuingCountry' => $this->getToken($string, 3, 5),
            'vehicleNumber' => $this->getToken($string, 6, 12),
            'registrationNumber' => $this->getToken($string, 15, 31),
        ];

        return new VehicleRegistrationDocument($fields);
    }
}
