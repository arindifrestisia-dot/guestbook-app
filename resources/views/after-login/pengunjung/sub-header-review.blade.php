<div class="flex flex-col md:flex-row sm:flex-row    justify-between items-center mb-3">
    <div class="text-center md:text-left mb-2 md:mb-0 md:flex md:items-center">
      <a href="{{ route('pengunjungs.exportExcelReview') }}">
        <button
          class="inline-block middle none center mr-3 rounded-lg border border-green-600 py-2.5 px-4 font-sans text-xs font-bold uppercase text-green-600 transition-all hover:opacity-75 focus:ring focus:ring-green-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
          data-ripple-light="true">
          <i class="fa-solid fa-download"></i><span class="m-1">Download Excel</span>
        </button>
      </a>
    </div>
    <div class="flex justify-center items-center mb-2 md:mb-0">
      <div class="relative flex items-center text-green-600">
        <form action="{{ route('pengunjungs.search') }}" method="GET">
          <span class="absolute left-4 h-10 flex items-center pr-3 border-r border-cyan-600">
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
          <input type="search" name="search" id="search" placeholder="Cari Pengunjung"
            class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-green-600 outline-none border border-cyan-600">
      </div>
    </div>
    <!-- /Search bar -->
  </div>
  