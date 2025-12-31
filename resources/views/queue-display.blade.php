<x-app-layout>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-blue-600 p-6 text-center text-white">
                <h1 class="text-2xl font-bold tracking-wide uppercase">Layanan Pelanggan</h1>
                <p class="text-blue-100 text-sm mt-1">Silakan ambil antrian dan tunggu panggilan</p>
            </div>

            <div class="p-8 text-center border-b border-gray-200">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Sedang Melayani</h2>

                <div id="current-number" class="text-8xl font-black text-gray-800 my-4 transition-all duration-300">
                    {{ $currentNumber ?? '-' }}
                </div>

                <p class="text-gray-400 text-sm">Nomor Antrian</p>
            </div>

            <div class="p-6 bg-gray-50">
                <button onclick="takeQueue()" id="btn-ambil"
                    class="inline-flex items-center justify-center w-full px-6 py-4 bg-blue-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg gap-2">

                    <i class="fa-solid fa-ticket"></i>
                    Ambil Nomor Antrian
                </button>

                <div id="user-ticket"
                    class="hidden mt-4 bg-green-50 border border-green-200 rounded-lg p-4 text-center transition-all duration-500">
                    <p class="text-green-800 text-sm font-semibold uppercase tracking-wide">Nomor Anda</p>
                    <span id="my-number" class="text-4xl font-bold text-green-600 block my-2">-</span>
                    <p class="text-xs text-green-600">Mohon menunggu nomor dipanggil.</p>
                </div>
            </div>

            <div class="bg-gray-800 text-gray-400 p-4 text-center text-xs tracking-wider">
                SISA ANTRIAN: <span id="waiting-count"
                    class="font-bold text-white text-sm ml-1">{{ $waitingCount ?? 0 }}</span>
            </div>
        </div>
    </div>
</x-app-layout>
