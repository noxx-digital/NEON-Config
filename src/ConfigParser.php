<?php

namespace Neon\Config;

use Neon\Config\Exception\FileNotFoundException;
use Neon\Config\Exception\IniParseException;
use Neon\Config\Exception\MissingConfigSettingException;

class ConfigParser
{
    /**
     * @var string
     */
    private string $ini_path;

    /**
     * @var bool
     */
    private bool $process_sections;

    /**
     * @var int
     */
    private int $scanner_mode;

    /**
     * @param string $ini_path
     * @param bool $process_sections
     * @param int $scanner_mode
     */
    public function __construct(
        string $ini_path,
        bool $process_sections=FALSE,
        int $scanner_mode=INI_SCANNER_NORMAL
    )
    {
        $this->ini_path = $ini_path;
    }

    /**
     * @return Config
     * @throws MissingConfigSettingException|FileNotFoundException
     * @throws IniParseException
     */
    public function load_config(): Config
    {
        if ( is_file( $this->ini_path ) )
        {
            $data = parse_ini_file( $this->ini_path, $this->process_sections, $this->scanner_mode );
            if( $data )
                return new Config( $data );
            else
                throw new IniParseException();
        }
        else
        {
            throw new FileNotFoundException( 'FileNotFoundException: ini file not found at \''.$this->ini_path.'\'' );
        }

    }
}