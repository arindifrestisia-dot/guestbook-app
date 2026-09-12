@extends('layouts.app')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')
  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    {{-- Start here --}}
    <div class="px-6 2xl:container">
      @include('after-login.users.sub-header')
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-XS rtl:text-right text-slate-100">
          <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
              <th scope="col" class="px-2 py-3">
                No.
              </th>
              <th scope="col" class="px-2 py-3">
                Nama
              </th>
              <th scope="col" class="px-2 py-3">
                Username
              </th>
              <th scope="col" class="px-2 py-3">
                Email
              </th>
              <th scope="col" class="px-2 py-3">
                Position
              </th>
              
              <th scope="col" class="px-2 py-3">
                Role
              </th>
              <th scope="col" class="px-2 py-3">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $index => $user)
              <tr class="bg-white border-b hover:bg-green-50 dark:hover:bg-green-50">
                <td class="px-6 py-2 text-sm text-gray-900">
                  {{ $index + 1 }}
                </td>
                <td class="px-3 py-2 text-sm font-medium text-gray-900 whitespace-nowrap">
                  {{ $user->name }}
                </td>
                <td class="px-3 py-2 text-sm font-medium text-gray-900">
                  {{ $user->username }}
                </td>
                <td class="px-3 py-2 text-sm font-medium text-gray-900">
                  {{ $user->email }}
                </td>
                <td class="px-3 py-2 text-sm font-medium text-gray-900">
                  {{ $user->position }}
                </td>
                <td class="px-3 py-2 text-sm font-medium text-gray-900">
                {{ $user->role == 0 ? 'Admin' : 'Super Admin' }}
                </td>
                
                {{-- info --}}
                <td class="px-3 py-2 text-sm font-medium text-gray-900 whitespace-nowrap">
                  <a href="{{ route('users.detail', $user->id) }}"
                    class="info-btn inline-flex items-center justify-center h-7 w-7 rounded-full bg-green-400 hover:bg-green-600">
                    <i class="fa-solid fa-exclamation text-white"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
