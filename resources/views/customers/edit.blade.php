@extends('home')
@section('Title','Edit customer')
@section('content')
    @endsection
<form method="post" action="{{ route('customers.update', $customer->id) }}">
    @csrf
  <div class="form-group">
    <label>Name Customer</label>
    <input type="text" class="form-control" name="name" value="{{ $customer->name }}" required>
  </div>
    <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
  </div>
    <div class="form-group">
    <label>Date of Birth</label>
    <input type="date" class="form-control" name="dbo" value="{{ $customer->dbo }}" required>
  </div>
    <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" placeholder="Enter email">
  </div>
    <div class="form-group">
        <label>Tỉnh thành</label>
        <select class="form-control" name="city_id">
            @foreach($cities as $city)
                <option
                    @if($customer->city_id == $city->id)
                    {{"selected"}}
                    @endif
                    value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Edit</button>
    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
</form>
