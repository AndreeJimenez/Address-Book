const contactsForm = document.querySelector("#contact"),
  contactsList = document.querySelector("#list-contacts tbody"),
  searchInput = document.querySelector("#search");

eventListeners();

function eventListeners() {
  contactsForm.addEventListener("submit", readForm);

  if (contactsList) {
    contactsList.addEventListener("click", deleteContact);
  }

  searchInput.addEventListener("input", searchContacts);

  contacsNumber();
}

function readForm(e) {
  e.preventDefault();

  const name = document.querySelector("#name").value,
    business = document.querySelector("#business").value,
    phone = document.querySelector("#phone").value,
    action = document.querySelector("#action").value;

  if (name === "" || business === "" || phone === "") {
    // 2 params: text and class
    showNotification("All fields are required", "error");
  } else {
    // Create call to Ajax
    const infoContact = new FormData();
    infoContact.append("name", name);
    infoContact.append("business", business);
    infoContact.append("phone", phone);
    infoContact.append("action", action);

    // console.log(...infoContact);

    if (action === "create") {
      insertDB(infoContact);
    } else {
      // update contact, Read Id
      const idRecord = document.querySelector("#id").value;
      infoContact.append("id", idRecord);
      updateRecord(infoContact);
    }
  }
}

function insertDB(data) {
  // Called ajax

  // Create the object
  var xhr = new XMLHttpRequest();

  // Open the Connection
  xhr.open("POST", "includes/models/model-contacts.php", true);

  // Pass the data
  xhr.onload = function() {
    if (this.status === 200) {
      // console.log(JSON.parse(xhr.responseText));
      // Read PHP response
      const response = JSON.parse(xhr.responseText);

      const newContact = document.createElement("tr");
      newContact.innerHTML = `
        <td>${response.data.name}</td>
        <td>${response.data.business}</td>
        <td>${response.data.phone}</td>
        `;

      const containerActions = document.createElement("td");

      // Update icon
      const updateIcon = document.createElement("i");
      updateIcon.classList.add("fas", "fa-pen-square");

      const updateButton = document.createElement("a");
      updateButton.appendChild(updateIcon);
      updateButton.href = `update.php?id=${response.data.id_insert}`;
      updateButton.classList.add("btn", "btn-update");

      containerActions.appendChild(updateButton);

      // Delete icon
      const deleteIcon = document.createElement("i");
      deleteIcon.classList.add("fas", "fa-trash-alt");

      const deleteButton = document.createElement("button");
      deleteButton.appendChild(deleteIcon);
      deleteButton.setAttribute("data-id", response.data.id_insert);
      deleteButton.classList.add("btn", "btn-delete");

      containerActions.appendChild(deleteButton);

      newContact.appendChild(containerActions);

      contactsList.appendChild(newContact);

      document.querySelector("form").reset();

      showNotification("Contact Successfully Created", "correct");

      contacsNumber();
    }
  };
  xhr.send(data);
}

function updateRecord(data) {
  const xhr = new XMLHttpRequest();

  xhr.open("POST", "includes/models/model-contacts.php", true);

  xhr.onload = function() {
    if (this.status === 200) {
      const response = JSON.parse(xhr.responseText);

      if (response.response === "correct") {
        showNotification("Contact Successfully Updated", "correct");
      } else {
        showNotification("Something went wrong...", "error");
      }
      setTimeout(() => {
        window.location.href = "index.php";
      }, 2000);
    }
  };
  xhr.send(data);
}

function deleteContact(e) {
  if (e.target.parentElement.classList.contains("btn-delete")) {
    const id = e.target.parentElement.getAttribute("data-id");

    const response = confirm("The record will be removed.");

    if (response) {
      const xhr = new XMLHttpRequest();

      xhr.open(
        "GET",
        `includes/models/model-contacts.php?id=${id}&action=delete`,
        true
      );

      xhr.onload = function() {
        if (this.status === 200) {
          const resultado = JSON.parse(xhr.responseText);

          if (resultado.response == "correct") {
            // Delete the DOM record
            console.log(e.target.parentElement.parentElement.parentElement);
            e.target.parentElement.parentElement.parentElement.remove();

            showNotification("Contact Removed", "correct");

            contacsNumber();
          } else {
            showNotification("Something went wrong...", "error");
          }
        }
      };
      xhr.send();
    }
  }
}

function showNotification(message, clase) {
  const notification = document.createElement("div");
  notification.classList.add(clase, "notification", "shadow");
  notification.textContent = message;

  contactsForm.insertBefore(
    notification,
    document.querySelector("form legend")
  );

  setTimeout(() => {
    notification.classList.add("visible");
    setTimeout(() => {
      notification.classList.remove("visible");
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, 3000);
  }, 100);
}

function searchContacts(e) {
  const expression = new RegExp(e.target.value, "i");
  redords = document.querySelectorAll("tbody tr");

  redords.forEach(redord => {
    redord.style.display = "none";

    if (
      redord.childNodes[1].textContent.replace(/\s/g, " ").search(expression) !=
      -1
    ) {
      redord.style.display = "table-row";
    }
    contacsNumber();
  });
}

function contacsNumber() {
  const totalContacts = document.querySelectorAll("tbody tr"),
    numberContainer = document.querySelector(".total-contacts span");

  let total = 0;

  totalContacts.forEach(contact => {
    if (contact.style.display === "" || contact.style.display === "table-row") {
      total++;
    }
  });

  numberContainer.textContent = total;
}
