@extends('layouts.app')
@section('title', 'Penilaian Kepuasan Tamu')

@section('content')
  <div class="w-full h-screen flex flex-col bg-white">
    <!-- Header -->
    <div class="w-full flex justify-between items-center bg-green-300 p-4">
      <!-- Left Side: Text -->
      <a href="{{ url('/') }}" class="flex flex-col items-center">
      <div class="flex items-center text-xl font-bold px-4">
        <img src="{{ asset('images/logobsip.png') }}" alt="Buku Tamu Icon" class="w-14 h-14 mr-4">
        <span>BALAI PENERAPAN STANDAR INSTRUMEN PERTANIAN RIAU</span>
      </div>
      <a href="{{ url('/') }}" class="flex flex-col items-center">

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
          <h3 class="text-lg">BPSIP RIAU</h3>
        </div>
        <img src="{{ asset('images/Customer Survey-amico.svg') }}" alt="Buku Tamu Icon" class="w-80 h-80">
      </div>

      <!-- Middle Section: Satisfaction Form -->
      <div class="w-full md:w-2/3 bg-green-300 flex flex-col p-8 rounded-lg" id="satisfaction-container">
        <form action="{{ route('pengunjungs.storeKepuasan') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $pengunjung->id }}">
          <h2 class="text-xl font-bold mb-8 px-5 py-3 text-left bg-green-500 rounded-md">INDEKS KEPUASAN TAMU</h2>
          <p class="text-center mb-4">Apakah anda puas dengan Pelayanan Kantor Kami?</p>

          <div class="flex justify-between items-stretch">
            <div class="flex justify-between space-x-4 h-36 w-full">
              <!-- Card 1: Sangat Puas -->
              <div
                class="flex-1 bg-green-200 rounded-lg shadow-md p-4 flex flex-col items-center justify-between cursor-pointer card"
                data-skor="5">
                <h3 class="font-bold text-lg mb-2">SANGAT PUAS</h3>
                <picture>
                  <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f603/512.webp" type="image/webp">
                  <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f603/512.gif" alt="😃" width="64"
                    height="64">
                </picture>
              </div>

              <!-- Card 2: Puas -->
              <div
                class="flex-1 bg-green-200 rounded-lg shadow-md p-4 flex flex-col items-center justify-between cursor-pointer card"
                data-skor="4">
                <h3 class="font-bold text-lg mb-2">PUAS</h3>
                <picture>
                  <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f642/512.webp" type="image/webp">
                  <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f642/512.gif" alt="🙂" width="64"
                    height="64">
                </picture>
              </div>

              <!-- Card 3: Cukup Puas -->
              <div
                class="flex-1 bg-green-200 rounded-lg shadow-md p-4 flex flex-col items-center justify-between cursor-pointer card"
                data-skor="3">
                <h3 class="font-bold text-lg mb-2">CUKUP PUAS</h3>
                <picture>
                  <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f610/512.webp" type="image/webp">
                  <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f610/512.gif" alt="😐" width="64"
                    height="64">
                </picture>
              </div>

              <!-- Card 4: Tidak Puas -->
              <div
                class="flex-1 bg-green-200 rounded-lg shadow-md p-4 flex flex-col items-center justify-between cursor-pointer card"
                data-skor="2">
                <h3 class="font-bold text-lg mb-2">TIDAK PUAS</h3>
                <picture>
                  <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f61e/512.webp" type="image/webp">
                  <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f61e/512.gif" alt="😞" width="64"
                    height="64">
                </picture>
              </div>
            </div>
          </div>

          <!-- Input Hidden untuk Skor Kepuasan -->
          <input type="hidden" id="skor_kepuasan" name="skor_kepuasan" value="">

          <div class="mt-4">
            <label for="komentar_kepuasan" class="block text-sm font-medium">Komentar</label>
            <textarea id="komentar_kepuasan" name="komentar_kepuasan" class="w-full border rounded py-2 px-3 text-sm"
              rows="4"></textarea>
          </div>

          <button type="submit"
            class="inline-block mt-4 text-center middle w-full none center mr-3 rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
            data-ripple-light="true">
            <i class="fa-solid fa-envelope"></i><span class="m-2">Kirim Penilaian</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // JavaScript for date and photo capture logic
    const dateElement = document.getElementById('current-date');
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    const today = new Date().toLocaleDateString('id-ID', options);
    dateElement.textContent = today;

    // Mengatur skor kepuasan berdasarkan kartu yang dipilih
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('click', function() {
        // Set skor sesuai kartu yang diklik
        const skor = this.getAttribute('data-skor');
        document.getElementById('skor_kepuasan').value = skor;

        // Tambahkan highlight pada kartu yang dipilih
        document.querySelectorAll('.card').forEach(c => {
          c.classList.remove('bg-green-500');
        });
        this.classList.add('bg-green-500');
      });
    });
  </script>
@endsection
