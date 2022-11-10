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

        $title = 'Quản lý ngôn ngữ';

        return view('language.list', compact('items', 'menuCategoryManager', 'title'));
    }

    public function create(Request $request)
    {
        $items = $this->LanguageRepository->getAll();
        $menuCategoryManager = true;

        $title = 'Quản lý ngôn ngữ';

        return view('language.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->LanguageRepository->store($request);

        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function edit(Request $request, $id)
    {
        $currentItem = $this->LanguageRepository->find($id);
        $menuCategoryManager = true;
        $items = $this->LanguageRepository->getAll();
        $title = 'Cập nhật chi nhánh';

        return view('language.index', compact('menuCategoryManager', 'items', 'currentItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->LanguageRepository->update($id, $request);

        if ($result) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
        return redirect()->back()->withErrors('Cập nhật thất bại.');
    }

    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $currentItem = $this->LanguageRepository->find($id);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
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
