<?php

namespace Programic\Rdw\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Programic\Rdw\Rdw find(string $license, array $types)
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
