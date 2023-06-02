# Image Generator

![Screenshot](images/screenshot.jpg)

This repository contains the Image Generator application, which generates a 5 x 2 image collage. 
The application follows PHP OOP principles and utilizes the Twig templating engine, with Tailwind CSS for styling.

The application requires PHP 7.4 and performs image processing tasks such as converting images to a predefined size and making them transparent. 
Due to the intensive image processing, caching is added for better performance.

Installation:

Follow the steps below to install and run Image Generator application:

1. Clone the repository:

   git clone https://github.com/azemitis/image-generator.git

2. Navigate to the image-generator folder:

   cd image-generator

3. Install dependencies:

   composer install

4. Launch localhost:
   
   cd public

   php -S localhost:8000