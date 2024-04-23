<?php include "inc/header.view.php"; ?>
<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }
</style>


<div class="table-section" style=" padding-bottom:0; padding-top:0;">
    <div class="buttons-container">
        <a href="<?= ROOT ?>/gm/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all top-btn-selected" id="all-btn">Overview</a>
        <a href="<?= ROOT ?>/gm/orders/retail" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending" id="pen-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/gm/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing " id="pro-btn">Bulk Orders</a>
    </div>
    <h2 class="table-section__title" style=" margin-bottom:0">Overview</h2>
</div>

<div class="dashboard2">
    <div class="charts-card">
        <!-- <p class="chart-title">Sales</p> -->
        <div id="chart"></div>
    </div>
    <div class="charts-card">
        <!-- <p class="chart-title">Sales</p> -->
        <div id="chart2"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.2/apexcharts.min.js"></script>
<script>
    url1 = "<?= ROOT ?>/fetch/retail_chart";
    product_names = [];
    quantities = [];

    fetch(url1)
        .then(response => response.json())
        .then(data => {
                // console.log(data);
                // chart.updateSeries(data);
                product_names = data.product_names
                quantities = data.quantities

                // console.log(product_names);
                // console.log(quantities);

                var options = {
                    series: quantities,
                    chart: {
                        width: '100%',
                        type: 'pie',
                    },
                    labels: product_names,
                    theme: {
                        monochrome: {
                            enabled: true,
                            color: '#212121',
                            shadeTo: 'light',
                            shadeIntensity: 0.65
                        }
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                offset: -5
                            }
                        }
                    },
                    title: {
                        text: "Retail Order Sales",
                        style: {
                            fontSize: '18px',
                            fontFamily:'Montserrat,sans-serif',
                            fontWeight:'600'

                        }
                        },
                        dataLabels: {
                            formatter(val, opts) {
                                const name = opts.w.globals.labels[opts.seriesIndex]
                                return [name, val.toFixed(1) + '%']
                            }
                        },
                        legend: {
                            show: false
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                });


            url2 = "<?= ROOT ?>/fetch/blk_chart"; product_names = []; quantities = []; fetch(url2)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                // chart2.updateSeries(data);
                product_names = data.product_names
                quantities = data.quantities

                // console.log(product_names);
                // console.log(quantities);

                var options2 = {
                    series: quantities,
                    chart: {
                        width: '100%',
                        type: 'pie',
                    },
                    labels: product_names,
                    theme: {
                        monochrome: {
                            enabled: true,
                            color: '#212121',
                            shadeTo: 'light',
                            shadeIntensity: 0.65
                        }
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                offset: -5
                            }
                        }
                    },
                    title: {
                        text: "Bulk Order Sales",
                        style: {
                            fontSize: '18px',
                            fontFamily:'Montserrat,sans-serif',
                            fontWeight:'600'

                        }
                    },
                    dataLabels: {
                        formatter(val, opts) {
                            const name = opts.w.globals.labels[opts.seriesIndex]
                            return [name, val.toFixed(1) + '%']
                        }
                    },
                    legend: {
                        show: false
                    }
                };

                var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
                chart2.render();
            });
</script>
<?php include "inc/footer.view.php"; ?>