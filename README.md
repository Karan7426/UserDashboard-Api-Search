# UserDashboard-Api-Search

UserDashboard-Api-Search is a web application built using CodeIgniter 4. It provides user registration, login, profile management, and integration with the Pixabay API for image and video searches. The application also includes AJAX functionality to display search results dynamically.

## Features

- **User Registration & Login**: Secure registration and login using session management.
- **Profile Management**: Users can update their profiles, including changing their name, email, password, and profile picture.
- **Search Functionality**: Integrated with the Pixabay API to search for images and videos.
- **AJAX Integration**: Display search results without reloading the page.
- **Flash Messages**: Success and error messages are displayed with auto-hide functionality.

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/UserDashboard-Api-Search.git
    ```
    
2. **Navigate to the project directory:**
    ```bash
    cd UserDashboard-Api-Search
    ```

3. **Install dependencies:**
    ```bash
    composer install
    ```

4. **Copy the `.env` file:**
    ```bash
    cp env .env
    ```

5. **Configure the database:**
   - Open the `.env` file.
   - Set your database credentials:
     ```
     database.default.hostname = localhost
     database.default.database = your_database_name
     database.default.username = your_username
     database.default.password = your_password
     database.default.DBDriver = MySQLi
     ```

6. **Run migrations:**
    ```bash
    php spark migrate
    ```

7. **Start the development server:**
    ```bash
    php spark serve
    ```

8. **Access the application:**
   Open your browser and go to [http://localhost:8080](http://localhost:8080).

## Usage

- **Registration**: Create an account using the registration page.
- **Login**: Login using your email and password.
- **Profile Management**: Update your profile, change your password, and upload a profile picture.
- **Search Images/Videos**: Use the search functionality to find images or videos from the Pixabay API.

## Folder Structure

- **app/Controllers**: Contains the application's controller files.
- **app/Models**: Contains the application's model files.
- **app/Views**: Contains the application's view files.
- **public/uploads**: Stores uploaded profile pictures.
- **writable/uploads**: Stores temporary files.

## License

This project is licensed under the MIT License.

## Contact

For any questions or suggestions, feel free to open an issue or contact me.

