```mermaid
classDiagram

class Professional{
PK - id
companyName
duns
user
}

class User{
PK - id
email
roles
password
isVerified
firstName
lastName
birthDate
signUpDate
phoneNumber
professional
}


```