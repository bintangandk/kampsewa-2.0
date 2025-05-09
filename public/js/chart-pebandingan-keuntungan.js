/*
/---------------------------------/
/- chart perbandingan keuntungan pertahun -/
/---------------------------------/
*/
async function fetchYearlyProfitComparison() {
    try {
        const response = await fetch("/api/yearly-profit-comparison");
        if (!response.ok) throw new Error("Network response was not ok");
        const result = await response.json();

        if (result?.success && result?.data) {
            return result.data;
        }
        throw new Error("Invalid data structure");
    } catch (error) {
        console.error("Error fetching yearly profit comparison:", error);
        return null;
    }
}

async function initYearlyProfitComparisonChart() {
    const canvas = document.getElementById("pebandingan-keuntungan-pertahun");
    if (!canvas) return;

    // Hancurkan chart lama jika ada
    if (canvas.chart) {
        canvas.chart.destroy();
    }

    const yearlyData = await fetchYearlyProfitComparison();
    if (!yearlyData) return;

    const monthNames = [
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
    const colors = [
        "rgb(51,145,133)",
        "rgb(235,134,43)",
        "rgb(179,129,244)",
        "rgb(207,245,0)",
    ];

    const datasets = yearlyData.map((data, index) => ({
        label: `Tahun ${data.year}`,
        data: data.monthly_profit,
        borderWidth: 3,
        borderColor: colors[index],
        tension: 0.4,
        yAxisID: index === 0 ? "y" : `y${index}`,
    }));

    const config = {
        type: "line",
        data: {
            labels: monthNames,
            datasets: datasets,
        },
        options: {
            responsive: true,
            interaction: {
                mode: "index",
                intersect: false,
            },
            scales: {
                y: {
                    type: "linear",
                    display: true,
                    position: "left",
                    title: {
                        display: true,
                        text: "Juta Rupiah",
                    },
                    ticks: {
                        callback: function (value) {
                            return `${value} Jt`;
                        },
                    },
                    border: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
                y1: {
                    type: "linear",
                    display: true,
                    position: "right",
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function (value) {
                            return `${value} Jt`;
                        },
                    },
                    border: {
                        display: false,
                    },
                },
                y2: {
                    type: "linear",
                    display: true,
                    position: "right",
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function (value) {
                            return `${value} Jt`;
                        },
                    },
                    border: {
                        display: false,
                    },
                },
                y3: {
                    type: "linear",
                    display: true,
                    position: "right",
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function (value) {
                            return `${value} Jt`;
                        },
                    },
                    border: {
                        display: false,
                    },
                },
                x: {
                    grid: {
                        display: true,
                    },
                    border: {
                        display: false,
                    },
                },
            },
            plugins: {
                legend: {
                    position: "top",
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 20,
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return `${context.dataset.label}: Rp ${(
                                context.raw * 1000000
                            ).toLocaleString("id-ID")}`;
                        },
                    },
                },
            },
        },
    };

    // Buat chart baru
    canvas.chart = new Chart(canvas, config);
}

// Panggil fungsi inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", initYearlyProfitComparisonChart);
