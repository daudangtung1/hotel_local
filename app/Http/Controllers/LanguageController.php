<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Repositories\LanguageRepository;
use File;

class LanguageController extends Controller
{
    
    
    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->LanguageRepository = $LanguageRepository;
    }

    public function create(Request $request)
    {
        if (!empty($request->export)) {
            $items = $this->LanguageRepository->getAll($request, false);

            $dataVi = [];
            $dataEn = [];
            foreach($items as $key => $item) {
                    $dataVi[$item->key] = $item->vi;
                    $dataEn[$item->key] = $item->en;
                }
           
            File::put(resource_path('lang/vi.json'), json_encode($dataVi));
            File::put(resource_path('lang/en.json'), json_encode($dataEn));
        }
        $items = $this->LanguageRepository->getAll($request);
        

        $menuCategoryManager = true;

        $title = __('Language_management_f');

        return view('language.index', compact('items', 'menuCategoryManager', 'title'));
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
    
    public function changeLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required',
        ]);
        \Session::put('language', $request->language);
        return redirect()->back();
    }
}
