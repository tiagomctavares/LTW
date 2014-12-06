# LTW Project

### [Project Guide](http://paginas.fe.up.pt/~arestivo/doku/doku.php/classes:years:2014:ltw:project)

### [Working Project] (http://gnomo.fe.up.pt/~ei10140/ltw-project/)

---
### Requirements

__The minimum expected requirements are the following:__

- [X] Users should be able to register an account.
- [X] Users should be able to login/logout from the system.
- [X] Registered users should be able to create a poll.
- [X] Registered users should be able to manage their polls.
- [X] Polls should contain one image and several possible answers.
- [X] Users should be able to list, search and answer to polls.
- [X] One user should not be able to answer twice to the same poll.
- [X] Poll owners and users that already answered a poll, should be able to see the poll results after its closure.
- [X] Users with no login should be able to vote on polls.
- [X] The following technologies should all be used: HTML, CSS, PHP, Javascript (by means of jQuery), Ajax/JSON, PDO/SQL (using sqlite).
- [X] Code should be organized and and consistent.
- [X] The web site should be as secure as possible.


__Some suggested extra requirements:__

- [X] Poll owners should be able to decide if the poll is public or private.
- [X] Private polls should not appear in listings or searches. Only the poll URL should needed to access it.
- [ ] Polls with more than one question.
- [X] Poll results with graphs or charts.
- [X] Possibility to share a poll using email or a social network.


__And whatever you come up with…__
- [X] Responsive Design
- [X] Modal
- [X] Timeline
- [X] SlideShow
- [X] PHP Classes and Interfaces
- [X] Automated database update (changing the version of DB in one file)
- [X] Non registered user can submit vote on polls 
- [X] AJAX Filters for your own polls
- [X] It's possible to close Polls (Results can only be seen after poll is closed except for the creator)

__Libraries__
- [X] MyPDO
- [X] Render
- [X] Session Controllers
- [X] Database Version

---

### Bugs and Features

Report bugs or new features by:

1. Adding an issues

2. Assigning it to the proper person(s)

---

### Project Preparation/Installation

##### Step 1

Copy Files:
1. Copy public_html to the server
2. Copy resources to parent folder of public_html


##### Step 2

Change path on index.php file. Path should represent the logic path to config. 

Example: project is located in /public_html/ltw-project and config is located on the parent folder of public_html inside folder resources
1. Open index.php on line 3: require_once realpath(dirname(__FILE__) . "/../../resources/config.php");


##### Step 3

Change variables in developer_config.php located in resources folder
Example: 
<?php
$user_url = 'http://paginas.fe.up.pt/~ei10140/ltw-project';
$cookie_path = '/~ei10140/ltw-project';
?>

user_url represents the urls of the server
cookie_path is used to store cookies

---

### Access Credentials
**Username** | **Password**
------ | -----------
andre | 1234
tiago | 1234
pedro | 1234
maria | 1234
joana | 1234
paulo | 1234


### Project Structure

##### Flow

For each request the flow is as follows:

1. HTTP Request for page **index.php**
2. **index.php** includes the **config.php** that takes care of configurations and the include of global libraries
2. **index.php** roots the request by parameter to the correct **view**
3. **view** does operations fetches data from **models** builds that data in a **"dictionary/variables"** to be used in **templates** and calls the proper **template** through the Render Library


##### Folders
**Folder** | **Description**
------ | -----------
public_html | Holds all public files to be accessed by clients
+ img | Location for all the static images of the application
++ upload | Location for all dynamic images (Polls)
+ css | Location for all css files
+ fonts | Location for fonts
+ js | Location for all js files
resources | Holds all libraries, configs and any code used as resource in project
+ lib | Location for all libraries
+ models | Location for files to get database data
+ views | Location of files with functions with actions. Control the request and builds the result template
+ templates | Location for all reusable components that make up the layout
++ pages | Location for the non-reusable content of the layout

**Legend**: Each + sign represents a new level in a directory (for example css is a subfolder of public_html)

##### Main Files

**File** | **Description**
---- | -----------
resources/db.sqlite3 | Database of the application
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
databaseVersion.php | Automated script to create the database and populate it
pageAlerts.php | Used to manage notifications for the user
userInfo.php | Used to manage SESSION information of the user

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
user_actions.php | Functions that handle user actions and redirect to pages (Example: Register)
pages.php | Functions that handle the user output (Example: Register Page)
ajax_request.php | Functions that handle asynchronous requests

---

### Common/Global Templates
**Template** | **Description**
-------- | -----------
error.php | Included when there is a rooting error or bad request
header.php | Header to be included in every page
footer.php | Footer to be included in every page
navbarAfterLogin.php |
navbarBeforeLogin.php |

### Templates
**Page** | **Description**
-------- | -----------
editPoll.php | HTML
home.php | HTML
login.php | HTML
newPoll.php | HTML
showPoll.php | Detailed information about poll also allows the user to vote
timeline.php | Shows the polls order by date in a timeline
viewAllPolls.php | Used to manage user Polls

## Students
1. Mário Ferreira - ei12105@fe.up.pt
2. Pedro Faria - ei12097@fe.up.pt
3. Tiago Tavares - ei10140@fe.up.pt
