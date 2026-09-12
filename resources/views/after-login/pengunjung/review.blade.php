@extends('layouts.app')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')

  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    {{-- Start here --}}
    <div class="px-6 2xl:container">
      @include('after-login.pengunjung.sub-header-review')
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-XS rtl:text-right text-slate-100">
          <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
              <th scope="col" class="px-2 py-3 text-center">
                No.
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Nama
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Instansi
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Skor Kepuasan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Komentar Kepuasan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Waktu Kunjungan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengunjungs as $index => $pengunjung)
              <tr class="bg-white border-b hover:bg-green-50 dark:hover:bg-green-50">
                <td class="px-6 py-2 text-sm text-gray-900 text-center">
                  {{ ($pengunjungs->currentPage() - 1) * $pengunjungs->perPage() + $index + 1 }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 whitespace-nowrap text-left">
                  {{ $pengunjung->name }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-left">
                  {{ $pengunjung->instansi }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $pengunjung->skor_kepuasan)
                      <span class="text-yellow-500" style="font-size: 1.2rem">&#9733;</span>
                    @else
                      <span class="text-gray-400" style="font-size: 1.2rem">&#9734;</span>
                    @endif
                  @endfor
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-left">
                  {{ $pengunjung->komentar_kepuasan }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->formatted_created_at }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{-- Tambahkan tautan pagination --}}
        <div class="mt-4">
          {{ $pengunjungs->links('vendor.pagination.custom') }}
        </div>
      </div>
    </div>
  </div>
@endsection
