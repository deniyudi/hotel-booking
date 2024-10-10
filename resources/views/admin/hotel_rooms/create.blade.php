<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('New Hotel Room') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

        <div class="item-card flex flex-row justify-between items-center">
          <div class="flex flex-row items-center gap-x-3">
            <img src="{{ $hotel->thumbnail }}" alt=""
              class="rounded-2xl object-cover w-[120px] h-[90px]">
            <div class="flex flex-col">
              <h3 class="text-indigo-950 text-xl font-bold">
                {{ $hotel->name }}
              </h3>
              <p class="text-slate-500 text-sm">
                {{ $hotel->city->name }}, {{ $hotel->country->name }}
              </p>
            </div>
          </div>
        </div>

        <hr class="my-5">

        <form method="POST" action="{{ route('admin.hotel_rooms.store', $hotel->slug) }}"
          enctype="multipart/form-data">
          @csrf

          <!-- Field Input -->
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
              required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="photo" :value="__('Photo')" />
            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" required autofocus
              autocomplete="photo" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')"
              required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="total_people" :value="__('Total People')" />
            <x-text-input id="total_people" class="block mt-1 w-full" type="number" name="total_people"
              :value="old('total_people')" required autofocus autocomplete="total_people" />
            <x-input-error :messages="$errors->get('total_people')" class="mt-2" />
          </div>

          <div class="mt-4" id="facilities-container">
            <x-input-label :value="__('Facilities')" />
            <div class="flex items-center mb-2">
              <select name="facilities[]" class="py-3 rounded-lg pl-3 mb-2 w-full border border-slate-300" required>
                <option value="" disabled selected>Choose Facility</option> <!-- Placeholder -->
                @foreach ($facilities as $facility)
                  <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                @endforeach
              </select>
              <button type="button" class="ml-2 text-red-500" onclick="removeFacility(this)">Remove</button>
            </div>
            <x-input-error :messages="$errors->get('facilities')" class="mt-2" />
          </div>
          <button type="button" id="add-facility" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
            Add Another Facility
          </button>

          <div class="flex items-center justify-end mt-4">
            <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full ml-4">
              Add New Hotel Room
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    // Daftar fasilitas yang sudah dipilih
    let selectedFacilities = [];

    document.getElementById('add-facility').addEventListener('click', function() {
        const facilitiesContainer = document.getElementById('facilities-container');

        // Create a wrapper for the new facility select and remove button
        const facilityWrapper = document.createElement('div');
        facilityWrapper.className = 'flex items-center mb-2';

        const newSelect = document.createElement('select');
        newSelect.name = 'facilities[]';
        newSelect.className = 'py-3 rounded-lg mb-2 pl-3 w-full border border-slate-300';
        newSelect.required = true;

        // Tambahkan placeholder
        const placeholderOption = document.createElement('option');
        placeholderOption.value = "";
        placeholderOption.textContent = "Choose Facility";
        placeholderOption.disabled = true;
        placeholderOption.selected = true;
        newSelect.appendChild(placeholderOption);

        // Inisialisasi opsi
        const facilities = @json($facilities);
        facilities.forEach(facility => {
            const option = document.createElement('option');
            option.value = facility.id;
            option.textContent = facility.name;
            newSelect.appendChild(option);
        });

        // Cek duplikat saat mengubah pilihan
        newSelect.addEventListener('change', function() {
            const selectedValue = newSelect.value;

            // Cek apakah fasilitas sudah dipilih sebelumnya
            if (selectedValue && selectedFacilities.includes(selectedValue)) {
                alert('This facility has already been selected.');
                newSelect.value = ""; // Reset pilihan jika duplikat
            } else if (selectedValue) {
                selectedFacilities.push(selectedValue); // Tambah fasilitas ke daftar
            }
        });

        // Create remove button for the select
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'ml-2 text-red-500';
        removeButton.textContent = 'Remove';
        removeButton.onclick = function() {
            const index = selectedFacilities.indexOf(newSelect.value);
            if (index > -1) {
                selectedFacilities.splice(index, 1); // Remove from the selected facilities
            }
            facilityWrapper.remove(); // Remove the select box and button from the DOM
        };

        facilityWrapper.appendChild(newSelect);
        facilityWrapper.appendChild(removeButton);
        facilitiesContainer.appendChild(facilityWrapper);
    });
  </script>

</x-app-layout>
