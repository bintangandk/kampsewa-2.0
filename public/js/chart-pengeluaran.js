function createGradientPengeluaranPertahun(id) {
    const ctx = document.getElementById(id).getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 300); // Sesuaikan lebar gradien dengan ukuran grafik Anda
    gradient.addColorStop(0, "rgb(179, 129, 244)"); // Warna atas
    gradient.addColorStop(1, "rgb(80, 56, 237)"); // Transparansi putih di bagian bawah
    return gradient;
}

const createGradientChartLine = (id) => {
    const ctx = document.getElementById(id).getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 300); // Sesuaikan lebar gradien dengan ukuran grafik Anda
    gradient.addColorStop(0, "rgb(179, 129, 244)"); // Warna atas
    gradient.addColorStop(1, "rgba(255, 255, 255, 0)"); // Transparansi putih di bagian bawah
    return gradient;
}
/*
-------------------------------------------------------------------------
Pengeluaran Pertahun
-------------------------------------------------------------------------
*/
const labelsPengeluaranPertahun = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Ag",
    "Sep",
    "Okt",
    "Nov",
    "Des",
];
const dataPengeluaranPertahun = {
    labels: labelsPengeluaranPertahun,
    datasets: [
        {
            label: "Total Pengeluaran",
            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
            borderRadius: 10,
            borderWidth: 0,
            // backgroundColor: 'rgb(235,235,235)',
            backgroundColor: createGradientPengeluaranPertahun('chart-pengeluaran-pertahun'),
            borderColor: 'rgb(124,169,207)',
            borderSkipped: false,
            barPercentage: 1,
            hoverBackgroundColor: "rgb(235,235,235)",
        },

    ],
};

// configutation
const configPengeluaranPertahun = {
    type: "bar",
    data: dataPengeluaranPertahun,
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
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
            },
            y: {
                ticks: {
                    display: false,
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
const canvasIDPengeluaran = document.getElementById(
    "chart-pengeluaran-pertahun"
);
new Chart(canvasIDPengeluaran, configPengeluaranPertahun);

/*
-------------------------------------------------------------------------
Pengeluaran Perbulan
-------------------------------------------------------------------------
*/
const labelsPengeluaranPerbulan = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Ag",
    "Sep",
    "Okt",
    "Nov",
    "Des"
];
const dataPengeluaranPerbuulan = {
    labels: labelsPengeluaranPerbulan,
    datasets: [
        {
            label: "Total Pengeluaran Perbulan",
            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
            borderWidth: 3,
            borderColor: createGradientPengeluaranPertahun('chart-pengeluaran-perbulan'),
            tension: 0.4,
            fill: true,
            backgroundColor: createGradientChartLine('chart-pengeluaran-perbulan'),
        },
    ],
};
const configPengeluaranPerbulan = {
    type: "line",
    data: dataPengeluaranPerbuulan,
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function (value) {
                        // Hanya tampilkan label jika nilainya bukan 0
                        if (value !== 0) {
                            return value;
                        }
                    },
                },
                border: {
                    display: false,
                },
                grid: {
                    display: false, // hilangkan garis vertikal
                }
            },
            x: {
                grid: {
                    display: false,
                },
                border: {
                    display: false,
                },
            }
        },
        plugins: {
            legend: {
                display: false,
            }
        }
    },
};
const canvasIDPengeluaranPerbulan = document.getElementById(
    "chart-pengeluaran-perbulan"
);
new Chart(canvasIDPengeluaranPerbulan, configPengeluaranPerbulan);
