let tasks = [];
let editingTaskIndex = null;

document.getElementById("add-btn").addEventListener("click", function() {
    const taskInput = document.getElementById("task-input");
    const dateInput = document.getElementById("date-input");
    
    if (taskInput.value && dateInput.value) {
        tasks.push({ text: taskInput.value, date: dateInput.value });
        taskInput.value = '';
        dateInput.value = '';
        renderTasks();
    }
});

function renderTasks() {
    const taskList = document.getElementById("task-list");
    taskList.innerHTML = '';

    tasks.forEach((task, index) => {
        const li = document.createElement("li");

        const taskText = document.createElement("span");
        taskText.className = "task-text";
        taskText.textContent = task.text;

        const taskDate = document.createElement("span");
        taskDate.className = "task-date";
        taskDate.textContent = task.date;

        const editBtn = document.createElement("button");
        editBtn.className = "edit-btn";
        editBtn.innerHTML = '<i class="fas fa-pencil-alt"></i>';
        editBtn.onclick = function() {
            openEditModal(index);
        };

        const deleteBtn = document.createElement("button");
        deleteBtn.className = "delete-btn";
        deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';
        deleteBtn.onclick = function() {
            tasks.splice(index, 1);
            renderTasks();
        };

        li.appendChild(taskText);
        li.appendChild(taskDate);
        li.appendChild(editBtn);
        li.appendChild(deleteBtn);
        taskList.appendChild(li);
    });
}

function openEditModal(index) {
    editingTaskIndex = index;
    const task = tasks[index];
    document.getElementById("edit-input").value = task.text;
    document.getElementById("edit-date-input").value = task.date;
    document.getElementById("edit-modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("edit-modal").style.display = "none";
}

function saveTask() {
    const updatedText = document.getElementById("edit-input").value;
    const updatedDate = document.getElementById("edit-date-input").value;
    
    if (updatedText && updatedDate && editingTaskIndex !== null) {
        tasks[editingTaskIndex] = { text: updatedText, date: updatedDate };
        renderTasks();
        closeModal();
    }
}
