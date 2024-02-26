function processParticipantCommentField(participantNumber) {
    const fieldName = `participant-${participantNumber}-comments`;
    const fieldElement = document.querySelector(`textarea[name="${fieldName}"]`);

    if (!fieldElement) return;

    const pElement = findParentPTag(fieldElement);
    hideElementIfPTag(pElement);
    setFieldId(fieldElement, fieldName);
}

function findParentPTag(element) {
    return element.parentNode.parentNode;
}

function hideElementIfPTag(element) {
    if (element.tagName === 'P') {
        element.style.display = 'none';
    }
}

function setFieldId(fieldElement, fieldName) {
    fieldElement.id = fieldName;
}

function processParticipantComments() {
    for (let i = 2; i <= 5; i++) {
        processParticipantCommentField(i);
    }
}

document.addEventListener('DOMContentLoaded', processParticipantComments);