# laravel-filterable

[![Build Status](https://travis-ci.org/meikooy/laravel-filterable.svg?branch=master)](https://travis-ci.org/meikooy/laravel-filterable)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Use url parameters to easily sort, filter and search eloquent models.

[Class documentation](https://meikooy.github.io/laravel-filterable/)

## Table of Contents
<details><summary>Click to expand</summary><p>

- [laravel-filterable](#laravel-filterable)
  - [Table of Contents](#table-of-contents)
  - [Getting started](#getting-started)
    - [Installation](#installation)
    - [Configuration](#configuration)
    - [Usage](#usage)
  - [Sorting](#sorting)
    - [Ascending order](#ascending-order)
    - [Descending order](#descending-order)
  - [Filtering](#filtering)
    - [Id columns](#id-columns)
    - [Custom filters](#custom-filters)
  - [Searching](#searching)
  - [Prerequisites](#prerequisites)
  - [Usage](#usage-1)


</p></summary></details>

## Getting started

### Installation
Install with composer

```sh
composer require meikooy/laravel-filterable 
```

### Configuration

Create new configuration file `filterable.php` in your [config](https://laravel.com/docs/6.x/configuration#introduction) directory (`config/filterable.php`).
```php
<?php

return [
    'namespace' => '\App\Models' # The namespace which contains your models
];
```
### Usage

To enable usage for your model, you need to apply the provided [Filterable](./src/Filterable.php) trait to your model.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Meiko\Filterable\Filterable;

class Post extends Model {
    use Filterable;
}
```

Next, call the `filters` in your controllers.

Example:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return Post::filters(
            function ($filterer) {
                return $filterer;
            }
        );    
    }
    

```

## Sorting

To sort your eloquent models, use the `sort` url param:

`sort=<column-name>`.

### Ascending order
Example: Sort post's in ascending order by the posts `updated_at` column.
```sh
http://localhost/api/posts?sort=updated_at

```
### Descending order

To sort the results in descending order, prefix the url param value with `-`.
```sh
http://localhost/api/posts?sort=-updated_at

```

## Filtering

To filter your eloquent models, you need to provide the `column name`, `comparison type` and `value` in the url.

`<column-name>=<comparison-type>=<value>`

Examples:

Fetch posts where the `title` column has text like `Lorem ipsum`
```
http//localhost/api/posts?title=lk=Lorem ipsum
```

Fetch posts where the `title` is NOT like `Lorem ipsum`
```
http//localhost/api/posts?title=nl=Lorem ipsum
```


Fetch posts where the `read_count` column has value bigger than 100.
```
http//localhost/api/posts?read_count=gt=100
```

Fetch posts where the `title` column contains one of: `Lorem ipsum`, `Hello` or `First`
```
http//localhost/api/posts?title=in=Lorem ipsum|Hello|First
```

NOTE: When providing multiple values, separate the elements with `|` character. Only the `bw`, `not-bw`, `in`, `not-in` comparison types support multiple values.

See [Field.php](./src/Field.php#L45) for all the supported comparison types.

### Id columns

If you need to filter models by one their relations and you use some kind of id obfuscation library (like [hashids](https://github.com/vinkla/hashids)) then queries with obfuscated id's won't work.
```
http//localhost/api/posts?user_id=BOaPXaoz # Won't return any results as we are trying to match the `user_id` (in the database) with the obfuscated value: BOaPXaoz
```

To fix this, you can set custom `idResolver` (in `config/filterable.php`) to "decode" your id values before they are used in queries.

`config/filterable.php`
```php
<?php

return [
    'namespace' => '\App\Models',
    'idResolver' => App\Models\IdResolver::class // The class has to have resolve() method
];

```
`app/Models/IdResolver.php`
```php
<?php

namespace App\Models;

use Hashids\Hashids;

class IdResolver
{
    public function resolve($modelName, $id, $routeKeyName)
    {
        $hashids = new Hashids();
        $decodedId = $hashids->decode($id);
        return $decodedId;
    }
}

```


### Custom filters

If the provided comparison types are not enough or you wish to have some additional logic for the filtering process
you can also create your own filters.

Example: Users have one-to-many relation with posts. We need to filter posts by their creators username.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return Post::filters(
                function ($filterer) {
                    $filterer->addFilterColumn(
                        'username',
                        function ($query, $type, $value) {
                            $query->whereHas(
                                'user',
                                function ($userQuery) use ($value) {
                                    return $userQuery->where('users.username', 'like', $value);
                                }
                            );
                        }
                    );

                    return $filterer;
                }
            );    
    }
    

```
Now we can use the `username` url param in our query.

```sh
http://localhost/api/posts?username=meikooy
```

## Searching

## Prerequisites

To use the search, you first need configure the columns which can be searched.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Meiko\Filterable\Filterable;

class Post extends Model {
    use Filterable;

    /**
     * Searchable attributes
     *
     * @var array
     */
    protected $searchable = [
        'title',
        'content',
    ];
}
```
## Usage

To search, use the `_q` url parameter.

```sh
http//localhost/api/posts?_q=searchword
```

The query tries to find matches for `searchword` in the Post's `title` and `content` columns.