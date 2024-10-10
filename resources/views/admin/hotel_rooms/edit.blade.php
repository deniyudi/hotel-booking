<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Hotel Room') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

        <div class="item-card flex flex-row justify-between items-center">
          <div class="flex flex-row items-center gap-x-3">
            <img src="{{ $hotelRoom->photo }}" alt=""
              class="rounded-2xl object-cover w-[120px] h-[90px]">
            <div class="flex flex-col">
              <h3 class="text-indigo-950 text-xl font-bold">
                {{ $hotelRoom->name }}
              </h3>
              <p class="text-slate-500 text-sm">
                {{ $hotel->city->name }}, {{ $hotel->country->name }}
              </p>
            </div>
          </div>
        </div>

        <hr class="my-5">

        <form method="POST" action="{{ route('admin.hotel_rooms.update', $hotelRoom) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" value="{{ $hotelRoom->name }}" class="block mt-1 w-full" type="text"
              name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="photo" :value="__('Photo')" />
            <img src="{{ $hotelRoom->photo }}" alt=""
              class="rounded-2xl object-cover w-[120px] h-[90px]">
            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" autofocus
              autocomplete="photo" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" value="{{ $hotelRoom->price }}" class="block mt-1 w-full" type="number"
              name="price" autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="total_people" :value="__('Total People')" />
            <x-text-input id="total_people" value="{{ $hotelRoom->total_people }}" class="block mt-1 w-full"
              type="number" name="total_people" autofocus autocomplete="total_people" />
            <x-input-error :messages="$errors->get('total_people')" class="mt-2" />
          </div>

          <div class="mt-4" id="facilities-container">
            <x-input-label :value="__('Facilities')" />
            @foreach ($hotelRoom->facilities as $facility)
              <div class="flex items-center mb-2">
                <select name="facilities[]" class="py-3 rounded-lg pl-3 border border-slate-300 w-full" required>
                  <option value="" disabled>Choose Facility</option>
                  @foreach ($facilities as $fac)
                    <option value="{{ $fac->id }}" {{ $facility->id === $fac->id ? 'selected' : '' }}>
                      {{ $fac->name }}
                    </option>
                  @endforeach
                </select>
                <button type="button" class="ml-2 text-red-500" onclick="removeFacility(this)">Remove</button>
              </div>
            @endforeach
          </div>

          <button type="button" id="add-facility" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
            Add Another Facility
          </button>

          <div class="flex items-center justify-end mt-4">
            <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
              Edit Hotel Room
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    const selectedFacilities = new Set();

    document.querySelectorAll('select[name="facilities[]"]').forEach(select => {
      if (select.value) {
        selectedFacilities.add(select.value); // Menambahkan fasilitas yang sudah ada ke dalam Set
      }
    });

    document.getElementById('add-facility').addEventListener('click', function() {
      const facilitiesContainer = document.getElementById('facilities-container');
      const newFacilityDiv = document.createElement('div');
      newFacilityDiv.className = 'flex items-center mb-2';

      const newSelect = document.createElement('select');
      newSelect.name = 'facilities[]';
      newSelect.className = 'py-3 rounded-lg pl-3 border border-slate-300 w-full';
      newSelect.required = true;

      const placeholderOption = document.createElement('option');
      placeholderOption.value = '';
      placeholderOption.textContent = 'Choose Facility';
      placeholderOption.disabled = true; // Buat tidak dapat dipilih
      placeholderOption.selected = true;
      newSelect.appendChild(placeholderOption);

      const facilities = @json($facilities);
      facilities.forEach(facility => {
        const option = document.createElement('option');
        option.value = facility.id;
        option.textContent = facility.name;
        newSelect.appendChild(option);
      });

      newSelect.addEventListener('change', function() {
        const selectedValue = newSelect.value;
        if (selectedValue && selectedFacilities.has(selectedValue)) {
          alert('This facility is already selected. Please choose a different facility.');
          newSelect.value = ''; // Reset pemilihan
        } else if (selectedValue) {
          selectedFacilities.add(selectedValue);
        }
      });

      newFacilityDiv.appendChild(newSelect);

      const removeButton = document.createElement('button');
      removeButton.type = 'button';
      removeButton.className = 'ml-2 text-red-500'; // Tidak ada lebar tetap
      removeButton.textContent = 'Remove';
      removeButton.onclick = function() {
        removeFacility(removeButton);
      };

      newFacilityDiv.appendChild(removeButton);
      facilitiesContainer.appendChild(newFacilityDiv);
    });

    function removeFacility(button) {
      const facilityDiv = button.parentElement;
      const select = facilityDiv.querySelector('select');
      if (select.value) {
        selectedFacilities.delete(select.value); // Menghapus dari fasilitas yang dipilih
      }
      facilityDiv.remove();
    }
  </script>
</x-app-layout>
