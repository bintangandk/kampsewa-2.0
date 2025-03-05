const labelsPenghasilanPerminggu = [
    "Min 1",
    "Min 2",
    "Min 3",
    "Min 4",
];

const dataPenghasilanPerminggu = {
    labels: labelsPenghasilanPerminggu,
    datasets: [
        {
            label: "My First Dataset",
            data: [
                37_435_142, 80_234_134, 38_345_123, 50_456_250
            ],
            fill: true,
            borderWidth: 3,
            borderColor: "rgb(8,14,46)",
            tension: 0.4,
            backgroundColor: createGradientPenghasilanPerminggu(),
        },
    ],
};

function createGradientPenghasilanPerminggu() {
    const ctx = document.getElementById("penghasilan-perminggu").getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 70); // Sesuaikan lebar gradien dengan ukuran grafik Anda
    gradient.addColorStop(0, "rgb(8,14,46)"); // Warna atas
    gradient.addColorStop(1, "rgba(199,180,238,1)"); // Transparansi putih di bagian bawah
    return gradient;
}

const configPenghasilanPerminggu = {
    type: "line",
    data: dataPenghasilanPerminggu,
    options: {
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0,
            },
        },
        tooltips: {
            line: false,
        },
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                border: {
                    display: false,
                },
                ticks: {
                    color : 'rgb(8,14,46)',
                }
            },
            y: {
                ticks: {
                    callback: function (value) {
                        // Hanya tampilkan label jika nilainya bukan 0
                        if (value !== 0) {
                            return value;
                        }
                    },
                    display: false
                },
                beginAtZero: true,
                border: {
                    display: false,
                },
                grid: {
                    display: false, // hilangkan garis vertikal
                },
            },
        },
    },
};
const penghasilanPerminggu = document.getElementById("penghasilan-perminggu");
new Chart(penghasilanPerminggu, configPenghasilanPerminggu);
