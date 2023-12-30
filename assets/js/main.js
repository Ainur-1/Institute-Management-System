function toggleModal(modalId, action) {
    const modal = document.getElementById(modalId);

    if (modal) {
        if (action === 'show') {
            modal.style.display = 'block';
        } else if (action === 'hide') {
            modal.style.display = 'none';
        }
    } else {
        console.error(`Modal with id ${modalId} not found!`);
    }
}