<?php

namespace Meiko\Filterable;

use Illuminate\Http\Request;
use Meiko\Filterable\Groups\AndGroup;
use Meiko\Filterable\Groups\OrGroup;
use Exception;

/**
 * Main filterer class
 */
class Filterer
{
    /**
     * Search query
     *
     * @var string
     */
    protected $searchQuery;

    /**
     * Sortables
     *
     * @var array
     */
    protected $sortables = [];

    /**
     * Sortable columns
     *
     * @var array
     */
    protected $sortableColumns = [];

    /**
     * Searchable columns
     *
     * @var array
     */
    protected $searchableColumns = [];

    /**
     * Filter groups
     *
     * @var array
     */
    protected $groups = [];

    /**
     * ID columns
     *
     * @var array
     */
    protected $idColumns = [];

    /**
     * Filter column callbacks
     *
     * @var array
     */
    protected $filterColumnCallbacks = [];

    /**
     * Required filter columns
     *
     * @var array
     */
    protected $requiredColumns = [];

    /**
     * Key for searching
     *
     * @var string
     */
    protected $queryKey = '_q';

    /**
     * Key for sortables
     *
     * @var string
     */
    protected $sortKey = 'sort';

    /**
     * Ignore keys prefixed with _
     *
     * @var string
     */
    protected $ignorePrefix = '_';

    /**
     * Ignore "include" and "page" keys
     *
     * @var array
     */
    protected $ignoreKeys = [
        'include',
        'page',
    ];

    /**
     * Base classname
     *
     * @var string
     */
    protected $baseClassname;

    /**
     * Parse sortable strings
     *
     * @param string $string
     * @return array
     */
    protected function parseSortable(string $string)
    {
        $direction = -1;
        if (substr($string, 0, 1) == '+' || preg_match('/[a-zA-Z]/', substr($string, 0, 1))) {
            $direction = 1;
        }
        $string = ltrim($string, '+-');

        return [$string, $direction];
    }

    /**
     * Get search query
     *
     * @return string
     */
    public function getSearchQuery()
    {
        return $this->searchQuery;
    }

    /**
     * Get sortables
     *
     * @return array
     */
    public function getSortables()
    {
        return $this->sortables;
    }

    /**
     * Get filter groups
     *
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set searchable columns
     *
     * @param array $columns
     * @return void
     */
    public function setSearchableColumns(array $columns)
    {
        $this->searchableColumns = $columns;
    }

    /**
     * Set sortable columns
     *
     * @param array $columns
     * @return void
     */
    public function setSortableColumns(array $columns)
    {
        $this->sortableColumns = $columns;
    }

    /**
     * Add sortable column
     *
     * @param string $column
     * @param integer $direction
     * @return void
     */
    public function addSortable(string $column, int $direction)
    {
        if ($this->sortableColumns && !in_array($column, $this->sortableColumns)) {
            throw new Exception('Column "'.$column.'" is not a sortable column');
        }

        $this->sortables[] = new Sort($column, $direction);
    }

    /**
     *  Add filter column with a callback
     *
     * @param string $column
     * @param callable $callback
     * @return void
     */
    public function addFilterColumn(string $column, callable $callback)
    {
        $this->filterColumnCallbacks[$column] = $callback;
    }

    /**
     * Add ID column
     *
     * @param string|array $column
     * @return void
     */
    public function addIdColumn($column)
    {
        $columns = (is_array($column)) ? $column : [$column];

        foreach ($columns as $column) {
            if (substr($column, -3) !== '_id') {
                continue;
            }

            $this->idColumns[substr($column, 0, -3)] = $column;
        }
    }

    /**
     * Parse HTTP request
     *
     * @param \Illuminate\Http\Request|null $request
     * @return void
     */
    public function parseRequest(Request $request = null)
    {
        $request = $request ?? app(Request::class);

        $group = new AndGroup;
        $columns = [];

        foreach ($request->all() as $key => $value) {
            if (in_array($key, $this->ignoreKeys)) {
                continue;
            }

            if ($key == $this->queryKey) {
                $this->searchQuery = $value;
            } elseif ($key == $this->sortKey) {
                foreach (explode(',', $value) as $part) {
                    list($piece, $direction) = $this->parseSortable($part);
                    $this->addSortable($piece, $direction);
                }
            } elseif (substr($key, 0, 1) != $this->ignorePrefix) {
                if (isset($this->idColumns[$key])) {
                    $key = $this->idColumns[$key];
                }

                $columns[] = $key;

                $callback = $this->filterColumnCallbacks[$key] ?? null;
                $field = new Field($key, $value, $callback);
                $field->setBaseClassname($this->baseClassname);

                $group->addField($field);
            }
        }

        $this->groups[] = $group;

        if ($this->searchableColumns && $this->getSearchQuery()) {
            $this->groups[] = $this->getSearchGroup();
        }

        $this->checkForRequiredColumns($columns);
    }

    /**
     * Get search filter group
     *
     * @return \Meiko\Filterable\Groups\OrGroup
     */
    protected function getSearchGroup()
    {
        $group = new OrGroup;
        $value = 'lk=' . $this->getSearchQuery();

        foreach ($this->searchableColumns as $key) {
            $group->addField(new Field($key, $value));
        }

        return $group;
    }

    /**
     * Check for required columns in filter
     *
     * @param array $columns
     * @return void
     */
    protected function checkForRequiredColumns(array $columns)
    {
        $intersect = array_intersect($this->requiredColumns, $columns);

        if (!empty($this->requiredColumns) && empty($intersect)) {
            throw new Exception('Required filters not present');
        }
    }

    /**
     * Require specific column in filter
     *
     * @param string $column
     * @return void
     */
    public function requireColumn(string $column)
    {
        $this->requiredColumns[] = $column;
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
