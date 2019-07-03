@extends('home')
@section('Title','Add new customer')

@section('content')
    <form method="post" action="{{ route('customers.store') }}">
        @csrf
        <div class="error-message">
            @if(count($errors) > 0)
                @foreach($errors -> all() as $error)
                    <p style="color: red">{{$error}}</p>
                @endforeach
                @endif
        </div>
      <div class="form-group">
        <label>NameCustomer</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your name">
      </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Date of birth</label>
            <input type="date" class="form-control" name="dbo" placeholder="Enter your birthday">
        </div>
        <div class="form-group">
            <label>Tỉnh thành</label>
            <select class="form-control" name="city_id">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
