use("libraryDB");

// Find a user by name and retrieve specific fields using findOne()
db.users.findOne({name: "Danial Afiq"}, {_id: 1, email: 1, contact: 1})

// Find all books and retrieve their titles, authors, and categories using find()
db.books.find({}, {title: 1, authors: 1, categories: 1})

// Find fines with amount greater than 5.0 and less than 25.0 using $gt and $lt operators
db.fines.find({amount: {$gt: 5.0, $lt: 25.0}}, 
    {loanId: 1 ,amount: 1, reason: 1}).sort({amount: 1})

// Find fines with amount equal to RM 0.0 using $eq operator
db.fines.find({amount: {$eq: 0.0}})

// Find loans with status either "BORROWED" or "PENDING" using $in operator
db.loans.find({status: {$in: ["BORROWED", "PENDING"]}}, {userId: 1, bookId: 1, status: 1})

// Find books that belong to both "Computer Science" and "Database" categories using $and operator
db.books.find({$and: [{categories: "Computer Science"}, {categories: "Database"}]}, 
    {title: 1, authors: 1, categories: 1})

// Find books that are either in "Programming" category or published in the year 2020 using $or operator
db.books.find({$or: [{categories: "Programming"}, {"publisher.year": 2020}]}, 
    {title: 1, authors: 1, categories: 1, publisher: 1})

// Find books authored by "Abraham Silberschatz" in array query 
db.books.find({authors: "Abraham Silberschatz"}, {title: 1, authors: 1, categories: 1})
