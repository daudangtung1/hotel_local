<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LanguageRepository;

class LanguageController extends Controller
{
    
    
    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->LanguageRepository = $LanguageRepository;
    }

    public function index(Request $request)
    {
        $items = $this->LanguageRepository->getAll(false);
        $menuCategoryManager = true;

        $title = __('Language_management_f');

        return view('language.list', compact('items', 'menuCategoryManager', 'title'));
    }

    public function create(Request $request)
    {
        $items = $this->LanguageRepository->getAll();
        $menuCategoryManager = true;

        $title = __('Language_management_f');

        return view('language.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->LanguageRepository->store($request);

        return redirect()->back()->with('success', __('Msg_create_success'));
    }

    public function edit(Request $request, $id)
    {
        $currentItem = $this->LanguageRepository->find($id);
        $menuCategoryManager = true;
        $items = $this->LanguageRepository->getAll();
        $title = __('Update_branch');

        return view('language.index', compact('menuCategoryManager', 'items', 'currentItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->LanguageRepository->update($id, $request);

        if ($result) {
            return redirect()->back()->with('success', __('Msg_update_success'));
        }
        return redirect()->back()->withErrors(__('Msg_update_fail'));
    }

    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $currentItem = $this->LanguageRepository->find($id);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }
    
    public function changeLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required',
        ]);
        \Session::put('language', $request->language);
        return redirect()->back();
    }
}
