@extends('layout.default')
@section('css')
    <style>
        a, a:hover {
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="float-right">
            <a href="{{url('laravel-crud/create')}}" class="btn btn-primary new-person">New Person</a>
        </div>
        <form method="get" action="{{route('crud')}}" class="serch" name="search">
            <div class="col-sm-5 form-group">
                <div class="input-group">
                    <input class="form-control" id="search"
                           value="{{ request('search') }}"
                           placeholder="Search name" name="search"
                           type="text" id="search"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-warning"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </form>
        {{--<input type="text" class="form-controller" id="search" name="search"></input>--}}

        <table class="table table-bordered bg-light">
            <thead class="bg-dark" style="color: white">
            <tr>
                <th width="60px" style="vertical-align: middle;text-align: center">No</th>
                <th style="vertical-align: middle">
                    <a href="{{url('laravel-crud')}}?search={{request('search')}}&gender={{request('gender')}}&field=name&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                        Name
                    </a>
                </th>
                <th style="vertical-align: middle">
                    <a href="{{url('laravel-crud')}}?search={{request('search')}}&gender={{request('gender')}}&field=gender&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                        Car
                    </a>
                </th>
                <th style="vertical-align: middle">
                    <a href="{{url('laravel-crud')}}?search={{request('search')}}&gender={{request('gender')}}&field=email&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                        Cell Phone
                    </a>
                </th>
                <th width="130px" style="vertical-align: middle">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            ?>
            @foreach($persons as $person)
                <tr>
                    <td style="vertical-align: middle">{{ $i++ }}</td>
                    <td style="vertical-align: middle">{{ $person->name }}</td>
                    <td>
                        @if(!empty($person->cars))
                            @foreach($person->cars as $car)
                                {{$car->car_name}}
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(!empty($person->cellphones))
                            @foreach($person->cellphones as $cellphone)
                                {{$cellphone->cellphone_name}}
                            @endforeach
                        @endif
                    </td>
                    <td style="vertical-align: middle" align="center">
                        <form id="frm_{{$person->id}}"
                              action="{{url('laravel-crud/delete/'.$person->id)}}"
                              method="post" style="padding-bottom: 0px;margin-bottom: 0px">
                            <a class="btn btn-primary btn-sm" title="Edit"
                               href="{{url('laravel-crud/edit/'.$person->id)}}">
                                Edit</a>
                            <input type="hidden" name="_method" value="delete"/>
                            {{csrf_field()}}
                            <a class="btn btn-danger btn-sm" title="Delete"
                               href="javascript:if(confirm('Are you sure want to delete?')) $('#frm_{{$person->id}}').submit()">
                                Delete
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-end">
                {{--                {{$persons->links()}}--}}
            </ul>
        </nav>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/crud/index.js') }}"></script>
@endsection