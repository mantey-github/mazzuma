<?php

namespace Mantey\Mazzuma;
use Exception;

class Mazzuma
{
    protected $service;

    /**
     * Mazzuma constructor.
     * @param $service
     * @throws Exception
     */
    public function __construct($service)
    {
        $config = include __DIR__.'/../config/mazzuma.php';

        $this->payWith($service, $config['key']);
    }

    /**
     * @param $service
     * @param $key
     * @return mixed
     * @throws Exception
     */
    private function payWith($service, $key)
    {
        $serviceClass = __NAMESPACE__ . '\\PayService\\'.$this->studly($service).'Service';
        if (!class_exists($serviceClass)) {
            $error = "$service is not a known pay service at Mazzuma. Try our `mobile-money` or `token` pay service";
            throw new Exception($error);
        }

        return new $serviceClass($key);
    }

    public function studly($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}