@extends('layouts.app')
@section('title', 'Penilaian Kepuasan Tamu')

@section('content')
  <div class="w-full h-screen flex flex-col bg-white fade-in">
    <!-- Header -->
    <div class="w-full flex justify-between items-center bg-green-300 p-4">
      <!-- Left Side: Text -->
      <a href="{{ url('/') }}" class="flex flex-col items-center">
        <div class="flex items-center text-xl font-bold px-4">
        <img src="{{ asset('images/logobsip.png') }}" alt="Buku Tamu Icon" class="w-14 h-14 mr-4">
        <span>BALAI PENERAPAN STANDAR INSTRUMEN PERTANIAN RIAU</span>
      </div>
      </a>

      <!-- Right Side: Date and Button -->
      <div class="flex flex-col items-end">
        <!-- Date and Day -->
        <div id="current-date" class="text-sm mb-2"></div>
        <!-- Login Button -->
        <a href="{{ route('login') }}">
          <button
            class="inline-block middle none center mr-3 rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
            data-ripple-light="true">

            <i class="fa-solid fa-download"></i><span class="m-1">LOGIN</span>
          </button>
        </a>
      </div>
    </div>

    <!-- Content -->
    <div class="w-full flex flex-col md:flex-row bg-white h-full p-8 space-y-4 md:space-y-0 md:space-x-4">
      <!-- Left Section: Welcome -->
      <div class="w-full md:w-1/3 bg-green-300 flex flex-col justify-center items-center rounded-lg p-2">
        <div class="text-center">
          <h2 class="text-lg font-bold mb-4">Selamat Datang</h2>
          <h1 class="text-3xl font-bold text-green-800">BUKU TAMU</h1>
          <h3 class="text-lg">BSIP RIAU</h3>
        </div>
        <img src="{{ asset('images/Customer Survey-amico.svg') }}" alt="Buku Tamu Icon" class="w-80 h-80">
      </div>

      <!-- Middle Section: Satisfaction Form -->
      <div class="w-full md:w-2/3 bg-green-300 flex flex-col p-8 rounded-lg" id="satisfaction-container">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-xs rtl:text-right text-slate-100">
            <thead class="text-xs text-gray-700 uppercase bg-green-100">
              <tr>
                <th scope="col" class="px-2 py-3 text-center">No.</th>
                <th scope="col" class="px-2 py-3 text-center">Nama</th>
                <th scope="col" class="px-2 py-3 text-center whitespace-wrap">Instansi</th>
                <th scope="col" class="px-2 py-3 text-center">Keperluan</th>
                <th scope="col" class="px-2 py-3 text-center">Bertemu Dengan</th>
                <th scope="col" class="px-2 py-3 text-center">Tanggal</th>
                <th scope="col" class="px-2 py-3 text-center">Isi Ulasan</th>
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
                  <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center whitespace-nowrap">
                    {{ $pengunjung->instansi }}
                  </td>
                  <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                    {{ $pengunjung->keperluan }}
                  </td>
                  <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                    {{ $pengunjung->bertemu }}
                  </td>
                  <td class="px-1 py-2 text-sm font-medium text-gray-900 whitespace-nowrap">
                    {{ $pengunjung->formatted_created_at }}
                  </td>
                  <td class="px-1 py-2 text-sm font-medium text-gray-900 text-center">
                    <a href="{{ route('pengunjungs.kepuasan', $pengunjung->id) }}"
                      class="info-btn inline-flex items-center justify-center h-7 w-7 rounded-full bg-green-400 hover:bg-green-600">
                      <i class="fa-solid fa-exclamation text-white"></i>
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

    <!-- JavaScript for Animation -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const content = document.querySelector('.fade-in');
        if (content) {
          content.classList.add('fade-in-active');
        }
      });
    </script>

  </div> 
@endsection