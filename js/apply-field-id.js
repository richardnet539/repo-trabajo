const fields = [
  "first-name",
  "last-name",
  "email",
  "school",
  "municipality",
  "autonomous-community",
  "stage",
  "course",
  "tutor",
  "captain",
  "comments",
];

const fieldHandlers = {
  comments: handleCommentsField,
  captain: handleCaptainField,
  default: handleDefaultField,
};

function handleCommentsField(fieldName) {
  const textArea = document.getElementsByName(fieldName)[0];
  textArea.id = fieldName;
}

function handleCaptainField(fieldName) {
  const captainCheckbox = document.getElementsByName(`${fieldName}[]`)[0];
  captainCheckbox.id = fieldName;
}

function handleDefaultField(fieldName) {
  const fieldElement = document.querySelector(`input[name="${fieldName}"]`);
  if (!fieldElement) return;
  fieldElement.id = fieldName;
}

function applyFieldLogic(field) {
  const fieldName = `participant-1-${field}`;
  const handler = fieldHandlers[field] || fieldHandlers.default;
  handler(fieldName);
}

document.addEventListener("DOMContentLoaded", function () {
  fields.forEach(applyFieldLogic);
});
