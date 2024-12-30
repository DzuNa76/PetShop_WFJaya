fetch("/api/monthly-earnings")
    .then((response) => response.json())
    .then((data) => {
        // Format data untuk grafik
        const labels = data.map((item) => `${item.month}-${item.year}`);
        const earnings = data.map((item) => item.total_earnings);

        // Buat grafik
        const ctx = document
            .getElementById("monthlyEarningsChart")
            .getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Penghasilan (IDR)",
                        data: earnings,
                        backgroundColor: "rgba(78, 115, 223, 0.1)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        borderWidth: 2,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.raw.toLocaleString(
                                    "id-ID",
                                    { style: "currency", currency: "IDR" }
                                );
                                return `${context.dataset.label}: ${value}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Month-Year",
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Earnings (IDR)",
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    });
