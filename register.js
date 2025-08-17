document.addEventListener("DOMContentLoaded", function () {
  
    const formElements = document.querySelectorAll("input, select, textarea");
    formElements.forEach((element) => {
      element.addEventListener("change", validateInput);
      element.addEventListener("blur", validateInput);
    });
  
    function validateInput(event) {
      const input = event.target;
      const isValid = checkValidity(input);
  
      if (isValid) {
        input.style.borderColor = "green";
        clearError(input);
      } else {
        input.style.borderColor = "red";
        showError(input, getErrorMessage(input));
      }
    }
  
    function clearError(input) {
      const errorElement = input.nextElementSibling;
      if (errorElement && errorElement.classList.contains("error-message")) {
        errorElement.remove();
      }
    }
  
    function showError(input, message) {
      clearError(input);
      if (message) {
        const errorElement = document.createElement("div");
        errorElement.className = "error-message";
        errorElement.style.color = "red";
        errorElement.style.fontSize = "0.8rem";
        errorElement.style.marginTop = "5px";
        errorElement.textContent = message;
        input.parentNode.insertBefore(errorElement, input.nextSibling);
      }
    }
  
    function getErrorMessage(input) {
      const name = input.name;
      const value = input.value;
      const isRequired = input.hasAttribute("required");
  
      if (isRequired && value.trim() === "") {
        return "This field is required";
      }
  
      switch (name) {
        case "first_name":
          if (!/^[A-Za-z\s.]+$/.test(value))
            return "Only letters, spaces and periods allowed";
          break;
        case "last_name":
          if (!/^[A-Za-z\s]*$/.test(value))
            return "Only letters and spaces allowed";
          break;
        case "dob":
          if (new Date(value) > new Date()) return "Date cannot be in the future";
          if (new Date().getFullYear() - new Date(value).getFullYear() < 18)
            return "Must be at least 18 years old";
          break;
        case "age":
          if (!/^\d+$/.test(value)) return "Numbers only";
          if (value < 18) return "Must be at least 18";
          if (value > 100) return "Please enter valid age";
          break;
        case "profile_created_by":
          if (!document.querySelector('input[name="profile_created_by"]:checked'))
            return "Please select profile_created_by";
          break;
        case "looking_for":
          if (!document.querySelector('input[name="looking_for"]:checked'))
            return "Please select looking_for";
          break;
        case "religion":
          if (isRequired && !value) return "Please select religion";
          break;
        case "marital_status":
          if (isRequired && !value) return "Please select religion";
          break;
        case "caste":
          if (!/^[A-Za-z\s]+$/.test(value))
            return "Only letters and spaces allowed";
          break;
        case "education":
          if (!/^[A-Za-z\s]+$/.test(value))
            return "Only letters and spaces allowed";
          break;
        case "profession":
          if (!/^[A-Za-z\s]+$/.test(value))
            return "Only letters and spaces allowed";
          break;
        case "email":
          if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value))
            return "Valid email required";
          break;
        case "candidate_phone":
          if (!/^[+]?[0-9]{10,15}$/.test(value))
            return "10-15 digit phone number";
          break;
        case "guardian_phone":
          if (!/^[+]?[0-9]{10,15}$/.test(value))
            return "10-15 digit phone number";
          break;
      }
  
      return null;
    }
  
    function checkValidity(input) {
      const id = input.name;
      const value = input.value;
      const isRequired = input.hasAttribute("required");
  
      if (isRequired && value.trim() === "") {
        return false;
      }
  
      switch (name) {
        case "first_name":
          return /^[A-Za-z\s.]+$/.test(value);
        case "last_name":
          return value === "" || /^[A-Za-z\s]+$/.test(value);
        case "dob":
          return (
            value &&
            new Date(value) <= new Date() &&
            new Date().getFullYear() - new Date(value).getFullYear() >= 18
          );
        case "religion":
          return !isRequired || value;
        case "caste":
          return value === "" || /^[A-Za-z\s]+$/.test(value);
        case "email":
          return value === "" || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        case "phone":
          return /^[+]?[0-9]{10,15}$/.test(value);
        case "address":
          return !isRequired || value.trim().length >= 10;
        case "education":
          return !isRequired || value;
        default:
          return true;
      }
    }
  
    // Form submission handler
    const form = document.querySelector("form");
    if (form) {
      form.addEventListener("submit", function (e) {
        let isValid = true;
        let firstInvalidElement = null;
  
        formElements.forEach((element) => {
          if (!checkValidity(element)) {
            validateInput({ target: element });
            isValid = false;
            if (!firstInvalidElement) {
              firstInvalidElement = element;
            }
          }
        });
      });
    }
  });