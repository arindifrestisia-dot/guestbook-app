@extends('layouts.app')
@section('title', 'Add User Data')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')
  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">

    {{-- Start here --}}
    <div class="px-6 2xl:container">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-base font-bold mb-4"><span class="mr-6 cursor-pointer" id="back-button"><i
              class="fa-solid fa-chevron-left"></i></span>Tambah User Baru</h2>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-1">
              <label for="name" class="block text-gray-900 text-sm">Name</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-3 py-2 border text-sm border-gray-300 rounded-lg transition duration-300 focus:border-cyan-500 focus:bg-cyan-50 active:border-cyan-500"
                required>
            </div>

            <div class="mb-1">
              <label for="username" class="block text-gray-700 text-sm">Username</label>
              <input type="text" name="username" value="{{ old('username') }}" id="username"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
            </div>

            <div class="mb-1">
              <label for="email" class="block text-gray-700 text-sm">Email</label>
              <input type="email" name="email" value="{{ old('email') }}"id="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
            </div>

            <div class="mb-1">
              <label for="password" class="block text-gray-700 text-sm">Password</label>
              <input type="password" name="password" value="{{ old('password') }}"id="password"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50"
                required>
              <small class="text-gray-500">Minimal 8 karakter</small>
            </div>

            <div class="mb-3">
              <label for="position" class="block text-gray-700 text-sm">Posisi</label>
              <select name="position" value="{{ old('position') }}" id="position"
                class="w-full px-3 py-3 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
                <option value="manager">Manager</option>
                <option value="tm">Team Manager</option>
                <option value="staff">Staff</option>
                <option value="sekretaris">Sekretaris</option>
                <option value="relations officer">Relations Officer</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="role" class="block text-gray-700 text-sm">Role</label>
              <select name="role" id="role"
                class="w-full px-3 py-3 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
                <option value="0">Admin</option>
                <option value="1">Super Admin</option>
              </select>
            </div>
          </div>

            <div class="mb-1">
              <label for="photo" class="block text-gray-700 text-sm">Photo</label>
              <input type="file" name="photo" value="{{ old('photo') }}" id="photo"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition duration-300 focus:border-cyan-500 focus:bg-cyan-50">
              <small class="text-gray-500">Foto format JPG dan JPEG Max.2 MB</small>
            </div>

          <div class="mb-4 mt-4">
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
