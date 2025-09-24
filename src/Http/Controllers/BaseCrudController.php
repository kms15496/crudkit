<?php

namespace Kaung\CrudKit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BaseCrudController extends BaseController
{
    protected $model;
    protected $fields;
    protected $view_base;
    protected $selectFields = [];
    protected $form_name;
    protected $dataTable;
    protected $collectionName;
    protected $hideFields = [];
    protected $multiple = [];
    protected $checkBoxFields = [];
    protected $radioFields = [];

    public function __construct(
        $model,
        $view_base,
        $fields = [],
        $form_name,
        $collectionName = null,
        $hideFields = [],
        $multiple = [],
        $checkBoxFields = [],
        $radioFields = [],
         $selectFields = []
    ) {
        $this->model         = $model;
        $this->view_base     = $view_base;
        $this->fields        = $fields;
        $this->form_name     = $form_name;
        $this->collectionName = $collectionName;
        $this->hideFields    = $hideFields;
        $this->multiple      = $multiple;
        $this->checkBoxFields = $checkBoxFields;
        $this->radioFields   = $radioFields;
         $this->selectFields = $selectFields;
    }

    public function index()
    {
        $data = $this->model::all();
        return view("{$this->view_base}.index", compact('data'));
    }

    public function createOrEdit($id = null)
    {
        $item  = $id ? $this->model::findOrFail($id) : null;
        $route = $id ? route("{$this->view_base}.update", $id)
                     : route("{$this->view_base}.store");

        return view('crudkit::base.crud', [
            'item'          => $item,
            'fields'        => $this->fields,
            'selectFields'  => $this->selectFields,
            'view_base'     => $this->view_base,
            'form_name'     => $this->form_name,
            'route'         => $route,
            'collection'    => $this->collectionName,
            'hideFields'    => $this->hideFields,
            'multiple'      => $this->multiple,
            'checkBoxFields'=> $this->checkBoxFields,
            'radioFields'   => $this->radioFields
        ]);
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate($this->fields);

        if ($id) {
            $item = $this->model::findOrFail($id);
            $item->update($validatedData);
        } else {
            $item = $this->model::create($validatedData);
        }

        // Handle file uploads
        foreach ($this->fields as $field => $rules) {
            if ($request->hasFile($field)) {
                if ($id) {
                    $item->clearMediaCollection($this->collectionName);
                }
                $item->addMedia($request->file($field))
                     ->toMediaCollection($this->collectionName);
            }
        }

        return redirect()
            ->route("{$this->view_base}.index")
            ->with('success', $id ? 'Data updated successfully!' : 'Data created successfully!');
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();

        return redirect()
            ->route("{$this->view_base}.index")
            ->with('success', 'Data deleted successfully!');
    }
}
