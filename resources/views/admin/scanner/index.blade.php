<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Scanner QR Code
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($trasferta)
                        <h3 class="text-lg font-medium text-center">Check-in per la trasferta: <span class="font-bold">{{ $trasferta->avversario }}</span></h3>
                        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-4">Inquadra il QR Code del tifoso nel riquadro sottostante.</p>

                        <div id="reader" class="w-full max-w-sm mx-auto aspect-square bg-gray-200 rounded-lg"></div>

                        <div id="result" class="mt-4 text-center font-bold"></div>
                    @else
                        <p class="text-center">Nessuna trasferta imminente con iscrizioni aperte trovata per il check-in.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            // Attendiamo che la pagina sia completamente caricata
            document.addEventListener('DOMContentLoaded', function () {
                // Se nella pagina c'è l'elemento 'reader'
                if (document.getElementById('reader')) {

                    function onScanSuccess(decodedText, decodedResult) {
                        // DecodedText è l'ID utente che abbiamo messo nel QR Code
                        console.log(`Scan Succeeded. Decoded text: ${decodedText}`);

                        // Per ora mostriamo solo un messaggio. Dopo lo collegheremo al server.
                        document.getElementById('result').innerHTML = `<span class="text-green-500">QR Code Rilevato: Utente ID ${decodedText}</span>`;

                        // Ferma lo scanner per un attimo per evitare scansioni multiple
                        html5QrcodeScanner.pause();
                        setTimeout(() => {
                            document.getElementById('result').innerHTML = '';
                            html5QrcodeScanner.resume();
                        }, 3000); // Riprende a scansionare dopo 3 secondi
                    }

                    function onScanFailure(error) {
                        // Questa funzione viene chiamata di continuo, la usiamo per mostrare un messaggio di "ricerca"
                        document.getElementById('result').innerHTML = `<span class="text-gray-500">In attesa di un QR Code...</span>`;
                    }

                    // Creiamo una nuova istanza dello scanner
                    let html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader",
                        { fps: 10, qrbox: {width: 250, height: 250} },
                        /* verbose= */ false);

                    // Avviamo la scansione
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                }
            });
        </script>
    @endpush
</x-app-layout>
