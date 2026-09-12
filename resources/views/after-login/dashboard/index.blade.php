<!-- after-login/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
  @include('components.header')
  @include('components.sidebar')
  @include('components.footer')

  <div class="ml-auto mb-2 lg:w-[75%] xl:w-[80%] 2xl:w-[82%]">
    <div class="px-6 2xl:container">
      {{-- Dashboard Header --}}
      <div class="flex justify-between items-center py-4">
        <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
      </div>

      {{-- Summary Cards --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-4">
        @if (Auth::user()->role != 0)
          <div class="bg-green-300 p-4 rounded-lg shadow-md">
            <h2 class="text-sm font-semibold">Total Users</h2>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
            <p class="text-sm text-gray-500">User Aktif</p>
          </div>
        @endif
        <div class="bg-green-300 p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold">Pengunjung Masuk</h2>
          <p class="text-2xl font-bold">{{ $guestCount }}</p>
          <p class="text-sm text-gray-500">Bulan Ini</p>
        </div>
        <div class="bg-green-300 p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold">Rating Ulasan</h2>
          <p class="text-2xl font-bold">
            @if (isset($averageRating))
              {{ $averageRating }}/5 &#9733;
            @else
              No ratings yet
            @endif
          </p>
          <p class="text-sm text-gray-500">Bulan Ini</p>
        </div>
        <div class="bg-green-300 p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold">Gender Tamu </h2>
          <p class="text-2xl font-bold">{{ $maleCount }} Pria & {{ $femaleCount }} Wanita</p>
          <p class="text-sm text-gray-500">Persebaran</p>
        </div>
      </div>

      {{-- Charts Section --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold mb-2">Jumlah Pengunjung Masuk Per Bulan</h2>
          <div class="h-64">
            {{-- Placeholder for Chart --}}
            <canvas id="monthlySalesChart"></canvas>
          </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold mb-2">Rata Rata Skor Kepuasan Pengunjung Per Bulan</h2>
          <div class="h-64">
            <canvas id="averageSatisfactionChart"></canvas>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 mb-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold mb-2">Rata-rata Tujuan Pengunjung</h2>
          <div class="h-64 w-full">
            {{-- Placeholder for Chart --}}
            <canvas id="keperluanChart" style="height: 400px; width: 2000px;"></canvas>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 mb-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
          <h2 class="text-sm font-semibold mb-2">Rata-rata Umur Pengunjung</h2>
          <div class="h-64 w-full">
            {{-- Placeholder for Chart --}}
            <canvas id="ageChart" style="height: 400px; width: 2000px;"></canvas>
          </div>
        </div>
      </div>

      {{-- Recent Activities --}}
      @if (Auth::user()->role != 0)
        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
          <h2 class="text-sm font-semibold mb-4">Aktivitas Terbaru</h2>
          <ul class="divide-y divide-gray-200">
            @forelse ($activities as $activity)
              <li class="py-2">
                <p class="text-sm text-gray-600">
                  @if ($activity->causer)
                    <span class="font-semibold">{{ $activity->causer->name }}</span>
                  @endif
                  {{ $activity->description }}
                </p>
                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
              </li>
            @empty
              <li class="py-2">
                <p class="text-sm text-gray-600">No recent activities found.</p>
              </li>
            @endforelse
          </ul>
        </div>
      @endif
    </div>
  </div>
@endsection
