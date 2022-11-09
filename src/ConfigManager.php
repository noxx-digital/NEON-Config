<?php

namespace Trinity;

use MissingConfigSettingException;
use FileNotFoundException;
use OutOfBoundsException;

class ConfigManager
{
    /**
     * @var array
     */
    private array $config_data;

    /**
     * @var string
     */
    private string $ini_path;

    /**
     * @var array
     */
    private array $mandatory_fields;

    /**
     * @param string $ini_path
     * @param bool $process_sections
     * @param int $scanner_mode
     */
    public function __construct(
        string $ini_path,
        private bool $process_sections=FALSE,
        private int $scanner_mode=INI_SCANNER_NORMAL
    )
    {
        $this->config_data  = [];
        $this->ini_path     = $ini_path;
    }

    /**
     * @param string $field_name
     *
     * @return void
     */
    public function set_mandatory_field( string $field_name )
    {
        $this->mandatory_fields[] = $field_name;
    }

    /**
     * @return void
     * @throws MissingConfigSettingException
     */
    public function check_mandartory_fields(): void
    {
          if( sizeof( $this->mandatory_fields ) > 0 )
              foreach( $this->mandatory_fields as $key => $value )
                  if( !key_exists( $key, $this->config_data ))
                      throw new MissingConfigSettingException(
                          "ConfigurationError: Missing mandatory config field: ('.$key.')\n"
                      );
    }

    /**
     * @return void
     * @throws MissingConfigSettingException|FileNotFoundException
     */
    public function ini_load(): void
    {
        if ( is_file( $this->ini_path ) )
            $this->config_data = parse_ini_file( $this->ini_path, $this->process_sections, $this->scanner_mode );
        else
            throw new FileNotFoundException( 'FileNotFoundException: ini file not found at \''.$this->ini_path.'\'' );

        $this->check_mandartory_fields();
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get( string $name )
    {
        if ( key_exists( $name, $this->config_data ))
            return $this->config_data[$name];
        else
            throw new OutOfBoundsException( "IndexNotFoundException: Config with name '$name' is not present." );
    }
}

