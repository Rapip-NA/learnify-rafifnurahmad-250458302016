<?php

namespace App\Livewire\Features\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public Category $category;
    public $name;
    public $description;
    public $showDeleteModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    protected $messages = [
        'name.required' => 'Category name is required.',
        'name.max' => 'Category name cannot exceed 255 characters.',
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function update()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('category-updated');
    }

    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        try {
            $categoryName = $this->category->name;
            $categoryId = $this->category->id;

            // Delete the category
            Category::destroy($categoryId);

            session()->flash('success', "Category '{$categoryName}' deleted successfully.");

            return $this->redirect(route('categories.index'), navigate: true);
        } catch (\Exception $e) {
            $this->showDeleteModal = false;
            session()->flash('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.features.admin.category.category-edit');
    }
}
