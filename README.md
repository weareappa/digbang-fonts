Digbang/FontAwesome
===================

![Fake build status](http://img.shields.io/badge/build-passing-green.svg)

Helper class to create FontAwesome icons with a predefined markup.

Installation
------------

Download through composer:

```
composer require digbang/font-awesome
```

Add the service provider and facade to your `config/app.php`:

```php
'providers' => [
    // ...
    Digbang\FontAwesome\FontAwesomeServiceProvider::class,
    
],

'aliases' => [
    // ...
    'FontAwesome' => Digbang\FontAwesome\Facade::class,
],
```

Usage
-----

### Through the facade

```php
FontAwesome::icon('icon', 'extra-class') // <i class="fa fa-icon extra-class"></i>
// or...
FontAwesome::icon('icon', ['class' => 'extra-class']) // <i class="fa fa-icon extra-class"></i>
```

### Through the helper function

```php
fa('icon', 'extra-class') // <i class="fa fa-icon extra-class"></i>
// or...
fa('icon', ['class' => 'extra-class']) // <i class="fa fa-icon extra-class"></i>
```

### HTML Attributes

You can also add any other attributes to the html.
Doing...

```php
fa('times', ['title' => 'Delete this!']) // <i class="fa fa-times" title="Delete this!"></i>
```

### Changing the tag

You can change the tag used by the library.
Doing...

```php
FontAwesome::setTag('span');

fa('edit'); // <span class="fa fa-edit"></span>
```

### Standalone usage

Non-Laravel projects can still use this, but the Facade and helper function won't be available.

```php
$fa = new Digbang\FontAwesome\FontAwesome;
$fa->setTag('span');
$fa->icon('times', 'text-danger'); // <span class="fa fa-times text-danger"></span>
```
