<?php

namespace Programic\Rdw\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Programic\Rdw\Result find(string $license, array $types): Programic\Rdw\Result
 *
 * @see \Illuminate\Database\Schema\Builder
 */
class Rdw extends Facade
{

    /**
     * Get a task builder instance.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return 'rdw';
    }
}
