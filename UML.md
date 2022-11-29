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
updatedAt
number
orders
}

Address -- Order
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

class Image{
PK - id
path
title
product
}

class Order{
PK - id
createAt
shipped
paymentMethod
billingAddress
deliveryAddress
user
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
class OrderDetail{
PK - id
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
orderDetails
}

Product -- Image
Product -- CartDetail
Product -- OrderDetail
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
cart
vat
addresses
orders
}

User -- Address
User -- Order

```