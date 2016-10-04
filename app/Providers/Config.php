<?php
/**
 * @author Abhimanyu Sharma <abhimanyusharma003@gmail.com>
 */
namespace App\Providers;

class Config
{
    /**
     * @var mixed
     */
    public $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = include __DIR__ . '/../Config/Config.php';
    }
}
