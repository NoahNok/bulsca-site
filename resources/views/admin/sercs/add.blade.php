@extends('layouts.adminlayout')

@section('title')
Add | SERC | Admin |
@endsection


@section('content')

<div class="container-responsive">
    <div class="breadcrumbs">
        <a href="{{ route('admin') }}">Admin</a>
        <span>></span>
        <a href="{{ route('admin.sercs') }}">SERCs</a>
        <span>></span>
        <p>Add</p>

    </div>

    <h1 class="header">Add SERC</h1>






    <div>
        <form action="@can('admin.sercs.manage'){{ route('admin.sercs.store') }}@endcan" enctype="multipart/form-data" method="POST" class="grid grid-cols-4 gap-4">
            @csrf

            <x-form-input id='name' title='Name'  />

         
           


            <x-form-input id='when' title='When' type="date"  />
            <x-form-input id='where' title='Where' dlist="where-dl"  />

            <datalist id="where-dl">
                @foreach (DB::table('sercs')->select('where')->distinct()->get() as $where)
                    <option value="{{ $where->where }}"></option>
                @endforeach
            </datalist>

            <x-form-input id='author' title='Author(s)' required="false" />
            <x-form-input id='no_cas' title='# Casualties' type="number" min="0"    />

            <div class=" row-start-2 col-span-3">
                <div class="form-input col-span-2 ">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows=6  class="input" ></textarea>
              
    
                </div>
            </div>

            <div class="row-start-3 col-span-1">
                <div class="form-input">
                    <label for="upload-file">Add Files</label>
                    <input id="upload-file" class="input file" name="files[]" type="file" multiple="true">
                    <small id="file-name-list"></small>
                </div>
            </div>

            <div class="row-start-4 col-span-2">
                <x-tag-input></x-tag-input>
            </div>




            







            <button type="submit" class="btn btn-thinner btn-save col-start-4 row-start-5">Add</button>

        </form>
    </div>

</div>
<script src="{{ asset('js/TagInput.js') }}"></script>
@endsection