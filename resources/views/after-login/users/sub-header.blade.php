<div class="flex flex-col md:flex-row sm:flex-row    justify-between items-center mb-3">
  <div class="text-center md:text-left mb-2 md:mb-0 md:flex md:items-center">
    <a href="{{ route('users.create') }}"
      class="inline-block middle none center mr-3 rounded-lg border border-green-500 bg-green-300 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-500"
      data-ripple-light="true"><i class="fa-solid fa-plus"></i> <span class="m-1">Tambah</span>
    </a>
  </div>
  <div class="flex justify-center items-center mb-2 md:mb-0">
    <div class="relative flex items-center text-cyan-600">
      <form action="{{ route('users.search') }}" method="GET">
        <span class="absolute left-4 h-10 flex items-center pr-3 border-r border-cyan-600">
          <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input type="search" name="search" id="search" placeholder="Cari User ..."
          class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-cyan-600">
    </div>
  </div>
  <!-- /Search bar -->
</div>
