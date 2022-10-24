<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="/storage/logo/blogo.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title> @yield('title') BULSCA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <meta name="description" content="@yield('meta')">
  <meta property="og:title" content="@yield('title') BULSCA">
  <meta name="og:description" content="@yield('meta')">
  <meta property="og:url" content="{{ url()->current() }}">
  @yield('extra-meta')
</head>

<body class="overflow-x-hidden flex flex-col min-h-screen">
  <div class="fixed w-screen z-50 transition-all duration-100" id="navbar">
    <div class="nav-wrapper transition-all duration-100">
      <a href="/" class="nav-brand xl:text-2xl  2xl:text-3xl text-xl pr-2 md:pr-0 capitalize transition-all">
        British Universities Lifesaving Clubs' Association
      </a>

      <div class="lg:hidden block text-white font-bold ml-auto ">
        <svg id="mobile-nav-opener" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </div>

      <nav class="ml-auto mr-10 lg:block hidden">
        <ul class="flex space-x-4 xl:space-x-8 2xl:space-x-12 nav-list">
          <li><a href="{{ route('latest') }}">Latest</a></li>
          <li class="group {{ Request::is('competitions*') ? 'nav-active' : ''}}">

            <a href="{{ route('comps') }}">Competitions</a>
            <div class="dropdown group-hover:h-auto group-focus:h-auto group-active:h-auto group-focus-within:h-auto">
              <ul>
                <li><a href="{{ route('league') }}">League</a></li>
                <li><a href="{{ route('champs') }}">Champs</a></li>
              </ul>
            </div>
          </li>
          <li class="group {{ Request::is('get-involved*') ? 'nav-active' : ''}}">
            <a href="{{ route('get-involved') }}" class=" overflow-hidden overflow-ellipsis whitespace-nowrap">Get Involved</a>
            <div class="dropdown group-hover:h-auto group-focus:h-auto group-active:h-auto group-focus-within:h-auto">
              <ul>
                <li><a href="{{ route('clubs') }}">Clubs</a></li>
                <li><a href="{{  route('create-club')  }}">Create a Club</a></li>
                <li><a href="{{  route('get-involved.committee')  }}">Committee</a></li>
              </ul>
            </div>
          </li>
          <li class="group {{ Request::is('welfare*') ? 'nav-active' : ''}}">
            <a href="{{ route('welfare') }}" class=" overflow-hidden overflow-ellipsis whitespace-nowrap">Welfare</a>
            <div class="dropdown group-hover:h-auto group-focus:h-auto group-active:h-auto group-focus-within:h-auto">
              <ul>
                <li><a href="{{ route('welfare') }}">Home</a></li>
                <li><a href="{{  route('welfare.help-and-reporting')  }}">Help and Reporting</a></li>
                <li><a href="{{  route('welfare.inclusion-and-accessibility')  }}">Inclusion and Accessibility</a></li>
              </ul>
            </div>
          </li>
          <li><a href="{{ route('resources') }}">Resources</a></li>
          <li><a href="{{ route('about') }}">About</a></li>
          <li class="group">
            <a href="{{ route('dashboard') }}">Account</a>
            @auth
            <div class="dropdown group-hover:h-auto group-focus:h-auto group-active:h-auto group-focus-within:h-auto">
              <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('settings') }}">Settings</a></li>
                @can('admin')
                <li><a href="{{ route('admin') }}">Admin</a></li>
                @endcan
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
            @endauth
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <div id="mobile-nav" class="mobile-nav">
    <div>
      <a href="/" class="nav-brand xl:text-2xl  2xl:text-3xl text-xl pr-2 md:pr-0 capitalize transition-all">
        British Universities Lifesaving Clubs' Association
      </a>
      <div class="lg:hidden block text-white font-bold ml-auto -mr-1 sm:-mr-4">
        <svg id="mobile-nav-closer" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </div>
    </div>
    <nav>
      <ul class="">
        <li><a href="{{ route('latest') }}">Latest</a></li>
        <li class="group {{ Request::is('competitions*') ? 'mobile-nav-active' : ''}}">
          <div class="mobile-nav-link">
            <a href="{{ route('comps') }}">Competitions</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

          </div>

          <div class="mobile-dropdown">
            <ul>
              <li><a href="{{ route('league') }}">League</a></li>
              <li><a href="{{ route('champs') }}">Champs</a></li>
            </ul>
          </div>
        </li>
        <li class="group {{ Request::is('get-involved*') ? 'mobile-nav-active' : ''}}">
          <div class="mobile-nav-link">
            <a href="{{ route('get-involved') }}">Get Involved</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

          </div>
          <div class="mobile-dropdown">
            <ul>
              <li><a href="{{ route('clubs') }}">Clubs</a></li>
              <li><a href="{{ route('create-club') }}">Create a Club</a></li>
              <li><a href="{{  route('get-involved.committee')  }}">Committee</a></li>
            </ul>
          </div>
        </li>


        <li class="group {{ Request::is('welfare*') ? 'mobile-nav-active' : ''}}">
          <div class="mobile-nav-link">
            <a href="{{ route('welfare') }}">Welfare</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

          </div>
          <div class="mobile-dropdown">
            <ul>

              <li><a href="{{ route('welfare.help-and-reporting') }}">Help and Reporting</a></li>
              <li><a href="{{  route('welfare.inclusion-and-accessibility')  }}">Inclusion and Accessibility</a></li>
            </ul>
          </div>
        </li>



        <li><a href="{{ route('resources') }}">Resources</a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li class="group {{ Request::is('dashboard*') ? 'mobile-nav-active' : ''}}">
          <div class="mobile-nav-link">
            <a href="{{ route('dashboard') }}">Account</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

          </div>
          @auth
          <div class="mobile-dropdown">
            <ul>

              <li><a href="{{ route('settings') }}">Settings</a></li>
              @can('admin')
              <li><a href="{{ route('admin') }}">Admin</a></li>
              @endcan
              <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
          </div>
          @endauth
        </li>
      </ul>
    </nav>
  </div>



  @yield('content')


  <div class=" container-responsive  ">
    <div class="grid md:grid-cols-2 grid-cols-1">
      <div class="flex flex-col">
        <h2 class="header">Join the mailing list</h2>
        <form action="https://bulsca.us15.list-manage.com/subscribe/post?u=1b1c9887c1e5ff377f6979e66&amp;id=94c67a5f8d&amp;f_id=00738de0f0" method="post" class="flex flex-col  overflow-hidden">

          <input type="text" class="border-b-2 border-red-500 text-xl   p-2  my-2 hover:outline-none focus:outline-none" name="EMAIL" placeholder="swimming@bulsca.co.uk">
          <input type="text" name="b_1b1c9887c1e5ff377f6979e66_94c67a5f8d" tabindex="-1" value="" class="hidden" hidden>
          <input type="checkbox" id="gdpr_3427" name="gdpr[3427]" value="Y" checked class="hidden" hidden>
          <small class="my-2 mb-3">
            By clicking below I acknowledge that BULSCA will send me emails about relevant events and news. You may opt out anytime by clicking <strong>unsubscribe</strong> in any email!
          </small>
          <button submit class="btn">Sign me up!</button>
        </form>

        <br>
        <br>

      </div>
      <div class="flex justify-center items-center">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBULSCA%2F&tabs=timeline&width=340&height=271&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId" width="340" height="271" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      </div>
    </div>
  </div>



  <footer class="bg-black w-full flex flex-col items-center justify-center mt-auto">
    <div class="p-6 px-32 flex flex-row items-center justify-center space-x-4">

      <a href="https://www.facebook.com/BULSCA/" rel="noopener noreferrer" target="_blank"><img src="/storage/logo/f_logo_RGB-Blue_1024.png" loading="lazy" class="w-12 h-12" alt=""></a>
      <a href="https://www.instagram.com/bulsca" rel="noopener noreferrer" target="_blank"><img src="/storage/logo/Instagram_Glyph_Gradient_RGB.png" loading="lazy" class="w-12 h-12" alt=""></a>

    </div>
    <small class="text-white pb-4 divide-x ">
      <a class="text-white font-normal no-underline hover:underline pr-1" href="{{ route('contact') }}">Contact</a>
      <a class="text-white font-normal no-underline hover:underline pl-2" href="{{ route('welfare') }}">Welfare</a>
    </small>
  </footer>


  @if(session('message'))
  <x-notification-sliver>{{ session('message') }}</x-notification-sliver>
  @endif

</body>

<script>
  let h1 = document.getElementById("head1")
  let h2 = document.getElementById("head2")
  let nav = document.getElementById("navbar")
  let toggle = true

  const runner = () => {
    if (toggle) {
      h1.classList.add('opacity-0')
      h2.classList.remove('opacity-0')
    } else {
      h1.classList.remove('opacity-0')
      h2.classList.add('opacity-0')
    }
    toggle = !toggle
  }

  window.onload = function() {
    initMobileNav()
    if (h1 == undefined || h2 == undefined) return

    setInterval(runner, 10000)

  }

  window.onscroll = () => {
    console.log('h')
    if (window.scrollY > 50) {
      nav.classList.add('nav-scrolled')
    } else {
      nav.classList.remove('nav-scrolled')
    }
  }

  function initMobileNav() {
    let mn = document.getElementById('mobile-nav');
    let mno = document.getElementById('mobile-nav-opener');
    let mnc = document.getElementById('mobile-nav-closer');


    mno.onclick = () => {
      mn.classList.add('open')
    }

    mnc.onclick = () => {
      mn.classList.remove('open')
    }
  }
</script>

</html>