document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("addTaskBtn").addEventListener("click", addTask);
    loadTasks();
  });

  function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
  }

  function loadTasks() {
    fetch("/Dashboard/listetaches")
      .then((res) => res.json())
      .then((data) => {
        data.forEach((t) => renderTask(t));
      });
  }

  function renderTask(task) {
    const el = document.createElement("div");
    el.className = "task";
    el.draggable = true;
    el.id = "task-" + task.id;
    el.dataset.id = task.id;
    el.dataset.status = task.status;
    el.ondragstart = drag;

    const title = document.createElement("span");
    title.textContent = task.title;
    title.style.flex = "1";
    title.onclick = () => moveToDone(task.id);

    const del = document.createElement("button");
    del.textContent = "🗑";
    del.className = "delete-btn";
    del.onclick = (e) => {
      e.stopPropagation();
      deleteTask(task.id);
    };

    el.appendChild(title);
    el.appendChild(del);
    document.getElementById(task.status).appendChild(el);
  }

  function addTask() {
    const input = document.getElementById("taskInput");
    const title = input.value.trim();
    if (!title) return alert("Veuillez saisir une tâche.");

    const csrf = getCsrfToken();

    fetch("/Dashboard/ajoutTache", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ title, csrf_token: csrf }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          renderTask({ id: data.id, title, status: "todo" });
          input.value = "";
        } else {
          alert(data.message);
        }
      });
  }

  function deleteTask(id) {
    if (!confirm("Supprimer ?")) return;
    const csrf = getCsrfToken();

    fetch("/Dashboard/deleteTache", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ id, csrf_token: csrf }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          document.querySelector(`[data-id='${id}']`)?.remove();
        } else {
          alert(data.message);
        }
      });
  }

  function moveToDone(id) {
    if (!confirm("Marquer comme terminé ?")) return;
    const el = document.querySelector(`[data-id='${id}']`);
    document.getElementById("done").appendChild(el);
    updateTask(id, "done");
  }

  function updateTask(id, status) {
    const csrf = getCsrfToken();

    fetch("/Dashboard/updateTache", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ id, status, csrf_token: csrf }),
    });
  }

  function allowDrop(e) {
    e.preventDefault();
  }

  function drag(e) {
    e.dataTransfer.setData("text", e.target.id);
  }

  function drop(e) {
    e.preventDefault();
    const id = e.dataTransfer.getData("text").split("-")[1];
    const el = document.getElementById("task-" + id);
    const newStatus = e.target.id;
    document.getElementById(newStatus).appendChild(el);
    updateTask(id, newStatus);
  }