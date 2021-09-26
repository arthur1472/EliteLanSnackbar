<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-0">
            <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl">Welkom</h1>

            <div class="mt-8">
                <div class="border-t border-b border-gray-200 divide-y divide-gray-200">
                    <div class="bg-white shadow sm:rounded-lg mt-12 border">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Wat is je naam?
                            </h3>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p>
                                    Gebruik graag je echte naam ipv game tag.
                                </p>
                            </div>
                            <form method="POST" action="{{route('first-time.update')}}" class="mt-5 sm:flex sm:items-center">
                                @csrf
                                <div class="w-full sm:max-w-xs">
                                    <label for="name" class="sr-only">Naam</label>
                                    <input type="text" value="{{$name}}" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com">
                                </div>
                                <button type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Opslaan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
