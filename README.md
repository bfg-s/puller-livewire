# puller-livewire

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/bfg-s/puller-livewire.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/bfg/puller-livewire.svg?style=flat-square)](https://packagist.org/packages/bfg-s/puller-livewire)

## Install
`composer require bfg/puller-livewire`

## Usage
1. Make sure that in your `public/vendor` folder published `puller-livewire/puller-livewire.js`.
   He had to appear immediately after installing the package,
   as it broads publications in the `laravel-assets` group.
   If this did not happen and you did not appear there, publish it manually:
```bash
php artisan vendor:publish --tag=puller-livewire-assets
```
2. Connect the script in your document after Livewire initialization:
```html
@livewireScripts()
<script src="{{ asset('vendor/puller-livewire/puller-livewire.js') }}"></script>
```
3. In Livewire component make event:
```php
class OrderTracker extends Component
{
    public $showNewOrderNotification = false;
 
    // Special Syntax: ['puller:{event}' => '{method}']
    protected $listeners = ['puller:livewire_event_name' => 'notifyNewOrder'];
 
    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
    }
}
```
4. Send Create a guide class or an anonymous channel named `livewire_event_name`.

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Credits

- [Xsaven](https://github.com/bfg-s)
- [All Contributors](https://github.com/bfg-s/puller-livewire/contributors)

## Security
If you discover any security-related issues, please email xsaven@gmail.com instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
