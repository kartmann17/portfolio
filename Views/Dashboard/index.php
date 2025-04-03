<?php $css = 'dashboard'; ?>
<section class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky pt-3">
                <h5 class="text-white text-center mb-4">Kreyatik Studio</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Emails</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#taskManager">Tâches</a>
                    </li>
                </ul>
                <button class="btn btn-primary mt-4" id="addProjectBtn" data-bs-toggle="modal" data-bs-target="#addProjectModal">Ajouter un projet</button>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2">Tableau de bord</h1>
                <div>
                    <a href="/log/logout" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">Déconnexion</a>
                    <button class="btn btn-light ms-3" id="searchBtn"><i class="fas fa-search"></i> Recherche</button>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <section class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Gains (Mensuel)</h5>
                            <p class="display-4">$40,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Gains (Annuel)</h5>
                            <p class="display-4">$215,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tâches Terminées</h5>
                            <p class="display-4">50%</p>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Revenue Chart Section -->
            <section>
                <h2>Revenus par Source</h2>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </section>

            <!-- Project Section -->
            <section>
                <h2>Projets en cours</h2>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Liste des projets</div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nom du projet</th>
                                    <th>Avancement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="projectList">
                                <!-- Liste dynamique des projets -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Task Manager Section -->
            <section id="taskManager" class="my-5">
                <h2 class="text-center mb-4">Gestionnaire de tâches</h2>
                <!-- Barre d'ajout -->
                <div class="input-group mb-3">
                    <input type="text" id="taskInput" class="form-control" placeholder="Ajouter une nouvelle tâche...">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <button class="btn btn-success" id="addTaskBtn">Ajouter</button>
                </div>

                <!-- Colonnes Trello -->
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4>À faire</h4>
                        <div id="todo" class="task-column" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                    </div>
                    <div class="col-md-4">
                        <h4>En cours</h4>
                        <div id="inprogress" class="task-column" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                    </div>
                    <div class="col-md-4">
                        <h4>Terminé</h4>
                        <div id="done" class="task-column" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</section>

<!-- Modal for adding project -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Ajouter un projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProjectForm" action="/Dashprojet/ajoutProjet">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="mb-3">
                        <label for="projectName" class="form-label">Nom du projet</label>
                        <input type="text" class="form-control" id="projectName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="projectStatus" class="form-label">Statut du projet</label>
                        <select class="form-select" id="projectStatus" name="status" required>
                            <option value="en-cours">En cours</option>
                            <option value="terminé">Terminé</option>
                            <option value="en-attente">En attente</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter le projet</button>
                </form>
            </div>
            <div id="error-message" class="alert alert-danger" role="alert"></div>
            <div id="success-message" class="alert alert-success" role="alert"></div>
        </div>
    </div>
</div>

<?php $script = 'dashboard';
$script = 'taches'; ?>