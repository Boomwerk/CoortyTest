# Test api Symfony For Coorty


## Download Project


> git clone https://github.com/Boomwerk/CoortyTest.git

## Install Project


> composer install


## IMG database 


![img database](https://github.com/Boomwerk/CoortyTest/coorty.png)


# Data


## {route}

> country

> animals

> breeds

> department

> poeples


## {data for send on post}

* ## country  
> { "countryName" , "countryImg"}

* ## animals  

> { "nameAnimals" , "imgAnimal" }

* ## breeds  

> { "nameBreed" , "sizeBreed" ,  "ageBreed", "imgAnimal"}

* ## department  

> { "nameDepartment" , "imgDepartment" }

* ## poeples  

> { "numberPeople" , "idDepartment", "idCountry", "idAnimals", "idBreeds" }



# How to use api 

### Method GET

    * /
    * /select/{route}
    * /select/{route}/{id}
    * /statistiques/agemoyenneAnimals/{idCountry}/{idAnimals}
    * /statistiques/NumbreOfDog/{idDepartment}/{idAge}
    * /statistiques/topAnimalsCountry/{country}/{animals}

### Method POST

    * /add/{route}

### Method PUT

    * /update/{route}/{id}

### Method DELETE

    * /delete/{route}/{id}

