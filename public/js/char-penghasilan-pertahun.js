async function fetchApiChartPenghasilan() {
    const url = 'http://192.168.1.3:8000/api/chart-penghasilan-menu-penghasilan';
    try {
        const response = await fetch(url);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}

fetchApiChartPenghasilan().then(data => {
    if (data) {
        const getTotalPenghasilan = data.total_pemasukan_per_bulan;
        console.log(getTotalPenghasilan);

        const labels = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        const labelsCadangan = [
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

        // Extract the total income for each month from the API response
        const dataPenghasilan = labels.map(month => {
            const monthData = getTotalPenghasilan.find(item => item.month === month);
            return monthData ? parseInt(monthData.total, 10) : 0;
        });

        const dataPenghasilanPertahun = {
            labels: labelsCadangan,
            datasets: [
                {
                    label: "Total Penghasilan",
                    data: dataPenghasilan,
                    fill: true,
                    borderWidth: 3,
                    borderColor: "rgb(124,169,207)",
                    tension: 0.4,
                    backgroundColor: createGradient(),
                },
            ],
        };

        function createGradient() {
            const ctx = document.getElementById("penghasilan").getContext("2d");
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, "rgb(124,169,207)");
            gradient.addColorStop(1, "rgba(255,255,255,0)");
            return gradient;
        }

        const configPenghasilanPertahun = {
            type: "line",
            data: dataPenghasilanPertahun,
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
                    mode: 'index',
            intersect: false,
            callbacks: {
                label: function(tooltipItem, data) {
                    let label = data.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += tooltipItem.yLabel.toLocaleString(); // Mengubah nilai menjadi format angka dengan tanda pemisah ribuan
                    return label;
                }
            }
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
                            callback: function (value) {
                                // Hanya tampilkan label jika nilainya bukan 0
                                if (value !== 0) {
                                    return value.toLocaleString(); // Mengubah nilai menjadi format angka dengan tanda pemisah ribuan
                                }
                            },
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

        const penghasilan = document.getElementById("penghasilan");
        new Chart(penghasilan, configPenghasilanPertahun);
    }
});
