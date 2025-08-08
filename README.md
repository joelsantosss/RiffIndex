RiffIndex
Abstract
RiffIndex is a web platform designed to unite rock music enthusiasts by providing a rich resource of band profiles, guitar tabs, and the latest rock news. It serves players of all skill levels and helps users discover new bands while fostering a community around their passion for rock music.

Project Objective
Develop a responsive and user-friendly website as a comprehensive rock music resource.

Build and maintain a database for band profiles and rock-related trivia.

Enable users to explore bands, access guitar tabs, and stay updated with rock news.

Implement user registration and login for personalized experiences.

Create an interactive interface encouraging community engagement.

Features
Guitar Tabs & Riffs: A curated collection for all skill levels.

Search Functionality: Easily find specific songs or bands.

Responsive Design: Smooth experience across all devices.

Database Design
Users Table: Stores user info (id, name, email, encrypted password, role, phone, image, requests).

Bands Table: Stores band details (id, genre, activity status, name, creation date, members, description).

Band Requests Table: Tracks user submissions for new band profiles (id, user_id, band_name, date, members, genre, description, status, request date, reason, activity status).

Relationships:

One-to-many relationship between Users and Band Requests.

Technologies Used
Frontend: HTML5, CSS3, JavaScript, Bootstrap

Backend: PHP 7.4+

Database: MySQL 5.7+

Local Environment: XAMPP

Challenges Faced
Ensuring consistent styling and layout across pages.

Implementing responsive design for various devices required extensive testing and adjustments.

Future Implementations
Adding a blog system where admins can post album reviews. Users can like and comment, enhancing engagement.

Testing
Verified user authentication (login/signup).

Tested clickable links for proper navigation.

Ensured email features function correctly.

Validated CRUD operations on bands and user databases.

