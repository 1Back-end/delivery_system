<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <h5 class="font-16 text-uppercase">Tableau de bord</h5>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">

        <div class="col-lg-3 col-sm-12 mb-3">
        <div class="card-box p-3 h-100 text-center">
            <div class="mb-3">
                <h6 class="text-uppercase font-12">Nombre total de colis</h6>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="mr-auto logo">
                        <span class="icon-pending text-white font-weight-bold">
                            <i class="fas fa-box fs-3"></i> <!-- Icône de colis -->
                        </span>
                    </div>
                    <div class="ml-auto">
                        <h6><?php echo $count_package; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-12 mb-3">
        <div class="card-box p-3 h-100 text-center">
        <?php
            // Définir l'objectif à 500 colis
            $goal = 500;

            // Calculer le pourcentage de progression
            $progress_percentage = ($total_packages / $goal) * 100;
            $progress_percentage = min(100, $progress_percentage); // S'assurer que la progression ne dépasse pas 100%
            ?>

            <!-- Affichage de la barre de progression -->
            <div style="width: 100%; background-color: #f3f3f3; border: 1px solid #ddd; border-radius: 5px;">
                <div style="width: <?= $progress_percentage ?>%; background-color: #4caf50; height: 25px; border-radius: 5px;">
                    <span style="color: white; padding-left: 10px;"><?= round($progress_percentage) ?>%</span>
                </div>
            </div>

            <p class="mt-3">Colis total: <?= $total_packages ?> / <?= $goal ?> colis</p>
    
        </div>
    </div>






            
        </div>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">

        <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
            <div class="card-box p-3 h-100">
                <!-- <h6 class="mb-3 font-14 text-uppercase">Nombre de commandes par statut</h6> -->
                <canvas id="packageStatusBarChart"></canvas>
                <!-- <canvas id="orderStatusChart" width="400" height="200"></canvas> -->
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
            <div class="card-box p-3 h-100">
                <!-- <h6 class="mb-3 font-14 text-uppercase">Nombre de commandes par statut</h6> -->
                <canvas id="warehouseChart" width="400" height="200"></canvas>
            </div>
        </div>

    </div>
</div>



<script>
        var ctx = document.getElementById('warehouseChart').getContext('2d');
        var warehouseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($warehouses); ?>, // Les noms des entrepôts
                datasets: [{
                    label: 'Nombre de véhicules',
                    data: <?php echo json_encode($vehicles); ?>, // Les nombres de véhicules par entrepôt
                    backgroundColor: '#1F4283', // Couleur des barres pour les véhicules
                    borderColor: '#1F4283',
                    borderWidth: 1
                }, {
                    label: 'Nombre de chauffeurs',
                    data: <?php echo json_encode($drivers); ?>, // Les nombres de chauffeurs par entrepôt
                    backgroundColor: '#28a745', // Couleur des barres pour les chauffeurs
                    borderColor: '#28a745',
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
                    title: {
                        display: true,
                        text: 'Statistiques des Entrepôts'
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>




<script>
    // Définir la police par défaut pour Chart.js
    Chart.defaults.font.family = 'Rubik';

    // Récupérer les données PHP et les formater pour Chart.js
    var data = <?php echo json_encode($stats); ?>;

    // Préparer les labels et les valeurs
    var labels = Object.keys(data); // Statuts
    var values = Object.values(data); // Comptage des colis par statut

    // Définir des couleurs pour chaque statut
    var colors = {
        'en attente': '#FFEB3B',  // Jaune vif (en attente)
        'en cours': '#2196F3',    // Bleu vif (en cours)
        'livré': '#4CAF50',       // Vert (livré)
        'perdu': '#9C27B0',       // Violet (perdu)
        'annulé': '#F44336'       // Rouge (annulé)
    };

    // Assigner les couleurs à chaque barre en fonction du statut
    var backgroundColors = labels.map(function(status) {
        return colors[status] || '#B0BEC5'; // Couleur par défaut (gris) si le statut n'est pas défini
    });

    // Créer le graphique à barres
    var ctx = document.getElementById('packageStatusBarChart').getContext('2d');
    var packageStatusBarChart = new Chart(ctx, {
        type: 'bar', // Type de graphique (barres)
        data: {
            labels: labels, // Statuts
            datasets: [{
                label: 'Répartition des colis par statut',
                data: values, // Nombre de colis par statut
                backgroundColor: backgroundColors, // Couleurs personnalisées pour chaque barre
                borderColor: backgroundColors.map(function(color) {
                    return color.replace('0.5', '1'); // Bordure des barres avec une couleur plus foncée
                }),
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
                title: {
                    display: true,
                    text: 'Répartition des colis par statut'
                },
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' colis';
                        }
                    }
                }
            }
        }
    });
</script>
