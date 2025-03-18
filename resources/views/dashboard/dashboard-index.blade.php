@extends('layout-folder.app-layout')

@section('content')

<div class="container mt-5">
    <h1>Tableau de Bord</h1>

    <div class="row">
        <!-- Graphique des sexes -->
        <div class="col-md-4">
            <h3>Répartition des sexes</h3>
            <canvas id="sexChart" width="400" height="400"></canvas>
        </div>

        <!-- Graphique des tranches d'âges -->
        <div class="col-md-4">
            <h3>Répartition des tranches d'âges</h3>
            <canvas id="ageChart" width="400" height="400"></canvas>
        </div>

        <!-- Graphique des événements par catégorie -->
        <div class="col-md-4">
            <h3>Répartition des événements par catégorie</h3>
            <canvas id="eventCategoryChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    // Données du graphique des sexes
    const sexData = @json($sexes);
    const sexLabels = sexData.map(item => item.sex);
    const sexCounts = sexData.map(item => item.count);

    const sexChart = new Chart(document.getElementById('sexChart'), {
        type: 'pie',
        data: {
            labels: sexLabels,
            datasets: [{
                data: sexCounts,
                backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe'],  // couleurs du camembert
                hoverBackgroundColor: ['#ff4384', '#36a2eb', '#cc65fe']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' utilisateurs';
                        }
                    }
                }
            }
        }
    });

    // Données du graphique des tranches d'âges
    const ageData = @json($ageGroups);
    const ageLabels = ageData.map(item => item.age_group + ' ans');
    const ageCounts = ageData.map(item => item.count);


    const ageColors = [
    '#118B50',  // 1ère barre
    '#36a2eb',  // 2ème barre
    '#cc65fe',  // 3ème barre
    '#ffcc00',  // 4ème barre
    '#ff5733',  // 5ème barre
    '#28a745',  // 6ème barre
    '#ffc107',  // 7ème barre
    '#17a2b8'   // 8ème barre, etc.
];


    const ageChart = new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Tranches d\'âge',
                data: ageCounts,
                backgroundColor: ageColors.slice(0, ageCounts.length), // Assurez-vous que le nombre de couleurs est suffisant
                borderColor: '#36a2eb',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' utilisateurs';
                        }
                    }
                }
            }
        }
    });

    // Données du graphique des événements par catégorie
    const eventCategoryData = @json($eventCategories);
    const eventCategoryLabels = eventCategoryData.map(item => item.category);
    const eventCategoryCounts = eventCategoryData.map(item => item.count);

    const eventCategoryChart = new Chart(document.getElementById('eventCategoryChart'), {
        type: 'bar',
        data: {
            labels: eventCategoryLabels,
            datasets: [{
                label: 'Événements par catégorie',
                data: eventCategoryCounts,
                backgroundColor: '#ff6384',
                borderColor: '#ff6384',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' événements';
                        }
                    }
                }
            }
        }
    });
</script>
<br>
<br>
@endsection
