@extends('layout')

@section('title')
{{ $article->title }} | Articles |
@endsection

@section('meta')
{{ Str::of(html_entity_decode(strip_tags($article->content)))->squish()->words() }}
@endsection

@section('content')

<div class="h-[40vh] w-screen bg-gray-100  overflow-hidden  ">

    <div class="h-full w-full overflow-hidden relative">
        <div class="absolute top-0 right-0 w-full h-full head-bg-3 flex items-center justify-center ">
            <img src="/storage/logo/blogo.png" class="w-[10%] hidden md:block" alt="">
            <div class="md:border-l-2 border-white md:ml-12 md:pl-12 py-8 max-w-7xl">
                <h2 class="md:text-6xl text-4xl font-bold text-white text-center">{{ Str::words($article->title, 3) }}</h2>

            </div>
        </div>

    </div>


</div>

<div class="container-responsive flex flex-col space-y-4">

    <a href="{{ route('latest') }}" class=" underline ">Back</a>
    <article class="flex flex-col">
        <div class="flex flex-row items-center">

            <div class="w-full">
                <h1 class="header header-larger">{{ $article->title }}</h1>
                <div class="flex flex-row">
                    <small class="text-gray-500 font-normal">{{ $article->getDateAuthorString() }}</small>
                    <small class="text-gray-500 font-normal ml-auto flex flex-row items-center justify-center space-x-2">
                        <span>{{ $article->getViews() }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </small>
                </div>
            </div>
            @if ($article->pinned)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 ml-auto text-bulsca hover:text-bulsca_red transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
            @endif
        </div>

        <hr class="mt-3 mb-3">
        <p>
            {!! $article->content !!}
        </p>

    </article>
    @hasanyrole('admin|super_admin|committee')
    <div class="flex flex-col md:flex-row ml-auto">
        <a href="{{ route('article.edit', $article->getSlug()) }}" class="btn btn-thinner">Edit</a>
    </div>
    @endhasanyrole


</div>











@endsection