# Laravel Barcode Generator

An adaptation of https://github.com/GameMaker2k/UPC-A-EAN-13-Maker, designed to provide a barcode route and functions for Laravel.

The package currently works with:
 - EAN 13 / EAN-13 / EAN13
 - ITF 14 / ITF-14 / ITF14

Include the repo within composer.json

```
"repositories": [
    {
        "url": "https://github.com/CraigWoodlandOW/laravel-barcode-generator",
        "type": "git"
    }
],
```

And reference as below:

```
"require": {
    "craigwoodlandow/laravel-barcode-generator": "dev-master"
},
```

This will provide the following routes:

```
{application_url}/vendor/barcode/itf14/{barcode_value}.png
{application_url}/vendor/barcode/ean13/{barcode_value}.png
```

For example:

```
{application_url}/vendor/barcode/itf14/10077101050361.png
{application_url}/vendor/barcode/ean13/077101050364.png
```
