@extends('layouts.app')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')

  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    {{-- Start here --}}
    <div class="px-6 2xl:container">
      @include('after-login.pengunjung.sub-header')
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
                NIK
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Umur
              </th>
              <th scope="col" class="px-2 py-3 text-center whitespace-wrap">
                Instansi
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Pekerjaan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                No. Telepon
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Gender
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Alamat
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Keperluan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Bertemu Dengan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Waktu Kunjungan
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Photo
              </th>
              <th scope="col" class="px-2 py-3 text-center">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengunjungs as $index => $pengunjung)
              <tr class="bg-white border-b hover:bg-green-50 dark:hover:bg-green-50">
                <td class="px-6 py-2 text-sm text-gray-900">
                  {{ ($pengunjungs->currentPage() - 1) * $pengunjungs->perPage() + $index + 1 }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                  {{ $pengunjung->name }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->nik }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->umur }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center whitespace-nowrap">
                  {{ $pengunjung->instansi }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->pekerjaan }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->telepon }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->gender }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->alamat }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->keperluan }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->bertemu }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                  {{ $pengunjung->formatted_created_at }}
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900">
                  <img src="{{ asset('images/' . $pengunjung->photo) }}" alt="Foto Pengunjung" class="w-16 h-16">
                </td>
                <td class="px-1 py-2 text-sm font-medium text-gray-900 whitespace-nowrap">
                  <a href="{{ route('pengunjungs.destroy', $pengunjung->id) }}" method="POST" data-confirm-delete="true"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="info-btn inline-flex items-center justify-center h-7 w-7 rounded-full bg-red-500 hover:bg-red-600">
                      <i class="fa-solid fa-trash text-white"></i>
                    </button>
                  </a>
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
