<?php

namespace HackAssembler\Parsers;

use HackAssembler\MapRegister;
use HackAssembler\AssemblerConstants;

class AInstructionParser
{
    public function handle(string $line, MapRegister $mapRegister): string
    {
        if (!str_starts_with($line, '@')) {
            return '';
        }

        $line = str_replace('@', '', $line);
        $line = $mapRegister->findSymbol($line) ?: $line;
        $foundSymbol = $mapRegister->findSymbol($line);

        if (!$foundSymbol && !is_numeric($line)) {
            $mapRegister->registerSymbol($line);
        } elseif ($foundSymbol) {
            $line = $foundSymbol;
        }

        return str_pad(decbin($line), AssemblerConstants::MAX_BITS_FOR_NUMBER, '0', STR_PAD_LEFT);
    }
}
