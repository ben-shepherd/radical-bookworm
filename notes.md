
# #Technologies

Docker for development

Laravel 11

Postgres

React using create-react-app (TypeScript)

Tailwindcss

Swagger for docs

# #DesignPattern

The design pattern used separates feature logic into a self contained folder in App/Domains.

The 'Books' domain contains all logic relating to Books, and can be accessed outside of the Domain folder by using the Contracts provided.

Contents of the Domain:

- ServiceProviders
	- Binds Concrete classes to Contracts
	- Adds routing file
	- Adds middleware
	- Provides ClientInfo (GuzzleHttp) with base information when requested with DI
		- Adds the headers for accepting JSON.
		- Sets the Base URL.
		- (except) The token is added onto the URL as a query parameter for each request. I'm not sure this is possible in a clean way within the provider.
- Routes
- Requests
	- Validation
- Services
	- A generic BookApiService
		- Responsible for communicating with other APIs
	- NyTimesService
		- Fetches data from the NYTimes API 
	- ExternalBookService
		- Fetches data from another database
- Factories
	- Methods for creating Models from arrays
- Repositories
	- Methods for queries
- Fakers
	- Fakes books JSON when NYTimes API quota is reached
- Formatters
	- Formats different data structures into a BookDTO
- DTOs
	- Used for parameters options
	- Used for structure of arrays (Book, BookNames)

For example, in your controller you may need to reference BooksApiService, rather than using the concrete class, instead you can utilize the Contract, using the methods provided.

By using Contracts in this way, we can provide public functions, and define the data types used in the form of DTOs, which will allow for predictable behaviour, and refactoring down the line becomes in easier.


# #Features

The BooksApiService is responsible for communicating with other classes that implement ApiContract, this allows implementing more than one external data source

The books collection CRUD endpoints are handled as a resource.

There is a best seller endpoint which pulls BookDTOs from all the external APIs provided in the config `config/books.php`

Endpoint for returning all favourites relating to a user

# #Authentication

Super insecure simple solution

Aa static key in the .env must match header Authorization

# #Extras

As well as the `NyTimesService`, I have provided an additional resource that acts as if it were another external API that provides book resources called `ExternalBookService`. In reality it's connecting to another DB and pulling the books down from a collection and then formatting them in the system expects 