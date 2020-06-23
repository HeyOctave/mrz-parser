<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Document\TravelDocument;
use Deft\MrzParser\Document\TravelDocumentInterface;
use Deft\MrzParser\Document\TravelDocumentType;
use Deft\MrzParser\Exception\ParseException;

/**
 * Parser of french CNI documents.
 * @see https://fr.wikipedia.org/wiki/Carte_nationale_d%27identit%C3%A9_en_France
 *
 * @package Deft\MrzParser\Parser
 */
class FrenchCNIDocumentParser extends AbstractParser
{
    public function support(string $mrz): bool
    {
        return strlen($mrz) === 72 && 'ID' === $this->getToken($mrz, 1, 2);
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
        if ('ID' !== $this->getToken($string, 1, 2)) {
            throw new ParseException("First characters are not 'ID'");
        }

        $secondLine = 36;

        $fields = [
            'type' => TravelDocumentType::ID_CARD,
            'primaryIdentifier' => $this->getToken($string, 6, 30),
            'documentNumber' => $this->getToken($string, $secondLine + 1, $secondLine + 12),
            'secondaryIdentifier' => $this->getNames($string, $secondLine + 14, $secondLine + 27)[0],
            'dateOfBirth' => $this->getDateToken($string, $secondLine + 28),
            'sex' => $this->getToken($string, $secondLine + 35),
            'nationality' => $this->getToken($string, 3, 5)
        ];

        return new TravelDocument($fields);
    }
}
