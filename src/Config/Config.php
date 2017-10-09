<?php
namespace Lavegui\Calendar\Config;

/**
 * Interface Config
 * @package Lavegui\Calendar\Config
 */
interface Config
{
    /**
     * @return bool
     */
    public function isDevMode();

    /**
     * @return array
     */
    public function db();

    /**
     * @return array
     */
    public function mappingPaths();
}
