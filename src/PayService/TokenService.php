<?php
namespace Mantey\Mazzuma\PayService;

use Mantey\Mazzuma\HttpClient\Curl;

class TokenService implements PayServiceInterface
{
    protected $key;

    protected $httpClient;

    public function __construct($key)
    {
        $this->key = $key;

        $this->httpClient = new Curl;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function makePayment(array $data)
    {
        return $this->httpClient
            ->post("phase3/mazexchange-api.php", array_merge($data, ['apikey' => $this->key]));
    }

    /**
     * @param $verifyId
     * @return mixed
     */
    public function verifyPayment($verifyId)
    {
        return $this->httpClient->get("checktransaction.php", [
            'hash' => $verifyId
        ]);
    }

    public function getBalance()
    {
        return $this->httpClient->post('phase3/mazexchange-api.php', [
            'option' => 'get_balance',
            'apikey' => $this->key
        ]);
    }

}
