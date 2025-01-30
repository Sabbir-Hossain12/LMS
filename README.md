
<!-- PROJECT LOGO -->
<br />
<div align="center">

[//]: # (  <a href="">)

[//]: # (    <img src="public/images/Logo/Capture_dark2.png" alt="Logo" width="180" height="60">)

[//]: # (  </a>)

<h2 align="center"> Learning Management System</h2>

  <p align="center">The Learning Management System (LMS) is a web-based platform designed to streamline the creation, delivery, and management of educational courses and training programs. This project aims to provide educators, trainers, and organizations with a robust and user-friendly tool to facilitate online learning, track student progress, and enhance the overall learning experience.

Whether you're an instructor looking to create interactive courses or a student seeking a centralized platform for learning, this LMS offers a comprehensive solution to meet your needs.</p>



<a href="http://techhatch-pos.great-site.net">View Demo</a>
</div>


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
    </li>
    <li><a href="#product-requirement-and-roadmap">Product Requirement and Roadmap
</a></li>
    <li><a href="#database-design">Database Design</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## Key Features

[//]: # (<img src="public/images/techhatch-pos.great-site.net_dashboard.png"/>)

## User/Student Authentication:

#### OTP Login & Registration
* Users can register or log in using only their phone number.
* A 6-digit OTP (One-Time Password) is sent via SMS.
* New users are automatically registered upon first successful OTP verification.

#### Password Reset
* Users can reset their account access using OTP verification.
* Triggers same security flow as login with additional confirmation step.

#### Real-Time OTP Timer
* Visual countdown timer (typically 5 minutes) shown during OTP entry..
* Auto-refresh option after timer expiration.
* Prevents OTP spam with rate limiting.

## Course Management

#### Classes
* Create, update, Delete and organize Classes ease.
* Featured Status and Status Options.

#### Courses
* Create, update, Delete and organize Courses ease.
* Featured Status and Status Options.
* Allow Courses to be associated with Classes.
* Meta information (title, description, image, keywords.)

#### Subjects
* Add each Subjects against Courses with ease.
* Subject List with Edit and Delete Options.
* Meta information (title, description, image, keywords.)

#### Lessons
* Add each Lesson against Subjects with ease.
* Lesson List with Edit and Delete Options.

#### Lesson Videos
* Add each Video against Lesson with ease.
* Lesson Videos List with Edit and Delete Options.

#### Lesson Materials
* Add each Materials against Lesson with ease.
* Lesson Materials List with Edit and Delete Options.

#### Lesson Exams
* Add  Exams (mcq/assignments/CQ) against Lesson with ease.
* Lesson Exams List with Edit, Delete and Submission Options.
* Track Submission,Marks, Attempts, Download Exam File and Grade Exam Results.

#### Exam Questions
* Add  Questions (mcq/assignments/CQ) against Exam with ease.
* Questions List with Edit, Delete Options.
* Support For Complex Math Equation with KaTeX.

## User Roles and Permissions
### Admin and Teacher
* Separate Dashboard for Admin and Teacher, They Can Manage Courses, along with other Functionalities.
* Support For Permission Management.
* Add, Edit, Update, Delete Users with Roles ease.

### Student
* Separate Dashboard for Student, They Can Manage Classes,Courses along with other Functionalities.
* Enrolled List, Exam History,Exam Solution.
* Support For Lesson, Videos, Materials, Quiz, Assignment, and other Functionalities.
* Add, Edit, Update, Delete Users with Roles ease.

## Website Dynamic Content

#### Hero Banner Section
* Update Hero Banner with ease.
* Support For Image Upload.

#### About Section
* Update About with ease.
* Support For Image Upload.

#### Testimonial Section
* Add,Edit,Update,Delete Testimonials with ease.
* Support For Image Upload.

#### Testimonial Settings Section
* Update Testimonial Settings with ease.
* Support For Image Upload.

#### Blog Section
* Add,Edit,Update,Delete Blogs with ease.
* Support For CKEditor.
* Support For Image Upload.
* Meta information (title, description, image, keywords.)

#### Page Section
* Add,Edit,Update,Delete Pages with ease.
* Meta information (title, description, image, keywords.)
* Support For CKEditor.

#### Website Basic Settings (Settings)
* Update Website Basic Settings with ease.
* Support For Image Upload.

## Order Management:
* Track and manage orders with payment Status and Status with ease.
* Support For Payment Gateway (Bkash).

## External API Support:
* Support For Bkash Payment Gateway.
* Support For SMS Gateway.
* Support For Chatgpt API.

## Responsive Design:
* Fully responsive and accessible on all devices (desktop, tablet, mobile).



<p align="right">(<a href="#readme-top">back to top</a>)</p>



## Technologies Used
<span style="font-weight: bold;">Frontend:</span> Jquery, Blade, HTML, CSS, JavaScript, Bootstrap

<span style="font-weight: bold;">Backend:</span> PHP, Laravel.

<span style="font-weight: bold;">Database:</span> MySQL.

<span style="font-weight: bold;">Authentication:</span> Custom OTP login/Registration System.

<span style="font-weight: bold;">Hosting:</span> EBNHost.

<span style="font-weight: bold;">Tools:</span> Git, PHPStorm, dbForge Studio, Xampp





<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started



### Prerequisites
* PHP 8.2.4+
* Composer (dependency manager for PHP)
* Database (MySQL/ PostgreSQL/ SQLite/ SQL Server)
* Git

### Installation

Please Follow the steps to install this project Locally.

#### 1. Clone the repo
Open your terminal and navigate to the directory where you want to install the Laravel project.
Then run the following command:
   ```sh
   git clone https://github.com/Sabbir-Hossain12/LMS.git
   ```
#### 2. Navigate to Project Directory
Move into the project directory:
   ```sh
   cd LMS
   ```

#### 3. Install Dependencies
Once you are in the project directory, use Composer to install the required dependencies:
   ```sh
   composer install
   ```

#### 4. Create Environment File
Laravel requires an environment file for configuration. Duplicate the .env.example file and save it as .env:

   ```sh
   cp .env.example .env
   ```
#### 5. Generate Application Key
Run the following command to generate a unique application key:
   ```sh
php artisan key:generate
   ```
#### 6. Run Migrations
Use the following command to run database migrations:
   ```sh
  php artisan migrate
   ```   
#### 7. Serve the Application
You can use Laravel's built-in development server to run the application locally.
Execute the following command:
```sh
php artisan serve
```   
This will start a development server, and you can access your Laravel application at http://127.0.0.1:8000 in your web browser.
<p align="right">(<a href="#readme-top">back to top</a>)</p>



## Database Design

<img src="https://i.ibb.co.com/1tCTxFBd/ss.png" alt="ss" border="0">



<!-- CONTACT -->
## Contact

Sabbir Hossain- h.sabbir36@yahoo.com

Project Link: https://github.com/Sabbir-Hossain12/LMS

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

i would like to give credit to some of the resources down below that helped my project.

#### Package

* [laravel-bkash-tokenize](https://github.com/karim-007/laravel-bkash-tokenize)
* [brian2694/laravel-toastr](https://github.com/brian2694/laravel-toastr)
* [spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
* [yajra/laravel-datatables-oracle](https://yajrabox.com/docs/laravel-datatables/11.0/installation)
* [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
* [laravel/breeze](https://github.com/laravel/breeze)
* [KaTex](https://katex.org/)
* [summernote-math](https://github.com/tylerecouture/summernote-math)

#### External API

* [Bkash Payment Gateway](https://www.bkash.com)
* [SMS Gateway](https://www.smsgateway.com.bd)
* [Chatgpt API](https://platform.openai.com/docs/guides/gpt/quickstart)


<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=for-the-badge
[contributors-url]: https://github.com/othneildrew/Best-README-Template/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/othneildrew/Best-README-Template.svg?style=for-the-badge
[forks-url]: https://github.com/othneildrew/Best-README-Template/network/members
[stars-shield]: https://img.shields.io/github/stars/othneildrew/Best-README-Template.svg?style=for-the-badge
[stars-url]: https://github.com/othneildrew/Best-README-Template/stargazers
[issues-shield]: https://img.shields.io/github/issues/othneildrew/Best-README-Template.svg?style=for-the-badge
[issues-url]: https://github.com/othneildrew/Best-README-Template/issues
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=for-the-badge
[license-url]: https://github.com/othneildrew/Best-README-Template/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 
