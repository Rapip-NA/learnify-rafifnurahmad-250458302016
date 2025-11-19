<?php

namespace App\Livewire\Features\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryView extends Component
{
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.features.admin.category.category-view');
    }
}
