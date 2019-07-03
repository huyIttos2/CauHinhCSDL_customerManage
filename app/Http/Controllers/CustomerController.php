<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(2);
        $cities = City::all();
        return view('customers.list', compact('customers', 'cities'));
    }

    public function create()
    {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    public function filterByCity(CustomerRequest $request)
    {
        $idCity = $request->input('city_id');
        $cityFilter = City::findOrFail($idCity);
        $customers = Customer::where('city_id', $cityFilter->id)->paginate(2)->appends('city_id',$request->city_id);
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    public function store(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dbo');
        $customer->city_id = $request->input('city_id');
        $customer->save();
        Session::flash('success', 'Tao moi khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities = City::all();
        return view('customers.edit', compact('customer','cities'));
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dbo');
        $customer->city_id = $request->input('city_id');
        $customer->save();
        Session::flash('success', 'Cap nhat khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        Session::flash('success', 'Xoa khach hang thanh cong');
        return redirect()->route('customers.index');
    }
    public function search(CustomerRequest $request){
        $keyword = $request->input('keyword');
        if(!$keyword){
            return redirect()->route('customers.index');
        }
        $customers = Customer::Where('name', 'LIKE', '%'. $keyword. '%')->paginate(2);
        $cities = City::all();
        return view('customers.list',compact('customers','cities'));
    }

}
