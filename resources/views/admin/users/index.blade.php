@extends('layouts.adminlayout')

@section('title')
Users | Admin |
@endsection


@section('content')

<div class="container">
    <div class="breadcrumbs">
        <a href="{{ route('admin') }}">Admin</a>
        <span>></span>
        <p>Users</p>


    </div>

    <h1 class="header">Users</h1>

    <div class="grid grid-cols-2 gap-4">
        @foreach ($users as $user)
        <a href="#" class="px-6 py-4 rounded-md border hover:border-bulsca transition no-underline">
            <div class="flex items-center justify-center">
                <h1 class="header header-bold">
                    {{ $user->name }}
                </h1>
                <small class="ml-auto  text-black font-normal "></small>

            </div>
            <hr class="-mx-6 mb-4">
            <div>
                <x-badge>University: @if ($user->getHomeUni()){{ $user->getHomeUni()->name }} @else None @endif</x-badge>

            </div>

        </a>

        @endforeach
    </div>

    {{ $users->links() }}

    <br>

    <div class="flex">
        <a href="{{ route('admin.users.create') }}" class="ml-auto"><button class="btn btn-thinner">Add User</button></a>
    </div>



</div>



@endsection