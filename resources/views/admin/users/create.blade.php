@extends('layouts.adminlayout')

@section('title')
Create | Users | Admin |
@endsection


@section('content')

<div class="container-responsive">
    <div class="breadcrumbs">
        <a href="{{ route('admin') }}">Admin</a>
        <span>></span>
        <a href="{{ route('admin.users') }}">Users</a>
        <span>></span>
        <p>Users</p>


    </div>

    <h1 class="header">Create User</h1>

    <form action="{{ route('admin.users.create.post') }}" method="POST" class="flex flex-col">
        @csrf
        <div class="grid grid-cols-3 gap-4">
            <x-form-input id="user_name" title="Name"></x-form-input>
            <x-form-input id="user_email" title="Email" extraCss="col-span-2"></x-form-input>

        </div>

        <br>
        <hr>
        <br>

        <x-form-select id="user_university" title="University" :options=" $unis "></x-form-select>
        <x-form-input id="user_university_admin" required="false" title="Uni Admin?" type="checkbox"></x-form-input>

        <h4>Roles</h4>
        <div class="grid grid-cols-3 gap-4 ">

            @foreach ($roles as $role)
            <div class="flex items-center">
                <label for="role-{{$role->id}}" class="mr-4">{{Str::headline(Str::replace('_', ' ', $role->name))}}</label>
                <input type="checkbox" name="role-{{$role->id}}" id="role-{{$role->id}}">
            </div>

            @endforeach
        </div>

        <br>
        <button class="btn btn-thinner ml-auto">Create</button>
    </form>







</div>



@endsection