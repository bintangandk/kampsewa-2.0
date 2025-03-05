/*
/----------------------------------------
/- customer chart pemasukan tahun saat ini dashboard
/- id canvas = customer-chart-pemasukan-dsb
/----------------------------------------
*/

// setup chart
const labelsMonthPemasukanTahunDashboard = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Agu",
    "Sep",
    "Okt",
    "Nov",
    "Des",
];
const dataPemasukanTahunDashboard = {
    labels: labelsMonthPemasukanTahunDashboard,
    datasets: [
        {
            label: "Total Tahun 2023",
            data: [37, 43, 23, 19, 87, 35, 22, 55, 74, 39, 41, 121],
            fill: false,
            borderColor: "rgb(86,11,208)",
            bordeWidth: 3,
            tension: 0.4,
        },
        {
            label: "Total Tahun 2024",
            data: [34, 56, 12, 66, 86, 12, 44, 66, 22, 33, 44, 55],
            fill: false,
            borderColor: "rgb(3,118,253)",
            bordeWidth: 3,
            tension: 0.4,
            yAxisID: "precentage",
        },
    ],
};

// config
const configPemasukanTahunDashboard = {
    type: "line",
    data: dataPemasukanTahunDashboard,
    options: {
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            y: {
                border: {
                    display: false,
                },
                grid: {
                    display: true,
                },
                ticks: {
                    callback: function (value) {
                        return `${value} M`;
                    }
                }
            },
            x: {
                border: {
                    display: false,
                },
                grid: {
                    display: false,
                },
            },
            precentage: {
                beginAtZero: true,
                position: 'right',
                border: {
                    display: false,
                },
                grid: {
                    display: false,
                },
                ticks: {
                    callback: function (value) {
                        return `${value} M`;
                    }
                }
            }
        },
    },
};

// render init block
const ctx = document.getElementById("customer-chart-pemasukan-dsb");
new Chart(ctx, configPemasukanTahunDashboard);

/*
/----------------------------------------
/- customer chart pemasukan tahun saat ini dashboard
/- id canvas = customer-chart-pemasukan-perbulan-dsb
/----------------------------------------
*/

// setup chart
const labelsMonthPemasukanBulanDashboard = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Agu",
    "Sep",
    "Okt",
    "Nov",
    "Des",
];
const dataPemasukanBulanDashboard = {
    labels: labelsMonthPemasukanBulanDashboard,
    datasets: [
        {
            label: "Total Bulan April",
            data: [37, 43, 23, 19, 87, 35, 22, 55, 74, 39, 41, 121],
            fill: false,
            borderColor: "rgb(255,206,86)",
            backgroundColor: "rgb(255,206,86)",
            bordeWidth: 3,
            tension: 0.4,
        },
        {
            label: "Total Bulan Mei",
            data: [34, 56, 12, 66, 86, 12, 44, 66, 22, 33, 44, 55],
            fill: false,
            borderColor: "rgb(75,192,192)",
            backgroundColor: "rgb(75,192,192)",
            bordeWidth: 3,
            tension: 0.4,
            yAxisID: "precentageperbulan",
        },
    ],
};

// config
const configPemasukanBulanDashboard = {
    type: "bar",
    data: dataPemasukanBulanDashboard,
    options: {
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            y: {
                border: {
                    display: false,
                },
                grid: {
                    display: true,
                },
                ticks: {
                    callback: function (value) {
                        return `${value} M`;
                    }
                }
            },
            x: {
                border: {
                    display: false,
                },
                grid: {
                    display: false,
                },
            },
            precentageperbulan: {
                beginAtZero: true,
                position: 'right',
                border: {
                    display: false,
                },
                grid: {
                    display: false,
                },
                ticks: {
                    callback: function (value) {
                        return `${value} M`;
                    }
                }
            }
        },
    },
};

// render init block
const ctxPerbulan = document.getElementById("customer-chart-pemasukan-perbulan-dsb");
new Chart(ctxPerbulan, configPemasukanBulanDashboard);
