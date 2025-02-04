<?php

namespace Asnardd\LangHelper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Asnardd\LangHelper\LangHelper
 */
class LangHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Asnardd\LangHelper\LangHelper::class;
    }
}
