const sendBtn = document.getElementById("send-btn");
const toInput = document.getElementById("to");
const messageInput = document.getElementById("message");
const idHeader = document.getElementById("sort-id");
const phoneHeader = document.getElementById("sort-to");
const messageHeader = document.getElementById("sort-mesage");

sendBtn?.addEventListener("click", handleSendMessage);

idHeader?.addEventListener("click", handleSort);
phoneHeader?.addEventListener("click", handleSort);
messageHeader?.addEventListener("click", handleSort);

let sortSwitch = true;
let dir = "asc";

async function handleSendMessage(e) {
  e.preventDefault();
  const form = e.target.closest("form");
  const prevBtnState = e.target.innerHTML;
  e.target.innerHTML = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Loading...</span>`;
  if (validateMessage(form)) {
    const data = new FormData(form);
    const newMessage = await saveMessage(data);

    if (newMessage.id) {
      form.reset();
      handleUpdateLatestMessages();
    }
  }
  e.target.innerHTML = prevBtnState;
}

function validateMessage(form) {
  return form.reportValidity();
}

const saveMessage = async (message) => {
  const url = "routes.php/send";

  const fetch_conf = {
    method: "POST",
    body: message,
  };

  try {
    const response = await fetch(url, fetch_conf);
    const result = await response.json();
    return result;
  } catch (error) {
    return { error: error.message };
  }
};

const getMessages = async (sort = "", dir = "asc") => {
  const url =
    "routes.php/latest?" + new URLSearchParams({ sort: sort, dir: dir });

  try {
    const response = await fetch(url);
    const result = await response.json();
    return result;
  } catch (error) {
    return { error: error.message };
  }
};

async function handleUpdateLatestMessages(sort = "id", dir = "asc") {
  const newMessages = await getMessages(sort, dir);
  createNewTable(newMessages);
}

function createNewTable(newMessages) {
  const tbody = document.getElementsByTagName("tbody")[0];
  tbody.innerHTML = "";
  newMessages.forEach((message) => {
    const tr = document.createElement("tr");

    for (const [key, value] of Object.entries(message)) {
      if (value !== null) {
        if (["id", "message_to", "body", "confirmation_code"].includes(key)) {
          const td = document.createElement("td");
          td.innerText = value;
          tr.appendChild(td);
        }
      }
    }
    tbody.appendChild(tr);
  });
}

function handleSort(e) {
  const header = e.target.id;

  switch (header) {
    case "sort-id":
      handleUpdateLatestMessages("id", dir);
      break;

    case "sort-to":
      handleUpdateLatestMessages("message_to", dir);
      break;
    case "sort-mesage":
      handleUpdateLatestMessages("body", dir);
      break;

    default:
      break;
  }

  if (sortSwitch && dir == "asc") {
    dir = "desc";
    sortSwitch = false;
  } else {
    dir = "asc";
    sortSwitch = true;
  }
}

handleUpdateLatestMessages("id");
