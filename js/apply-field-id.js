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

function applyFieldLogic(field, participantNumber) {
  const fieldName = `participant-${participantNumber}-${field}`;
  const handler = fieldHandlers[field] || fieldHandlers.default;
  handler(fieldName);
}

document.addEventListener("DOMContentLoaded", function () {
  for (let participantNumber = 1; participantNumber <= 3; participantNumber++) {
    fields.forEach((field) => {
      applyFieldLogic(field, participantNumber);
    });
  }
});
