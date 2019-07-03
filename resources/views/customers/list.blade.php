@extends('home')
@section('title','Danh sach khach hang')
@section('content')

    <div class="col-12">
        @if(Session::has('success'))
            <p class="text-success">
                <i class="fa fa-check" aria-hidden="true"></i>
                {{Session::get('success')}}
            </p>
        @endif
        @if(isset($totalCustomerFilter))
            <span class="text-muted">
                 {{'Tim thay'.''.$totalCustomerFilter.''.'khach hang:'}}
            </span>
        @endif
        @if(isset($cityFilter))
            <div class="pl-5">
                <span class="text-muted"><i class="fa fa-check" aria-hidden="true"></i>
                    {{'Thuoc tinh'.''.$cityFilter->name}}
                </span>
            </div>
        @endif
    </div>
    <div class="col-6">

        <form method="get" class="navbar-form navbar-left" action="{{route('customers.search')}}" >

            @csrf

            <div class="row">

                <div class="col-8">

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="Search" name="keyword">

                    </div>

                </div>

                <div class="col-4">

                    <button type="submit" class="btn btn-default">Tìm kiếm</button>

                </div>

            </div>

        </form>

    </div>
    <table class="table">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">CustomerName</th>
            <th scope="col">DOB</th>
            <th scope="col">Email</th>
            <th scope="col">Tinh</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $key => $customer)
            <tr>
                <th scope="row">{{++$key}}</th>
                <td>{{$customer->name}}</td>
                <td>{{$customer->dob}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->city['name']}}</td>
                <td><a href="{{ route('customers.edit', $customer->id) }}">Edit</a></td>
                <td><a href="{{ route('customers.destroy', $customer->id) }}"
                       onclick="return confirm('Ban chac chan muon xoa')">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    {{$customers->render()}}--}}
{{--    {{ $customers->appends(['page'=>Request::get('page')])->render()}}--}}
    {{ $customers->links() }}
    <a class="btn btn-primary" href="{{ route('customers.create') }}">Thêm mới</a>
    <a class="btn btn-outline-primary" href="" data-toggle="modal" data-target="#cityModal">
        Lọc
    </a>
    <div class="modal fade" id="cityModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <form action="{{ route('customers.filterByCity') }}" method="get">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!--Lọc theo khóa học -->
                        <div class="select-by-program">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label border-right">Lọc khách hàng theo tỉnh
                                    thành</label>
                                <div class="col-sm-7">
                                    <select class="custom-select w-100" name="city_id">
                                        <option value="">Chọn tỉnh thành</option>
                                        @foreach($cities as $city)
                                            @if(isset($cityFilter))
                                                @if($city->id == $cityFilter->id)
                                                    <option value="{{$city->id}}" selected>{{ $city->name }}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                                @endif
                                            @else
                                                <option value="{{$city->id}}">{{ $city->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <!--End-->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitAjax" class="btn btn-primary">Chọn</button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
