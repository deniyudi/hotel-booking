@extends('../layouts/main')

@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col overflow-x-hidden pb-[122px] relative">
    {{-- <div class="w-full h-[165px] absolute top-0 bg-[linear-gradient(244.6deg,_#7545FB_14.17%,_#2A3FCC_92.43%)]">
    </div> --}}
    <div class="relative z-10 px-[18px] flex flex-col gap-6 mt-[60px]">
      <div class="top-menu flex justify-between items-center">
        <a href="{{ route('frontend.hotels.details', $hotel->slug) }}" class="">
          <div class="w-[42px] h-[42px] flex shrink-0">
            <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
          </div>
        </a>
        <p class="font-semibold text-lg leading-[28px] text-center">Select Room Type</span></p>
        <div class="dummy-spacer w-[42px] h-[42px] flex shrink-0">
        </div>
      </div>
      <div id="result" class="result-card-container flex flex-col gap-[18px]">

        @forelse ($hotel->rooms as $room)
          <div class="card-result  mb-4 overflow-hidden flex flex-col">
            <div class="thumbnail-container rounded-xl w-full aspect-[360/140] overflow-hidden flex shrink-0">
              <img src="{{ $room->photo }}" class="object-cover w-full h-full" alt="thumbnail">
            </div>
            <div class="content-container flex flex-col gap-2">
              <div class="details-container flex flex-col p-2 gap-[6px] ">
                <p class="hotel-name font-medium text-xl mt-2">{{ $room->name }}</p>
                <p class="font-medium text-sm leading-[21px] text-[#757C98]">Max. {{ $room->total_people }} Adult
                  /Room
                </p>
                {{-- <div class="badge flex items-center gap-3">
                  <div class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/location-grey.svg') }}" alt="icon">
                  </div>
                  <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $room->hotel->name }} -
                    {{ $room->hotel->city->name }}, {{ $room->hotel->country->name }}</p>
                </div> --}}
                <div class="flex gap-4 pb-0 mt-3">
                  @foreach ($room->facilities->take(3) as $facility)
                    <div class="flex items-center gap-1">
                      <div class="flex shrink-0">
                        <img src="{{ asset('assets/images/icons/wifi-square-grey.svg') }}" alt="icon">
                      </div>
                      <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $facility->name }}</p>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="price-container flex items-center justify-between">
                <div class="total-price flex gap-[2px] items-center">
                  <p class="text-[#000] font-semibold text-lg leading-[27px]">
                    Rp {{ number_format($room->price, 0, ',', '.') }}
                  </p>
                  <p class="text-[#757C98] font-semibold text-xs leading-[18px]">/night</p>
                </div>
                <form method="GET"
                  action="{{ route('frontend.hotels.rooms.details', ['hotel' => $hotel->slug, 'hotel_room_slug' => $room->slug]) }}">
                  <button type="submit"
                    class="w-[138px] h-9 bg-[#4041DA] rounded-full
                     text-nowrap text-white font-semibold text-sm leading-[21px] flex items-center justify-center">Book
                    Now</button>
                </form>

              </div>
            </div>
          </div>

          {{-- <div class="card-result bg-white rounded-xl overflow-hidden flex flex-col">
            <div class="thumbnail-container w-full aspect-[357/160] overflow-hidden flex shrink-0">
              <img src="{{ Storage::url($room->photo) }}" class="object-cover w-full h-full" alt="thumbnail">
            </div>
            <div class="content-container flex flex-col p-4 gap-4">
              <div class="title-container flex flex-col gap-[2px]">
                <p class="font-semibold">{{ $room->name }}</p>
                <p class="font-medium text-sm leading-[21px] text-[#757C98]">Max. {{ $room->total_people }} Adult /Room
                </p>
              </div>
              <div class="facilities-container rounded-xl border border-[#DCDFE6] overflow-hidden">

                <div class="w-full bg-[#F93F6C] p-[10px]">
                  <p class="text-center font-semibold text-xs leading-[18px] text-white">Refund & Reschedule not allowed
                  </p>
                </div>
              </div>
              <div class="price-container flex items-center justify-between">
                <div class="total-price flex flex-col gap-[2px]">
                  <p class="text-[#54A917] font-semibold text-lg leading-[27px]">Rp
                    {{ number_format($room->price, 0, ',', '.') }}</p>
                  <p class="text-[#757C98] font-semibold text-xs leading-[18px]">/night</p>
                </div>
                <form method="GET"
                  action="{{ route('frontend.hotels.rooms.details', ['hotel' => $hotel->slug, 'hotel_room_slug' => $room->slug]) }}">
                  <button type="submit"
                    class="w-[138px] h-[48px] bg-[#4041DA] p-[12px_24px] rounded-full text-nowrap text-white font-semibold text-sm leading-[21px] flex items-center justify-center">Choose</button>
                </form>

              </div>
            </div>
          </div> --}}
        @empty
          <p>Belom ada kamar untuk saat ini</p>
        @endforelse
      </div>
    </div>
  </section>
@endsection
