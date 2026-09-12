<!-- resources/views/components/sidebar.blade.php -->
<aside
  class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-green-400 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[18%]">
  <div>
    <div class="mt-8 text-center">
      <img src="{{ Auth::user() ? asset('images/' . Auth::user()->photo) : '' }}" alt=""
        class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
      <h5 class="hidden mt-4 text-xl font-semibold text-gray-800 lg:block">{{ Auth::user()?->name }}</h5>
      <span class="hidden text-gray-800 lg:block uppercase">{{ Auth::user()?->position }}</span>
    </div>

    <ul class="space-y-2 tracking-wider mt-8">
      <li>
        <a href="{{ route('dashboard') }}" aria-label="dashboard"
          class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::is('dashboard*') ? 'text-white bg-green-600' : 'text-gray-800' }}">
          <i class="fa-solid fa-chart-line group-hover:text-cyan-600"></i>
          <span class="-mr-1 font-medium">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('pengunjungs.index') }}" aria-label="pengunjung"
          class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::routeIs('pengunjungs.index') ? 'text-white bg-green-600' : 'text-gray-800' }}">
          <i class="fa-regular fa-bookmark group-hover:text-cyan-600"></i>
          <span class="-mr-1 font-medium">Pengunjung</span>
        </a>
      </li>
      <li>
        <a href="{{ route('pengunjungs.review') }}" aria-label="review"
          class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::routeIs('pengunjungs.review') ? 'text-white bg-green-600' : 'text-gray-800' }}">
          <i class="fa-regular fa-star group-hover:text-cyan-600"></i>
          <span class="-mr-1 font-medium">Ulasan</span>
        </a>
      </li>
      {{-- <li>
        <a href="{{ route('proposals.index') }}" aria-label="surat"
          class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::is('proposal*') ? 'text-white bg-green-600' : 'text-gray-800' }}">
          <i class="fa-solid fa-paperclip"></i>
          <span class="-mr-1 font-medium">Proposal</span>
        </a>
      </li>
      <li>
        <a href="{{ route('surats.index') }}" aria-label="surat"
          class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::is('surats*') ? 'text-white bg-green-600' : 'text-gray-800' }}">
          <i class="fa-regular fa-envelope"></i>
          <span class="-mr-1 font-medium">Surat Keluar</span>
        </a>
      </li> --}}
      @if (Auth::user()->role != 0)
        <li>
          <a href="{{ route('users.index') }}" aria-label="users"
            class="relative px-4 py-3 flex items-center space-x-4 rounded-xl {{ Request::is('users*') ? 'text-white bg-green-600' : 'text-gray-800' }}">
            <i class="fa-solid fa-chart-line group-hover:text-cyan-600"></i>
            <span class="-mr-1 font-medium">Users</span>
          </a>
        </li>
      @endif
    </ul>
  </div>
</aside>
