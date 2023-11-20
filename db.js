// Get the "LayBay Date" input field
const layBayDateInput = document.getElementById("layBayDate");

// Add an event listener to the "LayBay Date" input field
layBayDateInput.addEventListener("change", setExpirationDate);

// Define the setExpirationDate function
function setExpirationDate() {
    const layBayDate = new Date(layBayDateInput.value);
    if (!isNaN(layBayDate) && layBayDate instanceof Date) {
        const expirationDate = new Date(layBayDate);
        expirationDate.setDate(layBayDate.getDate() + 31); // Add 31 days to the layBayDate
        const expireDateField = document.getElementById("expireDates");
        const year = expirationDate.getFullYear();
        let month = (expirationDate.getMonth() + 1).toString().padStart(2, '0');
        let day = expirationDate.getDate().toString().padStart(2, '0');
        expireDateField.value = `${year}-${month}-${day}`;
    }
}
