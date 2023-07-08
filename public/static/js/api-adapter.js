const API_URL = 'http://localhost:8000/api'

function registerTask(task) {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 201) {
          alert('Task created successfully!');
          resolve();
        } else {
          reject(new Error("There was a problem with the request."));
        }
      }
    };

    const register = {
      task
    }

    xhttp.open('POST', `${API_URL}/task`, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(register));
  })
}

function listAllTasks() {
  return new Promise(function (resolve, reject) {
    const tasks = [];

    function updateTasks(data) {
      data.forEach(task => tasks.push(task));
      resolve(tasks);
    }

    function fetchData(callback) {
      const xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = () => {
        if (xhttp.readyState === XMLHttpRequest.DONE) {
          if (xhttp.status === 200) {
            const response = xhttp.responseText;
            const data = JSON.parse(response);
            callback(data);
          } else {
            reject(new Error("There was a problem with the request."));
          }
        }
      };

      xhttp.open('GET', `${API_URL}/task`, true);

      xhttp.send();
    }

    fetchData(updateTasks);
  });
}

function getTaskById(id) {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 200) {
          const response = xhttp.responseText;
          const data = JSON.parse(response);
          resolve(data);
        } else {
          reject(new Error("There was a problem with the request."));
        }
      }
    };

    xhttp.open('GET', `${API_URL}/task/${id}`, true);
    xhttp.send();
  })
}

function updateTaskName(id, newTask) {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 204) {
          resolve();
        } else {
          reject(new Error("There was a problem with the request."));
        }
      }
    };

    const register = {
      task: newTask
    }

    xhttp.open('PUT', `${API_URL}/task/${id}`, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(register));
  })
}

function updateTaskStatus(id, status) {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 204) {
          const updatedStatus = status === 'pending' ? 'finished' : 'pending';
          resolve(updatedStatus);
        } else {
          reject(new Error("There was a problem with the request."));
        }
      }
    };

    if (status === 'pending') {
      xhttp.open('PATCH', `${API_URL}/task/done/${id}`, true);
      xhttp.send();
      return;
    }

    if (status === 'finished') {
      xhttp.open('PATCH', `${API_URL}/task/undone/${id}`, true);
      xhttp.send();
      return;
    }

    reject(new Error('Invalid status'))
  })
}

function deleteTask(id) {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 204) {
          resolve();
        } else {
          reject(new Error("There was a problem with the request."));
        }
      }
    };

    xhttp.open('DELETE', `${API_URL}/task/${id}`, true);
    xhttp.send();
  })
}
