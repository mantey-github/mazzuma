<?php
namespace Mantey\Mazzuma\HttpClient;


class Curl implements HttpClientInterface
{
    protected $curl;

    protected $defaultOptions;

    protected $baseUrl = "https://client.teamcyst.com";


    public function __construct()
    {
        $this->curl = curl_init();

        $this->defaultOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ];
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function post($url, $data)
    {
        $postURL = $this->baseUrl."/".$url;

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $postURL = $url;
        }

        $options = [
            CURLOPT_URL => $postURL,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ];

        return $this->call($options);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed
     */
    public function get($url, $params = [])
    {
        $getURL = !empty($params) ? $this->baseUrl."/".$url."?".http_build_query($params) : $this->baseUrl."/".$url;

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $getURL = !empty($params) ? $url ."?".http_build_query($params) : $url;
        }

        $options = [
            CURLOPT_URL => $getURL,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ];

        return $this->call($options);
    }


    /**
     * @param array $options
     * @return mixed
     */
    protected function call($options = [])
    {
        try {
            curl_setopt_array($this->curl, ($this->defaultOptions + $options));

            $response = curl_exec($this->curl);

            curl_close($this->curl);

            return $response;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}