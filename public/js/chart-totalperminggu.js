// Fungsi untuk mengambil data dari API
async function fetchWeeklyIncome() {
    try {
        const response = await fetch("/api/chart/weekly-income");
        const result = await response.json();

        if (result.success) {
            return result.data;
        }
        return [0, 0, 0, 0]; // Fallback jika error
    } catch (error) {
        console.error("Error fetching weekly income:", error);
        return [0, 0, 0, 0]; // Fallback jika error
    }
}

// Fungsi untuk inisialisasi chart
async function initializeChart() {
    const weeklyData = await fetchWeeklyIncome();

    const labelsPenghasilanPerminggu = ["Min 1", "Min 2", "Min 3", "Min 4"];

    const dataPenghasilanPerminggu = {
        labels: labelsPenghasilanPerminggu,
        datasets: [
            {
                label: "Penghasilan Perminggu",
                data: weeklyData,
                fill: true,
                borderWidth: 3,
                borderColor: "rgb(8,14,46)",
                tension: 0.4,
                backgroundColor: createGradientPenghasilanPerminggu(),
            },
        ],
    };

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
                        color: "rgb(8,14,46)",
                    },
                },
                y: {
                    ticks: {
                        callback: function (value) {
                            if (value !== 0) {
                                return new Intl.NumberFormat("id-ID").format(
                                    value
                                );
                            }
                        },
                        display: false,
                    },
                    beginAtZero: true,
                    border: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
            },
        },
    };

    const penghasilanPerminggu = document.getElementById(
        "penghasilan-perminggu"
    );
    new Chart(penghasilanPerminggu, configPenghasilanPerminggu);
}

// Panggil fungsi inisialisasi
initializeChart();

// Fungsi gradient (tetap sama)
function createGradientPenghasilanPerminggu() {
    const ctx = document
        .getElementById("penghasilan-perminggu")
        .getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 70);
    gradient.addColorStop(0, "rgb(8,14,46)");
    gradient.addColorStop(1, "rgba(199,180,238,1)");
    return gradient;
}
