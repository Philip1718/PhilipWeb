document.addEventListener("DOMContentLoaded", function () {
  const layBayDateInput = document.getElementById("layBayDate");
  const expireDatesInput = document.getElementById("expireDates");

  layBayDateInput.addEventListener("change", function () {
      const selectedDate = new Date(this.value);
      if (!isNaN(selectedDate.getTime())) {
          // Check if the entered date is valid
          const expirationDate = new Date(selectedDate);
          expirationDate.setDate(expirationDate.getDate() + 31);

          // Format the expiration date as YYYY-MM-DD (required for date input)
          const formattedExpirationDate = expirationDate.toISOString().substr(0, 10);

          // Set the calculated expiration date in the "Expire Date" input field
          expireDatesInput.value = formattedExpirationDate;
      } else {
          // Clear the "Expire Date" input field if the date is invalid or empty
          expireDatesInput.value = "";
      }
  });
  
  const laybForm = document.getElementById('laybForm');
  laybForm.addEventListener('submit', function (event) {
      event.preventDefault();

      // Get form data
      const formData = new FormData(this);

      // Send a POST request to the server with the form data
      fetch('/submitForm', {
          method: 'POST',
          body: formData,
      })
      .then((response) => {
          if (response.ok) {
              // Form was successfully submitted
              // You can display a confirmation message or redirect the user
              console.log('Form submitted successfully!');
              // Redirect to a confirmation page, if needed
          } else {
              console.error('Form submission failed.');
          }
      })
      .catch((error) => {
          console.error('Error submitting form:', error);
      });

      // Convert form data to an object
      const formDataObject = {};
      formData.forEach((value, key) => {
          formDataObject[key] = value;
      });

      // Store the form data in localStorage
      localStorage.setItem("laybayData", JSON.stringify(formDataObject));

      // Optionally, you can provide a visual indication to the user that the data has been submitted.

      // Clear the form fields (if needed)
      this.reset();
  });
});
