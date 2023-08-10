// Morris bar chart
Morris.Bar({
    element: 'morris-bar-chart',
    data: [{
        y: one,
        a: 75,
        b: 65,
        c: 40
    }, {
        y: two,
        a: 50,
        b: 40,
        c: 30
    }, {
        y: three,
        a: 75,
        b: 65,
        c: 40
    }, {
        y: four,
        a: 50,
        b: 40,
        c: 30
    }, {
        y: five,
        a: 75,
        b: 65,
        c: 40
    }, {
        y: six,
        a: 100,
        b: 90,
        c: 40
    }],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Pending', 'Cancelled', 'Other'],
    barColors: ['#fec107', '#00c292', '#9675ce'],
    hideHover: 'auto',
    gridLineColor: '#eef0f2',
    resize: true
});

// Morris donut chart        
Morris.Donut({
    element: 'morris-donut-chart',
    data: [{
        label: "Pending",
        value: tocmp,

    }, {
        label: "Cancelled",
        value: tocmc,
    }, {
        label: "Other",
        value: tocmo,
    }],
    resize: true,
    colors: ['#fb9678', '#5b69bc', '#35b8e0']
});

$("#sparkline8").sparkline([2, 4, 4, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
    type: 'line',
    width: '100%',
    height: '130',
    lineColor: '#00c292',
    fillColor: 'rgba(0, 194, 146, 0.2)',
    maxSpotColor: '#00c292',
    highlightLineColor: 'rgba(0, 0, 0, 0.2)',
    highlightSpotColor: '#00c292'
});
$("#sparkline9").sparkline([0, 2, 8, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
    type: 'line',
    width: '100%',
    height: '130',
    lineColor: '#03a9f3',
    fillColor: 'rgba(3, 169, 243, 0.2)',
    minSpotColor: '#03a9f3',
    maxSpotColor: '#03a9f3',
    highlightLineColor: 'rgba(0, 0, 0, 0.2)',
    highlightSpotColor: '#03a9f3'
});
$("#sparkline10").sparkline([2, 4, 4, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
    type: 'line',
    width: '100%',
    height: '130',
    lineColor: '#fb9678',
    fillColor: 'rgba(251, 150, 120, 0.2)',
    maxSpotColor: '#fb9678',
    highlightLineColor: 'rgba(0, 0, 0, 0.2)',
    highlightSpotColor: '#fb9678'
});
