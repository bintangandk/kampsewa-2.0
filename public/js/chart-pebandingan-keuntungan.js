/*
/---------------------------------/
/- chart perbandingan keuntungan pertahun -/
/---------------------------------/
*/
const labelsPerbandinganKeuntunganPertahun = [
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
const dataPerbandinganPenghasilanPertahun = {
    labels: labelsPerbandinganKeuntunganPertahun,
    datasets: [
        {
            label: "Total:",
            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
            borderWidth: 3,
            borderColor: "rgb(51,145,133)",
            tension: 0.4,
        },
        {
            label: "Total:",
            data: [65, 23, 80, 31, 56, 85, 48, 25, 98, 80, 75, 56],
            borderWidth: 3,
            borderColor: "rgb(235,134,43)",
            tension: 0.4,
            yAxisID: "precentage",
        },
        {
            label: "Total:",
            data: [65, 23, 20, 31, 51, 85, 48, 25, 28, 80, 75, 56],
            borderWidth: 3,
            borderColor: "rgb(179, 129, 244)",
            tension: 0.4,
            yAxisID: "precentage-kerugian1",
        },
        {
            label: "Total:",
            data: [55, 23, 20, 31, 21, 85, 68, 25, 89, 40, 75, 76],
            borderWidth: 3,
            borderColor: "rgb(207,245,0)",
            tension: 0.4,
            yAxisID: "precentage-kerugian2",
        },
    ],
};
const configPerbandinganKeuntunganPertahun = {
    type: "line",
    data: dataPerbandinganPenghasilanPertahun,
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
                    callback: function (value) {
                        return `${value} M`;
                    }
                },
                border: {
                    display: false,
                },
                grid: {
                    display: false, // hilangkan garis vertikal
                }
            },
            "precentage-kerugian1": {
                beginAtZero: true,
                position: 'left',
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
            },
            "precentage-kerugian2": {
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
            },
            x: {
                grid: {
                    display: true,
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
const canvasIDPerbandinganKeuntunganPertahun = document.getElementById(
    "pebandingan-keuntungan-pertahun"
);
new Chart(canvasIDPerbandinganKeuntunganPertahun, configPerbandinganKeuntunganPertahun);
