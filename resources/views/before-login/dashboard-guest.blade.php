@extends('layouts.app')
@section('title', 'Guestbook Register')

@section('content')
  <div class="w-full h-screen flex flex-col bg-white">
    <!-- Header -->
    <div class="w-full flex justify-between items-center bg-green-300 p-4">
      <!-- Left Side: Text -->
      <a href="{{ url('/') }}" class="flex flex-col items-center">
        <div class="flex items-center text-xl font-bold px-4">
          <div class="w-14 h-14 mr-4 z-10">
            <img src="{{ asset('images/logobsip.png') }}" alt="Buku Tamu Icon">
          </div>
          <div class="absolute whitespace-nowrap animate-move-right-to-left">
            <span class="pl-20 text-lg font-semibold text-gray-700">
              SELAMAT DATANG DI BALAI PENERAPAN STANDAR INSTRUMEN PERTANIAN (BPSIP) RIAU
            </span>
          </div>
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
          <h3 class="text-lg">BPSIP RIAU</h3>
        </div>
        <img src="{{ asset('images/Book lover-bro.svg') }}" alt="Buku Tamu Icon" class="w-86 h-86">

        <a href="{{ route('kepuasan.index') }}"class="inline-block ml-0 middle none center rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
          data-ripple-light="true">
          <i class="fa-solid fa-form"></i><span class="m-1">ISI ULASAN</span>
        </a>
      </div>

      <!-- Middle Section: Form -->
      <div class="w-full md:w-2/3 bg-green-300 flex flex-col p-6 rounded-lg">
        <form action="{{ route('pengunjungs.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h2 class="text-xl font-bold mb-8 px-5 py-3 text-left bg-green-500 rounded-md">REGISTER TAMU</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="name" class="block text-sm font-medium">Nama</label>
              <input type="text" id="name" name="name" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('name') }}">
              <small class="text-gray-500">Nama Lengkap Wajib Diisi</small>
            </div>
        
            <div>
              <label for="nik" class="block text-sm font-medium">NIK</label>
              <input type="number" id="nik" name="nik" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('nik') }}">
              <small class="text-gray-500">Optional</small>
            </div>

            <div>
              <label for="umur" class="block text-sm font-medium">Umur</label>
              <input type="number" id="umur" name="umur" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('umur') }}">
              <small class="text-gray-500">Umur Wajib Diisi</small>
            </div>

            <div>
              <label for="telepon" class="block text-sm font-medium">No. Telpon</label>
              <input type="number" id="telepon" name="telepon" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('telepon') }}">
              <small class="text-gray-500">No. Telepon Wajib Diisi</small>
            </div>

            <div>
              <label for="instansi" class="block text-sm font-medium">Asal Instansi</label>
              <input type="text" id="instansi" name="instansi" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('instansi') }}">
              <small class="text-gray-500">Asal Instansi Wajib Diisi</small>
            </div>
            <div>
              <label for="gender" class="block text-sm font-medium">Jenis Kelamin</label>
              <select id="gender" name="gender" class="w-full border rounded py-2 px-3 text-sm">
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Pria" {{ old('gender') == 'Pria' ? 'selected' : '' }}>Pria</option>
                <option value="Wanita" {{ old('gender') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
              </select>
              <small class="text-gray-500">Jenis Kelamin Wajib Diisi</small>
            </div>

            <div>
              <label for="alamat" class="block text-sm font-medium">Alamat</label>
              <input type="text" id="alamat" name="alamat" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('alamat') }}">
              <small class="text-gray-500">Alamat Wajib Diisi</small>
            </div>
            <div>
              <label for="pekerjaan" class="block text-sm font-medium">Pekerjaan</label>
              <input type="text" id="pekerjaan" name="pekerjaan" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('pekerjaan') }}">
              <small class="text-gray-500">Pekerjaan Wajib Diisi</small>
            </div>
            <div>
              <label for="keperluan" class="block text-sm font-medium">Tujuan Berkunjung</label>
              <select id="keperluan" name="keperluan" class="w-full border rounded py-2 px-3 text-sm">
        <option value="" disabled selected>Pilih Tujuan Berkunjung</option>
        <option value="Layanan Informasi Teknologi" {{ old('keperluan') == 'Layanan Informasi Teknologi' ? 'selected' : '' }}>
            Konsultasi Informasi Teknologi
        </option>
        <option value="Kunjungan Edukasi" {{ old('keperluan') == 'Kunjungan Edukasi' ? 'selected' : '' }}>
            Kunjungan Edukasi
        </option>
        <option value="Layanan Pengujian Penerapan Standar/Laboratorium" {{ old('keperluan') == 'Layanan Pengujian Penerapan Standar/Laboratorium' ? 'selected' : '' }}>
            Layanan Pengujian Penerapan Standar/Laboratorium
        </option>
        <option value="Layanan Magang & PKL" {{ old('keperluan') == 'Layanan Magang & PKL' ? 'selected' : '' }}>
            Layanan Magang & PKL
        </option>
        <option value="Layanan Benih/Bibit" {{ old('keperluan') == 'Layanan Benih/Bibit' ? 'selected' : '' }}>
            Layanan Benih/Bibit
        </option>
        <option value="Kerjasama" {{ old('keperluan') == 'Kerjasama' ? 'selected' : '' }}>
            Kerjasama
        </option>
        <option value="Mengantar Surat/Undangan" {{ old('keperluan') == 'Mengantar Surat/Undangan' ? 'selected' : '' }}>
            Mengantar Surat/Undangan
        </option>
        <option value="other">Lainnya</option>
    </select>
              <!-- <select id="keperluan" name="keperluan" class="w-full border rounded py-2 px-3 text-sm">
                <option value="" disabled selected>Pilih Tujuan Berkunjung</option>
                <option value="Layanan Informasi Teknologi">Konsultasi Informasi Teknologi</option>
                <option value="Kunjungan Edukasi">Kunjungan Edukasi</option>
                <option value="Layanan Pengujian Penerapan Standar/Laboratorium">Layanan Pengujian Penerapan
                  Standar/Laboratorium
                </option>
                <option value="Layanan Magang & PKL">Layanan Magang & PKL</option>
                <option value="Layanan Benih/Bibit">Layanan Benih/Bibit</option>
                <option value="Kerjasama">Kerjasama</option>
                <option value="Mengantar Surat/Undangan">Mengantar Surat/Undangan</option>
                <option value="other">Lainnya</option>
              </select> -->
              <input type="text" id="custom-keperluan" name="custom_keperluan"
                class="mt-2 w-full border rounded py-2 px-3 text-sm hidden"
                placeholder="Tulis tujuan berkunjung Anda" />
              <small class="text-gray-500">Tujuan Berkunjung Wajib Diisi</small>
            </div>

            <!-- Hidden input to store the photo in base64 format -->
            <input type="hidden" name="photo" id="photo" value="">

            <div>
              <label for="bertemu" class="block text-sm font-medium">Bertemu Dengan</label>
              <input type="text" id="bertemu" name="bertemu" class="w-full border rounded py-2 px-3 text-sm"
                value="{{ old('bertemu') }}">
              <small class="text-gray-500">Wajib Diisi</small>
            </div>
            {{-- <div>
              <input type="date" id="tanggal" name="tanggal" class="w-full border rounded py-2 px-3 text-sm">
            </div> --}}
          </div>
      </div>


      <!-- Right Section: Photo Capture -->
      <div class="w-full md:w-1/3 bg-green-300 flex flex-col items-center justify-center rounded-lg p-4">
        <div class="w-full h-52 bg-gray-200 rounded-lg mb-4 flex items-center justify-center"
          style="margin-top: -130px;">
          <img id="guest-photo" src="" alt="Guest Photo" class="w-full h-full rounded-lg hidden">
          <span id="photo-placeholder" class="text-gray-500">Tidak Ada Foto</span>
          <video id="camera-stream" class="hidden w-full h-full rounded-lg"></video>
        </div>
        {{-- <button type="button" id="start-camera-btn"
          class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mb-2">
          Ambil Foto
        </button> --}}
        <div class="flex space-x-3">
          <button type="button" id="start-camera-btn"
            class="inline-block middle none center rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
            data-ripple-light="true">
            <i class="fa-solid fa-camera"></i><span class="m-1">Ambil Foto</span>
          </button>

          <button type="button" id="take-photo-btn"
            class="middle none center rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700 hidden"
            data-ripple-light="true">
            <i class="fa-solid fa-download"></i><span class="m-1">Simpan Foto</span>
          </button>

          <button type="submit"
            class="inline-block middle none center rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
            data-ripple-light="true">
            <i class="fa-solid fa-check"></i><span class="m-1">SUBMIT DATA</span>
          </button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <script>
    // JavaScript for date and photo capture logic
    const dateElement = document.getElementById('current-date');

    // Opsi untuk tanggal
    const dateOptions = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };

    // Opsi untuk waktu
    const timeOptions = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // Gunakan format 24 jam
    };

    // Fungsi untuk memperbarui tanggal dan waktu
    function updateDateTime() {
      const now = new Date();

      // Format tanggal dan waktu
      const formattedDate = now.toLocaleDateString('id-ID', dateOptions);
      const formattedTime = now.toLocaleTimeString('id-ID', timeOptions);

      // Gabungkan tanggal dan waktu
      dateElement.textContent = `${formattedDate}, ${formattedTime}`;
    }

    // Panggil fungsi pertama kali
    updateDateTime();

    // Perbarui setiap detik
    setInterval(updateDateTime, 1000);

    // Photo capture logic
    const startCameraBtn = document.getElementById('start-camera-btn');
    const takePhotoBtn = document.getElementById('take-photo-btn');
    const photoPlaceholder = document.getElementById('photo-placeholder');
    const guestPhoto = document.getElementById('guest-photo');
    const cameraStream = document.getElementById('camera-stream');
    let stream;

    startCameraBtn.addEventListener('click', async () => {
      try {
        stream = await navigator.mediaDevices.getUserMedia({
          video: true
        });
        cameraStream.srcObject = stream;
        cameraStream.play();
        cameraStream.classList.remove('hidden');
        photoPlaceholder.classList.add('hidden');
        takePhotoBtn.classList.remove('hidden');
        startCameraBtn.classList.add('hidden');
      } catch (err) {
        alert("Akses kamera ditolak atau tidak tersedia.");
      }
    });

    takePhotoBtn.addEventListener('click', () => {
      const video = cameraStream;

      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');

        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const photoDataUrl = canvas.toDataURL('image/png');
        guestPhoto.src = photoDataUrl;
        guestPhoto.classList.remove('hidden');
        cameraStream.classList.add('hidden');
        takePhotoBtn.classList.add('hidden');
        photoPlaceholder.classList.add('hidden');
        document.getElementById('photo').value = photoDataUrl;

        stream.getTracks().forEach(track => track.stop());
      } else {
        console.error("Video is not ready to capture photo.");
      }

    });

    document.getElementById('keperluan').addEventListener('change', function() {
      const customInput = document.getElementById('custom-keperluan');
      if (this.value === 'other') {
        customInput.classList.remove('hidden'); // Tampilkan input jika "Lainnya" dipilih
        customInput.setAttribute('required', true); // Set input sebagai wajib diisi
      } else {
        customInput.classList.add('hidden'); // Sembunyikan input jika pilihan lain dipilih
        customInput.removeAttribute('required'); // Hapus atribut wajib diisi
        customInput.value = ''; // Bersihkan nilai input
      }
    });
  </script>

@endsection
