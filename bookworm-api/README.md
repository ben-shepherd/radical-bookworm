## Docker Installation

Clone the repository

`git clone <repo>`

Change current directory to repository

`cd <path-to-cloned-repository>`

Build docker containers

`docker compose up --build -d`

Confirm docker containers are running

`docker ps`

Obtain your New York Times API key

https://developer.nytimes.com/apis

Add your key to the .env file

```
NYTIMES_API_KEY=xyz123...
```

## React Frontend

Install react dependencies

`cd bookworm-react`

`yarn install`

Start react in development mode

`yarn start`
