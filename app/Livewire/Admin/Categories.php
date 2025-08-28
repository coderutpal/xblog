<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\ParentCategory;
use GuzzleHttp\Psr7\Message;

use function PHPSTORM_META\type;

class Categories extends Component
{
    public $isUpdateParentCategoryMode = false;
    public $pcategory_id, $pcategory_name;

    protected $listeners = [
        'updateCategoryOrdering',
        'confirmDeleteParentCategory'
    ];

    public function addParentCategory()
    {
        $this->pcategory_id = null;
        $this->pcategory_name = null;
        $this->isUpdateParentCategoryMode = false;
        $this->showParentCategoryModalForm();
    }

    public function createParentCategory()
    {
        $this->validate([
            'pcategory_name' => 'required|unique:parent_categories,name'
        ], [
            'pcategory_name.required' => 'Parent category field is required',
            'pcategory_name.unique' => 'Parent category name is already taken'
        ]);

        /** Store new parent category */
        $pcategory = new ParentCategory();
        $pcategory->name = $this->pcategory_name;
        $saved = $pcategory->save();

        if ($saved) {
            $this->hideParentCategoryModalForm();
            $this->dispatch('showToastr', type: 'success', message: 'Category has been added successfully');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong');
        }
    }

    /** Edit parent category */
    public function editParentCategory($id)
    {
        $pcategory = ParentCategory::findOrFail($id);
        $this->pcategory_id = $pcategory->id;
        $this->pcategory_name = $pcategory->name;
        $this->isUpdateParentCategoryMode = true;
        $this->showParentCategoryModalForm();
    }

    /** Update parent categoy */
    public function updateParentCategory()
    {
        $pcategory = ParentCategory::findOrFail($this->pcategory_id);
        $this->validate([
            'pcategory_name' => 'required|unique:parent_categories,name,' . $pcategory->name
        ], [
            'pcategory_name.required' => 'Parent category field is required',
            'pcategory_name.unique' => 'Parent category name is already taken'
        ]);

        $pcategory->name = $this->pcategory_name;
        $pcategory->slug = null;
        $updated = $pcategory->save();

        if ($updated) {
            $this->hideParentCategoryModalForm();
            $this->dispatch('showToastr', type: 'success',  message: 'Parent category updated successfully');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Somthing went wrong!');
        }
    }

    /** Update parent categoy order/sorting*/
    public function updateCategoryOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $new_position = $position[1];
            ParentCategory::where('id', $index)->update([
                'ordering' => $new_position
            ]);
        }
        $this->dispatch('showToastr', type: 'success', message: 'Parent category Order updated!');
    }

    /** Delete parent category */
    public function deleteParentCategory($id)
    {
        $this->dispatch('deleteParentCategory', ['id' => $id]);
    }

    public function confirmDeleteParentCategory($id)
    {
        $pcategory = ParentCategory::findOrFail($id);

        $delete = $pcategory->delete();

        if ($delete) {
            $this->dispatch('showToastr', type: 'success', message: 'Parent category item has been deleted!');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong!');
        }
    }

    public function showParentCategoryModalForm()
    {
        $this->resetErrorBag();
        $this->dispatch('showParentCategoryModalForm');
    }

    public function hideParentCategoryModalForm()
    {
        $this->dispatch('hideParentCategoryModalForm');
        $this->isUpdateParentCategoryMode = false;
        $this->pcategory_id = $this->pcategory_name = null;
    }

    public function render()
    {
        return view('livewire.admin.categories', [
            'pcategories' => ParentCategory::orderBy('ordering', 'asc')->get()
        ]);
    }
}
