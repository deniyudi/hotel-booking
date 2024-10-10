@extends('../layouts/main')

@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-[#F8F8F8] overflow-x-hidden pb-[122px] relative">
    {{-- <div class="w-full h-[203px] absolute top-0 bg-[linear-gradient(244.6deg,_#7545FB_14.17%,_#2A3FCC_92.43%)]">
    </div> --}}
    <div class="relative z-10 px-[18px] flex flex-col gap-6 flex-1">
      {{-- <div class="top-menu flex justify-between items-center">
        <div class="dummy-spacer w-[42px] h-[42px] flex shrink-0">
        </div>
        <p class="font-semibold text-lg leading-[28px] text-white text-center">Rencent Activity</span></p>
        <div class="dummy-spacer w-[42px] h-[42px] flex shrink-0">
        </div>
      </div> --}}
      <div class="flex justify-between w-full max-w-[640px] mt-3 mb-3 items-center">
        <div class="flex flex-col">
          <p class="text-2xl font-semibold">Activity</p>
        </div>
      </div>

      {{-- Tabs  --}}

      <div class="tabs-section">
        <div class="flex flex-row gap-4">
          <button class="tab-item flex w-full justify-center font-semibold p-[12px_24px] rounded-lg h-12"
            style="background-color: #4041DA17; color: #4041DA; border: none;" data-tab="waiting"
            id="waiting-tab">Waiting</button>
          <button class="tab-item flex w-full justify-center font-semibold p-[12px_24px] rounded-lg h-12"
            style="background-color: #4041DA17; color: #4041DA; border: none;" data-tab="success"
            id="success-tab">Success</button>
        </div>
      </div>



      <div id="Activity-list" class="result-card-container flex flex-col gap-[18px]">

        <div class="tab-content" id="waiting-content">
          @forelse ($mybookings->where('is_paid', false) as $booking)
            <div class="activity-result bg-white rounded-xl overflow-hidden flex flex-col gap-4 mb-4">
              <div class="flex items-center justify-between p-4 pb-0">
                <div class="flex flex-col gap-[2px]">
                  <p class="font-semibold">Waiting for Confirmation</p>
                  <p class="font-medium text-xs leading-[18px] text-[#757C98]">Order ID : {{ $booking->id }}</p>
                </div>
                <p
                  class="font-semibold text-xs leading-[18px] text-[#F8F8F8] rounded-full bg-[#F98D3F] p-[6px_12px] w-fit">
                  Pending</p>
              </div>
              <hr class="border-[#DCDFE6]">
              <div class="hotel-details flex gap-3 px-4">
                <div class="thumbnail-container w-[160px] h-[120px] flex shrink-0 rounded-xl overflow-hidden">
                  <img src="{{ $booking->room->photo }}" class="object-cover w-full h-full" alt="thumbnail">
                </div>
                <div class="hotel-info flex flex-col gap-[3px] h-fit">
                  <p class="font-semibold">{{ $booking->room->name }}</p>
                  <p class="font-medium text-sm leading-[21px] text-[#757C98]">
                    {{ $booking->hotel->name }}
                  </p>
                  <div class="badge flex items-center gap-3">
                    <div class="flex items-center gap-1">
                      <div class="flex shrink-0 w-4 h-4">
                        <img src="{{ asset('assets/images/icons/location-grey.svg') }}" alt="icon">
                      </div>
                      <p class="font-medium text-sm leading-[21px] text-[#757C98]">
                        {{ $booking->hotel->city->name }}, {{ $booking->hotel->country->name }}
                      </p>
                    </div>
                    <div class="flex items-center gap-1">
                      <div class="ratings-container flex items-center gap-[2px]">
                        <div class="star-container flex items-center">
                          <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                            <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                          </div>
                        </div>
                        <p class="rating font-medium text-sm leading-[21px]">{{ $booking->hotel->star_level }}.0</p>
                        <p class="reviewers font-thin text-sm leading-[21px] text-[#757C98]">(229)</p>
                      </div>
                    </div>
                  </div>
                  <div class="total-price flex gap-[2px] items-center mt-2">
                    <p class="text-[#000] font-semibold text-lg leading-[27px]">
                      Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                    </p>
                  </div>
                </div>
              </div>
              <a href="{{ route('frontend.booking_details', $booking) }}"
                class="flex items-center justify-center font-semibold p-[12px_24px] rounded-lg h-12 bg-[#4041DA17] text-[#4041DA] m-4 mt-0">Booking
                Details</a>
            </div>
          @empty
            <p>No Waiting Bookings</p>
          @endforelse
        </div>

        <div class="tab-content hidden" id="success-content">
          @forelse ($mybookings->where('is_paid', true) as $booking)
            <div class="activity-result bg-white rounded-xl overflow-hidden flex flex-col gap-4 mb-4">
              <div class="flex items-center justify-between p-4 pb-0">
                <div class="flex flex-col gap-[2px]">
                  <p class="font-semibold">Booking Success</p>
                  <p class="font-medium text-xs leading-[18px] text-[#757C98]">Order ID : {{ $booking->id }}</p>
                </div>
                <p
                  class="font-semibold text-xs leading-[18px] text-[#F8F8F8] rounded-full bg-[#54A917] p-[6px_12px] w-fit">
                  Success</p>
              </div>
              <hr class="border-[#DCDFE6]">
              <div class="hotel-details flex gap-3 px-4">
                <div class="thumbnail-container w-[160px] h-[120px] flex shrink-0 rounded-xl overflow-hidden">
                  <img src="{{ $booking->room->photo }}" class="object-cover w-full h-full" alt="thumbnail">
                </div>
                <div class="hotel-info flex flex-col gap-[3px] h-fit">
                  <p class="font-semibold">{{ $booking->room->name }}</p>
                  <p class="font-medium text-sm leading-[21px] text-[#757C98]">
                    {{ $booking->hotel->name }}
                  </p>
                  <div class="badge flex items-center gap-3">
                    <div class="flex items-center gap-1">
                      <div class="flex shrink-0 w-4 h-4">
                        <img src="{{ asset('assets/images/icons/location-grey.svg') }}" alt="icon">
                      </div>
                      <p class="font-medium text-sm leading-[21px] text-[#757C98]">
                        {{ $booking->hotel->city->name }}, {{ $booking->hotel->country->name }}
                      </p>
                    </div>
                    <div class="flex items-center gap-1">
                      <div class="ratings-container flex items-center gap-[2px]">
                        <div class="star-container flex items-center">
                          <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                            <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                          </div>
                        </div>
                        <p class="rating font-medium text-sm leading-[21px]">{{ $booking->hotel->star_level }}.0</p>
                        <p class="reviewers font-thin text-sm leading-[21px] text-[#757C98]">(229)</p>
                      </div>
                    </div>
                  </div>
                  <div class="total-price flex gap-[2px] items-center mt-2">
                    <p class="text-[#000] font-semibold text-lg leading-[27px]">
                      Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                    </p>
                  </div>
                </div>
              </div>
              <a href="{{ route('frontend.booking_details', $booking) }}"
                class="flex items-center justify-center font-semibold p-[12px_24px] rounded-lg h-12 bg-[#4041DA17] text-[#4041DA] m-4 mt-0">Booking
                Details</a>
            </div>
          @empty
            <p>No Success Booking</p>
          @endforelse
        </div>
      </div>
    </div>
    <div id="Menu-bar" class="fixed bottom-[24px] px-[18px] max-w-[640px] w-full z-30">
      <div
        class="bg-white p-[14px_12px] rounded-full flex items-center justify-center gap-8 shadow-[0_8px_30px_0_#0A093212]">
        <a href="{{ route('frontend.index') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="{{ asset('assets/images/icons/home-nonactive.svg') }}" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-semibold text-[#757C98]">Home</p>
          </div>
        </a>
        <a href="{{ route('frontend.search') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="{{ asset('assets/images/icons/search-nonactive.svg') }}" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#757C98]">Search</p>
          </div>
        </a>
        <a href="{{ route('frontend.my-bookings') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="{{ asset('assets/images/icons/activity-active.svg') }}" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#4041DA]">Activity</p>
          </div>
        </a>
        <a href="{{ route('frontend.settings') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="{{ asset('assets/images/icons/settings-nonactive.svg') }}" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#757C98]">Settings</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  @push('after-scripts')
    <script>
      document.querySelectorAll('.tab-item').forEach(item => {
        item.addEventListener('click', function() {
          // Hapus gaya aktif dari semua tab
          document.querySelectorAll('.tab-item').forEach(tab => {
            tab.style.backgroundColor = '#4041DA17'; // Warna latar belakang untuk tab tidak aktif
            tab.style.color = '#4041DA'; // Warna teks untuk tab tidak aktif
          });

          // Sembunyikan semua konten tab
          document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');

          // Tambahkan gaya aktif pada tab yang diklik
          this.style.backgroundColor = '#4041DA'; // Warna latar belakang untuk tab aktif
          this.style.color = 'white'; // Warna teks untuk tab aktif

          // Tampilkan konten tab yang sesuai
          document.getElementById(this.getAttribute('data-tab') + '-content').style.display = 'block';
        });
      });

      // Set initial active tab
      const initialTab = document.getElementById('waiting-tab');
      initialTab.style.backgroundColor = '#4041DA'; // Warna latar belakang untuk tab aktif
      initialTab.style.color = 'white'; // Warna teks untuk tab aktif
      document.getElementById('waiting-content').style.display = 'block';
    </script>
  @endpush
@endSection
