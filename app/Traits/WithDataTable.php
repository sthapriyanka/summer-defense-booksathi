<?php
namespace App\Traits;

use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

trait WithDataTable
{
    use WithPagination, Interactions;

    public ?int $perPage = 10;

    private int $perPageLimit = 100;

    public ?string $tableSearch = null;

    public $pageName = "page";


    public array $sort = [
        'column' => '',
        'direction' => ''
    ];

    public function updatedPage()
    {
        $this->unsetList();
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->unsetList();
    }

    public function updatedTableSearch()
    {
        $this->unsetList();
        $this->resetPage($this->pageName);
    }

    public function updatedPerPage()
    {
        if ($this->perPage > $this->perPageLimit)
            $this->toast()->error("Can't display more than $this->perPageLimit data")->send();
        $this->unsetList();
        $this->resetPage($this->pageName);
    }

    public function unsetList()
    {
        unset($this->list);
    }
}
