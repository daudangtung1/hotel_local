<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OptionRepository;

class OptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Request $request,
        OptionRepository $optionRepository
    ) {
        $this->request = $request;
        $this->optionRepository = $optionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menuSetup = true;
        $option = $this->optionRepository->find();

        if ($request->ajax()) {
            return view('option.modal-option', compact('option'))->render();
        }

        return view('option.index', compact('menuSetup', 'option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        $this->optionRepository->update($request);

        return redirect()->route('options.index')->with('success', __('Msg_update_success'));
    }
}
