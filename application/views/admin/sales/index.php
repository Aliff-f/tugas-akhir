<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Penjualan - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #f3f4f6; }
        
        /* --- Utilities Neo-Brutalism Custom --- */
        .nb-box {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 6px 6px 0px #000;
            border-radius: 8px;
        }

        .nb-btn {
            transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            font-weight: 700;
            text-transform: uppercase;
        }

        .nb-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000;
        }

        .nb-btn:active {
            transform: translate(0px, 0px);
            box-shadow: 0px 0px 0px #000;
        }

        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { height: 10px; }
        .custom-scroll::-webkit-scrollbar-track { background: #eee; border-top: 2px solid #000; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #000; border-radius: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #444; }
    </style>
</head>
<body class="text-black">

<section class="w-full lg:ps-80 min-h-screen py-12 px-8 md:px-12 lg:px-16">
    <div class="max-w-[1600px] mx-auto space-y-10">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <div class="inline-block px-3 py-1 bg-black text-white text-xs font-bold mb-3 transform -rotate-2">
                    ANALYTICS DASHBOARD
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-tighter leading-none">
                    Analisis <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-orange-500 to-red-600" style="-webkit-text-stroke: 1.5px black;">Penjualan</span>
                    <span class="inline-flex items-center gap-2 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded ml-2 align-middle animate-pulse border border-black shadow-[2px_2px_0_0_#000]">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> LIVE
                    </span>
                </h1>
                <p class="text-gray-500 font-bold mt-3 max-w-lg text-sm md:text-base">
                    Monitor performa penjualan, pendapatan, dan produk terlaris secara real-time.
                </p>
            </div>
            
            <div class="flex gap-4">
                <div class="nb-box bg-purple-300 px-8 py-5 flex flex-col items-center justify-center min-w-[200px] transform rotate-1 border-[3px]">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60">Insight</span>
                    <span class="text-2xl font-black mt-1 uppercase" id="insight-text">Grow Up! 🚀</span>
                </div>
                
                <div class="nb-box bg-green-400 px-8 py-5 flex flex-col items-center justify-center min-w-[200px] transform -rotate-1 border-[3px]">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Total Revenue</span>
                    <span class="text-2xl font-black mt-1 uppercase" id="total-revenue-text">Rp <?= number_format($total_revenue, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>

        <!-- Charts Grid 1 (Weekly & Monthly) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Weekly Chart -->
            <div class="nb-box p-6 relative">
                <div class="absolute -top-3 -left-3 bg-yellow-400 border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-[2px_2px_0_0_#000]">
                    Weekly Limit
                </div>
                <h2 class="font-black text-2xl uppercase mb-6 flex items-center gap-2 border-b-2 border-black pb-2">
                    <i class="fa-solid fa-chart-line text-yellow-600"></i> Penjualan 7 Hari Terakhir
                </h2>
                <div class="relative h-64 w-full">
                    <canvas id="weeklySalesChart"></canvas>
                </div>
            </div>

            <!-- Monthly Chart -->
            <div class="nb-box p-6 relative">
                <div class="absolute -top-3 -right-3 bg-blue-400 border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-[2px_2px_0_0_#000]">
                    Monthly Trends
                </div>
                <h2 class="font-black text-2xl uppercase mb-6 flex items-center gap-2 border-b-2 border-black pb-2">
                    <i class="fa-solid fa-chart-line text-blue-600"></i> Penjualan 30 Hari Terakhir
                </h2>
                <div class="w-full overflow-x-auto pb-4 custom-scroll">
                    <div class="relative h-64 min-w-[1200px]">
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Yearly Chart & Top Products -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Yearly Chart -->
            <div class="lg:col-span-2 nb-box p-6 relative">
                <div class="absolute -top-3 -left-3 bg-red-400 border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-[2px_2px_0_0_#000]">
                    Annual Overview
                </div>
                <h2 class="font-black text-2xl uppercase mb-6 flex items-center gap-2 border-b-2 border-black pb-2">
                    <i class="fa-solid fa-chart-line text-red-600"></i> Penjualan 12 Bulan Terakhir
                </h2>
                <div class="relative h-80 w-full">
                    <canvas id="yearlySalesChart"></canvas>
                </div>
            </div>

            <!-- Top Products -->
            <div class="nb-box p-6 relative bg-white">
                <div class="absolute -top-3 -right-3 bg-yellow-300 border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-[2px_2px_0_0_#000]">
                    Most Popular
                </div>
                <h2 class="font-black text-2xl uppercase mb-6 flex items-center gap-2 border-b-2 border-black pb-2">
                    <i class="fa-solid fa-trophy text-yellow-500"></i> Produk Terlaris
                </h2>
                
                <div class="space-y-4" id="top-products-container">
                    <?php if (!empty($top_products)): ?>
                        <?php foreach ($top_products as $index => $product): ?>
                            <div class="flex items-center gap-4 border-b-2 border-dashed border-gray-300 pb-3 last:border-0">
                                <span class="font-black text-3xl text-gray-300">#<?= $index + 1 ?></span>
                                <img src="<?= base_url('public/uploads/' . $product['image_url']) ?>" class="w-12 h-12 object-cover border-2 border-black rounded shadow-[2px_2px_0_0_#000]" alt="Product">
                                <div class="flex-1">
                                    <h5 class="font-bold text-sm uppercase leading-tight"><?= $product['name'] ?></h5>
                                    <span class="text-xs text-gray-500 font-bold"><?= $product['total_sold'] ?> Terjual</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500 font-bold">Belum ada data penjualan.</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const FONT_FAMILY = "'Space Grotesk', sans-serif";
    const base_url = '<?= base_url() ?>';
    
    let weeklyChart, monthlyChart, yearlyChart;

    function formatDate(dateString) {
        const options = { day: 'numeric', month: 'short' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    // --- Chart Shared Styles & Options ---
    const lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            line: { tension: 0.3, borderWidth: 4, borderColor: '#000' },
            point: { radius: 6, hoverRadius: 8, backgroundColor: '#fff', borderWeight: 3, borderColor: '#000' }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#000',
                titleFont: { family: FONT_FAMILY, weight: 'bold' },
                bodyFont: { family: FONT_FAMILY },
                padding: 12,
                cornerRadius: 8,
                displayColors: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#000', font: { family: FONT_FAMILY, weight: 'bold' } },
                grid: { color: 'rgba(0,0,0,0.1)', borderDash: [5, 5] }
            },
            x: {
                ticks: { color: '#000', font: { family: FONT_FAMILY, weight: 'bold' } },
                grid: { display: false }
            }
        }
    };

    async function fetchSalesData() {
        try {
            const response = await fetch(`${base_url}Admin/api_sales`);
            const data = await response.json();
            updateDashboard(data);
        } catch (error) {
            console.error('Error fetching sales data:', error);
        }
    }

    function updateDashboard(data) {
        // Update Revenue
        document.getElementById('total-revenue-text').innerText = data.total_revenue_formatted;

        // --- Process Weekly Data ---
        const last7Days = [];
        const weeklySalesCounts = [];
        for (let i = 6; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            const dateStr = d.toISOString().split('T')[0];
            last7Days.push(formatDate(dateStr));
            const match = data.weekly_sales.find(item => item.date === dateStr);
            weeklySalesCounts.push(match ? parseInt(match.total_sales) : 0);
        }

        // --- Process Monthly Data ---
        const last30Days = [];
        const monthlySalesCounts = [];
        for (let i = 29; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            const dateStr = d.toISOString().split('T')[0];
            last30Days.push(formatDate(dateStr));
            const match = data.monthly_sales.find(item => item.date === dateStr);
            monthlySalesCounts.push(match ? parseInt(match.total_sales) : 0);
        }

        // --- Process Yearly Data ---
        const yearlyLabels = [];
        const yearlySalesCounts = [];
        for(let i = 11; i >= 0; i--) {
            const d = new Date();
            d.setMonth(d.getMonth() - i);
            const monthName = d.toLocaleString('id-ID', { month: 'short' });
            const year = d.getFullYear();
            const key = `${year}-${String(d.getMonth() + 1).padStart(2, '0')}`;
            yearlyLabels.push(`${monthName} ${year}`);
            const match = data.yearly_sales.find(item => item.month_year === key);
            yearlySalesCounts.push(match ? parseInt(match.total_sales) : 0);
        }

        // Initial creation or full data update
        if (!weeklyChart) {
            initCharts(last7Days, weeklySalesCounts, last30Days, monthlySalesCounts, yearlyLabels, yearlySalesCounts);
        } else {
            weeklyChart.data.labels = last7Days;
            weeklyChart.data.datasets[0].data = weeklySalesCounts;
            weeklyChart.update('none');

            monthlyChart.data.labels = last30Days;
            monthlyChart.data.datasets[0].data = monthlySalesCounts;
            monthlyChart.update('none');

            yearlyChart.data.labels = yearlyLabels;
            yearlyChart.data.datasets[0].data = yearlySalesCounts;
            yearlyChart.update('none');
        }

        // Update Top Products
        let productsHtml = '';
        if (data.top_products.length > 0) {
            data.top_products.forEach((product, index) => {
                productsHtml += `
                    <div class="flex items-center gap-4 border-b-2 border-dashed border-gray-300 pb-3 last:border-0">
                        <span class="font-black text-3xl text-gray-300">#${index + 1}</span>
                        <img src="${base_url}public/uploads/${product.image_url}" class="w-12 h-12 object-cover border-2 border-black rounded shadow-[2px_2px_0_0_#000]" alt="Product">
                        <div class="flex-1">
                            <h5 class="font-bold text-sm uppercase leading-tight">${product.name}</h5>
                            <span class="text-xs text-gray-500 font-bold">${product.total_sold} Terjual</span>
                        </div>
                    </div>`;
            });
        } else {
            productsHtml = '<div class="text-center py-8 text-gray-500 font-bold">Belum ada data penjualan.</div>';
        }
        document.getElementById('top-products-container').innerHTML = productsHtml;
    }

    function initCharts(wLabels, wData, mLabels, mData, yLabels, yData) {
        weeklyChart = new Chart(document.getElementById('weeklySalesChart'), {
            type: 'line',
            data: {
                labels: wLabels,
                datasets: [{
                    data: wData,
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    fill: true
                }]
            },
            options: lineChartOptions
        });

        monthlyChart = new Chart(document.getElementById('monthlySalesChart'), {
            type: 'line',
            data: {
                labels: mLabels,
                datasets: [{
                    data: mData,
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    fill: true
                }]
            },
            options: { ...lineChartOptions, scales: { ...lineChartOptions.scales, x: { ...lineChartOptions.scales.x, ticks: { ...lineChartOptions.scales.x.ticks, maxTicksLimit: 30 } } } }
        });

        yearlyChart = new Chart(document.getElementById('yearlySalesChart'), {
            type: 'line',
            data: {
                labels: yLabels,
                datasets: [{
                    data: yData,
                    backgroundColor: 'rgba(248, 113, 113, 0.2)',
                    fill: true
                }]
            },
            options: lineChartOptions
        });
    }

    // Load initial data
    fetchSalesData();

    // Set interval for real-time (every 30 seconds)
    setInterval(fetchSalesData, 30000);
</script>

</body>
</html>
