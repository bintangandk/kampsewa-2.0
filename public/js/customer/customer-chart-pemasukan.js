/*
/----------------------------------------
/- customer chart pemasukan tahun saat ini dashboard
/- id canvas = customer-chart-pemasukan-dsb
/----------------------------------------
*/
async function fetchIncomeData() {
    try {
        const response = await fetch("/api/chart/income-chart-data");
        if (!response.ok) throw new Error("Network response was not ok");
        return await response.json();
    } catch (error) {
        console.error("Error fetching income data:", error);
        return null;
    }
}

async function initIncomeCharts() {
    const chartData = await fetchIncomeData();
    if (!chartData?.success) return;

    // Formatting function untuk tooltip
    const formatRupiah = (value) => {
        return `Rp ${value.toLocaleString("id-ID")}`;
    };

    // Chart Pemasukan Pertahun
    const yearlyCtx = document.getElementById("customer-chart-pemasukan-dsb");
    if (yearlyCtx) {
        new Chart(yearlyCtx, {
            type: "line",
            data: {
                labels: chartData.data.labels,
                datasets: [
                    {
                        label: `Total Tahun ${new Date().getFullYear() - 1}`,
                        data: chartData.data.lastYear,
                        fill: false,
                        borderColor: "rgb(86,11,208)",
                        borderWidth: 3,
                        tension: 0.4,
                    },
                    {
                        label: `Total Tahun ${new Date().getFullYear()}`,
                        data: chartData.data.currentYear,
                        fill: false,
                        borderColor: "rgb(3,118,253)",
                        borderWidth: 3,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        position: "top",
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                return `${
                                    context.dataset.label
                                }: ${formatRupiah(context.raw)}`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { display: false },
                        grid: { display: true },
                        ticks: {
                            callback: (value) => formatRupiah(value),
                        },
                    },
                    x: {
                        border: { display: false },
                        grid: { display: false },
                    },
                },
            },
        });
    }

    // Chart Pemasukan Perbulan
    const monthlyCtx = document.getElementById(
        "customer-chart-pemasukan-perbulan-dsb"
    );
    if (monthlyCtx) {
        const currentMonth = new Date().getMonth();
        const lastMonth = currentMonth === 0 ? 11 : currentMonth - 1;

        new Chart(monthlyCtx, {
            type: "bar",
            data: {
                labels: chartData.data.labels,
                datasets: [
                    {
                        label: `Total Bulan ${chartData.data.labels[lastMonth]}`,
                        data: chartData.data.currentYear.map((val, i) =>
                            i === lastMonth ? val : 0
                        ),
                        backgroundColor: "rgb(255,206,86)",
                        borderColor: "rgb(255,206,86)",
                        borderWidth: 3,
                    },
                    {
                        label: `Total Bulan ${chartData.data.labels[currentMonth]}`,
                        data: chartData.data.currentYear.map((val, i) =>
                            i === currentMonth ? val : 0
                        ),
                        backgroundColor: "rgb(75,192,192)",
                        borderColor: "rgb(75,192,192)",
                        borderWidth: 3,
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        position: "top",
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                return context.raw !== 0
                                    ? `${context.dataset.label}: ${formatRupiah(
                                          context.raw
                                      )}`
                                    : null;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { display: false },
                        grid: { display: true },
                        ticks: {
                            callback: (value) => formatRupiah(value),
                        },
                    },
                    x: {
                        border: { display: false },
                        grid: { display: false },
                    },
                },
            },
        });
    }
}

// Panggil fungsi inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", initIncomeCharts);
