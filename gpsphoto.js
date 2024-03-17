function uploadPhoto() {
    const photoInput = document.getElementById('photo-input');
    const photoTimeInput = document.getElementById('photo-time');
    const statusMessage = document.getElementById('status-message');

    // Validate input
    if (!photoInput.files[0]) {
        showAlert('Please select a photo.', 'error');
        return;
    }

    if (!photoTimeInput.value) {
        showAlert('Please enter the accurate time the photo was taken.', 'error');
        return;
    }

    // Display loading spinner
    showLoadingSpinner();

    // Retrieve selected file and photo time
    const photoFile = photoInput.files[0];
    const photoTime = photoTimeInput.value;

    // Create FormData object to send file and additional data
    const formData = new FormData();
    formData.append('photo', photoFile);
    formData.append('photoTime', photoTime);

    // Send data to the server using Fetch API
    fetch('/upload', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        // Hide loading spinner
        hideLoadingSpinner();

        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }

        // Clear form inputs
        photoInput.value = '';
        photoTimeInput.value = '';

        // Display success message
        showAlert('Photo uploaded successfully!', 'success');
    })
    .catch(error => {
        // Hide loading spinner
        hideLoadingSpinner();

        // Display error message
        showAlert(`Error: ${error.message}`, 'error');
    });
}

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
