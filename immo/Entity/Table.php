<?php
namespace App\Entity;

use App\Entity\URLHelper;

class Table
{

    protected $query;
    protected $get;
    protected $sortable = [];
    protected $columns = [];
    protected $formatters = [];
    protected $limit = 20;
    const SORT_KEY = 'sort';
    const DIR_KEY = 'dir';

    public function __construct(QueryBuilder $query, array $get)
    {
        $this->query = $query;
        $this->get = $get;
    }

    public function sortable(string ...$sortable): self
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function columns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function format(string $key, callable $function): self
    {
        $this->formatters[$key] = $function;
        return $this;
    }

    private function td(string $key, array $item)
    {
        if(isset($this->formatters[$key])) {
            return $this->formatters[$key]($item[$key]);
        }
        return $item[$key];
    }

    private function th(string $key)
    {
        if(!in_array($key, $this->sortable)) {
            return $this->columns[$key];
        }
        $sort = $this->get[self::SORT_KEY] ?? null;
        $direction = $this->get[self::DIR_KEY] ?? null;
        $icon = '';
        if($sort === $key) {
            $icon = $direction === 'asc' ? '^' :'v';
        }
        $url = URLHelper::withParams($this->get, [
            self::SORT_KEY => $key,
            self::DIR_KEY => $direction === 'asc' && $sort === $key ? 'desc' : 'asc'
        ]);
        return <<<HTML
    <a href="?$url">{$this->columns[$key]} $icon</a>
HTML;
    }

    public function render()
    {
        $page = $this->get['p'] ?? 1;
        $count = (clone $this->query)->count();
        if(!empty($this->get['sort']) && in_array($this->get['sort'], $this->sortable)) {
            $dir = ($this->get['dir'] == 'desc') ? 'asc' : 'desc';
            $this->query->orderBy($this->get['sort'], $this->get['dir'] ?? 'asc');
        }
        $items = $this->query
            ->select(array_keys($this->columns))
            ->limit($this->limit)
            ->page($page)
            ->fetchAll();
        $pages = ceil($count / $this->limit);
        ?>
        <table class="table">
            <thead>
            <tr>
                <?php foreach($this->columns as $key => $column): ?>
                    <th><?= $this->th($key) ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($items as $item): ?>
                <tr>
                    <?php foreach($this->columns as $key => $column): ?>
                <td><?= $this->td($key, $item) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php if($pages > 1 && $page > 1): ?>
            <a href="?<?= URLHelper::withParam($this->get, "p", $page - 1) ?>" class="btn btn-primary">Page précedente</a>
        <?php endif ?>
        <?php if($pages > 1 && $page < $pages): ?>
            <a href="?<?= URLHelper::withParam($this->get, "p", $page + 1) ?>" class="btn btn-primary">Page suivante</a>
        <?php endif ?>
        <?php
    }
}