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

                                <x-primary-button id="btn-next"
                                    class="font-bold !text-xl w-full justify-center gap-3 !p-6">
                                    Panggil Berikutnya
                                </x-primary-button>
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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            async function callNextQueue() {
                const originalButtonText = this.innerHTML;

                this.disabled = true;
                this.classList.add('opacity-75', 'cursor-not-allowed');
                this.innerHTML = 'Memanggil...';

                try {
                    const response = await axios.post("{{ route('admin.next') }}");

                    if (response.data) {
                        updateDisplay(response.data);
                    } else {
                        alert('Tidak ada antrian menunggu.');
                    }
                } catch (error) {
                    alert(`Error: ${error}`)
                } finally {
                    this.disabled = false;
                    this.classList.remove('opacity-75', 'cursor-not-allowed');
                    this.innerHTML = originalButtonText;
                }
            }

            async function fetchWaitingList() {
                const response = await axios.get("{{ route('queue.waiting-list') }}");
                const data = response.data

                const listContainer = document.getElementById('waiting-list');
                const countDisplay = document.getElementById('count-display');

                countDisplay.innerText = data.length;

                if (data.length === 0) {
                    listContainer.innerHTML =
                        '<li class="py-8 text-center text-gray-400 text-sm italic">Tidak ada antrian menunggu.</li>';
                } else {
                    let html = '';
                    data.forEach(q => {
                        html += `
                            <li class="py-3 flex justify-between items-center animate-pulse-once">
                                <span class="text-lg font-semibold text-gray-700">No. ${q.number}</span>
                                <span class="text-xs text-gray-400">Baru saja</span>
                            </li>`;
                    });
                    listContainer.innerHTML = html;
                }
            }

            function updateDisplay(data) {
                if (data.number) {
                    document.getElementById('admin-current-number').innerText = data.number;
                }

                fetchWaitingList();
            }

            const nextButton = document.getElementById('btn-next');
            nextButton.addEventListener('click', callNextQueue);
        </script>
    @endpush
</x-app-layout>
