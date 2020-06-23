<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\UnsupportedDocumentException;

class ParserFactory
{
    /**
     * @var ParserInterface[]
     */
    private array $parsers = [];

    public function __construct()
    {
        $this->addParser(new PassportParser());
        $this->addParser(new TravelDocumentType1Parser());
        $this->addParser(new FrenchCNIDocumentParser());
        $this->addParser(new VehicleRegistrationDocumentParser());
    }

    public function addParser(ParserInterface $parser): void
    {
        $this->parsers[] = $parser;
    }

    /**
     * @param $mrzString
     * @return ParserInterface
     * @throws UnsupportedDocumentException
     */
    public function create($mrzString)
    {
        foreach ($this->parsers as $parser) {
            if ($parser->support($mrzString)) {
                return $parser;
            }
        }

        throw new UnsupportedDocumentException("String length didn't match that of known document types");
    }
}
