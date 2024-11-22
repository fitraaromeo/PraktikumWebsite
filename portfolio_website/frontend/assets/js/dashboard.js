// Ambil data proyek dari API dan tampilkan di dashboard
fetch('http://localhost:8000/api/projects')
  .then(response => response.json())
  .then(response => {
    // Periksa apakah respons memiliki struktur yang diharapkan
    if (response.status === "success" && Array.isArray(response.data)) {
      const projectsContainer = document.getElementById('projectsContainer');
      projectsContainer.innerHTML = '';  // Kosongkan container sebelumnya
      // Iterasi dan tampilkan proyek dalam bentuk card
      response.data.forEach(project => {
        const projectCard = document.createElement('div');
        projectCard.classList.add('project-card');
        projectCard.innerHTML = `
          <h4>${project.title}</h4>
          <p>${project.description}</p>
          <button class="edit-button" onclick="editProject(${project.id})">Edit</button>
          <button class="delete-button" onclick="deleteProject(${project.id})">Delete</button>
        `;
        projectsContainer.appendChild(projectCard);
      });

      document.getElementById('totalProjects').textContent = response.data.length;
      document.getElementById('completedProjects').textContent = response.data.filter(p => p.completed).length;
      document.getElementById('pendingProjects').textContent = response.data.filter(p => !p.completed).length;
    } else {
      console.error("Invalid response structure:", response);
    }
  })
  .catch(error => console.error('Error fetching projects:', error));

// Fungsi untuk mengedit proyek
function editProject(projectId) {
  selectedProjectId = projectId;

  fetch(`http://localhost:8000/api/projects/?id=${projectId}`)
    .then(response => {
      // Pastikan response adalah OK dan status 200
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();  // Parse ke JSON jika response valid
    })
    .then(responseData => {
      // Cek apakah status response sukses
      if (responseData.status === "success" && responseData.data) {
        const project = responseData.data;  // Ambil project dari data
        document.getElementById('editId').value = project.id;
        document.getElementById('editTitle').value = project.title;
        document.getElementById('editDescription').value = project.description;
        document.getElementById('editModal').style.display = 'block';
      } else {
        throw new Error('Project not found or invalid response');
      }
    })
    .catch(error => {
      console.error('Error fetching project:', error);
      alert('Error fetching project details.');
    });
}


// Tutup modal
function closeModal() {
  document.getElementById('editModal').style.display = 'none';
}

// Simpan perubahan
document.getElementById('editForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const updatedProject = {
    id: document.getElementById('editId').value,
    title: document.getElementById('editTitle').value,
    description: document.getElementById('editDescription').value,
  };

  fetch(`http://localhost:8000/api/projects/`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(updatedProject),
  })
    .then(response => {
      // Cek apakah response adalah OK (status 200)
      if (!response.ok) {
        throw new Error('Failed to update project. Server responded with error');
      }
      return response.json();  // Parsing ke JSON
    })
    .then(data => {
      alert(data.message || 'Project updated successfully!');
      closeModal();
      location.reload();
    })
    .catch(error => {
      console.error('Error updating project:', error);
      alert('Error updating project. Please try again later.');
    });
});


// Fungsi untuk menghapus proyek
function deleteProject(projectId) {
  if (confirm('Are you sure you want to delete this project?')) {
    fetch('http://localhost:8000/api/projects', {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: projectId }),
    })
      .then(response => response.json())
      .then(data => {
        alert(data.message);  // Menampilkan pesan sukses/gagal
        location.reload();  // Reload halaman untuk menampilkan data terbaru
      })
      .catch(error => console.error('Error deleting project:', error));
  }
}
