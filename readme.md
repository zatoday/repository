# Laravel Repository
[![Build Status](https://travis-ci.org/zatoday/repository.svg?branch=master)](https://travis-ci.org/zatoday/repository)
[![License](https://poser.pugx.org/zatoday/repository/license)](https://packagist.org/packages/zatoday/repository)
[![Total Downloads](https://poser.pugx.org/zatoday/repository/downloads)](https://packagist.org/packages/zatoday/repository)
[![Monthly Downloads](https://poser.pugx.org/zatoday/repository/d/monthly)](https://packagist.org/packages/zatoday/repository)

Laravel Repositories is a package for Laravel 5.5 which is used to abstract the database layer. This makes applications much easier to maintain.

## Installation

Run the following command from you terminal:

 ```bash
 composer require zatoday/repository
 ```

## Usage

Create new file Repository
 ```bash
 php artisan make:repository [options] [--] <name>
 ```

 Example:
```bash
// Create Repository is User

php artisan make:repository User

// Or create Repository is User and create model User

php artisan make:repository -m User
```


```php
<?php


namespace App\Repositories;


use ZAToday\Repository\Repository;


class User extends Repository {

    public function model() {
        return \App\User::class;
    }
}
```

By implementing ```model()``` method you telling repository what model class you want to use. Now, create ```App\User``` model:

```php
<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class User extends Model {


}
```

And finally, use the repository in the controller:

```php
<?php


namespace App\Http\Controllers;


use App\Repositories\User;


class UserController extends Controller {

    private $user;

    public function __construct(User $user) {

        $this->user = $user;
    }

    public function index() {
        return \Response::json($this->user->all());
    }
}
```

## Available Methods

The following methods are available:

##### ZAToday\Repository\Contracts\RepositoryInterface

```php
public function all($columns = array('*'))
public function lists($value, $key = null)
public function paginate($perPage = 1, $columns = array('*'));
public function create(array $data)
// if you use mongodb then you'll need to specify primary key $attribute
public function update(array $data, $id, $attribute = "id")
public function delete($id)
public function find($id, $columns = array('*'))
public function findBy($field, $value, $columns = array('*'))
public function findAllBy($field, $value, $columns = array('*'))
public function findWhere($where, $columns = array('*'))
```

##### ZAToday\Repository\Contracts\CriteriaInterface

```php
public function apply($model, Repository $repository)
```

### Example usage


Create a new film in repository:

```php
$this->film->create(Input::all());
```

Update existing film:

```php
$this->film->update(Input::all(), $film_id);
```

Delete film:

```php
$this->film->delete($id);
```

Find film by film_id;

```php
$this->film->find($id);
```

you can also chose what columns to fetch:

```php
$this->film->find($id, ['title', 'description', 'release_date']);
```

Get a single row by a single column criteria.

```php
$this->film->findBy('title', $title);
```

Or you can get all rows by a single column criteria.
```php
$this->film->findAllBy('author_id', $author_id);
```

Get all results by multiple fields

```php
$this->film->findWhere([
    'author_id' => $author_id,
    ['year','>',$year]
]);
```

## Criteria

Criteria is a simple way to apply specific condition, or set of conditions to the repository query. Your criteria class MUST extend the abstract ```ZAToday\Repository\Criteria``` class.

Create new file Criteria:
 ```bash
 php artisan make:criteria
 ```

 Example:
```bash
// Create Criteria

php artisan make:criteria UserMaxId

// Or create Criteria with folder User

php artisan make:criteria User\MaxId
```

Here is a simple criteria:

```php
<?php

namespace App\Repositories\Criteria;

use ZAToday\Repository\Criteria;
use ZAToday\Repository\Contracts\RepositoryInterface as Repository;

class UserMaxId extends Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('id', '<', 5);
        return $model;
    }
}
```

Now, inside you controller class you call pushCriteria method:

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\Criteria\UserMaxId;
use App\Repositories\User;

class UserController extends Controller {

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {

        $this->user = $user;
    }

    public function index() {
        $this->user->pushCriteria(new UserMaxId);
        return \Response::json($this->user->all());
    }
}
```

or

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\Criteria\UserMaxId;
use App\Repositories\User;

class UserController extends Controller {

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {

        $this->user = $user;
    }

    public function index() {
        $criteria = new UserMaxId
        return \Response::json($this->user->getByCriteria($criteria)->all());
    }
}
```


## Credits

This package is largely inspired by [this](https://github.com/bosnadev/repository) great package by @Bosnadev.
