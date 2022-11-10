<?php

namespace Neon\Config;

use Neon\Config\Exception\FileNotFoundException;
use Neon\Config\Exception\IniParseException;

class ConfigParser
{
    /**
     * @param bool $process_sections
     * @param int $scanner_mode
     */
    public function __construct(
        public readonly bool $process_sections=FALSE,
        public readonly int $scanner_mode=INI_SCANNER_NORMAL
    )
    {}

    /**
     * @param string $ini_path
     *
     * @return Config
     * @throws FileNotFoundException
     * @throws IniParseException
     */
    public function load_config( string $ini_path ): Config
    {
        if ( is_file( $ini_path ) )
        {
            $data = parse_ini_file( $ini_path, $this->process_sections, $this->scanner_mode );
            if( $data )
                return new Config( $data );
            else
                throw new IniParseException();
        }
        else
        {
            throw new FileNotFoundException( 'FileNotFoundException: ini file not found at \''.$ini_path.'\'' );
        }

    }
}