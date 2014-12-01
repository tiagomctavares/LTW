# LTW Project

### [Project Guide](http://paginas.fe.up.pt/~arestivo/doku/doku.php/classes:years:2014:ltw:project)

---
### Requirements

__The minimum expected requirements are the following:__

<input type="checkbox"> Users should be able to register an account.
<input type="checkbox"> Users should be able to login/logout from the system.
<input type="checkbox"> Registered users should be able to create a poll.
<input type="checkbox"> Registered users should be able to manage their polls.
<input type="checkbox"> Polls should contain one image and several possible answers.
<input type="checkbox"> Users should be able to list, search and answer to polls.
<input type="checkbox"> One user should not be able to answer twice to the same poll.
<input type="checkbox"> Poll owners and users that already answered a poll, should be able to see the poll results.
<input type="checkbox"> The following technologies should all be used: HTML, CSS, PHP, Javascript (by means of jQuery), Ajax/JSON, PDO/SQL (using sqlite).
<input type="checkbox"> The web site should be as secure as possible.
<input type="checkbox"> Code should be organized and and consistent.

__Some suggested extra requirements:___

<input type="checkbox"> Poll owners should be able to decide if the poll is public or private.
<input type="checkbox"> Private polls should not appear in listings or searches. Only the poll URL should needed to access it.
<input type="checkbox"> Polls with more than one question.
<input type="checkbox"> Poll results with graphs or charts.
<input type="checkbox"> Possibility to share a poll using email or a social network.
<input type="checkbox"> And whatever you come up with…

---

### Bugs and Features

Report bugs or new features by:

1. Adding an issues

2. Assigning it to the proper person(s)

---

### Project Structure

##### Flow

For each request the flow is as follows:

1. HTTP Request for page **index.php**
2. **index.php** roots the request by parameter to the correct **view**
3. **view** does operations fetches data from **models** builds that data in a **"dictionary/variables"** to be used in **templates** and calls the proper **template**

For each test request the flow is as follows:

1. HTTP Request for page **tests.php**
2. **tests.php** includes the **all_tests.php** and shows the output

Note: Views/User actions must return vars and constant TESTING must be defined. If TESTING is defined library template_functions doesn't render html response.


##### Folders
**Folder** | **Description**
------ | -----------
public_html | Holds all public files to be accessed by clients
+ Img | Location for all the static images of the application
+ css | Location for all css files
+ js | Location for all js files
resources | Holds all libraries, configs and any code used as resource in project
+ lib | Location for all libraries
+ models | Location for files to get database data
+ views | Location of files with functions with actions. Control the request and builds the result template
+ tests | Location for files to run tests to user actions
+ templates | Location for all reusable components that make up the layout
++ pages | Location for the non-reusable content of the layout

**Legend**: Each + sign represents a new level in a directory (for example css is a subfolder of public_html)

##### Main Files

**File** | **Description**
---- | -----------
db.sqlite3 | Database of the application
public_html/index.php | Only accessible page for the clients, serving as root for the application
resources/config.php | Main configuration page. Should store application wide settings
resources/developer_config.php | Included and used in config.php and ignored by repo storing environemnt settings for each developer
resources/session_config.php | Used to configurate and start the Session. This file is included in config.php

---

### Libraries
**Library** | **Description**
------- | -----------
renderTemplate.php | Used to render templates, so devs don't have to include the same common files in each page
mypdo.php | Used to get data from database easier
[simpletest](http://www.simpletest.org/en) | 3rd party library to run unit Tests

---

### Models
**Model** | **Description**
-------- | -----------
user.php | Class that fetch User data from database
poll.php | Class that fetch Poll data from database

---

### Views
**Model** | **Description**
-------- | -----------
user_actions.php | Functions for user actions (Example: Register)
pages.php | Functions for user actions (Example: Register)

---

### Common/Global Templates
**Template** | **Description**
-------- | -----------
error.php | Included when there is a rooting error or bad request
header.php | Header to be included in every page
footer.php | Footer to be included in every page

### Templates
**Page** | **Description**
-------- | -----------

### Tests
**Model** | **Description**
-------- | -----------
all_tests.php | Suite test that includes and runs all tests for the application. To include a new test file just add the file with tests and fill one more array position in constructor with the filename.
testUserStart.php | Unitary Test to register and login user (incomplete)
testPoll.php | Unitary Test to add Poll, manage it and delete it (incomplete)
testUserEnd.php | Unitary Test to logout user and delete data of user from database (incomplete)


Notes: 
* The file and the class must have the same name
* For more information read [SimpleTest Documentation](http://www.simpletest.org/en)

---