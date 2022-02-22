This project is an application made as part of a web developer training.
The objective is to create a website allowing the management of the data of a spy organization.

The instructions are as follows:
- The agents have a name, a first name, a date of birth, an identification code, a nationality, 1 or more specialties.
- The targets have a name, a first name, a date of birth, a code name, a nationality.
- Contacts have a surname, first name, date of birth, code name, nationality.
- Hideouts have a code, an address, a country, a type.
- The missions have a title, a description, a code name, a country, 1 or more agents, 1 or more contacts, 1 or more targets, a type of mission (Surveillance, Assassination, Infiltration…), a status (In preparation, in progress, completed, failed), 0 or more hideouts, 1 specialty required, start date, end date.
- The administrators have a name, a first name, an email address, a password, a creation date.

Business rule:
- On a mission, the target(s) cannot have the same nationality as the agent(s).
- On a mission, the contacts must be of the nationality of the country of the mission.
- On a mission, the hideout must be in the same country as the mission.
- On a mission, you must assign at least 1 agent with the required specialty.

The teaching methods are as follows:
You are asked to create the database according to this description. All fields should have the correct types, with optimization. It is also necessary to create the links between the different tables. Some columns may be missing and necessary for your development, it's up to you to provide them. No dataset is provided. A design drawing (MCD/MLD) will be required. It will be necessary to create a database creation script, easily executable for quick creation.
You are then asked to create a front-office interface, accessible to everyone, allowing you to consult the list of all the missions, as well as a page allowing you to see the details of a mission.
In addition, it will be necessary to create a back-office interface, only accessible to ADMIN role users, which will make it possible to manage the library database. This back-office will make it possible to list, create, modify and delete each piece of data from the different tables, using forms and tables. These pages must not be accessible to everyone! It will therefore be necessary to create a login and logout page (no registration page).
The project must be carried out in object-oriented programming, of the MVC (Model View Controller) type. Each table in the database will be represented by a PHP object.

BONUS:
- Integrate a pagination system on all the lists of the site (front-office / back-office)
- Add a system of filters and sorting on all the lists of the site
- Add a search field for a mission
- Use AJAX to send and retrieve data to your backend asynchronously, without having to reload the page