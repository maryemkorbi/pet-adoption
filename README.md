# Pet Adoption Board

Animal shelters list their animals, people browse them and send adoption requests.
The shelter accepts or refuses each request, and the animal's status follows:
**available → reserved → adopted**.

Built with Laravel by Maryem Korbi.

## Installation

```
git clone https://github.com/maryemkorbi/pet-adoption.git
cd pet-adoption
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
composer run dev
```

The database file is not in Git: the migrate command offers to create it, answer yes.
On Windows PowerShell, use `copy .env.example .env` instead of `cp`.

Then open http://localhost:8000

## Features

- list, show, add, edit and delete animals (with photo upload)
- filter by species, search by name, pagination
- shelters list and one page per shelter with its animals
- adoption requests: send, accept or refuse; the animal's status changes automatically
- server-side validation with error messages and previous values kept
- JSON list of available animals: `/animals.json`
- feature tests: `php artisan test`

## Data

- **Shelter**: name, city, phone, email
- **Animal**: name, species, breed, age, gender, description, vaccinated, photo, status, belongs to a shelter
- **AdoptionRequest**: full name, email, phone, message, status, belongs to an animal
