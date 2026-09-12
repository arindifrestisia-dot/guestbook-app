<div class="ml-auto mb-4 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
  <div class="sticky z-10 top-0 h-14 border-b lg:py-2.5">
    <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
      <h5 hidden class="text-base text-gray-600 font-medium lg:block">
        <div class="flex items-center text-base px-4">
          <img src="{{ asset('images/logobsip.png') }}" alt="Buku Tamu Icon" class="w-9 h-9 mr-4">
          <img src="{{ asset('images/agrostandar.jpeg') }}" alt="Buku Tamu Icon" class="w-9 h-9 mr-4">
          <span class="tracking-widest">BALAI PENERAPAN STANDAR INSTRUMEN PERTANIAN RIAU</span>
        </div>
      </h5>
      <button class="w-12 h-16 -mr-2 border-r lg:hidden">
        {{-- Hamburger nya disini loh rek --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <div class="flex space-x">
        <form action="{{ route('logout') }}" method="POST">
          <button
            class="inline-block middle none center mr-3 rounded-lg border border-green-500 bg-green-300 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-500"
            data-ripple-light="true">
            <i class="fa-solid fa-right-from-bracket"></i><span class="ml-1">Logout</span>
          </button>
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
