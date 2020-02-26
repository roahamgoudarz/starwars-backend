
<a  href="https://prototype.net/">

<img  src="https://assets.website-files.com/5dd6f4bd37726fc1e1193f11/5dd706ff4e896a1d62450375_logo.svg"  alt="Prototype logo"  title="prototype"  align="right"  height="30"  />

</a>

  

# :star: Star Wars Movie Information
>  **Do or do not. There is no try.**

  <hr>

### Introduction

  

After running this project you will see:

  

1. Which of all Star Wars movies has the longest opening crawl?

2. What character (person) appeared in most of the Star Wars films?

3. What species (i.e. characters that belong to certain species) appeared in the most number of Star Wars films?

4. What planet in Star Wars universe provided largest number of vehicle pilots?

  

Not to mention, you should sign up and sign in to see the details.

  
  

![enter image description here](https://i.ibb.co/c6wtKMH/typo3-demo.png)

  

  

## Table of content

  

1. [Installation](#installation)
4. [Database](#database)
	- [General Ideas](#general-ideas)
	- [Details Ideas](#detailed-ideas)
5. [Code overview](#code-overview)
 	- [Backend flow](#backend-flow)
	- [Dependencies](#dependencies)
	- [CORS](#cors)
7. [Links](#links)

  

  

## Installation

### backend

The latest version can be installed by cloning the script and running composer to install dependencies.

  
Clone the repository

`git clone git@github.com:roahamgoudarz/starwars-backend.git`


Switch to the repository folder

`cd starwars-backend`

 
Install all the dependencies using composer

 
`composer install`

This will install star-wars backend and the latest dependencies.

### fronend

Clone the repository

`git clone git@github.com:roahamgoudarz/starwars-frontend.git`


Switch to the repository folder

`cd frontend`

 
Install all the dependencies using npm

 
`npm install`

This will install star-wars frontend dependencies.

Finally by `npm start` you can start!


## Database

  ### Suggested Modifications

  #### General Ideas

 - Change `created` columns to `timestamp` and set default value to `CURRENT_TIMESTAMP`
 - Change `edited` columns to `timestamp` and set `On Update Curent_Timestamp`
 - Add `Auto Increment` to tables
- Add new table `languages`
- Add new table `colors` for `eye_color`s and `skin_color`s
- Based on usage switch some tables from `MyISAM` to `InnoDB`
<br>

#### Detailed Ideas


| # | Table   | Column    | Description | 
| - |  ---     |   --      |      -----     |
|1 | people  | homeworld | - Convert to (int) <br> - Add index <br> - Change name to planet_id <br> - Add foreign keys constraints|
|2 |people | id | - Add auto increament
|3 |people | birth_year <br> eye_color <br> gender <br> hair_color <br> height <br> mass <br> skin_color | - Change from longtext
|4 | planets | id | - Add auto increment
|5 | planets | climate <br> diameter <br> gravity <br> orbital_period <br> population <br> rotation_period <br> surface_water <br> terrain  | - Change from longtext
|6 | species | id | - Add auto increment
|7 | species | average_height <br> average_lifespan <br> classification <br> designation <br> eye_colors <br> hair_colors <br> language <br> skin_colors | - Change from longtext
|8 | species | homeworld | - Convert to (int) <br> - Add index <br> - Change name to planet_id <br> - Add foreign keys constraints|
|9 | films | id | - Convert to auto increment
|10 | starships | id | - Convert to auto increment
|11 | transports |  id | - Convert to auto increment
|12 | transports |  cargo_capacity <br> consumables <br> consumables <br> crew <br> length <br> manufacturer <br> max_atmosphering_speed <br> model <br> passengers|  - Change from longtext
|13 | vehicles |  id       | - Convert to auto increment
|14 | vehicles |  vehicles | - Change from longtext



  

## Code overview

### Dependencies
[graphql-php](https://webonyx.github.io/graphql-php/) - For  implementing of GraphQL Api's in PHP
  
### Cross-Origin Resource Sharing (CORS)
This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from  `http://localhost:3000`  to help speed up your front-end testing. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.

-   [https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS)
-   [https://en.wikipedia.org/wiki/Cross-origin_resource_sharing](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing)
-   [https://www.w3.org/TR/cors](https://www.w3.org/TR/cors)

### Backend flow
![enter image description here](https://i.ibb.co/pzH8ZTF/flow.png)
## Links

  
  

*  [Demo](https://karohadaf.com/)
*  [Prototype](https://prototype.net/)
*  [Issue tracker](https://github.com/roahamgoudarz/starwars-backend/issues)
*  [Source code](https://github.com/roahamgoudarz/starwars-backend)
