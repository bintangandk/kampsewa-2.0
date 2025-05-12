// Fetch API total keuntungan
async function fetchApiTotalKerugian() {
    const url = "/api/chart-keuntungan-menu-dashboard";
    try {
        const response = await fetch(url, { mode: 'cors' }); // Use 'cors' mode
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        return null; // Return null in case of error
    }
}

fetchApiTotalKerugian().then(data => {
    if (data) {
        const getKerugian = data.total.total_kerugian;
        console.log(getKerugian);

        // Convert formatted string like "1,405M" to number 1405000000
        const parseKerugian = (str) => parseFloat(str.replace(/,/g, '').replace('M', '')) * 1000000;

        const kerugianTahunIni = parseKerugian(getKerugian.kerugian_tahun_saat_ini);
        const kerugianTahunLalu = parseKerugian(getKerugian.kerugian_tahun_lalu);

        const kerugian = document.getElementById("chart-kerugian");

        const dataChartKerugian = {
            labels: ["Tahun ini", "Tahun lalu"],
            datasets: [
                {
                    label: "Kerugian",
                    data: [
                        kerugianTahunIni,
                        kerugianTahunLalu,
                    ],
                    backgroundColor: [
                        "rgb(54, 162, 235)",
                        "#F2F5FD",
                    ],
                    hoverOffset: 4,
                    borderRadius: 10,
                },
            ],
        };

        const configKerugian = {
            type: "doughnut",
            data: dataChartKerugian,
            options: {
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        };

        new Chart(kerugian, configKerugian);
    } else {
        // Add manual data if fetch API fails
        const kerugian = document.getElementById("chart-Kerugian");

        const dataChartKerugian = {
            labels: ["Tahun ini", "Tahun lalu"],
            datasets: [
                {
                    label: "Kerugian",
                    data: [1500000000, 1000000000],
                    backgroundColor: [
                        "rgb(54, 162, 235)",
                        "#F2F5FD",
                    ],
                    hoverOffset: 4,
                    borderRadius: 10,
                },
            ],
        };

        const configKerugian = {
            type: "doughnut",
            data: dataChartKerugian,
            options: {
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        };

        new Chart(kerugian, configKerugian);
    }
}).catch(error => {
    console.error('Error fetching data:', error);
});
