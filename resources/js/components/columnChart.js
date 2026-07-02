// ApexCharts options and config
export default
console.log('success')
window.addEventListener("load", function() {
    let initialData = window.userStatsInitialData || [6500, 6418, 6456, 6526, 6356, 6456];
    let initialLabels = window.userStatsInitialLabels || ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'];

    let options = {
        chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
        },
        tooltip: {
        enabled: true,
        x: {
            show: false,
        },
        },
        fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#b17b4f",
            gradientToColors: ["#b17b4f"],
        },
        },
        dataLabels: {
        enabled: false,
        },
        stroke: {
        width: 6,
        },
        grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
        },
        series: [
        {
            name: "New users",
            data: initialData,
            color: "#b17b4f",
        },
        ],
        xaxis: {
        categories: initialLabels,
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        },
        yaxis: {
        show: false,
        },
    }

    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("area-chart"), options);
        chart.render();
        window.userStatsChart = chart; // Expose globally for dynamic updates
    }
    });

