@extends('layouts.app')
@section('title', 'Test Page')

@section('content')
  <div class="w-full h-screen flex justify-center items-center bg-no-repeat bg-cover bg-center bg-fixed relative"
    style="background-image: url('{{ asset('images/bgbg.jpeg') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Dark overlay -->

    <div
      class="w-full max-w-sm rounded-lg border border-gray-200 bg-white p-4 shadow-lg shadow-indigo-600/10 sm:p-6 md:p-8 relative z-10">
      <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <h5 class="text-xl font-bold tracking-widest text-gray-900">LOGIN ADMIN</h5>
        <div>
          <label for="login" class="mb-2 block text-sm font-medium text-gray-900">Masukkan Email/Username </label>
          <input type="text" name="login" id="login" value="{{ old('login') }}"
            class="outline-none block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Username atau Email" required />
          @error('login')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>
        <div>
          <label for="password" class="mb-2 block text-sm font-medium text-gray-900">Masukkan Password</label>
          <div class="relative">
            <input type="password" name="password" id="password" placeholder="****"
              class="outline-none block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
              required />

            <!-- Ikon Mata -->
            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2">
              <i id="eyeIcon" class="fa-solid fa-eye text-gray-600"></i>
            </button>
          </div>

          @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit"
          class="w-full rounded-lg bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
          <i class="fa-solid fa-right-to-bracket"></i><span class="m-1">LOGIN</span>
        </button>
      </form>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
      // Toggle password visibility
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;

      // Toggle eye icon
      if (type === 'password') {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      } else {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      }
    });
  </script>
@endsection
