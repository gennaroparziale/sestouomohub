<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Scanner QR Code</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($evento)
                        <h3 class="text-lg font-medium text-center">Check-in per: <span class="font-bold">{{ $evento->avversario }}</span></h3>
                        <p class="text-center text-sm ... mb-4">Inquadra il QR Code del tifoso nel riquadro.</p>
                        <div id="reader" class="w-full max-w-sm mx-auto aspect-square bg-gray-200 rounded-lg"></div>
                        <div id="result" class="mt-4 h-6 text-center font-bold"></div>
                    @else
                        <p class="text-center">Nessun evento imminente trovato per il check-in.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($evento)
        @push('scripts')
            <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const resultDiv = document.getElementById('result');

                    function onScanSuccess(decodedText, decodedResult) {
                        html5QrcodeScanner.pause();
                        resultDiv.innerHTML = `<span class="text-blue-500">Scansione OK. Registro...</span>`;

                        fetch('{{ route("admin.scanner.checkin") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                user_id: decodedText,
                                evento_id: '{{ $evento->id }}',
                                evento_type: '{{ get_class($evento) }}'
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    resultDiv.innerHTML = `<span class="text-green-500">${data.message}</span>`;
                                } else {
                                    resultDiv.innerHTML = `<span class="text-red-500">${data.message}</span>`;
                                }
                            })
                            .catch(error => {
                                resultDiv.innerHTML = `<span class="text-red-500">Errore di comunicazione.</span>`;
                            })
                            .finally(() => {
                                setTimeout(() => {
                                    html5QrcodeScanner.resume();
                                    resultDiv.innerHTML = '';
                                }, 3000);
                            });
                    }

                    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
                    html5QrcodeScanner.render(onScanSuccess, (error) => {});
                });
            </script>
        @endpush
    @endif
</x-app-layout>
