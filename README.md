# Mazzuma PHP package

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

This package provide an easy way to integrate [Mazzuma](https://mazzuma.com/) into your payment web application. 

Mazzuma allows you to gain mobile money payments from customers and clients with optimal ease 
and at no extra charges (standard mobile money operator charges apply).

## Installation

You can install the package via composer:

```bash
composer require mantey/mazzuma
```

## Usage
Head over to the [mazzuma dashboard](https://dashboard.teamcyst.com/) and create a new Mazzuma account to get your API key.

Open the `/config/mazzuma.php` and set the key with your Mazzuma API Key.

##### Mazzuma Mobile Money Payment
``` php

require "vendor/autoload.php"

use Mantey\Mazzuma\Mazzuma;

//Make Mobile Money Pament

$response = (new Mazzuma('mobile-money'))
        ->makePayment([
            "price" => 1,
            "network" => "mtn",
            "recipient_number" => "026xxxxxxx",
            "sender" => "024xxxxxxx",
            "option" => "rmta",
            "orderID" => "123342"
        ]);
                
print_r($response);

// Verify Mobile Money Pament

$verifyID = '1223234';

$response = (new MazzumaApi('mobile-money'))
                ->verify($verifyID);
                
print_r($response);
```

##### MAZ Token Payment
``` php

require "vendor/autoload.php"

use Mantey\Mazzuma\Mazzuma;

//Make Token Pament

$response = (new Mazzuma('token'))
        ->makePayment([
            "amount"=> 1,
            "recipient"=> "",
            "sender"=> "",
        ]);
                
print_r($response);

// Verify Token Pament

$hashVerifyID = '1223234';

$response = (new MazzumaApi('token'))
                ->verify($hashVerifyID);
                
print_r($response);
```

##### Mazzuma Payment Extras
``` php

require "vendor/autoload.php"

use Mantey\Mazzuma\Mazzuma;

//Get Balance

$response = (new Mazzuma('token'))
        ->getBalance();
                
print_r($response);
```

## Contributing

Please report any issue you find in the issues page. Pull requests are always welcome.

## License

Mazzuma is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-version]: https://img.shields.io/packagist/v/mantey/mazzuma.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mantey/mazzuma.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mantey/mazzuma
[link-downloads]: https://packagist.org/packages/mantey/mazzuma
[link-author]: https://github.com/mantey-github


