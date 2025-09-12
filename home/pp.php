<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF Export (No White Margin)</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body style="margin:0;padding:0;">

    <div id="printarea" style="width:794px;height:1123px;position:relative;">
        <img src="http://localhost/jewelgallery/lib/images/invoice.png" style="position:absolute;left:0;top:0;width:100%;height:100%;object-fit:fill;z-index:0;">
        <div style="position:relative;z-index:1;padding:20px;font-family:'Myanmar Text',sans-serif;">
            <p><strong>အမည် :</strong> Zaw Min Htwe</p>
            <p><strong>ဖုန်း :</strong> 09123456789</p>
            <p><strong>နေ့စွဲ :</strong> 21-07-2025 / 22:45:35</p>
            <p><strong>ကုန်ပစ္စည်း :</strong> Amethyst Dia Ring</p>
        </div>
    </div>

    <button onclick="downloadPDF()">Export PDF (No Margin)</button>

    <script>
    async function downloadPDF() {
        const element = document.getElementById("printarea");
        const canvas = await html2canvas(element, {
            scale: 2, // higher resolution
            useCORS: true
        });
        const imgData = canvas.toDataURL("image/png");

        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF("p", "pt", "a4");
        pdf.addImage(imgData, "PNG", 0, 0, 595.28, 841.89); // exact A4 size
        pdf.save("voucher.pdf");
    }
    </script>

</body>

</html>