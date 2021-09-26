<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Totale bestelling
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            71,897
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Afgeronde bestellingen
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            58.16%
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Avg. Click Rate
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            24.57%
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>


</x-app-layout>
