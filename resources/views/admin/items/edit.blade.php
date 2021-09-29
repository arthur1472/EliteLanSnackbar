<x-app-layout>
    <div class="max-w-2xl mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-0">
        <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl">Product wijzigen</h1>
        <div class="mt-10">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{route('admin.items.update', ['item' => $item])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                                    <input type="text" value="{{$item->name}}" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Omschrijving</label>
                                    <textarea id="description" name="description" rows="3" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{$item->description}}</textarea>
                                </div>
                                <div class="col-span-6">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Prijs</label>
                                    <input type="number" value="{{$item->price}}" name="price" id="price" step="any" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6">
                                    <label for="active" class="block text-sm font-medium text-gray-700">Actief</label>
                                    <input type="checkbox" @if($item->active) checked @endif name="active" id="active" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6">
                                    <label for="item_type" class="block text-sm font-medium text-gray-700">Categorie</label>
                                    <select id="item_type" name="item_type">
                                        @foreach($itemTypes as $itemType)
                                            <option @if($item->item_type_id === $itemType->id) selected @endif value="{{$itemType->id}}">{{$itemType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Opslaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
