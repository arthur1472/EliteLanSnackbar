<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account instellingen') }}
        </h2>
    </x-slot>

    <div class="divide-y divide-solid divide-gray-200 lg:col-span-9 md:w-2/3 md:mx-auto m-4 p-4 bg-white">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
                <h2 class="text-2xl font-medium leading-6 text-gray-900">Profiel</h2>
                <p class="mt-1 text-md text-gray-500">Hier staat wat informatie over jou.</p>
            </div>

            <p class="text-xl mt-6">Whatsapp</p>
            <div class="mt-3 flex flex-col lg:flex-row">
                <form action="{{ route('profile.update') }}" method="POST" class="w-full">
                    @csrf
                    <div class="flex-grow space-y-6">
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
                            <div class="flex">
                                @if($user->phone_number_verified)
                                <div class="flex mr-2 justify-center items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                </div>
                                @endif
                                <div class="mt-1 flex w-full rounded-md shadow-sm">
                                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">316</span>
                                    <input type="number" name="phone_number" id="phone_number" value="{{ $user->phone_number_without_prefix }}" class="block w-full min-w-0 flex-grow rounded-none rounded-r-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul role="list" class="divide-y divide-gray-200">
                                <li class="flex items-center justify-between py-1">
                                    <div class="flex flex-col">
                                        <label for="whatsapp_message">
                                            <p class="text-sm font-medium text-gray-900" id="privacy-option-1-label">Whatsapp berichten</p>
                                            <p class="text-sm text-gray-500" id="privacy-option-1-description">Zet deze optie aan als je updates wilt ontvangen via Whatsapp. Verifieer eerst je telefoonnummer voordat je dit aan zet (invullen en opslaan, dan komt de verificatie naar voren).</p>
                                        </label>
                                    </div>
                                    <div class="ml-3 flex h-5 items-center">
                                        <input id="whatsapp_message" name="whatsapp_message" @if($user->enable_whatsapp) checked @endif type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="w-full flex justify-end">
                            <input name="whatsapp_button" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" type="submit" value="Opslaan">
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-3 flex flex-col lg:flex-row">
                @if(! $user->phone_number_verified && $user->phone_number)
                    <form action="{{ route('profile.phone_verification') }}" method="POST" class="w-full">
                        @csrf
                        <div>
                            <label for="verification_code" class="block text-sm font-medium text-gray-700">Verificatie code</label>
                            <p class="text-sm text-gray-500" id="privacy-option-1-description">Druk op de knop "Sturen" om een verificatie code te krijgen via Whatsapp. Vul de code hier vervolgens in en druk op verifiëren. Maak hier aub geen misbruik van.</p>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">SNACKBAR-</span>
                                <input type="text" name="verification_code" id="verification_code" class="block w-full min-w-0 flex-grow rounded-none rounded-r-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="w-full flex justify-end mt-3">
                            @if(!$user->hasValidPhoneVerificationCode()) <input class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 mr-3" name="send" type="submit" value="Sturen"> @endif
                            @if($user->hasValidPhoneVerificationCode()) <input class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" name="verify" type="submit" value="Verifiëren"> @endif
                        </div>
                    </form>
                @endif
            </div>

            <p class="text-xl mt-6">Discord</p>
            <div class="flex flex-col lg:flex-row">
                <form class="w-full" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="flex-grow space-y-4">
                        <div>
                            <ul role="list" class="mt-2 divide-y divide-gray-200">
                                <li class="flex items-center justify-between py-2">
                                    <div class="flex flex-col">
                                        <label for="discord_mention">
                                            <p class="text-sm font-medium text-gray-900" id="discord-tag-label">Discord notificatie</p>
                                            <p class="text-sm text-gray-500" id="discord-tag-description">Zet deze optie aan als je updates wilt ontvangen via Discord. Je zal een mention/notificatie krijgen via de notitie update of status update.</p>
                                        </label>
                                    </div>
                                    <div class="ml-3 flex h-5 items-center">
                                        <input id="discord_mention" name="discord_mention"  type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="w-full flex justify-end">
                            <input name="discord_button" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" type="submit" value="Opslaan">
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-xl mt-6">Persoonlijke info</p>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mt-2 grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" autocomplete="given-name" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                    </div>
                </div>

                <div class="mt-4 w-full flex justify-end">
                    <input name="personal_info_button" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" type="submit" value="Opslaan">
                </div>
            </form>

{{--            <div class="mt-20 grid grid-cols-12 gap-6">--}}
{{--                <div class="col-span-12">--}}
{{--                    <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>--}}
{{--                    <input type="text" name="name" id="name" autocomplete="given-name" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">--}}
{{--                </div>--}}

{{--                <div class="col-span-12 sm:col-span-6">--}}
{{--                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>--}}
{{--                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">--}}
{{--                </div>--}}

{{--                <div class="col-span-12 sm:col-span-6">--}}
{{--                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>--}}
{{--                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">--}}
{{--                </div>--}}

{{--                <div class="col-span-12">--}}
{{--                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>--}}
{{--                    <input type="text" name="url" id="url" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">--}}
{{--                </div>--}}

{{--                <div class="col-span-12 sm:col-span-6">--}}
{{--                    <label for="company" class="block text-sm font-medium text-gray-700">Company</label>--}}
{{--                    <input type="text" name="company" id="company" autocomplete="organization" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</x-app-layout>
