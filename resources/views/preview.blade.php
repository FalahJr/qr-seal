@extends('layouts.user.default')

@section('content')
    <div class="container-fluid" style="height: 100vh;">
        <a href="javascript:history.back()" class="btn btn-primary my-3">Kembali</a>

        <div class="row h-100">
            <!-- PDF Preview Section -->
            <div class="col-md-8 d-flex align-items-center justify-content-center position-relative" id="pdfPreview"
                style="border-right: 1px solid #ccc;">
                <embed src="{{ URL::asset('storage/' . $file) }}" type="application/pdf"
                    style="width: 100%; height: 100%; border: none;" />

                <!-- QR Code positioned absolutely within the preview area -->
                <img src="{{ asset('storage/' . $qr_code) }}" id="qrCode" alt="QR code"
                    style="width: 10%; height: auto; position: absolute; top: 10px; left: 10px; display: none;">
            </div>

            <!-- QR Code and Download Section -->
            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('storage/' . $qr_code) }}" id="initialQrCode" alt="QR code"
                    style="width: 100%; height: auto;" draggable="true">

                <!-- Download Button -->
                <button class="btn btn-primary mt-4" id="downloadPDF" style="background-color: #40A2D8;">
                    Download PDF with QR Code
                </button>
            </div>
        </div>
    </div>

    <!-- Include the pdf-lib library -->
    <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <!-- Include the interact.js library -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@interactjs/interactjs/dist/interact.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.min.js"></script>

    <script type="text/javascript">
        let qrCodePosition = {
            x: 10,
            y: 10
        }; // Initial position

        // Interact.js draggable setup
        interact('#initialQrCode').draggable({
            onstart: function(event) {
                var initialQrCode = event.target;
                var qrCodeInPreview = document.getElementById('qrCode');
                qrCodeInPreview.style.top = (event.pageY - initialQrCode.height / 2) + 'px';
                qrCodeInPreview.style.left = (event.pageX - initialQrCode.width / 2) + 'px';
                qrCodeInPreview.style.display = 'block';
                initialQrCode.style.display = 'none';
            },
            onmove: dragMoveListener
        });

        interact('#qrCode').draggable({
            onmove: dragMoveListener
        });

        function dragMoveListener(event) {
            var target = event.target;
            var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);

            qrCodePosition.x = parseFloat(target.style.left) + x;
            qrCodePosition.y = parseFloat(target.style.top) + y;
        }

        // Download PDF button functionality
        document.getElementById('downloadPDF').addEventListener('click', async function() {
            var qrCode = document.getElementById('qrCode');
            var pdfPreview = document.getElementById('pdfPreview');

            if (qrCode && pdfPreview) {
                const existingPdfBytes = await fetch("{{ asset('storage/' . $file) }}").then(res => res
                    .arrayBuffer());
                const qrCodeImageBytes = await fetch(qrCode.src).then(res => res.arrayBuffer());

                const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
                const qrCodeImage = await pdfDoc.embedPng(qrCodeImageBytes);
                const pages = pdfDoc.getPages();
                const firstPage = pages[0];

                const pdfWidth = firstPage.getWidth();
                const pdfHeight = firstPage.getHeight();
                const qrWidth = qrCode.clientWidth;
                const qrHeight = qrCode.clientHeight;

                const qrPosX = (qrCodePosition.x / pdfPreview.clientWidth) * pdfWidth;
                const qrPosY = pdfHeight - ((qrCodePosition.y + qrHeight) / pdfPreview.clientHeight) *
                    pdfHeight;

                firstPage.drawImage(qrCodeImage, {
                    x: qrPosX,
                    y: qrPosY,
                    width: qrWidth,
                    height: qrHeight
                });

                const pdfBytes = await pdfDoc.save();
                const blob = new Blob([pdfBytes], {
                    type: 'application/pdf'
                });
                const url = URL.createObjectURL(blob);

                const a = document.createElement('a');
                a.href = url;
                a.download = 'downloaded-with-qr-code.pdf';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }
        });
    </script>
@endsection
