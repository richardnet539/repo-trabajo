document.addEventListener("DOMContentLoaded", function () {
  const addButton = document.createElement("button");
  addButton.id = "add-participant";
  addButton.textContent = "Add Participant";
  addButton.type = "button";

  const submitButton = document.getElementById("form-groups-submit");

  submitButton.parentNode.insertBefore(addButton, submitButton);

  const labelsToShow = [
    "Nombre",
    "Apellidos",
    "E-mail",
    "Municipio",
    "Comunidad Autónoma",
    "Grado que cursa en UNEATLANTICO",
    "Comentarios",
    "Capitán",
  ];
  const fieldsToShow = [
    "first-name",
    "last-name",
    "email",
    "municipality",
    "autonomous-community",
    "grade",
    "comments",
    "captain",
  ];

  function updateParticipantCount() {
    const participantCountField = document.querySelector(
      'input[name="participant-count"]'
    );
    let currentParticipantCount =
      parseInt(participantCountField.value, 10) || 1;

    if (currentParticipantCount < 5) {
      participantCountField.value = ++currentParticipantCount;
      toggleAddParticipantButton(currentParticipantCount);
      return currentParticipantCount;
    }

    return null;
  }

  function toggleAddParticipantButton(currentParticipantCount) {
    if (currentParticipantCount >= 5) {
      document.getElementById("add-participant").style.display = "none";
    }
  }

  function createFieldElement(field, fieldName, label, participantNumber) {
    const fieldElement =
      field === "comments"
        ? document.querySelector(`textarea[name="${fieldName}"]`)
        : document.querySelector(`input[name="${fieldName}"]`);

    const labelParagraph = createLabelParagraph(label);
    handleFieldDisplayAndWrapping(
      field,
      fieldElement,
      labelParagraph,
      fieldName
    );
  }

  function createLabelParagraph(labelText) {
    const labelParagraph = document.createElement("p");
    labelParagraph.innerText = labelText;
    return labelParagraph;
  }

  function handleFieldDisplayAndWrapping(
    field,
    fieldElement,
    labelParagraph,
    fieldName
  ) {
    if (!fieldElement) return;

    const wrapperSpan = document.createElement("span");
    wrapperSpan.classList.add("wpcf7-form-control-wrap");
    wrapperSpan.setAttribute("data-name", fieldName);

    const wrapperParagraph = document.createElement("p");

    setupFieldAttributes(field, fieldElement);
    wrapAndInsertFieldElement(
      field,
      fieldElement,
      wrapperSpan,
      wrapperParagraph,
      labelParagraph
    );
  }

  function setupFieldAttributes(field, fieldElement) {
    fieldElement.classList.remove("wpcf7-hidden");
    fieldElement.id = fieldElement.name;

    if (field === "comments") {
      showParentPElementIfNeeded(fieldElement);
    } else if (field === "captain") {
      fieldElement.type = "checkbox";
      fieldElement.classList.add("wpcf7-checkbox");
    } else {
      fieldElement.type = "text";
      fieldElement.classList.add("wpcf7-text");
    }
  }

  function showParentPElementIfNeeded(fieldElement) {
    if (fieldElement.tagName.toLowerCase() === "textarea") {
      const pElement = fieldElement.parentNode.parentNode;
      if (pElement && pElement.tagName === "P") {
        pElement.style.display = "block";
      }
    }
  }

  function wrapAndInsertFieldElement(
    field,
    fieldElement,
    wrapperSpan,
    wrapperParagraph,
    labelParagraph
  ) {
    fieldElement.parentNode.insertBefore(wrapperSpan, fieldElement);
    wrapperSpan.appendChild(fieldElement);
    wrapperSpan.parentNode.insertBefore(wrapperParagraph, wrapperSpan);
    wrapperParagraph.appendChild(wrapperSpan);
    wrapperParagraph.parentNode.insertBefore(labelParagraph, wrapperParagraph);
  }

  document
    .getElementById("add-participant")
    .addEventListener("click", function () {
      const currentParticipantCount = updateParticipantCount();

      if (currentParticipantCount) {
        fieldsToShow.forEach((field, index) => {
          const fieldName = `participant-${currentParticipantCount}-${field}`;
          const participantTitle = document.getElementById(
            `participant-${currentParticipantCount}`
          );
          participantTitle.style.display = "block";
          createFieldElement(
            field,
            fieldName,
            labelsToShow[index],
            currentParticipantCount
          );
        });
      }
    });

  document.addEventListener(
    "wpcf7mailsent",
    function (event) {
      const participantCountField = document.querySelector(
        'input[name="participant-count"]'
      );
      if (participantCountField) {
        participantCountField.value = "1";
      }
    },
    false
  );
});
