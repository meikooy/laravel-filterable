<?php

namespace Meiko\Filterable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;

/**
 * Filter field
 */
class Field
{
    /**
     * Filter key
     *
     * @var string
     */
    protected $key;

    /**
     * Filter value
     *
     * @var string
     */
    protected $value;

    /**
     * Possible query callback
     *
     * @var callable
     */
    protected $callback;

    /**
     * Base classname
     *
     * @var string
     */
    protected $baseClassname;

    /**
     * Available comparison types and their query counterparts
     *
     * @var array
     */
    protected $types = [
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'ge' => '>=',
        'lt' => '<',
        'le' => '<=',
        'lk' => 'like',
        'not-lk' => 'not like',
        'in' => null,
        'not-in' => null,
        'bw' => null,
        'not-bw' => null,
        'ex' => null,
        'not-ex' => null,
    ];

    /**
     * Query wildcard character
     *
     * @var string
     */
    protected $wildcard = '*';

    /**
     * Create a new field instance
     *
     * @param string $key
     * @param string $value
     * @param callable|null $callback
     */
    public function __construct(string $key, string $value, callable $callback = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->callback = $callback;

        // change like and not like for postgres
        $connection = Config::get('database.default');
        if (Config::get('database.connections.' . $connection . '.driver') == 'pgsql') {
            $this->types['lk'] = 'ilike';
            $this->types['not-lk'] = 'not ilike';
        }
    }

    /**
     * Get field key
     *
     * @return void
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * Get field comparison type based on field value
     *
     * @return string
     */
    protected function getType()
    {
        foreach (array_keys($this->types) as $type) {
            if (strpos($this->value, $type.'=') === 0) {
                return $type;
            }
        }
        return (strpos($this->value, $this->wildcard) !== false) ? 'lk' : 'eq';
    }

    /**
     * Is filter key an id key
     *
     * @return boolean
     */
    protected function isIdKey()
    {
        return (substr($this->getKey(), -3) == '_id' || $this->getKey() == 'id');
    }

    /**
     * Resolve model id from key
     *
     * @param string $id
     * @return integer
     */
    protected function getModelId($id)
    {
        if ($this->getKey() == 'id') {
            $className = $this->baseClassname;
        } else {
            $namespace = config('filterable.namespace', '\App');
            $modelName = studly_case(substr($this->getKey(), 0, -3));
            $className = $namespace . '\\' . $modelName;
        }

        $idResolver = config('filterable.idResolver');
        $instance = new $className;
        $primaryKeyName = $instance->getKeyName();

        if ($idResolver && class_exists($idResolver)) {
            $resolver = new $idResolver;
            $id = $resolver->resolve($modelName, $id, $instance->getRouteKeyName());
        }

        $model = $instance->where($instance->getRouteKeyName(), $id)->first();
        return ($model) ? $model->$primaryKeyName : null;
    }

    /**
     * Get field value
     *
     * @return string|null|array
     */
    protected function getValue()
    {
        $value = preg_replace('/^('.implode('|', array_keys($this->types)).')=/i', '', $this->value);
        $arrayTypes = ['bw', 'not-bw', 'in', 'not-in'];
        $likeTypes = ['lk', 'not-lk'];
        $matchTypes = ['eq', 'ne'];
        $arraySeparator = '|';

        if ($value == 'null') {
            return null;
        } elseif (in_array($this->getType(), $arrayTypes) || strpos($value, $arraySeparator) !== false) {
            $arr = [];
            foreach (explode($arraySeparator, $value) as $v) {
                if ($this->isIdKey()) {
                    $id = $this->getModelId($v);
                    if ($id === null) {
                        continue;
                    }
                    $arr[] = $id;
                } else {
                    $arr[] = $v;
                }
            }
            return $arr;
        } elseif (in_array($this->getType(), $likeTypes)) {
            $queryWildcard = '%';

            if (strpos($value, $this->wildcard) !== false) {
                return str_replace($this->wildcard, $queryWildcard, $value);
            } else {
                return $queryWildcard . $value . $queryWildcard;
            }
        } elseif (in_array($this->getType(), $matchTypes) && $this->isIdKey()) {
            $value = $this->getModelId($value);
        }

        return $value;
    }

    /**
     * Apply filter to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        $key = $this->getKey();
        $type = $this->getType();
        $value = $this->getValue();

        if ($this->callback) {
            $query = ($this->callback)($query, $type, $value);
        } elseif ($type == 'in') {
            $query->whereIn($key, $value);
        } elseif ($type == 'not-in') {
            $query->whereNotIn($key, $value);
        } elseif ($type == 'bw') {
            $query->whereBetween($key, $value);
        } elseif ($type == 'not-bw') {
            $query->whereNotBetween($key, $value);
        } elseif (is_null($value) && in_array($type, ['eq', 'ne'])) {
            if ($type == 'eq') {
                $query->whereNull($key);
            } elseif ($type == 'ne') {
                $query->whereNotNull($key);
            }
        } else {
            $query->where($key, ((isset($this->types[$type])) ? $this->types[$type] : '='), $value);
        }

        return $query;
    }

    /**
     * Set base classname to use against id-filters
     *
     * @param string $classname
     * @return void
     */
    public function setBaseClassname(string $classname)
    {
        $this->baseClassname = $classname;
    }
}
