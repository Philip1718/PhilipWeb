// const tableBody = document.querySelector("table tbody");

// window.addEventListener("DOMContentLoaded", function () {
//     // Fetch data from the server
//     fetch('retrieveData.php')
//         .then(response => response.json())
//         .then(data => {
//             // Iterate through the retrieved data and add rows to the table
//             data.forEach(item => {
//                 const newRow = document.createElement("tr");
//                 const columns = ["id", "firstName", "lastName", "tel", "price", "deposit", "bayArea", "layBayDate", "expireDates"];

//                 columns.forEach(column => {
//                     const cell = document.createElement("td");
//                     cell.textContent = item[column];
//                     newRow.appendChild(cell);
//                 });

//                 tableBody.appendChild(newRow);
//             });
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//         });
// });
// Define the URL for fetching data from the server (retrieveData.php)
const fetchDataUrl = 'retrieveData.php';

// Function to fetch and display data in the table
function fetchDataAndDisplay() {
    const tableBody = document.querySelector("table tbody");

    // Fetch data from the server
    fetch(fetchDataUrl)
        .then(response => response.json())
        .then(data => {
            // Clear the existing rows in the table
            tableBody.innerHTML = '';

            // Iterate through the retrieved data and add rows to the table
            data.forEach(item => {
                const newRow = document.createElement("tr");
                const columns = [ "firstName", "lastName","id", "tel", "price", "deposit", "bayArea", "layBayDate", "expireDates" ,"rowId"];

                columns.forEach(column => {
                    const cell = document.createElement("td");
                    cell.textContent = item[column];
                    newRow.appendChild(cell);
                });

                tableBody.appendChild(newRow);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Call the function to fetch and display data when the page loads
window.addEventListener("DOMContentLoaded", fetchDataAndDisplay);
