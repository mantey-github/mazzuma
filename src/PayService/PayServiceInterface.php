<?php
namespace Mantey\Mazzuma\PayService;

interface PayServiceInterface
{
    public function makePayment(array $data);

    public function verifyPayment($verifyId);

    public function getBalance();
}