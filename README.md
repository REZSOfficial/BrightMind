### Bright Mind

#### Description
This project is a web application for creating and learning courses built using Laravel, Vue.js, and Inertia.js. It serves as a modern stack example demonstrating how to integrate these technologies to create a seamless single-page application experience with server-side rendering.

#### Features
- **Laravel**: Utilizes Laravel as the backend framework for routing, controllers, models, and API endpoints.
- **Vue.js**: Implements Vue.js for building interactive user interfaces and components.
- **Inertia.js**: Integrates Inertia.js to combine Vue components with Laravel backend routes effortlessly.
- **Authentication**: Includes basic authentication system using Laravel's built-in authentication features.
- **CRUD Operations**: Demonstrates basic CRUD operations (Create, Read, Update, Delete) using Laravel models and Vue.js components.

#### Versions
- PHP: 8.2.12
- Composer
- Node.js: 21.6.2
- NPM or Yarn

#### Installation Instructions
1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd <project-folder>
   
2. **Install PHP dependencies:**
   ```bash
   composer install
   
3. **Install JavaScript dependencies:**
   ```bash
   npm install
   # or
   yarn

4. **Set up environment variables:**
   - Duplicate .env.example file and rename it to .env.
   - Configure your database and other environment-specific settings in .env.
  
5. **Generate application key:**
   ```bash
   php artisan key:generate

6. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed

7. **Compile assets:**
   ```bash
   npm run dev
   # or for production
   npm run prod

8. **Start the development server:**
   ```bash
   php artisan serve

9. **Access the application
    - Open your browser and visit http://localhost:8000
    
