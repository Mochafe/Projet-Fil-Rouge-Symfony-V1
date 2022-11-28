```mermaid
classDiagram

class Address{
PK - id
street
country
zipcode
city
user
createdAt
}

class Cart{
PK - id
user
cartDetails
}

Cart -- CartDetail
class CartDetail{
PK - id
cart
product
quantity
}

class Category{
PK - id
name
image
parent
childs
products
}

Category -- self
Category -- self
Category -- Product
class Image{
PK - id
path
title
product
}

class Product{
PK - id
name
description
reference
price
discount
discountRate
quantity
category
content
images
cartDetails
}

Product -- Image
Product -- CartDetail
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
cart
vat
addresses
}

User -- Address
class Professional{
PK - id
companyName
duns
user
}


```