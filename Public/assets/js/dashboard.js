// dashboard.js
document.addEventListener('DOMContentLoaded', function () {
    const emailList = document.getElementById('emailList');
    const projectList = document.getElementById('projectList');
    const addProjectForm = document.getElementById('addProjectForm');

    // Données fictives pour l'exemple
    const emails = ['email1@domain.com', 'email2@domain.com'];
    const projects = [
        { name: 'Projet A', status: 'en-cours' },
        { name: 'Projet B', status: 'terminé' }
    ];

    // Fonction pour afficher les emails
    function renderEmails() {
        emailList.innerHTML = '';
        emails.forEach(email => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.textContent = email;
            emailList.appendChild(li);
        });
    }

    // Fonction pour afficher les projets
    function renderProjects() {
        projectList.innerHTML = '';
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

    // Ajouter un projet
    addProjectForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const projectName = document.getElementById('projectName').value;
        const projectStatus = document.getElementById('projectStatus').value;
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        fetch("/Dashprojet/ajoutProjet", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                name: projectName,
                status: projectStatus,
                csrf_token: csrf
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                projects.push({ name: projectName, status: projectStatus });
                renderProjects();
                document.getElementById('projectName').value = '';
                document.getElementById('projectStatus').value = 'en-cours';
                bootstrap.Modal.getInstance(document.getElementById('addProjectModal')).hide();
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error("Erreur : ", err));
    });

    renderEmails();
    renderProjects();
});