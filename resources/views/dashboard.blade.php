<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Loket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center">

                            <h3 class="text-lg font-medium text-gray-500 uppercase tracking-wider mb-2">Sedang Melayani
                            </h3>

                            <div class="py-8">
                                <span id="admin-current-number"
                                    class="text-9xl font-black text-blue-600 transition-all duration-300">
                                    {{ $currentNumber ?? '-' }}
                                </span>
                            </div>

                            <div class="mt-4 border-t pt-6">
                                <p class="mb-4 text-sm text-gray-500">Klik tombol di bawah untuk memanggil antrian
                                    berikutnya.</p>

                                <button onclick="callNext()" id="btn-next"
                                    class="w-full inline-flex justify-center items-center px-6 py-6 bg-gray-800 border border-transparent rounded-lg font-bold text-xl text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 gap-3 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Panggil Berikutnya
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button onclick="if(confirm('Reset antrian ke 0?')) resetQueue()"
                            class="text-red-500 hover:text-red-700 text-sm font-semibold underline">
                            Reset Antrian Hari Ini
                        </button>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-bold text-gray-800">Menunggu (<span
                                        id="count-display">{{ $waitingCount ?? 0 }}</span>)</h3>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Live</span>
                            </div>

                            <div class="overflow-y-auto max-h-[400px] pr-2">
                                <ul id="waiting-list" class="divide-y divide-gray-100">
                                    @forelse($waitingList as $queue)
                                        <li class="py-3 flex justify-between items-center">
                                            <span class="text-lg font-semibold text-gray-700">No.
                                                {{ $queue->number }}</span>
                                            <span
                                                class="text-xs text-gray-400">{{ $queue->created_at->format('H:i') }}</span>
                                        </li>
                                    @empty
                                        <li class="py-8 text-center text-gray-400 text-sm italic" id="empty-msg">
                                            Tidak ada antrian menunggu.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
