Digbang/Fonts
===================

Helper class to create Font icons with a predefined markup.

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
    Digbang\Fonts\FontsServiceProvider::class,
    
],

'aliases' => [
    // ...
    'Fonts' => Digbang\Fonts\Facade::class,
],
```

Publish the config file:

```
php artisan vendor:publish --provider Digbang\\Fonts\\FontsServiceProvider
```

Usage
-----

### Through the facade

```php
// The `icon` function will use the configured icon prefix (defaults to "fa")
Fonts::icon('icon', 'extra-class') // <i class="fa fa-icon extra-class"></i>

// Package provides "fa" and "mat" as helper method for Font Awesome and Material Design icons.
Fonts::fa()->icon('icon', ['class' => 'extra-class']) // <i class="fa fa-icon extra-class"></i>
Fonts::mat()->icon('icon', ['class' => 'extra-class']) // <i class="zmdi zmdi-icon extra-class"></i>
```

### Through the helper function

```php
icon('foo'); // <i class="fa fa-foo"></i>
fa('icon', 'extra-class') // <i class="fa fa-icon extra-class"></i>
mat('icon', ['class' => 'extra-class']) // <i class="mat mat-icon extra-class"></i>
```

### HTML Attributes

You can also add any other attributes to the html.

```php
fa('times', ['title' => 'Delete this!']) // <i class="fa fa-times" title="Delete this!"></i>
```

### Inner content

An icon can have inner content:

```php
fa('times', 'text-hide')->withContent("Remove element");

// FontAwesome stacks
fa('stack', 'fa-lg')->withContent(
	fa('circle', 'fa-stack-2x') .
	fa('flag', 'fa-stack-1x fa-inverse')
);
```

### Changing the tag

You can change the tag used by the library.

```php
// Setting a new default tag to all fonts
Fonts::setDefaultTag('span');
fa('edit'); // <span class="fa fa-edit"></span>

// Setting a tag on each use
Fonts::fa()->withTag('span')->icon('times'); // <span class="fa fa-times"></span>
```

### Extending the factory

The `Digbang\Fonts\FontManager` can be extended with macros:

```php
Fonts::macro('digbang', function () {
	return $this->create('db');
});

Fonts::digbang()->icon('foo'); // <i class="db db-foo"></i>
```

### Standalone usage

Non-Laravel projects can still use this, but the Facade and helper function won't be available.

```php
$fonts = new Digbang\Fonts\Factory('fa');
$fonts->setDefaultTag('span');

$fonts->icon('times', 'text-danger'); // <span class="fa fa-times text-danger"></span>
$fonts->mat()->icon('times', 'text-danger'); // <span class="mat mat-times text-danger"></span>
```
