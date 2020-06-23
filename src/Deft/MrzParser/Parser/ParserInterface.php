<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Document\DocumentInterface;
use Deft\MrzParser\Exception\ParseException;

interface ParserInterface
{
    /**
     * Extracts all the information from a MRZ string and returns a populated instance of DocumentInterface
     *
     * @param $string
     * @return DocumentInterface
     * @throws ParseException
     */
    public function parse($string);

    public function support(string $mrz): bool;
}
