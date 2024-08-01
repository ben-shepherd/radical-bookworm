## Hosting
I've used Docker for hosting all the required apps. I've took advantage of ChatGPT to help with building out the configuration files.

## Issues frontend
The header background color (for RADICAL logo) does not match the design
The sidebar icon does not update to active when a different page is loaded (Always sticks to the homepage (chart icon))

## Issues backend
none! (yet)

## Todo Frontend
Endpoints i think we'll need
- new york best sellers
- favourite books
- save rating

## Todo Backend
- create middleware (can be simple, static key from .env passed to header Authorization)
- search books endpoint
- favourite books endpoint
- crud endpoints
- rating endpoint

# Frontend Design notes

# API Design Notes
- Utilised the Domain folder structure with scalability in mind.
- Most functions only perform 1 action, allowing them to predictable and reusable.
- Organised into a commonly accepted folder structure, queries in repositories, factories for creating objects
- Public services have contracts allowing them to utlized outside of it's feature domain folder

# Updating of books
- The updating of books functionality sits inside a Command. 
-- Typically, this allows to run it as a cron daily. 
-- An alternative method, store a TTL somewhere, when a user requests a search endpoint, we could trigger a queue worker to perform the update, while not affecting the response time of the initial request. This means the user can request the a search, but also is responsible for triggering an update due to the system recognising it out of date 