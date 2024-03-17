function showAlert(message, type) {
    const statusMessage = document.getElementById('status-message');
    statusMessage.innerHTML = message;
    statusMessage.className = type;
}

function showLoadingSpinner() {
    const statusMessage = document.getElementById('status-message');
    statusMessage.innerHTML = '<div class="spinner"></div>';
}

function hideLoadingSpinner() {
    const statusMessage = document.getElementById('status-message');
    statusMessage.innerHTML = '';
}
