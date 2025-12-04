# Navigation Module

*anomaly.module.navigation*

#### Powerful navigation management made easy.

The Navigation Module provides a flexible system for creating and managing navigation menus with support for nested links and dynamic menu building.

## Features

- Multiple navigation menus
- Nested menu structure (unlimited depth)
- Link types (URL, page, module, custom)
- Drag-and-drop menu builder
- Target and class attributes
- Permission-based visibility
- Menu caching
- Template rendering

## Usage

### Displaying Navigation

```twig
{# Display navigation menu #}
{{ nav('main')|raw }}

{# Display with custom view #}
{{ nav('main', 'theme::partials/navigation')|raw }}

{# Get navigation object #}
{% set menu = nav('main') %}
{% for link in menu.links %}
    <a href="{{ link.url }}">{{ link.title }}</a>
{% endfor %}
```

### Creating Menus Programmatically

```php
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;

$menus = app(MenuRepositoryInterface::class);
$links = app(LinkRepositoryInterface::class);

// Create menu
$menu = $menus->create([
    'slug' => 'footer',
    'name' => 'Footer Navigation'
]);

// Add links
$links->create([
    'menu' => $menu,
    'type' => 'url',
    'url' => '/about',
    'title' => 'About Us'
]);
```

## Requirements

- Streams Platform ^1.10
- PyroCMS 3.10+

## License

The Navigation Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
