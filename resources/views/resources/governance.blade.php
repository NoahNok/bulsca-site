@extends('layout')

@section('title')
Championships 2022 | Competitions | 
@endsection

@section('content')

<div class="h-[40vh] w-screen bg-gray-100  overflow-hidden  ">

    <div class="h-full w-full overflow-hidden relative">
      <div class="absolute top-0 right-0 w-full h-full head-bg-3 flex items-center justify-center " >
        <img src="/storage/logo/blogo.png" class="w-[10%] hidden md:block" alt="">
        <div class="md:border-l-2 border-white md:ml-12 md:pl-12 py-8">
          <h2 class="md:text-6xl text-4xl font-bold text-white">Resources</h2>
          <p class="text-white">Beep boop...</p>
        </div>
      </div>

    </div>

    
  </div>

  

  <div class="container-responsive">
  @foreach ($res as $resSec)

  
      <h3 class="header">{{ $resSec['name'] }}</h3>
      <br>

      <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
      @foreach ($resSec['resources'] as $r)
       <x-resource-download :file="$r" /> 


      @endforeach
      </div>
      <br><hr><br>

            
  @endforeach
  </div>


@endsection