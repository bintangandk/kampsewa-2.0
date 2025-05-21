// Fetch API total keuntungan
async function fetchApiTotalKeuntungan() {
    const url = "/api/chart/monthly-income"; // URL telah diganti
    try {
        const response = await fetch(url, { mode: "cors" }); // Use 'cors' mode
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error fetching data:", error);
        return null; // Return null in case of error
    }
}

fetchApiTotalKeuntungan()
    .then((data) => {
        if (data) {
            const getKeuntungan = data.total.total_keuntungan;
            console.log(getKeuntungan);

            // Convert formatted string like "1,405M" to number 1405000000
            const parseKeuntungan = (str) =>
                parseFloat(str.replace(/,/g, "").replace("M", "")) * 1000000;

            const keuntunganTahunIni = parseKeuntungan(
                getKeuntungan.keuntungan_tahun_saat_ini
            );
            const keuntunganTahunLalu = parseKeuntungan(
                getKeuntungan.keuntungan_tahun_lalu
            );

            const keuntungan = document.getElementById("chart-keuntungan");

            const dataChartKeuntungan = {
                labels: ["Tahun ini", "Tahun lalu"],
                datasets: [
                    {
                        label: "Keuntungan",
                        data: [keuntunganTahunIni, keuntunganTahunLalu],
                        backgroundColor: ["rgb(54, 162, 235)", "#F2F5FD"],
                        hoverOffset: 4,
                        borderRadius: 10,
                    },
                ],
            };

            const configKeuntungan = {
                type: "doughnut",
                data: dataChartKeuntungan,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            };

            new Chart(keuntungan, configKeuntungan);
        } else {
            // Add manual data if fetch API fails
            const keuntungan = document.getElementById("chart-keuntungan");

            const dataChartKeuntungan = {
                labels: ["Tahun ini", "Tahun lalu"],
                datasets: [
                    {
                        label: "Keuntungan",
                        data: [1500000000, 1000000000], // Manual data in the same unit (1.5M and 1M)
                        backgroundColor: ["rgb(54, 162, 235)", "#F2F5FD"],
                        hoverOffset: 4,
                        borderRadius: 10,
                    },
                ],
            };

            const configKeuntungan = {
                type: "doughnut",
                data: dataChartKeuntungan,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            };

            new Chart(keuntungan, configKeuntungan);
        }
    })
    .catch((error) => {
        console.error("Error fetching data:", error);
    });
