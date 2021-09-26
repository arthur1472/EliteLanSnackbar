<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-0">
            <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl">Winkelwagen</h1>

            @if (session('productNames'))
                <div class="rounded-md bg-red-50 p-4 mt-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/x-circle -->
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                De volgende producten zijn niet meer beschikbaar en automatisch uit je winkelwagen verwijdert
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    @foreach(session('productNames') as $productName)
                                        <li>
                                            {{$productName}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-8">
                <section aria-labelledby="cart-heading">
                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        @foreach($cart->cartLines as $cartLine)
                            <li class="flex py-6">
                                @if(config('snackbar.show_image'))
                                    <div class="flex-shrink-0">
                                        <img src="{{$item->image_url}}" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                                    </div>
                                @endif

                                <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                    <div>
                                        <div class="flex justify-between">
                                            <h4 class="text-sm">
                                                <a href="{{route('items.index')}}" class="font-medium text-gray-700 hover:text-gray-800">
                                                    {{$cartLine->item->name}}
                                                </a>
                                            </h4>
                                            <p class="ml-4 text-sm font-medium text-gray-900">€{{number_format($cartLine->quantity * $cartLine->item->price,2)}}</p>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{$cartLine->item->description}}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            €{{number_format($cartLine->item->price,2)}} p.st.
                                        </p>
                                    </div>
                                    @if($cartLine->toppingModels)
                                        <div class="mt-4">
                                            @foreach($cartLine->toppingModels as $topping)
                                                <p class="mt-1 text-sm text-gray-500">
                                                    - {{$topping->name}}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="mt-4 flex-1 flex items-end justify-between">
                                        <p class="flex items-start text-sm text-gray-700 space-x-2">
                                            <form class="w-full" id="cart_line_{{$cartLine->id}}" method="post" action="{{route('carts.quantity', ['cart_line' => $cartLine->id])}}">
                                                @csrf
                                                <select onchange="document.getElementById('cart_line_{{$cartLine->id}}').submit()" id="quantity" name="quantity" class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    @for($i = 1; $i <= 20; $i++)
                                                        <option value="{{$i}}" @if($i === $cartLine->quantity) selected @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </p>
                                        <div class="ml-4">
                                            <form action="{{route('carts.delete', ['cart_line' => $cartLine->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                                    <span>Verwijder</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <form action="{{route('orders.store')}}" method="post">
                @csrf
                    <!-- Order summary -->
                    <section aria-labelledby="summary-heading" class="mt-10">
                        <h2 id="summary-heading" class="sr-only">Bestelling overzicht</h2>

                        <div>
                            <dl class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-base font-medium text-gray-900">
                                        Totaal
                                    </dt>
                                    <dd class="ml-4 text-base font-medium text-gray-900">
                                        €{{number_format($cart->price,2)}}
                                    </dd>
                                </div>
                            </dl>
                        </div>


                        @if($cart->cartLines->count() > 0)
                            <div class="border-t mt-10 pt-6">
                                <label for="note" class="block text-sm font-medium text-gray-700">Opmerking <span class="text-xs">(optioneel)</span></label>
                                <div class="mt-1">
                                    <textarea id="note" name="note" rows="3" class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></textarea>
                                </div>
                            </div>


                            <div class="mt-10">
                                <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Bestellen</button>
                            </div>
                        @endif

                        <div class="mt-6 text-sm text-center">
                            <p>
                                of <a href="{{route('items.index')}}" class="text-indigo-600 font-medium hover:text-indigo-500">Verder winkelen<span aria-hidden="true"> &rarr;</span></a>
                            </p>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
