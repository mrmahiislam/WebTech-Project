const fs = require('fs');
const path = require('path');

// File path (change to your preferred location)
const filePath = 'C:\\xampp\\htdocs\\WebTech_Project\\RegistrationFormDatas.txt';

function saveToFile(data) {
  const formattedData = `
  New Registration:
  Email: ${data.email}
  Age: ${data.age}
  Zip Code: ${data.zipcode}
  City: ${data.city}
  Timestamp: ${new Date().toLocaleString()}
  ------------------------
  `;

  // Append to file (creates file if it doesn't exist)
  fs.appendFileSync(filePath, formattedData);
  console.log('Data saved to:', filePath);
}

// Example usage (replace with your form data)
const formData = {
  email: "test@example.com",
  age: "25",
  zipcode: "1234",
  city: "Dhaka"
};

saveToFile(formData);