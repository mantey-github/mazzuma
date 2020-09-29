<?php

namespace Mantey\Mazzuma;
use Exception;

class Mazzuma
{
    protected $key;

    protected $service;

    public function __construct()
    {
        $config = include __DIR__.'/../config/mazzuma.php';
        $this->key = $config['key'];
    }

    /**
     * @param $service
     * @return mixed
     * @throws Exception
     */
    public function payWith($service)
    {
        $serviceClass = __NAMESPACE__ . '\\PayService\\'.$this->studly($service).'Service';
        if (!class_exists($serviceClass)) {
            $error = "$service is not a known pay service at Mazzuma. Try our `mobile-money` or `token` pay service";
            throw new Exception($error);
        }

        return new $serviceClass($this->key);
    }

    public function studly($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}