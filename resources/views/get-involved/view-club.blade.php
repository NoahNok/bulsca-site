@extends('layout')

@section('title')
{{ $club->name }} | Clubs |
@endsection

@section('meta')

{{ Str::of(html_entity_decode(str_replace('  ', ' ', strip_tags(str_replace('<', ' <', $club->getPage()->first()->content)))))->squish()->limit(170) }}

@endsection

@section('extra-meta')

<meta property="og:type" content="article" />
<meta property="og:image" content="{{ $club->image_path ? route('image', $club->image_path) : '/storage/logo/blogo.png' }}">
@endsection


@section('content')



<div class="h-[40vh] w-screen bg-gray-100  overflow-hidden  ">

  <div class="h-full w-full overflow-hidden relative">
    <div class="absolute top-0 right-0 w-full h-full  flex items-center justify-center " style=" background-color: {{ $club->getPage()->first()->banner_color }}">
      <img src="{{ $club->image_path ? route('image', $club->image_path) : 'https://bulsca.co.uk/storage/logo/blogo.png' }}" class="w-[10%] hidden md:block " alt="">
      <div class="md:border-l-2 border-white md:ml-12 md:pl-12 py-8">
        <h2 class="md:text-6xl text-4xl font-bold text-white" style="color: {{ $club->getPage()->first()->banner_text_color }}">{{ $club->name }}</h2>


      </div>
    </div>

  </div>


</div>

<div class="container-responsive flex flex-col space-y-4">

  


  <link rel="stylesheet" href="{{ asset('css/ck_styles.css') }}">



  <div class="flex flex-row items-center">
    <a href="{{ route('clubs') }}" class=" underline ">Back</a>
    @if ($club->currentUserIsClubAdmin() || (auth()->user() && auth()->user()->can('admin.universities.manage')))

    <a href="{{ url()->current() }}/edit" class="btn btn-thinner ml-auto">Edit</a>

    @endif
  </div>


  <div class="ck-content">
    {!! $club->getPage()->first()->content ?? '' !!}
  </div>

  @if ($club->location != null)
  @php
  $splt = explode(',', $club->location);
  $lat = $splt[0];
  $long = $splt[1];

@endphp
<div id="map" x-long="{{ $lat }}" x-lat="{{ $long }}" style="width: 100%; height: 400px; display: none"></div>
  @endif

</div>




@endsection