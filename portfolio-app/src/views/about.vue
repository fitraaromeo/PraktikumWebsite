<template>
    <div class="about-page">
      <section class="about-hero">
        <div class="container">
          <h1 class="about-title">About Me</h1>
          <p class="about-intro">
            Hello! I'm a passionate data scientist with a strong interest in analyzing data, building predictive models, and uncovering meaningful insights. Let me share my journey with you.</p>
        </div>
      </section>
  
      <section class="about-details">
        <div class="container">
          <div class="about-section">
            <h2>My Background</h2>
            <p>
                I am an active student of Informatics at University of Muhammadiyah Malang, I am currently pursuing an undergraduate education. I am interested in the computer field more precisely I am interested in the field of data scientist.
            </p>
          </div>
  
          <div class="about-section">
            <h2>Skills & Expertise</h2>
            <ul class="skills-list">
              <li>Frontend Development: Vue.js, HTML, CSS, JavaScript, PHP</li>
              <li>Backend Development: Laravel</li>
              <li>Database Management: MySQL</li>
              <li>Version Control: Git, GitHub</li>
              <li>Basic Data Scientist: Python</li>
            </ul>
          </div>
  
          <div class="about-section">
            <h2>Hobbies & Interests</h2>
            <p>
              Apart from coding, I enjoy playing basketball, traveling to new places, and exploring the latest trends in technology. These hobbies fuel my creativity and inspire my work.
            </p>
          </div>
  
          <div class="about-section">
            <h2>Contact Me</h2>
            <p>If you would like to collaborate or just say hi, feel free to reach out!</p>
            <a href="https://wa.me/6281259306280" class="btn btn-primary">Contact Me on WhatsApp</a>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <style scoped>
  /* Global Styling */
  body {
    margin: 0;
    font-family: "Arial", sans-serif;
    background-color: #121212;
    color: #ffffff;
  }
  
  .about-page {
    padding: 0;
  }
  
  /* Hero Section */
  .about-hero {
    background: linear-gradient(135deg, #4a90e2, #1c1c1c);
    padding: 100px 20px;
    text-align: center;
  }
  
  .about-title {
    font-size: 3rem;
    margin: 0 0 20px;
    color: #ffffff;
  }
  
  .about-intro {
    font-size: 1.5rem;
    color: #f0f0f0;
  }
  
  /* Details Section */
  .about-details {
    padding: 40px 20px;
    background-color: #1c1c1c;
  }
  
  .about-section {
    margin-bottom: 40px;
  }
  
  .about-section h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #ffffff;
  }
  
  .about-section p {
    font-size: 1.2rem;
    color: #d3d3d3;
  }
  
  .skills-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .skills-list li {
    font-size: 1.1rem;
    margin-bottom: 10px;
    color: #d3d3d3;
  }
  
  /* Buttons */
  .btn-primary {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1rem;
    color: #ffffff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }
  
  .btn-primary:hover {
    background-color: #0056b3;
  }
  </style>
  