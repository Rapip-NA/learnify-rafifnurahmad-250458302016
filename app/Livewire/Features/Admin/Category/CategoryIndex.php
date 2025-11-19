<?php

namespace App\Livewire\Features\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $deleteId;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        try {
            if ($this->deleteId) {
                $category = Category::find($this->deleteId);

                if ($category) {
                    $categoryName = $category->name;
                    $category->delete();

                    $this->deleteId = null;

                    session()->flash('success', "Category '{$categoryName}' deleted successfully.");

                    // Reset to first page if current page is empty after deletion
                    $this->resetPage();
                } else {
                    session()->flash('error', 'Category not found.');
                }
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete category: ' . $e->getMessage());
            $this->deleteId = null;
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.features.admin.category.category-index', [
            'categories' => $categories
        ]);
    }
}
