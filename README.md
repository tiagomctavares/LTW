# LTW Project

### [Project Guide](http://paginas.fe.up.pt/~arestivo/doku/doku.php/classes:years:2014:ltw:project)

---

### Bugs and Features

Report bugs or new features by:

1. Adding an issues

2. Assigning it to the proper person(s)

---

### Project Structure

##### Folders
| Folder | Description |
| public_html | Holds all public files to be accessed by clients |
| + Img | Location for all the static images of the application |
| + css | Location for all css files |
| + js | Location for all js files |
| resources | Holds all libraries, configs and any code used as resource in project |
| + lib | Location for all libraries |
| + templates | Location for all reusable components that make up the layout |
| ++ pages | Location for the non-reusable content of the pages |

##### Main Files
| File | Description |
| db.sqlite3 | Database of the application |
| public_html/index.php | Only accessible page for the clients, serving as root for the application |
| resources/config.php | Main configuration page. Should store application wide settings |
| resources/dev_options.php | Used in config.php and ignored by repo storing environemnt settings for each developer |

---

### Libraries
| Library | Description |
| templateFunctions.php | Used to render templates, so devs don't have to include the same pages for each page |

---

### Common Templates
| Template | Description |
| error.php | Included when there is a rooting error or bad request |
| header.php | Header to be included in every page |
| footer.php | Footer to be included in every page |