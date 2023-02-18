<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Producten') }}
        </h2>
    </x-slot>

    <div class="bg-white">
        @foreach($itemTypes as $itemType)
            @if($itemType->items()->count() > 0)
                <div class="max-w-2xl mx-auto py-6 px-4 sm:py-6 sm:px-6 lg:max-w-7xl lg:px-8">
                    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{$itemType->name}}</h2>

                    <div class="mt-2 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($itemType->items as $item)
                            <div class="group relative">
                                @if(config('snackbar.show_image'))
                                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                        <img src="{{$item->image_url}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                                    </div>
                                @endif
                                <div class="mt-2 flex justify-between">
                                    <div>
                                        <h3 class="text-md text-gray-700">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                {{$item->name}}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">{{$item->description}}</p>
                                    </div>
                                    <p class="text-md font-medium text-gray-900">{{$item->price}}</p>
                                </div>

                                <div class="mt-4">
                                    @if($item->hasToppings())
                                        <a href="{{route('items.configure', ['item' => $item->id])}}" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200">Configureer</a>
                                    @else
                                        <form action="{{route('carts.add_item')}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$item->id}}" name="itemId">
                                            <button type="submit" class="w-full relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200">Toevoegen</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="max-w-2xl mx-auto py-6 px-4 sm:py-6 sm:px-6 lg:max-w-7xl lg:px-8">
        <ul role="list" class="mt-8 mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="w-full flex items-center justify-between p-6 space-x-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 text-2xl font-bold font-medium truncate">Sauzen</h3>
                        </div>
                        <p class="mt-2 text-gray-900 text-md truncate">Mayonaise</p>
                        <p class="mt-1 text-gray-900 text-md truncate">Ketchup</p>
                        <p class="mt-1 text-gray-900 text-md truncate">Curry</p>
                        <p class="mt-1 text-gray-900 text-md truncate">Sriracha</p>
                        <p class="mt-1 text-gray-900 text-md truncate">Chilisaus</p>
                        <p class="mt-1 text-gray-900 text-md truncate">Knoflooksaus</p>
                    </div>
                </div>
            </li>
            <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="w-full flex items-center justify-between p-6 space-x-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 text-2xl font-bold font-medium truncate">Openingstijden</h3>
                        </div>
                        <p class="mt-2 text-gray-900 font-bold text-base">Vrijdag</p>
                        <p class="mt-1 text-gray-900 text-md">12-00-16:00 (Snacks, Tosti's, Broodjes)</p>
                        <p class="mt-1 text-gray-900 text-md">21:00-23:30 (Snacks, Fingerfood)</p>

                        <p class="mt-4 text-gray-900 font-bold text-base">Zaterdag</p>
                        <p class="mt-1 text-gray-900 text-md">10:00-11:00 (Tosti's, Broodjes)</p>
                        <p class="mt-1 text-gray-900 text-md">12:00-13:30 (Snacks, Tosti's, Broodjes)</p>
                        <p class="mt-1 text-gray-900 text-md">15:00-16:00 (Snacks)</p>
                        <p class="mt-1 text-gray-900 text-md">21:00-23:30 (Snacks, Fingerfood)</p>

                        <p class="mt-4 text-gray-900 font-bold text-base">Zondag</p>
                        <p class="mt-1 text-gray-900 text-md">09:00-10:30 (Tosti's, Broodjes)</p>
                        <p class="mt-1 text-gray-900 text-md">11:00-13:00 DOUBLE HAPPY HOUR!! ALLES VOOR 50 CENT!</p>
                    </div>
                </div>
            </li>
            <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="w-full flex items-center justify-between p-6 space-x-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 text-2xl font-bold font-bold font-medium truncate">Avondeten</h3>
                        </div>
                        <p class="mt-2 text-gray-900 text-md truncate">Vrijdag-Zaterdag</p>
                        <p class="mt-1 text-gray-900 text-md truncate">18:00-19:00</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</x-app-layout>
