@extends('layouts.app')
@section('title', 'Edit User Data')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')
  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    <div class="px-6 2xl:container">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-1">
              <label for="name" class="block text-gray-900 text-sm">Name</label>
              <input type="text" name="name" id="name" value="{{ $user->name }}"
                class="w-full px-3 py-2 text-sm border  border-gray-300 rounded-lg transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
            </div>

            <div class="mb-1">
              <label for="username" class="block text-gray-700 text-sm">Username</label>
              <input type="text" name="username" id="username" value="{{ $user->username }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
            </div>

            <div class="mb-1">
              <label for="email" class="block text-gray-700 text-sm">Email</label>
              <input type="email" name="email" id="email" value="{{ $user->email }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
            </div>

            <div class="mb-1 relative">
  <label for="password" class="block text-gray-700 text-sm">Password</label>
  <div class="relative">
    <input type="password" name="password" value="{{ old('password') }}" id="password"
      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
      required>
    <span id="toggle-password" class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
      <i class="fa-solid fa-eye-slash text-gray-500"></i>
    </span>
  </div>
  <small class="text-gray-500">Kosongkan jika tidak ingin mengganti password</small>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const toggleIcon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', function () {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text'; // Ubah input menjadi teks (password terlihat)
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password'; // Ubah input kembali menjadi password (disembunyikan)
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      }
    });
  });
</script>


            <div class="mb-3">
              <label for="position" class="block text-gray-700 text-sm">Posisi</label>
              <select name="position" id="position"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
                <option value="Super Admin" {{ $user->position == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="Admin" {{ $user->position == 'Admin' ? 'selected' : '' }}>Admin</option>
              
              </select>
            </div>

            <div class="mb-1">
              <label for="photo" class="block text-gray-700 text-sm">Photo</label>
              <input type="file" name="photo" id="photo"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
              @if ($user->photo)
                <img src="{{ asset('images/' . $user->photo) }}" alt="{{ $user->name }}" class="h-32 w-32 mt-2 rounded-full object-cover">
              @endif
            </div>

            

            <div class="mb-3">
              <label for="role" class="block text-gray-700 text-sm">Role</label>
              <select name="role" id="role"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <button
            class="w-full inline-block middle none center mr-3 rounded-lg border border-green-500 bg-green-500 py-2.5 px-4 font-sans text-xs font-bold uppercase text-gray-800 transition-all focus:ring focus:ring-green-200 active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:bg-green-700"
            data-ripple-light="true">
            <i class="fa-solid fa-check"></i><span class="m-1">Update data</span>
          </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
