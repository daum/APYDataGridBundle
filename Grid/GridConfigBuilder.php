<?php
namespace APY\DataGridBundle\Grid;

use APY\DataGridBundle\Grid\Action\RowActionInterface;
use APY\DataGridBundle\Grid\Source\Source;

/**
 * A basic grid configuration.
 *
 * @package APY\DataGridBundle\Grid
 * @author  Quentin Ferrer
 */
class GridConfigBuilder implements GridConfigBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var GridTypeInterface
     */
    protected $type;

    /**
     * @var Source
     */
    protected $source;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $routeParameters = array();

    /**
     * @var bool
     */
    protected $persistence;

    /**
     * @var int
     */
    protected $page = 0;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $maxResults;

    /**
     * @var bool
     */
    protected $filterable = true;

    /**
     * @var bool
     */
    protected $sortable = true;

    /**
     * @var string
     */
    protected $sortBy;

    /**
     * @var string
     */
    protected $order = 'asc';

    /**
     * @var string|array
     */
    protected $groupBy;

    /**
     * @var array
     */
    protected $actions;

    /**
     * @var array
     */
    protected $options;

    /**
     * Constructor.
     *
     * @param string $name    The grid name
     * @param array  $options The grid options
     */
    public function __construct($name, array $options = array())
    {
        $this->name    = $name;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource(): Source
    {
        return $this->source;
    }

    /**
     * Set Source
     *
     * @param Source $source
     *
     * @return $this
     */
    public function setSource(Source $source): static
    {
        $this->source = $source;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): GridTypeInterface
    {
        return $this->type;
    }

    /**
     * Set Type
     *
     * @param GridTypeInterface $type
     *
     * @return $this
     */
    public function setType(GridTypeInterface $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Set Route
     *
     * @param mixed $route
     *
     * @return $this
     */
    public function setRoute($route): static
    {
        $this->route = $route;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteParameters(): array
    {
        return $this->routeParameters;
    }

    /**
     * Set RouteParameters
     *
     * @param mixed $routeParameters
     *
     * @return $this
     */
    public function setRouteParameters($routeParameters): static
    {
        $this->routeParameters = $routeParameters;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPersisted(): bool
    {
        return $this->persistence;
    }

    /**
     * Set Persistence
     *
     * @param mixed $persistence
     *
     * @return $this
     */
    public function setPersistence($persistence): static
    {
        $this->persistence = $persistence;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Set Page
     *
     * @param int $page
     *
     * @return $this
     */
    public function setPage($page): static
    {
        $this->page = $page;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption($name): bool
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($name, $default = null): mixed
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxPerPage(): int
    {
        return $this->limit;
    }

    /**
     * Set Limit
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setMaxPerPage($limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get MaxResults
     *
     * @return int
     */
    public function getMaxResults(): int
    {
        return $this->maxResults;
    }

    /**
     * Set MaxResults
     *
     * @param int $maxResults
     *
     * @return $this
     */
    public function setMaxResults($maxResults): static
    {
        $this->maxResults = $maxResults;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * Set Sortable
     *
     * @param boolean $sortable
     *
     * @return $this
     */
    public function setSortable($sortable): static
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isFilterable(): bool
    {
        return $this->filterable;
    }

    /**
     * Set Filterable
     *
     * @param boolean $filterable
     *
     * @return $this
     */
    public function setFilterable($filterable): static
    {
        $this->filterable = $filterable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * Set Order
     *
     * @param string $order
     *
     * @return $this
     */
    public function setOrder($order): static
    {
        $this->order = $order;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    /**
     * Set SortBy
     *
     * @param string $sortBy
     *
     * @return $this
     */
    public function setSortBy($sortBy): static
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupBy(): string|array
    {
        return $this->groupBy;
    }

    /**
     * Set GroupBy
     *
     * @param array|string $groupBy
     *
     * @return $this
     */
    public function setGroupBy($groupBy): static
    {
        $this->groupBy = $groupBy;

        return $this;
    }

    /**
     * @param RowActionInterface $action
     *
     * @return $this
     */
    public function addAction(RowActionInterface $action): static
    {
        $this->actions[$action->getColumn()][] = $action;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGridConfig(): GridConfigInterface
    {
        $config = clone $this;

        return $config;
    }
}
