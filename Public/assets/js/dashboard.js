
document.addEventListener('DOMContentLoaded', function () {
    const emailList = document.getElementById('emailList');
    const projectList = document.getElementById('projectList');
    const addProjectForm = document.getElementById('addProjectForm');

    // Liste fictive des emails (à remplacer par un fetch si besoin)
    const emails = ['email1@domain.com', 'email2@domain.com'];

    // Affichage des emails
    function renderEmails() {
        emailList.innerHTML = '';
        emails.forEach(email => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.textContent = email;
            emailList.appendChild(li);
        });
    }

    // Chargement dynamique des projets depuis la base de données
    function loadProjects() {
        fetch("/Dashboard/listeProjets")
            .then(res => {
                console.log("📡 Réponse brute reçue :", res);
                return res.json();
            })
            .then(projects => {
                console.log("✅ Projets JSON :", projects);

                const debugZone = document.getElementById("debug");
                if (debugZone) {
                    debugZone.innerHTML = `<pre>${JSON.stringify(projects, null, 2)}</pre>`;
                }

                renderProjects(projects);
            })
            .catch(err => {
                console.error("❌ Erreur lors du chargement des projets :", err);

                const debugZone = document.getElementById("debug");
                if (debugZone) {
                    debugZone.innerHTML = `<span style="color:red;">Erreur : ${err}</span>`;
                }
            });
    }

    // Affichage des projets dans le tableau
    function renderProjects(projects) {
        projectList.innerHTML = '';

        if (!Array.isArray(projects)) {
            projectList.innerHTML = "<tr><td colspan='4' style='color:red;'>❌ Données invalides</td></tr>";
            return;
        }

        projects.forEach((project, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${project.name}</td>
                <td>${project.status}</td>
                <td>
                    <button class="btn btn-warning btn-sm">Modifier</button>
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </td>
            `;
            projectList.appendChild(tr);
        });
    }

    // Soumission du formulaire pour ajouter un projet
    addProjectForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const projectName = document.getElementById('projectName').value;
        const projectStatus = document.getElementById('projectStatus').value;
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        fetch("/Dashprojet/ajoutProjet", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                name: projectName,
                status: projectStatus,
                csrf_token: csrf
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    loadProjects(); // Recharge la liste depuis la base
                    document.getElementById('projectName').value = '';
                    document.getElementById('projectStatus').value = 'en-cours';

                    const modalEl = document.getElementById('addProjectModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                console.error("Erreur : ", err);
                alert("Erreur réseau.");
            });
    });

    // Initialisation
    renderEmails();
    loadProjects();
});
