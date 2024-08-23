<img src="{{ $hero->header_logo }}" :src="hero.header_logo" ondblclick="ee(this)"
    class="md:w-[12.5%] w-[50%] h-auto mt-18  " alt="">
<div class=" py-8 pb-12 text-center flex flex-col " x-show="showHeaders">
    <p class="md:text-[5rem] text-5xl font-bold text-white mb-3 md:mb-0 " x-model="hero.header_title" x-ref="ht"
        x-init="$refs.ht.contentEditable = true" style="  ">
        {{ $hero->header_title }}</p>
    <p class=" text-xl font-semibold text-white" x-model="hero.header_subtitle" x-ref="hst" x-init="$refs.hst.contentEditable = true">
        {{ $hero->header_subtitle }}</p>

</div>
