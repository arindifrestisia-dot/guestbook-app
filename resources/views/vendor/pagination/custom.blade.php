<!-- resources/views/vendor/pagination/custom.blade.php -->

@if ($paginator->hasPages())
  <nav>
    <ul class="flex justify-end mb-4">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li>
          <span
            class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 opacity-50 cursor-not-allowed"
            aria-disabled="true">
            <span class="material-icons text-sm">keyboard_arrow_left</span>
          </span>
        </li>
      @else
        <li>
          <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
            href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
            <span class="material-icons text-sm">keyboard_arrow_left</span>
          </a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li>
            <span
              class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 cursor-not-allowed">{{ $element }}</span>
          </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li>
                <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-green-600 to-green-400 p-0 text-sm text-white shadow-md shadow-pink-500/20 transition duration-150 ease-in-out"
                  href="{{ $url }}">{{ $page }}</a>
              </li>
            @else
              <li>
                <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                  href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li>
          <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
            href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
            <span class="material-icons text-sm">keyboard_arrow_right</span>
          </a>
        </li>
      @else
        <li>
          <span
            class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 opacity-50 cursor-not-allowed"
            aria-disabled="true">
            <span class="material-icons text-sm">keyboard_arrow_right</span>
          </span>
        </li>
      @endif
    </ul>
  </nav>
@endif
