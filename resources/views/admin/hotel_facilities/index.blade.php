<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-row justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage Hotel Facilities') }}
      </h2>
      <a href="{{ route('admin.hotel_facilities.create') }}"
        class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
        Add New
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
        @forelse ($hotel_facilities as $facility)
          <div class="item-card flex flex-row justify-between items-center">
            <div class="flex flex-row items-center gap-x-3">
              <div class="flex flex-col">
                <p class="text-slate-500 text-sm">Icon</p>
                <i class="fa-solid {{ $facility->icon }} fa-lg"></i>
              </div>
            </div>
            <div class="flex flex-row items-center gap-x-3">
              <div class="flex flex-col">
                <p class="text-slate-500 text-sm">Name</p>
                <h3 class="text-indigo-950 text-xl font-bold">
                  {{ $facility->name }}
                </h3>
              </div>
            </div>
            <div class="hidden md:flex flex-col">
              <p class="text-slate-500 text-sm">Description</p>
              <h3 class="text-indigo-950 text-xl font-bold">
                {{ $facility->description }}
              </h3>
            </div>
            <div class="hidden md:flex flex-row items-center gap-x-3">
              {{-- lihat parameter di controller edit --}}
              <a href="{{ route('admin.hotel_facilities.edit', $facility) }}"
                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Edit
              </a>
              <form action="{{ route('admin.hotel_facilities.destroy', $facility) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                  Delete
                </button>
              </form>
            </div>
          </div>
        @empty
          <p>belum ada data terbaru</p>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
