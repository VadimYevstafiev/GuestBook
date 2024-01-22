This is my implementation of the GuestBook test job.
Implemented:
1. There is a main page ('Home') on which notes are displayed.
    Messages are divided into pages of 25 notes.
    The main page is available for viewing by both authorized users and unauthorized visitors.

2. For each note, authorized users can write as many comments (notes) as they want (the 'Add note' button on notes).
    Authorized users can also make new notes ('Send note' button).

3. Heading notes (those that are not comments) are displayed on the 'Heads' page, with the ability to sort by the following fields:
    User Name, Email, and Created_at (date added), both in descending and reverse order.
    The 'Heads' page is only viewable by authorized users.

4. There are two roles for authorized users: 'admin' and 'user'.
    'admin' has the permissions:
       - create new notes;
       - edit own notes;
       - delete notes, both your own and those of other users.
    'user' has the permissions:
       - create new notes;
       - edit own notes;
       - delete own notes.

5. Anyone can register in the application as 'user', or log in as 'admin' (email 'admin@admin.com', password 'test1234') or 'user' role (email 'test@test.com' , password 'test1234').

6. The contetnt of created or edited notes is checked for the presence of HTML tags (allowed tags <a href=”” title=””> </a> <code> </code> <i> </i> <strong> </strong>), as well as for the presence of unclosed tags.

7. The users can attach files to created and edited note:
       - images (allowed extensions - 'jpg', 'jpeg', 'gif', 'png');
       - text files (valid extension - 'txt, valid size no more than 100 kB).

8. When editing messages, you can delete previously attached files.


In order to deploy the project, you must:
1. Open a terminal in the root folder of the project.
2. Copy the .env.example file and rename it to .env
   Make sure there are no leading or trailing spaces in the .env name.
3. Install composer (if it is not installed) according to the guide https://getcomposer.org/download/.
4. Install Laravel Sail (https://laravel.com/docs/10.x/sail#main-content).
    Enter the commands in the terminal:
     composer require laravel/sail --dev
     php artisan sail:install

     When prompted "Which services would you like to install?" select mysql

     ./vendor/bin/sail up -d --build
     ./vendor/bin/sail artisan key:generate
     ./vendor/bin/sail artisan storage:link
    ./vendor/bin/sail artisan migrate --seed

5. Install Laravel Breeze (https://laravel.com/docs/10.x/starter-kits#laravel-breeze).
    Enter the commands in the terminal:

     ./vendor/bin/sail composer require laravel/breeze --dev
     ./vendor/bin/sail npm install
     ./vendor/bin/sail npm run dev (recommended in another tab)

6. Open http://localhost/ in your browser.
7. Register ('Register') or log in (email 'admin@admin.com', password 'test1234' or email 'test@test.com', password 'test1234').