@extends('layout')

@section('title')
    (Edit) {{ $club->name }} | Clubs |
@endsection

@section('content')
    <div class="h-[40vh] w-screen bg-gray-100  overflow-hidden  ">

        <div class="h-full w-full overflow-hidden relative">
            <div class="absolute top-0 right-0 w-full h-full bg-bulsca flex items-center justify-center " id="banner"
                style=" background-color: {{ $club->getPage()->first()->banner_color }}">
                <img src="{{ $club->image_path ? route('image', $club->image_path) : '/storage/logo/blogo.png' }}"
                    class="w-[10%] hidden md:block " alt="">
                <div class="md:border-l-2 border-white md:ml-12 md:pl-12 py-8">
                    <h2 class="md:text-6xl text-4xl font-bold text-white" id="banner-head"
                        style="color: {{ $club->getPage()->first()->banner_text_color }}">{{ $club->name }}</h2>
                    <p class="text-white" style="color: {{ $club->getPage()->first()->banner_text_color }}" id="banner-sub">
                        You are editing this clubs page!</p>

                </div>
            </div>

        </div>


    </div>

    <div class="mx-2 md:mx-[20%] my-[2%]">
        <form action="" method="POST" class="flex flex-col">
            @csrf
            <div class="flex justify-between items-center">
                <a href="./" class=" underline ">Back</a>
                <button class="ml-auto btn btn-thinner btn-save">Save</button>

            </div>


            <x-form-input id="location" title="Location (Lat,Long)" required="false"
                defaultValue="{{ $club->location }}"></x-form-input>

            <div class="form-input">
                <label for="clr-picker">Banner Colour</label>

                <div class="flex space-x-2 items-center">
                    <input type="color" name="banner_color" id="clr-picker" class="mb-0"
                        value="{{ $club->getPage()->first()->banner_color }}">
                    <svg xmlns="http://www.w3.org/2000/svg" id="clr-trigger" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15 11.25 1.5 1.5.75-.75V8.758l2.276-.61a3 3 0 1 0-3.675-3.675l-.61 2.277H12l-.75.75 1.5 1.5M15 11.25l-8.47 8.47c-.34.34-.8.53-1.28.53s-.94.19-1.28.53l-.97.97-.75-.75.97-.97c.34-.34.53-.8.53-1.28s.19-.94.53-1.28L12.75 9M15 11.25 12.75 9" />
                    </svg>
                </div>

                <script>
                    const picker = document.getElementById('clr-picker')
                    const trigger = document.getElementById('clr-trigger')
                    const banner = document.getElementById('banner')

                    trigger.addEventListener('click', () => {
                        const eyeDropper = new EyeDropper()
                        eyeDropper.open().then(result => {
                            picker.value = result.sRGBHex
                            banner.style.backgroundColor = result.sRGBHex
                        })
                    })

                    picker.oninput = () => {
                        banner.style.backgroundColor = picker.value
                    }
                </script>

            </div>
            <br>

            <div class="form-input">
                <label for="btc">Banner Text Colour</label>
                <select name="banner_text_color" id="btc">
                    <option value="#000000" @if ($club->getPage()->first()->banner_text_color == '#000000') selected @endif>Black</option>
                    <option value="#ffffff" @if ($club->getPage()->first()->banner_text_color == '#ffffff') selected @endif>White</option>
                </select>
                <script>
                    const btc = document.getElementById('btc')
                    const bannerHead = document.getElementById('banner-head')
                    const bannerSub = document.getElementById('banner-sub')
                    btc.oninput = () => {
                        bannerHead.style.color = btc.value
                        bannerSub.style.color = btc.value
                    }
                </script>
            </div>

            <br>
            <h4>Socials</h4>
            <div class="grid-3">
                <x-form-input id="website" title="Website" required="false" defaultValue="{{ $club->website }}"
                    placeholder="bulsca.co.uk"></x-form-input>
                <x-form-input id="instagram" title="Instagram Handle" required="false" defaultValue="{{ $club->instagram }}"
                    placeholder="BULSCA"></x-form-input>
                <x-form-input id="facebook" title="Facebook Handle" required="false" defaultValue="{{ $club->facebook }}"
                    placeholder="BULSCA"></x-form-input>
            </div>

            <br>
            <div>
                <div class="main-container">
                    <div class="editor-container editor-container_classic-editor editor-container_include-style"
                        id="editor-container">
                        <div class="editor-container__editor">
                            <textarea name="content" id="editor">{!! $club->getPage()->first()->content ?? '' !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <script type="importmap">
		{
			"imports": {
				"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
				"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
			}
		}
		</script>
            <script type="module" src="{{ asset('js/ck.js') }}"></script>
            {{-- <textarea hidden name="content" id="editor" class="h-[52vh]">{!! $club->getPage()->first()->content ?? '' !!}</textarea> --}}
            <br>

        </form>
    </div>
@endsection
