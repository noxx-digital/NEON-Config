<?php

namespace Neon\Config;

use OutOfBoundsException;

class Config
{
    /**
     * @param array $data
     */
    public function __construct( private readonly array $data ) {}

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get( string $key )
    {
        if ( key_exists( $key, $this->config_data ))
            return $this->data[$key];
        else
            throw new OutOfBoundsException( "IndexNotFoundException: Config with name '$key' is not present." );
    }
}