# Image Generator

![Screenshot](images/screenshot.jpg)

This repository contains Image Generator application 
which generates a 5 x 2 image collage. 
The application follows PHP OOP principles and utilizes the Twig templating engine which uses Tailwind.
The application runs in PHP 7.4. It converts images to a predefined size and makes them transparent.
Due to heavy image processing use of Cache is recommended.

Installation:

Follow the steps below to install and run Image Generator application:

1. Clone the repository:

   git clone -b https://github.com/azemitis/image-generator.git

2. Navigate to the image-generator folder:

   cd image-generator

3. Install dependencies:

   composer install

4. Launch localhost:
   
   cd public

   php -S localhost:8000