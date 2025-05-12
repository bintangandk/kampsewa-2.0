async function fetchMonthlyIncome() {
    const url = "/api/chart/monthly-income";
    try {
        const response = await fetch(url, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const result = await response.json();

        if (result.success && result.data) {
            return result.data;
        }
        throw new Error("Invalid data format");
    } catch (error) {
        console.error("Error fetching monthly income:", error);
        return {
            labels: ["Feb", "Mar", "Apr", "Mei"],
            values: [0, 0, 0, 0], // Fallback data
        };
    }
}

async function initializeChart() {
    // Pastikan elemen canvas ada
    const canvas = document.getElementById("penghasilan-perbulan");
    if (!canvas) {
        console.error("Canvas element not found!");
        return;
    }

    // Hancurkan chart lama jika ada
    if (canvas.chart) {
        canvas.chart.destroy();
    }

    // Ambil data dari API
    const { labels, values } = await fetchMonthlyIncome();
    console.log("Data from API:", { labels, values });

    // Konfigurasi Chart
    const config = {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Penghasilan Perbulan",
                    data: values,
                    fill: true,
                    borderWidth: 3,
                    borderColor: "rgb(124,169,207)",
                    tension: 0.4,
                    backgroundColor: createGradientPenghasilanPerbulan(canvas),
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => `Rp ${ctx.raw.toLocaleString("id-ID")}`,
                    },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: "white" },
                },
                y: {
                    ticks: {
                        callback: (val) =>
                            val !== 0
                                ? `Rp ${val.toLocaleString("id-ID")}`
                                : undefined,
                        display: false,
                    },
                    beginAtZero: true,
                    grid: { display: false },
                    border: { display: false },
                },
            },
        },
    };

    // Buat chart baru
    canvas.chart = new Chart(canvas, config);
}

// Fungsi gradient yang dimodifikasi
function createGradientPenghasilanPerbulan(canvas) {
    const ctx = canvas.getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
    gradient.addColorStop(0, "rgb(124,169,207)");
    gradient.addColorStop(1, "rgba(8,14,46,1)");
    return gradient;
}

// Inisialisasi chart saat halaman dimuat
document.addEventListener("DOMContentLoaded", initializeChart);
