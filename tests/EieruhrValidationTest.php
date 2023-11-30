<?php

declare(strict_types=1);
include_once __DIR__ . '/stubs/Validator.php';
class EieruhrValidationTest extends TestCaseSymconValidation
{
    public function testValidateEieruhr(): void
    {
        $this->validateLibrary(__DIR__ . '/..');
    }
    public function testValidateEggTimerModule(): void
    {
        $this->validateModule(__DIR__ . '/../EggTimer');
    }
}