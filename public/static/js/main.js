onload = () => {
  managerTaskState();
  $('#taskForm').submit(handleRegisterTask);
}

function handleRegisterTask(event) {
  event.preventDefault();
  const task = $('#textAreaTask').val();

  try {
    registerTask(task);
    managerTaskState();
  } catch (error) {
    alert('Error: ', error.message);
  }

  $('#textAreaTask').val('');
}

function handleDeleteTask(id) {
  try {
    deleteTask(id);
    alert('Task deleted successfully!');
  } catch (error) {
    alert('Error: ', error.message);
  }

  managerTaskState();
}

async function handleEditTask(id) {
  const dialog = document.getElementById('editModal');

  try {
    const response = await getTaskById(id);

    const { task } = { ...response };

    $('#newTask').attr('value', task);

    $('#cancelEditModal').on('click', () => dialog.close());

    $('#newTaskForm').on('submit', (event) => {
      event.preventDefault();
      const newTask = $('#newTask').val();

      updateTaskName(id, newTask);

      alert('Task updated successfully!');

      managerTaskState();

      dialog.close();
    });
  } catch (error) {
    alert('Houve um erro', error.message);
  }

  dialog.show();

}

function handleUpdateTaskStatus(id) {
  database.updateTaskStatus(id);
  managerTaskState();
}

async function showTaskFromDatabase({
  deleteTaskFn,
  editTaskFn,
  editStatusFn
}) {
  const tasks = await listAllTasks();

  $('#tasksContainer').html('');

  tasks.forEach(({ task, updated_at, status, id }) => {
    const state = status === 'finished' ? 'concluído' : 'não concluído'

    const formattedData = typeof window !== undefined
      ? Intl.DateTimeFormat('pt-BR', {
        dateStyle: "long",
        timeStyle: "medium"
      }).format(new Date(updated_at))
      : new Date(updated_at).toLocaleDateString('pt-BR');

    const box = $('<div>');
    const date = $('<p>').text(`Atualizado em: ${formattedData}`);
    const showTask = $('<span>').text(task);

    const checkBox = $('<button>').text(state);
    $(checkBox).on('click', () => editStatusFn(id));

    const deleteTask = $('<button>').text('Deletar');
    deleteTask.attr('class', 'deleteButton');

    $(deleteTask).on('click', () => deleteTaskFn(id));

    const editTask = $('<button>').text('Editar');
    editTask.attr('class', 'editButton');

    $(editTask).on('click', () => editTaskFn(id));

    box.append(checkBox);
    box.append(showTask);
    box.append(date);
    box.append(deleteTask);
    box.append(editTask);

    $('#tasksContainer').append(box);
  })
}

function managerTaskState() {
  showTaskFromDatabase({
    deleteTaskFn: handleDeleteTask,
    editTaskFn: handleEditTask,
    editStatusFn: handleUpdateTaskStatus
  });
}
