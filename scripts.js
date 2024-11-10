// Function to fetch and display data
function fetchData() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_data.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("data-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Function to handle form submission with AJAX
function submitForm(event) {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(document.getElementById("addForm"));

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "insert_data.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("message").innerText = xhr.responseText; // Display confirmation message
            document.getElementById("addForm").reset(); // Reset form fields
            fetchData(); // Refresh data after insertion
        }
    };
    xhr.send(formData);
}

// Function to delete an entry
function deleteEntry(id) {
    if (confirm("Are you sure you want to delete this entry?")) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_data.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("message").innerText = xhr.responseText;
                fetchData(); // Refresh data after deletion
            }
        };
        xhr.send("id=" + id);
    }
}
