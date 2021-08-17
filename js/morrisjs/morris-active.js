// Da
    
Morris.Area({
        element: 'extra-area-chart',
        data: [ {
            period: '2020-01',
            Journalier: 105,
            Hepdomadaire: 100,
            Mensuel: 80
        },
         {
            period: '2020-02',
            Journalier: 105,
            Hepdomadaire:50,
            Mensuel: 80
        },
         {
            period: '2021',
            Journalier: 250,
            Hepdomadaire: 150,
            Mensuel: 200
        }],
        xkey: 'period',
        ykeys: ['Journalier', 'Hepdomadaire', 'Mensuel'],
        labels: ['Journalier', 'Hepdomadaire', 'Mensuel'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#006DF0', '#933EC5', '#65b12d'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 1,
        hideHover: 'auto',
        lineColors: ['#006DF0', '#933EC5', '#65b12d'],
        resize: true
        
    });