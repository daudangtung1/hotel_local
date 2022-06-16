<?php

namespace App\Http\Controllers;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use Illuminate\Support\Carbon;

class BookingRoomController extends Controller
{
    public function __construct()
    {
        $this->BookingRoom = new BookingRoom();
        $this->customers = new Customers();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // $customer = Customers::firstOrCreate(
        //     ['name' => request('name')],
        //     ['id_card' => request('idCard')]
        // );
        // $customer->phone = request('phone');
        // $customer->address = request('address');
        // $this->customers->add($customer);

        $customer = [
            'name' => request('name'),
            'id_card' => request('idCard'),
            'phone' => request('phone'),
            'address' => request('address'),
        ];
        DB::table('customers')->insert($customer);
        $id_card = Customers::firstOrCreate(
                ['id_card' => request('idCard')]
            );
        $customerId = DB::table('customers')
                    ->select('id')
                    ->where('id_card','=','1')
                    ->get();
        var_dump( $customerId );die();
         $data = [
            'room_id' => '1', //request('roomId') 
            'customer_id' =>  $customerId[0]->id,
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'created_at' => new Carbon(),
         ];
         $this->BookingRoom->bookingRoom($data);
        return "done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
