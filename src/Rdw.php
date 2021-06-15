<?php

namespace Programic\Rdw;

use Illuminate\Contracts\Foundation\Application;

class Rdw
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param bool|callable $condition
     * @param callable $task
     * @return $this
     */
    public function find($license, array $types = ['info'])
    {
        return (new RdwApi)->find($license, $types);
    }
}
