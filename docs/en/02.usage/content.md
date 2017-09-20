## Usage[](#usage)

This section will show you how to use the addon via API and in the view layer.


### Menus[](#usage/menus)

Menus are stream entries that represent a collection of links.


#### Menu Fields[](#usage/menus/menu-fields)

Below is a list of `fields` in the `menus` stream. Fields are accessed as attributes:

    $menu->name;

Same goes for decorated instances in Twig:

    {{ menu.name }}

###### Fields

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Type</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

name

</td>

<td>

text

</td>

<td>

The menu name.

</td>

</tr>

<tr>

<td>

slug

</td>

<td>

slug

</td>

<td>

The menu API slug.

</td>

</tr>

<tr>

<td>

description

</td>

<td>

textarea

</td>

<td>

The menu description.

</td>

</tr>

</tbody>

</table>


#### Menu Interface[](#usage/menus/menu-interface)

This section will go over the `\Anomaly\NavigationModule\Menu\Contract\MenuInterface` class.


##### MenuInterface::getLinks()[](#usage/menus/menu-interface/menuinterface-getlinks)

The `getLinks` method returns a collection of the related menu links.

###### Returns: `\Anomaly\NavigationModule\Link\LinkCollection`

###### Example

    foreach ($menu->getLinks() as $link) {
        echo $link->getUrl();
    }

###### Twig

    {% for link in menu.getLinks() %}
        {{ link.getUrl() }}
    {% endfor %}


##### MenuInterface::links()[](#usage/menus/menu-interface/menuinterface-links)

The `links` method returns the link `relation`.

###### Returns: `\Illuminate\Database\Eloquent\Relations\HasMany`

###### Example

    foreach ($menu->links()->where('parent_id', 1)->get() as $link) {
        echo $link->getUrl();
    }

###### Twig

    {% for link in menu.links().where('parent_id', 1).get() %}
        {{ link.getUrl() }}
    {% endfor %}


#### Menu Repository[](#usage/menus/menu-repository)

This class will go over the `\Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface`


##### MenuRepositoryInterface::findBySlug()[](#usage/menus/menu-repository/menurepositoryinterface-findbyslug)

The `findBySlug` method returns a menu it's slug.

###### Returns: `\Anomaly\NavigationModule\Menu\Contract\MenuInterface` or `null`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$slug

</td>

<td>

true

</td>

<td>

string

</td>

<td>

none

</td>

<td>

The slug of the menu to find.

</td>

</tr>

</tbody>

</table>


### Links[](#usage/links)

Links are stream entries that belong to a menu. Links use extensions called `link type extensions` to define how they work.


#### Link Fields[](#usage/links/link-fields)

Below is a list of `fields` in the `links` stream. Fields are accessed as attributes:

    $link->title;

Same goes for decorated instances in Twig:

    {{ link.title }}

###### Fields

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

menu

</td>

<td>

true

</td>

<td>

relationship

</td>

<td>

none

</td>

<td>

The related menu.

</td>

</tr>

<tr>

<td>

type

</td>

<td>

true

</td>

<td>

addon

</td>

<td>

none

</td>

<td>

The link type extension.

</td>

</tr>

<tr>

<td>

entry

</td>

<td>

true

</td>

<td>

polymorphic

</td>

<td>

none

</td>

<td>

The related link information per link type.

</td>

</tr>

<tr>

<td>

target

</td>

<td>

true

</td>

<td>

select

</td>

<td>

none

</td>

<td>

The link's target attribute.

</td>

</tr>

<tr>

<td>

class

</td>

<td>

false

</td>

<td>

text

</td>

<td>

null

</td>

<td>

The link class.

</td>

</tr>

<tr>

<td>

parent

</td>

<td>

false

</td>

<td>

relationship

</td>

<td>

null

</td>

<td>

The related parent link.

</td>

</tr>

<tr>

<td>

allowed_roles

</td>

<td>

false

</td>

<td>

multiple

</td>

<td>

null

</td>

<td>

The user roles allowed to view the link.

</td>

</tr>

</tbody>

</table>


#### Link Interface[](#usage/links/link-interface)

This section will go over the `\Anomaly\NavigationModule\Link\Contract\LinkInterface` class.


##### LinkInterface::getUrl()[](#usage/links/link-interface/linkinterface-geturl)

The `getUrl` method returns the link's URL via it's `extension`.

###### Returns: `string`

###### Example

    $link->getUrl();

###### Twig

    {{ link.getUrl() }}


##### LinkInterface::getTitle()[](#usage/links/link-interface/linkinterface-gettitle)

The `getTitle` returns the link title via it's `extension`.

###### Returns: `string`

###### Example

    $link->getTitle();

###### Twig

    {{ link.getTitle() }}


### Plugin[](#usage/plugin)

This section will go over how to use the plugin that comes with the Navigation module.


#### menu[](#usage/plugin/menu)

The `menu` function let's you generate navigation structure based on the specified navigation menu.

The returned plugin criteria will render the resulting navigation automatically using `__toString()` if you do not explicitly call `render()`.

###### Returns: `\Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$root

</td>

<td>

false

</td>

<td>

mixed

</td>

<td>

none

</td>

<td>

The id, instance, or path of the root navigation link.

</td>

</tr>

</tbody>

</table>

###### Twig

    {{ menu()|raw }}

    {# Showing child navigation #}
    {{ menu('about')
        .linkAttributesDropdown({'data-toggle': 'dropdown'})
        .listClass('nav navbar-nav navbar-right')
        .childListClass('dropdown-menu')
        .render()|raw }}


##### Available Options[](#usage/plugin/menu/available-options)

The `menu` function uses the plugin criteria to allow you to configure options for the resulting navigation.

Options are defined by chaining together `camelCase` methods:

    {{ menu().optionOne('example')|raw }} // Results in option_one = example

So to define `dropdown_class` for example you would do this:

    {{ menu().dropdownClass('dropdown')|raw }}

<div class="alert alert-info">**Pro Tip:** Defining criteria options this way is standard throughout Pyro!</div>

###### Options

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

view

</td>

<td>

false

</td>

<td>

anomaly.module.navigation::links

</td>

<td>

The base view to render the navigation from.

</td>

</tr>

<tr>

<td>

macro

</td>

<td>

false

</td>

<td>

anomaly.module.navigation::macro

</td>

<td>

The macro to use for rendering the navigation.

</td>

</tr>

<tr>

<td>

depth

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The maximum depth of the navigation.

</td>

</tr>

<tr>

<td>

list_tag

</td>

<td>

false

</td>

<td>

ul

</td>

<td>

The list tag to use.

</td>

</tr>

<tr>

<td>

list_class

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The list class to use.

</td>

</tr>

<tr>

<td>

item_tag

</td>

<td>

false

</td>

<td>

li

</td>

<td>

The list item tag to use.

</td>

</tr>

<tr>

<td>

item_class

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The list item class to use.

</td>

</tr>

<tr>

<td>

dropdown_class

</td>

<td>

false

</td>

<td>

dropdown

</td>

<td>

The CSS class for links containing child links.

</td>

</tr>

<tr>

<td>

active_class

</td>

<td>

false

</td>

<td>

active

</td>

<td>

The CSS class for links that are selected or whose child link is selected.

</td>

</tr>

<tr>

<td>

selected_class

</td>

<td>

false

</td>

<td>

current

</td>

<td>

The CSS class for the currently selected navigation link.

</td>

</tr>

<tr>

<td>

link_class

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The CSS class to use for links.

</td>

</tr>

<tr>

<td>

link_attributes

</td>

<td>

false

</td>

<td>

[]

</td>

<td>

An array of key value html attributes for links.

</td>

</tr>

<tr>

<td>

link_attributes_dropdown

</td>

<td>

false

</td>

<td>

[]

</td>

<td>

An array of key value html attributes for links that have a dropdown.

</td>

</tr>

<tr>

<td>

child_list_tag

</td>

<td>

false

</td>

<td>

list_tag

</td>

<td>

The list tag for child lists.

</td>

</tr>

<tr>

<td>

child_list_class

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The list class for child lists.

</td>

</tr>

<tr>

<td>

dropdown_toggle

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The dropdown toggle tag to use in the case a dropdown toggle is desired.

</td>

</tr>

<tr>

<td>

dropdown_toggle_class

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The dropdown toggle class to use in the case a dropdown toggle is desired.

</td>

</tr>

<tr>

<td>

dropdown_toggle_attributes

</td>

<td>

false

</td>

<td>

[]

</td>

<td>

An array of key value html attributes for the dropdown toggle.

</td>

</tr>

<tr>

<td>

dropdown_toggle_text

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The text or HTML to display inside the dropdown toggle.

</td>

</tr>

</tbody>

</table>


#### links[](#usage/plugin/links)

The `links` function returns the links in a specified menu.

To return the collection of links use the `get()` trigger on the plugin criteria (see example below).

###### Returns: `\Anomaly\NavigationModule\Link\LinkCollection`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$menu

</td>

<td>

true

</td>

<td>

string

</td>

<td>

none

</td>

<td>

The slug of the menu to return links for.

</td>

</tr>

</tbody>

</table>

###### Twig

    {% for link in links('footer').get() %}
    <p>
        <a href="{{ link.url }}">{{ link.title }}</a>
    </p>
    {% endfor %}


##### Available Options[](#usage/plugin/links/available-options)

The `links` function uses the plugin criteria to allow you to configure options for the resulting navigation.

Options are defined by chaining together `camelCase` methods:

    {{ links().optionOne('example')|raw }} // Results in option_one = example

So to define `dropdown_class` for example you would do this:

    {{ links().dropdownClass('dropdown')|raw }}

<div class="alert alert-info">**Pro Tip:** Defining criteria options this way is standard throughout Pyro!</div>

###### Options

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

root

</td>

<td>

false

</td>

<td>

none

</td>

<td>

The id or path of the root link to start navigation from.

</td>

</tr>

</tbody>

</table>
