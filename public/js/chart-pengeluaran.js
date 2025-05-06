// Fungsi gradient tetap sama
function createGradientPengeluaranPertahun(id) {
    const ctx = document.getElementById(id).getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgb(179, 129, 244)");
    gradient.addColorStop(1, "rgb(80, 56, 237)");
    return gradient;
}

const createGradientChartLine = (id) => {
    const ctx = document.getElementById(id).getContext("2d");
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgb(179, 129, 244)");
    gradient.addColorStop(1, "rgba(255, 255, 255, 0)");
    return gradient;
};

// Fungsi untuk fetch data
async function fetchExpenseData() {
    try {
        const response = await fetch("/api/chart/expense-data");
        if (!response.ok) throw new Error("Network response was not ok");

        const result = await response.json();

        if (result?.success && result?.data) {
            return result.data;
        }
        throw new Error("Invalid data structure");
    } catch (error) {
        console.error("Error fetching expense data:", error);
        // Return default data if API fails
        return {
            yearly: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agt",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
                values: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
            monthly: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agt",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
                values: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
        };
    }
}

// Inisialisasi Chart Pengeluaran Pertahun
async function initYearlyExpenseChart() {
    const canvas = document.getElementById("chart-pengeluaran-pertahun");
    if (!canvas) return;

    if (canvas.chart) canvas.chart.destroy();

    const expenseData = await fetchExpenseData();

    const config = {
        type: "bar",
        data: {
            labels: expenseData.yearly.labels,
            datasets: [
                {
                    label: "Total Pengeluaran",
                    data: expenseData.yearly.values,
                    borderRadius: 10,
                    borderWidth: 0,
                    backgroundColor: createGradientPengeluaranPertahun(
                        "chart-pengeluaran-pertahun"
                    ),
                    borderColor: "rgb(124,169,207)",
                    borderSkipped: false,
                    barPercentage: 1,
                    hoverBackgroundColor: "rgb(235,235,235)",
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
                },
                y: {
                    ticks: { display: false },
                    beginAtZero: true,
                    border: { display: false },
                    grid: { display: false },
                },
            },
        },
    };

    canvas.chart = new Chart(canvas, config);
}

// Inisialisasi Chart Pengeluaran Perbulan
async function initMonthlyExpenseChart() {
    const canvas = document.getElementById("chart-pengeluaran-perbulan");
    if (!canvas) return;

    if (canvas.chart) canvas.chart.destroy();

    const expenseData = await fetchExpenseData();

    const config = {
        type: "line",
        data: {
            labels: expenseData.monthly.labels,
            datasets: [
                {
                    label: "Total Pengeluaran Perbulan",
                    data: expenseData.monthly.values,
                    borderWidth: 3,
                    borderColor: createGradientPengeluaranPertahun(
                        "chart-pengeluaran-perbulan"
                    ),
                    tension: 0.4,
                    fill: true,
                    backgroundColor: createGradientChartLine(
                        "chart-pengeluaran-perbulan"
                    ),
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
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) =>
                            value !== 0
                                ? `Rp ${value.toLocaleString("id-ID")}`
                                : "",
                    },
                    border: { display: false },
                    grid: { display: false },
                },
                x: {
                    grid: { display: false },
                    border: { display: false },
                },
            },
        },
    };

    canvas.chart = new Chart(canvas, config);
}

// Initialize all charts when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    initYearlyExpenseChart();
    initMonthlyExpenseChart();
});
