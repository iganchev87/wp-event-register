# Event Register  

Event Register is a WordPress plugin for a new custom type of events.

## Installation

1. In **wp-content/plugins** create folder with name **event-register**.
2. Clone or Download plugin (all files) from **https://github.com/iganchev87/wp-event-register** in **wp-content/plugins/event-register**
3. Activate from Plugins and "Events" tab will show in Dashboard. 

---
## Usage

- New event can be created in Events (in Dashboard) after filing form.
Form have 4 inputs: Title, Date, Event location and Event URL.
- A Google Calendar button has been added in preview mode - it will open the calendar with filled in data for Title, date and location (from event data).
- I tried to integrate Google map, but due to problems API key,  the map is only embedded.


### Structure
```
├── css
│   ├── event_register_form_admin_styles.css
│   │── jquery-ui.min.css
│
├── inc
│   ├── event-register-activate.php
│   └── event-register-deactivate.php
│
├── js
│   └── init_custom.js
│   └── jquery-ui.min.js
│
├── views
│   └──components
│   │            └── google-map.php
│   └── event-form.php
│   └── page.php
│
└── event-register.php

4 directories, 9 files
```

---
#### Crated by Ivan Ganchev iganchev87@gmail.com
### License
[MIT](https://choosealicense.com/licenses/mit/)
