const fields = [
    "first-name",
    "last-name",
    "email",
    "municipality",
    "autonomous-community",
    "grade",
    "comments",
    "captain",
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
    console.log(fieldElement);
    fieldElement.id = fieldName;
}

function applyFieldLogic(field) {
    const fieldName = `participant-1-${field}`;
    const handler = fieldHandlers[field] || fieldHandlers.default;
    handler(fieldName);
}

document.addEventListener('DOMContentLoaded', function () {
    fields.forEach(applyFieldLogic);
});