<div class="flex flex-col md:flex-row sm:flex-row    justify-between items-center mb-3">
  <div class="text-center md:text-left mb-2 md:mb-0 md:flex md:items-center">
    <a href="{{ route('users.create') }}" class="py-2 px-5 rounded mb-2 md:mb-0 md:mr-2 bg-slate-200 hover:bg-slate-400">➕</a>
    <button class="py-2 px-5 font-semibold rounded mb-2 md:mb-0 md:mr-2 bg-slate-200 hover:bg-slate-400">Unggah
      Excel</button>
    <button class="py-2 px-5 font-semibold rounded mb-2 md:mb-0 bg-slate-200 hover:bg-slate-400">Import Excel</button>
  </div>
  <div class="flex justify-center items-center mb-2 md:mb-0">
    <div class="relative flex items-center text-gray-400 focus-within:text-cyan-400">
      <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
          <path id="Icon_awesome-search" data-name="search"
            d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z">
          </path>
        </svg>
      </span>
      <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here"
        class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300 focus:border-cyan-300 transition">
    </div>
  </div>
  <!-- /Search bar -->
</div>
