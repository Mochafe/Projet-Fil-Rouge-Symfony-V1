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
class CartDetail{
PK - id
cart
product
quantity
}

class Cart{
PK - id
user
cartDetails
}

Cart -- CartDetail
class Image{
PK - id
path
title
product
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
class Order{
PK - id
createAt
shipped
paymentMethod
billingAddress
deliveryAddress
user
orderDetails
received
}

Order -- OrderDetail
class OrderDetail{
PK - id
product
quantity
discount
orderUser
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
supplier
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

class Supplier{
PK - id
name
products
}

Supplier -- Product
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