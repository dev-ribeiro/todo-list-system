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
