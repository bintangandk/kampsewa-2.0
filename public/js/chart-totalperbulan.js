// Fungsi untuk mengambil data dari API bulanan
async function fetchMonthlyIncome() {
    try {
        const response = await fetch("/api/chart/monthly-income");
        const result = await response.json();

        if (
            result.success &&
            result.data &&
            Array.isArray(result.data.labels) &&
            Array.isArray(result.data.values)
        ) {
            // Jika label dan value valid
            return {
                labels: result.data.labels,
                values: result.data.values.map((val) => val ?? 0), // pastikan nilai null jadi 0
            };
        }

        // fallback jika data tidak sesuai format
        return generateDefaultChartData();
    } catch (error) {
        console.error("Error fetching monthly income:", error);
        return generateDefaultChartData();
    }
}

// Generate fallback 4 bulan terakhir dengan nilai 0
function generateDefaultChartData() {
    const now = new Date();
    const labels = [];

    for (let i = 3; i >= 0; i--) {
        const tempDate = new Date(now.getFullYear(), now.getMonth() - i, 1);
        const formatter = new Intl.DateTimeFormat("id-ID", { month: "short" });
        labels.push(formatter.format(tempDate));
    }

    return {
        labels: labels,
        values: [0, 0, 0, 0],
    };
}

// Fungsi inisialisasi chart keuntungan bulanan
async function initializeMonthlyIncomeChart() {
    const data = await fetchMonthlyIncome();

    const dataChart = {
        labels: data.labels,
        datasets: [
            {
                label: "Total Keuntungan",
                data: data.values,
                fill: true,
                borderWidth: 3,
                borderColor: "rgb(8,14,46)",
                tension: 0.4,
                backgroundColor: createGradientMonthlyIncome(),
            },
        ],
    };

    const config = {
        type: "line",
        data: dataChart,
        options: {
            layout: {
                padding: 0,
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
                            return "0";
                        },
                        display: false,
                    },
                    beginAtZero: true,
                    grid: {
                        display: false,
                    },
                },
            },
        },
    };

    const canvas = document.getElementById("chart-keuntungan-perbulan");
    new Chart(canvas, config);
}

// Fungsi membuat gradasi latar belakang chart
function createGradientMonthlyIncome() {
    const ctx = document
        .getElementById("chart-keuntungan-perbulan")
        .getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 70);
    gradient.addColorStop(0, "rgb(8,14,46)");
    gradient.addColorStop(1, "rgba(199,180,238,1)");
    return gradient;
}

// Jalankan chart
initializeMonthlyIncomeChart();
