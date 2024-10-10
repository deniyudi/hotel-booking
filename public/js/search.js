  // Function to set default date values
  function setDefaultDates() {
    const checkInInput = document.getElementById('checkIn');
    const checkOutInput = document.getElementById('checkOut');

    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);

    const formatDate = (date) => date.toISOString().split('T')[0];

    checkInInput.value = formatDate(today);
    checkOutInput.value = formatDate(tomorrow);

    updateButtonText(checkInInput);
    updateButtonText(checkOutInput);
  }


  function updateButtonText(dateInput) {
    const selectedDate = new Date(dateInput.value);
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const formattedDate = `${selectedDate.getDate()} ${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;

    // Update button text
    dateInput.previousElementSibling.innerText = formattedDate;
    dateInput.previousElementSibling.classList.remove('text-[#757C98]', 'font-medium');
    dateInput.previousElementSibling.classList.add('font-semibold');
  }

  function updateHiddenFields() {
    const checkInValue = document.getElementById('checkIn').value;
    const checkOutValue = document.getElementById('checkOut').value;

    document.getElementById('hiddenCheckIn').value = checkInValue;
    document.getElementById('hiddenCheckOut').value = checkOutValue;
  }

  function handleDateButtonClick(inputId) {
    const dateInput = document.getElementById(inputId);
    dateInput.showPicker();

    dateInput.addEventListener("change", () => {
      updateButtonText(dateInput);
        validateDates();
        updateHiddenFields();
    });
  }

  function validateDates() {
    const checkInInput = document.getElementById('checkIn');
    const checkOutInput = document.getElementById('checkOut');

    const checkInDate = new Date(checkInInput.value);
    const checkOutDate = new Date(checkOutInput.value);

    if (checkInDate >= checkOutDate) {
      const newCheckOutDate = new Date(checkInDate);
      newCheckOutDate.setDate(checkInDate.getDate() + 1);
      checkOutInput.value = newCheckOutDate.toISOString().split('T')[0];
      updateButtonText(checkOutInput);
    }
  }

  window.onload = () => {
    setDefaultDates();
    updateHiddenFields();
  };
