document.getElementById('projectForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Cegah reload halaman default dari form

  // Ambil data dari input form
  const title = document.getElementById('projectTitle').value;
  const description = document.getElementById('projectDescription').value;

  // Validasi data input
  if (!title || !description) {
    alert('Please fill out all fields!');
    return;
  }

  console.log('Submitting data:', { title, description }); // Debug log

  // Kirim data ke backend menggunakan POST
  fetch('http://localhost:8000/', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      title: title,
      description: description,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Failed to submit data');
      }
      return response.json();
    })
    .then((data) => {
      alert('Project added successfully!');
      console.log('Response:', data);
      // Reset form setelah submit
      document.getElementById('projectForm').reset();
    })
    .catch((error) => {
      console.error('Error:', error);
      alert('Failed to submit project. Please try again.');
    });
});
