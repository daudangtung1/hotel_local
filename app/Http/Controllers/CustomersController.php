<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Repositories\BookingRoomRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class CustomersController extends Controller
{
    public $customerRepository;

    public $serviceRepository;

    public $userRepository;

    public $excel;

    public function __construct(customerRepository $customerRepository, UserRepository $userRepository, Excel $excel)
    {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->excel = $excel;
    }

    public function index(Request $request)
    {
        $customers = $this->customerRepository->getAll();
        $menuCategoryManager = true;
        $title = 'Quản lý thành viên';

        return view('customers.create', compact('customers', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $result = $this->customerRepository->store($request);

        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }
        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function edit(Request $request, $customer_id)
    {
        $request->merge(['customer_id' => $customer_id]);
        $currentItem = $this->customerRepository->find($request);

        $menuCategoryManager = true;
        $customers = $this->customerRepository->getAll();
        $title = 'Cập nhật thành viên';
        return view('customers.create', compact('menuCategoryManager', 'customers', 'currentItem', 'title'));
    }

    public function show(Request $request, $id) 
    {
        $request->merge(['customer_id' => $id]);
        $currentItem = $this->customerRepository->find($request);

        if ($request->ajax()) {
            return response()->json([
                'customer' => $currentItem
            ]);
        }
        
        return [];
    }

    public function update(Request $request)
    {
        $result = $this->customerRepository->update($request);
        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function destroy(Request $request, $customer_id)
    {
        $request->merge(['customer_id' => $customer_id]);
        $currentItem = $this->customerRepository->find($request);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }

    public function report(Request $request)
    {
        if(!empty($request->export)) {
            return $this->excel->download(new CustomerExport($request), 'customers.xlsx');
        }
        $customers = $this->customerRepository->filter($request);
        $menuCategoryManager = true;
        return view('customers.report', compact('customers', 'menuCategoryManager'));
    }

    public function SearchByCustomerName(Request $request) 
    {
       $customers = $this->customerRepository->SearchByCustomerName($request->get('name'));

       return view('customers.user-booking-form', compact('customers'))->render();
    }
}