@extends('layout')

@section('content')

<div class="h-[40vh] w-screen bg-gray-100  overflow-hidden  ">

    <div class="h-full w-full overflow-hidden relative">
      <div class="absolute top-0 right-0 w-full h-full head-bg-3 flex items-center justify-center " >
        <img src="/storage/logo/blogo.png" class="w-[10%] hidden md:block " alt="">
        <div class="md:border-l-2 border-white md:ml-12 md:pl-12 py-8">
          <h2 class="md:text-6xl text-4xl font-bold text-white">About</h2>
          <p class="text-white">Swimming since 2002</p>
        </div>
      </div>

    </div>

    
  </div>

    <div class="container-responsive ">
        <div class="grid md:grid-cols-2 grid-cols-1 ">
        
            <div class="flex flex-col justify-center">
                <h2 class="header header-large">In the beginning</h2>
                <p class="">

                    Competitive lifesaving between clubs at universities across Britain began as a small collaboration between rival clubs over fifteen years ago and quickly expanded as more clubs became involved.
                    <br><br>
                    The formation of BULSCA in 2002 was in response to this growing popularity of lifesaving sport at universities; with the university lifesaving league being established in the 2002/03 season to provide a connection between the various competitions hosted by the universities over a season.
                    <br><br>
                    A detailed rule manual was drawn up to bring consistency between competitions in this first season. It wasn’t too long after, that BULSCA was formalised with the publication of the first BULSCA constitution, in 2004.
                    <br><br>
                    It is now not uncommon to see 20 to 30 teams at a majority of the competitions. In addition to the BULSCA league, and in an effort to achieve British Universities and College Sport (BUCS, formerly British Universities Sports Association BUSA) recognition in the 2006/07 season, BULSCA introduced the Student Nationals, a full weekend of competition combining both speed events and traditional events.
                    <br><br>
                    The biggest change in BULSCA happened in 2007, with the formation of a full BULSCA committee. Previously, there had been a BULSCA Chairperson who dealt with the day to day running of BULSCA, with the individual Club Captains making up the rest of a general committee. However, as BULSCA grew in size and ambition it became necessary to form the full committee, made up of a mixture of current BULSCA members and BULSCA “old boys”. The Club Captains still make up  a general committee, to whom the BULSCA committee answers.
                </p>
            </div>

            <div class="flex items-center justify-center md:mb-0 mb-4">
                <img src="/storage/photos/History1.jpg" loading="lazy" class="w-[90%]" alt="">
            </div>
        
        </div>
    </div>

    <div class="container-responsive">
        <div class="grid md:grid-cols-2 grid-cols-1 ">
        
        <div class="flex items-center justify-center md:mb-0 mb-4">
            <img src="/storage/photos/History3.jpg" loading="lazy" class="w-[90%]" alt="">
        </div>

        <div class="flex flex-col justify-center">
    
            <p class="">
            Today the BULSCA calendar is extensive with some clubs taking part in around eight BULSCA league competitions a year, as well as RLSS Branch and National competitions, international competitions, and training events.
            <br><br>
            BULSCA has previously provided volunteers for events such as the London Triathlon, the Blenheim Triathlon, the RLSS’s ‘Save a Baby’s Life’ and ‘Get Safe 4 Summer‘ campaigns, along with many more local small-scale events.
            <br><br>
            Although BULSCA predominantly exists to run the league and Championships, BULSCA are making efforts to run courses which will aid our members through their  time in lifesaving, and to encourage participation in Lifesaving and Lifesaving Sport.
            <br><br>

            <strong>If you would like to know more about BULSCA or want to get involved yourself, whether as a university student, a coach, or an official; please contact the current committee.</strong>
            </p>
        </div>
    </div>
    
</div>






@endsection