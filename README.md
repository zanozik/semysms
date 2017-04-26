SemySMS Notifications Channel
================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)

## Installation

You can install the package via composer:

``` bash
composer require zanozik/semysms
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\SemySMS\SemySMSServiceProvider::class,
],
```

### Setting up the SemySMS service

Sign up on [SemySMS](https://semysms.net) and create your token in your Control Panel -> API.

Add the following section and fill in the details there (you can also use your .env file to store your credentials):

```php
// config/services.php
...
'semysms' => [
    'token' => env('SEMYSMS_TOKEN', '12345678901234567890'),
    'device' => env('SEMYSMS_DEVICE', '12345')
],
...
```

## Usage

You can now use the channel in your `via()` method inside the Notification class.

``` php
use NotificationChannels\SemySMS\SemySMSChannel;
use NotificationChannels\SemySMS\SemySMSMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification{

    public function via($notifiable){
        return [SemySMSChannel::class];
    }

    public function toSmsGatewayMe($notifiable){
        return (new SemySMSMessage)->text('Your invoice has been paid');
    }
}
```

### Routing a message

You should add a `routeNotificationForSemySMS()` method in your notifiable model:

``` php
...
/**
 * Route notifications for the SemySMS channel.
 *
 * @return int
 */
public function routeNotificationForSemySMS(){
    return $this->phone_number;
}
...
```

### Available methods

- `text($text)`: (string) SMS Text.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/zanozik/semysms.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg

[link-packagist]: https://packagist.org/packages/zanozik/semysms
