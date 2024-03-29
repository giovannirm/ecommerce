<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CreateOrder extends Component
{
    public $shipping_type = 1;
    
    public $contact, $phone, $address, $reference, $shipping_cost = 0;

    public $departments, $cities = [], $districts = [];

    public $department_id = "", $city_id = "", $district_id = "";

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'shipping_type' => 'required'
    ];

    public $attributes = [
        'contact' => 'Nombre de Contacto',
        'phone' => 'Teléfono de Contacto',
        'department_id' => 'Departamento',
        'city_id' => 'Ciudad',
        'district_id' => 'Distrito',
        'address' => 'Dirección',
        'reference' => 'Referencia',

    ];

    public function updatedShippingType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'department_id', 'city_id', 'district_id', 'address', 'reference'
            ]);
        }
    }

    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();

        $this->reset('city_id', 'district_id', 'shipping_cost', 'districts');
    }

    public function updatedCityId($value)
    {
        $city = City::find($value);
        $this->shipping_cost = $city->cost;

        $this->districts = District::where('city_id', $value)->get();

        $this->reset('district_id');
    }

    public function mount()
    {
        $this->departments = Department::all();        
    }

    public function create_order()
    {
        $rules = $this->rules;
        $attributes = $this->attributes;

        if ($this->shipping_type == 2) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules, null, $attributes);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->shipping_type = $this->shipping_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + str_replace(',', '', Cart::subtotal());
        $order->content = Cart::content();

        if ($this->shipping_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->reference = $this->reference;
        }

        $order->save();

        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
