# ComuniBundle

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require metarete/comuni-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Metarete\ComuniBundle\ComuniBundle::class => ['all' => true],
];
```
## Load database

Go to Garda Informatica website and download archive from https://www.gardainformatica.it/database-comuni-italiani; unzip in your path.

Open a command console, enter your project directory and execute the
following command to load the archive:

```php
$ bin/console metarete:comuni:load /<path_to>/gi_comuni_cap.json
```

## Use Service

You can call the provided `ComuniService` to:

* get a list of distinct province abbreviations (this->comuniService->getProvinceList())
* get a list of unique CAP (postal codes) from a given comune ($this->comuniService->getCAPListFromComune('Torino'))
* get a list of unique CAP (postal codes) from a given province ($this->comuniService->getCAPListFromProvincia('MI'))


## Link

[Garda Informatica](https://www.gardainformatica.it/)

## Credits

[Metarete s.r.l.](https://metarete.it)