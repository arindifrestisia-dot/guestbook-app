@extends('layouts.app')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')

  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    <div class="px-6 2xl:container">
      <h1 class="text-base font-extrabold mb-6 text-gray-800"><span class="mr-6 cursor-pointer" id="back-button"><i
            class="fa-solid fa-chevron-left"></i></span>Detail Pengguna</h1>
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="flex p-6">
          @if ($user->photo)
            <div class="mr-6">
              <img src="{{ asset('images/' . $user->photo) }}" alt="{{ $user->name }}"
                class="h-32 w-32 rounded-full object-cover shadow-md border border-gray-200">
            </div>
          @endif
          <div class="flex-grow">
            <div class="text-2xl leading-6 font-semibold text-gray-900 mb-2">{{ $user->name }}</div>
            <div class="text-sm font-medium text-gray-500 mb-8">{{ $user->position }}</div>
            <div class="border-t border-gray-200">
              <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                  <dt class="text-sm font-medium text-gray-500">Username</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->username }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                  <dt class="text-sm font-medium text-gray-500">Email</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                </div>
                
              </dl>
              <div class="flex justify-start mt-6">
                <a href="{{ route('users.edit', $user->id) }}"
                  class="inline-block middle none center mr-3 rounded-lg border border-green-600 py-3 px-6 font-sans text-xs font-bold uppercase text-green-600 transition-all hover:opacity-75 focus:ring focus:ring-green-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                  data-ripple-light="true">
                  <i class="fa-regular fa-pen-to-square"></i><span class="m-1">Edit</span>
                </a>
                <a href="{{ route('users.destroy', $user->id) }}" method="POST" data-confirm-delete="true">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="middle none center mr-3 rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    <i class="fa-solid fa-trash"></i><span class="m-1">Hapus</span>
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
