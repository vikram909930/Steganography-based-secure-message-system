Image Encryption and Steganography System

A secure web-based application that encrypts data and hides it within an image using AES encryption and steganography techniques. This ensures data confidentiality and protection from unauthorized access.

Features

AES Encryption: Encrypts user input data before embedding it into an image.

Image-Based Steganography: Hides encrypted data inside an image.

Secure File Storage: Allows users to save and download the encrypted image.

Password Protection: Uses a user-provided password for encryption and decryption.

User-Friendly UI: Modern, responsive interface with an animated gradient background.

Data Retrieval: Option to extract and decrypt the hidden data from an image.


Technologies Used

Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL

Encryption Algorithm: AES (Advanced Encryption Standard)

Hashing Algorithm: SHA-256 (for secure authentication)

Libraries:

CryptoJS (for client-side encryption)



Installation & Setup

1. Clone the Repository

git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name

2. Set Up the Server

Install XAMPP or any local PHP server.

Move the project to the htdocs folder if using XAMPP.

Start Apache and MySQL.


3. Configure the Database

Create a MySQL database (e.g., image_security).

Import the provided database.sql file into MySQL.

Update config.php with your database credentials.


4. Run the Project

Open a web browser and go to:

http://localhost/your-project-folder/


Usage

Encrypt and Embed Data

1. Enter the data you want to hide.


2. Provide an encryption password.


3. Upload an image.


4. Click "Encrypt and Embed" to process the encryption.


5. Download the encrypted image.



Decrypt and Extract Data

1. Upload an encrypted image.


2. Enter the correct decryption password.


3. Click "Decrypt" to reveal the hidden data.



Project Structure

/your-project-folder
│── index.html            # Main UI for encryption
│── encryptHis.php        # Handles encryption and image processing
│── decrypt.php           # Handles decryption
│── config.php            # Database connection
│── assets/
│   ├── styles.css        # Styling
│   ├── scripts.js        # JavaScript logic
│── uploads/              # Stores encrypted images
│── README.md             # Project documentation

Contributing

Feel free to contribute!

1. Fork the repository


2. Create a feature branch (git checkout -b feature-name)


3. Commit your changes (git commit -m "Added a new feature")


4. Push to the branch (git push origin feature-name)


5. Open a Pull Request



License

This project is open-source and available under the MIT License.
