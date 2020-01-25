@extends('layout.default')
@section('css')
    <style>
        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <h1>{{isset($person)?'Edit':'New'}} Person</h1>
            <hr/>
            @if(isset($person))
                <form action="{{url('laravel-crud/update/'.$person->id)}}"
                      method="post" style="padding-bottom: 0px;margin-bottom: 0px">
                    @else
                        <form method="post">

                            @endif
                            @csrf
                            <div class="form-group row required">
                                <div class="col-md-8">
                                    <label>Name:</label>
                                    {{--                    {{$person->name}}--}}
                                    <input type="text" name="name" value="{{isset($person)?($person->name):''}}">
                                    {!! $errors->first('name','<span class="invalid-feedback">:message</span>') !!}
                                </div>

                                <div class="col-md-8">
                                    <label>Car Name:</label>
                                    <input type="text" name="car"
                                           value="{{isset($person) && !empty($car)?($car->car_name):''}}">
                                    {!! $errors->first('car','<span class="invalid-feedback">:message</span>') !!}
                                </div>

                                <div class="col-md-8">
                                    <label>CellPhone Name:</label>
                                    <input type="text" name="cellphone"
                                           value="{{isset($person) && !empty($cell_phone)?($cell_phone->cellphone_name):''}}">
                                    {!! $errors->first('cellphone','<span class="invalid-feedback">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 col-lg-2"></div>
                                <div class="col-md-4">
                                    <a href="{{url('laravel-crud')}}" class="btn btn-danger">
                                        Back</a>
                                    <input type="submit" name="Save" class="btn btn-primary">
                                    {{--{!! Form::button("Save",["type" => "submit","class"=>"btn--}}
                                    {{--btn-primary"])!!}--}}
                                </div>
                            </div>
                        </form>
        </div>
    </div>
@endsection