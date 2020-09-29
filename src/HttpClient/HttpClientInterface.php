<?php
namespace Mantey\Mazzuma\HttpClient;

interface HttpClientInterface
{
    public function post($url, $data);

    public function get($url, $params = []);
}