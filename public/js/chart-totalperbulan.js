async function fetchDataTotalPerbandinganPenghasilanDariTigaBulanLalu() {
    const url = 'http://192.168.1.3:8000/api/chart-penghasilan-perbulan-menu-penghasilan';
    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Accept' : 'application/json',
            }
        });
        const data = response.json();
        return data
    } catch(error) {
        console.error(error);
        return null;
    }
}

fetchDataTotalPerbandinganPenghasilanDariTigaBulanLalu().then(data => {
    if(data) {
        console.log(data.total_pemasukan_per_bulan);
    }
});
const labelsPenghasilanPerbulan = [
    "Feb",
    "Mar",
    "Apr",
    "Mei",
];

const dataPenghasilanPerbulan = {
    labels: labelsPenghasilanPerbulan,
    datasets: [
        {
            label: "My First Dataset",
            data: [
                30_435_142, 25_234_134, 30_345_123, 50_456_250
            ],
            fill: true,
            borderWidth: 3,
            borderColor: "rgb(124,169,207)",
            tension: 0.4,
            backgroundColor: createGradientPenghasilanPerbulan(),
        },
    ],
};

function createGradientPenghasilanPerbulan() {
    const ctx = document.getElementById("penghasilan-perbulan").getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 70); // Sesuaikan lebar gradien dengan ukuran grafik Anda
    gradient.addColorStop(0, "rgb(124,169,207)"); // Warna atas
    gradient.addColorStop(1, "rgba(8,14,46,1)"); // Transparansi putih di bagian bawah
    return gradient;
}

const configPenghasilanPerbulan = {
    type: "line",
    data: dataPenghasilanPerbulan,
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
                    color : 'white',
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
const penghasilanPerbulan = document.getElementById("penghasilan-perbulan");
new Chart(penghasilanPerbulan, configPenghasilanPerbulan);
