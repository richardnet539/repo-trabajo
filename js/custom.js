document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.createElement("button");
    addButton.id = "add-participant";
    addButton.textContent = "Añadir Participante";
    addButton.type = "button";

    const wrapperDiv = document.createElement("div");
    wrapperDiv.id = "participant-wrapper";

    wrapperDiv.appendChild(addButton);

    const addParagraphText = document.getElementById("participant-add");

    addParagraphText.parentNode.insertBefore(wrapperDiv, addParagraphText);

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
        "autonomus-community",
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

        wrapperParagraph.id = fieldName
        labelParagraph.id = fieldName + "-" + "label"

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
        console.log(labelParagraph.id)
        if (labelParagraph.id.includes("captain")) {
            const wrapperParagraphParent = wrapperParagraph.parentNode;
            wrapperParagraphParent.parentNode.insertBefore(labelParagraph, wrapperParagraphParent);
        } else {
            wrapperParagraph.parentNode.insertBefore(labelParagraph, wrapperParagraph);
        }
    }

    document
        .getElementById("add-participant")
        .addEventListener("click", function () {
            const currentParticipantCount = updateParticipantCount();


            if (currentParticipantCount) {
                const container = document.getElementById(`participant-${currentParticipantCount}-container`);

                if (container) {
                    container.style.display = "block";
                }

                if (currentParticipantCount) {
                    const participantContainer = document.getElementById(`container-${currentParticipantCount}`);
                    
                    if (participantContainer) {
                        participantContainer.style.display = "block";
                    }
                }

                if (currentParticipantCount >= 5) {
                    document.getElementById(`participant-add`).style.display = "none";
                }

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
    );f
});



jQuery(document).ready(function ($) {
    $('#form-groups-submit').each(function (i, field) {
        $(field).addClass('buttom-submit-group');
    });
});

jQuery(document).ready(function ($) {
    var $inputFields = $('input.wpcf7-form-control');

    $inputFields.each(function (i, field) {
        $(field).addClass('form-liga');
        $(field).addClass('input-width');

        var nameAttribute = $(field).attr('name');
        if (nameAttribute && nameAttribute.indexOf('captain') !== -1) {
            $(field).addClass('checkbox-input'); 
        
            var labelContainer = $('<label></label>');

            var divContainer = $('<div class="captain-container"></div>');

            var participantIndex = Math.floor((i - 2) / 8) + 1;

            $(field).wrap(labelContainer);

            $(field).after(`<p id="captain-sibling-${participantIndex}">Asignar</p>`);
            $(field).add(`#captain-sibling-${participantIndex}`).wrapAll(divContainer);
        }
    });
});


jQuery(document).ready(function ($) {
    $('#participant-wrapper').each(function (i, field) {
        $(field).addClass('buttom-container');
    });
});

jQuery(document).ready(function ($) {
    $('textarea.wpcf7-form-control').each(function (i, field) {
        $(field).addClass('form-liga');
        $(field).addClass('input-width');
    });
});

jQuery(document).ready(function ($) {
    $('#add-participant').each(function (i, field) {
        $(field).addClass('buttom-liga');
    });
});

jQuery(document).ready(function ($) {
    $('textarea.wpcf7-form-control').each(function (i, field) {
        $(field).addClass('size-input-textarea');
    });
});

jQuery(document).ready(function ($) {
    $('.wpcf7-list-item-label').addClass('input-capitan-checkbox');
});



